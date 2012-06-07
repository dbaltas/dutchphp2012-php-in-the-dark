#!/usr/bin/php
<?php
/**
 * Ncurses example : hello world!
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-layout
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/08-ncurses-windows.php
 */

// initialize ncurses
ncurses_init();

// Check if color is supported, if so define our color pair
//if (ncurses_has_colors()) {
//    ncurses_start_color();
//    ncurses_init_pair(1, NCURSES_COLOR_YELLOW, NCURSES_COLOR_BLUE);
//    ncurses_color_set(1); // set color pair 1 as current
//}

// create a new, fullscreen window + capture window width and height
ncurses_getmaxyx(STDSCR, &$winheight, &$winwidth);
$fullscreen = ncurses_newwin(0, 0, 0, 0); 
ncurses_border(0, 0, 0, 0, 0, 0, 0, 0);
ncurses_refresh();


// create a new, smaller window in the middle of the page
$width = 30; $height = 9;
$x = ($winwidth - $width) / 2;
$y = ($winheight - $height) / 2;
$popup = ncurses_newwin($height, $width, $y, $x);
ncurses_wborder($popup, 0, 0, 0, 0, 0, 0, 0, 0);

// move into the small window and write a string
$txt = 'Hello World!';
$txtlen = strlen($txt);
ncurses_mvwaddstr($popup, ($height - 1) / 2 - 1, ($width - $txtlen) / 2, $txt);
$txt = '(press any key)';
$txtlen = strlen($txt);
ncurses_mvwaddstr($popup, ($height - 1) / 2 + 1, ($width - $txtlen) / 2, $txt);
ncurses_wrefresh($popup);

$pressed = ncurses_getch();// wait for a user keypress
//
//
// Create a window and capture the max x and y for screen width and height
//$text = 'Hello world!';
//ncurses_mvaddstr(round($height / 2), round(($width - strlen($text)) / 2), $text);

// Flush the output to the screen
//ncurses_refresh();

// Sleep 5 secs before the screen is wiped
ncurses_end();
echo "$winheight x $winwidth | $height x $width | ($y, $x)" . PHP_EOL;