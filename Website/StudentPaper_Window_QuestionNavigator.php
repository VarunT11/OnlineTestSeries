<html>
<head>
<style type="text/css">
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{font-family:Calibri;font-size:22pt;text-align:center}
th{font-family:Calibri;font-size:22pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<?php
session_start();
function Refresh(){
	echo "<script language=javascript>
		window.open('StudentPaper.php','_parent');
	</script>";
}
if(isset($_SESSION["TimeMethod"]) and $_SESSION["TimeMethod"]==1)
{
function DisplayQuestion($i)
		{	global $qtype;
			$_SESSION["PaperQuestionNum"]=$i;
			$_SESSION["Current_Question"]=$_SESSION["Question_$i"];
			if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type"){
				$_SESSION["Current_Option_A"]=$_SESSION["Option_A_$i"];
				$_SESSION["Current_Option_B"]=$_SESSION["Option_B_$i"];
				$_SESSION["Current_Option_C"]=$_SESSION["Option_C_$i"];
				$_SESSION["Current_Option_D"]=$_SESSION["Option_D_$i"];
			}
			Refresh();
		}		
	$subject=$_SESSION["subject"];
	$qtype=$_SESSION["qtype"];
	$totalq=$_SESSION["totalq"];	
	$conn=new mysqli("localhost","root","","$subject");
	echo "<table><tr><th colspan=5>QUESTION NAVIGATOR</th></tr>";
	for($i=1;$i<=$totalq;$i++){
		if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
			if(!isset($_SESSION["$i.'_Answer_Obtained'"]) or $_SESSION["$i.'_Answer_Obtained'"]=="")
				$style="background-color:yellow;color:black";
			else
				$style="background-color:blue;color:white";
		}
		if($qtype=="Multiple_Correct_Type"){
		if((!isset($_SESSION["$i.'_Answer_Obtained_A'"]) or $_SESSION["$i.'_Answer_Obtained_A'"]=="") and 
		   (!isset($_SESSION["$i.'_Answer_Obtained_B'"]) or $_SESSION["$i.'_Answer_Obtained_B'"]=="") and
		   (!isset($_SESSION["$i.'_Answer_Obtained_C'"]) or $_SESSION["$i.'_Answer_Obtained_C'"]=="") and
		   (!isset($_SESSION["$i.'_Answer_Obtained_D'"]) or $_SESSION["$i.'_Answer_Obtained_D'"]=="")) 
				$style="background-color:yellow;color:black";
			else
				$style="background-color:blue;color:white";
		}
		if($qtype=="Integer_Type"){
			if(!isset($_SESSION["$i.'_Int_Answer'"]) or $_SESSION["$i.'_Int_Answer'"]=="")
				$style="background-color:yellow;color:black";
			else
				$style="background-color:blue;color:white";
		}
		if($i%5==1)
			echo "<tr>";
		if($i<10)
			echo "<td><input type=submit value=0$i name=bt$i style='$style'></td>";
		else
			echo "<td><input type=submit value=$i name=bt$i style='$style'></td>";
		
		if($i%5==0 and !$i==$totalq)
			echo "</tr>";
		if($i==$totalq)
			echo "</tr></table>";
	}
	for($i=1;$i<=$totalq;$i++)
		if(isset($_POST["bt$i"]))
			DisplayQuestion("$i");
}
if(isset($_SESSION["TimeMethod"]) and $_SESSION["TimeMethod"]==2)
{
	$totalq=$_SESSION["Practice_TotalQ"];
	echo "<table>";
	echo "<tr><th colspan=5>QUESTION NAVIGATOR</th></tr>";
	for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
	{
		$j=$i-$_SESSION["Practice_StartQ"]+1;
		if(!isset($_SESSION["$i.'_Answer_Obtained'"]) or $_SESSION["$i.'_Answer_Obtained'"]=="")
				$style="background-color:yellow;color:black";
			else
				$style="background-color:blue;color:white";
		if($j%5==1)
			echo "<tr>";
		if($i<10)
			echo "<td><input type=submit value=0$i name=bt$i style='$style'></td>";
		else
			echo "<td><input type=submit value=$i name=bt$i style='$style'></td>";
		
		if($j%5==0 and !$i==$_SESSION["Practice_EndQ"])
			echo "</tr>";
		if($i==$_SESSION["Practice_EndQ"])
			echo "</tr></table></div>";
	}
 	if(!isset($_SESSION["PaperQuestionNum"])){
		$_SESSION["PaperQuestionNum"]=$_SESSION["Practice_StartQ"];
		Refresh();
	}
	for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
		if(isset($_POST["bt$i"])){
			$_SESSION["PaperQuestionNum"]=$i;
			Refresh();
		}
}
?>
</form>
</body>
</html>