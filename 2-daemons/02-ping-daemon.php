#!/usr/bin/php
<?php

// Some config
define('LOGFILE', '/tmp/jkp-daemon-ping.log');

// Daemonize the parent
$pid = pcntl_fork();
if ($pid == -1) {
    echo 'Could not daemonize!\n';
    exit(1);
} elseif ($pid > 0) {
    echo 'Daemonized to ' . $pid . "\n";
    exit(0);
} else { // Daemonized
    umask(0);
    $sid = posix_setsid();
    if ($sid < 0) {
        echo 'Could not detach session id.\n';
        exit(1);
    }
    chdir(dirname(__FILE__));
    fclose(STDIN); fclose(STDOUT); fclose(STDERR);
    $fdIN = fopen('/dev/null', 'r');
    $fdOUT = fopen(LOGFILE, 'a');
    $fdERR = fopen('php://stdout', 'a');

    echo "Start pinging!\n";
    while (true) {
        echo "[" . date('Y-m-d H:i:s') . "] PING!\n";
        sleep(1);
    }
    echo "Stop pinging!\n";
}
