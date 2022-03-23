<?php require_once "../../includes/function/connect.php";
require_once "../../includes/function/function.php";

set_time_limit(0);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$mode = $_POST["rp_mode"];
$id = $_POST["rp_id"];
$do = $_POST["rp_do"];
$rstr = $_POST["rp_rstr"];
$lstr = $_POST["rp_lstr"];
$index = $_POST["rp_index"];
$name = $_POST["rp_name"]; 
$nname = $_POST["rp_nname"];
$source = $_POST["rp_source"];
$status = $_POST["rp_status"];

if($do == "index"){

if ($mode == "lr" || $mode == "css") {
    if(empty($name) || empty($nname) || empty($lstr) || empty($rstr)){
      echo "Please fill all fields of the mode that you choose" ;
      exit();
    }
}else if ($mode == "json" || $mode == "regex") {
    if(empty($name) ||empty($nname) || empty($rstr)){
        echo "Please fill all fields of the mode that you choose" ;
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
            $source = ($source == "empty") ? array("id" => 0 , "type" => "empty") : json_decode($source , true);


                $stmt = $db->prepare("INSERT INTO `parses` (`type`, `source`, `source_type`, `status`, `mode`, `name`, `nname`, `lstr`, `rstr`, `iindex`, `repeater`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array("parse" , $source["id"] , $source["type"] , $status ,  $mode , $name , $nname , $lstr , $rstr , $index , $id));

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

 }

else if($do = "edit"){


    if ($mode == "lr" || $mode == "css") {
        if(empty($name) || empty($nname) || empty($lstr) || empty($rstr)){
          echo "Please fill all fields of the mode that you choose" ;
          exit();
        }
    }else if ($mode == "json" || $mode == "regex") {
        if(empty($name) ||empty($nname) || empty($rstr)){
            echo "Please fill all fields of the mode that you choose" ;
            exit();
        }
    }
    
    if ($id == 0) {
        echo "Somthing Went wrong Please Try Again";
        return;
    } else {
        $count = checkItems("parses", "id");
        if ($count > 0) {
            $get = getItem("parses", "id", $id);

               if (!empty($get)) {
                $source = ($source == "empty") ? array("id" => 0 , "type" => "empty") : json_decode($source , true);


                    $stmt = $db->prepare("UPDATE `parses` SET `type`=?,`source`=?,`source_type`=?,`status`=?,`mode`=?,`name`=?,`nname`=?,`lstr`=?,`rstr`=?,`iindex`=? WHERE id = ?");
                    $stmt->execute(array("parse" , $source["id"] , $source["type"] , $status ,  $mode , $name , $nname , $lstr , $rstr , $index , $id));

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

}
}






