<!DOCTYPE>
<html>
	<head>
		<title>Mathematica Academia</title>

		<link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two&subset=latin,latin-ext" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div id="bg">
		</div>

		<?php include("navbar.php"); ?>


		<div id="container">
			<div id="title">Select a Game</div>

			<div id="subtitle">Addition</div>
			<div id="choices">
				<input type="button" value="Demo Game" onclick="window.location.href = 'demo.php?o=0&m=1'" />
			</div>

			<div id="subtitle">Subtraction</div>
			<div id="choices">
				<input type="button" value="Demo Game" onclick="window.location.href = 'demo.php?o=1&m=2'" />
			</div>
		</div>
	</body>
</html>
