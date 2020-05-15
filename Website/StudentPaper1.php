<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
select{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center}
th{font-family:Calibri;font-size:22pt;text-align:center;color:white}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
if(!isset($_SESSION["StudentLogin"]))
	echo "Please <a href='Student_Login.php'>Login</a> or <a href='StudentNewAccount.php'>Sign Up</a> to access the Website";
else{
	function redirect($url){ob_start();header('Location: '.$url);ob_end_flush();}
	echo "
		<form method=post>
		<table width=100% bgcolor='#09b529'>
		<tr><td colspan=3>Choose the Subject</td></tr>
		<tr><td>Physics<input type=radio name=subject value=Physics></td>
			<td>Chemistry<input type=radio name=subject value=Chemistry></td>
			<td>Mathematics<input type=radio name=subject value=Mathematics></td>
		</tr>
		<tr><td colspan=2>Select The Question Type - </td>
		<td>
			<select name=qtype>
				<option value='Single_Correct_Type'>Single Correct Type</option>
				<option value='Multiple_Correct_Type'>Multiple Correct Type</option>
				<option value='Integer_Type'>Integer Answer Type</option>
				<option value='True_False_Type'>True-False Type</option>			
			</select>
		</td></tr>
		<tr><td colspan=2>Enter The Number of Questions you want - </td><td><input type=text name=totalq></td></tr>
		<tr><td colspan=3><input type=submit value='Proceed' name=bt1 style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'></td></tr>
		</table>
	";
}
if(isset($_POST["bt1"])){
		if(!isset($_POST["subject"]))
			die("Please Fill Up All The Details");
		$subject=$_POST["subject"];
		$qtype=$_POST["qtype"];
		$totalq=$_POST["totalq"];
		if($qtype=="" or $totalq=="")
			die("Please Fill Up All The Details");
		$_SESSION["subject"]=$subject;
		$_SESSION["qtype"]=$qtype;
		$_SESSION["totalq"]=$totalq;
		echo "<table width=100% bgcolor='#09b529'><tr><th>SUBJECT - $subject </th><th> QUESTION TYPE - $qtype </th></tr>";
		$conn=new mysqli("localhost","root","","$subject");
		$query="select * from $qtype";
		$select=$conn->query($query);
		$totalq=$select->num_rows;
		$k=1;
		for($i=1;$i<=$totalq;$i++){
			$qquery="select * from $qtype where QNum=$i";
			$qselect=$conn->query($qquery);
			
			while($row=$qselect->fetch_assoc()){
				$_SESSION["$i.QuestionTopic"]=$row["Topic"];
			}
			if($i==1)
				$_SESSION["$k.Topic"]=$_SESSION["$i.QuestionTopic"];
			$l=0;
			for($j=1;$j<=$k;$j++){
				if($_SESSION["$i.QuestionTopic"]==$_SESSION["$j.Topic"])
				$l=$l+1;
			}
			if($l==0){
				$k=$k+1;
				$_SESSION["$k.Topic"]=$_SESSION["$i.QuestionTopic"];
			}
		}
		$_SESSION["Topics_Num"]=$k;
		
		if($_SESSION["Topics_Num"]==0)
			die("0 Questions Available");
		for($i=1;$i<=$_SESSION["Topics_Num"];$i++){
			$val=$_SESSION["$i.Topic"];
			$len=strlen($val);
			$newval="";
			for($j=0;$j<$len;$j++){
				$chr=substr($val,$j,1);
				if($chr==" ")
					$newval=$newval."_";
				else
					$newval=$newval.$chr;
			}
			$_SESSION["$i.Topic"]=$newval;
			
		}
	
		echo "<tr><td>Choose The Topic - </td><td><select name=topic>";
		for($i=1;$i<=$_SESSION["Topics_Num"];$i++){
			$val=$_SESSION["$i.Topic"];
			echo "<option value='$val'>$val</option>";
		}
		echo "</select></td></tr>";
		echo "<tr><td colspan=2><input type=submit value=Submit name=bt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'></td></tr></table>";
}

if(isset($_POST["bt"])){
	$a=$_POST["topic"];
	$len=strlen($a);
	$topic="";
	for($i=0;$i<$len;$i++){
		$chr=substr($a,$i,1);
		if($chr=="_")
			$topic=$topic." ";
		else
			$topic=$topic.$chr;
	}
	$_SESSION["topic"]=$topic;
	$_SESSION["PaperEntry"]="True";
	$_SESSION["PaperMethod"]="1";
	echo "<script language=javascript>
			window.open('StudentPaperIntro.php', '_blank', 'width=1500, height=900');
		</script>";
}
?>
</center>
</body>
</html>