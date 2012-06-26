<?php

class Beardcat {

    private $url;
    private static $cache;

    public function __construct($url)
    {
        $this->url = $url;
        $this->cache = unserialize(file_get_contents(ROOT . DS . 'beardcat/beardcat-cache'));
        arsort($this->cache['posts']);
    }

    public function go()
    {
        $md_file = $this->is_page() ? $this->get_page() : ($this->is_post() ? $this->get_post() : $this->throw_404());

        if ($this->is_post()) {
            preg_match('/(\d{4}\/\d{2}\/\d{2})/', $md_file, $matches);
            $this->date = str_replace('/', '-', $matches[1]);
        }

        $this->render($md_file);
    }

    private function render($md_file, $status = 200)
    {
        $md = file_get_contents($md_file);

        switch ($status) {
            case 404:
                break;
            case 200:
            default:
                echo $this->embed_in_template($md);
                break;
        }
    }

    private function embed_in_template($content)
    {
        $template = file_get_contents('../templates/view.php');

        preg_match('/(#{1} [\S ]+)/', $content, $matches);
        $title = $matches[1];

        $content = str_replace($matches[1], '', $content);

        $template = str_replace('{{ TITLE }}', Markdown($title), $template);
        $template = str_replace('{{ CONTENT }}', Markdown($content), $template);

        $template = str_replace('{{ DATE }}', $this->is_post() ? $this->date : '', $template);

        return $template;
    }

    private function is_page()
    {
        if (isset($this->cache['pages'][$this->url])) {
            return true;
        }
        return false;
    }
    private function get_page()
    {
        return $this->cache['pages'][$this->url];
    }

    private function is_post()
    {
        if (isset($this->cache['posts'][$this->url])) {
            return true;
        }
        return false;
    }
    private function get_post()
    {
        return $this->cache['posts'][$this->url];
    }

    private function throw_404()
    {
        return '../markdown/pages/404.md';
    }

    public function debug_cache()
    {
        echo '<pre>';
        print_r($this->cache);
        echo '</pre><hr />';
    }
}

function sortByOrder($a, $b) {
    return $b['date'] > $a['date'];
}