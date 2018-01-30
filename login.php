<!DOCTYPE html>
<html id='first_page'>
<head>
	<title>Se connecter - iHouse</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<div class="wrap">
		<img id="logo" src="images/iHouse.png">
	</div>


	<div class="wrap">
		<form method="post" class="formulaire" id='connexion' action="login.php">

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
	session_start();
	include("template/connexionbdd.php");

	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST["password"]) && isset($_POST["mail"])) 
		{
			$_POST["mail"] = verification($_POST["mail"]);
			$_POST["password"] = verification($_POST["password"]);
			
			$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='" . $_POST["mail"] . "'");
			$donnees = $reponse->fetch();
			$reponse->closeCursor();



			$options = ['cost' => 11,];
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
				if (password_verify($_POST["password"], $donnees["password"]))
				{
					$_SESSION['user'] = $_POST['mail'];
					$_SESSION['id_utilisateur']=$donnees["id_utilisateur"];
					die("<script>location.href = '/index.php'</script>");
				}
				else 
				{
					echo '<div class="error">Mauvais mot de passe / Utilisateur inconnu</div>';
				}
			}
		}
	}

	?>

</body>
</html>
