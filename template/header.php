	<div id="wrap2">
		<a href="/index.php"><img id="logo_mini" src="images/iHouse_logo_blanc.png"></a>
		<div class="info">

			<?php 
			if(!@include_once('template/connexionbdd.php')) 
			{
				include("template/connexionbdd.php");
			}				 
			$reponse = $bdd->query("SELECT * FROM Utilisateur WHERE mail='" . $_SESSION["user"] . "'");
			$donnees = $reponse->fetch();
			$reponse->closeCursor();
			?>

			<ul id="menu">
				<li <?php if ($donnees["type_compte"] != 'Administrateur' AND $donnees["type_compte"] != 'Maintenance') {echo 'style="font-size: 1.9em;"';} ?>><a href="index.php" class="link_nav">Panneau de contrôle</a></li>
				<li <?php if ($donnees["type_compte"] != 'Administrateur' AND $donnees["type_compte"] != 'Maintenance') {echo 'style="font-size: 1.9em;"';} ?>><a href="camera.php" class="link_nav">Vidéosurveillance</a></li>
				<li <?php if ($donnees["type_compte"] != 'Administrateur' AND $donnees["type_compte"] != 'Maintenance') {echo 'style="font-size: 1.9em;"';} ?>><a href="parametre.php" class="link_nav">Gestion du compte</a></li>
				<li <?php if ($donnees["type_compte"] != 'Administrateur' AND $donnees["type_compte"] != 'Maintenance') {echo 'style="font-size: 1.9em;"';} ?>><a href="assistance.php" class="link_nav">Assistance</a></li>
				<?php 
				if ($donnees["type_compte"] == 'Administrateur') {
					echo "<li><a href='create_user.php' class='link_nav'>Création d'utilisateur</a></li>";
				}
				if ($donnees["type_compte"] == 'Administrateur' OR $donnees["type_compte"] == 'Maintenance') {
					echo "<li><a href='modif_user.php' class='link_nav'>Recherche d'utilisateur</a></li>";
				}
				if ($donnees["type_compte"] == 'Administrateur') {
					echo "<li><a href='create_capteur.php' class='link_nav'>Ajout capteur</a></li>";
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


			<div id="ID">ID client : FR 09 67 34 <?php echo $donnees["id_utilisateur"] ?></div>
			<a href="logout.php" id="logout">Se déconnecter</a>
		</div>
	</div>
