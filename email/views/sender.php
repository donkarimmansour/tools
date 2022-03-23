<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Sender";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>

    <!-- Content -->
    <div class="container mt-3 mb-3">


        <div class="card">


            <div class="card-header ">
                <span style="font-weight: bold;">Sender </span>

                <div style="text-align:center; display: inline-block;">
                    <button type="button" class="btn btn-info m-1">
                        total <span class="badge badge-light info" id="total">0</span>
                    </button>

                    <button type="button" class="btn btn-primary m-1">
                        checked <span class="badge badge-light primary" id="checked">0</span>
                    </button>

                    <button type="button" class="btn btn-success m-1">
                        Successed <span class="badge badge-light success" id="success">0</span>
                    </button>

                    <button type="button" class="btn btn-danger m-1">
                        Failed <span class="badge badge-light danger" id="failure">0</span>
                    </button>

                </div>

            </div>

            <div class="card-body">

                <!-- <div class=" alert  alert-danger " style="display: none;" id="error">

                                           </div> -->

                <?php if (isset($_SESSION['msg'])) { ?>
                    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                        <span class="badge badge-pill badge-danger">Error</span>
                        <?php echo $_SESSION['msg']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php unset($_SESSION['msg']);
                } ?>
                <form id="form" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-sm-12 mb-3">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="host" class="control-label mb-1 required">Host</label>
                                <input type="text" id="host" value="<?php if (isset($_POST["host"])) echo $_POST["host"]; ?>" name="host" class="form-control " placeholder="Host">
                                <small id="host_err" class="form-text text-danger d-none">Please enter host...</small>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">

                            <div class="form-group">
                                <label for="Secure required">Secure</label>
                                <select id="Secure" name="Secure" class="form-control">
                                    <option value="tls">tls</option>
                                    <option value="ssl">ssl</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="port" class="control-label mb-1 required">Port</label>
                                <input type="number" id="port" value="<?php if (isset($_POST["port"])) echo $_POST["port"]; ?>" name="port" class="form-control" placeholder="Port">
                                <small id="port_err" class="form-text text-danger d-none">Please enter Port...</small>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="username" class="control-label mb-1 required">Username</label>
                                <input type="text" id="username" value="<?php if (isset($_POST["username"])) echo $_POST["username"]; ?>" name="username" class="form-control" placeholder="Username">
                                <small id="user_err" class="form-text text-danger d-none">Please enter Username...</small>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="password" class="control-label mb-1 required">Password</label>
                                <input type="password" id="password" value="<?php if (isset($_POST["password"])) echo $_POST["password"]; ?>" name="password" class="form-control" placeholder="Password">
                                <small id="pass_err" class="form-text text-danger d-none">Please enter Password...</small>


                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="from" class="control-label mb-1">Sender Email</label>
                                <input type="email" id="from" value="<?php if (isset($_POST["from"])) echo $_POST["from"]; ?>" name="from" class="form-control" placeholder="Frome">
                                <small id="se_err" class="form-text text-danger d-none">Please enter Sender Email...</small>


                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="fromname" class="control-label mb-1 ">Sender Name</label>
                                <input type="text" id="fromname" value="<?php if (isset($_POST["fromname"])) echo $_POST["fromname"]; ?>" name="fromname" class="form-control" placeholder="FromName">
                                <small id="sn_err" class="form-text text-danger d-none">Please enter Sender Name...</small>

                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="ReplyTo" class="control-label mb-1">Reply To</label>
                                <input type="email" id="ReplyTo" value="<?php if (isset($_POST["ReplyTo"])) echo $_POST["ReplyTo"]; ?>" name="ReplyTo" class="form-control" placeholder="ReplyTo">
                                <small id="rt_err" class="form-text text-danger d-none">Please enter Reply To...</small>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Attachment" class="control-label mb-1">Attachment</label>
                                <input accept="*" style="background: #d0d0e0;" type="file" name="Attachment" id="Attachment">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="Type">Message Type</label>
                                <select id="Type" name="Type" class="form-control">
                                    <option value="html">Html</option>
                                    <option value="plain">Plain</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="CharSet">Character set</label>
                                <select id="CharSet" name="CharSet" class="form-control">
                                    <option value="UTF-8">UTF-8</option>
                                    <option value="iso-8859-1">iso-8859-1</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="encoding">Message encoding</label>
                                <select id="encoding" name="encoding" class="form-control">
                                    <option value="8bit">8bit</option>
                                    <option value="7bit">7bit</option>
                                    <option value="binary">binary</option>
                                    <option value="base64">base64</option>
                                    <option value="quoted-printable">quoted-printable</option>
                                </select>

                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
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

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="delay" class="control-label mb-1">Delay</label>
                                <input type="number" id="delay" value="<?php if (isset($_POST["delay"])) echo $_POST["delay"]; else echo 0 ?>" name="delay" class="form-control" placeholder="delay">
                                <small id="delay_err" class="form-text text-danger d-none">Please enter 0 or more ...</small>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="subject" class="control-label mb-1">Subect</label>
                                <input type="text" id="subject" value="<?php if (isset($_POST["Subject"])) echo $_POST["Subject"]; ?>" name="Subject" class="form-control" placeholder="Subject">
                                <small id="title_err" class="form-text text-danger d-none">Please enter Subect...</small>

                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="html" class="control-label mb-1 required">Html</label>
                                <textarea id="html" name="Html" class="form-control" placeholder="Html" rows="5"><?php if (isset($_POST["Html"])) echo $_POST["Html"]; ?></textarea>
                                <small id="html_err" class="form-text text-danger d-none">Please enter Html...</small>

                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="receiver" class="control-label mb-1 required">Email List</label>
                                <textarea id="receiver" name="receiver" class="form-control" placeholder="Receiver" rows="5"><?php if (isset($_POST["receiver"])) echo $_POST["receiver"]; ?></textarea>
                                <small id="el_err" class="form-text text-danger d-none">Please enter Email List...</small>

                            </div>
                        </div>

                       
                                <div class="col-md-6 col-sm-12 mb-1">
                                    <button type="submit" id="send" class="btn btn-lg btn-success btn-block">
                                        <span>Send</span>
                                    </button>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-1">
                                    <button type="button" id="stop" class="btn btn-lg btn-danger btn-block">
                                        <span>stop</span>
                                    </button>
                                </div>
                          
                        
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="okay" class="control-label mb-1">Okay</label>
                                <textarea id="okay" name="okay" class="form-control" placeholder="okay" rows="5"><?php if (isset($_POST["okay"])) echo $_POST["okay"]; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="errors" class="control-label mb-1">Errors</label>
                                <textarea id="errors" name="errors" class="form-control" placeholder="errors" rows="5"><?php if (isset($_POST["errors"])) echo $_POST["errors"]; ?></textarea>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>


<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>


    <script>
        $(document).ready(function() {
            $('#stop').attr('disabled', true);


            $("#form").submit(function(e) {
            //     // custom handling here
               e.preventDefault();

                // audio.play();

                if ($("#host").val() == null || $("#host").val().trim() == "") {
                        $("#host_err").removeClass("d-none").addClass("d-block")
                        return
                    } else if ($("#port").val() == null || $("#port").val().trim() == "") {
                        $("#port_err").removeClass("d-none").addClass("d-block")
                        return

                    }else if ($("#username").val() == null || $("#username").val().trim() == "") {
                        $("#user_err").removeClass("d-none").addClass("d-block")
                        return

                    } else if ($("#password").val() == null || $("#password").val().trim() == "") {
                        $("#pass_err").removeClass("d-none").addClass("d-block")
                        return

                    // } else if ($("#from").val() == null || $("#from").val().trim() == "") {
                    //     $("#se_err").removeClass("d-none").addClass("d-block")
                    //     return

                    // } else if ($("#fromname").val() == null || $("#fromname").val().trim() == "") {
                    //     $("#sn_err").removeClass("d-none").addClass("d-block")
                    //     return

                    // } else if ($("#ReplyTo").val() == null || $("#ReplyTo").val().trim() == "") {
                    //     $("#rt_err").removeClass("d-none").addClass("d-block")
                    //     return

                     } else if ($("#subject").val() == null || $("#subject").val().trim() == "") {
                        $("#title_err").removeClass("d-none").addClass("d-block")
                        return

                    }else if ($("#html").val() == null || $("#html").val().trim() == "") {
                        $("#html_err").removeClass("d-none").addClass("d-block")
                        return

                    } else if ($("#delay").val() == null || parseInt($("#delay").val()) < 0) {
                        $("#delay_err").removeClass("d-none").addClass("d-block")
                        return

                    }else if ($("#receiver").val() == null || $("#receiver").val().trim() == "") {
                        $("#el_err").removeClass("d-none").addClass("d-block")
                        return

                    }else { 
                        $("#host_err").removeClass("d-block").addClass("d-none")
                        $("#port_err").removeClass("d-block").addClass("d-none")
                        $("#user_err").removeClass("d-block").addClass("d-none")
                        $("#pass_err").removeClass("d-block").addClass("d-none")
                        $("#delay_err").removeClass("d-block").addClass("d-none")
                        // $("#sn_err").removeClass("d-block").addClass("d-none")
                        // $("#se_err").removeClass("d-block").addClass("d-none")
                        $("#el_err").removeClass("d-block").addClass("d-none")
                        $("#html_err").removeClass("d-block").addClass("d-none")
                        $("#title_err").removeClass("d-block").addClass("d-none")
                        // $("#rt_err").removeClass("d-block").addClass("d-none")



                var receiver = $('#receiver').val().split('\n');

                var total = receiver.length;
                var success = 0;
                var failure = 0;

                $('#total').html(total);


                receiver.forEach(function(value, index) {


                    setTimeout(() => {
                        
                        var ajaxCall = $.ajax({
                        url: '../controller/sender.php',
                        type: 'POST',
                        data: $('#form').serialize() + "&email=" + value,

                        beforeSend: function() {
                            $('#stop').attr('disabled', null);
                            $('#send').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            console.log(data)
                            try{
                                if (data.indexOf("Status : OKAY") >= 0) {
                                    success += 1;
                                    document.getElementById("okay").innerHTML += data + $("#separator").val();
                                    // audio.play();
                                    var receiver = $("#receiver").val().split('\n');
                                    receiver.splice(0, 1);
                                    $("#receiver").val(receiver.join("\n"));

                                } else {
                                    failure += 1;
                                    document.getElementById("errors").innerHTML += data + $("#separator").val();
                                    var receiver = $("#receiver").val().split('\n');
                                    receiver.splice(0, 1);
                                    $("#receiver").val(receiver.join("\n"));

                                }

                                var checked = parseInt(success) + parseInt(failure);

                                $('#failure').html(failure);
                                $('#success').html(success);
                                $('#checked').html(checked);

                                var result = Math.round((checked / total) * 100) ;

                                $('#title').html('[' + checked + '/' + total + '] mailer');
                                document.getElementById("progressbar").style.width = result + "%";
                                document.getElementById("progressbar").innerText = result + "%";

                                if (checked == total) {
                                    $('#send').attr('disabled', null);
                                    $('#stop').attr('disabled', 'disabled');
                                    // audio.play();
                                }
                            }catch(err){
                                alert(err.message)
                                $('#send').attr('disabled', null);
                                $('#stop').attr('disabled', 'disabled');
                            }

                       }

                    }); //end ajax

                    },parseInt($("#delay").val())  * 1000);
                   

                }); //end foreach
                    }//else
             }); //end onclick



            $('#stop').click(function() {
                ajaxCall.abort();
                $('#send').attr('disabled', null);
                $('#stop').attr('disabled', 'disabled');
            });


        });
    </script>
