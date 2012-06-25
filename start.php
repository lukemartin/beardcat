<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once ROOT . DS . 'beardcat/beardcat-config.php';
require_once ROOT . DS . 'beardcat/beardcat.php';
require_once ROOT . DS . 'utils/markdown.php';

$bc = new Beardcat($url);

//$bc->debug_cache();
$bc->go();