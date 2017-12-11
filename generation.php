<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<input type="text" name="password">
	<input type="submit" name="">

	<?php
	$options = [
		'cost' => 11,
	];
	echo password_hash($_POST["password"], PASSWORD_BCRYPT, $options)."\n";
	?>
</body>
</html>