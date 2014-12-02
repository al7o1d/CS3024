<?php
	$valid = false;
	if(isset($_GET["mid"]) && isset($_GET["name"]) && isset($_GET["sid"]))
	{
		$mid = $_GET["mid"];
		$name = $_GET["name"];
		$sid = $_GET["sid"];
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
			<?php include("DbConn.php"); ?>
			<?php if($valid): ?>
			<div id="subtitle"><?php echo($name . ", Module ID: " . $mid); ?></div>

			<table>
				<tr>
					<th>Student ID</th>
					<th>Module ID</th>
					<th>Game ID</th>
					<th>Game Score</th>
					<th>Game Level</th>
					<th>Time Played</th>
				</tr>

				<?php if($valid && $result = mysqli_query($con, "SELECT S.studentID, S.moduleID, S.score, S.gameID, S.gameLevel, S.timePlayed FROM score S WHERE S.moduleID = $mid AND S.studentID = $sid")): ?>
					<?php while($row = mysqli_fetch_assoc($result)): ?>
					<tr>
						<td><?= $row["studentID"]; ?></td>
						<td><?= $row["moduleID"]; ?></td>
						<td><?= $row["gameID"]; ?></td>
						<td><?= $row["score"]; ?></td>
						<td><?= $row["gameLevel"]; ?></td>
						<td><?= $row["timePlayed"]; ?></td>
					</tr>
					<?php endwhile; ?>
				<?php else: ?>
				404 Module Not Found
				<?php endif; ?>
			</table>
			<?php else: ?>
			Invalid parameters!
			<?php endif; ?>
		</div>
	</body>
</html>
