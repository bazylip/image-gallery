<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php include 'header.php' ?>
	<form action="/user/add" method="post">
		<p>Email: <input type="email" name="email"></p>
		<p>Login: <input type="text" name="login"></p>
		<p>Password: <input type="password" name="password"></p>
		<p>Repeat password: <input type="password" name="passwordRepeat"></p>
		<br/>
		<input type="submit" name="button" value="Register">
	</form>
</body>
</html>