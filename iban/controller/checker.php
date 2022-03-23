<?php
set_time_limit(0);

function getStr($n,$string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[$n]);
  return $str[0];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = array(
    "tx_valIBAN_pi1[iban]" => $_POST["iban"] ,
    "tx_valIBAN_pi1[fi]" => "fi" ,
    "no_cache" => "1" ,
    "Action" => "validate IBAN"
  );

    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "https://www.ibancalculator.com/iban_validieren.html");
    curl_setopt($ch1, CURLOPT_HEADER, 0);
    curl_setopt($ch1, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch1, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
    curl_setopt ($ch1, CURLOPT_COOKIEFILE,dirname(__FILE__) . '/cookie.txt');
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, urldecode(http_build_query($data)));
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
    
    // curl_setopt($ch1, CURLOPT_SSLVERSION, 3);
    // curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch1, CURLOPT_SSL_VERIFYSTATUS, false);

    $iban = curl_exec($ch1); 

    if(curl_error($ch1)){
      echo curl_error($ch1)  ;

    }else{

      if($_POST["iban"] != null && $_POST["iban"] != ""){
            //     $length = getStr(1,$iban,'src="plu.gif.pagespeed.ce.bUDgwa48V8.gif" width="16" height="16" alt="+"></td><td><p>' ,'</p>');
            //     $Bankleitzahl = getStr(2,$iban,'src="plu.gif.pagespeed.ce.bUDgwa48V8.gif" width="16" height="16" alt="+"></td><td><p>' ,'</p>');
            //  //   $Account_number = getStr(1,$iban,'src="xmin.gif.pagespeed.ic.NGAFB8nGWx.webp" width="16" height="16" alt="-"></td><td><p>' ,'</p>');
            //     $BAN = getStr(3,$iban,'src="plu.gif.pagespeed.ce.bUDgwa48V8.gif" width="16" height="16" alt="+"></td><td><p>' ,'</p>');
            $status = getStr(1,$iban,'<fieldset><legend>Result</legend><p>' ,'</p>');

            //  stripos($length,"the correct length"  ) > 0? $length = "true" : $length = "false" ;
            //   stripos($Bankleitzahl,"is correct"  ) > 0 ? $Bankleitzahl = "true" : $Bankleitzahl = "false" ;
            //  stripos($BAN,"is correct"  ) > 0 ? $BAN = "true" : $BAN = "false" ;
            stripos($status,"incorrect"  ) > 0 ? $status = "false" : $status = "true ****************" ;



            // echo "{$_POST["iban"]} | length => {$length} | Bankleitzahl => {$Bankleitzahl} |  | IBAN => {$BAN} | status => {$status} |";
            echo "{$_POST["iban"]} | status => {$status}";

      }
  

    }

} // post 




?>