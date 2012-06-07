#!/usr/bin/php
<?php

/**
 * Use of history with readline in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/08-readline-history.php
 */

// If we have a history file, read it in; otherwise blank history
$historyFile = './readline.hist';
if (is_file($historyFile)) {
    readline_read_history($historyFile);
}

// Endless loop, keep the commands coming
while (true) {
    $line = strtolower(trim(readline("Command: ")));
    echo 'Received [ ' . $line . ' ]' . PHP_EOL;
    readline_add_history($line); // add command to history
    // check special actions
    switch ($line) { // check special actions
        case 'clear': // clear the history
            readline_clear_history();
            break;
        case 'history': // print out the history
            print_r(readline_list_history());
            break;
        case 'quit': case 'exit': // quit / exit
            break 2;
        default:
            break;
    }
}

readline_write_history($historyFile);