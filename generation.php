<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post" id='connexion' action="generation.php">
		<input type="text" name="password">
		<input type="submit" name="">
	</form>

	<?php
	$options = [
		'cost' => 11,
	];
	echo password_hash($_POST["password"], PASSWORD_BCRYPT, $options)."\n";
	?>
</body>
</html>