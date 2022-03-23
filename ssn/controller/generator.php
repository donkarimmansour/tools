<?php
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  require_once "./ssn.php" ;

  // Instantiate the class
$fngssn = new fngssn();

if($_POST["state"] == "RAND") $_POST["state"] = ""  ;
// Generate a SSN for California
$ssn = $fngssn->generateSSN($_POST["state"]);
// Validate a SSN
$state = $fngssn->validateSSN($ssn);

echo json_encode(array("ssn" => $ssn , "state" => $state)) ;

} // post 

?>