<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (isset($_POST["name"]) AND isset($_POST["last_name"]) AND isset($_POST["mail"]) AND isset($_POST["phone"]) AND isset($_POST["account_type"])) {

		include("template/connexionbdd.php");

		$name = verification($_POST["name"]);
		$last_name = verification($_POST["last_name"]);
		$mail = verification($_POST["mail"]);
		$phone = verification($_POST["phone"]);
		$account_type = verification($_POST["account_type"]);
		$options = ['cost' => 11,];
		$password = password_hash("test", PASSWORD_BCRYPT, $options);
		$id_house = '0';

		$bdd->exec("INSERT INTO Utilisateur(id_utilisateur, nom, prenom, mail, password, telephone, type_compte, id_maison) VALUES (DEFAULT, '$name', '$last_name', '$mail', '$password', '$phone', '$account_type', '$id_house')");

		die("<script>location.href = 'https://www.ihouse-panel.com/git/create_user.php'</script>");

	}
}
?>