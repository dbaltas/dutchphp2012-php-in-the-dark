#!/usr/bin/php
<?php
/**
 * Pear Color example
 * http://pear.php.net/package/Console_Color
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-layout
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/01-console-color.php
 */

// Console_Color is old and has some issues with static methods
error_reporting(0);

require_once '../Library/Console/Color.php';

// color reset sequence, for later use
$reset = Console_Color::convert('%n');

// %r = RED
echo Console_Color::convert('Ratio %r0-30%%%n (low)') . PHP_EOL;

// get YELLOW
$yellow = Console_Color::fgcolor('yellow');
echo 'Ratio ' . $yellow . '31-70% ' . $reset . ' (average)' . PHP_EOL;

// %G = BOLD GREEN
echo Console_Color::convert('Ratio %G71-100%%%n (high)') . PHP_EOL;

// CYAN background, RED text, underlined
$style   = Console_Color::color('red', 'underline', 'cyan');
echo $style . ' DONE? ' . $reset . PHP_EOL;


// BLACK background, CYAN text, underlined
$redbg   = Console_Color::bgcolor('red');
$cyantxt = Console_Color::fgcolor('cyan');
$underline = Console_Color::style('underline');
echo $redbg . $cyantxt . $underline . ' YES! ' . $reset . PHP_EOL;