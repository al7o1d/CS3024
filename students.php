<?php
	$valid = false;
	if(isset($_GET["cid"]))
	{
		$cid = $_GET["cid"];
		$valid = true;
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

		<?php include("navbar.php"); ?>

		<div id="container">
			<?php if($valid): ?>
			<div id="subtitle">Students from South Park Elemenatry, Class <?= $cid; ?></div>
			</br>
			<?php include("DbConn.php"); ?>
			<?php if($result = mysqli_query($con, "SELECT * FROM `student` WHERE `classID` = $cid")): ?>
			<table>
				<tr>
					<th>Student ID</th>
					<th>Surname</th>
					<th>Forename(s)</th>
					<th>Average Points</th>
					<th>Total Points</th>
					<th>View</th>
				</tr>

				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["studentID"]; ?></td>
					<td><?= $row["surname"]; ?></td>
					<td><?= $row["firstname"]; ?></td>
					<?php
						if($result1 = mysqli_query($con, "SELECT AVG(score) AS avgScore FROM `score` WHERE `studentID` = " . $row["studentID"]))
						{
							while($row1 = mysqli_fetch_assoc($result1))
							{
								$avgPoints = $row1["avgScore"];
							}
						}
					?>
					<td><?= $avgPoints; ?></td>
					<?php
						if($result1 = mysqli_query($con, "SELECT SUM(score) AS totalScore FROM `score` WHERE `studentID` = " . $row["studentID"]))
						{
							while($row1 = mysqli_fetch_assoc($result1))
							{
								$totalPoints = $row1["totalScore"];
							}
						}
					?>
					<td><?= $totalPoints; ?></td>
					<td><a href="student.php?id=<?= $row["studentID"]; ?>&name=<?= $row["firstname"] . " " . $row["surname"] ?>">--></a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			<?php else: ?>
			404 Students Not Found
			<?php endif; ?>
			<?php else: ?>
			Invalid parameters!
			<?php endif; ?>
		</div>
	</body>
</html>
