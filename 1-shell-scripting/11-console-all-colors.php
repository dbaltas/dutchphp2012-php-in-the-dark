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
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/02-console-all-colors.php
 */

// Console_Color is old and has some issues with static methods
error_reporting(0);

require_once '../Library/Console/Color.php';

echo Console_Color::convert('black:   %knormal%n %Kbold%n %0background%n') . PHP_EOL;
echo Console_Color::convert('red:     %rnormal%n %Rbold%n %1background%n') . PHP_EOL;
echo Console_Color::convert('green:   %gnormal%n %Gbold%n %2background%n') . PHP_EOL;
echo Console_Color::convert('yellow:  %ynormal%n %Ybold%n %3background%n') . PHP_EOL;
echo Console_Color::convert('blue:    %bnormal%n %Bbold%n %4background%n') . PHP_EOL;
echo Console_Color::convert('magento: %mnormal%n %Mbold%n %5background%n') . PHP_EOL;
echo Console_Color::convert('cyan:    %cnormal%n %Cbold%n %6background%n') . PHP_EOL;
echo Console_Color::convert('white:   %wnormal%n %Wbold%n %7background%n') . PHP_EOL;
echo Console_Color::convert('%Fflash%n') . PHP_EOL;
echo Console_Color::convert('%Uunderline%n') . PHP_EOL;
echo Console_Color::convert('%9bold%n') . PHP_EOL;
echo Console_Color::convert('%_bold%n') . PHP_EOL;
echo Console_Color::convert('%8reverse%n') . PHP_EOL;
echo Console_Color::convert('%%') . PHP_EOL;