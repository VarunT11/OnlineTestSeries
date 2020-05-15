<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<form method=post>
<legend>SELF PRACTICE TEST</legend>
<table bgcolor="#09b529">
<tr><td>Enter The Number of Questions You Want </td><td> <input type=text name=totalq></td></tr>
<tr><td>Enter The Question Number of Starting Question </td><td> <input type=text name=qstart></td></tr>
<tr><td>Set The Time Limit (In Minutes) </td><td> <input type=text name=time_limit></td></tr>
<tr><td colspan=2><input type=submit value="Start" name=bt style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:20pt;color:White"></td></tr>
</table>
</form>
<?php
if(isset($_POST["bt"]))
{
	session_start();
	if($_POST["totalq"]=="" or !is_numeric($_POST["totalq"]) or $_POST["totalq"]<0
	or $_POST["qstart"]=="" or !is_numeric($_POST["qstart"]) or $_POST["qstart"]<0
	or $_POST["time_limit"]=="" or !is_numeric($_POST["time_limit"]) or $_POST["time_limit"]<0
	)
		die("Please Enter a Valid Number");
	$_SESSION["Practice_TotalQ"]=$_POST["totalq"];
	$_SESSION["Practice_StartQ"]=$_POST["qstart"];
	$_SESSION["Practice_EndQ"]=$_POST["qstart"]+$_POST["totalq"]-1;;
	$_SESSION["Time_Of_Paper"]=$_POST["time_limit"]*60;
	$_SESSION["Start_Time"]=time();
	$_SESSION["TimeMethod"]=2;
	$_SESSION["AttemptMethod"]=2;
	$_SESSION["SelfPracticeStart_1"]="True";
	echo "<script language=javascript>
			window.open('StudentPaper.php', '_blank', 'width=1500, height=900');
		</script>";
}
?>
</center>
</body>
</html>