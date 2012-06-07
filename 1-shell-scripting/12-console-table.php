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
 * @link https://github.com/Amazium/PHP-In-The-Dark/blob/master/2-Layout/03-console-table.php
 */

require 'Console/Table.php';

$tbl = new Console_Table();
$tbl->setHeaders(
    array('Language', 'Year')
);
$tbl->addRow(array('PHP', 1994));
$tbl->addRow(array('C',   1970));
$tbl->addRow(array('C++', 1983));

$data = array(
    array('MySQL', 1994),
    array('CouchDB', 2005),
    array('Oracle', 1978)
);
$tbl->addData($data, 0, 3);

echo $tbl->getTable() . PHP_EOL;