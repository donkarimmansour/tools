<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Url Extractor";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>


<!-- Content -->
<div class="container mt-3 mb-3">

    <?php breadcrumbs("Email", "Url Extractor"); ?>

    <div class="card">


        <div class="card-header ">
            <span style="font-weight: bold;">Url Extractor </span>

            <div style="text-align:center; display: inline-block;">
                <button type="button" class="btn btn-info m-1">
                    links <span class="badge badge-light info" id="links">0</span>
                </button>

            </div>

        </div>

        <div class="card-body">

            <form id="form" method="post" enctype="multipart/form-data">

                <div class="row">


                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
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

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="url" class="control-label mb-1 required">url</label>
                                    <input type="text" id="url" name="url" class="form-control" placeholder="Url" value="<?php if (isset($_POST["url"])) echo $_POST["url"]; ?>" />
                                    <small id="url_err" class="form-text text-danger d-none">Please Enter the Url.</small>

                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="okay" class="control-label mb-1 required">Urls</label>
                                    <textarea id="okay" class="form-control" placeholder="Urls" rows="6"></textarea>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12  mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Extract</span>
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-12  mb-1">
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







<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>

<script>
    $(document).ready(function() {


        $('#stop').attr('disabled', true);

        var links = 0;

        //$('#start').click(function() {
        $("#form").submit(function(e) {
            // custom handling here
            e.preventDefault();

            // audio.play()
            if ($("#url").val() == null || $("#url").val().trim() == "") {
                $("#url_err").removeClass("d-none").addClass("d-block")
                return
            } else {
                $("#url_err").removeClass("d-block").addClass("d-none")

                ajaxCall = $.ajax({
                url: '../controller/link.php',
                type: 'POST',
                data: $('#form').serialize(),

                beforeSend: function() {
                    $('#stop').attr('disabled', null);
                    $('#start').attr('disabled', 'disabled');
                },

                success: function(data) {

                    if ($("#separator").val() == "&#13;") $("#separator").val() = "\n";
                    links = data.split($("#separator").val()).length
                    document.getElementById("okay").innerHTML = data + $("#separator").val();


                    $('#links').html(links);
                    $('#start').attr('disabled', null);
                    $('#stop').attr('disabled', 'disabled');

                }
            

          

            }); //end ajax
            }
        }); //end onclick


        $('#stop').click(function() {
      
          ajaxCall.abort();
           
            $('#start').attr('disabled', null);
            $('#stop').attr('disabled', 'disabled');
        });


    });
</script>
