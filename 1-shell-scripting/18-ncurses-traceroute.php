#!/usr/bin/env php
<?php
// define some key constants. 
define("ESCAPE_KEY", 27);
define("ENTER_KEY", 13);

// get our initial data 
exec("cat traceroute-amazium.output", $tr_return);

$ncurses_session = ncurses_init();

$main = ncurses_newwin(0, 0, 0, 0); // main window 
ncurses_getmaxyx(&$main, $lines, $columns);
ncurses_border(0, 0, 0, 0, 0, 0, 0, 0);

while (1) {

    // border the main window
    ncurses_attron(NCURSES_A_REVERSE);
    ncurses_mvaddstr(0, 1, "Traceroute example");
    ncurses_attroff(NCURSES_A_REVERSE);

    // create a lower window which is dynamically sized...
    $lower_frame_window = ncurses_newwin(10, $columns - 3, $lines - 11, 1);
    ncurses_wborder($lower_frame_window, 0, 0, 0, 0, 0, 0, 0, 0); // border it
    $lower_main_window = ncurses_newwin(8, $columns - 5, $lines - 10, 2);

    $main_list_window = ncurses_newwin($lines - 12, $columns - 3, 1, 1);
    ncurses_wborder($main_list_window, 0, 0, 0, 0, 0, 0, 0, 0); // border it

    if ($currently_selected == "") {
        $currently_selected = 0;
    }
    for ($a = 0; $a < count($tr_return); $a++) {
        $out = $tr_return[$a];
        if ($currently_selected == intval($a)) {
            ncurses_wattron($main_list_window, NCURSES_A_REVERSE);
            ncurses_mvwaddstr($main_list_window, 1 + $a, 1, $out);
            ncurses_wattroff($main_list_window, NCURSES_A_REVERSE);
        } else {
            ncurses_mvwaddstr($main_list_window, 1 + $a, 1, $out);
        }
    }
    if ($y == ENTER_KEY) {
        $newout = explode(" ", $check_me);
        $rwhois_return = rwhois(trim($newout[3]));
        $a = 0;
        while (list($key, $val) = each($rwhois_return)) {
            ncurses_mvwaddstr($lower_main_window, 1 + $a, 1, $key . " - " . $val);
            $a++;
        }
    } elseif ($y == ESCAPE_KEY) {
        ncurses_end();
        exit;
    }
    ncurses_move(-1, 1); // toss cursor out of sight.
    ncurses_wrefresh($lower_frame_window);
    ncurses_wrefresh($lower_main_window); // show it
    ncurses_wrefresh($main_list_window);

    // wait for user to press a key
    $y = ncurses_getch($lower_main_window);

    // check for the presence of up-arrow and down-arrow keys
    if ($y == NCURSES_KEY_UP) {
        $currently_selected--;
        if ($currently_selected < 0) {
            $currently_selected = 0;
        }
    } elseif ($y == NCURSES_KEY_DOWN) {
        $currently_selected++;
        if ($currently_selected >= count($tr_return)) {
            $currently_selected = count($tr_return) - 1;
        }
    }
}//end main while
// the following are two helper functions for 
// this ncurses example. 
function traceroute($address)
{
    // Using precaptured output since VM prevents traceroute
    exec("cat traceroute-amazium.output");

    //exec("/usr/sbin/traceroute $address", $trreturn);
    return $trreturn;
}

//end function
// reverse whois 
function rwhois($query)
{
    //$fp = fsockopen("rwhois.arin.net", 4321, $errno, $errstr, 30);
    //if (!$fp) {
    //    $ret[] = "$errstr ($errno)\n";
    //} else {
    //    fputs($fp, "$query");
    //    $count = 1;
    //    while (!feof($fp) && $count < 17) {
    //        $back = fgets($fp, 128);
    $file = file_exists("whois/$query") ? "whois/$query" : "whois/default";
    $lines = explode("\n", file_get_contents($file));
    foreach ($lines as $back) { 
        $data = explode(":", $back);
        $ret[$data[1]] = $data[2];
        $count++;
    }//fi
    return $ret;
}

//end function 
