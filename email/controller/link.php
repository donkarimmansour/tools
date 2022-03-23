<?php
header('Access-Control-Allow-Origin: *');
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

       $header = array(
        'method: GET',
        'accept: *',
        'content-type: application/x-www-form-urlencoded',
        'sec-fetch-mode: cors',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36');
        $header = array(
            'method: GET',
            'accept: *',
            'content-type: application/x-www-form-urlencoded',
            'sec-fetch-mode: cors',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.85 Safari/537.36');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $_POST["url"]);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
             $result = curl_exec($ch);
             $links = array() ;
             $href = [] ;

            if(curl_error($ch)){
              $links[0] =  curl_error($ch) ;
              $href = $links[0] ;
            }else{
              $dom = new DOMDocument;
              @$dom->loadHTML($result);
              
              $links = $dom->getElementsByTagName('a');
             
              foreach ($links as $link){
                  array_push($href , $link->getAttribute('href')) ;
              }
            }

            $separator = $_POST["separator"] == "&#13;" ? "\n" : $_POST["separator"] ;
            $trimmed =  (implode("{$separator}" , $href));
            echo  $trimmed ;

} // post 

?>