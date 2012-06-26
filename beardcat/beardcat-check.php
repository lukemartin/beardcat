<?php

require_once 'beardcat-config.php';

$paths           = array();
$paths['drafts'] = array();
$paths['pages']  = array();
$paths['posts']  = array();
$paths['media']  = array();

$it = new RecursiveDirectoryIterator('../markdown');

foreach (new RecursiveIteratorIterator ($it) as $file) {
    preg_match('/([a-zA-Z0-9\/\.\_\-]+)\.md/', $file, $matches);

    if ($matches) {
        if (strpos($matches[1], 'markdown/pages/') !== false) {
            $paths['pages'][PAGE_PREFIX . str_replace('../markdown/pages/', '', $matches[1] . '/')] = $matches[0];
        }

        if (strpos($matches[1], 'markdown/posts/') !== false) {
            $slug = explode('/', $matches[1]);
            $slug = $slug[count($slug) - 1];

            $paths['posts'][POST_PREFIX . $slug . '/'] = $matches[0];
        }
    }

}
print_r($paths);

file_put_contents('beardcat-cache', serialize($paths));