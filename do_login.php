<?PHP
//////////////////////////////////////////////////////////////////////////////////
//	do_login.php
//	This script handles login attempts
//	
// 	https://github.com/Vicarious-Studio/Simple-PHP-MySQL-Login-System.git
//
//////////////////////////////////////////////////////////////////////////////////

// Start session
session_start();

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

// Ok, the information supplied is good. Let's check the database.
$USERNAME = $_POST['username'];
$PASSWORD = md5(strrev(md5($_POST['password'])));

require("config.php");
$con = mysqli_connect($DBSERVER, $DBUSER, $DBPASS, $DBNAME);
$result = mysqli_query($con, "SELECT ID, username, pass from $DBTABLE WHERE username = '$USERNAME' AND pass = '$PASSWORD'");

if(mysqli_num_rows($result) != 1) {
	// Invalid Login
	mysqli_close($con);
	die("Invalid Login"); 
} else {
	// Valid login
	// Lets give them a sid
	$SID = md5($PASSWORD . time()); 
	mysqli_query($con, "UPDATE $DBTABLE SET sid = '$SID' WHERE username = '$USERNAME' AND pass = '$PASSWORD'");
	
	// Now create the session
	$_SESSION['sid'] = $SID;
	$row = mysqli_fetch_array($result);
	$_SESSION['uid'] = $row['ID'];
	
	// And finally redirect them
	header("location: index.php");
}




?>
