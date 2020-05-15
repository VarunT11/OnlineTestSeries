<html>
<head>
<style type="text/css">
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{border-radius:5pt;font-family:Calibri;font-size:22pt;text-align:center;color:White}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<center>
<?php
session_start();
$subject=$_SESSION["subject"];
$qtype=$_SESSION["qtype"];
$QNum=$_SESSION["QuestionView"];
$Question=$_SESSION["Question_$QNum"];
if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type"){
	$Option_A=$_SESSION["Option_A_$QNum"];
	$Option_B=$_SESSION["Option_B_$QNum"];
	$Option_C=$_SESSION["Option_C_$QNum"];
	$Option_D=$_SESSION["Option_D_$QNum"];
}
if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
	$Answer_Obtained=$_SESSION["$QNum.'_Answer_Obtained'"];
	$Answer_Correct=$_SESSION["$QNum.'_Answer_Correct'"];
}
if($qtype=="Multiple_Correct_Type"){
	$Answer_Obtained="";$Answer_Correct="";
	function Check_Answer($a){
		global $Answer_Obtained;
		global $Answer_Correct;
		global $QNum;
	if($_SESSION["$QNum.'_Response_$a'"]=="Correct"){
	$Answer_Correct=$Answer_Correct."$a ";
	$Answer_Obtained=$Answer_Obtained."$a ";}
	
	if($_SESSION["$QNum.'_Response_$a'"]=="Incorrect")
		$Answer_Obtained=$Answer_Obtained."$a ";
	
	if($_SESSION["$QNum.'_Response_$a'"]=="Left_Correct")
		$Answer_Correct=$Answer_Correct."$a ";
	}
	Check_Answer("A"); Check_Answer("B"); Check_Answer("C"); Check_Answer("D"); 
}
if($qtype=="Integer_Type"){
	$Answer_Correct=$_SESSION["$QNum.'_Answer_Correct'"];
	$Answer_Obtained=$_SESSION["$QNum.'_Int_Answer'"];
}
$Status=$_SESSION["Status_$QNum"];
if($Status=="Correct")$style="style='background-color:Green'";
if($Status=="Partial Correct")$style="style='background-color:Purple'";
if($Status=="Incorrect")$style="style='background-color:Red'";
if($Status=="Unattempted")$style="style='background-color:Yellow;color:Black'";

echo "<table width=100% bgcolor='#1172DF'>
	<tr><td colspan=4>Question Number $QNum</td></tr>
	<tr><td colspan=4>$Question</td></tr>";
if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type")
echo "<tr><td>A</td><td>$Option_A</td><td>B</td><td>$Option_B</td></tr>
	  <tr><td>C</td><td>$Option_C</td><td>D</td><td>$Option_D</td></tr>";
echo "</table>
	<table width=100% bgcolor='#1172DF'>
	<tr><td>Correct Answer</td><td>$Answer_Correct</td></tr>
	<tr><td>Your Answer</td><td>$Answer_Obtained</td></tr>
	<tr><td>Status</td><td $style>$Status</td></tr>
	</table>
	<input type=submit value='Close' name=bt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'>
	";
if(isset($_POST["bt"])){
	echo "<script language=javascript>window.close()</script>";
}
?>
</center>
</form>
</body>
</html>