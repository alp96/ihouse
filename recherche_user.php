<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	include("template/connexionbdd.php");

	if (isset($_POST["champs_nom"])) {
		$nom = verification($_POST["champs_nom"]);
		if ($nom != "") {
			$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE nom LIKE '$nom%'");
			while ($donnees = $reponse->fetch())
			{
				echo $donnees['nom'];
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