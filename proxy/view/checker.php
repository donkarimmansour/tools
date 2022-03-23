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
<!-- Content -->
<div class="container mt-3 mb-3">
    <?php breadcrumbs("Proxy", "Checker"); ?>

    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-md-2">
                    <span style="font-weight: bold;">Checker</span>

                </div>


                <div class="col-md-10">
                    <div style="text-align:center; display: inline-block;">
                        <button type="button" class="btn btn-info mt-1">
                            total <span class="badge badge-light info" id="total">0</span>
                        </button>

                        <button type="button" class="btn btn-primary mt-1">
                            tested <span class="badge badge-light primary" id="tested">0</span>
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
                    </div>
                </div>
            </div>



        </div>

        <div class="card-body">

            <form id="proxychecker" method="post">

                <div class="row">

                    <div class="col-sm-12 mb-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="Type">Type</label>
                            <select id="Type" name="type" class="form-control">
                                <option value="All">All</option>
                                <option value="HTTP">HTTP</option>
                                <option value="HTTPS">HTTPS</option>
                                <option value="SOCKS5">SOCKS5</option>
                                <option value="SOCKS4">SOCKS4</option>
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
                            <label for="list" class="control-label mb-1 required">Enter the Proxy List</label>
                            <textarea id="list" class="form-control" placeholder="Enter the Proxy List" rows="6"></textarea>
                            <small id="err" class="form-text text-danger d-none">Please enter valid proxies.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1">Successed</label>
                            <textarea id="okay" class="form-control" placeholder="Successed" rows="6"></textarea>
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
        
                <div class="card-header align-items-center w-100">
                    <h2 class="h3 d-inline">Approved <i class="fa fa-check"></i></h2>
                        <span class="float-right">
                            <button type="button" class="btn btn-xs btn-danger" onclick="document.getElementById('lives').innerHTML = ''"><i class="fa fa-close"> Clear </i></font></button>
                        </span>
                    
                </div>

                <div class="card-body no-padding bg-white">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Proxy</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">City</th>
                                    <th scope="col">Isp</th>
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




            <div class="articles card mt-2">

                <div class="card-header align-items-center">
                    <h2 class="h3 d-inline">Rejected <i class="fa fa-close"></i></h2>
                    <span class="float-right">
                            <button type="button" class="btn btn-xs btn-danger" onclick="document.getElementById('error').innerHTML = ''"><i class="fa fa-close"> Clear </i></font></button>
                        </span>

                </div>
                <div class="card-body no-padding bg-transparent">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Proxy</th>
                                    <th scope="col">Error</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tr>
                            <tbody id="error">

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
        $("#proxychecker").submit(function(e) {
            // custom handling here
            e.preventDefault();

            var Successed = 0;
            var Failed = 0;
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
                        data: $('#proxychecker').serialize() + "&proxy=" + value,

                        beforeSend: function() {
                            $('#stop').attr('disabled', null);
                            $('#start').attr('disabled', 'disabled');
                        },

                        success: function(data) {
                              console.log(data)
                            try {
                                data = JSON.parse(data)

                                if (data["status"] == "failed") {
                                    Failed++
                                    var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                                  <td><span class="badge badge-warning">${data["data"]}</span></td></tr>`
                                    document.getElementById("error").innerHTML += output

                                } else {
                                     data = JSON.parse(data["data"])

                                    if ($("#okay").val().trim() != "" && $("#okay").val().includes(value)) Duplicated++
                                    else {
                                        Successed++
                                        var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                        <td><span class="badge badge-success">${data["country"]}</td>
                                        <td><span class="badge badge-primary">${data["city"]}</span></td>
                                        <td><span class="badge badge-warning">${data["isp"]}</span></td></tr>`

                                        document.getElementById("okay").innerHTML += value + $("#separator").val();
                                        document.getElementById("lives").innerHTML += output
                                    }

                                }


                            } catch (err) {
                                Failed++
                                var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                                <td><span class="badge badge-warning">${err.message}</span></td></tr>`
                                    document.getElementById("error").innerHTML += output

                            }


                            Tested = parseInt(Failed) + parseInt(Successed) + parseInt(Duplicated);

                            $('#successed').html(Successed);
                            $('#failed').html(Failed);
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