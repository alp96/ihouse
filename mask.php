<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style_login.css">
	<link rel="icon" href="favicon.png" />
	<meta charset="UTF-8">
</head>
<body>

	<section id="wrap2">
		<img id="logo_mini" src="iHouse_logo_blanc.png">
		<div class="info">
			<img id="picture" src="man.png">
			<?php 
			$name = 'Perrier';
			echo '<div id="username">Bonjour M. ' . $name . '</div>';
			?>
			<div id="ID">ID client : FR 09 67 34 2C</div>
			<a href="#" id="logout">Se déconnecter</a>
		</div>
	</section>

	<section id="menu_fond">
		<ul id="menu_icone">
			<li class="hauteur"><img class="icone" src="icone_panneau.png"></li>
			<li class="hauteur"><img class="icone" src="icone_camera.png"></li>
			<li class="hauteur"><img class="icone" src="icone_parametre.png"></li>		
		</ul>

		<ul id="menu">
			<li>Panneau de contrôle</li>
			<li>Vidéosurveillance</li>
			<li>Gestion du compte</li>
		</ul>
	</section>

	<?php 
	
	?>