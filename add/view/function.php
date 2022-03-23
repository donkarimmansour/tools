<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "function";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";


?>
<!-- Content -->
<div class="container mt-3 mb-3">
    <?php breadcrumbs("Repeater", "Parse"); ?>
    <div class="card">
        <div class="card-header ">
            <span style="font-weight: bold;">Parse</span>
        </div>

        <div class="card-body">
            <form id="rfun" method="post">
                <div class="row">



                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="function">Function</label>
                            <select id="function" name="function" class="form-control">
                                <option value="length">Length</option>
                                <option value="delay">Delay</option>
                                <option value="rnd">Random</option>
                                <option value="rplc">Replace</option>
                                <option value="rndall">ReplaceAll</option>
                                <option value="ue">UrlEncode</option>
                                <option value="ud">UrlDecode</option>
                                <option value="be">Base64Encode</option>
                                <option value="bd">Base64Decode</option>
                                <option value="substr">SubStr</option>
                                <option value="substing">SubString</option>
                                <option value="trim">Trim</option>
                                <option value="strim">TrimStart</option>
                                <option value="ltrim">TrimEnd</option>
                                <option value="lc">ToLowerCase</option>
                                <option value="uc">ToUpperCase</option>
                                <option value="indexof">IndexOf</option>
                                <option value="lindexof">LastIndexOf</option>
                                <option value="charat">CharAt</option>
                                <option value="ccharat">CharCodeAt</option>
                                <option value="rnd">FromCharCode</option>
                                <option value="tosting">ToString</option>
                                <option value="toint">ParseInt</option>
                                <option value="startswith">StartsWith</option>
                                <option value="endswith">EndsWith</option>
                                <option value="jts">JsonToString</option>
                                <option value="stj">StringToJson</option>
                                <option value="isint">IsInteger</option>
                                <option value="istring">IsString</option>
                                <option value="isnan">IsNaN</option>
                                <option value="ceil">Ceil</option>
                                <option value="floor">Floor</option>
                                <option value="round">Round</option>
                                <option value="concat">Concat</option>
                                <option value="repeat">Repeat</option>
                                <option value="valueof">ValueOf</option>
                                <option value="split">Split</option>
                                <option value="slice">Slice</option>
                                <option value="includes">Includes</option>
                                <option value="compare">LocaleCompare</option>
                                <option value="match">Match</option>
                                <option value="search">Search</option>

                            </select>
                        </div>
                    </div>

                    <!-- var encodedStringBtoA = btoa(decodedStringBtoA);
                    console.log(encodedStringBtoA);
                    var encodedStringAtoB = 'SGVsbG8gV29ybGQh';

                    // Decode the String
                    var decodedStringAtoB = atob(encodedStringAtoB);
                    console.log(decodedStringAtoB); -->

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="name" class="control-label mb-1 required">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="<Nama>" />
                            <small id="nmerr" class="form-text text-danger d-none">Please enter a valid name.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nname" class="control-label mb-1 required">Nickname</label>
                            <input type="text" name="nname" id="nname" class="form-control" placeholder="Nickname" />
                            <small id="nnmerr" class="form-text text-danger d-none">Please enter a valid Nickname.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="first" class="control-label mb-1 required">first</label>
                            <input type="text" name="first" id="first" class="form-control" placeholder="text" />
                            <small id="firsterr" class="form-text text-danger d-none">Please enter a valid first.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="second" class="control-label mb-1 required">second</label>
                            <input type="text" name="second" id="second" class="form-control" placeholder="text" />
                            <small id="seconderr" class="form-text text-danger d-none">Please enter a valid second.</small>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="three" class="control-label mb-1 required">three</label>
                            <input type="text" name="three" id="three" class="form-control" placeholder="text" />
                            <small id="threeerr" class="form-text text-danger d-none">Please enter a valid three.</small>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-1 text-center" style="display: none;">
                        <p style="font-weight: 900;font-size: 14px;" id="note">note</p>
                    </div>


                    <div class="col-md-6 col-sm-12 mt-1">
                        <button type="button" id="test" class="btn btn-lg btn-primary btn-block">
                            <span>Test</span>
                        </button>
                    </div>

                    <div class="col-md-6 col-sm-12 mt-1">
                        <button type="submit" id="add" class="btn btn-lg btn-success btn-block">
                            <span>Add</span>
                        </button>
                    </div>




                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="errors" class="control-label mt-2">Errors</label>
                            <textarea id="errors" name="errors" class="form-control" placeholder="Errors" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="result" class="control-label mt-2">Result</label>
                            <textarea id="result" name="result" class="form-control" placeholder="Result" rows="3"></textarea>
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


        $('#function').on("change", function() {

            if ($("#function").val() == "rnd") {
                $("#first").siblings("label").text("String")
                $("#first").attr("placeholder", "String")
                $("#note").text("?l = LowerCase , ?u = UpperCase , ?d = Digit , ?s = Sympol")
                $("#note").parent().removeClass("d-none").addClass("d-block")
            } else if ($("#function").val() == "rplc") {
                $("#first").siblings("label").text("Replace")
                $("#first").attr("placeholder", "Replace")
                $("#second").siblings("label").text("With")
                $("#second").attr("placeholder", "With")
                // $("#note").text("?l = LowerCase , ?u = UpperCase , ?d = Digit , ?s = Sympol")
                $("#note").parent().removeClass("d-block").addClass("d-none")
            } else if ($("#function").val() == "rplc") {
                $("#first").siblings("label").text("Replace")
                $("#first").attr("placeholder", "Replace")
                $("#second").siblings("label").text("With")
                $("#second").attr("placeholder", "With")
                // $("#note").text("?l = LowerCase , ?u = UpperCase , ?d = Digit , ?s = Sympol")
                $("#note").parent().removeClass("d-block").addClass("d-none")
            }
            // } else if ($("#mode").val() == "css") {
            //     $("#lstr").siblings("label").text("Selector")
            //     $("#lstr").attr("placeholder", "Selector [Attribute|Attribute='value']")
            //     $("#rstr").siblings("label").text("Attribute")
            //     $("#rstr").attr("placeholder", "Attribute")
            //     $("#rstr").parent().parent().removeClass("d-none").addClass("d-block")
            //     $("#lstr").parent().parent().addClass("col-md-6")
            // } else if ($("#mode").val() == "json") {
            //     $("#lstr").siblings("label").text("Fieled Name")
            //     $("#lstr").attr("placeholder", "Fieled Name ****,***,**")
            //     $("#rstr").parent().parent().removeClass("d-block").addClass("d-none")
            //     $("#lstr").parent().parent().removeClass("col-md-6")
            // } else if ($("#mode").val() == "regex") {
            //     $("#lstr").siblings("label").text("Regex")
            //     $("#lstr").attr("placeholder", "Regex (without /)")
            //     $("#rstr").parent().parent().removeClass("d-none").addClass("d-block")
            //     $("#rstr").siblings("label").text("Modifier")
            //     $("#rstr").attr("placeholder", "Modifier")



        });


        $('#test').click(function() {

            if ($("#name").val() == null || $("#name").val().trim() == "") {
                $("#nmerr").removeClass("d-none").addClass("d-block")
                return
            } else if ($("#nname").val() == null || $("#nname").val().trim() == "") {
                $("#nnmerr").removeClass("d-none").addClass("d-block")
                return

            } else {

                $("#nmerr").removeClass("d-block").addClass("d-none")
                $("#nnmerr").removeClass("d-block").addClass("d-none")


                if ($("#function").val() == "rnd" || $("#function").val() == "concat") {
                    if ($("#first").val() == null || $("#first").val().trim() == "") {
                        $("#firsterr").text("Please enter a valid String")
                        $("#firsterr").removeClass("d-none").addClass("d-block")
                        return
                    } else {
                        $("#firsterr").removeClass("d-none").addClass("d-none")
                        try {

                            if ($("#function").val() == "rnd") {
                                let inpt = $("#first").val().trim()
                                var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
                                var Bigcharacters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                var Smaillcharacters = 'abcdefghijklmnopqrstuvwxyz';
                                var Numbers = '0123456789';
                                inpt = inpt.replaceAll("?l", Smaillcharacters.charAt(Math.floor(Math.random() * 26)))
                                inpt = inpt.replaceAll("?u", Bigcharacters.charAt(Math.floor(Math.random() * 26)))
                                inpt = inpt.replaceAll("?d", Numbers.charAt(Math.floor(Math.random() * 10)))
                                inpt = inpt.replaceAll("?s", specialChars.charAt(Math.floor(Math.random() * 27)))

                                $("#result").val(inpt)
                                console.log(inpt)
                            } else if ($("#function").val() == "concat") {
                                let inpt = $("#first").val().trim()

                                $("#result").val(inpt)
                                console.log(inpt)
                            }
                        } catch (err) {
                            $("#errors").val(err.message)
                            console.log(err.message)

                        }

                    }
                } else if ($("#function").val() == "rplc") {
                    if ($("#first").val() == null || $("#first").val().trim() == "") {
                        $("#firsterr").text("Please enter a valid String")
                        $("#firsterr").removeClass("d-none").addClass("d-block")
                        return
                    } else if ($("#second").val() == null || $("#second").val().trim() == "") {
                        $("#seconderr").text("Please enter a valid String")
                        $("#seconderr").removeClass("d-none").addClass("d-block")
                        return
                    } else {
                        $("#seconderr").removeClass("d-none").addClass("d-none")
                        $("#firsterr").removeClass("d-none").addClass("d-none")
                        try {
                            let inpt = $("#first").val().trim()
                            let inpt2 = $("#second").val().trim()


                            $("#result").val(inpt)
                            console.log(inpt)
                        } catch (err) {
                            $("#errors").val(err.message)
                            console.log(err.message)

                        }

                    }


                }

            }

        });


        $('#rfun').click(function(e) {
            e.preventDefault()

            if ($("#name").val() == null || $("#name").val().trim() == "") {
                $("#nmerr").removeClass("d-none").addClass("d-block")
                return
            } else if ($("#nname").val() == null || $("#nname").val().trim() == "") {
                $("#nnmerr").removeClass("d-none").addClass("d-block")
                return

            } else {

                $("#nmerr").removeClass("d-block").addClass("d-none")
                $("#nnmerr").removeClass("d-block").addClass("d-none")


                try {

                                  ajaxCall = $.ajax({
                                    url: '../controller/function.php',
                                    type: 'POST',
                                    data: $('#rparse').serialize(),

                                    beforeSend: function() {
                                        $('#add').attr('disabled', 'disabled');
                                    },

                                    success: function(data) {
                                        console.log(data)

                                        if (data.includes("Please fill all fields of the mode that you choose")) {
                                            $("#errors").val("Please fill all fields of the mode that you choose")
                                        } else {
                                            location.href = "index.php"
                                        }

                                        $('#add').attr('disabled', null);
                                    }

                                }); //end ajax

                } catch (err) {
                    $("#errors").val(err.message)
                    console.log(err.message)

                }



            }

        });

    });
</script>