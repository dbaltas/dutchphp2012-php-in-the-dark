#!/usr/bin/php
<?php

/**
 * Showing the php getopt() function in console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/02-basic-getopt.php
 */

// Define short options
$shortopts = "";
$shortopts.= "hv";  // No values
$shortopts.= "u:";  // Required value
$shortopts.= "p::"; // Optional value

// Define long options
$longopts  = array(
    "user:",       // Required value
    "password::",  // Optional value
    "help",        // No value
    "verbose",     // No value
);

// Get the options (5.3 style)
$options = getopt(
    $shortopts,
    $longopts
);

// Show it
echo PHP_EOL;
print_r($options);
echo PHP_EOL;
