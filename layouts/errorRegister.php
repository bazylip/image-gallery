<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
<a href="/user/register">Go back to register</a>
<h1>Failed while registering!</h1>
<h2>Errors:</h2>
<ul>
	<?php foreach ($this->errors as $error): ?>
		<li><?php switch($error){
				case 'login':
					echo "Login already in use";
					break;
				case 'email':
					echo "Email already in use";
					break;
				case 'password':
					echo "Passwords don't match";
					break;
				}
			?></li>
	<?php endforeach; ?>
</ul>
</body>
</html>