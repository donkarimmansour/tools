<?php
set_time_limit(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  require_once "./ssn.php" ;

  // Instantiate the class
$fngssn = new fngssn();

// Generate a SSN for California
$ssn = $_POST["ssn"];
// Validate a SSN
$state = $fngssn->validateSSN($ssn);

echo json_encode(array("ssn" => $ssn , "state" => $state)) ;

} // post 

?>