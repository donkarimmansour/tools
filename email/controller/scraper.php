<?php

set_time_limit(0);

$success = 0;
$fail = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function extract_emails_from($string){
        preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $string, $matches);
        return $matches[0];
    }

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
                 $emails = [] ;
    
                if(curl_error($ch)){
                  $emails[0] =  curl_error($ch) ;
                }else{

                   array_push($emails , extract_emails_from($result));
                }
    
                $separator = $_POST["separator"] == "&#13;" ? "\n" : $_POST["separator"] ;
                $trimmed =  (implode("{$separator}" , $emails[0]));
                echo  $trimmed ;

} // post 



?>