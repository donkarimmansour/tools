<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Bin checker";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";


?>
<!-- Content -->
<div class="container mt-3 mb-3">
    <?php breadcrumbs("Bin", "checker"); ?>
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-md-2">
                    <span style="font-weight: bold;">Mailer </span>

                </div>


                <div class="col-md-10">
                    <div style="text-align:center; display: inline-block;">
                        <button type="button" class="btn btn-info mt-1">
                            total <span class="badge badge-light info" id="total">0</span>
                        </button>

                        <button type="button" class="btn btn-primary mt-1">
                            tested <span class="badge badge-light primary" id="tested">0</span>
                        </button>

                        <button type="button" class="btn btn-warning mt-1">
                            Duplicated <span class="badge badge-light warning" id="duplicated">0</span>
                        </button>
                    </div>
                </div>
            </div>



        </div>

        <div class="card-body">

            <form id="Binchecker" method="post">

                <div class="row">

                    <div class="col-sm-12 mb-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="list" class="control-label mb-1 required">Enter the Bin List</label>
                            <textarea id="list" class="form-control" placeholder="Enter the Bin List" rows="6"></textarea>
                            <small id="err" class="form-text text-danger d-none">Please enter valid Bins.</small>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mt-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Check</span>
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-12 mt-1">
                                <button type="button" id="stop" class="btn btn-lg btn-danger btn-block">
                                    <span>stop</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>
        <div class="card-footer mb-2 pb-0">

            <div class="articles card">
              
                <div class="card-header align-items-center">
                    <h2 class="h3 d-inline">Detiels <i class="fa fa-check"></i></h2>
                    <span class="float-right">
                            <button type="button" class="btn btn-xs btn-danger" onclick="document.getElementById('lives').innerHTML = ''"><i class="fa fa-close"> Clear </i></font></button>
                        </span>
                </div>

                <div class="card-body no-padding bg-white">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Bin</th>
                                    <th scope="col">Network (Type)</th>
                                    <th scope="col">Brand (Prepaid)</th>
                                    <th scope="col">Bank (Country)</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                </tr>
                            <tbody id="lives">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>


<script>
    $(document).ready(function() {


        $('#stop').attr('disabled', true);


        //$('#start').click(function() {
        $("#Binchecker").submit(function(e) {
            // custom handling here
            e.preventDefault();

            var Tested = 0;
            var Duplicated = 0;

            if ($("#list").val() == null || $("#list").val().trim() == "") {
                $("#err").removeClass("d-none").addClass("d-block")
            } else {
                $("#err").removeClass("d-block").addClass("d-none")

                // audio.play()
                var list = $('#list').val().split('\n');
                var total = list.length;
                $('#total').html(total);

                list.forEach(function(value, index) {
                    ajaxCall = $.ajax({
                        url: '../controller/checker.php',
                        type: 'POST',
                        data: $('#Binchecker').serialize() + "&bin=" + value,

                        beforeSend: function() {
                            $('#stop').attr('disabled', null);
                            $('#start').attr('disabled', 'disabled');
                        },

                        success: function(data) {
                            try {
                                Tested++
                                data = JSON.parse(data)

                                if (data["status"] == "failed") {
                                    var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                                  <td><span class="badge badge-warning">${data["data"]}</span></td>
                                                  <td><span class="badge badge-info">${value}</span></td>
                                                  <td><span class="badge badge-warning">${data["data"]}</span></td></tr>`
                                    document.getElementById("lives").innerHTML += output

                                } else {
                                     data = JSON.parse(data["data"])

                                    if ($("#lives").text().includes(value)) Duplicated++
                                    else {
                                        var prepaid = data["prepaid"] ? "yes" : "no"
                                        var name = data["bank"]["name"] ? data["bank"]["name"] : "#"
                                        var url = data["bank"]["url"] ? data["bank"]["url"] : "#"
                                        var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                        <td><span class="badge badge-success">${data["scheme"]} (${data["type"]})</td>
                                        <td><span class="badge badge-primary">${data["brand"]} (${prepaid})</span></td>
                                        <td><span class="badge badge-warning"><a href="${url}">${name}</a> (${data["country"]["name"]})</span></td></tr>`

                                        document.getElementById("lives").innerHTML += output
                                    }

                                }


                            } catch (err) {
                                Tested++
                                var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                             <td><span class="badge badge-warning">${err.message}</span></td>
                                             <td><span class="badge badge-info">${value}</span></td>
                                             <td><span class="badge badge-warning">${err.message}</span></td></tr>`
                                    document.getElementById("lives").innerHTML += output

                            }


                            $('#tested').html(Tested);
                            $('#duplicated').html(Duplicated);

                            var result = Math.ceil((Tested / total) * 100);

                            $('#title').html('[' + Tested + '/' + total + '] checker');
                            document.getElementById("progressbar").style.width = result + "%";
                            document.getElementById("progressbar").innerText = result + "%";

                            if (Tested == total) {
                                $('#start').attr('disabled', null);
                                $('#stop').attr('disabled', 'disabled');
                                // audio.play();
                            }

                            var list = $("#list").val().split('\n');
                            list.splice(0, 1);
                            $("#list").val(list.join("\n"));

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