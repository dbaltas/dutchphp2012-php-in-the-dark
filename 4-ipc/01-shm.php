#!/usr/bin/php
<?php

// First we create the memory segment
$key = ftok(__FILE__, 'a');
$shmId = shm_attach($key, 1024, 0666);

// Check if we have a variable in the memory segment
if (!($originalValue = shm_has_var($shmId, 1))) {
    $originalValue = 0;
    shm_put_var($shmId, 1, $originalValue);
}

// Endless loop, if value changed display it, otherwise change it ourselves
while (true) {
    $value = shm_get_var($shmId, 1);
    if ($value != $originalValue) {
        echo "! Found a new value in memory: " . $value . PHP_EOL;         
    }
    // Set a new value
    $originalValue = rand(100, 999);
    shm_put_var($shmId, 1, $originalValue);
    echo "- Setting value in memory to: " . $originalValue . PHP_EOL;

    // random sleep
    sleep(rand(2,3));
}
