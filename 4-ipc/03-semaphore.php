#!/usr/bin/php
<?php 

$simAllowed = ($argc > 1) ? (int)$argv[1] : 1;

$SEMKey = "1" ; 

## Get Semaphore id 
$seg = sem_get( $SEMKey, $simAllowed, 0666, -1) ; 

$x = 0;
while ($x++ < 5) {
    echo "Try to acquire ...\n"; 
    sem_acquire($seg); 
    echo "=> semaphore acquired...\n" ; 
    sleep(10);
    sem_release($seg); 
}
