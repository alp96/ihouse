<?php 
try 
{
	$bdd = new PDO('mysql:host=localhost;dbname=db701520246;charset=utf8', 'root', 'ihousebddISEP');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) 
{
	echo 'Échec lors de la connexion : ' . $e->getMessage();
}
?>