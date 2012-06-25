<?php

class Beardcat {

    private $url;
    private static $cache;

    public function __construct($url)
    {
        $this->url = $url;
        $this->cache = unserialize(file_get_contents(ROOT . DS . 'beardcat/beardcat-cache'));
    }

    public function go()
    {
        if ($this->url == '') die();

        $md_file = $this->url == '' ? 'md' : ($this->is_page() ? $this->get_page() : ($this->is_post() ? $this->get_post() : $this->throw_404()));

        $this->render($md_file);
    }

    private function render($md_file, $status = 200)
    {
        $md = Markdown(file_get_contents($md_file));

        switch ($status) {
            case 404:
                break;
            case 200:
            default:
                echo $this->embed_in_template($md);
                break;
        }
    }

    private function embed_in_template($md)
    {
        $template = file_get_contents('../templates/view.php');

        $template = str_replace('{{ CONTENT }}', $md, $template);

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
        die("404");
    }

    public function debug_cache()
    {
        echo '<pre>';
        print_r($this->cache);
        echo '</pre><hr />';
    }
}