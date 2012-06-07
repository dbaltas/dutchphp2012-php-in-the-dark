#!/usr/bin/php
<?php

/**
 * Basic PHP input in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-shell-scripting/01-basic-input.php
 */

echo PHP_EOL;

// Number of arguments
echo '$_SERVER["argc"] = ';
echo $_SERVER['argc'] . PHP_EOL;

// Array of arguments
echo '$_SERVER["argv"] = ';
print_r($_SERVER['argv']);

echo PHP_EOL;
