<!DOCTYPE html>
<html id='first_page'>
<head>
	<title>Se connecter - iHouse</title>
	<link rel="stylesheet" href="style_login.css">
	<link rel="icon" href="favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<div class="wrap">
		<img id="logo" src="iHouse.png">
	</div>


	<div class="wrap">
		<form method="post" id='connexion' action="login.php">

			<div id="titre">Espace personnel</div>

			<div class="texte">Adresse e-mail</div>

			<input class="field" type="text" name="mail">

			<div class="texte">Mot de passe</div>

			<input class="field" type="password" name="password">
			<br>
			<input id="bouton" type="submit" value="Se connecter">
		</form>
	</div>
	<div class="wrap">
		<div id="forget"><a class="link" href="password_lost.php">Identifiants oubliés ?</a></div>
	</div>

	<?php 
	include("template/connexionbdd.php");

	function verification($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}



	if(isset($_POST["password"]) && isset($_POST["mail"]))
	{

		$_POST["mail"] = verification($_POST["mail"]);
		$_POST["password"] = verification($_POST["password"]);
		$options = [
			'cost' => 11,
		];
		$_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, $options)."\n";


		$reponse = $conn->query('SELECT * FROM `Utilisateur` WHERE `mail` LIKE $_POST["mail"]');

		echo $reponse["password"];

		if($_POST["mail"] == '')
		{
			echo '<div class="error">Veuillez renseigner l\'adresse e-mail</div>';
		}
		elseif($_POST["password"] == '')
		{
			echo '<div class="error">Veuillez renseigner le mot de passe</div>';
		}
		elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) 
		{
			echo '<div class="error">Veuillez rentrer une adresse mail valide</div>';
		}
		elseif ($_POST["mail"] != '' && $_POST["password"] != '')
		{
			if($_POST["mail"] != "test@test.com")
			{
				echo '<div class="error">Utilisateur inconnu</div>';
			}
			elseif($_POST["password"] != "juniorisep")
			{
				echo '<div class="error">Mauvais mot de passe</div>';
			}
			elseif($_POST["password"] == "juniorisep" && $_POST["mail"] == "test@test.com")
			{
				die("<script>location.href = 'https://www.ihouse-isep.com/app/v1/index.php'</script>");
			}
		}
	}
	?>

</body>
</html>