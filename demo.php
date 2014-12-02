<?php
	if(isset($_GET["o"]))
	{
		$operator = $_GET["o"];
	}
	if(isset($_GET["m"]))
	{
		$moduleID = $_GET["m"];
	}

	if($operator == 0 || $operator == 1)
	{

	}
	else
	{
		die("Invalid Parameters!");
	}

	if($moduleID == 1 || $moduleID == 2)
	{

	}
	else
	{
		die("Invalid Parameters!");
	}

	$studentID = "1101";
	$classID = "11";
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

		<?php
			include("DbConn.php");
			if($result = mysqli_query($con, "SELECT gameLevel, score FROM score AS s1 WHERE s1.studentID = $studentID AND s1.moduleID = $moduleID AND s1.gameID = 111 AND s1.timePlayed = (SELECT MAX(timePlayed) FROM score AS s2 WHERE s1.studentID = s2.studentID AND s1.moduleID = s2.moduleID AND s1.gameID = s2.gameID)"))
			{
				while($row = mysqli_fetch_assoc($result))
				{
					$level = $row["gameLevel"];
					$scoreini = $row["score"];

					if ($level == 3){
						$multiplier = 1;
					} elseif ($level == 2){
						$multiplier = 0.8;
					} else {
						$multiplier = 0.65;
					}

					$scoredecide = $scoreini / $multiplier;

					if ($scoredecide > 18) {
						if ($level != 3) {
							$level++;
						}
					} elseif ($scoredecide > 10 && $scoredecide <= 17) {
						$level = $level;
					} else {
						if ($level != 1) {
							$level--;
						}
					}
				}
			}
			else
			{
				die("Connection to database failed!");
			}

			echo("<script type='text/javascript'>var level = $level;</script>");
			echo("<script type='text/javascript'>var operator = $operator</script>");
			echo("<script type='text/javascript'>var studentID = $studentID</script>");
			echo("<script type='text/javascript'>var moduleID = $moduleID</script>");
		?>

		<script src="js/script.js" type="text/javascript"></script>
	</head>

	<body onload="onLoad();">
		<div id="bg">
		</div>

		<?php include("navbar.php"); ?>

		<div id="container">
			<div id="subtitle">Demonstration - Student #<?= $studentID; ?>, Class #<?= $classID; ?></div>

			<div id="demo">
				<div id="stats">
					<div id="level">Level: <span id="_level">-1</span></div>
					<script type="text/javascript">$("#_level").text(level);</script>
					<div id="correct">Correct: <span id="_correct">0</span></div>
					<div id="incorrect">Incorrect: <span id="_incorrect">0</span></div>
					<div id="question_count">Question: <span id="_question_count">0</span></div>
					<div id="correct_streak">Correct Streak: <span id="_correct_streak">0</span></div>

					<br/>

					<div id="instruction">Evaluate the following:</div>
					</br>
					<div id="_question" style="font-size: 50px;">-</div>
					</br>
					<form action="javascript:submit();">
						<input id="answer" type="text" value="" placeholder="Answer..." autofocus="true" autocomplete="off" autocorrect="off"  />
					</form>

					<div id="cheat">psssst... the answer is <span id="_cheat">-</span> :')</div>
				</div>

				<input type="button" value="Submit" onclick="submit();" />
				<br/>
				<input type="button" value="Skip" onclick="skip();" />
			</div>
		</div>
	</body>
</html>
