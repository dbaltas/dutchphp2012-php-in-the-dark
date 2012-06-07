#!/usr/bin/php
<?php
/**
 * Ncurses example : get screen information
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-layout
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/06-ncurses-screeninfo.php
 */

// initialize ncurses
ncurses_init();

// Create a window and capture the max x and y for screen width and height
// STDSCR = resource id of the main ncurses window
ncurses_getmaxyx(STDSCR, &$height, &$width);

// Clean up after yourself
ncurses_end();

// Echo width and height, this needs to be done after the ncurses_end
echo 'Width: ' . $width . PHP_EOL . 'Height: ' . $height . PHP_EOL;