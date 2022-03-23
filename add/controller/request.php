<?php require_once "../../includes/function/connect.php";
require_once "../../includes/function/function.php";
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


$cheader = isset($_POST["cheader"]) ? $_POST["cheader"] : "off" ;
$gheader = isset($_POST["gheader"]) ? $_POST["gheader"] : "off" ;
$location = isset($_POST["location"]) ? $_POST["location"] : "off" ;
$cookies = isset($_POST["cookies"]) ? $_POST["cookies"] : "off" ;
$pear = isset($_POST["pear"]) ? $_POST["pear"] : "off" ;
$hos = isset($_POST["hos"]) ? $_POST["cheader"] : "off" ;
$timeout = isset($_POST["timeout"]) ? $_POST["timeout"] : "off" ;


$id = $_POST["rr_id"];
$out = $_POST["rr_out"];
$header = $_POST["rr_header"];
$method = $_POST["rr_method"];
$url = $_POST["rr_url"];
$query = $_POST["rr_query"];
$do = $_POST["rr_do"];
$nname = $_POST["rr_nname"];
$status = $_POST["rr_status"];

if ($do == "rr_test") {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method == "post") {
            if (empty($url) || empty($nname) || empty($query)) {
                echo "Please fill all fields of the mode that you choose";
                exit();
            }
        } else if ($method == "get") {
            if (empty($url) || empty($nname)) {
                echo "Please fill all fields of the mode that you choose";
                exit();
            }
        }


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



if ($do == "rr_add") {
   

    if ($method == "post") {
        if (empty($url) || empty($nname) || empty($query)) {
            echo "Please fill all fields of the mode that you choose"; 
            exit();
        }
    } else if ($method == "get") {
        if (empty($url) || empty($nname)) {
            echo "Please fill all fields of the mode that you choose"; 
            exit();
        }
    }
        if ($id == 0) {
            echo "Somthing Went wrong Please Try Again";
            return;
        } else {
            $count = checkItems("repeaters", "id");
            if ($count > 0) {
                $get = getItem("repeaters", "id", $id);

                   if (!empty($get)) {

                        $stmt = $db->prepare("INSERT INTO `requests` (`status`, `type`, `method`, `url`, `nname`, `query`, `time`, `header`, `gheader`, `cheader`, `location`, `cookies`, `pear`, `hos`, `timeout`, `repeater`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)");
                        $stmt->execute(array($status ,'request' , $method , $url , $nname , $query , $out , $header , $gheader , $cheader , $location , $cookies , $pear , $hos , $timeout , $id));

                        if($stmt && ($stmt->rowCount()>0)) {
                            echo "xxx success" ;  return ;
                
                        }else{
                            echo "Somthing Went wrong Please Try Again" ; return ;
                        }
                    }else{
                        echo "Somthing Went wrong Please Try Again" ; return ;
                    }

            
                    } else {
                        echo "Somthing Went wrong Please Try Again";
                        return;
                    }

            }//else

 }//if


 

else if ($do == "rr_edit") {

    

    if ($method == "post") {
        if (empty($url) || empty($nname) || empty($query)) {
            echo "Please fill all fields of the mode that you choose"; 
            exit();
        }
    } else if ($method == "get") {
        if (empty($url) || empty($nname)) {
            echo "Please fill all fields of the mode that you choose"; 
            exit();
        }
    }
   // $key = isset($_POST["rr_key"]) ? $_POST["rr_key"] : "" ;

    if ($id == 0) {
        echo "Somthing Went wrong Please Try Again";
        return;
    } else {
        $count = checkItems("requests", "id");
        if ($count > 0) {
            $get = getItem("requests", "id", $id);

               if (!empty($get)) {
        
                    $stmt = $db->prepare("UPDATE `requests` SET `status` = ?, `type` = ?, `method` = ?, `url` = ?, `nname` = ?, `query` = ?, `time` = ?, `header` = ?, `gheader` = ?, `cheader` = ?, `location` = ?, `cookies` = ?, `pear` = ?, `hos` = ?, `timeout` = ? WHERE id = ?");
                    $stmt->execute(array($status ,'request', $method , $url , $nname , $query , $out , $header , $gheader , $cheader , $location , $cookies , $pear , $hos , $timeout , $id));

                    if($stmt) {
                        echo "xxx success" ;  return ;
            
                    }else{
                        echo "Somthing Went wrong Please Try Again" ; return ;
                    }
                }else{
                    echo "Somthing Went wrong Please Try Again" ; return ;
                }

        
                } else {
                    echo "Somthing Went wrong Please Try Again";
                    return;
                }

        }//else

 }//if


}