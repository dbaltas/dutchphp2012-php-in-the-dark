#!/usr/bin/php
<?php

// Definitions
define('MAX_PROCESSES', 10);
define('MSG_WORK', 1);
define('MSG_STATUS', 2);

// First we daemonize our script
$pid = pcntl_fork();
if ($pid > 1) { // Script started on the command line
    echo 'Script running in memory with PID ' . $pid . PHP_EOL;
    exit(0);
} elseif ($pid === 0) { // Daemonized script
    $parentPid = getmypid();
    umask(0);
    $sid = posix_setsid();
    if ($sid < 0) {
        echo 'Could not detach session id' . PHP_EOL;
        exit(1);
    }
    chdir(dirname(__FILE__));

    fclose(STDIN); fclose(STDOUT); fclose(STDERR);
    $fdIN  = fopen('/dev/null', 'r'); // No input as daemon
    $fdOUT = fopen('/var/log/parallel.log', 'a');
    $fdERR = fopen('/var/log/parallel-errors.log', 'a');
} else { // Something went wrong
    echo 'Something went wrong while forking the script' . PHP_EOL;
    exit(1);
}

// Next we create our child processes
$allProcesses = array();
for ($i = 0; $i < MAX_PROCESSES; $i++) {
    if (getmypid() == $parentPid) {
        $pid = pcntl_fork();
        if ($pid > 1) {
            $allProcesses[$pid] = $pid;
        } else {
            
        }
    }
}

$queueKey = ftok(__FILE__, 'a');
$queueId = msg_get_queue($queueKey);

// Execute the logic we need
if (getmypid() == $parentPid) { // Parent
    echo "PARENT $parentPid\n";
    while (true) {
        // Check if we received a message
        if (msg_receive($queueId, MSG_STATUS, $msgType, 32, $status, false, 0, $error)) {
            echo "[$parentPid] RECEIVED : $status\n";
        }
    }
} else { // Child
    $currentPid = getmypid();
    echo "CHILD $currentPid\n"; 
    while (true) {
        // Check if we received a message
        if (msg_receive($queueId, MSG_WORK, $msgType, 32, $workId, false, 0, $error)) {
            echo "[$currentPid] RECEIVED : $workId\n";
        }
        msg_send($queueId, MSG_STATUS, "[$currentPid] <$workId> done", false);
        sleep(rand(1,2));
    }
}
