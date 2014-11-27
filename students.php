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
			<div id="subtitle">Students from class 1a in South Park Elemenatry</div>

			<?php include("DbConn.php"); ?>
			<?php if($result = mysqli_query($con, "SELECT * FROM `student` WHERE `classID` = 11")): ?>
			<table>
				<tr>
					<th>Student ID</th>
					<th>Surname</th>
					<th>Forename(s)</th>
					<th>All Points</th>
					<th>View</th>
				</tr>

				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["studentID"]; ?></td>
					<td><?= $row["surname"]; ?></td>
					<td><?= $row["firstname"]; ?></td>
					<td><?= $row["totalPoints"]; ?></td>
					<td><a href="student.php?id=<?= $row["studentID"]; ?>&name=<?= $row["firstname"] . " " . $row["surname"] ?>">--></a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			<?php else: ?>
			404 Students Not Found
			<?php endif; ?>
		</div>
	</body>
</html>
