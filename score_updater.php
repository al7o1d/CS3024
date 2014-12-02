<?php
	if(isset($_POST["score"]))
	{
		$score = $_POST["score"];
	}
	else
	{
		die("INVALID PARAMETERS");
	}

	if(isset($_POST["level"]))
	{
		$level = $_POST["level"];
	}
	else
	{
		die("INVALID PARAMETERS");
	}

	if(isset($_POST["studentID"]))
	{
		$studentID = $_POST["studentID"];
	}
	else
	{
		die("INVALID PARAMETERS");
	}

	if(isset($_POST["moduleID"]))
	{
		$moduleID = $_POST["moduleID"];
	}
	else
	{
		die("INVALID PARAMETERS");
	}

	if($level == 3)
	{
		$multiplier = 1;
	}
	else if($level == 2)
	{
		$multiplier = 0.8;
	}
	else
	{
		$multiplier = 0.65;
	}

	$score = $multiplier * $score;

	include("DbConn.php");
	if($result = mysqli_query($con, "INSERT INTO score (gameID, moduleID, studentID, score, timePlayed, gameLevel) VALUES (111, $moduleID, $studentID, $score, NOW(), $level)"))
	{
		echo("Query worked!");
	}
	else
	{
		echo("Query failed!");
	}
?>