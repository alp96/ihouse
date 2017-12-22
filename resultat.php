<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Résultat de la recherche</title>
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
			if (is_numeric($_GET["id_user"]) OR isset($_SESSION["id_transmis"])) 
			{
				if (isset($_GET["id_user"])) {
					$id_user = $_GET["id_user"];
					echo $id_user;
					$_SESSION["id_transmis"] = $id_user;
				}
				else
				{
					$id_user = $_SESSION["id_transmis"];
				}

				$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE id_utilisateur='" . $id_user . "'");
				$donnees = $reponse->fetch();
				$reponse->closeCursor();
				?>

				<div id="content">
					<div class="formulaire marge_haut">
						<form method="post" id='modif_user' action="resultat.php">

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
								<input class="field" type="text" name="new_lastname">
								<br>
							</div>
							<div class="texte">Adresse e-mail :
								<br>
								<?php echo $donnees["mail"]; ?>
								<br>
								<input class="field" type="text" name="new_mail">
								<br>
							</div>
							<div class="texte">Numéro de téléphone :
								<br>
								<?php echo $donnees["telephone"]; ?>
								<br>
								<input class="field" type="text" name="new_telephone">
								<br>
							</div>
							<input id="bouton" type="submit" value="Modifier les données">

						</form>
					</div>
				</div>
				<?php 
				if($_SERVER["REQUEST_METHOD"] == "POST") 
					{if (isset($_POST["new_name"]) OR isset($_POST["new_lastname"]) OR isset($_POST["new_mail"]) OR isset($_POST["new_telephone"]) OR isset($_POST["account_type"])) {

						$id_user = $_SESSION["id_transmis"];
						
						//regarde quelles sont les données à modifier dans la bdd
						if ($_POST["new_name"] != $donnees["nom"] AND $_POST["new_name"] != "") {
							$modif_name = $_POST["new_name"];
						}
						elseif ($_POST["new_name"] == "" OR $_POST["new_name"] == $donnees["nom"]) {
							$modif_name = $donnees["nom"];
						}

						if ($_POST["new_lastname"] != $donnees["prenom"] AND $_POST["new_lastname"] != "") {
							$modif_lastname = $_POST["new_lastname"];
						}
						elseif ($_POST["new_lastname"] == "" OR $_POST["new_lastname"] == $donnees["prenom"]) {
							$modif_lastname = $donnees["prenom"];
						}

						if ($_POST["new_mail"] != $donnees["mail"] AND $_POST["new_mail"] != "") {
							$modif_mail = $_POST["new_mail"];
						}
						elseif ($_POST["new_mail"] == "" OR $_POST["new_mail"] == $donnees["mail"]) {
							$modif_mail = $donnees["mail"];
						}

						if ($_POST["new_telephone"] != $donnees["telephone"] AND $_POST["new_telephone"] != "") {
							$modif_telephone = $_POST["new_telephone"];
						}
						elseif ($_POST["new_telephone"] == "" OR $_POST["new_telephone"] == $donnees["telephone"]) {
							$modif_telephone = $donnees["telephone"];
						}

						$modif_name = verification($modif_name);
						$modif_lastname = verification($modif_lastname);
						$modif_telephone = verification($modif_telephone);
						$modif_mail = verification($modif_mail);

						$bdd->exec("UPDATE Utilisateur SET nom = '$modif_name', prenom = '$modif_lastname', mail = '$modif_mail', telephone = '$modif_telephone' WHERE id_utilisateur='" . $id_user . "'");
						echo '<div class="ok">Utilisateur modifié avec succès</div>';
					}
				}
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