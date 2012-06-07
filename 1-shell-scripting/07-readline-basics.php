#!/usr/bin/php
<?php

/**
 * Basic use of readline in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/05-file-descriptors.php
 */

// Read the name from the command line, using the provided text as prompt.
$name = readline('Please enter your name: ');

// Display "Hello <name>"
echo 'Hello ' . $name . PHP_EOL;