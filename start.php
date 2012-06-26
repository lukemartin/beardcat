<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once ROOT . DS . 'beardcat/beardcat-config.php';
require_once ROOT . DS . 'beardcat/beardcat.php';
require_once ROOT . DS . 'utils/markdown.php';

$bc = new Beardcat($url);

$bc->debug_cache();
$bc->go();



/*
$array = array();
$array['posts'] = array();

$array['posts']['some-website'] = array(
    'path' => '../markdown/md.md',
    'date' => '2012-12-12 00:08:12'
);
$array['posts']['some-older-website'] = array(
    'path' => '../markdown/md.md',
    'date' => '2011-12-12 00:08:12'
);
$array['posts']['some-older-website-2'] = array(
    'path' => '../markdown/md.md',
    'date' => '2012-12-12 00:08:11'
);

echo '<pre>';
print_r($array);
echo '</pre>';


function sortByOrder($a, $b) {
    return $b['date'] > $a['date'];
}

uasort($array['posts'], 'sortByOrder');
echo '<pre>';
print_r($array);
echo '</pre>';


die();
*/