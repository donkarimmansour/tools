<?php

set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function extract_emails_from($string){
        preg_match_all("/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i", $string, $matches);
        return $matches[0];
    }

        $text = $_POST["text"];
        $separator = $_POST["separator"];
        $emails = extract_emails_from($text);
        $trimmed = (implode("{$separator}" , $emails));

        //  $new = array_unique(explode("{$Delimiter}", $trimmed));
        //  $newemail = implode("{$Delimiter}",$new);
         echo $trimmed ;


} // post 



?>