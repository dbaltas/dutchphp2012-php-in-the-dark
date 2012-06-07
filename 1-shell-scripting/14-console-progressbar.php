#!/usr/bin/php 
<?php
/**
 * Pear Console Progressbar example
 * http://pear.php.net/package/Console_ProgressBar
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 */

require '../Library/Console/ProgressBar.php';

echo PHP_EOL;

$format = '[%bar%] %percent% (%current%/%max%) ';
$filler = '*>';
$empty  = '0';
$width  = 70;
$size   = 125;
$bar = new Console_ProgressBar($format, $filler, $empty, $width, $size);

for ($i = 0; $i <= $size; $i++) {
    $bar->update($i);
    sleep(1);
}

echo PHP_EOL . PHP_EOL;
