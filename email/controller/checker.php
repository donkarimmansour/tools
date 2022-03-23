<?php

set_time_limit(0);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function x_check($email)
    {
        $exp = "/^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/";
        if (preg_match($exp, $email)) {
            $domin = explode("@", $email)[1];
            if (checkdnsrr($domin , "MX")) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

        $email = x_check(trim($_POST["email"])) ? "Status : okey" : "Status : error";

        echo $email ;


} // post 



?>