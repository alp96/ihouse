<!DOCTYPE html>
<html id='first_page'>
<head>
	<title>Se connecter - iHouse</title>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<div class="wrap">
		<img id="logo" src="images/iHouse.png">
	</div>


	<div class="wrap">
		<form method="post" id='connexion' action="login.php">

			<div id="titre">Espace personnel</div>

			<div class="texte">Adresse e-mail</div>

			<input class="field" type="text" name="mail">

			<div class="texte">Mot de passe</div>

			<input class="field" type="password" name="password">
			<br>
			<input id="bouton" type="submit" value="Se connecter">
		</form>
	</div>
	<div class="wrap">
		<div id="forget"><a class="link" href="password_lost.php">Identifiants oubliés ?</a></div>
	</div>

	<?php 
	include("template/connexionbdd.php");

	function verification($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'ihousebddISEP');
	define('DB_DATABASE', 'db701520246');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["password"]) && isset($_POST["mail"])) {


/*
			$myusername = mysqli_real_escape_string($db,$_POST['mail']);
			$mypassword = mysqli_real_escape_string($db,$_POST['password']); 

			$sql = "SELECT password FROM `Utilisateur` WHERE `mail`=".$_POST['mail']."";
			$result = mysqli_query($db,$sql);
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
    			// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "password: " . $row["password"];
				}
			} else {
				echo "0 results";
			}

			echo gettype($result);*/

			$bdd = new PDO('mysql:host=localhost;dbname=db701520246;charset=utf8', 'root', 'ihousebddISEP');
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}
			$reponse = $bdd->query("SELECT password FROM `Utilisateur` WHERE `mail`=".$_POST['mail']."");
			$donnees = $reponse->fetch();
			echo $donnees["password"];
			$reponse->closeCursor();



			$options = ['cost' => 11,];
			if (password_verify(password_hash($_POST["password"],PASSWORD_BCRYPT, $options), $reponse)) {
				echo "ok";
			}
			else {
				echo "erreur mdr";
			}
		/*

      // If result matched $myusername and $mypassword, table row must be 1 row
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$active = $row['active'];

			$count = mysqli_num_rows($result);

		if($count == 1) {
			session_register("myusername");
			$_SESSION['login_user'] = $myusername;

			die("<script>location.href = 'https://www.ihouse-isep.com/app/v1/index.php'</script>");
		}else {
			$error = "Your Login Name or Password is invalid";
		}*/

	}
}

	/*if(isset($_POST["password"]) && isset($_POST["mail"]))
	{

		$_POST["mail"] = verification($_POST["mail"]);
		$_POST["password"] = verification($_POST["password"]);

		$options = [
			'cost' => 11,
		];

		$_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, $options)."\n";

		$req = $conn->prepare('SELECT mail, password FROM Utilisateur WHERE mail = ?');
		$req->execute(array($_GET['mail']));

		echo $_GET['mail'];

		if($_POST["mail"] == '')
		{
			echo '<div class="error">Veuillez renseigner l\'adresse e-mail</div>';
		}
		elseif($_POST["password"] == '')
		{
			echo '<div class="error">Veuillez renseigner le mot de passe</div>';
		}
		elseif (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) 
		{
			echo '<div class="error">Veuillez rentrer une adresse mail valide</div>';
		}
		elseif ($_POST["mail"] != '' && $_POST["password"] != '')
		{
			if($_POST["mail"] != "test@test.com")
			{
				echo '<div class="error">Utilisateur inconnu</div>';
			}
			elseif($_POST["password"] != "juniorisep")
			{
				echo '<div class="error">Mauvais mot de passe</div>';
			}
			elseif($_POST["password"] == "juniorisep" && $_POST["mail"] == "test@test.com")
			{
				die("<script>location.href = 'https://www.ihouse-isep.com/app/v1/index.php'</script>");
			}
		}
	}
}*/
?>

</body>
</html>