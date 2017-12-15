<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Paramètres</title>
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
		include("template/nav.php");

		$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='" . $donnees["mail"] . "'");
		$donnees = $reponse->fetch();
		$reponse->closeCursor();
		?>

		<div id="content">
			<div class="formulaire marge_haut">
				<form method="post" id='modif_email' action="parametre.php">

					<div id="titre">Paramètres</div>

					<div class="texte">Adresse e-mail actuelle :
						<br>
						<?php echo $donnees["mail"]; ?>
					</div>
					<input class="field" type="text" name="mail">

					<br>
					<input id="bouton" type="submit" value="Modifier Email">
				</form>
				<form method="post" id='modif_phone' action="parametre.php">
					<div class="texte">Numéro de téléphone actuel :
						<br>
						<?php echo $donnees["telephone"]; ?>
					</div>
					<input class="field" type="text" name="phone">
					<br>
					<input id="bouton" type="submit" value="Modifier le numéro">
				</form>
				<form method="post" id='modif_mdp' action="parametre.php">
					<div class="texte">Mot de passe :</div>

					<input class="field" type="password" name="mdp_old" placeholder="Ancien mot de passe">
					<br>
					<input class="field" type="password" name="mdp1" placeholder="Nouveau mot de passe">
					<br>
					<input class="field" type="password" name="mdp2" placeholder="Confirmer mot de passe">
					<br>
					<input id="bouton" type="submit" value="Modifier mot de passe">
				</form>
			</div>
		</div>
	</div>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST["phone"]) OR isset($_POST["mail"]) OR (isset($_POST["mdp_old"]) AND isset($_POST["mdp1"]) AND isset($_POST["mdp2"])))
		{
			$mail = $donnees["mail"];
			if (isset($_POST["mail"])) 
			{
				$_POST["mail"] = verification($_POST["mail"]);
				if($_POST["mail"] == '')
				{
					echo '<div class="error">Veuillez renseigner l\'adresse e-mail</div>';
				}
				elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) 
				{
					echo '<div class="error">Veuillez rentrer une adresse mail valide</div>';
				}
				elseif ($_POST["mail"] != '') 
				{
					$new_mail = $_POST["mail"];
					$bdd->exec("UPDATE Utilisateur SET mail = '$new_mail' WHERE mail = '$mail'");
					$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='$new_mail'");
					$donnees = $reponse->fetch();
					$reponse->closeCursor();
					$_SESSION['user'] = $new_mail;
					echo '<div class="ok">Adresse mail changée avec succès</div>';
				}
			}
			if (isset($_POST["phone"])) 
			{
				$_POST["phone"] = verification($_POST["phone"]);
				if($_POST["phone"] == '')
				{
					echo '<div class="error">Veuillez renseigner votre numéro</div>';
				}
				else
				{
					$new_phone = $_POST["phone"];
					$bdd->exec("UPDATE Utilisateur SET telephone = '$new_phone' WHERE mail = '$mail'");
					echo '<div class="ok">Téléphone avec succès</div>';
				}
			}
			if (isset($_POST["mdp_old"]) AND isset($_POST["mdp1"]) AND isset($_POST["mdp2"]))
			{
				$_POST["mdp_old"] = verification($_POST["mdp_old"]);
				$_POST["mdp1"] = verification($_POST["mdp1"]);
				$_POST["mdp2"] = verification($_POST["mdp2"]);
				$options = ['cost' => 11,];

				echo $password_verify($_POST["mdp_old"], $donnees["password"]) ? 'true' : 'false';

				if($_POST["mdp_old"] == '' OR $_POST["mdp1"] == '' OR $_POST["mdp2"] == '')
				{
					echo '<div class="error">Veuillez renseigner vos mots de passe</div>';
				}
				else{
					if (password_verify($_POST["mdp_old"], $donnees["password"]) == FALSE)
					{
						echo '<div class="error">Mot de passe erroné</div>';
					}
					elseif ($_POST["mdp1"] != $_POST["mdp2"]) 
					{
						echo '<div class="error">Vos nouveaux mots de passe ne sont pas identiques</div>';
					}
					elseif ($_POST["mdp1"] == $_POST["mdp2"] AND password_verify($_POST["mdp_old"], $donnees["password"]))
					{
						$new_password = password_hash($_POST["mdp1"], PASSWORD_BCRYPT, $options);
						$bdd->exec("UPDATE Utilisateur SET password = '$new_password' WHERE mail = '$mail'");
						echo '<div class="ok">Mot de passe changé avec succès</div>';
					}
				}
			}
		}
		?>
	</body>
	</html>