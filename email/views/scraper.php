<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Scraper";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>
<!-- Content -->
<div class="container mt-3 mb-3">
    <?php breadcrumbs("Email", "Scraper");
    ?>


    <div class="card">


        <div class="card-header ">
            <span style="font-weight: bold;">Scraper </span>

            <div style="text-align:center; display: inline-block;">

                <button type="button" class="btn btn-info m-1">
                    total <span class="badge badge-light info" id="total">0</span>
                </button>

                <button type="button" class="btn btn-primary m-1">
                    tested <span class="badge badge-light primary" id="tested">0</span>
                </button>

                <button type="button" class="btn btn-success m-1">
                    Extracted <span class="badge badge-light success" id="Extracted">0</span>
                </button>

                <button type="button" class="btn btn-danger m-1">
                    Duplicate <span class="badge badge-light danger" id="Duplicate">0</span>
                </button>

                <button type="button" class="btn btn-warning m-1">
                    Unique <span class="badge badge-light warning" id="Unique">0</span>
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
                                    <label for="list" class="control-label mb-1 required">Enter the Url List</label>
                                    <textarea id="list" class="form-control" placeholder="Enter the Url List" rows="7"><?php if (isset($_POST["list"])) echo $_POST["list"]; ?></textarea>
                                    <small id="list_err" class="form-text text-danger d-none">Enter the Url List</small>

                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="okay" class="control-label mb-1 required">Unique</label>
                                    <textarea id="okay" class="form-control" placeholder="Unique" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="errors" class="control-label mb-1 required">Duplicate</label>
                                    <textarea id="errors" class="form-control" placeholder="Duplicate" rows="4"><?php if (isset($_POST["errors"])) echo $_POST["errors"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Extract</span>
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








<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>
<script>
    $(document).ready(function() {


        $('#stop').attr('disabled', true);

        var Unique = 0;
        var Duplicate = 0;
        var Extracted = 0;
        var tested = 0;

        //$('#start').click(function() {
        $("#form").submit(function(e) {
            // custom handling here
            e.preventDefault();
            if ($("#list").val() == null || $("#list").val().trim() == "") {
                $("#list_err").removeClass("d-none").addClass("d-block")
                return
            } else {
                $("#list_err").removeClass("d-block").addClass("d-none")
            }

            // audio.play()
            var list = $('#list').val().split('\n');
            var total = list.length;
            $('#total').html(total);

            list.forEach(function(value, index) {
                ajaxCall = $.ajax({
                    url: '../controller/scraper.php',
                    type: 'POST',
                    data: $('#form').serialize() + "&url=" + value,

                    beforeSend: function() {
                        $('#stop').attr('disabled', null);
                        $('#start').attr('disabled', 'disabled');
                    },

                    success: function(data) {

                        if (data != null && data != "\n" && data != " ") {
                            var newdata = data.split("\n")
                            tested++
                            newdata.forEach((email) => {
                                if (email != "") {

                                    if ($("#okay").val().includes(email)) {

                                        Duplicate++
                                        document.getElementById("errors").innerHTML += email + $("#separator").val();


                                    } else {
                                        Unique++
                                        document.getElementById("okay").innerHTML += email + $("#separator").val();

                                    }
                                }
                            var list = $("#list").val().split('\n');
                            list.splice(0, 1);
                            $("#list").val(list.join("\n"));

                            })

                          
                            Extracted = parseInt(Unique) + parseInt(Duplicate);

                            $('#Unique').html(Unique);
                            $('#Duplicate').html(Duplicate);
                            $('#tested').html(tested);
                            $('#Extracted').html(Extracted);

                            var result = Math.ceil((tested / total) * 100);

                            $('#title').html('[' + tested + '/' + total + '] checker');
                            document.getElementById("progressbar").style.width = result + "%";
                            document.getElementById("progressbar").innerText = result + "%";

                            if (tested == total) {
                                $('#start').attr('disabled', null);
                                $('#stop').attr('disabled', 'disabled');
                                // audio.play();
                            }

                        }
                    }

                }); //end ajax

            }); //end foreach
        }); //end onclick


        $('#stop').click(function() {
           ajaxCall.abort();

            $('#start').attr('disabled', null);
            $('#stop').attr('disabled', 'disabled');
        });


    });
</script>
