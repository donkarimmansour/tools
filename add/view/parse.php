<?php

use function PHPSTORM_META\type;

require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "function";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

$Id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;
$do = isset($_GET["do"]) ? $_GET["do"] : "index";

?>
<!-- Content -->
<div class="container mt-3 mb-3">

    <?php if ($do == "index") {

        breadcrumbs("Repeater", "Parse"); ?>

        <div class="card">
            <div class="card-header ">
                <span style="font-weight: bold;">Parse</span>
            </div>

            <div class="card-body">
                <form id="rparse" method="post">
                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_source">Source</label>
                                <select id="rp_source" name="rp_source" class="form-control">
                                    <?php

                                    // $stmt = $db->prepare(
                                    //     "SELECT `id` , `nname` , `type` , `date`
                                    //     FROM requests 
                                    //     WHERE requests.repeater = ? 
                                    //     UNION 
                                    //     SELECT `id` , `nname` , `type` ,`date`
                                    //     FROM parses 
                                    //     WHERE parses.repeater = ? 
                                    //     ORDER BY `date` ASC"
                                    // );

                                    $stmt = $db->prepare(
                                        "SELECT `id` , `nname` , `type` , `date`
                                        FROM requests 
                                        WHERE requests.repeater = ?"
                                    );

                                    $stmt->execute(array($Id));
                                    $getAll = $stmt->fetchAll();

                                    if (!empty($getAll)) {
                                        foreach ($getAll as $key => $get) { ?>
                                            <option value="<?php echo htmlspecialchars(json_encode(array("id" => $get["id"], "type" => $get["type"]))); ?>"><?php echo "{$get["nname"]} ({$get["type"]})"; ?></option>
                                    <?php }
                                    }  ?>

                                </select>
                            </div>
                        </div>
     

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_status" class=" form-control-label">Status</label>
                                <select name="rp_status" id="rp_status" class="form-control">
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_mode">Mode</label>
                                <select id="rp_mode" name="rp_mode" class="form-control">
                                    <option value="lr">LR</option>
                                    <option value="css">Css</option>
                                    <option value="json">Json</option>
                                    <option value="regex">Regex</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_name" class="control-label mb-1 required">Name</label>
                                <input type="text" name="rp_name" id="rp_name" class="form-control" placeholder="<Nama>" />
                                <small id="rp_nmerr" class="form-text text-danger d-none">Please enter a valid name.</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_nname" class="control-label mb-1 required">Nickname</label>
                                <input type="text" name="rp_nname" id="rp_nname" class="form-control" placeholder="Nickname" />
                                <small id="rp_nnmerr" class="form-text text-danger d-none">Please enter a valid Nickname.</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_index" class="control-label mb-1 required">Index</label>
                                <input type="number" name="rp_index" id="rp_index" class="form-control" placeholder="0" value="0" />
                                <small id="rp_inerr" class="form-text text-danger d-none">Please enter a valid Index.</small>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_lstr" class="control-label mb-1 required">Left String</label>
                                <input type="text" name="rp_lstr" id="rp_lstr" class="form-control" placeholder="Left String" />
                                <small id="rp_lerr" class="form-text text-danger d-none">Please enter a valid Left String.</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_rstr" class="control-label mb-1 required">Right String</label>
                                <input type="text" name="rp_rstr" id="rp_rstr" class="form-control" placeholder="Right String" />
                                <small id="rp_rerr" class="form-text text-danger d-none">Please enter a valid Right String.</small>
                            </div>
                        </div>

                        <input type="hidden" name="rp_id" value="<?php echo $Id ?>" id="rr_id">
                        <input type="hidden" name="rp_do" value="<?php echo $do ?>" id="rp_do">


                        <div class="col-md-6 col-sm-12 mt-1">
                            <button type="submit" id="rp_test" class="btn btn-lg btn-primary btn-block">
                                <span>Test</span>
                            </button>
                        </div>

                        <div class="col-md-6 col-sm-12 mt-1">
                            <button type="submit" id="rp_add" class="btn btn-lg btn-success btn-block">
                                <span>Add</span>
                            </button>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="rp_code" class="control-label mt-2">Code</label>
                                <textarea id="rp_code" name="rp_code" class="form-control" placeholder="Code" rows="6"></textarea>
                                <small id="rp_cerr" class="form-text text-danger d-none">Please enter a valid Text.</small>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_errors" class="control-label mt-2">Errors</label>
                                <textarea id="rp_errors" name="rp_errors" class="form-control" placeholder="Errors" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_result" class="control-label mt-2">Result</label>
                                <textarea id="rp_result" name="rp_result" class="form-control" placeholder="Result" rows="3"></textarea>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>

        <?php } else if ($do == "edit") {

        $count = checkItems("parses", "id");

        if ($count > 0) {
            $get = getItem("parses", "id", $Id);

            if (!empty($get)) {


                breadcrumbs("Repeater", "Edit");

        ?>

                <div class="card">
                    <div class="card-header ">
                        <span style="font-weight: bold;">Edit</span>
                    </div>

                    <div class="card-body">
                        <form id="rparse" method="post">
                            <div class="row">

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_source">Source</label>
                                        <select id="rp_source" name="rp_source" class="form-control">
                                            <?php

                                            $g = isset($_GET["g"]) && is_numeric($_GET["g"]) ? intval($_GET["g"]) : 0;

                                            $stmt = $db->prepare(
                                                "SELECT `id` , `nname` , `type` , `date`
                                                FROM requests 
                                                WHERE requests.repeater = ?"
                                            );

                                            $stmt->execute(array($g));
                                            // $getAll = $stmt->fetchall();
                                            $getAll = $stmt->fetchAll();

                                            if (!empty($getAll)) {
                                                foreach ($getAll as $get2) { ?>
                                                    <option value="<?php echo htmlspecialchars(json_encode(array("id" => $get2["id"], "type" => $get2["type"]))); ?>" <?php echo ($get["source"] != 0 && $get["source"]  == $get2["id"]) ? "selected" : ""; ?>><?php echo "{$get2["nname"]} ({$get2["type"]})"; ?></option>
                                            <?php }
                                            }  ?>


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_mode">Mode</label>
                                        <select id="rp_mode" name="rp_mode" class="form-control">
                                            <option value="lr" <?php echo $get["mode"] == "lr" ? "selected" : ""; ?>>LR</option>
                                            <option value="css" <?php echo $get["mode"] == "css" ? "selected" : ""; ?>>Css</option>
                                            <option value="json" <?php echo $get["mode"] == "json" ? "selected" : ""; ?>>Json</option>
                                            <option value="regex" <?php echo $get["mode"] == "regex" ? "selected" : ""; ?>>Regex</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_status" class=" form-control-label">Status</label>
                                        <select name="rp_status" id="rp_status" class="form-control">
                                            <option value="publish" <?php echo $get["status"] == "pablish" ? "selected" : ""; ?>>Publish</option>
                                            <option value="draft" <?php echo $get["status"] == "draft" ? "selected" : ""; ?>>Draft</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_name" class="control-label mb-1 required">Name</label>
                                        <input type="text" name="rp_name" id="rp_name" class="form-control" placeholder="<Nama>" value="<?php echo $get["name"]; ?>" />
                                        <small id="rp_nmerr" class="form-text text-danger d-none">Please enter a valid name.</small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_nname" class="control-label mb-1 required">Nickname</label>
                                        <input type="text" name="rp_nname" id="rp_nname" class="form-control" placeholder="Nickname" value="<?php echo $get["nname"]; ?>" />
                                        <small id="rp_nnmerr" class="form-text text-danger d-none">Please enter a valid Nickname.</small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_index" class="control-label mb-1 required">Index</label>
                                        <input type="number" name="rp_index" id="rp_index" class="form-control" placeholder="0" value="<?php echo $get["iindex"]; ?>" />
                                        <small id="rp_inerr" class="form-text text-danger d-none">Please enter a valid Index.</small>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_lstr" class="control-label mb-1 required">Left String</label>
                                        <input type="text" name="rp_lstr" id="rp_lstr" class="form-control" placeholder="Left String" value="<?php echo htmlspecialchars($get["lstr"]); ?>" />
                                        <small id="rp_lerr" class="form-text text-danger d-none">Please enter a valid Left String.</small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_rstr" class="control-label mb-1 required">Right String</label>
                                        <input type="text" name="rp_rstr" id="rp_rstr" class="form-control" placeholder="Right String" value="<?php echo htmlspecialchars($get["rstr"]); ?>" />
                                        <small id="rp_rerr" class="form-text text-danger d-none">Please enter a valid Right String.</small>
                                    </div>
                                </div>

                                <input type="hidden" name="rp_id" value="<?php echo $Id ?>" id="rp_id">
                                <input type="hidden" name="rp_do" value="<?php echo $do ?>" id="rp_do">


                                <div class="col-md-6 col-sm-12 mt-1">
                                    <button type="submit" id="rp_test" class="btn btn-lg btn-primary btn-block">
                                        <span>Test</span>
                                    </button>
                                </div>

                                <div class="col-md-6 col-sm-12 mt-1">
                                    <button type="submit" id="rp_edit" class="btn btn-lg btn-success btn-block">
                                        <span>Edit</span>
                                    </button>
                                </div>



                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_code" class="control-label mt-2">Code</label>
                                        <textarea id="rp_code" name="rp_code" class="form-control" placeholder="Code" rows="6"></textarea>
                                        <small id="rp_cerr" class="form-text text-danger d-none">Please enter a valid Text.</small>
                                    </div>
                                </div>


                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_errors" class="control-label mt-2">Errors</label>
                                        <textarea id="rp_errors" name="rp_errors" class="form-control" placeholder="Errors" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_result" class="control-label mt-2">Result</label>
                                        <textarea id="rp_result" name="rp_result" class="form-control" placeholder="Result" rows="3"></textarea>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>

    <?php
            } else {
                header("location:index.php");
            }
        } else {
            header("location:index.php");
        }
    }

    ?>

</div>

<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>


<script>
    $(document).ready(function() {


        $('#rp_code').on("change , keyup , load", function() {
            if ($("#rp_mode").val() == "json" && $(this).val().startsWith("[") && $(this).val().endsWith("]")) $("#rp_index").attr("disabled", false)
            else if ($("#rp_mode").val() == "json") $("#rp_index").attr("disabled", true)
        })

        $('#rp_mode').on("change", function() {

            if ($("#rp_mode").val() == "lr") {
                $("#rp_lstr").siblings("label").text("Left String")
                $("#rp_lstr").attr("placeholder", "Left String")
                $("#rp_rstr").siblings("label").text("Right String")
                $("#rp_rstr").attr("placeholder", "Right String")
                $("#rp_rstr").parent().parent().removeClass("d-none").addClass("d-block")
                $("#rp_lstr").parent().parent().addClass("col-md-6")
            } else if ($("#rp_mode").val() == "css") {
                $("#rp_lstr").siblings("label").text("Selector")
                $("#rp_lstr").attr("placeholder", "Selector [Attribute|Attribute='value']")
                $("#rp_rstr").siblings("label").text("Attribute")
                $("#rp_rstr").attr("placeholder", "Attribute")
                $("#rp_rstr").parent().parent().removeClass("d-none").addClass("d-block")
                $("#rp_lstr").parent().parent().addClass("col-md-6")
            } else if ($("#rp_mode").val() == "json") {
                $("#rp_lstr").siblings("label").text("Fieled Name")
                $("#rp_lstr").attr("placeholder", "Fieled Name ****,***,**")
                $("#rp_rstr").parent().parent().removeClass("d-block").addClass("d-none")
                $("#rp_lstr").parent().parent().removeClass("col-md-6")
            } else if ($("#rp_mode").val() == "regex") {
                $("#rp_lstr").siblings("label").text("Regex")
                $("#rp_lstr").attr("placeholder", "Regex (without /)")
                $("#rp_rstr").parent().parent().removeClass("d-none").addClass("d-block")
                $("#rp_rstr").siblings("label").text("Modifier")
                $("#rp_rstr").attr("placeholder", "Modifier")
            }

            if ($("#rp_mode").val() == "regex") $("#rp_index").attr("disabled", true)
            else if ($("#rp_mode").val() != "regex") $("#rp_index").attr("disabled", false)


        });


        $('#rparse').submit(function(e) {

                e.preventDefault()

                    if ($("#rp_name").val() == null || $("#rp_name").val().trim() == "") {
                        $("#rp_nmerr").removeClass("d-none").addClass("d-block")
                        return
                    } else if ($("#rp_nname").val() == null || $("#rp_nname").val().trim() == "") {
                        $("#rp_nnmerr").removeClass("d-none").addClass("d-block")
                        return

                    } else if ($("#rp_mode").val() != "json" && ($("#rp_index").val() == null || parseInt($("#rp_index").val().trim()) < 0)) {
                        $("#rp_inerr").removeClass("d-none").addClass("d-block")
                        return

                    } else if ($("#rp_mode").val() == "json" && !$("#rp_index").attr("disabled") && ($("#rp_index").val() == null || parseInt($("#rp_index").val().trim()) < 0)) {
                        $("#rp_inerr").removeClass("d-none").addClass("d-block")
                        return

                    } else {

                        $("#rp_nmerr").removeClass("d-block").addClass("d-none")
                        $("#rp_nnmerr").removeClass("d-block").addClass("d-none")
                        $("#rp_qerr").removeClass("d-block").addClass("d-none")
                        $("#rp_inerr").removeClass("d-block").addClass("d-none")


                        if ($("#rp_lstr").val() == null || $("#rp_lstr").val().trim() == "") {
                            $("#rp_lerr").text("Please enter a valid Left String")
                            $("#rp_lerr").removeClass("d-none").addClass("d-block")
                            return
                        } else if (($("#rp_mode").val() == "lr" || $("#rp_mode").val() == "css") && ($("#rp_rstr").val() == null || $("#rp_rstr").val().trim() == "")) {
                            $("#rp_rerr").text("Please enter a valid Right String")
                            $("#rp_rerr").removeClass("d-none").addClass("d-block")
                            return
                        } else {
                            $("#rp_lerr").removeClass("d-block").addClass("d-none")
                            $("#rp_rerr").removeClass("d-block").addClass("d-none")

                            if (e.originalEvent.submitter.id == "rp_test") {

                                try {

                                let source = JSON.parse($("#rp_source").val())
                                let data = request('../controller/index.php' , `ri_do=getData&id=${source["id"]}&type=${source["type"]}`)
                                data = request('../controller/index.php' , `ri_do=repeater&data=${data}`)

                                if (data.includes("</myError>")) {
                                    $("#rp_errors").val(data.substr(10))
                                } else if (data.includes("</myCode>")) {

                                        $("#rp_code").val(data.substr(9))

                                        let parse = myParser($("#rp_mode").val(), data.substr(9), $("#rp_lstr").val().trim(), $("#rp_rstr").val().trim(), $("#rp_index").val().trim())
                                        $("#rp_result").val(parse)

                                } else {
                                    $("#rp_errors").val(data)
                                    alert(data)
                                }

                                $('#rp_add').attr('disabled', null);
                                $('#rp_test').attr('disabled', null);
                            } catch (err) {
                                $("#rp_errors").val(err.message)
                                console.log(err.message)
                                $('#rp_add').attr('disabled', null);
                                $('#rp_test').attr('disabled', null);

                            }










                        } else if (e.originalEvent.submitter.id == "rp_add" || e.originalEvent.submitter.id == "rp_edit") {

                            
                                    try {
                                        let data = request('../controller/parse.php' , $(this).serialize())
                                        let id = parseInt(location.href.split("&").find(id => id.includes("g")).split("=")[1]);
                                        console.log(data)

                                        if (data.includes("Please fill all fields of the mode that you choose")) {
                                            $("#rp_errors").val("Please fill all fields of the mode that you choose")
                                        } else if (data.includes("Somthing Went wrong Please Try Again")) {
                                            $("#rp_errors").val("Somthing Went wrong Please Try Again")
                                        } else if (data.includes("xxx success")) {
                                            location.href = "index.php?do=repeater&id=" + id
                                        } else if (data.includes("</myError>")) {
                                            $("#rp_errors").val(data.substr(10))
                                        } else if (data.includes("</myCode>")) {
                                            $("#rp_code").val(data.substr(9))
                                        } else {
                                            $("#rp_errors").val(data)
                                            alert(data)
                                        }


                                        $('#rp_add').attr('disabled', null);
                                        $('#rp_test').attr('disabled', null);
                                    } catch (err) {
                                        $("#rp_errors").val(err.message)
                                        console.log(err.message)
                                        $('#rp_add').attr('disabled', null);
                                        $('#rp_test').attr('disabled', null);

                                    }


                        } //else if
                    } //else
                } //else


        });



    function request(link,requestData) {
        let mydata
        ajaxCall = $.ajax({
            url: link,
            type: 'POST',
            data: requestData,
            async: false,

            beforeSend: function() {
                $('#rp_test').attr('disabled', 'disabled');
                $('#rp_add').attr('disabled', 'disabled');
            },

            success: function(data) {
                try {

                    mydata = data

                    $('#rp_add').attr('disabled', null);
                    $('#rp_test').attr('disabled', null);
                } catch (err) {
                    mydata = "empty"
                    $("#rp_errors").val(err.message)
                    console.log(err.message)
                    $('#rp_add').attr('disabled', null);
                    $('#rp_test').attr('disabled', null);
                }
            }

        }); //end ajax
        return mydata

    }



    function myParser(mode, code, lstr, rstr, index) {

        if (mode == "lr") {
            function extractText(string, start, end) {
                var str = string.split(start)
                str = str[parseInt(index)].split(end)
                return str[0];
            }
            $("#rp_result").val(extractText(code, $("#rp_lstr").val().trim(), $("#rp_rstr").val().trim()))
            console.log(extractText(code, $("#rp_lstr").val().trim(), $("#rp_rstr").val().trim()))
            return extractText(code, lstr, rstr)

        } else if ($("#rp_mode").val() == "css") {
            var query = document.querySelectorAll($("#rp_lstr").val().trim())[parseInt($("#rp_index").val().trim())]
            $("#rp_result").val(query[$("#rp_rstr").val().trim()])
            console.log(query[$("#rp_rstr").val().trim()])

        } else if ($("#rp_mode").val() == "json") {
            var mycode;
            var query = $("#rp_lstr").val().trim().split(",")
            if (!$("#rp_index").attr("disabled")) {
                mycode = JSON.parse(code)[parseInt($("#rp_index").val().trim())]
            } else {
                mycode = JSON.parse(code)
            }

            query.forEach(v => {
                mycode = code[v]
            });
            $("#rp_result").val(mycode)
            console.log(mycode)


        } else if ($("#rp_mode").val() == "regex") {
            let res
            let str = code
            if ($("#rp_rstr").val().trim() != null && $("#rp_rstr").val().trim() != "") {
                res = new RegExp($("#rp_lstr").val().trim(), $("#rp_rstr").val().trim())
            } else {
                res = new RegExp($("#rp_lstr").val().trim())
            }
            res = str.match(res)

            $("rp_result").val(res)
            console.log(res)
        }

    }



    });
</script>