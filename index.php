<?PHP
//////////////////////////////////////////////////////////////////////////////////
//	index.php
//	An example page that check if the user is logged in,
//  and handles the result.
//	
// 	https://github.com/Vicarious-Studio/Simple-PHP-MySQL-Login-System.git
//
//////////////////////////////////////////////////////////////////////////////////




// Require the checkauth.php file to check if they are logged in
require("checkauth.php");
//die(print_r($_SESSION));
// Perform the check
if(IsLoggedIn()) {
	// User is logged in
	echo("You are logged in!");
} else {
	// User is not logged in
	// You could redirect to a login page or use inline code. 
	// In this example we will use a redirect

	header("location: login.php");
} 

?>
