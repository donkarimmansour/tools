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

    <?php breadcrumbs("Ssn", "Generator");
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

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="control-label mb-1">Include</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="ckstate" value="country" />
                                <label class="form-check-label" for="ckstate">State</label>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progressbar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="RAND" selected="">All States</option>
                                <option value="AL">Alabama (AL)</option>
                                <option value="AK">Alaska (AK)</option>
                                <option value="AZ">Arizona (AZ)</option>
                                <option value="AR">Arkansas (AR)</option>
                                <option value="CA">California (CA)</option>
                                <option value="CO">Colorado (CO)</option>
                                <option value="CT">Connecticut (CT)</option>
                                <option value="DC">District of Columbia (DC)</option>
                                <option value="DE">Delaware (DE)</option>
                                <option value="FL">Florida (FL)</option>
                                <option value="GA">Georgia (GA)</option>
                                <option value="HI">Hawaii (HI)</option>
                                <option value="ID">Idaho (ID)</option>
                                <option value="IL">Illinois (IL)</option>
                                <option value="IN">Indiana (IN)</option>
                                <option value="IA">Iowa (IA)</option>
                                <option value="KS">Kansas (KS)</option>
                                <option value="KY">Kentucky (KY)</option>
                                <option value="LA">Louisiana (LA)</option>
                                <option value="ME">Maine (ME)</option>
                                <option value="MD">Maryland (MD)</option>
                                <option value="MA">Massachusetts (MA)</option>
                                <option value="MI">Michigan (MI)</option>
                                <option value="MN">Minnesota (MN)</option>
                                <option value="MS">Mississippi (MS)</option>
                                <option value="MO">Missouri (MO)</option>
                                <option value="MT">Montana (MT)</option>
                                <option value="NE">Nebraska (NE)</option>
                                <option value="NV">Nevada (NV)</option>
                                <option value="NH">New Hampshire (NH)</option>
                                <option value="NJ">New Jersey (NJ)</option>
                                <option value="NM">New Mexico (NM)</option>
                                <option value="NY">New York (NY)</option>
                                <option value="NC">North Carolina (NC)</option>
                                <option value="ND">North Dakota (ND)</option>
                                <option value="OH">Ohio (OH)</option>
                                <option value="OK">Oklahoma (OK)</option>
                                <option value="OR">Oregon (OR)</option>
                                <option value="PA">Pennsylvania (PA)</option>
                                <option value="RI">Rhode Island (RI)</option>
                                <option value="SC">South Carolina (SC)</option>
                                <option value="SD">South Dakota (SD)</option>
                                <option value="TN">Tennessee (TN)</option>
                                <option value="TX">Texas (TX)</option>
                                <option value="UT">Utah (UT)</option>
                                <option value="VT">Vermont (VT)</option>
                                <option value="VA">Virginia (VA)</option>
                                <option value="WA">Washington (WA)</option>
                                <option value="WV">West Virginia (WV)</option>
                                <option value="WI">Wisconsin (WI)</option>
                                <option value="WY">Wyoming (WY)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="form-control" id="year">
                                <option value="0">All Years</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                                <option value="2008">2008</option>
                                <option value="2007">2007</option>
                                <option value="2006">2006</option>
                                <option value="2005">2005</option>
                                <option value="2004">2004</option>
                                <option value="2003">2003</option>
                                <option value="2002">2002</option>
                                <option value="2001">2001</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                                <option value="1959">1959</option>
                                <option value="1958">1958</option>
                                <option value="1957">1957</option>
                                <option value="1956">1956</option>
                                <option value="1955">1955</option>
                                <option value="1954">1954</option>
                                <option value="1953">1953</option>
                                <option value="1952">1952</option>
                                <option value="1951">1951</option>
                                <option value="1950">1950</option>
                                <option value="1949">1949</option>
                                <option value="1948">1948</option>
                                <option value="1947">1947</option>
                                <option value="1946">1946</option>
                                <option value="1945">1945</option>
                                <option value="1944">1944</option>
                                <option value="1943">1943</option>
                                <option value="1942">1942</option>
                                <option value="1941">1941</option>
                                <option value="1940">1940</option>
                                <option value="1939">1939</option>
                                <option value="1938">1938</option>
                                <option value="1937">1937</option>
                                <option value="1936">1936</option>
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
                            <label for="Quantity" class="control-label mb-1 required">Quantity</label>
                            <input type="text" id="Quantity" class="form-control" placeholder="Quantity" value="10" />
                            <small id="q_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>

                        </div>
                    </div>




                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1 required">Ssn List</label>
                            <textarea id="okay" class="form-control" placeholder="Ssn List" rows="6"></textarea>
                            
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Generate</span>
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
                    data: $('#form').serialize(),

                    beforeSend: function() {
                        $('#stop').attr('disabled', null);
                        $('#start').attr('disabled', 'disabled');
                    },

                    success: function(data) {
                        if ($("#separator").val() == "&#13;") $("#separator").val() = "\n";

                        data = JSON.parse(data)

                        if ($("#ckstate").is(':checked')) {
                            document.getElementById("okay").innerHTML += data["ssn"] + " ( " + data["state"] + " )" + $("#separator").val();
                        } else {
                            document.getElementById("okay").innerHTML += data["ssn"] + $("#separator").val();
                        }




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