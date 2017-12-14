<div id="menu_fond">
	<ul id="menu_icone">
		<li class="hauteur"><img class="icone" src="images/icone_panneau.png"></li>
		<li class="hauteur"><img class="icone" src="images/icone_camera.png"></li>
		<li class="hauteur"><img class="icone" src="images/icone_parametre.png"></li>
		<?php 
			if ($donnees["type_compte"] == 'Administrateur') {
				echo "<li class='hauteur'><img class='icone' src='images/icone_create_user.png'></li>";
			}
		 ?>		
	</ul>

	<ul id="menu">
		<li>Panneau de contrôle</li>
		<li>Vidéosurveillance</li>
		<li><a href="parametre.php" class="link_nav">Gestion du compte</a></li>
		<?php 
			if ($donnees["type_compte"] == 'Administrateur') {
				echo "<li><a href='create_user.php' class='link_nav'>Création utilisateur</a></li>";
			}
		 ?>
	</ul>
</div>