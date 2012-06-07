#!/usr/bin/php
<?php

/**
 * Use of autocomplete with readline in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/09-readline-autocomplete.php
 */

/**
 * Callback function to do auto completion with readline
 *
 * @param string $string text typed so far
 * @param string $index
 * @return string
 */
function readlineCompletion($string, $index)
{
    // words available for auto completion
    return array(
        'history',
        'quit',
        'exit',
        'clear',
        'clean',
        'cls'
    );
}

// Define the function used for auto completion
readline_completion_function('readlineCompletion');

// Readline with auto-complete functionality
$line = readline("Command: ");