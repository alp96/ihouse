<?php

session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
	die("<script>location.href = '/login.php'</script>");
}

try 
{
	$bdd = new PDO('mysql:host=localhost;dbname=ihouse;charset=utf8', 'root', '');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) 
{
	echo 'Échec lors de la connexion : ' . $e->getMessage();
}


$data[] = array('Température','Numéro capteur');



$query = $bdd->query("SELECT * FROM capteur WHERE type_capteur = 'Temperature'");


while($result = $query->fetch())

{

	$data[] = array($result['id_capteur'], $result['valeur']);

}

echo json_encode($data);
?>
