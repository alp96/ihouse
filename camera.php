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
		die("<script>location.href = '/login.php'</script>");
	}
	include("template/header.php");
	$id_user = $_SESSION['user'];
	$reponse2 = $bdd->query("SELECT * FROM Utilisateur WHERE mail= '" . $id_user . "'");
	$donnees2 = $reponse2->fetch();
	$id_user = $donnees2["id_utilisateur"];


	if ($_SERVER["REQUEST_METHOD"] == "GET") 
	{
		if (!empty($_GET["activate"])) 
		{
			if (is_numeric($_GET["activate"])) 
			{
				$id_camera = $_GET["activate"];
				$reponse3 = $bdd->query("SELECT * FROM camera WHERE id_utilisateur='" . $id_user . "' AND id_camera = '" . $id_camera . "' AND active = 'false'");
				$donnees3 = ($reponse3->fetchColumn()==0)?1:0;
				if ($donnees3 == 0) 
				{
					$new_camera = $bdd->query("UPDATE camera SET active = 'true' WHERE id_camera ='$id_camera'");
				}
			}
		}
		if (!empty($_GET["desactivate"]))
		{
			if (is_numeric($_GET["desactivate"])) 
			{
				$id_camera = $_GET["desactivate"];
				$reponse3 = $bdd->query("SELECT * FROM camera WHERE id_utilisateur='" . $id_user . "' AND id_camera = '" . $id_camera . "' AND active = 'true'");
				$donnees3 = ($reponse3->fetchColumn()==0)?1:0;
				if ($donnees3 == 0) 
				{
					$new_camera = $bdd->query("UPDATE camera SET active = 'false' WHERE id_camera ='$id_camera'");
				}
			}
		}
	}

	?>
	<div id='wrap4'>
		<div id="content">

			<div class="titre_cam">Vos caméras de surveillance disponibles :</div>

			<?php 

			$reponse = $bdd->query("SELECT * FROM camera WHERE id_utilisateur='" . $id_user . "'");
			$compteur = 0;
			$active = 0;
			while($donnees = $reponse->fetch())
			{
				$compteur ++;
				if($donnees["active"] == 'true')
				{
					$active++;
					echo '<div class="ligne">Caméra n°' . $compteur . '   <a href="/camera.php?desactivate=' . $donnees["id_camera"] . '"><input type="button" name="activate" value="Désactiver" id="bouton" style="margin-top: 10px;"></a><br><iframe class="camera" width="560" height="315" src="' . $donnees["url"] . '" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe></div>';
				}  
			}
			if ($active == 0) 
			{
				echo '<i>Aucune caméra n\'est activée pour le moment.</i><br><br>';
			}
			$reponse->closeCursor();

			?>
			<div class="titre_cam">Vos caméras désactivées :</div>

			<?php 

			$reponse = $bdd->query("SELECT * FROM camera WHERE id_utilisateur='" . $id_user . "'");
			$compteur = 0;
			$desactive = 0;

			while($donnees = $reponse->fetch())
			{
				$compteur ++;
				if($donnees["active"] == 'false')
				{
					$desactive++;
					echo '<div class="ligne">Caméra n°' . $compteur . '   <a href="/camera.php?activate=' . $donnees["id_camera"] . '"><input type="button"  id="bouton" style="margin-top: 10px;" name="activate" value="Activer"></a></div></br>';
				}
			}

			if ($desactive == 0) 
			{
				echo '<i>Aucune caméra n\'est désactivée pour le moment.</i><br>';
			}

			$reponse->closeCursor();

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