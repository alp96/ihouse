	<div id="wrap2">
		<img id="logo_mini" src="images/iHouse_logo_blanc.png">
		<div class="info">
			<img id="picture" src="images/man.png">

			<?php 
			include("template/connexionbdd.php");
			$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='" . $_SESSION["user"] . "'");
			$donnees = $reponse->fetch();
			$reponse->closeCursor();

			$name = $donnees["nom"];
			echo '<div id="username">Bonjour';
			if ($donnees["genre"] == "homme") {
				echo "M. ";
			}
			else
			{
				echo "Mme ";	
			}
			echo $name . '</div>';
			}
			?>

			<div id="ID">ID client : FR 09 67 34 2C</div>
			<a href="logout.php" id="logout">Se déconnecter</a>
		</div>
	</div>