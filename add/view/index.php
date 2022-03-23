<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "proxy checker";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

$do = isset($_GET["do"]) ? $_GET["do"] : "index";
$Id = isset($_GET["id"]) && is_numeric($_GET["id"]) ? intval($_GET["id"]) : 0;
$name = isset($_GET["name"]) ? $_GET["name"] : "empty";

?>
<!-- Content -->
<div class="container mt-3 mb-3">


    <?php if ($do == "index") {
        breadcrumbs("Repeaters", "Repeaters");

        $sort = "ASC";
        $arr_sort = array("DESC", "ASC");

        if (isset($_GET["sort"]) && in_array($_GET["sort"], $arr_sort)) {

            $sort = $_GET["sort"];
        }

        $count = checkItems("repeaters", "id");

        if ($count > 0) {
            $stmt = $db->prepare("SELECT `id`, `type`, `name`, `description` FROM `repeaters` ORDER BY `id` {$sort}");
            $stmt->execute();
            $getAll = $stmt->fetchAll();

            if (!empty($getAll)) {

    ?>

                <div class="card">
                    <div class="card-header ">
                        <span style="font-weight: bold;">Mailer </span>

                        <span style="float: right;"> <a href=""> <a href=""></a></a>
                            <a style="<?php if (isset($_GET["sort"])  && $_GET["sort"] == "ASC") {
                                            echo "font-weight: bold;color:black;";
                                        } else {
                                            echo "font-weight: 400;color:#6c757d;";
                                        } ?> ?>" href="?sort=ASC">Asc</a><span> / </span>
                            <a style="<?php if (isset($_GET["sort"])  && $_GET["sort"] == "DESC") {
                                            echo "font-weight: bold;color:black;";
                                        } else {
                                            echo "font-weight: 400;color:#6c757d;";
                                        } ?> ?>" href="?sort=DESC">Desc</a>
                        </span>

                    </div>

                    <div class="card-body">

                        <form id="rindex" method="post">
                            <div class="row">

                                <?php
                                $counter = 1;
                                foreach ($getAll as $get) {
                                ?> <?php


                                    $description = $get["description"];
                                    $description = $description != "empty" ? $description : "";
                                    $description = strlen($description) < 15 ? $description : substr($description, 0, 15) . "..";

                                    ?>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="card">
                                                <div class="card-body d-flex justify-content-around">
                                                    <h5 class="card-title">#<?php echo $counter; ?></h5>
                                                    <h5 class="card-title"><?php echo $get["id"]; ?></h5>
                                                    <h5 class="card-title"><?php echo $get["name"]; ?></h5>
                                                    <h5 class="card-title"><?php echo $description; ?></h5>
                                                    <button><a href="?do=edit&id=<?php echo $get["id"]; ?>"><i class="fas fa-edit fa-lg"></i></a></button>
                                                    <button type="button" class="confirm"><a href="?do=delete&type=<?php echo "{$get["type"]}"; ?>s&id=<?php echo $get["id"]; ?>"><i class="fas fa-trash-alt"></i></a></button>
                                                    <button type="button" class="confirm"><a href="?do=duplicate&type=<?php echo "{$get["type"]}"; ?>s&id=<?php echo $get["id"]; ?>"><i class="fas fa-clone"></i></a></button>
                                                    <button type="button"><a href="?do=repeater&id=<?php echo $get["id"]; ?>&name=<?php echo $get["name"]; ?>"><i class="fas fa-list"></i></a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <?php $counter++;
                                }  ?>

                                <div class="col-sm-12 mt-1">
                                    <button type="button" id="ri_newadd" class="btn btn-lg btn-primary btn-block">
                                        <span>Add</span>
                                    </button>
                                </div>

                            </div>
                        </form>

                <?php } else {
                btnAdd("Add New Repeater");
            }
        } else {
            btnAdd("Add New Repeater");
        } ?>





                    </div>
                </div>

            <?php

        } else if ($do == "repeater") {


            breadcrumbs("Repeater", "Repeater");

            ?>

                <div class="card">
                    <div class="card-header ">
                        <span style="font-weight: bold;"><?php echo $name; ?></span>
                    </div>

                    <div class="card-body">

                        <form id="rindex" method="post">

                            <div class="row">

                                <?php

                                $count = checkItem("repeaters", "id", $Id);

                                if ($count > 0) {

                                    $stmt = $db->prepare(
                                        "SELECT `id` , `nname` , `type` , `date`
                                        FROM requests 
                                        WHERE requests.repeater = ? 
                                        UNION 
                                        SELECT `id` , `nname` , `type` ,`date`
                                        FROM parses 
                                        WHERE parses.repeater = ? 
                                        ORDER BY `date` ASC"
                                                    );

                                    $stmt->execute(array($Id, $Id));
                                    // $getAll = $stmt->fetchall();
                                    $getAll = $stmt->fetchAll();

                                    if (!empty($getAll)) {



                                ?>

                                        <?php

                                        foreach ($getAll as $key => $get) {
                                            $counter = 1;


                                        ?>

                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="card">
                                                        <div class="card-body d-flex justify-content-around">
                                                            <h5 class="card-title">#<?php echo $counter; ?></h5>
                                                            <h5 class="card-title"><?php echo "{$get["nname"]} ({$get["type"]})"; ?></h5>
                                                            <button type="button"><a href="<?php echo "{$get["type"]}"; ?>.php?do=edit&id=<?php echo $get["id"]; ?>&g=<?php echo $Id; ?>"><i class="fas fa-edit fa-lg"></i></a></button>
                                                            <button type="button" class="confirm"><a href="?do=delete&type=<?php echo "{$get["type"]}"; ?>s&id=<?php echo $get["id"]; ?>"><i class="fas fa-trash-alt"></i></a></button>
                                                            <button type="button" class="confirm"><a href="?do=duplicate&type=<?php echo "{$get["type"]}"; ?>s&id=<?php echo $get["id"]; ?>"><i class="fas fa-clone"></i></a></button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                <?php $counter++;
                                        }
                                    }
                                }

                                ?>


                                <div class="col-sm-12">
                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <label for="mode">Mode</label>
                                                <select id="mode" name="mode" class="form-control"> 
                                                    <option value="request">Request</option>
                                                    <?php 
                                                        $count = checkItem("requests", "repeater" , $Id);
                                                        if ($count > 0 && $Id != 0) {
                                                            echo '<option value="parse">Parse</option>' ;
                                                        } ?>
                                                        <?php 
                                                        $count2 = checkItem("functions", "repeater" , $Id);
                                                        if ($count2 > 0 && $Id != 0) {
                                                            echo '<option value="function">Function</option>' ;
                                                        } ?>

                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="ri_do" value="<?php echo $do ?>" id="ri_do">


                                        <div class="col-md-4 col-sm-12 mt-1">
                                            <button type="submit" id="ri_add" class="btn btn-lg btn-primary btn-block">
                                                <span>Add</span>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-sm-12 mt-1">
                                            <button type="button" id="ri_start" class="btn btn-lg btn-success btn-block">
                                                <span>Start</span>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-sm-12 mt-1">
                                            <button type="button" id="ri_cancel" class="btn btn-lg btn-warning btn-block">
                                                <span>Cancel</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                                <input type="hidden" name="ri_do" value="<?php echo $do ?>" id="ri_do">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="ri_result" class="control-label mt-2">Result</label>
                                        <textarea id="ri_result" name="ri_result" class="form-control" placeholder="Result" rows="6"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="ri_errors" class="control-label mt-2">Errors</label>
                                        <textarea id="ri_errors" name="ri_errors" class="form-control" placeholder="Errors" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>



                        </form>

                    </div>
                </div>


                <?php


            } else if ($do == "edit") {



                $count = checkItem("repeaters", "id", $Id);

                if ($count > 0 && $Id != 0) {
                    $get = getItem("repeaters", "id", $Id);

                    if (!empty($get)) {
                        breadcrumbs("Repeaters", "Edit");

                ?>

                        <div class="card">
                            <div class="card-header ">
                                <span style="font-weight: bold;">Edit</span>
                            </div>

                            <div class="card-body">

                                <form id="rindex" method="post">

                                    <div class="row">



                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="ri_name" class="control-label mb-1 required">Name</label>
                                                <input type="text" name="ri_name" id="ri_name" value="<?php echo $get["name"]; ?>" class="form-control" placeholder="Name" />
                                                <small id="ri_nmerr" class="form-text text-danger d-none">Please enter a valid name.</small>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="ri_description" class="control-label mt-2">description</label>
                                                <textarea id="ri_description" name="ri_description" class="form-control" placeholder="description" rows="3"><?php echo $get["description"] != "empty" ? $get["description"] : ""; ?></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="ri_do" value="<?php echo $do ?>" id="ri_do">
                                        <input type="hidden" name="ri_id" value="<?php echo $Id ?>" id="ri_id">

                                        <div class="col-md-6 col-sm-12 mt-1">
                                            <button type="submit" id="ri_edit" class="btn btn-lg btn-success btn-block">
                                                <span>Edit</span>
                                            </button>
                                        </div>

                                        <div class="col-md-6 col-sm-12 mt-1">
                                            <button type="button" id="ri_cancel" class="btn btn-lg btn-warning btn-block">
                                                <span>Cancel</span>
                                            </button>
                                        </div>

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
            } else if ($do == "add") {

                breadcrumbs("Repeater", "Add"); ?>

<div class="card">
    <div class="card-header ">
        <span style="font-weight: bold;">Add</span>
    </div>

    <div class="card-body">

        <form id="rindex" method="post">

            <div class="row">



                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="ri_name" class="control-label mb-1 required">Name</label>
                        <input type="text" name="ri_name" id="ri_name" class="form-control" placeholder="Name" />
                        <small id="ri_nmerr" class="form-text text-danger d-none">Please enter a valid name.</small>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="ri_description" class="control-label mt-2">description</label>
                        <textarea id="ri_description" name="ri_description" class="form-control" placeholder="description" rows="3"></textarea>
                    </div>
                </div>

                <input type="hidden" name="ri_do" value="<?php echo $do ?>" id="ri_do">

                <div class="col-md-6 col-sm-12 mt-1">
                    <button type="submit" id="ri_add" class="btn btn-lg btn-success btn-block">
                        <span>Add</span>
                    </button>
                </div>

                <div class="col-md-6 col-sm-12 mt-1">
                    <button type="button" id="ri_cancel" class="btn btn-lg btn-warning btn-block">
                        <span>Cancel</span>
                    </button>
                </div>



            </div>
    </div>

</div>

</form>

</div>
</div>

<?php

            }
?>


</div>

<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>


<script>
    $(document).ready(function() {

        //  $('#stop').attr('disabled', true);

        //$('#start').click(function() {
        // $("#rcheck").submit(function(e) {
        //     // custom handling here
        //     e.preventDefault();
        //     if ($("#mode").val() == "parse") {
        //         localStorage.setItem("results", JSON.stringify({
        //             result: $("#result").val()
        //         }));
        //         location.href = "parse.php"
        //     } else if ($("#mode").val() == "function") {
        //         localStorage.setItem("results", JSON.stringify({
        //             result: $("#result").val()
        //         }));
        //         location.href = "function.php"
        //     } else if ($("#mode").val() == "request") {
        //         location.href = "request.php"
        //     }

        // }); //end onclick

        // $("#result").change(e => localStorage.setItem("results", JSON.stringify({
        //     result: $("#result").val()
        // })))

        $("#rindex").submit(e => {
            e.preventDefault()





            if ($("#ri_do").val() == "repeater") {


                try {
                    let id = parseInt(location.href.split("&").find(id => id.includes("id")).split("=")[1]);

                    if ($("#mode").val() == "parse") {
                        location.href = "parse.php?id=" + id + "&g=" + id
                    } else if ($("#mode").val() == "function") {
                        location.href = "function.php"
                    } else if ($("#mode").val() == "request") {
                        location.href = "request.php?id=" + id + "&g=" + id
                    }


                } catch (err) {
                    ("#ri_errors").val(err.message)
                    alert(err.message)

                }
            }









            if ($("#ri_do").val() == "add" || $("#ri_do").val() == "edit") {

                if ($("#ri_name").val() == null || $("#ri_name").val().trim() == "") {
                    $("#ri_nmerr").removeClass("d-none").addClass("d-block")
                    return
                } else {

                    $("#ri_nmerr").removeClass("d-block").addClass("d-none")

                    try {

                        ajaxCall = $.ajax({
                            url: '../controller/index.php',
                            type: 'POST',
                            data: $("#rindex").serialize(),
                            async: false,

                            success: function(data) {
                                try {
                                    console.log(data)
                                    if (data.includes("Please enter a valid name.")) {
                                        $("#ri_nmerr").removeClass("d-none").addClass("d-block")
                                    } else if (data.includes("Somthing Went wrong Please Try Again")) {
                                        alert("Somthing Went wrong Please Try Again")
                                    } else if (data.includes("xxx success")) {
                                        window.location.href = "index.php?do=index"
                                    } else {
                                        alert(data)
                                    }
                                } catch (err) {
                                    alert(err.message)
                                    window.location.href = "index.php?do=index"
                                }
                            }

                        }); //end ajax
                    } catch (err) {
                        alert(err.message)
                        window.location.href = "index.php?do=index"
                    }
                }
            }

        })




        if (location.href.includes("do=delete") || location.href.includes("do=duplicate")) {

            try {

                let id = parseInt(location.href.split("&").find(id => id.includes("id")).split("=")[1]);
                let did = location.href.split("&").find(id => id.includes("do")).split("=")[1];
                let type = location.href.split("&").find(id => id.includes("type")).split("=")[1];

                if (id > -1) {
                    ajaxCall = $.ajax({
                        url: '../controller/index.php',
                        type: 'POST',
                        data: "ri_id=" + id + "&ri_do=" + did + "&type=" + type,
                        async: false,

                        success: function(data) {
                            console.log(data)
                            if (data.includes("Somthing Went wrong Please Try Again")) {
                                alert("Somthing Went wrong Please Try Again")
                                window.location.href = "index.php?do=index"
                            } else if (data.includes("xxx success")) {
                                window.location.href = "index.php?do=index"
                            } else {
                                alert(data)
                                window.location.href = "index.php?do=index"
                            }

                        }

                    });
                } else {
                    window.location.href = "index.php?do=index"
                }
            } catch (err) {
                alert(err.message)
                window.location.href = "index.php?do=index"
            }
        }







        $(".confirm").click(function() {
            return confirm("Ara YOU Sure");
        });

        $("#ri_newadd").click(() => {
            window.location.href = "?do=add"
        })

        $("#ri_cancel").click(() => {
            window.location.href = "?do=index"
        })





        $('#ri_start').click(function() {

            try {

                if ($("#ri_data").val().trim() != null || $("#ri_data").val().trim() != "") {
                    let list = JSON.parse($("#ri_data").val().trim())


                    for (var i = 0; i < list.length; i++) {

                        if (list[i]["mode"] == "request") {
                            // ajaxCall = $.ajax({
                            //     url: '../controller/index.php',
                            //     type: 'POST',
                            //     data: "ri_do=repeater&data=" + JSON.stringify(list[i]),
                            //     async: false,

                            //     beforeSend: function() {
                            //         $('#ri_start').attr('disabled', 'disabled');
                            //         $('#ri_add').attr('disabled', 'disabled');

                            //     },

                            //     success: function(data) {
                            //     console.log(data.substr(0 , 100))

                            //     if (data.includes("</myError>")) {
                            //         $("#ri_errors").val(data.substr(10))
                            //     } else if (data.includes("</myCode>")) {
                            //         document.getElementById("ri_result").innerHTML = data.substr(9)
                            //     } else {
                            //         $("#rr_errors").val(data)
                            //         alert(data)
                            //     }

                            //     }

                            // }); //end ajax
                        } else if (list[i]["mode"] == "function") {



                            // console.log(results + " !")
                            // results = results.concat("test")

                            // $("#result").val(results)
                            // console.log(results + " !")


                        } else if (list[i]["mode"] == "parse") {
                            if (list[i]["data"]["source"] == "" || list[i]["data"]["source"] == null) {
                                continue;
                            }


                            ajaxCall = $.ajax({
                                url: '../controller/index.php',
                                type: 'POST',
                                data: "ri_do=repeater&data=" + list[i]["data"]["source"],
                                async: false,

                                beforeSend: function() {
                                    $('#ri_test').attr('disabled', 'disabled');
                                    $('#ri_add').attr('disabled', 'disabled');
                                },

                                success: function(data) {

                                    console.log(data)
                                    try {

                                        if (data.includes("</myError>")) {
                                            $("#ri_errors").val(data.substr(10))
                                        } else if (data.includes("</myCode>")) {

                                            document.getElementById("ri_result").innerHTML = data.substr(9)

                                            if (list[i]["data"]["mode"] == "lr") {
                                                function extractText(string, start, end) {
                                                    var str = string.split(start)
                                                    str = str[parseInt(list[i]["data"]["index"])].split(end)
                                                    return str[0];
                                                }
                                                $("#ri_result").val(extractText(data.substr(9), list[i]["data"]["lstr"], list[i]["data"]["rstr"]))
                                                console.log(extractText(data.substr(9), list[i]["data"]["lstr"], list[i]["data"]["rstr"]))

                                            } else if (list[i]["data"]["mode"] == "css") {
                                                var query = document.querySelectorAll(list[i]["data"]["lstr"])[parseInt(list[i]["data"]["index"])]
                                                $("#ri_result").val(query[list[i]["data"]["rstr"]])
                                                console.log(query[$("#rp_rstr").val().trim()])

                                            } else if (list[i]["data"]["mode"] == "json") {
                                                var code;
                                                var query = list[i]["data"]["lstr"].split(",")
                                                if (list[i]["data"]["index"] != -1) {
                                                    code = JSON.parse(data.substr(9))[parseInt(list[i]["data"]["index"])]
                                                } else {
                                                    code = JSON.parse(data.substr(9))
                                                }

                                                query.forEach(v => {
                                                    code = code[v]
                                                });
                                                $("#ri_result").val(code)
                                                console.log(code)


                                            } else if ($("#rp_mode").val() == "regex") {
                                                let res
                                                let str = data.substr(9)
                                                if (list[i]["data"]["rstr"] != null && list[i]["data"]["rstr"] != "") {
                                                    res = new RegExp(list[i]["data"]["lstr"], list[i]["data"]["rstr"])
                                                } else {
                                                    res = new RegExp(list[i]["data"]["lstr"])
                                                }
                                                res = str.match(res)


                                                $("#ri_result").val(res)
                                                console.log(res)
                                            }



                                        } else {
                                            $("#ri_errors").val(data)
                                            alert(data)
                                        }

                                        $('#ri_add').attr('disabled', null);
                                        $('#ri_test').attr('disabled', null);
                                    } catch (err) {
                                        $("#ri_errors").val(err.message)
                                        console.log(err.message)
                                        $('#ri_add').attr('disabled', null);
                                        $('#ri_test').attr('disabled', null);

                                    }


                                }

                            }); //end ajax




















                            // if (list[i]["data"]["mode"] == "lr") {


                            //     function extractText(string, start, end) {
                            //         var str = string.split(start)
                            //         str = str[list[i]["data"]["index"]].split(end)
                            //         return str[0];
                            //     }


                            //         // results = extractText(results, list[i]["data"]["lstr"], list[i]["data"]["rstr"])
                            //         // $("#ri_result").val(results)
                            //         // console.log(results)



                            // } else if (list[i]["data"]["mode"] == "css") {




                            //         // var query = document.querySelectorAll(list[i]["data"]["lstr"])[list[i]["data"]["index"]]
                            //         // $("#ri_result").val(query[list[i]["data"]["rstr"]])
                            //         // console.log(query[list[i]["data"]["rstr"]])



                            // } else if (list[i]["data"]["mode"] == "json") {



                            //         // var code;
                            //         // var query = list[i]["data"]["lstr"].split(",")
                            //         // if (parseInt(list[i]["data"]["index"]) > -1 && arseInt(list[i]["data"]["index"]) != null) {
                            //         //     code = JSON.parse($("#ri_result").val().trim())[list[i]["data"]["index"]]
                            //         // } else {
                            //         //     code = JSON.parse($("#ri_result").val().trim())
                            //         // }

                            //         // query.forEach(v => {
                            //         //     code = code[v]
                            //         // });
                            //         // $("#ri_result").val(code)
                            //         // console.log(code)


                            // } else if (list[i]["data"]["mode"] == "regex") {





                            //         // let res
                            //         // let str = $("#code").val().trim()
                            //         // if (list[i]["data"]["rstr"] != null && list[i]["data"]["rstr"] != "") {
                            //         //     res = new RegExp(list[i]["data"]["lstr"], list[i]["data"]["rstr"])
                            //         // } else {
                            //         //     res = new RegExp(list[i]["data"]["lstr"])
                            //         // }
                            //         // res = str.match(res)

                            //         // $("#result").val(res)
                            //         // console.log(res)

                            // }


                        }

                        if (list.length == (i + 1)) {
                            $('#ri_start').attr('disabled', null);
                            $('#ri_add').attr('disabled', null);
                            break
                        }

                    } //for


                } else {
                    ("#ri_errors").val("Somthing Went wrong Please Try Again")
                    alert("Somthing Went wrong Please Try Again")
                } //else

            } catch (err) {
                $("#ri_errors").val(err.message)
                console.log(err.message)

            } //catch


        });

    });
</script>