#!/usr/bin/php
<?php

// Definitions
define('MSG_WORK', 1);
define('MSG_STATUS', 2);

$queueKey = ftok(dirname(__FILE__) . '/06-parallel-example.php', 'a');
$queueId = msg_get_queue($queueKey);
for ($i = 0; $i < 1000; $i++) {
    msg_send($queueId, MSG_WORK, rand(100000, 200000), false);
}
