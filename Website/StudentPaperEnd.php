<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{border-radius:5pt;font-family:Calibri;font-size:22pt;text-align:center;color:white}
</style>
</head>
<body bgcolor="#B3D5F2"><center>
<form method=post>
<center>
<?php
session_start();
if(isset($_SESSION["PaperStart"]) and $_SESSION["PaperStart"]=="End"){
	$totalq=$_SESSION["totalq"];$subject=$_SESSION["subject"];$qtype=$_SESSION["qtype"];
	$correct_answers=0;
	$partial_correct=0;
	$incorrect_answers=0;
	$left_answers=0;
	$StartTime=$_SESSION["Start_Time"];
	$EndTime=time();
	$TimeTaken=$EndTime-$StartTime;
	
		$TotalSeconds_Left=$TimeTaken;
		$Hours_Left=floor($TotalSeconds_Left/3600);
		if($Hours_Left<10)
			$Hours_Left="0".$Hours_Left;
		$LeftSeconds_Left=($TotalSeconds_Left%3600);
		$Minutes_Left=floor($LeftSeconds_Left/60);
		if($Minutes_Left<1)
			$_SESSION["Time_Blink"]="Yes";
		if($Minutes_Left<10)
			$Minutes_Left="0".$Minutes_Left;
		$Seconds_Left=($LeftSeconds_Left%60);
		if($Seconds_Left<10)
			$Seconds_Left="0".$Seconds_Left;
	
	$TimeTaken="$Hours_Left Hours, $Minutes_Left Minutes, $Seconds_Left Seconds";
	
for($i=1;$i<=$totalq;$i++){
	if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
		if(!isset($_SESSION["$i.'_Answer_Obtained'"]))
			$_SESSION["$i.'_Answer_Obtained'"]="";		
		if($_SESSION["$i.'_Answer_Obtained'"]=="")
			$left_answers=$left_answers+1;
		elseif($_SESSION["$i.'_Answer_Obtained'"]==$_SESSION["$i.'_Answer_Correct'"])
			$correct_answers=$correct_answers+1;
		else
			$incorrect_answers=$incorrect_answers+1;}	
if($qtype=="Multiple_Correct_Type"){
				
		$correct_options=0;
		$left_correct_options=0;
		$left_incorrect_options=0;
		$incorrect_options=0;
		$total_correct_options=$_SESSION["$i.'_Correct_Answers'"];
		if($_SESSION["$i.'_Answer_A'"]=="T" and $_SESSION["$i.'_Answer_Obtained_A'"]=="A"){$correct_options=$correct_options+1;$_SESSION["$i.'_Response_A'"]="Correct";}
	elseif($_SESSION["$i.'_Answer_A'"]=="F" and $_SESSION["$i.'_Answer_Obtained_A'"]=="A"){$incorrect_options=$incorrect_options+1;$_SESSION["$i.'_Response_A'"]="Incorrect";}
	elseif($_SESSION["$i.'_Answer_A'"]=="T" and $_SESSION["$i.'_Answer_Obtained_A'"]==""){$left_correct_options=$left_correct_options+1;$_SESSION["$i.'_Response_A'"]="Left_Correct";}
	elseif($_SESSION["$i.'_Answer_A'"]=="F" and $_SESSION["$i.'_Answer_Obtained_A'"]==""){$left_incorrect_options=$left_incorrect_options+1;$_SESSION["$i.'_Response_A'"]="Left_Incorrect";}

		if($_SESSION["$i.'_Answer_B'"]=="T" and $_SESSION["$i.'_Answer_Obtained_B'"]=="B"){$correct_options=$correct_options+1;$_SESSION["$i.'_Response_B'"]="Correct";}
	elseif($_SESSION["$i.'_Answer_B'"]=="F" and $_SESSION["$i.'_Answer_Obtained_B'"]=="B"){$incorrect_options=$incorrect_options+1;$_SESSION["$i.'_Response_B'"]="Incorrect";}
	elseif($_SESSION["$i.'_Answer_B'"]=="T" and $_SESSION["$i.'_Answer_Obtained_B'"]==""){$left_correct_options=$left_correct_options+1;$_SESSION["$i.'_Response_B'"]="Left_Correct";}
	elseif($_SESSION["$i.'_Answer_B'"]=="F" and $_SESSION["$i.'_Answer_Obtained_B'"]==""){$left_incorrect_options=$left_incorrect_options+1;$_SESSION["$i.'_Response_B'"]="Left_Incorrect";}
	
		if($_SESSION["$i.'_Answer_C'"]=="T" and $_SESSION["$i.'_Answer_Obtained_C'"]=="C"){$correct_options=$correct_options+1;$_SESSION["$i.'_Response_C'"]="Correct";}
	elseif($_SESSION["$i.'_Answer_C'"]=="F" and $_SESSION["$i.'_Answer_Obtained_C'"]=="C"){$incorrect_options=$incorrect_options+1;$_SESSION["$i.'_Response_C'"]="Incorrect";}
	elseif($_SESSION["$i.'_Answer_C'"]=="T" and $_SESSION["$i.'_Answer_Obtained_C'"]==""){$left_correct_options=$left_correct_options+1;$_SESSION["$i.'_Response_C'"]="Left_Correct";}
	elseif($_SESSION["$i.'_Answer_C'"]=="F" and $_SESSION["$i.'_Answer_Obtained_C'"]==""){$left_incorrect_options=$left_incorrect_options+1;$_SESSION["$i.'_Response_C'"]="Left_Incorrect";}
	
		if($_SESSION["$i.'_Answer_D'"]=="T" and $_SESSION["$i.'_Answer_Obtained_D'"]=="D"){$correct_options=$correct_options+1;$_SESSION["$i.'_Response_D'"]="Correct";}
	elseif($_SESSION["$i.'_Answer_D'"]=="F" and $_SESSION["$i.'_Answer_Obtained_D'"]=="D"){$incorrect_options=$incorrect_options+1;$_SESSION["$i.'_Response_D'"]="Incorrect";}
	elseif($_SESSION["$i.'_Answer_D'"]=="T" and $_SESSION["$i.'_Answer_Obtained_D'"]==""){$left_correct_options=$left_correct_options+1;$_SESSION["$i.'_Response_D'"]="Left_Correct";}
	elseif($_SESSION["$i.'_Answer_D'"]=="F" and $_SESSION["$i.'_Answer_Obtained_D'"]==""){$left_incorrect_options=$left_incorrect_options+1;$_SESSION["$i.'_Response_D'"]="Left_Incorrect";}
	
	
	$_SESSION["$i.'_Correct_Options'"]=$correct_options;
	$_SESSION["$i.'_Incorrect_Options'"]=$incorrect_options;
	$_SESSION["$i.'_Left_Correct_Options'"]=$left_correct_options;
	$_SESSION["$i.'_Left_Incorrect_Options'"]=$left_incorrect_options;
	
	$left_options=$left_correct_options+$left_incorrect_options;
	if($correct_options==$total_correct_options and $incorrect_options==0)
		$correct_answers=$correct_answers+1;
	elseif($correct_options>0 and $incorrect_options==0)
		$partial_correct=$partial_correct+1;
	elseif($incorrect_options>0)
		$incorrect_answers=$incorrect_answers+1;
	elseif(($left_options)==4)
		$left_answers=$left_answers+1;
	}
		
if($qtype=="Integer_Type"){
		if($_SESSION["$i.'_Int_Answer'"]=="")
			$left_answers=$left_answers=1;
		
		elseif($_SESSION["$i.'_Answer_Correct'"]==$_SESSION["$i.'_Int_Answer'"])
			$correct_answers=$correct_answers+1;
		
		else
			$incorrect_answers=$incorrect_answers+1;
	}
	}	
	if($qtype=="Single_Correct_Type"){
	$Max_Marks=3*$totalq;
	$Marks_Obtained=(3*$correct_answers)-(1*$incorrect_answers);}
	
	if($qtype=="Multiple_Correct_Type"){
		$Max_Marks=4*$totalq;
		$Marks_Obtained=0;
		for($i=1;$i<=$totalq;$i++){
			if($_SESSION["$i.'_Correct_Options'"]==$_SESSION["$i.'_Correct_Answers'"] and $_SESSION["$i.'_Incorrect_Options'"]==0)
				$Marks_Obtained=$Marks_Obtained+4;
		elseif($_SESSION["$i.'_Correct_Options'"]>0 and $_SESSION["$i.'_Incorrect_Options'"]==0)
				$Marks_Obtained=$Marks_Obtained+(1*$_SESSION["$i.'_Correct_Options'"]);
		elseif($_SESSION["$i.'_Incorrect_Options'"]>0)
				$Marks_Obtained=$Marks_Obtained-2;
		}
	}
		
	if($qtype=="Integer_Type"){
		$Max_Marks=3*$totalq;
		$Marks_Obtained=3*$correct_answers;}
	if($qtype=="True_False_Type"){
		$Max_Marks=3*$totalq;
		$Marks_Obtained=(3*$correct_answers)-(1*$incorrect_answers);
	}
	
	echo "Test Report<table bgcolor='#1172DF'>";
	echo "<tr><td>Total Questions</td><td> $totalq</td></tr>
		 <tr><td>Questions Attempted</td><td> ".($totalq-$left_answers)."</td></tr>
		 <tr><td>Correct Answers</td><td> $correct_answers</td></tr>";
	if($qtype=="Multiple_Correct_Type")
		echo "<tr><td>Partial Correct Answers</td><td> $partial_correct</td></tr>";
		echo "<tr><td>Incorrect Answers</td><td>$incorrect_answers</td></tr>
		<tr><td>Time Taken</td><td>$TimeTaken</td></tr>
		<tr><td> Maximum Marks</td><td>$Max_Marks </td></tr>
		<tr><td> Marks Obtained</td><td>$Marks_Obtained</td></tr>
		</table>
		<legend>Performance</legend>
		<table width=60% align=left>";
	
	for($i=1;$i<=$totalq;$i++){
		
	if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
		$Answer_Obtained=$_SESSION["$i.'_Answer_Obtained'"];
		$Answer_Correct=$_SESSION["$i.'_Answer_Correct'"];
		if($Answer_Correct==$Answer_Obtained)
			$val="Correct";
		elseif($Answer_Obtained=="")
			$val="Unattempted";
		else	
			$val="Incorrect";
			}
	if($qtype=="Multiple_Correct_Type"){
			if($_SESSION["$i.'_Correct_Options'"]==$_SESSION["$i.'_Correct_Answers'"] and $_SESSION["$i.'_Incorrect_Options'"]==0)$val="Correct";
		elseif($_SESSION["$i.'_Correct_Options'"]>0 and $_SESSION["$i.'_Incorrect_Options'"]==0)$val="Partial Correct";	
		elseif($_SESSION["$i.'_Incorrect_Options'"]>0)$val="Incorrect";
		elseif($_SESSION["$i.'_Left_Correct_Options'"]+$_SESSION["$i.'_Left_Incorrect_Options'"]==4)$val="Unattempted";	
		}
				
		if($qtype=="Integer_Type"){
			if($_SESSION["$i.'_Int_Answer'"]==$_SESSION["$i.'_Answer_Correct'"])
				$val="Correct";
			elseif($_SESSION["$i.'_Int_Answer'"]=="")
				$val="Unattempted";
			else
				$val="Incorrect";
			}
			
	if($val=="Correct")$style="style='background-color:Green;color:white'";
	if($val=="Partial Correct")$style="style='background-color:Purple;color:white'";
	if($val=="Incorrect")$style="style='background-color:Red;color:white'";
	if($val=="Unattempted")$style="style='background-color:Yellow;color:black'";
	$_SESSION["Status_$i"]=$val;
	if($i%10==1)echo "<tr>";
	if($i<10)$num="0$i";else $num=$i;
	echo "<td><input type=submit value=$num name=$i $style></td>";
	if($i%10==0 or $i==$totalq)echo "</tr>";
	}
		echo "</table>
		<table align=right width=40%>
		<tr><td><input type=submit value='   ' style='background-color:green'></td><td style='color:black'>Correct</td></tr>";
	if($qtype=="Multiple_Correct_Type")
		echo "<tr><td><input type=submit value='   ' style='background-color:purple'></td><td style='color:black'>Partial Correct</td></tr>";
		echo "<tr><td><input type=submit value='   ' style='background-color:red'></td><td style='color:black'>Incorrect</td></tr>
		<tr><td><input type=submit value='   ' style='background-color:yellow'></td><td style='color:black'>Unattempted</td></tr>
		</table>
		Click On The Question Number To View Its Details
		<br>
		<input type=submit value='Close' name=clbt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'>";
		for($i=1;$i<=$totalq;$i++)
			if(isset($_POST["$i"])){
				$_SESSION["QuestionView"]=$i;
				echo "<script language=javascript>
				window.open('StudentPaperEnd_Question.php','_blank', 'width=1000, height=600')
				</script>";
			}
		if(isset($_POST["clbt"])){
			$id=$_SESSION["StudentID"];
			$name=$_SESSION["StudentName"];
			$photo=$_SESSION["StudentPhoto"];
			session_destroy();
			session_start();
			$_SESSION["StudentLogin"]="True";
			$_SESSION["StudentID"]=$id;
			$_SESSION["StudentName"]=$name;
			$_SESSION["StudentPhoto"]=$photo;
			echo "<script language=javascript>window.close()</script>";
		}
	}
?>
</center>
</form>
</body>
</html>