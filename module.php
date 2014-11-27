<?php
	$valid = false;
	if(isset($_GET["id"]) && isset($_GET["name"]))
	{
		$valid = true;
		$id = $_GET["id"];
		$name = $_GET["name"];
	}
?>

<!DOCTYPE>
<html>
	<head>
		<title>Mathematica Academia</title>

		<link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two&subset=latin,latin-ext" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="js/script.js" type="text/javascript"></script>
	</head>

	<body onload="onLoad();">
		<div id="bg">
		</div>

		<div id="nav_bar">
			<div id="nav">
				<div id="logo">MA.</div>

				<ul id="nav_list">
					<li><a href="#">About MA</a></li>
					<li><a href="#">For Schools</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="./Demo.html">Demo</a></li>
				</ul>
			</div>
		</div>

		<div id="container">
			<div id="subtitle"><?php if($valid) echo($name . ", Module ID: " . $id); else echo("?"); ?></div>
			
			<?php include("DbConn.php"); ?>

			<table>
				<tr>
					<th>Game Name</th>
					<th>Game Score</th>
					<th>Game Level</th>
					<th>Time Played</th>
				</tr>

				<?php if($valid && $result = mysqli_query($con, "SELECT * FROM `game` WHERE `moduleID` = $id")): ?>
				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["gameName"]; ?></td>
					<td><?= $row["gameName"]; ?></td>
					<td><?= $row["gameName"]; ?></td>
				</tr>
				<?php endwhile; ?>
				<?php endif; ?>
			</table>
			
			
			
			
			
			
			
			
			
		</div>
	</body>
</html>
