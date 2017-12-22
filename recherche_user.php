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

					function recherche($champs_recherche, $colonne){
						if (isset($champs_recherche)) {
							$champs = verification($champs_recherche);
							if ($champs != "") {
								$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE '$colonne' LIKE '$champs%'");
								$counter = 0;
								echo "<div class='titre_recherche'>Résultat de la recherche pour le nom " . $champs . "</div><br>";
								echo "<table><tr><td class='cellule gras'>N°</td><td class='cellule gras'>Nom</td><td class='cellule gras'>Prénom</td><td class='cellule gras'>Adresse email</td><td class='cellule'></td>";
								while ($donnees = $reponse->fetch())
								{
									$counter = $counter + 1;

									$tableau = array('id_user' => $donnees['id_utilisateur']);

									$url = "http://ihouse-panel.com/git/resultat.php?" . http_build_query($tableau, '', "&");

									echo "<tr><td class='cellule'>";
									echo $counter . "</td><td class='cellule'>" . $donnees['nom'] . "</td><td class='cellule'>" . $donnees['prenom'] . "</td><td class='cellule'>" . $donnees['mail'] . "</td><td class='cellule'><a href='" . $url . "'>Modifier</a>";
									echo '</td></tr>';
								}
								echo "</table>";
								$reponse->closeCursor();
							}
						}
					}

					recherche($_POST["champs_nom"], "nom")

					/*if (isset($_POST["champs_nom"])) {
						$nom = verification($_POST["champs_nom"]);
						if ($nom != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE nom LIKE '$nom%'");
							$counter = 0;
							echo "<div class='titre_recherche'>Résultat de la recherche pour le nom " . $nom . "</div><br>";
							echo "<table><tr><td class='cellule gras'>N°</td><td class='cellule gras'>Nom</td><td class='cellule gras'>Prénom</td><td class='cellule gras'>Adresse email</td><td class='cellule'></td>";
							while ($donnees = $reponse->fetch())
							{
								$counter = $counter + 1;

								$tableau = array('id_user' => $donnees['id_utilisateur']);

								$url = "http://ihouse-panel.com/git/resultat.php?" . http_build_query($tableau, '', "&");

								echo "<tr><td class='cellule'>";
								echo $counter . "</td><td class='cellule'>" . $donnees['nom'] . "</td><td class='cellule'>" . $donnees['prenom'] . "</td><td class='cellule'>" . $donnees['mail'] . "</td><td class='cellule'><a href='" . $url . "'>Modifier</a>";
								echo '</td></tr>';
							}
							echo "</table>";
							$reponse->closeCursor();
						}
					}*/

					if (isset($_POST["champs_prenom"])) {
						$prenom = verification($_POST["champs_prenom"]);
						if ($prenom != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE prenom LIKE '$prenom%'");
							$counter = 0;
							echo "<div class='titre_recherche'>Résultat de la recherche pour le prénom " . $prenom . "</div><br>";
							echo "<table><tr><td class='cellule gras'>N°</td><td class='cellule gras'>Prénom</td><td class='cellule gras'>Nom</td><td class='cellule gras'>Adresse email</td><td class='cellule'></td>";
							while ($donnees = $reponse->fetch())
							{
								$counter = $counter + 1;

								$tableau = array('id_user' => $donnees['id_utilisateur']);

								$url = "http://ihouse-panel.com/git/resultat.php?" . http_build_query($tableau, '', "&");

								echo "<tr><td class='cellule'>";
								echo $counter . "</td><td class='cellule'>" . $donnees['prenom'] . "</td><td class='cellule'>" . $donnees['nom'] . "</td><td class='cellule'>" . $donnees['mail'] . "</td><td class='cellule'><a href='" . $url . "'>Modifier</a>";
								echo '</td></tr>';
							}
							echo "</table>";
							$reponse->closeCursor();
						}
					}

					if (isset($_POST["champs_mail"])) {
						$mail = verification($_POST["champs_mail"]);
						if ($mail != "") {
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail LIKE '$mail%'");
							$counter = 0;
							echo "<div class='titre_recherche'>Résultat de la recherche pour le mail " . $mail . "</div><br>";
							echo "<table><tr><td class='cellule gras'>N°</td><td class='cellule gras'>Adresse email</td><td class='cellule gras'>Nom</td><td class='cellule gras'>Prénom</td><td class='cellule'></td>";
							while ($donnees = $reponse->fetch())
							{
								$counter = $counter + 1;

								$tableau = array('id_user' => $donnees['id_utilisateur']);
								echo "<tr><td class='cellule'>";
								echo $counter . "</td><td class='cellule'>" . $donnees['mail'] . "</td><td class='cellule'>" . $donnees['nom'] . "</td><td class='cellule'>" . $donnees['prenom'] . "</td><td class='cellule'><a href='" . $url . "'>Modifier</a>";
								echo '</td></tr>';
							}
							echo "</table>";
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