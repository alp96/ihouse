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
		die("<script>location.href = '/login.php'</script>");
	}
	include("template/header.php");
	
	if ($donnees['type_compte'] == "Administrateur" OR $donnees['type_compte'] == "Maintenance") {
		?>
		<div id='wrap4'>
			<?php
			//include("template/nav.php");
			?>
			<div id="content">
				<?php 
				if($_SERVER["REQUEST_METHOD"] == "POST") 
				{

					function recherche($champs_recherche, $colonne){ //fonction de recherche sur le nom, prénom ou mail
						$bdd = new PDO('mysql:host=localhost;dbname=db701520246;charset=utf8', 'root', 'ihousebddISEP');
						
						$champs = verification($champs_recherche);
						if ($champs != "") 
						{
							$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE $colonne LIKE '$champs%' ORDER BY $colonne");
							if (is_array($donnees = $reponse->fetch()))
							{
								$counter = 0;
								echo "<div class='titre_recherche'>Résultat de la recherche pour le " . $colonne . " " . $champs . "</div><br>";
								echo "<table><tr><td class='cellule gras'>N°</td><td class='cellule gras'>Nom</td><td class='cellule gras'>Prénom</td><td class='cellule gras'>Adresse email</td><td class='cellule'></td>";
								do 
								{
									$counter = $counter + 1;

									$tableau = array('id_user' => $donnees['id_utilisateur']);

									$url = "http://ihouse-panel.com/git/resultat.php?" . http_build_query($tableau, '', "&");

									echo "<tr><td class='cellule'>";
									echo $counter . "</td><td class='cellule'>" . $donnees['nom'] . "</td><td class='cellule'>" . $donnees['prenom'] . "</td><td class='cellule'>" . $donnees['mail'] . "</td><td class='cellule'><a href='" . $url . "'>Modifier</a>";
									echo '</td></tr>';
								}while($donnees = $reponse->fetch());
								echo "</table>";
							}
							else
							{
								echo "<div class='titre_recherche'>Résultat de la recherche pour le " . $colonne . " " . $champs . "</div><br>";
								echo "<div class='titre_recherche'>Aucun résultat !</div>";
							}
						$reponse->closeCursor();
					}
				}

				if (isset($_POST["champs_nom"])) {
					recherche($_POST["champs_nom"], "nom");
				}

				if (isset($_POST["champs_prenom"])) {
					recherche($_POST["champs_prenom"], "prenom");
				}

				if (isset($_POST["champs_mail"])) {
					recherche($_POST["champs_mail"], "mail");
				}
			}

			?>

		</div>
	</div>
	<?php 
}
else{
	die("<script>location.href = '/index.php'</script>");
}	?>
</body>
</html>