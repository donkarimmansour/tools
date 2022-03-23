<?php require_once "../../includes/function/connect.php";
require_once "../../includes/function/function.php";

set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$do = $_POST["ri_do"];


if($do == "add"){

    $ri_name = isset($_POST["ri_name"]) ? filter_var($_POST["ri_name"], FILTER_SANITIZE_STRING) : "";
    $ri_description = isset($_POST["ri_description"])  ? filter_var($_POST["ri_description"], FILTER_SANITIZE_STRING) : "empty" ;

if (empty($ri_name) && $ri_name == "") {
    echo "Please enter a valid name." ; return ;
} else {

        $stmt = $db->prepare("INSERT INTO repeaters (name , description ) VALUES (?,?)");
        $stmt->execute(array($ri_name , $ri_description));
        if($stmt && ($stmt->rowCount()>0)) {
            echo "xxx success" ; echo $stmt->rowCount() ; return ;

        }else{
            echo "Somthing Went wrong Please Try Again" ; return ;

        }
    } 
}



else if ($do == "edit"){

$ri_id =  isset($_POST["ri_id"]) ? filter_var($_POST["ri_id"], FILTER_SANITIZE_NUMBER_INT) : -1 ;
$ri_name = isset($_POST["ri_name"]) ? filter_var($_POST["ri_name"], FILTER_SANITIZE_STRING) : "";
$ri_description = isset($_POST["ri_description"])  ? filter_var($_POST["ri_description"], FILTER_SANITIZE_STRING) : "empty" ;

if (empty($ri_name) && $ri_name == "") {
    echo "Please enter a valid name." ; return ;
}else if ($ri_id <= 0) {
    echo "Somthing Went wrong Please Try Again" ; return ;
} else {
    $count = checkItems("repeaters", "id", $ri_id);
    if ($count > 0) {

            $stmt = $db->prepare("UPDATE repeaters SET name = ? , description = ? WHERE id = ?");
            $stmt->execute(array($ri_name , $ri_description , $ri_id));
            if($stmt) {
                echo "xxx success" ; echo $stmt->rowCount() ; return ;

            }else{
                echo "Somthing Went wrong Please Try Again" ; return ;

            }
        }else{
            echo "Somthing Went wrong Please Try Again" ; return ;

        }
        
    } 

}

else if ($do == "delete"){
    $ri_id =  isset($_POST["ri_id"]) ? filter_var($_POST["ri_id"], FILTER_SANITIZE_NUMBER_INT) : 0 ;
    $type =  $_POST["type"] ;

     if ($ri_id == 0) {
        echo "Somthing Went wrong Please Try Again" . $ri_id ; return ;
    } else {

        $count = checkItems("{$type}", "id", $ri_id);
        if ($count > 0) {

            $stmt = $db->prepare("DELETE FROM {$type} WHERE id = :id ");
            $stmt->bindparam("id", $ri_id);
            $stmt->execute();

            if($stmt) {
                echo "xxx success" ; return ;
    
            }else{
                echo "Somthing Went wrong Please Try Again" ; return ;
    
            }
         }
        }
    
}

else if ($do == "duplicate"){
    $ri_id =  isset($_POST["ri_id"]) ? filter_var($_POST["ri_id"], FILTER_SANITIZE_NUMBER_INT) : 0 ;
    $type =  $_POST["type"] ;

     if ($ri_id == 0) {
        echo "Somthing Went wrong Please Try Again" . $ri_id ; return ;
    } else {

        $count = checkItems("{$type}", "id", $ri_id);
        if ($count > 0) {
            $stmt;

            if($type == "repeaters"){
                $stmt = $db->prepare("INSERT INTO {$type} (name , description) SELECT name , description  FROM {$type} WHERE id = :id");

            }
            else if($type == "requests"){
                $stmt = $db->prepare("INSERT INTO {$type} (`status`, `source_type`, `type`, `source`, `method`, `url`, `nname`, `query`, `time`, `header`, `gheader`, `cheader`, `location`, `cookies`, `pear`, `hos`, `timeout`, `repeater`, `date`) SELECT `status`, `source_type`, `type`, `source`, `method`, `url`, `nname`, `query`, `time`, `header`, `gheader`, `cheader`, `location`, `cookies`, `pear`, `hos`, `timeout`, `repeater`, `date`  FROM {$type} WHERE id = :id");

            }
            else if($type == "parses"){
                $stmt = $db->prepare("INSERT INTO {$type} (`type`, `source`, `source_type`, `status`, `mode`, `name`, `nname`, `lstr`, `rstr`, `iindex`, `repeater`, `date`) SELECT `type`, `source`, `source_type`, `status`, `mode`, `name`, `nname`, `lstr`, `rstr`, `iindex`, `repeater`, `date`  FROM {$type} WHERE id = :id");

            }
            $stmt->bindparam("id", $ri_id);
            $stmt->execute();

            if($stmt) {
                echo "xxx success" ; echo $stmt->rowCount() ; return ;
    
            }else{
                echo "Somthing Went wrong Please Try Again" ; return ;
    
            }
         }
        }
    
}

else if ($do == "repeater"){
 
 $data = json_decode($_POST["data"], true)["myNewDb"];

if ($data["type"] == "request") {

    $cheader = $data["cheader"] ;
    $gheader = $data["gheader"] ;
    $location = $data["location"] ;
    $cookies = $data["cookies"] ;
    $pear = $data["pear"] ;
    $hos = $data["hos"] ;
    $timeout = $data["timeout"] ;
    $out = $data["time"] ;
    $header = $data["header"] ;
    $method = $data["method"] ;
    $url = $data["url"] ;
    $query = $data["query"] ;
    $nname = $data["nname"] ;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        if ($timeout == "on") {
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, $out);
        }
        if ($cheader == "on") {
            $headers = explode("\n", $header);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($gheader == "on") {
            curl_setopt($ch, CURLOPT_HEADER, 1);
        } 
        if ($location == "on") {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        }
        if ($pear == "on") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        }
        if ($hos == "on") {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        }
        if ($cookies == "on") {
            curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd() . '/cookie.txt');
            curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd() . '/cookie.txt');
        }
       


    if ($method == "post") {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    }


    $result = curl_exec($ch);

    if (curl_error($ch)) {
        echo "</myError>" . curl_error($ch);
    } else {
        echo "</myCode>" . $result;
    }
}


  
}
else if ($do == "getData"){
    $id =  isset($_POST["id"]) ? filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT) : 0 ;
    $type =  isset($_POST["type"]) ? filter_var($_POST["type"], FILTER_SANITIZE_STRING) : "empty" ;

     if ($id == 0) {
        echo "Somthing Went wrong Please Try Again" ; return ;
    } else {

        $count = checkItems("{$type}s", "id");
        if ($count > 0) {
                 $get = getItem("{$type}s", "id", $id);

                if (!empty($get)) {

                  echo json_encode(array("myNewDb" => $get)) ; return ;
            
                }else{
                    echo "Somthing Went wrong Please Try Again" ; return ;

                }
         }else{
            echo "Somthing Went wrong Please Try Again" ; return ;

        }
    }
    
}

else if ($do == "xxxx"){

  
}






}








//  $data = json_decode($_POST["data"], true);

// if($data["mode"] == "request"){

//   $result =  request(["use"] , ["url"] , ["method"] ,
//      ["header"] , ["query"] , ["timeout"]);

//     echo $result ;

// }


