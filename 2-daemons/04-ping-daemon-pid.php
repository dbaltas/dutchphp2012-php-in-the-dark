#!/usr/bin/php
<?php

// Some config
define("PIDFILE", "/var/run/pinger.pid");
define("LOGFILE", "/tmp/jkp-daemon-signals.log");
declare(ticks = 1);

// Signal handler
function signalHandler($signal)
{
    echo "SIGNAL $signal CAUGHT\n";
    global $doPing;
    switch ($signal) {
        case SIGTERM: case SIGQUIT:
            echo "We're done!\n";
            // handle shutdown tasks
            @unlink(PIDFILE);
            exit(); break;
        case SIGINT:
            echo "Setting \$doPing = false\n";
            $doPing = false;
            break;
        case SIGHUP:
            echo "Reinitialize, continue pinging...\n";
            pcntl_alarm(5);
            break;
        case SIGUSR1:
            echo "Caught SIGUSR1!\n";
            break;
        case SIGALRM:
            echo "Another 5 seconds have passed!\n";
            pcntl_alarm(5);
            break;
    }
}

// Check if the process is already running
if (file_exists(PIDFILE)) {
    $pid = trim(file_get_contents(PIDFILE));
    // Check if it is alive
    $check = posix_kill($pid, 0);
    if (posix_kill($pid, 0)) {
        die("Script is already running!\n");
    }
    // Not running, continue
    echo "PIDFILE found, script not running\n";
}

// Setup signal handlers
pcntl_signal(SIGTERM, "signalHandler");
pcntl_signal(SIGQUIT, "signalHandler");
pcntl_signal(SIGINT, "signalHandler");
pcntl_signal(SIGHUP, "signalHandler");
pcntl_signal(SIGUSR1, "signalHandler");
pcntl_signal(SIGALRM, "signalHandler", true);

// Daemonize the parent
$pid = pcntl_fork();
if ($pid == -1) {
    echo "Could not daemonize!\n";
    exit(1);
} elseif ($pid > 0) {
    echo "Daemonized to " . $pid . "\n";
    exit(0);
} else { // Daemonized

    $pid = getmypid();
    file_put_contents(PIDFILE, $pid);

    umask(0);
    $sid = posix_setsid();
    if ($sid < 0) {
        echo "Could not detach session id.\n";
        exit(1);
    }
    chdir(dirname(__FILE__));
    fclose(STDIN); fclose(STDOUT); fclose(STDERR);
    $fdIN = fopen("/dev/null", "r");
    $fdOUT = fopen(LOGFILE, "a");
    $fdERR = fopen("php://stdout", "a");

    echo "Start pinging!\n";
    global $doPing;
    $doPing = true;
    pcntl_alarm(5);

    while ($doPing) {
        pcntl_signal_dispatch();
        echo "[" . date("Y-m-d H:i:s") . "] PING!\n";
        if (date("s") == "00") {
            posix_kill(posix_getpid(), SIGUSR1);
        }
        sleep(1);
    }
    echo "Stop pinging!\n";
    @unlink(PIDFILE);
}
