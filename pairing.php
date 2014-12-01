<?php
	$valid = false;
	if(isset($_GET["cid"]) && isset($_GET["mid"]))
	{
		$valid = true;
		$cid = $_GET["cid"];
		$mid = $_GET["mid"];
	}
?>
<?php
$pairing_scores = array();
$pairing_ids = array();
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

					foreach($students as $id => $ns)
					{
						echo("ID: $id, Score: $ns<br/>");
						array_push($pairing_ids, $id);
						array_push($pairing_scores, $ns);
					}
				}
				else
				{
					echo("Invalid Parameters!");
				}
			?>
			<?php echo $pairing_scores[0] ?>
			<?php echo $pairing_scores[1] ?>
			<?php echo $pairing_scores[2] ?>
			</br>
			<?php echo $pairing_ids[0] ?>
			<?php echo $pairing_ids[1] ?>
			<?php echo $pairing_ids[2] ?>
			</br>
			<?php
			#sorting algorithm
			$length = count($pairing_scores);
				for ($i = 0; $i < $length; $i++) {
				
				  print $pairing_scores[$i];
				}
			?>
		</div>
	</body>
</html>
