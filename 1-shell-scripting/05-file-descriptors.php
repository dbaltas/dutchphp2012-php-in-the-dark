#!/usr/bin/php
<?php

/**
 * Use of file descriptors in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/05-file-descriptors.php
 */

// Write out text to the output stream & capture name as input
fwrite(STDOUT, PHP_EOL . 'Please enter your name: ');
$name = trim(fgets(STDIN));

// Display "Hello <name>" to output and "I don't know <name>" to error
fwrite(STDOUT, PHP_EOL . 'Hello ' . $name);
fwrite(STDERR, PHP_EOL . 'I don\'t know ' . $name);

echo PHP_EOL;