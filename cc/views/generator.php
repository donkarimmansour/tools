<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Extractor";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>

<div class="container mt-3 mb-3">

    <?php breadcrumbs("Email", "Extractor");
    ?>
    <div class="card">

        <div class="card-header ">
            <span style="font-weight: bold;">Mailer </span>

            <div style="text-align:center; display: inline-block;">
                <button type="button" class="btn btn-info m-1">
                    total <span class="badge badge-light info" id="total">0</span>
                </button>

                <button type="button" class="btn btn-success m-1">
                    Generated <span class="badge badge-light success" id="generated">0</span>
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
                                <input class="form-check-input" type="checkbox" id="date" value="Data" checked/>
                                <label class="form-check-label" for="date">Date</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ckccv" value="CCV" checked/>
                                <label class="form-check-label" for="ckccv">CCV</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="bank" value="Bank Type" />
                                <label class="form-check-label" for="bank">Bank Type</label>
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <div class="form-group">
                            <label for="bin" class="control-label mb-1 required">Enter your BIN</label>
                            <input type="number" value="552289" id="bin" list="bins" class="form-control" placeholder="Enter your BIN" />
                            <small id="b_err" class="form-text text-danger d-none">Please Enter your BIN.</small>

                            <datalist id="bins">
                                <option value="552289">
                                <option value="546479">
                                <option value="512112">
                                <option value="512119">
                                <option value="552589">
                            </datalist>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="row">

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Month">Month</label>
                                    <select id="Month" name="Month" class="form-control">
                                        <option value="Random" selected="selected">Random</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Year">Year</label>
                                    <select id="Year" name="Year" class="form-control">
                                        <option value="Random" selected="selected">Random</option>
                                        <option value="2021">21</option>
                                        <option value="2022">22</option>
                                        <option value="2023">23</option>
                                        <option value="2024">24</option>
                                        <option value="2025">25</option>
                                        <option value="2026">26</option>
                                        <option value="2027">27</option>
                                        <option value="2028">28</option>
                                        <option value="2029">29</option>
                                        <option value="2030">30</option>
                                        <option value="2031">31</option>
                                        <option value="2032">32</option>
                                        <option value="2033">33</option>
                                        <option value="2034">34</option>
                                        <option value="2035">35</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ccv" class="control-label mb-1 required">CCV</label>
                                    <input type="text" id="ccv" class="form-control" placeholder="CCV" value="Random" />
                                </div>
                            </div>


                            <div class="col-4">
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

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Formate">Formate</label>
                                    <select id="Formate" name="Formate" class="form-control">
                                        <option value="CHECKER" selected="selected">CHECKER</option>
                                        <option value="CSV">CSV</option>
                                        <option value="XML">XML</option>
                                        <option value="JSON">JSON</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="Quantity" class="control-label mb-1 required">Quantity</label>
                                    <input type="number" id="Quantity" class="form-control" placeholder="Quantity" value="10" />
                                    <small id="q_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>

                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="list" class="control-label mb-1 required">Cards</label>
                            <textarea id="list" class="form-control" placeholder="Cards" rows="9"><?php if (isset($_POST["text"])) echo $_POST["text"]; ?></textarea>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Generate Cards</span>
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

              

                $("#form").submit(function(e) {
                        // custom handling here
                        e.preventDefault();

                        if ($("#bin").val() == null || $("#bin").val() == "") {
                            $("#b_err").removeClass("d-none").addClass("d-block")
                            return
                        } else if ($("#Quantity").val() == null || $("#Quantity").val() == "" || parseInt($("#Quantity").val()) < 1) {
                            $("#q_err").removeClass("d-none").addClass("d-block")
                            return
                        } else {
                            $("#q_err").removeClass("d-block").addClass("d-none")
                            $("#b_err").removeClass("d-block").addClass("d-none")

                          
                            var total = 0;
                            var generated = 0;
                            document.getElementById("progressbar").style.width = 0 + "%";
                            document.getElementById("progressbar").innerText = 0 + "%";
                            document.getElementById("list").innerHTML = ""


                            $('#stop').attr('disabled', null);
                            $('#start').attr('disabled', 'disabled');

                            var Quantity = $('#Quantity').val()
                            if (Quantity < 1) Quantity = 1;
                            else if (Quantity > 1000) Quantity = 1000;
                            $('#Quantity').val(Quantity)
                            Quantity = $('#Quantity').val()
                            $('#total').html(Quantity);

                            var output = '';
                            var Formate = $("#Formate").find('option:selected').val()

                            if (Formate == "XML") output += "<xml>\n";
                            else if (Formate == "JSON") output += "{\n";

                            for (var qu = 1; qu <= Quantity; qu++) {

                                //date generator
                                if ($("#date").is(':checked') && $("#Year").val() == 'Random' && $("#Month").val() == 'Random') {
                                    var mes = Math.floor(Math.random() * (13));
                                    if (mes.toString().length == 1) mes = 0 + "" + mes;
                                    var year = (new Date().getFullYear() + Math.floor(Math.random() * (8)));
                                } else if ($("#date").is(':checked') && $("#Month").val() != 'Random' && $("#Year").val() == 'Random') {
                                    var mes = $("#Month").val();
                                    var year = (new Date().getFullYear() + Math.floor(Math.random() * (8)));
                                } else if ($("#date").is(':checked') && $("#Month").val() == 'Random' && $("#Year").val() != 'Random') {
                                    var mes = Math.floor(Math.random() * (13));
                                    if (mes.toString().length == 1) mes = 0 + "" + mes;
                                    var year = $("#Year").val();
                                } else if ($("#date").is(':checked') && $("#Month").val() != 'Random' && $("#Year").val() != 'Random') {
                                    var mes = $("#Month").val();
                                    var year = $("#Year").val();
                                } else var ccDate = '';

                                //ccv generator
                                if (($("#ccv").val() == 'Random' && $("#ckccv").is(':checked')) || ($("#ccv").val() == '' && $("#ckccv").is(':checked'))) {
                                    var ccv = 100 + Math.floor(Math.random() * (899));
                                } else if ($("#ccv").val() != 'Random' && $("#ckccv").is(':checked')) {
                                    var ccv = $("#ccv").val();
                                } else {
                                    var ccv = '';
                                }

                                //bin generator
                                if ($("#bin").val() == '') {
                                    var cc = 1000000000000000 + Math.floor(Math.random() * (8999999999999999))
                                } else {
                                    if ($("#bin").val().length >= 16) {
                                        var cc = $("#bin").val()
                                    } else {
                                        var ccL = 16 - $("#bin").val().length
                                        var ccS = "1";
                                        var ccE = "8";
                                        for (let i = 1; i < ccL; i++) {
                                            ccS += "" + 0
                                            ccE += "" + 9
                                        }
                                        var cc = parseInt($("#bin").val() + (parseInt(ccS) + (Math.floor(Math.random() * parseInt(ccE)))));
                                    }
                                }

                                //bank generator
                                var fg = cc.toString().charAt(0)
                                var bank = ""
                                if (fg == 0) bank = "N/A"
                                else if (fg == 1) bank = "Airline"
                                else if (fg == 2) bank = "N/A"
                                else if (fg == 3) bank = "American Express"
                                else if (fg == 4) bank = "Visa"
                                else if (fg == 5) bank = "Mastercard"
                                else if (fg == 6) bank = "Discover"
                                else if (fg == 7) bank = "Petroleum"
                                else if (fg == 8) bank = "Telecommunications"
                                else if (fg == 9) bank = "Government"


                                if (Formate == "CHECKER") {
                                    output += cc;
                                    if ($("#date").is(':checked')) output += "|" + mes + '|' + year;
                                    if ($("#ckccv").is(':checked')) output += "|" + ccv;
                                    if ($("#bank").is(':checked')) output += "|" + bank + "\n";
                                    else output += "\n";
                                } else if (Formate == "CSV") {
                                    output += cc;
                                    if ($("#ckccv").is(':checked')) output += ", " + ccv;
                                    if ($("#date").is(':checked')) output += ", " + mes + '/' + year;
                                    if ($("#bank").is(':checked')) output += ", " + bank + "\n";
                                    else output += "\n";
                                } else if (Formate == "XML") {
                                    output += "<CreditCard>\n";
                                    if ($("#bank").is(':checked')) output += "<CardNetwork>" + bank + "<\/CardNetwork>\n";
                                    output += "<CardNumber>" + cc + "<\/CardNumber>\n";
                                    if ($("#ckccv").is(':checked')) output += "<CardCCV2>" + ccv + "<\/CardCCV2>\n";
                                    if ($("#date").is(':checked')) output += "<CardExpDate>" + mes + "/" + year + "<\/CardExpDate>\n";
                                    output += "<\/CreditCard>\n";
                                } else if (Formate == "JSON") {
                                    output += "{\n";
                                    output += "\"CreditCard\":{\n";
                                    if ($("#bank").is(':checked')) output += "\"CardNetwork\": \"" + bank + "\"\n";
                                    output += "\"CardNumber\": \"" + cc + "\"\n";
                                    if ($("#ckccv").is(':checked')) output += "\"CardCCV2\": \"" + ccv + "\"\n";
                                    if ($("#date").is(':checked')) output += "\"CardExpDate\": \"" + mes + "/" + year + "\"\n";
                                    output += "}\n";
                                    output += "}";
                                    if (qu < Quantity) output += ",";
                                    output += "\n";
                                }

                                if (Formate == "XML") output + "</xml>";
                                else if (Formate == "JSON") output + "}";
                                document.getElementById("list").innerHTML = output + $("#separator").val();;


                                generated++
                                $('#generated').html(generated);

                                var result = Math.ceil((generated / Quantity) * 100);

                                $('#title').html('[' + generated + '/' + Quantity + '] checker');
                                document.getElementById("progressbar").style.width = result + "%";
                                document.getElementById("progressbar").innerText = result + "%";

                                if (generated == Quantity) {
                                    $('#start').attr('disabled', null);
                                    $('#stop').attr('disabled', 'disabled');
                                    // audio.play();
                                }
                            }
                        }//else

                        }); //end onclick

                    $('#stop').click(function() {

                        ajaxCall.abort();

                        $('#start').attr('disabled', null);
                        $('#stop').attr('disabled', 'disabled');
                    });


                });
</script>
