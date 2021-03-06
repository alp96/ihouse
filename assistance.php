<?php
	session_start();

	include("template/connexionbdd.php");

/*Cette fonction vérifie le type de compte du client (simple-user ou technicien/admin)*/
	$reponse = $bdd->query('SELECT type_compte FROM Utilisateur WHERE id_utilisateur='.$_SESSION['id_utilisateur'].'');
					$donnees = $reponse->fetch();
					$reponse->closeCursor();
					if ($donnees["type_compte"] != 'Administrateur') {
						$_SESSION['droit_maintenance'] = 0;
					}
					if ($donnees["type_compte"] == 'Administrateur' OR $donnees["type_compte"] == 'Technicien' OR $donnees["type_compte"] == 'Maintenance') {
						$_SESSION['droit_maintenance'] = 1;
					}
/*echo $_SESSION['droit_maintenance'];*/
?>

<!DOCTYPE html>
<html>

	<head>

		<title>Assistance</title>
		<meta charset="utf-8" />

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="style_panel.css">
		<link rel="stylesheet" href="assistance/style_Boite_Message.css">
		<link rel="stylesheet" href="assistance/style_Boite_ticket.css">

		<link rel="icon" href="images/favicon.png" />

		<script type="text/javascript" src="assistance/script_assistance.js"></script>

	</head>

	<style>
		#button_assistance
		{
			border-color: #283152;
			color: white;
			background-color: #283152;
			border-radius: 5px;
			border: 0px;					
			padding: 5px 10px;
			box-shadow: 2px 2px 20px #1f1f4a;
			font-size: 16px;
		}

		#ticket_inbox
		{
			width: 45%;
		}

		.ticket_box
		{
	  		overflow: auto;
  		}

  		.message_box
		{
	  		overflow: auto;
  		}	

		#container{
			display: inline-block;
			position: absolute;
			width:100%;
			height:auto;
			left:0px;
			top:140px;
		    	display: flex;
    			justify-content: space-around;
		}

	</style>
	
	<body>

		<?php
			include("template/header.php");
			//include("../template/nav.php");
		?>

		<div id="container">

			<!--Affichage du tableau des tickets-->
			<table id="tablesujet" class="ticket_box">
				<thead id="theadsujet">
					<tr>
						<?php
						if ($_SESSION['droit_maintenance']==0) {
						echo '
							<th colspan="3">
								<label for="sujet">Nouveau sujet :</label>
								<input type="text" name="ticket" id="ticket_inbox" />
								<input id="button_assistance" type="submit" value="Envoyer" onclick="post_sujet()" />
							</th>'; //id=submit_ticket
						}
						?>
					</tr>
					<tr>
						<th>Sujet</th>
						<th>Date & Heure</th>
						<th>Etat</th>
					</tr>
				</thead>
				<tbody id="tbodysujet">		
					<?php
						include("assistance/getTicket.php");
					?>
			    </tbody>
			</table>
			<!--Fin du tableau des tickets-->

			<!--Affichage des messages en ajax-->
			<div id="MessageHint">
				<!--Selectionner un sujet pour afficher les messages-->
			</div>

		</div>

		<script>
			//On simule un clique au chargement de la page pour que ajax charge les messages du dernier ticket consulté
			ticket_clic(0);
		</script>

	</body>
</html>
