<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{font-family:Calibri;font-size:25pt;text-align:center}
th{font-family:Calibri;font-size:25pt;text-align:center;font-weight:bold}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<form method=post>
<?php
session_start();
if(!isset($_SESSION["SelfPracticeStart_End"]) or !$_SESSION["SelfPracticeStart_End"]=="True")
	die("You are not Authorised to access the Website");
else
{
	$totalq=$_SESSION["Practice_TotalQ"];
	echo "<div style='position:absolute;top:20pt;left:60pt'><table border=2>";
	echo "<tr><th>QUESTION NUMBER</th><th>CORRECT ANSWER</th><th>YOUR ANSWER</th><th>STATUS</th></tr>";
	$correct=0;$incorrect=0;$unattempted=0;
	for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
	{
		if(!isset($_SESSION["$i.'_Answer_Correct'"]) or $_SESSION["$i.'_Answer_Correct'"]=="")
			$CorrAns="";
		else
			$CorrAns=$_SESSION["$i.'_Answer_Correct'"];
		if(!isset($_SESSION["$i.'_Answer_Obtained'"]) or $_SESSION["$i.'_Answer_Obtained'"]=="")
			$YourAns="";
		else
			$YourAns=$_SESSION["$i.'_Answer_Obtained'"];
		
		if($YourAns==""){$unattempted=$unattempted+1;$Status="Unattempted";$style='background-color:Blue;color:White';}
	elseif($YourAns==$CorrAns){$correct=$correct+1;$Status="Correct";$style='background-color:Green;color:White';}
		else{$incorrect=$incorrect+1;$Status="Incorrect";$style='background-color:Red;color:White';}
		
		echo "<tr><td>$i</td><td>$CorrAns</td><td>$YourAns</td><td style='$style'>$Status</td></tr>";
		
	}
	echo "</table>";
	echo "<table border=1>";
	echo "<tr><th>TOTAL QUESTIONS</th><th>CORRECT ANSWERS</th><th>INCORRECT ANSWERS</th><th>UNATTEMPTED ANSWERS</th></tr>";
	echo "<tr><td>$totalq</td><td>$correct</td><td>$incorrect</td><td>$unattempted</td></tr>";
	echo "</table><br>";
	echo "<input type=submit value='Close' name=closebt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'>";
	echo "</div>";

	if(isset($_POST["closebt"]))
	{
		$StudentID=$_SESSION["StudentID"];$studentName=$_SESSION["StudentName"];$studentPhoto=$_SESSION["StudentPhoto"];
		session_destroy();
		session_start();
		$_SESSION["StudentLogin"]="True";
		$_SESSION["StudentID"]=$StudentID;
		$_SESSION["StudentName"]=$studentName;
		$_SESSION["StudentPhoto"]=$studentPhoto;
		echo "<script language=javascript>window.close()</script>";
	}
}
?>
</form>
</center>
</body>
</html>