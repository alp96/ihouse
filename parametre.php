<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="favicon.png" />
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
			<form method="post" id='modif_email' action="parametre.php">
				<div class="texte">Numéro de téléphone actuel :
					<br>
					<?php echo $donnees["telephone"]; ?>
				</div>
				<input class="field" type="text" name="phone">
				<br>
				<input id="bouton" type="submit" value="Modifier le numéro">
			</form>
		</div>
	</div>
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST["phone"]) OR isset($_POST["mail"])) 
		{
			$mail = $donnees["mail"];
			if (isset($_POST["mail"])) {
				$_POST["mail"] = verification($_POST["mail"]);
				if($_POST["mail"] == '')
				{
					echo '<div class="error">Veuillez renseigner l\'adresse e-mail</div>';
				}
				elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) 
				{
					echo '<div class="error">Veuillez rentrer une adresse mail valide</div>';
				}
				elseif ($_POST["mail"] != '') {
					$new_mail = $_POST["mail"];
					$bdd->exec("UPDATE Utilisateur SET mail = '$new_mail' WHERE mail = '$mail'");

					die("<script>location.href = 'https://www.ihouse-panel.com/git/parametre.php'</script>");
				}
			}
			if (isset($_POST["phone"])) {
				$_POST["mail"] = verification($_POST["mail"]);
			}

		}
	}
?>

</body>
</html>