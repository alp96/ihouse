<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Modification d'utilisateur</title>
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
	
	if ($donnees['type_compte'] == "Administrateur" OR $donnees['type_compte'] == "Maintenance") {
		?>
		<div id='wrap4'>
			<?php
			include("template/nav.php");
			?>
			<div id="content">

				<div id="recherche" class="formulaire marge_haut">
					<div id="titre">Recherche</div>
					<div id="filling">Veuillez renseigner un champ pour lancer la recherche :</div>
					<br>
					<form method="post" action="recherche_user.php">
						<div class="texte">Nom :</div>
						<input class="field" type="text" name="champs_nom">
						<div class="texte">Prénom :</div>
						<input class="field" type="text" name="champs_prenom">
						<div class="texte">Mail :</div>
						<input class="field" type="text" name="champs_mail" style="margin-bottom: 20px;">
						<br>
						<input id="bouton" class="no_marge" type="submit" name="valider" value="Rechercher">
					</form>

				</div>

			</div>
		</div>
		<?php 
	}
	else{
		die("<script>location.href = 'https://www.ihouse-panel.com/git/default.php'</script>");
	}	?>
</body>
</html>