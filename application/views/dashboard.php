<!DOCTYPE html>
<html>
<head>
	<title><?php echo $this->session->userdata('name'); ?></title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style type="text/css">
		
		.v1{
			border-left: 2px solid black;
			height: 500px;
		}

		.title{
			font-weight: bold; 
			font-family: courier; 
			font-style: italic; 
			font-size: 200%; 
			text-decoration: none; 
			color: #d7d7d7;
		}
		
		.logout{
			color: white;
			background-color: #222;
			text-decoration: none;
			border: none;
		}

		.leftpanel{
			list-style-type: none;
			padding-right: 4%;
		}

		#leftmenu{
			position: fixed;
		}

		.right{
			float: right;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-inverse navbar-fixed-top" style="padding: 1%;">
			    	<div class="navbar-header">
			      		<a class="title" href="">Exam-Portal</a>
			    	</div>
			   		<div class="right">
				   		<h2 style="color: #cc0000;"><?php echo $this->session->userdata('name'); ?></h2>
				   		<form method="post" action="teacherController/logoutUser">
							<input type="submit" name="logout" value="Logout" class="logout">
						</form>
			   		</div>
				</nav>
			</div>
		</div>
		<div class="row" style="margin-top: 10%;">
			<div id="leftmenu" class="col-md-2">
				<div class="v1 right"></div>
				<ul class="list-group leftpanel">
					<li class="list-group-item" id="addquestionnaire">New Questionnaire</li>
					<li class="list-group-item">List All Questionnaires</li>
					<li class="list-group-item">Results</li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
			<div id="quesarea" class="col-md-offset-2 col-md-10">
				<form method="post" id="question_options" style="display: none;" class="form-inline">
					<label class="form-group">Number of Questions</label>
					<input type="text" name="num_questions" id="num_questions" class="form-control" required style="width: 7%;">
					<label>Question type</label>
					<select id="tf" class="form-control">
					  	<option value="1">MCQ</option>
					  	<option value="2">True/False</option>
					</select>
					<label>Need Timer?</label>
					<select id="timerselector" class="form-control" name="timerselector">
					  	<option value=1 selected="selected">Yes</option>
					  	<option value=2>No</option>
					</select>
					<label id="timerlabel" class="form-group">Time</label>
					<input id="timervalue" type="text" name="timervalue" class="form-control" style="width: 7%;">
					<button id="addquestion" class="btn btn-primary">Add questions</button>
				</form>
			</div>
			<div id="quesarea1" class="col-md-offset-2 col-md-6"></div>
		</div>
	</div>


</body>

<script>
	
	$(document).ready(function(){

		var selectedVal = $("#timerselector").val();
		$("#addquestionnaire").click(function(){

			$("#question_options").show();
			$("#timerselector").change(function(){

				selectedVal = $(this).val();
				console.log(selectedVal);
				if(selectedVal == '2') {

					$("#timervalue").hide();
					$("#timerlabel").hide();
				}
				if(selectedVal == '1') {

					$("#timervalue").show();
					$("#timerlabel").show();

				}
			});
			var timervalue = $("#timervalue").val();

		});

		$("#addquestion").click(function(e){

			e.preventDefault();
			var num_questions = $("#num_questions").val();
			var ques_type = $("#tf").val();
			var i = 1,j=0;
			var txt = "<div>\
			<form class='form-group' method='post' action='submit'>\
			<input type='hidden' name='num_questions' value=" + num_questions +">\
			<input type='hidden' name='ques_type' value=" + ques_type +">\
			<input type='hidden' name='timerselect' value=" + selectedVal +">\
			<input type='hidden' name='timerval' value=" + timervalue +">"
			var txt1 ="";
			while(i <= num_questions) {

				txt1 = txt1 + "<div class='form-inline'>\
				<hr>\
				<b>Question" + i + "</b>\
				<br>\
				<textarea rows='4' cols='60' class='form-control' name='ques[]'></textarea>\
				<button id='close' class='glyphicon glyphicon-remove btn btn-danger form-control' style=' padding :1.5%; '></button>";

				if(ques_type == 1){
					
					txt1 = txt1 + "<br>\
					<b>Answer options</b>\
					<br>\
					<input type='text' name='opt[]' class='form-control' style='padding-right :5%;'>\
					<input type='text' name='opt[]' class='form-control' style='padding-right :5%;'>\
					<input type='text' name='opt[]' class='form-control' style='padding-right :5%;'>\
					<input type='text' name='opt[]' class='form-control' style='padding-right :5%;'>\
					</div>";
				}
				else if(ques_type == 2) {
					
					txt1 = txt1 + "<br>\
					<b>Answer options</b>\
					<br>\
					<input type='radio' name='truefalse[" + j + "]' value='1' checked class='form-control'>True\
					<br>\
					<input type='radio' name='truefalse[" + j + "]' value='2' class='form-control'>False\
					<br>\
					</div>";
					j++;
					console.log(txt1);
				}

				i++;
			}

				txt1 = txt1 + "<input type='submit' class='btn btn-primary' value='Submit'></form></div>";
				var txt2 = txt + txt1;
				$("#quesarea1").append(txt2);
		});

		$(document).on('click', '#close', function(){ 

			$(this).parent().parent().parent().remove();
		});
	});

</script>
</html>