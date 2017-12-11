<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<?php
	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['user']))
	{
		die("<script>location.href = 'https://www.ihouse-panel.com/git/login.php'</script>");
	}
	include("template/connexionbdd.php");
	include("template/header.php");
	include("template/nav.php");
	?>
</body>
</html>