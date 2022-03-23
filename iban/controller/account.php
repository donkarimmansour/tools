<?php
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $proxy = trim($_GET['proxy']) ;
  $num = trim($_GET['num']) ;
  $code = trim($_GET['code']) ;
  $type = $_GET["type"] ;

        $headers = array(
            "POST /listener.php HTTP/1.1",
            "Host: www.bankaccountchecker.com",
            "Cookie: PHPSESSID=o0ce2ldvqr4fu8ssgn48r6jun6; crisp-client%2Fsession%2F8edfc94a-7473-4f43-b368-bbb95116746d=session_41e6a6df-84b5-4ab6-ae61-6b40ada5f444; crisp-client%2Fsocket%2F8edfc94a-7473-4f43-b368-bbb95116746d=1",
            );
      
      
        $data = array(
          "key" => "guest" ,
          "password" => " guest",
          "type" => "uk",
          "browser_number" => "",
          "browser_working" => "webkit",
          "os" => "nt",
          "os_number" => "10.0",
          "sortcode" => $code ,
          "bankaccount" => $num,
          "institution" => "",
          "branch" => "",
          "fast_payment" => "",
          "bacs_credit" => "",
          "bacs_direct_debit" => "",
          "chaps" => "",
          "cheque" => "",
          "branch_address" => "",
          "phone" => "",
          "institution" => "Available for Registered Users",
          "branch" => "Available for Registered Users",
          "facilities" => "Available for Registered Users",
          "branchDetails" => "Available for Registered Users",
          "branchDetails" => "Available on demand on the subscription page",
        );
      
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://www.bankaccountchecker.com/listener.php");
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt ($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt');
          curl_setopt ($ch, CURLOPT_COOKIEFILE,dirname(__FILE__) . '/cookie.txt');
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($data)));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      
          curl_setopt($ch, CURLOPT_PROXY,$proxy);
          curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
      
      
          if($type == "HTTP") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
          if($type == "HTTPS") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTPS);
          if($type == "SOCKS4") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
          if($type == "SOCKS5") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
      
          $account = curl_exec($ch); 

   

    if(curl_error($ch))
    {
        $status = "error" ;
        $data = curl_error($ch) ;
    }
    else
    {  
        
         if($account != null && $account != "" && substr($account , 0 , 1) == "{"){
            $account = json_decode($account) ;

                $status = "Json" ;
                $data = $account ;
    
            }else {
                $status = "Not Json" ;
                $data = $account ;
            }
    }

    echo json_encode(array("status" => $status , "account" => $code . " : " . $num , "data" => $data), JSON_UNESCAPED_UNICODE);

} // post 


?>