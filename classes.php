<?php
	$valid = false;
	if(isset($_GET["sid"]))
	{
		$valid = true;
		$sid = $_GET["sid"];
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
			<div id="subtitle">Class Selector</div>
			</br>
			<?php include("DbConn.php"); ?>
			<?php if($result = mysqli_query($con, "SELECT * FROM `class` WHERE `schoolID` = $sid")): ?>
			<table>
				<tr>
					<th>Class ID</th>
					<th>View</th>
				</tr>

				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["classID"]; ?></td>
					<td><a href="students.php?cid=<?= $row["classID"]; ?>">--></a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			</br>
			<?php else: ?>
			404 Classes Not Found
			<?php endif; ?>
			<?php else: ?>
			Invalid parameters!
			<?php endif; ?>
		</div>
	</body>
</html>
