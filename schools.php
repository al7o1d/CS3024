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
					<li><a href="demo.html">Demo</a></li>
					<li><a href="./schools.php">Tracking</a></li>
					<li><a href="./pairing.php?cid=11&mid=1">Pairing</a></li>
				</ul>
			</div>
		</div>

		<div id="container">
			<div id="subtitle">School Selector</div>
			</br>
			<?php include("DbConn.php"); ?>
			<?php if($result = mysqli_query($con, "SELECT * FROM `school`")): ?>
			<table>
				<tr>
					<th>School ID</th>
					<th>School Name</th>
					<th>School Address</th>
					<th>View</th>
				</tr>

				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["schoolID"]; ?></td>
					<td><?= $row["name"]; ?></td>
					<td><?= $row["schoolAddress"]; ?></td>
					<td><a href="classes.php?sid=<?= $row["schoolID"]; ?>">--></a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			</br>
			<?php else: ?>
			404 Schools Not Found
			<?php endif; ?>
		</div>
	</body>
</html>
