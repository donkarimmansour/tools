<?php
ob_start();
session_start();

set_time_limit(0);

$function = $_POST["function"];
$first = $_POST["first"];
$second = $_POST["second"];
$three = $_POST["three"];
$name = $_POST["name"];
$nname = $_POST["nname"];

// if ($mode == "lr" || $mode == "css") {
//     if(empty($name) || empty($nname) || empty($lstr) || empty($rstr)){
//       echo "Please fill all fields of the mode that you choose" ;
//       exit();
//     }
// }else if ($mode == "json" || $mode == "regex") {
//     if(empty($name) ||empty($nname) || empty($rstr)){
//         echo "Please fill all fields of the mode that you choose" ;
//         exit();
//     }
// }

$data = array("mode" => "function", "data" => array(
    "function" => $function, "name" => $name,"nname" => $nname, "first" => $first, "second" => $second, "three" => $three
));

$newData = array();
if (isset($_SESSION["data"])) {
    $newData = json_decode($_SESSION["data"], true);

    array_push($newData, $data);
} else {
    array_push($newData, $data);
}
// session_destroy();

$_SESSION["data"] = json_encode($newData, JSON_UNESCAPED_UNICODE);
//$data = $_SESSION["data"];
//echo  $data;
