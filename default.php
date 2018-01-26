<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="style_panel.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Page d'accueil</title>
</head>
<body>

	<?php
	session_start();
	session_regenerate_id();
	if(!isset($_SESSION['user']))
	{
		die("<script>location.href = 'http://ihouse-panel.com/git/login.php'</script>");
	}
	include("template/header.php");
	include("template/nav.php");
	?>
	<div id="container">
		
		<form method="post" id='ajouter_salle' action="default.php">



		<div id="modifiersalles">
			<span class="big">Pièces :</span> 
			<span class="right">
				<input id="bouton" type="button" value="Modifier salles" onclick=cacherbouton()>
			</span>
			<span id="ajout_boutons">
				<input id="fieldsalle" class="fieldsalle" type="text" name="salle">
				<input id="bouton1" type="submit" value="Ajouter la pièce" name="btnsalle">
				<input id="bouton2" type="submit" value="Retour">
			</span>
		</div>


		 <script>  
		 	document.getElementById("bouton1").style.display= 'none' ;
		 	document.getElementById("bouton2").style.display= 'none' ;      
		 	document.getElementById("fieldsalle").style.display= 'none' ;      
		  
     		function cacherbouton() { 
            document.getElementById("bouton").style.display= 'none' ;          
            document.getElementById("fieldsalle").style.display= 'inline-block' ;
            document.getElementById("bouton1").style.display= 'inline-block' ;
            document.getElementById("bouton2").style.display= 'inline-block' ;

 
			var tab = document.getElementsByClassName("submitcross");
			for(var i = 0; i<tab.length;i++)
			{
				tab[i].style.visibility= 'visible' ;
			}
			

      		}
         </script>


		<?php
		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(isset($_POST["salle"])) 
			{
					$_POST["salle"] = verification($_POST["salle"]);
					if($_POST["salle"] == '')
					{
						if(isset($_POST["btnsalle"])) 
						{			
							echo '<div class="error">Cette salle n\'a pas de nom !</div>';
						}
					}
					else {
						$new_salle = $_POST["salle"];
						$maison = $donnees["id_maison"];
						$bdd->exec("INSERT INTO Salle VALUES(NULL,'$maison','$new_salle')");
					}
				}
			}
		?>
		<table>
		<?php	
		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(isset($_POST["action"])) 
			{
					$_POST["submit"] = verification($_POST["submit"]);
					if($_POST["submit"] == '')
					{
						echo '<div class="error">Erreur inattendue, veuillez contacter le support</div>';
					}
					else {
						$id = $_POST["submit"];
						$bdd->exec("DELETE FROM Salle WHERE id_salle=$id");
					}
				}
			}
		?>
		</table>

		</form>

		<form action="" method="post" id="toutessalles">
		<input type="hidden" name="action" value="submit" />


		<?php
			$maison = $donnees["id_maison"];
			
			$liste = $bdd->query("SELECT * FROM Salle WHERE id_maison='$maison'");
			if ($liste) {
				while($row = $liste->fetch()) {
					$nom = $row["nom"];
					$id = $row["id_salle"];
						
					

					echo("
					<div class=\"piece\">
					<div class=\"titresalle\">$nom : 
					<span class=\"right\">
						<input id=\"$id\"  class=\"submitcross\" type=\"submit\" name=\"submit\" value=\"$id\" onclick=\"return confirm('Voulez-vous vraiment supprimer cette salle?')\">
					</span>
					</div>
					<div class=\"capteurbox\">
						
						<h4>Aucun capteur dans cette pièce !</h4>
						<img src =\"ihouse/plus.png\" class=\"capteur\"></img>
						
					</div>
					</div>
					");

					echo ("<script>
					document.getElementById(\"$id\").style.visibility= 'hidden' ;
					</script>
					");
				}
			}
		?>
	</div>
	</form>


	<script>
		function resize(foo)
		{
			wscreen = window.innerWidth;
			content_width = (wscreen - 310);
			if(content_width < 500)content_width=500;
			document.getElementById("container").style.width = content_width + "px";
		}
		resize();
		window.onresize = resize;

		var imgs = document.getElementsByTagName("img");
		for (var i = 0; i < imgs.length; i++) {
			imgs[i].ondragstart = function() {return false; };
		}
		var as = document.getElementsByTagName("a");
		for (var i = 0; i < as.length; i++) {
			as[i].ondragstart = function() {return false; };
		}
	</script>
</body>
</html>