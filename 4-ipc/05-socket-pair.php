#!/usr/bin/php
<?php

$sockets = array();
$msgParent = 'Message From Parent.';
$msgChild = 'Message From Child.';

if (socket_create_pair(AF_UNIX, SOCK_STREAM, 0, $sockets) === false) {
    echo "socket_create_pair() failed. Reason: " . socket_strerror(socket_last_error());
}

$pid = pcntl_fork();
if ($pid == -1) {
    echo 'Could not fork Process.';
} elseif ($pid) { // Parent
    socket_close($sockets[0]);
    echo "[" . getmypid() . "] SENDING : " . $msgParent . PHP_EOL;
    if (socket_write($sockets[1], $msgParent, strlen($msgParent)) === false) {
        echo "socket_write() failed. Reason: ".socket_strerror(socket_last_error($sockets));
    }
    if ($message = socket_read($sockets[1], 1024, PHP_BINARY_READ)) {
        echo "[" . getmypid() . "] RECEIVED : " . $message . PHP_EOL;
    }
    socket_close($sockets[1]);
} else { // Child
    socket_close($sockets[1]);
    echo "[" . getmypid() . "] SENDING : " . $msgChild . PHP_EOL;
    if (socket_write($sockets[0], $msgChild, strlen($msgChild)) === false) {                                          
        echo "socket_write() failed. Reason: ".socket_strerror(socket_last_error($sockets));
    }
    if ($message = socket_read($sockets[0], 1024, PHP_BINARY_READ)) {
        echo "[" . getmypid() . "] RECEIVED : " . $message . PHP_EOL;
    }
    socket_close($sockets[0]);
}
