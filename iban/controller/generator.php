<?php

set_time_limit(0);

function getStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = array("country" => $_POST["country"] , "submit" => "" ) ;
  $ch1 = curl_init();
  curl_setopt($ch1, CURLOPT_URL, 'https://fungenerators.com/random/iban');
  curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch1, CURLOPT_POST, 1);
  curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($data));
  $iban = curl_exec($ch1); 
  
  if(curl_error($ch1)){
    echo curl_error($ch1)  ;

  }else{
    $iban = getStr($iban, '<h2 class="wow fadeInUp head-room animated"  data-wow-delay=".6s">', '</h2>');

     echo $iban  ;

  }

} // post 



?>