<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Création d'utilisateur</title>
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
	
	if ($donnees['type_compte'] == "Administrateur") {
		?>
		<div id='wrap4'>
			<?php
			//include("template/nav.php");
			?>

			<div id="content">
				<form method="post" id='create_user' class="formulaire" action="create_user.php">

					<div id="titre">Création de compte</div>

					<div class="texte">Genre</div>
					<select name="genre" size = "1" class="selection">
						<option>Homme</option>
						<option>Femme</option>
					</select>

					<div class="texte">Nom</div>
					<input class="field" type="text" name="name">

					<div class="texte">Prénom</div>
					<input class="field" type="text" name="last_name">

					<div class="texte">Adresse e-mail</div>
					<input class="field" type="text" name="mail">

					<div class="texte">Numéro de téléphone</div>
					<input class="field" type="text" name="phone">

					<div class="texte">Type de compte</div>
					<select name="account_type" size="1" class="selection">
						<option>Client</option>
						<option>Technicien</option>
						<option>Maintenance</option>
						<option>Administrateur</option>
					</select>

					<br>
					<input id="bouton" type="submit" value="Créer un utilisateur">
				</form>
			</div>
		</div>
		<?php 

		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if (isset($_POST["name"]) AND isset($_POST["last_name"]) AND isset($_POST["mail"]) AND isset($_POST["phone"]) AND isset($_POST["account_type"]) AND isset($_POST["genre"])) {

				if ($_POST["name"] != "" AND $_POST["last_name"] != "" AND $_POST["mail"] != "" AND $_POST["phone"] != ""){

					$name = verification($_POST["name"]);
					$genre = verification($_POST["genre"]);
					$last_name = verification($_POST["last_name"]);
					$mail = verification($_POST["mail"]);
					$phone = verification($_POST["phone"]);
					$account_type = verification($_POST["account_type"]);
					$options = ['cost' => 11,];
					$password = password_hash("test", PASSWORD_BCRYPT, $options);
					$id_house = '0';

					$bdd->exec("INSERT INTO Utilisateur(id_utilisateur, nom, prenom, genre, mail, password, telephone, type_compte, id_maison) VALUES (DEFAULT, '$name', '$last_name', '$genre','$mail', '$password', '$phone', '$account_type', '$id_house')");

					echo '<div class="ok">Utilisateur crée avec succès !</div>';
				}
				else
				{
					echo '<div class="error">Erreur ! Des champs sont vides !</div>';
				}
			}
		}
	}
	else{
	die("<script>location.href = '/default.php'</script>");
}	?>
</body>
</html>