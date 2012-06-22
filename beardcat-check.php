<?php

$paths           = array();
$paths['drafts'] = array();
$paths['pages']  = array();
$paths['posts']  = array();
$paths['media']  = array();

$it = new RecursiveDirectoryIterator('markdown');

foreach (new RecursiveIteratorIterator ($it) as $file) {
    preg_match('/([a-zA-Z0-9\/\.\_\-]+)\.md/', $file, $matches);

    if ($matches) {
        if (strpos($matches[1], 'markdown/pages/') !== false) {
            $paths['pages'][str_replace('markdown/pages/', '', $matches[1])] = $matches[0];
        }

        if (strpos($matches[1], 'markdown/posts/') !== false) {
            $slug = explode('/', $matches[1]);
            $slug = $slug[count($slug) - 1];

            $paths['posts'][$slug] = $matches[0];
        }
    }

}

file_put_contents('storage/cache/beardcat', (time() + (2628000 * 60)) . serialize($paths));