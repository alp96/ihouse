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
		die("<script>location.href = '/login.php'</script>");
	}
	include("template/header.php");
	#include("template/nav.php");
	?>
	<!-- #######################   CAPTEURS    ##############################-->
	<div id="ajoutcapeurs"> 
		<div id="formajoutcapteurback">
		</div>
		<div id="formajoutcapteur">
			<p>Liste des capteurs disponibles pour votre maison:</p>
			<form method="post" id='ajouter_capteur' action="default.php">
			<input type="hidden" id="capsalle" name="capsalle" value="" />
				<nav class=listecapteurs>
					<ul>
						<?php
							$maison = $donnees["id_maison"];
							
							$liste = $bdd->query("SELECT * FROM Capteur WHERE id_maison='$maison' ORDER BY type_capteur, id_capteur");
							
							if ($liste) {
								while($row = $liste->fetch()) {
									$nom = $row["type_capteur"];
									$vrainom = $row["nom"];
									$id = $row["id_capteur"];
										
									
									echo("
									<li><button name='btncapteur' type='submit' value='$id' class='bouton3'>$nom - Numéro de série : $id <span class='righter'>Nom : $nom $vrainom</span></button></li>
									");
								}
							}
						?>
					</ul>
				</nav>
			</form>

			<button id = "annulerajoutcapteur" class="bouton1" onclick="closecapteur()">Annuler</button>
			
		</div>
	</div>
	<!-- #####################################################################-->
	<div id="container">
		
		<form method="post" id='ajouter_salle' action="default.php">



		<div id="modifiersalles">
			<span class="big">Pièces :</span> 
			<span class="right">
				<input id="bouton" type="button" value="Modifier" onclick=cacherbouton()>
				<input id="fieldsalle" class="fieldsalle" type="text" name="salle">
				<input id="bouton1" type="submit" value="Ajouter la pièce" name="btnsalle">
				<input id="bouton2" type="submit" value="Retour">
			</span>
		</div>


		 <script>  
		 	var cursalle=-1;
			function addcapteur(idsalle)
			{
				document.getElementById("ajoutcapeurs").style.display= 'block' ;
				cursalle=idsalle;
				document.getElementById("capsalle").value = cursalle ;
			}
			function addcapteurfinal(idcapteur)
			{
				alert(cursalle);
				document.getElementById("ajoutcapeurs").style.display= 'block' ;
			}

			function closecapteur()
			{
				document.getElementById("ajoutcapeurs").style.display= 'none' ;
			}

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

				var tab = document.getElementsByClassName("capteurplus");
				for(var i = 0; i<tab.length;i++)
				{
					tab[i].style.visibility= 'visible' ;
				}

				var tab = document.getElementsByClassName("invisibutton");
				for(var i = 0; i<tab.length;i++)
				{
					tab[i].style.display= 'block' ;
				}

				var tab = document.getElementsByClassName("diseditable");
				for(var i = 0; i<tab.length;i++)
				{
					tab[i].contentEditable="true";
					tab[i].classList.add("editable");
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

						$liste = $bdd->query("SELECT * FROM Salle WHERE nom = '$new_salle' ORDER BY nom");
						if($liste && $liste->fetch()){
							echo '<div class="error">Cette salle existe déjà</div>';
						}
						else{
							$maison = $donnees["id_maison"];
							$bdd->exec("INSERT INTO Salle VALUES(NULL,'$maison','$new_salle')");
						}
						
					}
				}
			
			if(isset($_POST["btncapteur"]) && isset($_POST["capsalle"])) 
			{
					$_POST["btncapteur"] = verification($_POST["btncapteur"]);
					$_POST["capsalle"] = verification($_POST["capsalle"]);
					if($_POST["btncapteur"] == '' || $_POST["capsalle"] == '')
					{		
						echo '<div class="error">Erreur inattendue</div>';
					}
					else 
					{
						$new_cap = $_POST["btncapteur"];
						$salle = $_POST["capsalle"];
						$bdd->exec("
						UPDATE Capteur
						SET id_salle = $salle
						WHERE id_capteur = $new_cap
						");
						
						//("INSERT INTO Capteur VALUES(NULL,'$maison','$new_salle')");
					}
			}
		}
		?>

		
		<?php	
		if($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			if(isset($_POST["action"])) 
			{
				if(isset($_POST["submit"])) 
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

				if(isset($_POST["submitcap"])) 
				{
					$_POST["submitcap"] = verification($_POST["submitcap"]);
					if($_POST["submitcap"] == '')
					{
						echo '<div class="error">Erreur inattendue, veuillez contacter le support</div>';
					}
					else {
						$id = $_POST["submitcap"];
						$bdd->exec("
						UPDATE Capteur
						SET id_salle = '-1'
						WHERE id_capteur = $id
						");
					}
				}
					
			}

			if(isset($_POST["nomcap"]) && isset($_POST["idcapteur"]))
			{
				$_POST["nomcap"] = verification($_POST["nomcap"]);
				$_POST["idcapteur"] = verification($_POST["idcapteur"]);

				$new_capnom = $_POST["nomcap"];
				$id_cap = $_POST["idcapteur"];
				$bdd->exec("
				UPDATE Capteur
				SET nom = '$new_capnom'
				WHERE id_capteur = $id_cap
				");
			}

			if(isset($_POST["commande"]) && isset($_POST["idcapteur"]))
			{
				$_POST["commande"] = verification($_POST["commande"]);
				$_POST["idcapteur"] = verification($_POST["idcapteur"]);
				
				$ok = false;
				if($_POST["commande"] == '' || $_POST["idcapteur"] == '' || !is_numeric($_POST["commande"]) )
				{
					echo '<div class="error">Erreur : seuls les nombres sont acceptés en commande</div>';
				}
				else
				{
					if($_POST["typecommande"] == "Temperature")
					{
						if(-1 == $_POST["commande"])
						{
							$ok=true;
							echo '<div class="confirm">Régulation de la température désactivée dans cette pièce</div>';
						}
						else if(0 > $_POST["commande"] || $_POST["commande"] > 40)
						{
							echo '<div class="error">Erreur : Veuillez entrer un nombre entre 0 et 40 (-1 pour désactivation)</div>';
						}
						else{
							$ok=true;
						}
						
						
					}
					else if($_POST["typecommande"] == "Humidite")
					{
						if(-1 == $_POST["commande"])
						{
							$ok=true;
							echo '<div class="confirm">Régulation de l\'humidité désactivée dans cette pièce</div>';
						}
						else if(0 > $_POST["commande"] || $_POST["commande"] > 100)
						{
							echo '<div class="error">Erreur : Veuillez entrer un nombre entre 1 et 100 (-1 pour désactivation)</div>';
						}
						else
						{
							$ok=true;
						}
					}
					else if($_POST["typecommande"] == "Luminosite")
					{
						if(0 > $_POST["commande"] || $_POST["commande"] > 1)
						{
							echo '<div class="error">Erreur</div>';
						}
						else
						{
							$_POST["commande"] = 1-$_POST["commande"];
							$ok=true;
						}
					}
				}
				if($ok)
				{
					$new_cap = $_POST["idcapteur"];
					$comm = $_POST["commande"];
					$bdd->exec("
					UPDATE Capteur
					SET commande = $comm
					WHERE id_capteur = $new_cap
					");
				}
				
				
			}

		}
		?>

		</form>

		<form action="" method="post">
		<input type="hidden" name="action" value="submit" />


		<?php
			$maison = $donnees["id_maison"];
			
			$liste = $bdd->query("SELECT * FROM Salle WHERE id_maison='$maison' ORDER BY nom");
			if ($liste) {
				while($row = $liste->fetch()) {
					$nom = $row["nom"];
					$id = $row["id_salle"];
						
					

					echo("
					<div class=\"piece\">
					<div class=\"titresalle\">$nom : 
					<span class=\"right\">
						<input id=\"cross$id\"  class=\"submitcross\" type=\"submit\" name=\"submit\" value=\"$id\" onclick=\"return confirm('Voulez-vous vraiment supprimer cette salle?')\">
					</span>
					</div>
					<div class=\"capteurbox\">");

					$liste2 = $bdd->query("SELECT * FROM Capteur WHERE id_salle='$id' ORDER BY CASE `type_capteur`
					WHEN 'Pression' THEN 2
					ELSE 1
					END, id_capteur");
					
					$vide=true;
					if($liste2)
					{
						while($row2 = $liste2->fetch()) {
							
							$type = $row2["type_capteur"];
							$value = $row2["valeur"];
							$commande = $row2["commande"];
							$idcap= $row2["id_capteur"];
							$nom= $row2["nom"];
							echo("<div class=\"capteur\">
							<span class=\"right2\">
							<input id=\"crosscap$idcap\"  class=\"submitcross\" type=\"submit\" name=\"submitcap\" value=\"$idcap\" onclick=\"return confirm('Voulez-vous vraiment retirer ce capteur de la salle?')\">
							</span>");
							if($type == "Temperature")
							{
								echo("
								<h3>Température <span class='wrapeditable'><span id='captnom$idcap' class='diseditable'>$nom</span></span></h3>
								
								<h4>Actuelle : $value °C</h4>
								<h4>Souhaitée :  <span id='capt$idcap' name='$type' class='editable' contenteditable='true'>$commande</span>°C</h4>
								<button onclick=\"commandpost($idcap,'','$type');\" type='button' class='bouton3 bouton3center'>Confirmer</button>
								");
							}

							if($type == "Humidite")
							{
								echo("
								<h3>Humidité <span class='wrapeditable'><span id='captnom$idcap' class='diseditable'>$nom</span></span></h3>
								
								<h4>Actuelle : $value %</h4>
								<h4>Souhaitée :  <span id='capt$idcap' name='$type' class='editable' contenteditable='true'>$commande</span>%</h4>
								<button onclick=\"commandpost($idcap,'','$type');\" type='button' class='bouton3 bouton3center'>Confirmer</button>
								");
							}

							if($type == "Luminosite")
							{
								$valst = "aucune";
								if($value==1)$valst = "basse";
								if($value==2)$valst = "moyenne";
								if($value==3)$valst = "élevée";

								$comst = "éteintes";
								if($commande==1)$comst = "allumées";
								if($commande=="")$commande=0;

								$act = "Allumer";
								if($commande==1)$act = "Eteindre";
								echo("
								<h3>Luminosité <span class='wrapeditable'><span id='captnom$idcap' class='diseditable'>$nom</span></span></h3>
								
								<h4>Actuelle : $valst</h4>
								<h4>Lampes :  $comst</h4>
								<button onclick=\"commandpost($idcap,'$commande','$type');\" type='button' class='bouton3 bouton3center'>$act</button>
								");
							}
							if($type == "Pression")
							{
								$valst = "ouvert";
								if($value==1)$valst = "fermé";
								echo("
								<h3>Pression <span class='wrapeditable'><span id='captnom$idcap' class='diseditable'>$nom</span></span></h3>
								
								<h4>Etat : $valst</h4>
								");
							}


							echo("
							<button onclick=\"namepost($idcap);\" type='button' class='bouton3 bouton3center invisibutton'>Changer le nom</button>
							</div>");
							$vide=false;
						}
					}
					if(!$liste2 || $vide)
					{
						echo('<h4>Aucun capteur dans cette pièce !</h4>');
					}
						
					
					echo("
					<img onclick='addcapteur($id)' id=\"capteurplus$id\" src =\"ihouse/plus.png\" class=\"capteurplus\"></img>
					</div>
					</div>
					");

					echo ("<script>
					var tab = document.getElementsByClassName('submitcross');
					for(var i = 0; i<tab.length;i++)
					{
						tab[i].style.visibility= 'hidden' ;
					}
					var tab = document.getElementsByClassName('capteurplus');
					for(var i = 0; i<tab.length;i++)
					{
						tab[i].style.visibility= 'hidden' ;
					}
					</script>
					");
				}
			}
		?>
	</div>
	</form>


	<script>

		function commandpost(captid,com,typ)
		{
			var val = com;//document.getElementById("capt"+captid).innerHTML;
			if(val=='')val=document.getElementById("capt"+captid).innerHTML;
			var val2 = typ;//document.getElementById("capt"+captid).getAttribute("name");

			var nom=document.getElementById("captnom"+captid).innerHTML;
			method = "post";

			//alert(val);
			//alert(val2);

			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", "");

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "commande");
			hiddenField.setAttribute("value", val);

			form.appendChild(hiddenField);

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "idcapteur");
			hiddenField.setAttribute("value", captid);

			form.appendChild(hiddenField);

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "typecommande");
			hiddenField.setAttribute("value", val2);

			form.appendChild(hiddenField);

			document.body.appendChild(form);
			form.submit();
		}

		function namepost(captid)
		{
			var nom=document.getElementById("captnom"+captid).innerHTML;
			method = "post";

			//alert(val);
			//alert(val2);

			var form = document.createElement("form");
			form.setAttribute("method", method);
			form.setAttribute("action", "");

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "idcapteur");
			hiddenField.setAttribute("value", captid);

			form.appendChild(hiddenField);

			var hiddenField = document.createElement("input");
			hiddenField.setAttribute("type", "hidden");
			hiddenField.setAttribute("name", "nomcap");
			hiddenField.setAttribute("value", nom);

			form.appendChild(hiddenField);

			document.body.appendChild(form);
			form.submit();
		}


		var tab2 = document.getElementsByClassName("editable");
		for(var i = 0; i<tab2.length;i++)
		{
			tab2[i].addEventListener('keypress', function(evt) {if (evt.which === 13) {
				evt.preventDefault();
				}
			});
		}
		function resize(foo)
		{
			wscreen = window.innerWidth;
			content_width = (wscreen - 200);
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