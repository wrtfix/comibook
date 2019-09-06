<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

date_default_timezone_set('UTC');
require 'simplehtmldom/simple_html_dom.php';
require_once dirname(__FILE__) . '/simplehtmldom/simple_html_dom.php';


class SimpleHTMLDOM{

    function __construct() {

    }
    
    public function getTitelUrlContentFromUrl($url,$titulo,$utl){
        // Create DOM from URL
        $html = file_get_html($url);

        // Find all article blocks
        foreach($html->find('article') as $article) {
            $item['title']     = $article->find($titulo, 0)->plaintext;
            $item['url']     = $url.$article->find($utl, 0)->href;
            $articles[] = $item;
        }

        return $articles;
    }
    
    public function getContetFromUrl($url, $body, $resumen, $contenido){
        // Create DOM from URL
        $html = file_get_html($url);

        // Find all article blocks
        foreach($html->find($body) as $article) {
            $item['description']     = $article->find($resumen, 0)->plaintext;
            $item['content']     = $article->find($contenido, 0)->plaintext;
            $articles[] = $item;
        }

        return $articles;
    }
    
    
    
}