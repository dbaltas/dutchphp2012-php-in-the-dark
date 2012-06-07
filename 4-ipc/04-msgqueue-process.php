#!/usr/bin/php
<?php

define('MSG_WORK', 1);
define('MSG_STATUS', 2);

// First we get the message queue
$key = ftok(dirname(__FILE__) . '/04-msgqueue-master.php', 'a');
$queueId = msg_get_queue($key);

while (true) {
    // See if we got an item to be processed
    if (msg_receive($queueId, MSG_WORK, $msgType, 
                    32, $message, false, 0, $error)) 
    {
        echo "Processing $message" . PHP_EOL;
        sleep(rand(1,2));
        $pid = getmypid();
        msg_send($queueId, MSG_STATUS, "[$pid] <$message> done", false);
    } else {
        echo "Received [$error] fetching message\n";
    }
}
