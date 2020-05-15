<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
legend{font-weight:bold;font-family:Calibri;font-size:30pt}
td{font-family:Calibri;font-size:25pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<form method=post>
<?php
session_start();
if(!isset($_SESSION["SelfPracticeStart_2"]) or $_SESSION["SelfPracticeStart_2"]=="False")
	die("You are not Authorised to access the Website");
else
{
	echo "<legend>CHOOSE CORRECT OPTIONS</legend>";
	$totalq=$_SESSION["Practice_TotalQ"];
	echo "<div style='position:absolute;top:20pt;right:20pt'><table>";
	echo "<legend>QUESTION NAVIGATOR</legend>";
	for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
	{
		$j=$i-$_SESSION["Practice_StartQ"]+1;
		if(!isset($_SESSION["$i.'_Answer_Correct'"]) or $_SESSION["$i.'_Answer_Correct'"]=="")
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
	
	if(!isset($_SESSION["PaperQuestionNum"]))
		$_SESSION["PaperQuestionNum"]=$_SESSION["Practice_StartQ"];
	for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
		if(isset($_POST["bt$i"]))
			$_SESSION["PaperQuestionNum"]=$i;
		$n=$_SESSION["PaperQuestionNum"];
		echo "<div style='position:absolute;top:100pt;left:200pt'><table>";
		echo "<legend>Question Number - $n</legend>";
		$checkedA="";$checkedB="";$checkedC="";$checkedD="";
		if(isset($_SESSION["$n.'_Answer_Correct'"])){
			$Response=$_SESSION["$n.'_Answer_Correct'"];
		if($Response=="A")$checkedA='checked';
		if($Response=="B")$checkedB='checked';
		if($Response=="C")$checkedC='checked';
		if($Response=="D")$checkedD='checked';}
		echo "<tr><td><input type=radio name=Answer$n value=A $checkedA></td><td>Option A</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=B $checkedB></td><td>Option B</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=C $checkedC></td><td>Option C</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=D $checkedD></td><td>Option D</td></tr>";

		echo "<tr><td><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Save Response' name=qbt></td><td><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Clear Response' name=rbt$n></td></tr>";
		
		if($_SESSION["PaperQuestionNum"]==$_SESSION["Practice_StartQ"])
			echo "<tr><td colspan=2><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Next Question >' name=nexq></tr></td>";
		elseif($_SESSION["PaperQuestionNum"]==$_SESSION["Practice_EndQ"])
			echo "<tr><td colspan=2><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='< Previous Question' name=prevq></td></tr>";
		else
			echo "<tr><td><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='< Previous Question' name=prevq></td><td><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Next Question >' name=nexq></td></tr>";
		
		echo "<tr><td colspan=2><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Evaluate' name=pbt></td></tr>";
		
		if(isset($_POST["prevq"])){
			$new=$n-1;
			$_SESSION["PaperQuestionNum"]=$new;
			header("Refresh:0");
		}
		if(isset($_POST["nexq"])){
			$new=$n+1;
			$_SESSION["PaperQuestionNum"]=$new;
			header("Refresh:0");
		}
		
		if(isset($_POST["qbt"])){
			for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
				if(isset($_POST["Answer$i"]))
					$_SESSION["$i.'_Answer_Correct'"]=$_POST["Answer$i"];
				header("Refresh:0");
		}
		
		if(isset($_POST["rbt$n"])){
			$_SESSION["$n.'_Answer_Correct'"]="";
			header("Refresh:0");
		}
		
		if(isset($_POST["pbt"])){
			$_SESSION["SelfPracticeStart_2"]="False";
			$_SESSION["SelfPracticeStart_End"]="True";
			$_SESSION["PaperQuestionNum"]=1;
			function redirect($url){ob_start();header('Location: '.$url);ob_end_flush();}
			redirect("StudentSelfPractice_Main_2.php");
		}
		echo "</table></div>";
}
?>
</form>
</center>
</body>
</html>