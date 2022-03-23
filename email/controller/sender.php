<?php
set_time_limit(0);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //  $_SESSION['msg'] = "";

    curl_error
  

    if (!isset($_POST["receiver"]) || trim($_POST["receiver"]) == "") {
        echo "Please enter receiver...";
        //  echo json_encode(array("error" => $error ))  ;
    } elseif (!isset($_POST["host"]) || trim($_POST["host"]) == "") {
        echo "Please enter host...";
        //  echo json_encode(array("error" => $error ))  ;
    } elseif (!isset($_POST["username"]) || trim($_POST["username"]) == "") {
        echo "Please enter username...";
        //  echo json_encode(array("error" => $error ))  ;
    } elseif (!isset($_POST["password"]) || trim($_POST["password"]) == "") {
        echo "Please enter password...";
        //   echo json_encode(array("error" => $error ))  ;
    } elseif (!isset($_POST["port"]) || trim($_POST["port"]) == "") {
        echo "Please enter port...";
        //   echo json_encode(array("error" => $error ))  ;
    }
    //   elseif (trim($_POST["from"])==""){
    //     echo "Please enter from...";
    //    // echo json_encode(array("error" => $error ))  ;
    //   }
    //   elseif (trim($_POST["fromname"]) ==""){
    //     echo "Please enter fromname...";
    //   //  echo json_encode(array("error" => $error ))  ;
    //   }
    elseif (!isset($_POST["Subject"]) || trim($_POST["Subject"]) == "") {
        echo "Please enter Subject...";
        //  echo json_encode(array("error" => $error ))  ;
    }
    //   elseif (trim($_POST["ReplyTo"]) ==""){
    //     $_SESSION['msg'] = "Please enter ReplyTo...";
    //  //   echo json_encode(array("error" => $error ))  ;
    //   }
    elseif (!isset($_POST["Html"]) || trim($_POST["Html"]) == "") {
       echo "Please enter Html...";
        //  echo json_encode(array("error" => $error ))  ;
    } else {



        function x_trim($string)
        {
            return stripslashes(trim($string));
        }

        function setup_letter($letter)
        {
            $letter = x_trim($letter);
            $letter = urlencode($letter);
            //  $letter = preg_replace("%5C%22", "%22", $letter);
            $letter = urldecode($letter);
            $letter = stripslashes($letter);
            return $letter;
        }


        $stmp_Host = x_trim($_POST["host"]);
        $stmp_Username =  x_trim($_POST["username"]);
        $stmp_Password =  x_trim($_POST["password"]);
        $stmp_Port = x_trim($_POST["port"]);
        $stmp_From =   x_trim($_POST["from"]);
        $stmp_FromName =  x_trim($_POST["fromname"]);
        $Subject = x_trim($_POST["Subject"]);
        $stmp_html =   setup_letter($_POST["Html"]);
        $stmp_ReplyTo =   x_trim($_POST["ReplyTo"]);
        $stmp_receiver =   x_trim($_POST["receiver"]);
        $stmp_Secure =   $_POST["Secure"];
        $stmp_encoding =   $_POST["encoding"];
        $stmp_CharSet =   $_POST["CharSet"];
        $stmp_Type =   $_POST["Type"];
        $Attachment =  isset($_FILES["Attachment"]) ? $_FILES["Attachment"] : array("name" => "" , "error" => 10)  ;
        //$stmp_Delimiter =   $_POST["Delimiter"];



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



        require("../../includes/PHPMailer/class.phpmailer.php");
        $mail = new PHPMailer();

        //  $date = date("Y-m-d_H:i:s");

        // if (!is_dir("./results")) {
        //     mkdir("./results", 0755, true);
        // }


       // $result = fopen("./results/" . "result" . ".txt", "a");

      //  $emails = explode("\r\n", $stmp_receiver);

      $mail->CharSet = $stmp_CharSet;
      $mail->IsSMTP();
      $mail->SetLanguage("en");
      $mail->Host = $stmp_Host;
      $mail->SMTPAuth = true;
      $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
      $mail->Username = $stmp_Username;
      $mail->Password = $stmp_Password;
      $mail->SMTPSecure = $stmp_Secure;
      $mail->Port = $stmp_Port;
      $mail->Encoding = $stmp_encoding;
      $mail->SMTPDebug = 1;



    if ($stmp_ReplyTo != "") {
        $mail->AddReplyTo("{$stmp_ReplyTo}");
    }
    if ($stmp_From != "") {
        $mail->From = $stmp_From;
    }
    if ($stmp_FromName != "") {
        $mail->FromName = $stmp_FromName;
    }
    if ($stmp_Type == "html") {
        $mail->IsHTML(true);
    } elseif ($stmp_Type == "plain") {
        $mail->IsHTML(false);
    }

    if ($Attachment['name'] != "" && $Attachment['error'] == 0) {
        $mail->AddAttachment($Attachment['tmp_name'], $Attachment['name']);
    }

    $mail->Subject = $Subject;
    $mail->Body    =  $stmp_html;
    $mail->AltBody = 'Karim Mansour';

      //  $mail->WordWrap = 50;
      $email = $_POST["email"] ;

      
      //  foreach ($emails as $email) {

            if ($email != '') {
                if (!x_check($email)) {
                    $isEmail = "INCORRECT EMAIL";
                    $STATUS = "Not Email";
                     echo "Email : " . $email . " | Check : " . $isEmail . " | Status : " .  $STATUS . "\n" ;

                   // fwrite($result, "Email : " . $email . " | Check : " . $Email . " | Status : " .  $STATUS . "\n");
                } else {
                    $isEmail = "CORRECT EMAIL";



                    $mail->clearReplyTos();
                    $mail->clearAllRecipients();

                    $mail->AddAddress("{$email}");

                    if (!$mail->send()) {
                        if (!$mail->isSendmail()) {

                            if (!$mail->isQmail()) {

                               // $fail++;
                                $STATUS = strtoupper($mail->ErrorInfo);
                               // fwrite($result, "Email : " . $email . " | Check : " . $Email . " | Status : " .  $STATUS . "\n");
                                echo "Email : " . $email . " | Check : " . $isEmail . " | Status : " .  $STATUS . "\n" ;

                            } else {
                              //  $fail++;
                                $STATUS = "qmail";
                                //fwrite($result, "Email : " . $email . " | Check : " . $Email . " | Status : " .  $STATUS . "\n");
                                echo  "Email : " . $email . " | Check : " . $isEmail . " | Status : " .  $STATUS . "\n" ;
                            }
                        } else {
                           // $fail++;
                            $STATUS = "sendmail";
                           // fwrite($result, "Email : " . $email . " | Check : " . $Email . " | Status : " .  $STATUS . "\n");
                            echo  "Email : " . $email . " | Check : " .$isEmail . " | Status : " .  $STATUS . "\n" ;
                        }
                    } else {
                       // $success++;
                        $STATUS = "OKAY";
                        //fwrite($result, "Email : " . $email . " | Check : " . $Email . " | Status : " .  $STATUS . "\n");
                        echo  "Email : " . $email . " | Check : " . $isEmail . " | Status : " .  $STATUS . "\n" ;
                    }
                }//else
            }//if
       
         //   flush();
       // }
       // fclose($result);
    }
} // post 



?>