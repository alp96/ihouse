	<div id="wrap2">
		<img id="logo_mini" src="images/iHouse_logo_blanc.png">
		<div class="info">

			<ul id="menu">
				<li><a href="default.php" class="link_nav">Panneau de contrôle</a></li>
				<li><a href="camera.php" class="link_nav">Vidéosurveillance</a></li>
				<li><a href="parametre.php" class="link_nav">Gestion du compte</a></li>
				<li><a href="assistance/assistance.php" class="link_nav">Assistance</a></li>
				<?php 
				include("template/connexionbdd.php");
				$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='" . $_SESSION["user"] . "'");
				$donnees = $reponse->fetch();
				$reponse->closeCursor();
				if ($donnees["type_compte"] == 'Administrateur') {
					echo "<li><a href='create_user.php' class='link_nav'>Création utilisateur</a></li>";
				}
				if ($donnees["type_compte"] == 'Administrateur' OR $donnees["type_compte"] == 'Maintenance') {
					echo "<li><a href='modif_user.php' class='link_nav'>Modification utilisateur</a></li>";
				}
				?>
			</ul>
		</div>

		<div class="info" style="margin-right:  10px;">
			<?php 
			$name = $donnees["nom"];
			if ($donnees["genre"] == "homme") {
				echo '<img id="picture" src="images/man.png">';
			}
			else
			{
				echo '<img id="picture" src="images/woman.png">';
			}
			echo '<div id="username">Bonjour ';
			if ($donnees["genre"] == "homme") {
				echo "M. ";
			}
			else
			{
				echo "Mme ";	
			}
			echo $name . '</div>';
			?>


			<div id="ID">ID client : FR 09 67 34 2C</div>
			<a href="logout.php" id="logout">Se déconnecter</a>
		</div>
	</div>
