<?php
	$valid = false;
	if(isset($_GET["cid"]) && isset($_GET["mid"]))
	{
		$valid = true;
		$cid = $_GET["cid"];
		$mid = $_GET["mid"];
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
			<div id="subtitle">Pairing</div>
			<?php
				include("DbConn.php");

				if($valid)
				{
					$students = array();
					if($result = mysqli_query($con, "SELECT * FROM `student` WHERE `classID` = " . $cid))
					{
						while($row = mysqli_fetch_assoc($result))
						{
							if($result1 = mysqli_query($con, "SELECT AVG(score) AS avgScore FROM `score` WHERE `studentID` = " . $row["studentID"]))
							{
								while($row1 = mysqli_fetch_assoc($result1))
								{
									$avgScore = $row1["avgScore"];
								}
							}
							if($result1 = mysqli_query($con, "SELECT AVG(score) AS avgScore FROM `score` WHERE `studentID` = " . $row["studentID"] . " AND `moduleID` = " . $mid))
							{
								while($row1 = mysqli_fetch_assoc($result1))
								{
									$avgModuleScore = $row1["avgScore"];
								}
							}

							$studentID = $row["studentID"];
							$normalizedScore = $avgScore + (2 * $avgModuleScore);
							$students[$studentID] = $normalizedScore;
						}
					}

					asort($students);

					foreach($students as $id => $ns)
					{
						echo("ID: $id, Score: $ns<br/>");
					}
					echo("<br/>");

					$keys = array_keys($students);
					$count = count($keys)/2;

					for($i = 0; $i < $count; $i++){
						if (count($keys) == 1){
							echo("no partner for " . $keys[0] . "<br>");
							break;
						} else {
							echo("pair " . $keys[0] .  " with " . end($keys). "<br>");
							array_shift($keys);
							array_pop($keys);
						}
					}

				}
				else
				{
					echo("Invalid Parameters!");
				}
			?>
		</div>
	</body>
</html>
