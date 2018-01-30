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
				<form method="post" id='create_user' class="formulaire" action="create_capteur.php">

					<div id="titre">Ajout de capteur</div>
                    <br>
					<div class="texte">Type</div>
					<select name="genre" size = "1" class="selection">
						<option>Temperature</option>
						<option>Lunimosite</option>
                        <option>Humidite</option>
                        <option>Pression</option>
					</select>
                    <br>
                    <br>

					<div class="texte">ID maison associé</div>
					<input class="field" type="text" name="name">
					<br>
                    <br>

                    <div class="texte">ID du capteur (optionnel)</div>
					<input class="field" type="text" name="cap">
					<br>
                    <br>

					<input id="bouton" type="submit" value="Ajouter un capteur">

                    
				</form>
			</div>
		</div>
		<?php 

		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if (isset($_POST["name"]) AND isset($_POST["cap"]) AND isset($_POST["genre"])) {

				if ($_POST["name"] != ""){

                    $cap = verification($_POST["cap"]);
                    if ($cap == "")$cap="DEFAULT";
                    else $cap="'"+$cap+"'";
					$name = verification($_POST["name"]);
					$genre = verification($_POST["genre"]);
					
					$bdd->exec("INSERT INTO Capteur(id_maison, id_capteur, type_capteur) VALUES ('$name',$cap,'$genre')");

					echo '<div class="ok">Capteur ajouté avec succès !</div>';
				}
				else
				{
					echo '<div class="error">Erreur ! Des champs sont vides !</div>';
				}
			}
		}
	}
	else{
	die("<script>location.href = '/index.php'</script>");
}	?>
</body>
</html>