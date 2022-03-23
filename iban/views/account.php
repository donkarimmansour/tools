<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    set_time_limit(0);

  $proxy = trim($_POST['proxy']) ;
  $num = trim($_POST['num']) ;
  $code = trim($_POST['code']) ;
  $type = $_POST["type"] ;

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

}else{ // post 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sender</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body style="background-color: green;">

<div class="container mt-3 mb-3">

 
    <div class="card">



        <div class="card-header ">
            <span style="font-weight: bold;">Bank Account Checker </span>

            <div style="text-align:center; display: inline-block;">
                <button type="button" class="btn btn-info m-1">
                    Total <span class="badge badge-light info" id="total">0</span>
                </button>

                <button type="button" class="btn btn-secondary m-1">
                    checked <span class="badge badge-light success" id="checked">0</span>
                </button>

                <button type="button" class="btn btn-success mt-1">
                    Successed <span class="badge badge-light success" id="successed">0</span>
                </button>

                <button type="button" class="btn btn-danger mt-1">
                    Failed <span class="badge badge-light danger" id="failed">0</span>
                </button>

                <button type="button" class="btn btn-warning mt-1">
                    Duplicate <span class="badge badge-light warning" id="duplicated">0</span>
                </button>

                <button type="button" class="btn btn-primary m-1">
                    Proxies Total <span class="badge badge-light info" id="ptotal">0</span>
                </button>

                <button type="button" class="btn btn-dark m-1">
                    Proxies checked <span class="badge badge-light success" id="pchecked">0</span>
                </button>


            </div>

        </div>

        <div class="card-body">

            <form id="form" method="post" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-sm-12 mb-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="separator">Separator</label>
                            <select id="separator" name="separator" class="form-control">
                                <option value="&#13;">New Line</option>
                                <option value="|">|</option>
                                <option value=":">:</option>
                                <option value=";">;</option>
                                <option value=";">;</option>
                                <option value="$">$</option>
                                <option value="*">*</option>
                                <option value="#">#</option>
                                <option value="&">&</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select id="type" name="type" class="form-control">
                                <option value="All">All</option>
                                <option value="HTTP">HTTP</option>
                                <option value="HTTPS">HTTPS</option>
                                <option value="SOCKS5">SOCKS5</option>
                                <option value="SOCKS4">SOCKS4</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="code" class="control-label mb-1 required">Short Code</label>
                            <input type="text" id="code" class="form-control" placeholder="Short Code" />
                            <small id="code_err" class="form-text text-danger d-none">Please enter a valid Short Code.</small>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="list" class="control-label mb-1 required">List</label>
                            <textarea id="list" class="form-control" placeholder="List" rows="6"></textarea>
                            <small id="list_err" class="form-text text-danger d-none">Please Enter List.</small>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="proxies" class="control-label mb-1 required">Enter the proxies</label>
                            <textarea id="proxies" class="form-control" placeholder="Enter the proxies" rows="6"></textarea>
                            <small id="proxies_err" class="form-text text-danger d-none">Please enter valid proxies.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="error" class="control-label mb-1 required">Not Working</label>
                            <textarea id="error" class="form-control" placeholder="Not Working" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1 required">Working</label>
                            <textarea id="okay" class="form-control" placeholder="Working" rows="6"></textarea>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>heck</span>
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="button" id="stop" class="btn btn-lg btn-danger btn-block">
                                    <span>stop</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>

    </div>


</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        var ajaxCall;
        $('#stop').attr('disabled', true);


        //$('#start').click(function() {
        $("#form").submit(function(e) {
            // custom handling here
            e.preventDefault();

            var links = 0;
            var total = 0;
            var checked = 0;
            var Successed = 0;
            var Failed = 0;
            var Duplicated = 0;
            var ptotal = 0;
            var pchecked = 0;
            var l = 0;
            

            if ($("#code").val() == null || $("#code").val().trim() == "") {
                $("#code_err").removeClass("d-none").addClass("d-block")
                return
            } if ($("#proxies").val() == null || $("#proxies").val().trim() == "") {
                $("#proxies_err").removeClass("d-none").addClass("d-block")
                return
            } if ($("#list").val() == null || $("#list").val().trim() == "") {
                $("#list_err").removeClass("d-none").addClass("d-block")
                return
            } else {
                $("#list_err").removeClass("d-block").addClass("d-none")
                $("#code_err").removeClass("d-block").addClass("d-none")
                $("#proxies_err").removeClass("d-block").addClass("d-none")

                var list = $('#list').val().split('\n');
                var proxies = $('#proxies').val().split('\n');
                var total = list.length;
                var ptotal = proxies.length;
                $('#total').html(total);
                $('#ptotal').html(ptotal);
                var i = 0;

                list.forEach(function(value, index) {


                // while ( l < total) {
                    //  l++

                    if ($('#proxies').val() == "") {
                        $('#start').attr('disabled', null);
                        $('#stop').attr('disabled', 'disabled');
                        // audio.play();
                        ajaxCall.abort();
                    }
                     
                    ajaxCall = $.ajax({
                        type: 'POST',
                        data: `num=${list[l]}&code=${$('#code').val()}&proxy=${proxies[i]}&type=${$('#type').val()}`,
                        async: true ,

                        beforeSend: function() {
                            $('#stop').attr('disabled', null);
                            $('#start').attr('disabled', 'disabled');
                        },

                        success: function(data) {
                           
                           console.log(data)

                            if ($("#separator").val() == "&#13;") $("#separator").val() = "\n";
     
                             try {
                                data = JSON.parse(data)

                                if (data["status"] == "error") {

                                    if (data["data"].includes("Failed to connect to")) {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + "Failed to connect" + $("#separator").val();
                                        i++
                                        RemoveIp()
                                        pchecked++

                                    }if (data["data"].includes("Could not resolve proxy")) {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + "Could not resolve proxy:" + $("#separator").val();
                                        i++

                                        RemoveIp()
                                        pchecked++
                                    } else {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + data["data"] + " {{{Error}}}" + $("#separator").val();
                                        i++
                                        RemoveIp()
                                        pchecked++

                                    }


                                } else if (data["status"] == "Not Json") {
                                    document.getElementById("error").innerHTML += data["account"] + " => " + result + " {{{Not Json}}}" + $("#separator").val();

                                } else if (data["status"] == "Json") {

                                    if (data["data"]["resultCode"] ==  "01") {
                                        if ($("#okay").val().trim() != "" && $("#okay").val().includes(value)) {
                                            Duplicated++
                                            document.getElementById("error").innerHTML += data["account"] + " => " + "Duplicated" + $("#separator").val();

                                        } else {
                                            Successed++
                                            document.getElementById("okay").innerHTML += data["account"] + " => " + "Valid" + $("#separator").val();
                                        }
                                        RemoveAccount()
                                        checked++
                                      //  l++
                                    } else if (data["data"]["resultCode"] ==  "02") {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + "Not Valid" + $("#separator").val();
                                        Failed++
                                        RemoveAccount()
                                        checked++
                                        l++
                                    } else if (data["data"]["resultCode"] ==  "03") {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + "exceeded the number" + $("#separator").val();
                                        i++
                                        RemoveIp()
                                        pchecked++
                                     //   l++
                                    } else {
                                        document.getElementById("error").innerHTML += data["account"] + " => " + data["data"] + " {{{UnKnown}}}" + $("#separator").val();
        
                                    }

                                } else {
                                    document.getElementById("error").innerHTML += data["account"] + " => " + data["data"] + " {{{Else}}}" + $("#separator").val();
                                }

                            } catch (err) {
                                document.getElementById("error").innerHTML +=  data["data"]  + $("#separator").val();
                                console.log(err.message)
                            }


                            $('#checked').html(checked);
                            $('#pchecked').html(pchecked);
                            $('#successed').html(Successed);
                            $('#failed').html(Failed);
                            $('#duplicated').html(Duplicated);

                            Tested = parseInt(Failed) + parseInt(Successed) + parseInt(Duplicated);

                            var result = Math.ceil((checked / total) * 100);

                            $('#title').html('[' + Tested + '/' + total + '] checker');
                            document.getElementById("progressbar").style.width = result + "%";
                            document.getElementById("progressbar").innerText = result + "%";


                            if (checked == total) {
                                $('#start').attr('disabled', null);
                                $('#stop').attr('disabled', 'disabled');
                                // audio.play();
                            }


                        }

                    }); //end ajax
               }); //end foreach
             
            }
        }); //end onclick


        $('#stop').click(function() {
            ajaxCall.abort();

            $('#start').attr('disabled', null);
            $('#stop').attr('disabled', 'disabled');
        });

        function RemoveIp() {
            var proxiesD = $("#proxies").val().split('\n');
            proxiesD.splice(0, 1);
            $("#proxies").val(proxiesD.join("\n"));
        }

        function RemoveAccount() {
            var list = $("#list").val().split('\n');
            list.splice(0, 1);
            $("#list").val(list.join("\n"));

        }
    });
</script>


</body>
</html>

<?php } ?>