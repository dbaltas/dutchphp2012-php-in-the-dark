#!/usr/bin/php
<?php

// First we create the memory segment
$key = ftok(__FILE__, 'a');
$shmopId = shmop_open($key, "c", 0666, 1024);

// Endless loop, if value changed display it, otherwise change it ourselves
$originalValue = 0;
while (true) {
    $value = (int)shmop_read($shmopId, 0, 3);
    if ($value != $originalValue) {
        echo "! Found a new value in memory: " . $value . PHP_EOL;         
    }
    // Set a new value
    $originalValue = (int)rand(100, 999);
    shmop_write($shmopId, $originalValue, 0);
    echo "- Setting value in memory to: " . $originalValue . PHP_EOL;

    // random sleep
    sleep(rand(2,3));
}
