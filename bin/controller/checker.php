<?php
set_time_limit(0); 
 //error_reporting(0);
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

function reConnect($bin){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://lookup.binlist.net/{$bin}");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);

    if(curl_error($ch))
    {
        $status = "failed" ;
        $data = curl_error($ch) ;
    }
    else
    {      
        if($result != null && $result != "" && substr($result , 0 , 1) == "{"){

                $status = "success" ;
                $data = $result ;

            }else {
                $status = "failed" ;
                $data = $result ;
            }
    }

    if(strpos($result , "429 Too Many Requests") > -1 ) reConnect($bin);
    else echo  json_encode(array("status" => $status , "data" => $data) , JSON_UNESCAPED_UNICODE);
    
}

$bin = trim($_POST['bin']) ;
reConnect($bin);
 }