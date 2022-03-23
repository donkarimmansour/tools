<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Checker";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>

<div class="container mt-3 mb-3">

    <?php breadcrumbs("Ssn", "Checker");
    ?>
    <div class="card">

        <div class="card-header ">
            <span style="font-weight: bold;">Checker </span>

            <div style="text-align:center; display: inline-block;">
                <button type="button" class="btn btn-info m-1">
                    total <span class="badge badge-light info" id="total">0</span>
                </button>

                <button type="button" class="btn btn-success m-1">
                    checked <span class="badge badge-light success" id="checked">0</span>
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
                        <div class="form-group">
                            <label class="control-label mb-1">Include</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ckstate" value="country" />
                                <label class="form-check-label" for="ckstate">State</label>
                            </div>

                        </div>
                    </div>

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




                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="list" class="control-label mb-1 required">Ssn List</label>
                            <textarea id="list" class="form-control" placeholder="Ssn List" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1 required">Results</label>
                            <textarea id="okay" class="form-control" placeholder="Results" rows="6"></textarea>
                            <small id="list_err" class="form-text text-danger d-none">Please Enter the text/content.</small>

                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Check</span>
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

        var links = 0;
        var total = 0;
        var checked = 0;
        //$('#start').click(function() {
        $("#form").submit(function(e) {
            // custom handling here
            e.preventDefault();




            if ($("#list").val() == null || $("#list").val().trim() == "") {
                $("#list_err").removeClass("d-none").addClass("d-block")
                return
            } else {
                $("#list_err").removeClass("d-block").addClass("d-none")

                var list = $('#list').val().split('\n');
                var total = list.length;
                $('#total').html(total);

            list.forEach(function(value, index) {

                ajaxCall = $.ajax({
                    url: '../controller/checker.php',
                    type: 'POST',
                    data: "ssn=" + value,

                    beforeSend: function() {
                        $('#stop').attr('disabled', null);
                        $('#start').attr('disabled', 'disabled');
                    },

                    success: function(data) {
                        if ($("#separator").val() == "&#13;") $("#separator").val() = "\n";

                        data = JSON.parse(data)
                        var is = !data["state"] ? "invalid" : "valid"

                        if ($("#ckstate").is(':checked')) {
                            document.getElementById("okay").innerHTML += data["ssn"] + " | " + is + " ( " + data["state"] + " )" + $("#separator").val();
                        } else {
                            document.getElementById("okay").innerHTML += data["ssn"] + " | " + is + $("#separator").val();
                        }

                        checked++
                        $('#checked').html(checked);

                        var result = Math.ceil((checked / total) * 100);

                        $('#title').html('[' + checked + '/' + total + '] checker');
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


    });
</script>