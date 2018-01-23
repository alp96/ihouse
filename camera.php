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
	$id_user = $_SESSION['id'];
	?>
	<div id='wrap4'>
		<?php
		//include("template/nav.php");
		?>
		<div id="content">

			<div>Vos caméras de surveillance disponibles :</div>

			<?php 

			$reponse = $bdd->query("SELECT * FROM camera WHERE id_utilisateur='" . $id_user . "'");
			echo $id_user . 'ok';
			while($donnees = $reponse->fetch())
			{
				echo $id_user;
				echo '<iframe width="560" height="315" src="' . $donnees["url"] . '" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>';
			}
			$reponse->closeCursor();

			 ?>

			<iframe width="560" height="315" src="https://www.youtube.com/embed/5DgFlQD5CNY" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>

			<div>Désactiver vos caméras</div>
			<div>Merci de tapper votre mot de passe pour confirmer</div>
			<form method="post" action="camera.php">
				<input type="password" name="mdp" id="bouton">
				<input type="submit" name="submi" value="Valider">
			</form>

			<?php 

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST["mdp"])) {
					echo '<div class="error">Merci de saisir votre mot de passe</div>';
				}
				else
				{
					$password = verification($_POST["mdp"]);
					$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE id_utilisateur='" . $id_user . "'");
					$donnees = $reponse->fetch();
					$reponse->closeCursor();
					if (password_verify($password, $donnees["password"])) {
						$camera = "off";
					}
				}
			}

			?>
		</div>
	</div>
</body>
</html>