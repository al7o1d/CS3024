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

		<?php include("navbar.php"); ?>

		<div id="container">
			<div id="subtitle"><?php if($valid) echo($name . ", Student ID: " . $id); else echo("?"); ?></div>

			<?php include("DbConn.php"); ?>
			<?php if($valid && $result = mysqli_query($con, "SELECT S.moduleID, M.title, AVG(S.score) AS averageScore FROM score S, module M WHERE S.studentID = $id AND S.moduleID = M.moduleID GROUP BY M.title")): #SELECT * , SUM(score) AS totalScore FROM `score`  WHERE `studentID` = 1101 AND ORDER BY `moduleID`?>
			<table>
				<tr>
					<th>Module ID</th>
					<th>Module Title</th>
					<th>Average Module Score</th>
					<th>View</th>
				</tr>

				<?php while($row = mysqli_fetch_assoc($result)): ?>
				<tr>
					<td><?= $row["moduleID"]; ?></td>
					<td><?= $row["title"]; ?></td>
					<td><?= $row["averageScore"]; ?></td>
					<td><a href="module.php?mid=<?= $row["moduleID"]; ?>&name=<?= $row["title"]; ?>&sid=<?= $id; ?>">--></a></td>
				</tr>
				<?php endwhile; ?>
			</table>
			<?php else: ?>
			404 Student Not Found
			<?php endif; ?>
		</div>
	</body>
</html>
