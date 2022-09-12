<?php
require 'simple_html_dom.php';
class Api{

    function scraping_generic($url, $search) {
        $return = false;
        $html = file_get_html($url);
        foreach($html->find('a#rasp') as $e) 
            $return = $e->href . '<br>';
        $html->clear();
        unset($html);
        http_response_code(200);
        return $return;
    }
    
        
      
}

$new = new Api();
echo $new->scraping_generic('https://mrk-bsuir.by/ru', '#rasp[href]');