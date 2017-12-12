<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="favicon.png" />
	<meta charset="UTF-8">
	<title>Création d'utilisateur</title>
</head>
<body>

	<?php
	/*session_start();
	session_regenerate_id();
	if(!isset($_SESSION['user']))
	{
		die("<script>location.href = 'https://www.ihouse-panel.com/git/login.php'</script>");
	}*/
	include("template/connexionbdd.php");
	include("template/header.php");
	include("template/nav.php");
	?>

	<form method="post" id='connexion' action="login.php">

		<div id="titre">Création de compte</div>

		<div class="texte">Nom</div>
		<input class="field" type="text" name="name">

		<div class="texte">Prénom</div>
		<input class="field" type="text" name="last_name">

		<div class="texte">Adresse e-mail</div>
		<input class="field" type="text" name="mail">

		<div class="texte">Numéro de téléphone</div>
		<input class="field" type="text" name="phone">

		<div class="texte">Type de compte</div>
		<select name="account_type" size="1">
			<option>Client</option>
			<option>Technicien</option>
			<option>Maintenance</option>
			<option>Administrateur</option>
		</select>

		<br>
		<input id="bouton" type="submit" value="Se connecter">
	</form>

</body>
</html>