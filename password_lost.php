<!DOCTYPE html>
<html id='first_page'>
<head>
	<title>Mot de passe oublié - iHouse</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<div class="wrap">
		<img id="logo" src="images/iHouse.png">
	</div>


	<div class="wrap">
		<form method="post" id='lostpassword' action="password_lost.php">

			<div id="titre">Mot de passe oublié</div>

			<div class="texte">Adresse e-mail</div>

			<input class="field" type="text" name="mail">
			<br>
			<input id="bouton" type="submit" value="Générer un nouveau mot de passe">
		</form>
		
		<div id="forget"><a class="link" href="login.php">Retour à l'écran de connexion</a></div>
	</div>

	<?php 
	if(isset($_POST["mail"]))
	{
		if($_POST["mail"] == '')
		{
			echo '<div class="error">Veuillez renseigner l\'adresse e-mail</div>';
		}
		elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) 
		{
			echo '<div class="error">Veuillez rentrer une adresse mail valide</div>';
		}
		else
		{
			echo '<div class="ok">Un lien de réinitialisation vous a été envoyé par email.</div>';

		}
	}

	?>

</body>
</html>