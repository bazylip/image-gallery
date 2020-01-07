<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php include 'header.php' ?>
	<form action="/user/login/status" method="post">
		<?php if (isset($_GET['error'])) {echo "<p>Login and/or password incorrect";} ?>
		<p>Login: <input type="text" name="login"></p>
		<p>Password: <input type="password" name="password"></p>
		<br/>
		<input type="submit" name="button" value="Login">
	</form>
</body>
</html>