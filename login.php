<!--
	And example login page where the user can login
	or click a link to create an account
	
	https://github.com/Vicarious-Studio/Simple-PHP-MySQL-Login-System.git
	
-->

<html>
<head>
	<title>Login / Register</title>
</head>

<body>

<h2>Please Login</h2>

<form action="do_login.php" method="POST">
Username: <input type="text" name="username" />
<br/><br/>
Password: <input type="password" name="password" />
<br/><br/>
<input type="submit" value="Login" />
</form>

<hr/>
<h3><a href="register.php">Click Here To Register An Account</a></h3>

</body>
</html>
