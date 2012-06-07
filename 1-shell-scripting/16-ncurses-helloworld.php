#!/usr/bin/php
<?php
/**
 * Ncurses example : hello world!
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-layout
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/07-ncurses-helloworld.php
 */

// initialize ncurses
ncurses_init();

// Check if color is supported, if so define our color pair
if (ncurses_has_colors()) {
    ncurses_start_color();
    ncurses_init_pair(1, NCURSES_COLOR_YELLOW, NCURSES_COLOR_BLUE);
    ncurses_color_set(1); // set color pair 1 as current
}

// Create a window and capture the max x and y for screen width and height
ncurses_mvaddstr(3, 5, 'Hello World!');

// Flush the output to the screen
ncurses_refresh();

// Sleep 5 secs before the screen is wiped
sleep(5);
ncurses_end();