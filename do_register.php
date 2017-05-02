<?PHP
/////////////////////////////////////////////////////
//	do_register.php
//	This script handles creating an account
//	
// 	https://github.com/Vicarious-Studio/Simple-PHP-MySQL-Login-System.git
//
//	
/////////////////////////////////////////////////////

// First off let's make sure information was posted
if(empty($_POST['username']) || empty($_POST['password'])) {
	// Information was not supplied
	die("<strong>Error:</strong> You must enter a username and password. Please click back on your browser.");
}

// Now let's make sure they are sanatized
if(!ctype_alnum($_POST['username']) || !ctype_alnum($_POST['password'])) {
	// Infomation was not sanatized
	// NOTE: You may want to change this to allow symbols, but do NOT allow ' or " or -- for MySQL Reasons.
	die("<strong>Error:</strong> Invalid username or password. Please click back on your browser.");
}

// Ok, the information supplied is good. Let's insert it into the database.
$USERNAME = $_POST['username'];
$PASSWORD = md5(strrev(md5($_POST['password'])));

require("config.php");
$con = mysqli_connect($DBSERVER, $DBUSER, $DBPASS, $DBNAME);
mysqli_query($con, "INSERT INTO $DBTABLE (ID, username, pass) VALUES(NULL, '$USERNAME', '$PASSWORD')");
mysqli_close($con);

// Output to the user
echo "Success! <a href='index.php'>Click Here To Return To Site</a>";
?>
