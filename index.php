<?php
require 'simple_html_dom.php';
class Scrap{

    function scraping_generic($url, $search) {
        $return = array();
        $html = file_get_html($url);
        foreach($html->find('a#rasp') as $e) 
            $return[] = ["schedule" => $e->href];

        foreach($html->find('a#rasp_old') as $e)
            $return[] = ["schedule_old" => $e->href];

        $html->clear();
        unset($html);
        http_response_code(200);
        return $return;
    }     
      
}

$new = new Scrap();
$data =  $new->scraping_generic('https://mrk-bsuir.by/ru', '#rasp[href]');
$data = array("data" => $data);
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
echo json_encode($data);
