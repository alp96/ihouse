<?php 
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))
{
	die("<script>location.href = '/login.php'</script>");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="images/favicon.png" />
	<meta charset="UTF-8">
	<title>Statistiques</title>

	<?php
	include("template/header.php");
	?>
</head>
<body>
	<div id='wrap4'>
		<div id="content">

			<form method="post" class="formulaire" action="stats.php">

				<div id="titre">Graphique à afficher :</div>

				<?php  if (!empty($_POST["genre"])) {
					?>
					<select name="genre" size = "1" class="selection">
						<option value="Temperature" <?php if ($_POST["genre"] == "Temperature") {echo "selected";}?>>Température</option>
						<option value="Luminosite" <?php if ($_POST["genre"] == "Luminosite") {echo "selected";}?>>Lunimosité</option>
						<option value="Humidite" <?php if ($_POST["genre"] == "Humidite") {echo "selected";}?>>Humidité</option>
						<option value="Pression" <?php if ($_POST["genre"] == "Pression") {echo "selected";}?>>Pression</option>
					</select>
					<br>
					<select name="choix" size="1" class="selection">
						<option>Actuelle</option>
						<option>Dans le temps</option>
						<?php 
						$reponse = $bdd->query("SELECT * FROM Maison");
						var_dump($reponse);
						while ($donnees == $reponse->fetch()) {
							echo "<option>Maison " + $donnees["id_maison"] + "</option>";
						}
						?>
						
					</select>
					<?php
				}
				else{
					?>
					<select name="genre" size = "1" class="selection">
						<option value="Temperature">Température</option>
						<option value="Luminosite">Luminosité</option>
						<option value="Humidite">Humidité</option>
						<option value="Pression">Pression</option>
					</select>
					<?php
				}
				?>

				<br>

				<input id="bouton" type="submit" value="Choisir ce capteur">

			</form>

			<?php 
			$titre = "";
			$titre_colonne2 = "";
			$chart = "line";
			$option_chart = "";
			$chart_name = "LineChart";

			if ((!empty($_POST["genre"]) && !empty($_POST["choix"]))) {
				if ($_POST["genre"] == "Temperature") {
					$resultat = "Temperature";
					$titre = "Température";
					$titre_colonne2 = "°C";
					$chart = "bar";
					$option_chart = "isStacked: true,";
					$chart_name = "ColumnChart";

				}
				if ($_POST["genre"] == "Pression") {
					$resultat = "Pression";
					$titre = "Pression";
					$titre_colonne2 = "bar";

				}
				if ($_POST["genre"] == "Humidite") {
					$resultat = "Humidite";
					$titre = "Humidité";
					$titre_colonne2 = "%";

				}
				if ($_POST["genre"] == "Luminosite") {
					$resultat = "Luminosite";
					$titre = "Luminosité";
					$titre_colonne2 = "I/O";
				}
			}
			 ?>

			<div id="piechart"></div>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

			<script type="text/javascript">
				// Load google charts 
				google.charts.load('current', {packages: ['corechart', '<?php echo $chart; ?>']});
				google.charts.setOnLoadCallback(drawChart);

				// Draw the chart and set the chart values
				function drawChart() {
					var data = new google.visualization.DataTable();
					data.addColumn('number', 'X');
					data.addColumn('number', '<?php echo $titre_colonne2 ?> ');

					data.addRows([
						[0, 0],   [1, 10],  [2, 23],  [3, 17],  [4, 18],  [5, 9],
						[6, 11],  [7, 27],  [8, 33],  [9, 40],  [10, 32], [11, 35],
						[12, 30], [13, 40], [14, 42], [15, 47], [16, 44], [17, 48],
						[18, 52], [19, 54], [20, 42], [21, 55], [22, 56], [23, 57],
						[24, 60], [25, 50], [26, 52], [27, 51], [28, 49], [29, 53],
						[30, 55], [31, 60], [32, 61], [33, 59], [34, 62], [35, 65],
						[36, 62], [37, 58], [38, 55], [39, 61], [40, 64], [41, 65],
						[42, 63], [43, 66], [44, 67], [45, 69], [46, 69], [47, 70],
						[48, 72], [49, 68], [50, 66], [51, 65], [52, 67], [53, 70],
						[54, 71], [55, 72], [56, 73], [57, 75], [58, 70], [59, 68],
						[60, 64], [61, 60], [62, 65], [63, 67], [64, 68], [65, 69],
						[66, 70], [67, 72], [68, 75], [69, 80]
						]);

				  // Optional; add a title and set the width and height of the chart
				  var options = {
				  	hAxis: {
				  		title: 'Capteur'
				  	},
				  	vAxis: {
				  		title: '<?php echo $titre; ?>'
				  	},
				  	<?php echo $option_chart;?>
				  };

				  // Display the chart inside the <div> element with id="piechart"
				  var chart = new google.visualization.<?php echo $chart_name; ?>(document.getElementById('piechart'));
				  chart.draw(data, options);
				}
			</script>
		</div>
	</div>
</body>