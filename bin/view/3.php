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

    <?php breadcrumbs("Bin", "Generator");
    ?>
    <div class="card">



        <div class="card-header ">
            <span style="font-weight: bold;">Generator </span>

            <div style="text-align:center; display: inline-block;">
                <button type="button" class="btn btn-info mt-1">
                    total <span class="badge badge-light info" id="total">0</span>
                </button>
                <button type="button" class="btn btn-success mt-1">
                    generated <span class="badge badge-light success" id="generated">0</span>
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
                            <label for="type">Type</label>
                            <select id="type" name="type" class="form-control">
                                <option value="num">Number</option>
                                <option value="text">Text</option>
                                <option value="rand">Random</option>
                            </select>
                        </div>
                    </div>

                 
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Quantity" class="control-label mb-1 required">Quantity</label>
                                    <input type="text" id="Quantity" class="form-control" placeholder="Quantity" value="10" />
                                    <small id="q_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="length" class="control-label mb-1 required">Length</label>
                                    <input type="number" id="length" class="form-control" placeholder="Length" value="5"/>
                                    <small id="l_err" class="form-text text-danger d-none">Please Enter 1 or more.</small>

                                </div>
                            </div>
                       

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="prefix" class="control-label mb-1">prefix</label>
                            <input type="text" id="prefix" class="form-control" placeholder="prefix" />
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="suffix" class="control-label mb-1">suffix</label>
                            <input type="text" id="suffix" class="form-control" placeholder="suffix" />
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="okay" class="control-label mb-1">List</label>
                            <textarea id="okay" class="form-control" placeholder="List" rows="6"></textarea>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mt-1">
                                <button type="submit" id="start" class="btn btn-lg btn-success btn-block">
                                    <span>Generate</span>
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
    </div>


</div>


<?php
require_once "../.{$incDir}{$incTemp}footer.php";
?>

<script>
    $(document).ready(function() {

                $('#stop').attr('disabled', true);
                var generated = 0

                $("#form").submit(function(e) {
                        // custom handling here
                        e.preventDefault();

                        if ($("#Quantity").val() == null || $("#Quantity").val() == "" || parseInt($("#Quantity").val()) < 1) {
                            $("#q_err").removeClass("d-none").addClass("d-block")
                            return
                        } else if ($("#length").val() == null || $("#length").val() == "" || parseInt($("#length").val()) < 1) {
                            $("#l_err").removeClass("d-none").addClass("d-block")
                            return
                        } else {
                            $("#q_err").removeClass("d-block").addClass("d-none")
                            $("#l_err").removeClass("d-block").addClass("d-none")

                            var prefix = ""
                            var suffix = ""
                            var quantity = 0
                            var dlength = 0
                            // var ini = 1
                            // var lst = 8                                



                            $('#stop').attr('disabled', null);
                            $('#start').attr('disabled', 'disabled');

                            length = parseInt($('#Quantity').val())
                            $('#total').text(length);

                            if (parseInt($('#prefix').val()) != null && $('#prefix').val() != "" && $('#prefix').val() != 0)
                                prefix = $('#prefix').val()
                            if (parseInt($('#suffix').val()) != null && $('#suffix').val() != "" && $('#suffix').val() != 0)
                                suffix = $('#suffix').val()
                            if (parseInt($('#length').val()) != null && $('#length').val() != "" && $('#length').val() != 0)
                                dlength = parseInt($('#length').val())


                            let Numbers = '0123456789';
                            let Smaillcharacters = 'abcdefghijklmnopqrstuvwxyz';
                            let Random = 'abcdefghijklmnopqrstuvwxyz0123456789';
                            let gen = ""
                          
                    for (let index = 0; index < parseInt($("#Quantity").val()); index++) {


                        gen = ""

                        if($("#type").val() == "num"){                               

                            for (let i = 1; i <= dlength; i++) {
                              gen += Numbers.charAt(Math.floor(Math.random() * 10))                            
                            }

                        }else if($("#type").val() == "text"){

                            for (let i = 1; i <= dlength; i++) {
                              gen += Smaillcharacters.charAt(Math.floor(Math.random() * 26))                       
                            }

                        }else if($("#type").val() == "rand"){

                            for (let i = 1; i <= dlength; i++) {
                              gen += Random.charAt(Math.floor(Math.random() * 36))                       
                            }

                        }


                                let i = index + 1
                                generated++

                                var nm = prefix + "" + gen + "" + suffix
                                document.getElementById("okay").innerHTML += "" + nm + $("#separator").val();
                                $('#generated').html(generated);

                                var result = Math.ceil((i / length) * 100);

                                $('#title').html('[' + i + '/' + length + '] checker');
                                document.getElementById("progressbar").style.width = result + "%";
                                document.getElementById("progressbar").innerText = result + "%";

                                if (length == i) {
                                    $('#start').attr('disabled', null);
                                    $('#stop').attr('disabled', 'disabled');
                                    // audio.play();
                                }

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