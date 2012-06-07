#!/usr/bin/php
<?php

define('MSG_WORK', 1);
define('MSG_STATUS', 2);

// First we get the message queue
$key = ftok(__FILE__, 'a');
$queueId = msg_get_queue($key);

// We add some IDs to be processed on it
for ($i = 0; $i < 1000; $i++) {
    $id = rand(10000, 20000);
    msg_send($queueId, MSG_WORK, $id, false);
}

// We check if we receive STATUS messages
while (true) {
    if (msg_receive($queueId, MSG_STATUS, $msgType, 
                    32, $message, false, 0, $error)) 
    {
        echo $message . PHP_EOL;
    } else {
        echo "Received [$error] fetching message\n";
    }
}
