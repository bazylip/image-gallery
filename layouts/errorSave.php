<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<a href="/image/add">Go back to image upload</a>
	<h1>Failed while saving image!</h1>
	<h2>Errors:</h2>
	<ul>
		<?php foreach ($this->errors as $error): ?>
			<li><h3><?= ($error == 'size') ? "Image too big" : "Incorrect file extension" ?></h3></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>
