<?PHP
/////////////////////////////////////////////////////
//	checkauth.php
//	This is the file to require on any page
//	where you want to check authentication.
// 	
//  https://github.com/Vicarious-Studio/Simple-PHP-MySQL-Login-System.git
//	
/////////////////////////////////////////////////////

// Start PHP Session
session_start();
// Require config.php where database information is stored.

require("config.php");


function IsLoggedIn() {
	// Step 1: Check if the session exists
	if(empty($_SESSION['sid']) || empty($_SESSION['uid'])) {
		// The session does not exist
		return false;
		
	} else {
		// Ok the session does exist and is defined
		// Let's check if they are the correct format
		if(!is_numeric($_SESSION['uid'])) {
			// The uid is not a number, so it is invalid
			session_destroy(); // Destroy the invalid session
			return false;
		} elseif(!ctype_alnum($_SESSION['sid'])) {
			// The sid is invalid
			session_destroy(); // Destroy the invalid session
			return false;
		} else {
			// Ok session is valid, let's check it against the database
			// NOTE: You need to test this, it does not show errors by defualt to prevent hacking attempts
			$SESSION_ID = $_SESSION['uid'];
			$SESSION_SID = $_SESSION['sid'];
			
			$con = mysqli_connect($DBSERVER, $DBUSER, $DBPASS, $DBNAME);
			$result = mysqli_query($con, "SELECT ID,sid FROM $DBTABLE WHERE ID = '$SESSION_ID' AND sid = '$SESSION_SID'");
			if(mysqli_num_rows($result != 1)) {
				// Not found in database
				session_destroy(); // Destroy invalid session
				mysqli_close($con);
				return false;
			} else {
				mysqli_close($con);
				return true;
			}			
			
		}
		
	}
}

?>
