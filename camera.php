<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Caméra</title>
</head>
<body>

	<?php
	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['user']))
	{
		die("<script>location.href = 'https://www.ihouse-panel.com/git/login.php'</script>");
	}
	include("template/header.php");
	?>
	<div id='wrap4'>
		<?php
		//include("template/nav.php");
		?>
		<div id="content">

			<div>Vos caméras de surveillance disponibles :</div>

			<iframe width="560" height="315" src="https://www.youtube.com/embed/5DgFlQD5CNY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
		</div>
	</div>
</body>
</html>