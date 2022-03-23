<?php
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

<style>
    .multiselect {
        width: 100%;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

    }

    .selectBox {
        position: relative;

    }

    .selectBox select {
        width: 100%;
        font-weight: bold;
    }

    .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;

    }

    #checkboxes {
        display: none;
        border: 1px #dadada solid;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    #checkboxes label {
        display: block;
        padding: 5px;
    }

    #checkboxes input {
        margin-right: 5px;
    }

    #checkboxes label:hover {
        background-color: #1e90ff;
    }
</style>

<!-- Content -->
<div class="container mt-3 mb-3">

    <?php if ($do == "index") {
        breadcrumbs("Request", "Add"); ?>

        <div class="card">
            <div class="card-header ">
                <span style="font-weight: bold;">Add</span>
            </div>

            <div class="card-body">

                <form id="rrequest" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rr_url" class="control-label mb-1 required">Url</label>
                                <input type="text" id="rr_url" name="rr_url" class="form-control" placeholder="http://****************.***/" />
                                <small id="rr_uerr" class="form-text text-danger d-none">Please enter a valid Url.</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rp_status" class=" form-control-label">Status</label>
                                <select name="rr_status" id="rp_status" class="form-control">
                                    <option value="publish">Publish</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 ">
                            <div class="form-group">
                                <label for="rr_method">Method</label>
                                <select id="rr_method" name="rr_method" class="form-control">
                                    <option value="get">Get</option>
                                    <option value="post">Post</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="rr_nname" class="control-label mb-1 required">Nickname</label>
                                <input type="text" name="rr_nname" id="rr_nname" class="form-control" placeholder="Nickname" />
                                <small id="rr_nnmerr" class="form-text text-danger d-none">Please enter a valid Nickname.</small>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="multiselect">
                                    <div class="selectBox">
                                        <select>
                                            <option>Use...</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes">
                                        <label for="cheader">
                                            <input type="checkbox" name="cheader" id="cheader" />Custom Header</label>
                                        <label for="cookies">
                                            <input type="checkbox" name="cookies" id="cookies" />Cookies</label>
                                        <label for="location">
                                            <input type="checkbox" name="location" id="location" />Location</label>
                                        <label for="gheader">
                                            <input type="checkbox" name="gheader" id="gheader" />Get Header</label>
                                        <label for="timeout">
                                            <input type="checkbox" name="timeout" id="timeout" />TimeOut</label>
                                        <label for="pear">
                                            <input type="checkbox" name="pear" id="pear" />SSL VerifyPear</label>
                                        <label for="hos">
                                            <input type="checkbox" name="hos" id="hos" />SSL VerifyHos</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="rr_id" value="<?php echo $Id ?>" id="rr_id">


                        <div class="col-sm-12" style="display: none;">
                            <div class="form-group">
                                <label for="rr_header" class="control-label mt-2">Custom Header</label>
                                <textarea id="rr_header" name="rr_header" class="form-control" placeholder="Custom Header" rows="6"></textarea>
                                <small id="rr_herr" class="form-text text-danger d-none">Please enter a valid Header.</small>
                            </div>
                        </div>

                        <div class="col-sm-12" style="display: none;">
                            <div class="form-group">
                                <label for="rr_out" class="control-label mb-1 required">TimeOut</label>
                                <input type="text" name="rr_out" id="rr_out" class="form-control" placeholder="1000" />
                                <small id="rr_oerr" class="form-text text-danger d-none">Please enter valid Seconds.</small>
                            </div>
                        </div>

                        <div class="col-sm-12" style="display: none;">
                            <div class="form-group">
                                <label for="rr_query" class="control-label mb-1 required">Query</label>
                                <input type="text" name="rr_query" id="rr_query" class="form-control" placeholder="?email=*****&pass=********" />
                                <small id="rr_qerr" class="form-text text-danger d-none">Please enter a valid Url.</small>
                            </div>
                        </div>


                        <form>


                            <div class="col-md-6 col-sm-12 mt-1">
                                <button id="rr_test" class="btn btn-lg btn-primary btn-block">
                                    <span>Test</span>
                                </button>
                            </div>

                            <div class="col-md-6 col-sm-12 mt-1">
                                <button id="rr_add" class="btn btn-lg btn-success btn-block">
                                    <span>Add</span>
                                </button>
                            </div>


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="rr_okay" class="control-label mt-2">Code</label>
                                    <textarea id="rr_okay" class="form-control" placeholder="Code" rows="6"></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="rr_errors" class="control-label mt-2">Errors</label>
                                    <textarea id="rr_errors" name="errors" class="form-control" placeholder="Errors" rows="3"></textarea>
                                </div>
                            </div>


                    </div>

                </form>

            </div>
        </div>
        <?php } else if ($do == "edit") {

        $count = checkItems("requests", "id");

        if ($count > 0) {
            $get = getItem("requests", "id", $Id);

            if (!empty($get)) {


        breadcrumbs("Request", "Edit");


        ?>

            <div class="card">
                <div class="card-header ">
                    <span style="font-weight: bold;">Edit</span>
                </div>

                <div class="card-body">

                    <form id="rrequest" method="post">

                        <div class="row">

                    
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rr_url" class="control-label mb-1 required">Url</label>
                                        <input type="text" id="rr_url" value="<?php echo $get["url"]; ?>" name="rr_url" class="form-control" placeholder="http://****************.***/" />
                                        <small id="rr_uerr" class="form-text text-danger d-none">Please enter a valid Url.</small>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rp_status" class=" form-control-label">Status</label>
                                        <select name="rr_status" id="rp_status" class="form-control">
                                            <option value="publish" <?php echo $get["status"] == "pablish" ? "selected" : ""; ?>>Publish</option>
                                            <option value="draft" <?php echo $get["status"] == "draft" ? "selected" : ""; ?>>Draft</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 ">
                                    <div class="form-group">
                                        <label for="rr_method">Method</label>
                                        <select id="rr_method" name="rr_method" class="form-control">
                                            <option value="get" <?php if ($get["method"] == "get") echo "selected"; ?>>Get</option>
                                            <option value="post" <?php if ($get["method"] == "post") echo "selected"; ?>>Post</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="rr_nname" class="control-label mb-1 required">Nickname</label>
                                        <input type="text" value="<?php echo $get["nname"]; ?>" name="rr_nname" id="rr_nname" class="form-control" placeholder="Nickname" />
                                        <small id="rr_nnmerr" class="form-text text-danger d-none">Please enter a valid Nickname.</small>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="multiselect">
                                            <div class="selectBox">
                                                <select>
                                                    <option>Use...</option>
                                                </select>
                                                <div class="overSelect"></div>
                                            </div>
                                            <div id="checkboxes">
                                                <label for="cheader">
                                                    <input type="checkbox" <?php if ($get["cheader"] == "on") echo "checked"; ?> name="cheader" id="cheader" />Custom Header</label>
                                                <label for="cookies">
                                                    <input type="checkbox" <?php if ($get["cookies"] == "on") echo "checked"; ?> name="cookies" id="cookies" />Cookies</label>
                                                <label for="location">
                                                    <input type="checkbox" <?php if ($get["location"] == "on") echo "checked"; ?> name="location" id="location" />Location</label>
                                                <label for="gheader">
                                                    <input type="checkbox" <?php if ($get["gheader"] == "on") echo "checked"; ?> name="gheader" id="gheader" />Get Header</label>
                                                <label for="timeout">
                                                    <input type="checkbox" <?php if ($get["timeout"] == "on") echo "checked"; ?> name="timeout" id="timeout" />TimeOut</label>
                                                <label for="pear">
                                                    <input type="checkbox" <?php if ($get["pear"] == "on") echo "checked"; ?> name="pear" id="pear" />SSL VerifyPear</label>
                                                <label for="hos">
                                                    <input type="checkbox" <?php if ($get["hos"] == "on") echo "checked"; ?> name="hos" id="hos" />SSL VerifyHos</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="rr_id" value="<?php echo $Id ?>" id="rr_id">
                                <input type="hidden" name="rr_key" value="<?php echo $key ?>" id="rr_key">


                                <div class="col-sm-12" style="display:<?php echo $get["cheader"] == "on" ? "block" : "none"; ?>;">
                                    <div class="form-group">
                                        <label for="rr_header" class="control-label mt-2">Custom Header</label>
                                        <textarea id="rr_header" name="rr_header" class="form-control" placeholder="Custom Header" rows="6"><?php if ($get["cheader"] == "on") echo $get["header"]; ?></textarea>
                                        <small id="rr_herr" class="form-text text-danger d-none">Please enter a valid Header.</small>
                                    </div>
                                </div>

                                <div class="col-sm-12" style="display:<?php echo $get["timeout"] == "on" ? "block" : "none"; ?>;">
                                    <div class="form-group">
                                        <label for="rr_out" class="control-label mb-1 required">TimeOut</label>
                                        <input type="text" value="<?php if ($get["timeout"] == "on") echo $get["out"]; ?>" name="rr_out" id="rr_out" class="form-control" placeholder="1000" />
                                        <small id="rr_oerr" class="form-text text-danger d-none">Please enter valid Seconds.</small>
                                    </div>
                                </div>

                                <div class="col-sm-12" style="display:<?php echo $get["method"] == "post" ? "block" : "none"; ?>;">
                                    <div class="form-group">
                                        <label for="rr_query" class="control-label mb-1 required">Query</label>
                                        <input type="text" value="<?php if ($get["method"] == "post") echo $get["query"]; ?>" name="rr_query" id="rr_query" class="form-control" placeholder="?email=*****&pass=********" />
                                        <small id="rr_qerr" class="form-text text-danger d-none">Please enter a valid Url.</small>
                                    </div>
                                </div>


                                <form>


                                    <div class="col-md-6 col-sm-12 mt-1">
                                        <button id="rr_test" class="btn btn-lg btn-primary btn-block">
                                            <span>Test</span>
                                        </button>
                                    </div>

                                    <div class="col-md-6 col-sm-12 mt-1">
                                        <button id="rr_edit" class="btn btn-lg btn-success btn-block">
                                            <span>Edit</span>
                                        </button>
                                    </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="rr_okay" class="control-label mt-2">Code</label>
                                        <textarea id="rr_okay" class="form-control" placeholder="Code" rows="6"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="rr_errors" class="control-label mt-2">Errors</label>
                                        <textarea id="rr_errors" name="errors" class="form-control" placeholder="Errors" rows="3"></textarea>
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

        $('#cheader').on("change", function() {

            if ($(this).is(':checked') && $("#rr_header").parent().parent().css("display") == "none") {
                $("#rr_header").parent().parent().slideDown()
            } else if (!$(this).is(':checked') && $("#rr_header").parent().parent().css("display") == "block") {
                $("#rr_header").parent().parent().slideUp()
            }
        });

        $('#timeout').on("change", function() {

            if ($(this).is(':checked') && $("#rr_out").parent().parent().css("display") == "none") {
                $("#rr_out").parent().parent().slideDown()
            } else if (!$(this).is(':checked') && $("#rr_out").parent().parent().css("display") == "block") {
                $("#rr_out").parent().parent().slideUp()
            }
        });

        $('#rr_method').on("change", function() {

            if ($(this).val() == "post") {
                $("#rr_query").parent().parent().slideDown()
            } else if ($(this).val() == "get") {
                $("#rr_query").parent().parent().slideUp()
            }
        });





        $("#rrequest").submit(function(e) {
            // custom handling here
            e.preventDefault();
            if ($("#rr_url").val() == null || $("#rr_url").val().trim() == "") {
                $("#rr_uerr").removeClass("d-none").addClass("d-block")
                return
            } else if (($("#rr_nname").val() == null || $("#rr_nname").val().trim() == "")) {
                $("#rr_nnmerr").removeClass("d-none").addClass("d-block")
                return

            } else if ($("#rr_header").parent().parent().css("display") == "block" && ($("#rr_header").val() == null || $("#rr_header").val().trim() == "")) {
                $("#rr_herr").removeClass("d-none").addClass("d-block")
                return

            } else if ($("#rr_out").parent().parent().css("display") == "block" && ($("#rr_out").val() == null || parseInt($("#rr_out").val().trim()) < 10)) {
                $("#rr_oerr").removeClass("d-none").addClass("d-block")
                return

            } else if ($("#rr_query").parent().parent().css("display") == "block" && ($("#rr_query").val() == null || $("#rr_query").val().trim() == "")) {
                $("#rr_qerr").removeClass("d-none").addClass("d-block")
                return
            } else {
                $("#rr_uerr").removeClass("d-block").addClass("d-none")
                $("#rr_nnmerr").removeClass("d-block").addClass("d-none")
                $("#rr_herr").removeClass("d-block").addClass("d-none")
                $("#rr_oerr").removeClass("d-block").addClass("d-none")
                $("#rr_qerr").removeClass("d-block").addClass("d-none")

                ajaxCall = $.ajax({
                    url: '../controller/request.php',
                    type: 'POST',
                    data: $(this).serialize() + "&rr_do=" + e.originalEvent.submitter.id,

                    beforeSend: function() {
                        $('#rr_test').attr('disabled', 'disabled');
                        $('#rr_add').attr('disabled', 'disabled');
                    },

                    success: function(data) {

                        console.log(data)
                        try {
                            let id = parseInt(location.href.split("&").find(id => id.includes("g")).split("=")[1]);


                            if (data.includes("Please fill all fields of the mode that you choose")) {
                                $("#rr_errors").val("Please fill all fields of the mode that you choose")
                            } else if (data.includes("Somthing Went wrong Please Try Again")) {
                                $("#rr_errors").val("Somthing Went wrong Please Try Again")
                            } else if (data.includes("</myError>")) {
                                $("#rr_errors").val(data.substr(10))
                            } else if (data.includes("xxx success")) {
                                location.href = "index.php?do=repeater&id=" + id
                            } else if (data.includes("</myCode>")) {
                                document.getElementById("rr_okay").innerHTML = data.substr(9)
                            } else {
                                $("#rr_errors").val(data)
                                alert(data)
                            }

                            $('#rr_add').attr('disabled', null);
                            $('#rr_test').attr('disabled', null);
                        } catch (err) {
                            $("#rr_errors").val(err.message)
                            alert(err.message)
                        }
                    }

                }); //end ajax

            }

        }); //end onclick



        var expanded = false;

        $(".selectBox").click(e => {
            var checkboxes = $("#checkboxes")
            if (!expanded) {
                checkboxes.slideDown()


                expanded = true;
            } else {
                checkboxes.slideUp()


                expanded = false;
            }
        })



    });
</script>