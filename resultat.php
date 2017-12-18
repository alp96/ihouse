<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Résultat recherche</title>
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
			if (is_numeric($_GET["id_user"])) 
			{
				$id_user = $_GET["id_user"];

				$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE id_utilisateur='" . $id_user . "'");
				$donnees = $reponse->fetch();
				$reponse->closeCursor();
				?>

				<div id="content">
					<div class="formulaire marge_haut">
						<form method="post" id='modif_user' action="#">

							<div id="titre">Modifier</div>
							<div class="texte">Nom :
								<br>
								<?php echo $donnees["nom"]; ?>
								<br>
								<input class="field" type="text" name="new_name">
								<br>
							</div>
							<div class="texte">Prénom :
								<br>
								<?php echo $donnees["prenom"]; ?>
								<br>
								<input class="field" type="text" name="new_name">
								<br>
							</div>
							<div class="texte">Adresse e-mail :
								<br>
								<?php echo $donnees["mail"]; ?>
								<br>
								<input class="field" type="text" name="new_name">
								<br>
							</div>
							<div class="texte">Numéro de téléphone :
								<br>
								<?php echo $donnees["telephone"]; ?>
								<br>
								<input class="field" type="text" name="new_name">
								<br>
							</div>
							<div class="texte">Type de compte :
								<br>
								<?php echo $donnees["type_compte"]; ?>
								<br>
								<select name="account_type" size="1">
									<option disabled selected value>Pas de modification</option>
									<option>Client</option>
									<option>Technicien</option>
									<option>Maintenance</option>
									<option>Administrateur</option>
								</select>
								<br>

							</div>
							<input id="bouton" type="submit" value="Modifier les données">

						</form>
					</div>
				</div>
				<?php 
			}
			else {
				echo "<div class='error'>Merci de ne pas tenter de modifier les URL à des fins malveillantes.</div>";
			} ?>
		</div>
		<?php
	}
	?>
</body>
</html>