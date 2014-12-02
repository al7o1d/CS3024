var correct = 0;
var incorrect = 0;
var question_count = 0;
var curr_answer = 0;
var correct;
var correctInARow = 0;

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
			correct++;
			if(++correctInARow >= 5)
			{
				score = 20 - incorrect;

				$.post
				(
					"score_updater.php",
					{
						score: score + "",
						level: level + "",
						studentID: studentID + "",
						moduleID: moduleID + ""
					},
					function(response)
					{
						window.location.href = "games.php";
					}
				)
				.fail
				(
					function()
					{
						alert("Something went wrong! D:");
					}
				);
			}

			$("_correct_streak").text(correctInARow);
		}
		else
		{
			incorrect++;
			correctInARow = 0;
		}

		prepQ();
	}
	else
	{
		alert("That is not a number!");
	}
}

function skip()
{
	incorrect++;
	prepQ();
}

function prepQ()
{
	var q = genQ(level);
	var n1 = q[0];
	var o = q[1];
	var n2 = q[2];
	var a = q[3];

	curr_answer = a;

	$("#_question").text(n1 + " " + o + " " + n2 + " = ?");
	$("#_cheat").text(a);
	$("#answer").val("");
	
	$("#_level").text(level);
	$("#_correct").text(correct);
	$("#_incorrect").text(incorrect);
	$("#_question_count").text(question_count - 1);
}

function genQ(level)
{
	var max = 0;
	
	if(level == 1) {
	max = 10;
	}
	if(level == 2) {
	max = 100;
	}
	if(level == 3) {
	max = 1000;
	}
	var n1 = rand(1, max);
	var o = "";
	var n2 = rand(1, max);
	var a = 0;

	//switch(rand(0, 3))
	switch(operator)
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
			var _a = n1;
			var _b = n2;
			var _c = _a * _b;
			a = _c / _b;
			n1 = _c;
			n2 = _b;

			o = "/";
			break;
		default:
			a = n1 + n2;
			o = "+";
	}

	if(++question_count >= 21)
	{
		score = 20 - incorrect;

		$.post
		(
			"score_updater.php",
			{
				score: score + "",
				level: level + "",
				studentID: studentID + "",
				moduleID: moduleID + ""
			},
			function(response)
			{
				window.location.href = "games.php";
			}
		)
		.fail
		(
			function()
			{
				alert("Something went wrong! D:");
			}
		);
	}

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