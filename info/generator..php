<?php
require_once "../includes/function/ini.php";
$jsDir = ".{$jsDir}";
$cssDir = ".{$cssDir}";
$cssImg = ".{$cssImg}";
$pageTitle = "Generator";

require_once ".{$incDir}{$incFun}function.php";
require_once ".{$incDir}{$incTemp}header.php";
require_once ".{$incDir}{$incTemp}navbar.php";

?>

<div class="container mt-3 mb-3">

    <?php breadcrumbs("Info", "Generator");
    ?>
    <div class="card">


            <div class="card-header ">
                <span style="font-weight: bold;">Generator </span>
            </div>

            <div class="card-body">

                <form id="form" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <select id="nat" name="nat" class="form-control">
                                    <option value="us" selected>United States</option>
                                    <option value="au">Australia</option>
                                    <option value="br">Brazil</option>
                                    <option value="ca">Canada</option>
                                    <option value="ch">Switzerland</option>
                                    <option value="de">Germany</option>
                                    <option value="dk">Denmark</option>
                                    <option value="es">Spain</option>
                                    <option value="fi">Finland</option>
                                    <option value="fr">France</option>
                                    <option value="gb">United Kingdom</option>
                                    <option value="ie">Ireland</option>
                                    <option value="ir">Iran</option>
                                    <option value="no">Norway</option>
                                    <option value="nl">Netherlands</option>
                                    <option value="nz">New Zealand</option>
                                    <option value="tr">Turkey</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <button type="submit" id="start" class="btn btn-primary btn-block p-2" style="cursor: pointer;">
                                    <span>generate</span>
                                </button>
                            </div>
                        </div>





                        <div class="col-sm-12">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Title :</th>
                                        <td id="Title">Title</td>
                                        <th>Gender :</th>
                                        <td id="Gender">Gender</td>
                                    </tr>
                                    <tr>
                                        <th>FirstName :</th>
                                        <td id="FirstName">FirstName</td>
                                        <th>LastName :</th>
                                        <td id="LastName">LastName</td>
                                    </tr>
                                    <tr>
                                        <th>Street Name :</th>
                                        <td id="StreetName">Street Name</td>
                                        <th>Street Number :</th>
                                        <td id="StreetNumber">Street Number</td>
                                    </tr>
                                    <tr>
                                        <th>City :</th>
                                        <td id="City">City</td>
                                        <th>State :</th>
                                        <td id="State">State</td>
                                    </tr>
                                    <tr>
                                        <th>Country :</th>
                                        <td id="Country">Country</td>
                                        <th>Postcode :</th>
                                        <td id="Postcode">Postcode</td>
                                    </tr>
                                    <tr>

                                        <th>Birthday :</th>
                                        <td id="Birthday">Birthday</td>
                                        <th>Age :</th>
                                        <td id="Age">Age</td>
                                    </tr>
                                    <tr>
                                        <th>Phone :</th>
                                        <td id="Phone">Phone</td>
                                        <th>Cell :</th>
                                        <td id="Cell">Cell</td>
                                    </tr>
                                    <tr>
                                        <th>Email :</th>
                                        <td id="Email">Email</td>
                                        <th>SSN :</th>
                                        <td id="SSN">SSN</td>
                                    </tr>
                                    <tr>

                                        <th>Username :</th>
                                        <td id="Username">Username</td>
                                        <th>Password :</th>
                                        <td id="Password">Password</td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>

                    </div>

                </form>

            </div>
        </div>


    </div>

<?php
require_once ".{$incDir}{$incTemp}footer.php";
?>

    <script>
        $(document).ready(function() {
            Generator()
            //$('#start').click(function() {
            $("#form").submit(function(e) {
                // custom handling here
                e.preventDefault();
                Generator()
            
            }); //end onclick


            function Generator(){

                ajaxCall = $.ajax({
                    url: 'https://randomuser.me/api/',
                    type: 'GET',
                    data: $('#form').serialize(),
                    dataType: 'json',

                    beforeSend: function() {
                        $('#start').attr('disabled', 'disabled');
                    },

                    success: function(data, textStatus, xhr) {

                        if (data != null && data != "" && textStatus == "success") {


                            var Title = data["results"][0]["name"]["title"] ? data["results"][0]["name"]["title"] : "Title"
                            var Gender = data["results"][0]["gender"] ? data["results"][0]["gender"] : "Gender"
                            var FirstName = data["results"][0]["name"]["first"] ? data["results"][0]["name"]["first"] : "FirstName"
                            var LastName = data["results"][0]["name"]["last"] ? data["results"][0]["name"]["last"] : "LastName"
                            var StreetName = data["results"][0]["location"]["street"]["name"] ? data["results"][0]["location"]["street"]["name"] : "StreetName"
                            var StreetNumber = data["results"][0]["location"]["street"]["number"] ? data["results"][0]["location"]["street"]["number"] : "StreetNumber"
                            var City = data["results"][0]["location"]["city"] ? data["results"][0]["location"]["city"] : "City"
                            var State = data["results"][0]["location"]["state"] ? data["results"][0]["location"]["state"] : "State"
                            var Country = data["results"][0]["location"]["country"] ? data["results"][0]["location"]["country"] : "Country"
                            var Postcode = data["results"][0]["location"]["postcode"] ? data["results"][0]["location"]["postcode"] : "Postcode"
                            var Birthday = data["results"][0]["dob"]["date"] ? new Date(data["results"][0]["dob"]["date"]).toLocaleDateString()  : "Birthday"
                            var Age = data["results"][0]["dob"]["age"] ? data["results"][0]["dob"]["age"] : "Age"
                            var Phone = data["results"][0]["phone"] ? data["results"][0]["phone"] : "Phone"
                            var Cell = data["results"][0]["cell"] ? data["results"][0]["cell"] : "Cell"
                            var Email = data["results"][0]["email"] ? data["results"][0]["email"] : "Email"
                            var SSN = data["results"][0]["id"]["value"] ? data["results"][0]["id"]["value"] : "SSN"
                            var Username = data["results"][0]["login"]["username"] ? data["results"][0]["login"]["username"] : "Username"
                            var Password = data["results"][0]["login"]["password"] ? data["results"][0]["login"]["password"] : "Password"

                            $('#Title').html(Title);
                            $('#Gender').html(Gender);
                            $('#FirstName').html(FirstName);
                            $('#LastName').html(LastName);
                            $('#StreetName').html(StreetName);
                            $('#StreetNumber').html(StreetNumber);
                            $('#City').html(City);
                            $('#State').html(State);
                            $('#Country').html(Country);
                            $('#Postcode').html(Postcode);
                            $('#Birthday').html(Birthday);
                            $('#Birthday').html();
                            $('#Age').html(Age);
                            $('#Phone').html(Phone);
                            $('#Cell').html(Cell);
                            $('#Email').html(Email);
                            $('#SSN').html(SSN);
                            $('#Username').html(Username);
                            $('#Password').html(Password);


                        }
                        $('#start').attr('disabled', null);

                    }

                }); //end ajax
            }

        });
    </script>
