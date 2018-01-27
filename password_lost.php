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
		<form method="post" id='lostpassword' class="formulaire" action="password_lost.php">

			<div id="titre">Mot de passe oublié</div>

			<div class="texte">Adresse e-mail</div>

			<input class="field" type="text" name="mail">
			<?php 
			if (!empty($_GET["code"])) 
			{
			 	echo '<br><div class="texte">Code de réinitialisation</div><input class="field" type="text" name="code">';
			} 
			?>
			<br>
			<input id="bouton" type="submit" value="Réinitialisation du mot de passe">
		</form>
		
		<div id="forget"><a class="link" href="login.php">Retour à l'écran de connexion</a></div>
	</div>

	<?php 
	include("template/connexionbdd.php");

	if(isset($_POST["mail"]) AND empty($_POST["code"]))
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
			echo '<div class="ok">Un code de réinitialisation vous a été envoyé par email.</div>';
			$to      = verification($_POST["mail"]);

			$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail= '" . $to . "'");
			$reponse2 = $bdd->query("SELECT * FROM Utilisateur WHERE mail= '" . $to . "'");
			$donnees = $reponse->fetch();
			$mail_existant=($reponse2->fetchColumn()==0)?1:0;


			if (!$mail_existant) 
			{

				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($i = 0; $i < 10; $i++) 
				{
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}

				$subject = '[iHouse] Mot de passe perdu';

				if ($donnees["genre"] ==  "homme") 
				{
					$genre = 'M.';
				}
				elseif ($donnees["genre"] ==  "femme")
				{
					$genre = 'Mme';
				}

				$message = 'Bonjour ' . $genre . ' ' . $donnees["prenom"] . ' ' . $donnees["nom"] . ',<br><br>
				Vous avez signalé sur le site Web d\'iHouse que vous avez
				oublié votre mot de passe.<br><br>
				Vous avez maintenant la possibilité de modifier votre mot
				de passe en saisissant le code généré ci-dessous dans la page de réinitialisation de mot de passe : <br>' . $randomString;
				$headers = 'From: password_lost@ihouse-panel.com' . "\r\n" .
				'Reply-To: password_lost@ihouse-panel.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

				$id = $donnees["id_utilisateur"];

				$bdd->exec("INSERT INTO password_lost SET id_utilisateur = '$id', code = '$randomString', validite = NOW()");

				mail($to, $subject, $message, $headers);

				die("<script>location.href = 'https://www.ihouse-panel.com/git/password_lost.php?code=1'</script>");

			}
			

		}
	}

	?>

</body>
</html>