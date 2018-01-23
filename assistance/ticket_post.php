<?php

	session_start();

	include("../template/connexionbdd.php");


	/*Insertion du ticket dans la BDD à l'aide d'une requête préparée*/

	if ($_POST['sujet_ticket']!="") {//On vérifie qu'il y ai bien un sujet

		$req = $bdd->prepare('INSERT INTO ticket (id_utilisateur,sujet,resolu) VALUES(?,?,?)');

		$req->execute(array($_SESSION['id_utilisateur'],$_POST['sujet_ticket'],0));

		include("getTicket.php");
	}

?>