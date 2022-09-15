<?php
require 'simple_html_dom.php';
class Scrap{

    function scraping_generic($url) {
        $return = array();
        $html = file_get_html($url);
        foreach($html->find('a#rasp') as $e) 
            $return[] = ["schedule" => $e->href,
                         "content" => $e->find('text')];

        foreach($html->find('a#rasp_old') as $e)
            $return[] = ["schedule_old" => $e->href,
                        "content" => $e->find('text')];

        $html->clear();
        unset($html);
        http_response_code(200);
        return $return;
    }     
      
}

$new = new Scrap();
$data =  $new->scraping_generic('https://mrk-bsuir.by/ru');

$data = array("data" => $data);
// header('Content-Type: application/json; charset=utf-8');
// header('Access-Control-Allow-Origin: *');

for ($i = 0; $i < count($data['data']); $i++){
    $content = $data['data'][$i]['content'][1]; 
    $content = (array)$content;
    $text = $content['_'][4];
    unset($data['data'][$i]['content'][0]);
    unset($data['data'][$i]['content'][1]);
    $data['data'][$i]['content'] = $text;
}
echo'<pre>';
var_dump($data);
echo'</pre>';
// echo json_encode($data, JSON_UNESCAPED_UNICODE);
