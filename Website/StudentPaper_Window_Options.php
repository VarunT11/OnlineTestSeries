<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{font-family:Calibri;font-size:22pt;text-align:center}
th{font-family:Calibri;font-size:22pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<?php
session_start();
if($_SESSION["TimeMethod"]==1)
{
	$subject=$_SESSION["subject"];
	$qtype=$_SESSION["qtype"];
	$totalq=$_SESSION["totalq"];
	$filepath="Uploads/Questions/$subject/$qtype/";
	$n=$_SESSION["PaperQuestionNum"];
	function Refresh(){
	echo "<script language=javascript>
		window.open('StudentPaper.php','_parent');
	</script>";
}
for($i=1;$i<=$totalq;$i++)
		if($qtype=="Integer_Type")
			if(!isset($_SESSION["$n.'_Int_Answer'"]))
				$_SESSION["$n.'_Int_Answer'"]="";
if($qtype=="Integer_Type"){
		echo "<table align=right style='background-color:blue;border-radius:5pt;border=1;border-color:black;border-style:solid'>
				<tr><th colspan=3 style='color:White;font-family:Calibri'>VIRTUAL KEYPAD</th></tr>
				<tr><td></td><td><input type=submit value=0 name=int0></td><td></td></tr>
				<tr><td><input type=submit name=int1 value=1></td><td><input type=submit name=int2 value=2></td><td><input type=submit name=int3 value=3></td></tr>
				<tr><td><input type=submit name=int4 value=4></td><td><input type=submit name=int5 value=5></td><td><input type=submit name=int6 value=6></td></tr>
				<tr><td><input type=submit name=int7 value=7></td><td><input type=submit name=int8 value=8></td><td><input type=submit name=int9 value=9></td></tr>
			</table>";}
	for($i=0;$i<=9;$i++)
	if(isset($_POST["int$i"])){
		$a=$_SESSION["$n.'_Int_Answer'"];
		$b=$_POST["int$i"];
		$c=$a.$b;
		$_SESSION["$n.'_Int_Answer'"]=$c;
		Refresh();
		}
	echo "<table align=left>";
if($qtype=="Single_Correct_Type"){
		$checkedA="";$checkedB="";$checkedC="";$checkedD="";
		if(isset($_SESSION["$n.'_Answer_Obtained'"])){
			$Response=$_SESSION["$n.'_Answer_Obtained'"];
		if($Response=="A")$checkedA='checked';
		if($Response=="B")$checkedB='checked';
		if($Response=="C")$checkedC='checked';
		if($Response=="D")$checkedD='checked';}
		echo "<tr><td>A.<input type=radio name=Answer$n value=A $checkedA></td><td>".$_SESSION["Current_Option_A"]."</td></tr>";
		echo "<tr><td>B.<input type=radio name=Answer$n value=B $checkedB></td><td>".$_SESSION["Current_Option_B"]."</td></tr>";
		echo "<tr><td>C.<input type=radio name=Answer$n value=C $checkedC></td><td>".$_SESSION["Current_Option_C"]."</td></tr>";
		echo "<tr><td>D.<input type=radio name=Answer$n value=D $checkedD></td><td>".$_SESSION["Current_Option_D"]."</td></tr>";
	}
	if($qtype=="Multiple_Correct_Type"){
		$checkedA="";$checkedB="";$checkedC="";$checkedD="";
		if(isset($_SESSION["$n.'_Answer_Obtained_A'"]) or isset($_SESSION["$n.'_Answer_Obtained_B'"]) or isset($_SESSION["$n.'_Answer_Obtained_C'"]) or isset($_SESSION["$n.'_Answer_Obtained_D'"])){
			if(isset($_SESSION["$n.'_Answer_Obtained_A'"]))$Response_A=$_SESSION["$n.'_Answer_Obtained_A'"];else $Response_A="";
			if(isset($_SESSION["$n.'_Answer_Obtained_B'"]))$Response_B=$_SESSION["$n.'_Answer_Obtained_B'"];else $Response_B="";
			if(isset($_SESSION["$n.'_Answer_Obtained_C'"]))$Response_C=$_SESSION["$n.'_Answer_Obtained_C'"];else $Response_C="";
			if(isset($_SESSION["$n.'_Answer_Obtained_D'"]))$Response_D=$_SESSION["$n.'_Answer_Obtained_D'"];else $Response_D="";
			
		if($Response_A=="A")$checkedA='checked';
		if($Response_B=="B")$checkedB='checked';
		if($Response_C=="C")$checkedC='checked';
		if($Response_D=="D")$checkedD='checked';}
		echo "<tr><td>A.<input type=radio name=Answer_A$n value=A $checkedA></td><td>".$_SESSION["Current_Option_A"]."</td></tr>";
		echo "<tr><td>B.<input type=radio name=Answer_B$n value=B $checkedB></td><td>".$_SESSION["Current_Option_B"]."</td></tr>";
		echo "<tr><td>C.<input type=radio name=Answer_C$n value=C $checkedC></td><td>".$_SESSION["Current_Option_C"]."</td></tr>";
		echo "<tr><td>D.<input type=radio name=Answer_D$n value=D $checkedD></td><td>".$_SESSION["Current_Option_D"]."</td></tr>";
	}
	if($qtype=="Integer_Type"){
		echo "<tr><td colspan=2>YOUR RESPONSE - ".$_SESSION["$n.'_Int_Answer'"]."</td></tr>";}
	if($qtype=="True_False_Type"){
	$checkedT="";$checkedF="";
	if(isset($_SESSION["$n.'_Answer_Obtained'"])){
			$Response=$_SESSION["$n.'_Answer_Obtained'"];
		if($Response=="T")$checkedT='checked';
		if($Response=="F")$checkedF='checked';}
	echo "<tr><td><input type=radio name=Answer$n value=T $checkedT>True</td><td><input type=radio name=Answer$n value=F $checkedF>False</td></tr>";}
	echo "</table>";
	echo "<table align=right>";
	if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type" or $qtype=="True_False_Type")
	echo "<tr><td><input type=submit value='Save Response' name=qbt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:22pt;color:White'></td></tr>";
	echo "<tr><td><input type=submit value='Clear Response' name=rbt$n style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:22pt;color:White'></td></tr>";
	echo "</table>";
	if(isset($_POST["qbt"])){
	for($i=1;$i<=$totalq;$i++){
				if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type"){
					if(isset($_POST["Answer$i"])){
						$_SESSION["$i.'_Answer_Obtained'"]=$_POST["Answer$i"];
					}	
				}
				if($qtype=="Multiple_Correct_Type"){
					if(isset($_POST["Answer_A$i"]))$_SESSION["$i.'_Answer_Obtained_A'"]=$_POST["Answer_A$i"];
					if(isset($_POST["Answer_B$i"]))$_SESSION["$i.'_Answer_Obtained_B'"]=$_POST["Answer_B$i"];
					if(isset($_POST["Answer_C$i"]))$_SESSION["$i.'_Answer_Obtained_C'"]=$_POST["Answer_C$i"];
					if(isset($_POST["Answer_D$i"]))$_SESSION["$i.'_Answer_Obtained_D'"]=$_POST["Answer_D$i"];
					}
					}	
				Refresh();
	}
	if(isset($_POST["rbt$n"])){
				if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type")
					$_SESSION["$n.'_Answer_Obtained'"]="";
				if($qtype=="Multiple_Correct_Type"){
					$_SESSION["$n.'_Answer_Obtained_A'"]="";
					$_SESSION["$n.'_Answer_Obtained_B'"]="";
					$_SESSION["$n.'_Answer_Obtained_C'"]="";
					$_SESSION["$n.'_Answer_Obtained_D'"]="";
				}
				if($qtype=="Integer_Type")
					$_SESSION["$n.'_Int_Answer'"]="";
					$_SESSION["$n.'_Int_Answer'"]="";
					Refresh();
		}
}
if($_SESSION["TimeMethod"]==2)
{
		function Refresh(){
		echo "<script language=javascript>
			window.open('StudentPaper.php','_parent');
		</script>";
		}
		$n=$_SESSION["PaperQuestionNum"];
		$checkedA="";$checkedB="";$checkedC="";$checkedD="";
		if(isset($_SESSION["$n.'_Answer_Obtained'"])){
			$Response=$_SESSION["$n.'_Answer_Obtained'"];
		if($Response=="A")$checkedA='checked';
		if($Response=="B")$checkedB='checked';
		if($Response=="C")$checkedC='checked';
		if($Response=="D")$checkedD='checked';}
		echo "<table align=left>";
		echo "<tr><td><input type=radio name=Answer$n value=A $checkedA></td><td>Option A</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=B $checkedB></td><td>Option B</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=C $checkedC></td><td>Option C</td></tr>";
		echo "<tr><td><input type=radio name=Answer$n value=D $checkedD></td><td>Option D</td></tr>";
		echo "</table>";
		echo "<table align=right><tr><td><input type=submit value='Save Response' name=qbt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td></tr>";
		echo "<tr><td><input type=submit value='Clear Response' name=rbt$n style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td></tr></table>";
	
		if(isset($_POST["qbt"])){
			for($i=$_SESSION["Practice_StartQ"];$i<=$_SESSION["Practice_EndQ"];$i++)
				if(isset($_POST["Answer$i"]))
					$_SESSION["$i.'_Answer_Obtained'"]=$_POST["Answer$i"];
				Refresh();
		}
		
		if(isset($_POST["rbt$n"])){
			$_SESSION["$n.'_Answer_Obtained'"]="";
			Refresh();
		}
}
?>
</form>
</body>
</html>