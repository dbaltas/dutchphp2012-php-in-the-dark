<?php

$daemons = array(
    'pinger' => array(
        'name'    => 'Ping Daemon!',
        'pidfile' => '/var/run/pinger.pid',
        'command' => '/php-in-the-dark/2-daemons/04-ping-daemon-pid.php',
        'params'  => array()
    ),
);

foreach ($daemons as $daemon) {
    echo "Checking " . $daemon['name'] . " ";
    if (file_exists($daemon['pidfile'])) {
        $pid = trim(file_get_contents($daemon['pidfile']));
        if (!empty($pid)) {
            // check if alive => send fake signal 0 and see if we get a reply
            if (posix_kill($pid, 0)) {
                echo "[OK]\n";
                continue; // next check
            }
        }
        echo "[PID FILE, NOT RUNNING]\n";
        @unlink($daemon['pidfile']);
    } else {
        echo "[NO PID FILE, NOT RUNNING]\n";
    }
    $pid = pcntl_fork();
    if ($pid === 0) {
        $sid = posix_setsid(); // Detach session
        if ($sid != -1) {
            echo "   => Starting " . $daemon['command'] . PHP_EOL;
            pcntl_exec($daemon['command'], $daemon['params']);
        }
    }
}