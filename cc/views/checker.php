<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "cc checker";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";


?>
<!-- Content -->
<div class="container mt-3 mb-3">
    <?php breadcrumbs("Card", "checker"); ?>
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

                        <button type="button" class="btn btn-success mt-1">
                            Successed <span class="badge badge-light success" id="successed">0</span>
                        </button>

                        <button type="button" class="btn btn-danger mt-1">
                            Failed <span class="badge badge-light danger" id="failed">0</span>
                        </button>

                        <button type="button" class="btn btn-warning mt-1">
                            Duplicated <span class="badge badge-light warning" id="duplicated">0</span>
                        </button>
                    </div>
                </div>
            </div>



        </div>

        <div class="card-body">

            <form id="ccchecker" method="post">

                <div class="row">

                    <div class="col-sm-12 mb-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="Separator">Separator</label>
                                    <select id="Separator" name="Separator" class="form-control">
                                        <option value="&#13;">New Line</option>
                                        <option value=":">:</option>
                                        <option value=";">;</option>
                                        <option value="|">|</option>
                                        <option value=" ">space</option>
                                        <option value="$">$</option>
                                        <option value="*">*</option>
                                        <option value="#">#</option>
                                        <option value="&">&</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label mb-1 d-block">Use</label>
                                    <div class="form-check form-check-inline">
                                        $&nbsp;
                                        <input class="form-check-input" type="checkbox" id="prcheck" value="country" />
                                        <label class="form-check-label" for="prcheck">Proxy</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>




                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="list" class="control-label mb-1 required">Enter the cc List</label>
                            <textarea id="list" class="form-control" placeholder="Enter the cc List" rows="6"></textarea>
                            <small id="llist_err" class="form-text text-danger d-none">Please enter valid cc.</small>
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

                            <div class="col-md-6 col-sm-12" style="display: none;">
                                <div class="form-group">
                                    <label for="type">Proxy Type</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="All">All</option>
                                        <option value="HTTP">HTTP</option>
                                        <option value="HTTPS">HTTPS</option>
                                        <option value="SOCKS5">SOCKS5</option>
                                        <option value="SOCKS4">SOCKS4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12" style="display: none;">
                                <div class="form-group">
                                    <label for="dead" class="control-label mb-1 required">Change Proxy after <span id="after">5</span> dead results</label>
                                    <input type="number" id="dead" class="form-control" placeholder="dead" value="5" />
                                    <small id="ss_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12" style="display: none;">
                        <div class="form-group">
                            <label for="proxies" class="control-label mb-1 required">Enter the Proxies List</label>
                            <textarea id="proxies" class="form-control" placeholder="Enter the Proxies List" rows="6"></textarea>
                            <small id="plist_err" class="form-text text-danger d-none">Please enter valid Proxies List.</small>
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
                                    <th scope="col">cc</th>
                                    <th scope="col">$$$$$</th>
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
                                    <th scope="col">cc</th>
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
        $("#ccchecker").submit(function(e) {
            // custom handling here
            e.preventDefault();



            if ($("#list").val() == null || $("#list").val().trim() == "") {
                $("#llist_err").removeClass("d-none").addClass("d-block")
            } else {
                $("#llist_err").removeClass("d-block").addClass("d-none")

                if ($("#prcheck").is(':checked')) {

                    if ($("#proxies").val() == null || $("#proxies").val().trim() == "") {
                        $("#plist_err").removeClass("d-none").addClass("d-block")
                    } else {
                        $("#plist_err").removeClass("d-block").addClass("d-none")

                        if ($("#dead").val() == null || $("#dead").val() == "" || parseInt($("#dead").val()) < 1) {
                            $("#ss_err").removeClass("d-none").addClass("d-block")
                        } else {
                            $("#ss_err").removeClass("d-block").addClass("d-none")
                            ccCheck()
                        }

                    }

                } else {
                    ccCheck()
                }


            }

        }); //end onclick


        $('#prcheck').on("change", function() {
            $("#proxies").parent().parent().slideToggle()
            $("#type").parent().parent().slideToggle()
            $("#dead").parent().parent().slideToggle()

        });

        $('#dead').on("keyup , change", function() {
            if ($("#dead").val() == null || $("#dead").val().trim() == "" || parseInt($("#dead").val().trim()) < 1) $("#dead").val(1)
            $("#after").text($("#dead").val())

        });


        $('#stop').click(function() {
            ajaxCall.abort();

            $('#start').attr('disabled', null);
            $('#stop').attr('disabled', 'disabled');
        });






        function ccCheck() {
            var Successed = 0;
            var Failed = 0;
            var Tested = 0;
            var Duplicated = 0;

            // audio.play()
            var list = $('#list').val().split('\n');
            var total = list.length;
            var cfs = 0
            $('#total').html(total);

            list.forEach(function(value, index) {

                if ($("#prcheck").is(':checked')) {
                    var proxies = $('#proxies').val().split('\n');
                    var proxy = proxies.slice(0, 1);
                    cfs++
                    if (cfs == parseInt($("#dead").val())) {
                        proxies.splice(0, 1);
                        $("#proxies").val(proxies.join("\n"));
                        cfs = 0
                    }

                }

                var query = $("#prcheck").is(':checked') ? "&is=yes&proxy=" + proxy : "&is=no"


                ajaxCall = $.ajax({
                    url: '../controller/checker.php',
                    type: 'POST',
                    data: $('#ccchecker').serialize() + "&cc=" + value + query,

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
                             // newdata = JSON.parse(data["data"])
                                newdata = data["data"]

                                if ($("#okay").val().trim() != "" && $("#okay").val().includes(value)) Duplicated++
                                else {
                                    // if (newdata.includes("The credit card was declined. Please check the information that you entered.")) {
                                    //     Failed++
                                    //     var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                    //     <td><span class="badge badge-warning">The credit card was declined. Please check the information that you entered.</span></td></tr>`
                                    //     document.getElementById("error").innerHTML += output

                                    // } else {
                                        Successed++
                                        var output = `<tr><td><span class="badge badge-info">${value}</span></td>
                                        <td><span class="badge badge-success">${ newdata}</td></tr>`

                                        document.getElementById("okay").innerHTML += value + $("#Separator").val();
                                        document.getElementById("lives").innerHTML += output
                                  //  }

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


    });
</script>