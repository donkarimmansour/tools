<?php
require_once "../../includes/function/ini.php";
$jsDir = "../.{$jsDir}";
$cssDir = "../.{$cssDir}";
$cssImg = "../.{$cssImg}";
$pageTitle = "Generator";

require_once "../.{$incDir}{$incFun}function.php";
require_once "../.{$incDir}{$incTemp}header.php";
require_once "../.{$incDir}{$incTemp}navbar.php";

?>

<div class="container mt-3 mb-3">

    <?php breadcrumbs("Iban", "Generator");
    ?>
    <div class="card">



        <div class="card-header ">
            <span style="font-weight: bold;">Generator </span>

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
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="country_input">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="AD">Andorra</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="AL">Albania</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Republic of Azerbaijan</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BR">Brazil</option>
                                        <option value="BY">Republic of Belarus</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DE">Germany</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ES">Spain</option>
                                        <option value="FI">Finland</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FR">France</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="GE">Georgia</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GR">Greece</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="HR">Croatia</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IE">Ireland</option>
                                        <option value="IL">Israel</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IT">Italy</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="LI">Liechtenstein (Principality of)</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="LV">Latvia</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MD">Moldova</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MT">Malta</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="NO">Norway</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PL">Poland</option>
                                        <option value="PS">Occupied Palestinian Territory</option>
                                        <option value="PT">Portugal</option>
                                        <option value="QA">Qatar</option>
                                        <option value="RO">Romania</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SE">Sweden</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SK">Slovak Republic</option>
                                        <option value="SM">San Marino</option>
                                        <option value="ST">Sao Tome And Principe</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="XK">Republic of Kosovo</option>
                                    </select>
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


                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="Quantity" class="control-label mb-1 required">Quantity</label>
                                    <input type="text" id="Quantity" class="form-control" placeholder="Quantity" value="10" />
                                    <small id="q_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1 required">Iban List</label>
                            <textarea id="okay" class="form-control" placeholder="Iban List" rows="9"></textarea>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 start">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Generate</span>
                                </button>
                            </div>
                            <div class="col-md-6 col-sm-12 start">
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
                var generated = 0;

                //$('#start').click(function() {
                $("#form").submit(function(e) {
                        // custom handling here
                        e.preventDefault();





                        if ($("#Quantity").val() == null || $("#Quantity").val() == "" || parseInt($("#Quantity").val()) < 1) {
                            $("#q_err").removeClass("d-none").addClass("d-block")
                            return
                        } else {
                            $("#q_err").removeClass("d-block").addClass("d-none")
                            
                            
                            
                            
                            var Quantity = $('#Quantity').val()
                            if (Quantity < 1) Quantity = 1;
                            else if (Quantity > 1000) Quantity = 1000;
                            $('#Quantity').val(Quantity)
                            Quantity = $('#Quantity').val()
                            $('#total').html(Quantity);

                            for (var qu = 1; qu <= Quantity; qu++) {

                                ajaxCall = $.ajax({
                                    url: '../controller/generator.php',
                                    type: 'POST',
                                    data: "country=" + $("#country").val(),

                                    beforeSend: function() {
                                        $('#stop').attr('disabled', null);
                                        $('#start').attr('disabled', 'disabled');
                                    },

                                    success: function(data) {
                                        if ($("#separator").val() == "&#13;") $("#Delimiter").val() = "\n";


                                        document.getElementById("okay").innerHTML += data + $("#separator").val();


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

                                }); //end ajax
                            }
                            
                            
                            
                            
                            }


                        }); //end onclick


                    $('#stop').click(function() {
                        ajaxCall.abort();

                        $('#start').attr('disabled', null);
                        $('#stop').attr('disabled', 'disabled');
                    });


                });
</script>