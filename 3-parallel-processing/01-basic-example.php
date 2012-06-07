#!/usr/bin/php
<?php

// Some config
define('MAX_CHILDREN', 10);
define('LOGFILE', '/tmp/jkp-parallel-basic.log');

// Daemonize the parent
$pid = pcntl_fork();
if ($pid == -1) {
    echo 'Could not daemonize!';
    exit(1);
} elseif ($pid > 0) {
    echo 'Daemonized to ' . $pid;
    exit(0);
} else { // Daemonized
    umask(0);
    $sid = posix_setsid();
    if ($sid < 0) {
        echo 'Could not detach session id.';
        exit(1);
    }
    chdir(dirname(__FILE__));
    fclose(STDIN); fclose(STDOUT); fclose(STDERR);
    $fdIN = fopen('/dev/null', 'r');
    $fdOUT = fopen(LOGFILE, 'a');
    $fdERR = fopen('php://stdout', 'a');
}

$parentPid = getmypid();

// Create our children
for ($i = 0; $i < MAX_CHILDREN; $i++) {
    if (getmypid() == $parentPid) {
        $pids[$pid] = $pid = pcntl_fork(); // SPAWN NEW CHILD
        if ($pid < 0) {
            echo 'Could not fork!';
            exit(1);
        }
    }
}

if (getmypid() == $parentPid) {
    // Parent Code
    while (!empty($pids)) {
        pcntl_signal_dispatch();
        echo "There are " . count($pids) . " processes running\n";
        foreach ($pids as $pid) {
            $pid2 = pcntl_waitpid($pid, $status, WNOHANG | WUNTRACED);
            if ($pid2 == $pid) {
                unset($pids[$pid2]);
           }
        }
        sleep(1);
    }
    echo "[PARENT] DONE!\n";
    exit(0);
} else {
    // Child Code
    for ($i = 0; $i < 10; $i++) {
        echo "[" . getmypid() . "] PING!\n";
        sleep(rand(1,4));
    }
    echo "[" . getmypid() . "] DONE!\n";
    exit(0);
}