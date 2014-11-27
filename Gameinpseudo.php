<?php
function gameInitiator($module){
	$level = getLevel($student, $module); //gets the level they played the last game at
	$score = getScore($student, $module); //gets the previous score
	$level = levelConverter($level, $score); //changes the level based on the previous score
	
	$score = playGame($level, $module, $interface); //initialize the actual game with the new 
													//level

	//regardless of the difficulty each student should get the amount of points they got
	giveStudentFancyPoints($score, $student);
	
	//for the teacher to see the difference, the points should be normalized, hence a need for a multiplier
	$multiplier = getMultiplier($level);

	$normalizedScore = $multiplier * $score;

	//the teacher will see the normalized points
	writeToTeacher($student, $module, $normalizedScore);


	//any new game should depend on their new level
	writeStudentLevel($level, $student, $module);
}

function getMultiplier($level){
	//the multiplier values are arbitrary at this point
	if ($level == 3){
		$multiplier = 1;
	} elseif ($level == 2){
		$multiplier = 0.7;
	} else {
		$multiplier = 0.5;
	}

	return $multiplier;
}

function levelConverter($level, $score){
	//moves the student up, down or makes them stay on a level depending on their results
	//the needed points are arbitrary at this point
	if ($score > 18) {
		if ($level != 3) {
			$level++;
		}
	} elseif ($score > 10 && $score <= 17) {
		$level = $level;
	} else {
		if ($level != 1) {
			$level--;
		}
	}
	
	return $level;
}

function getLevel($student, $module){
	//SQL that returns the student level on a particular module. You need to query 
	//the database for the students id, the module id, the last game he played which 
	//you can get by querying the score table's latest time stamp, and then get the 
	//level from game table.
	
	return $level;
}

function playGame($level, $module, $interface) {
	//starts the actual game based on the level, module and interface and returns the score
	//achieved in the game
	return $score;

function getScore($student, $module) {
	//SQL query that does the same thing as "getLevel" function but instead returns the score.
	
	return $score;

function giveStudentFancyPoints($score, $student){
	//SQL that adds to the total points of the student for rewards
	$fancyPoints = $score;
}

function writeToTeacher($student, $module, $normalizedScore){
	//appends the score to the student tracking
}

function writeStudentLevel($level, $student, $module){
	//SQL that replaces the student level on the particular module with the new level
}
?>