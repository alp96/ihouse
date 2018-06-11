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

	<!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<script>
		google.charts.load('current', '1', {packages: ['corechart', 'bar']});
		google.charts.setOnLoadCallback(drawAxisTickColors);

		function drawAxisTickColors() 
		{
			var data = new google.visualization.DataTable();
			data.addColumn('timeofday', 'Time of Day');
			data.addColumn('number', 'Motivation Level');
			data.addColumn('number', 'Energy Level');

			data.addRows([
				[{v: [8, 0, 0], f: '8 am'}, 1, .25],
				[{v: [9, 0, 0], f: '9 am'}, 2, .5],
				[{v: [10, 0, 0], f:'10 am'}, 3, 1],
				[{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
				[{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
				[{v: [13, 0, 0], f: '1 pm'}, 6, 3],
				[{v: [14, 0, 0], f: '2 pm'}, 7, 4],
				[{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
				[{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
				[{v: [17, 0, 0], f: '5 pm'}, 10, 10],
				]);

			var options = {
				title: 'Motivation and Energy Level Throughout the Day',
				focusTarget: 'category',
				hAxis: {
					title: 'Time of Day',
					format: 'h:mm a',
					viewWindow: {
						min: [7, 30, 0],
						max: [17, 30, 0]
					},
					textStyle: {
						fontSize: 14,
						color: '#053061',
						bold: true,
						italic: false
					},
					titleTextStyle: {
						fontSize: 18,
						color: '#053061',
						bold: true,
						italic: false
					}
				},
				vAxis: {
					title: 'Rating (scale of 1-10)',
					textStyle: {
						fontSize: 18,
						color: '#67001f',
						bold: false,
						italic: false
					},
					titleTextStyle: {
						fontSize: 18,
						color: '#67001f',
						bold: true,
						italic: false
					}
				}
			};

			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}

	</script>-->

	<?php
	include("template/header.php");
	?>

	<div id='wrap4'>
		<div id="content">


			<div id="piechart"></div>

			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

			<script type="text/javascript">
// Load google charts 
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
	var data = google.visualization.arrayToDataTable([
		['Task', 'Hours per Day'],
		['Work', 8],
		['Eat', 2],
		['TV', 4],
		['Gym', 2],
		['Sleep', 8]
		]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'My Average Day', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
</div>
</div>