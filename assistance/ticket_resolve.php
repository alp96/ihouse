<?php
	session_start();

	//include("../template/connexionbdd.php");


	/*Mise à 1 de la valeur "résolu" dans la BDD à l'aide d'une requête préparée*/

	$bdd->exec('UPDATE ticket SET  resolu= 1 WHERE id_ticket = '.$_POST['id_ticket'].'');

?>
