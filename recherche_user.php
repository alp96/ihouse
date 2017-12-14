<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	include("template/connexionbdd.php");

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

?>