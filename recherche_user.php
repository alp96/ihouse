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
			?>
			<div id="content">
				<?php 
				if($_SERVER["REQUEST_METHOD"] == "POST") 
				{
					if (isset($_POST["champs_nom"])) {
						$nom = verification($_POST["champs_nom"]);
						if ($nom != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE nom LIKE '$nom%'");
							$counter = 0;
							echo "Résultat de la recherche pour le nom " . $nom . "\n";
							while ($donnees = $reponse->fetch())
							{
								$counter = $counter + 1;
								echo $counter . ') ' . $donnees['nom'] . ' ' . $donnees['prenom'] . ' ' . $donnees['mail'];
								echo '<br>';
							}
							$reponse->closeCursor();
						}
					}

					if (isset($_POST["champs_prenom"])) {
						$prenom = verification($_POST["champs_prenom"]);
						if ($prenom != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE prenom LIKE '$prenom%'");
							while ($donnees = $reponse->fetch())
							{
								echo $donnees['prenom'];
								echo '<br>';
							}
							$reponse->closeCursor();
						}
					}

					if (isset($_POST["champs_mail"])) {
						$mail = verification($_POST["champs_mail"]);
						if ($mail != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail LIKE '$mail%'");
							while ($donnees = $reponse->fetch())
							{
								echo $donnees['mail'];
								echo '<br>';
							}
							$reponse->closeCursor();
						}
					}
				}

				?>

			</div>
		</div>
		<?php 
	}
	else{
		die("<script>location.href = 'https://www.ihouse-panel.com/git/default.php'</script>");
	}	?>
</body>
</html>