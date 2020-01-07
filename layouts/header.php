<?php require_once '../models/Database.php'; ?>

<a href="/gallery">Gallery</a>
<a href="/gallery/selected">Gallery of selected images</a>
<a href="/image/add">Add image</a>
<?php
	if(!isset($_SESSION['user_id'])){
		echo '<a href="/user/login">Login</a> ';
		echo '<a href="/user/register">Register</a>';
	}else{
		$cursor = Database::get()->users->find(['_id' => $_SESSION['user_id']]);
		foreach ($cursor as $loggedUser){
			echo $loggedUser['login'];
		}
		echo ' <a href="/user/logout">Logout</a> ';
	}
?>
