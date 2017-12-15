<div id="menu_fond">
	<ul id="menu_icone">
		<li class="hauteur"><img class="icone" src="images/icone_panneau.png"></li>
		<li class="hauteur"><img class="icone" src="images/icone_camera.png"></li>
		<li class="hauteur"><img class="icone" src="images/icone_parametre.png"></li>
		<?php 
			if ($donnees["type_compte"] == 'Administrateur') {
				echo "<li class='hauteur'><img class='icone' src='images/icone_create_user.png'></li>";
			}
			if ($donnees["type_compte"] == 'Administrateur' OR $donnees["type_compte"] == 'Maintenance') {
				echo "<li class='hauteur'><img class='icone' src='images/icone_modif_user.png'></li>";
			}
		 ?>		
	</ul>

	<ul id="menu">
		<li><a href="default.php" class="link_nav">Panneau de contrôle</a></li>
		<li>Vidéosurveillance</li>
		<li><a href="parametre.php" class="link_nav">Gestion du compte</a></li>
		<?php 
			if ($donnees["type_compte"] == 'Administrateur') {
				echo "<li><a href='create_user.php' class='link_nav'>Création utilisateur</a></li>";
			}
			if ($donnees["type_compte"] == 'Administrateur' OR $donnees["type_compte"] == 'Maintenance') {
				echo "<li><a href='modif_user.php' class='link_nav'>Modification utilisateur</a></li>";
			}
		 ?>
	</ul>
</div>