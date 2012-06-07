#!/usr/bin/php
<?php

/**
 * Using custom file descriptors in Console scripts
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-input-output
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/1-Input-Output/06-replacing-file-descriptors.php
 */

// log file to write to
$logfile = '/tmp/some-log-file.log';
$errfile = '/tmp/some-error-file.log';

// Close standard I/O descriptors
fclose(STDOUT);
fclose(STDERR);

// first 3 descriptors fill up the blanks
$fdOUT = fopen($logfile, 'a');
$fdERR = fopen($errfile, 'a');
//$fdERR = fopen('php://stdout', 'a');

// STDOUT writes to $logfile
// STDERR writes to STDOUT, so also to $logfile

echo "Writing something\n";
fwrite(STDERR, "hello error string\n"); 
