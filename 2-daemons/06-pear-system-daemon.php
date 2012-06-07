#!/usr/bin/php
<?php

require_once "../Library/System/Daemon.php";

$options = array(
    'appName' => 'pinger2',
    'appDir' => dirname(__FILE__),
    'appDescription' => 'Just pings',
    'authorName' => 'Jeroen Keppens',
    'authorEmail' => 'jeroen@amazium.com',
);

System_Daemon::setOptions($options); // Minimum configuration

if ($argv[1] == '--startup') {
    $path = System_Daemon::writeAutoRun();
    echo "Startup script written: $path";
    exit(0);
}


System_Daemon::start();              // Spawn Deamon!
$runningOkay = true;
while (!System_Daemon::isDying() && $runningOkay) {
    // Ping
    error_log(date('Y-m-d H:i:s') . ' - PING!' . PHP_EOL, 3, '/tmp/jkp-pear-system-daemon.log');

    // Relax the system by sleeping for a little bit
    // iterate also clears statcache
    System_Daemon::iterate(2);
}

// Shut down the daemon nicely
// This is ignored if the class is actually running in the foreground
System_Daemon::stop();