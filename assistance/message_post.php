<?php

	session_start();

	include("../template/connexionbdd.php");


	/*Insertion du message à l'aide d'une requête préparée*/
	if(isset($_SESSION['dernier_ticket_consulte']) && $_SESSION['dernier_ticket_consulte']!=0)
	{
		$req = $bdd->prepare('INSERT INTO message (id_ticket,id_utilisateur,message) VALUES(?,?,?)');

		$req->execute(array($_SESSION['dernier_ticket_consulte'],$_SESSION['id_utilisateur'],$_POST['message']));	
	}
?>
