<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<table align=left><tr><td>
<input type=submit value='Submit Paper' name=pbt style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:20pt;color:White">
</td></tr></table>
<?php
session_start();
if($_SESSION["AttemptMethod"]=="1")
{	function Refresh(){
	echo "<script language=javascript>
		window.open('StudentPaper.php','_parent');
	</script>";
	}
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
	$filepath="Uploads/Questions/$subject/$qtype/";
	$n=$_SESSION["PaperQuestionNum"];
	if(isset($_POST["pbt"]) or (isset($_SESSION["TimeMethod"]) and $_SESSION["TimeMethod"]=="End")){
	for($i=1;$i<=$totalq;$i++){
	if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
	if(!isset($_SESSION["$i.'_Answer_Obtained'"]))$_SESSION["$i.'_Answer_Obtained'"]="";}
	if($qtype=="Integer_Type"){
	if(!isset($_SESSION["$i.'_Int_Answer'"]))$_SESSION["$i.'_Int_Answer'"]="";}
	if($qtype=="Multiple_Correct_Type"){
		if(!isset($_SESSION["$i.'_Answer_Obtained_A'"]))$_SESSION["$i.'_Answer_Obtained_A'"]="";
		if(!isset($_SESSION["$i.'_Answer_Obtained_B'"]))$_SESSION["$i.'_Answer_Obtained_B'"]="";
		if(!isset($_SESSION["$i.'_Answer_Obtained_C'"]))$_SESSION["$i.'_Answer_Obtained_C'"]="";
		if(!isset($_SESSION["$i.'_Answer_Obtained_D'"]))$_SESSION["$i.'_Answer_Obtained_D'"]="";
					$Answers=$_SESSION["$i.'_Answer_Correct'"];
					$length=strlen($Answers);$Correct_Answers=$length/2;
					$_SESSION["$i.'_Correct_Answers'"]=$Correct_Answers;
					for($k=1;$k<=$Correct_Answers;$k++)
						$_SESSION["$i.'_Answer_$k'"]=substr($Answers,2*($k-1),1);
					for($l=($Correct_Answers+1);$l<=4;$l++)
						$_SESSION["$i.'_Answer_$l'"]="";
					
					$A1=$_SESSION["$i.'_Answer_1'"];
					$A2=$_SESSION["$i.'_Answer_2'"];
					$A3=$_SESSION["$i.'_Answer_3'"];
					$A4=$_SESSION["$i.'_Answer_4'"];
					
					if($A1=="A" or $A2=="A" or $A3=="A" or $A4=="A")$_SESSION["$i.'_Answer_A'"]="T";
					else $_SESSION["$i.'_Answer_A'"]="F";
					if($A1=="B" or $A2=="B" or $A3=="B" or $A4=="B")$_SESSION["$i.'_Answer_B'"]="T";
					else $_SESSION["$i.'_Answer_B'"]="F";
					if($A1=="C" or $A2=="C" or $A3=="C" or $A4=="C")$_SESSION["$i.'_Answer_C'"]="T";
					else $_SESSION["$i.'_Answer_C'"]="F";
					if($A1=="D" or $A2=="D" or $A3=="D" or $A4=="D")$_SESSION["$i.'_Answer_D'"]="T";
					else $_SESSION["$i.'_Answer_D'"]="F";
				}
			}
			$_SESSION["PaperStart"]="End";
			function redirect($url){ob_start();header('Location: '.$url);ob_end_flush();}
			echo "<script language=javascript>
			window.open('StudentPaperEnd.php','_parent');
			</script>";
		}
		echo "<table align=right width=40%><tr>";
		if($_SESSION["PaperQuestionNum"]==1)
			echo "<td></td><td><input type=submit value='Next Question >' name=nexq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td>";
		elseif($_SESSION["PaperQuestionNum"]==$_SESSION["totalq"])
			echo "<td><input type=submit value='< Previous Question' name=prevq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td><td></td>";
		else
			echo "<td><input type=submit value='< Previous Question' name=prevq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td><td><input type=submit value='Next Question >' name=nexq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td>";
		echo "</tr></table>";

		if(isset($_POST["prevq"])){
			$new=$n-1;
			DisplayQuestion("$new");
			Refresh();
		}
		if(isset($_POST["nexq"])){
			$new=$n+1;
			DisplayQuestion("$new");
			Refresh();
		}
}
elseif($_SESSION["AttemptMethod"]=="2")
{		function Refresh(){
		echo "<script language=javascript>
			window.open('StudentPaper.php','_parent');
		</script>";
		}
		echo "<table align=right><tr>";
			if($_SESSION["PaperQuestionNum"]==$_SESSION["Practice_StartQ"])
			echo "<td><input type=submit value='Next Question >' name=nexq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td>";
		elseif($_SESSION["PaperQuestionNum"]==$_SESSION["Practice_EndQ"])
			echo "<td><input type=submit value='< Previous Question' name=prevq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td>";
		else
			echo "<td><input type=submit value='< Previous Question' name=prevq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td><td><input type=submit value='Next Question >' name=nexq style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td>";
			echo "</tr></table>";
			$n=$_SESSION["PaperQuestionNum"];
			if(isset($_POST["prevq"])){
			$new=$n-1;
			$_SESSION["PaperQuestionNum"]=$new;
			Refresh();
		}
		if(isset($_POST["nexq"])){
			$new=$n+1;
			$_SESSION["PaperQuestionNum"]=$new;
			Refresh();
		}
		
		if(isset($_POST["pbt"]) or (isset($_SESSION["TimeMethod"]) and $_SESSION["TimeMethod"]=="End")){
			$_SESSION["SelfPracticeStart_1"]="False";
			$_SESSION["SelfPracticeStart_2"]="True";
			$_SESSION["PaperQuestionNum"]=$_SESSION["Practice_StartQ"];
			echo "<script language=javascript>
			window.open('StudentSelfPractice_Main_1.php','_parent');
			</script>";}

}
?>
</form>
</body>
</html>