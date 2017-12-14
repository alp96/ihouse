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
					Veuillez renseigner au moins un champ pour lancer la recherche :
					<br>
					<form method="post" action="recherche_user.php">
						Nom :
						<br>
						<input type="text" name="champs_nom">
						<input type="submit" name="valider_nom" value="Rechercher !">
						<br>
					</form>
					<form method="post" action="recherche_user.php">
						Prénom :
						<br>
						<input type="text" name="champs_prenom">
						<input type="submit" name="valider_prenom" value="Rechercher !">
						<br>
					</form>
					<form method="post" action="recherche_user.php">
						Mail :
						<br>
						<input type="text" name="champs_mail">
						<input type="submit" name="valider_mail" value="Rechercher !">
						<br>
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