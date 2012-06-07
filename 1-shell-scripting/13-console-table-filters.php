#!/usr/bin/php
<?php
/**
 * Pear Console Table example
 * http://pear.php.net/package/Console_Table
 *
 * Part of my conference talk and blog series PHP in the Dark
 *
 * @author Jeroen Keppens
 * @link http://www.amazium.com/blog/php-in-the-dark-layout
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/04-console-table-filters.php
 */

// Call back function
function checkNA($value) {
    $value = trim($value);
    if (empty($value) || $value == '?') {
        return 'N/A';
    }
    return $value;
}

// Create a new table and define the headers
require '../Library/Console/Table.php';
$tbl = new Console_Table();
$tbl->setHeaders(
    array('Title', 'Author', 'Published')
);

// Add the filter to the second and third column
$func = 'checkNA';
$tbl->addFilter(1, $func);
$tbl->addFilter(2, $func);

// Add the data
$data = array(
    array('Ghosts', '?', 1981),
    array('Origins', 'S. Ome D. Ude', ''),
    array('My Book', 'Jeroen', 2050)
);
$tbl->addData($data);

// Print the table
echo $tbl->getTable() . PHP_EOL;