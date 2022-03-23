<?php
set_time_limit(0); 
 //error_reporting(0);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {

$proxy = trim($_POST['proxy']) ;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_PROXY,$proxy);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
$type = $_POST["type"] ;

if($type == "HTTP") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
if($type == "HTTPS") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTPS);
if($type == "SOCKS4") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
if($type == "SOCKS5") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);

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
            $data = "nothing" ;
        }
}

    echo json_encode(array("status" => $status, "data" => $data), JSON_UNESCAPED_UNICODE);
 }