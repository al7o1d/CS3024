var score = 0;
var correct = 0;
var incorrect = 0;
var skips = 0;
var question_count = 0;

var curr_answer = 0;

var chart_stats = [correct, incorrect, skips];
function onLoad()
{
	prepQ();
}
function submit()
{
	var ua = $("#answer").val();
	if(isNumber(ua))
	{
		if(ua == curr_answer)
		{
			alert("Correct! Well done.");
			score += 10;
			correct++;
		}
		else
		{
			alert("Uh, oh! That wasn't right. Try another!");
			incorrect++;
		}

		prepQ();
	}
	else
	{
		alert("That is not a number!");
	}
	draw();
}

function skip()
{
	alert("That's a shame.");

	skips++;
	prepQ();
}

function prepQ()
{
	var q = genQ();
	var n1 = q[0];
	var o = q[1];
	var n2 = q[2];
	var a = q[3];

	curr_answer = a;

	$("#_question").text(n1 + " " + o + " " + n2 + " = ?");
	$("#_cheat").text(a);
	$("#answer").val("");

	$("#_score").text(score);
	$("#_correct").text(correct);
	$("#_incorrect").text(incorrect);
	$("#_skips").text(skips);
	$("#_question_count").text(question_count);
}

function genQ(difficulty)
{
	var max = 0;
	
	if(difficulty == 1) {
	max = 10;
	}
	if(difficulty == 2) {
	max = 20;
	}
	if(difficulty == 3) {
	max = 100;
	}
	var n1 = rand(1, max);
	var o = "";
	var n2 = rand(1, max);
	var a = 0;

	switch(rand(0, 3))
	{
		case 0:
			a = n1 + n2;
			o = "+";
			break;
		case 1:
			a = n1 - n2;
			o = "-";
			break;
		case 2:
			a = n1 * n2;
			o = "*";
			break;
		case 3:
			a = n1 / n2;
			o = "/";
			break;
		default:
			a = n1 + n2;
			o = "+";
	}

	question_count++;

	return [n1, o, n2, a];
}

function isNumber(n)
{
	return !isNaN(parseFloat(n)) && isFinite(n);
}

function rand(min, max)
{
	return Math.floor(Math.random() * (max - min + 1)) + min;
}