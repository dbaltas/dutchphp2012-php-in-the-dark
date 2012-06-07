#!/usr/bin/php
<?php

/**
 * Showing the pear Console_Getopt::getopt() method in console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/03-pear-getopt.php
 */

// Define short options
// No values
$shortopts = "hv";
// Required values => 1 colon
$shortopts.= "u:";
// Optional values => 2 colons
$shortopts.= "p::";

// Define long options
$longopts  = array(
// No values
    "help", "verbose",
// Required values => 1 =
    "user=",
// Optional values => 2 =
    "password==",
);

require_once '../Library/Console/Getopt.php';
$getopt = new Console_Getopt();

// Get the arguments & remove script
$args = $getopt->readPHPArgv();
array_shift($args);

echo PHP_EOL;
// Parse the options
$options = $getopt->getopt2(
    $args, $shortopts, $longopts);
if (PEAR::isError($options)) {
    echo 'Got error: ';
    echo $options->getMessage();
    echo PHP_EOL . PHP_EOL;
} else {
    print_r($options);
}