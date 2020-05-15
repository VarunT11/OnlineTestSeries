<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:18pt;text-align:center;color:black}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<center>
<?php
session_start();
$subject=$_SESSION["Current_Subject"];
$id=$_SESSION["StudentID"];
$conn=new mysqli("localhost","root","","syllabus");
$fp=fopen("Uploads/SyllabusMeter/$subject/$id.txt","r+");
if($subject=="Physics")
	$totalt=28;
if($subject=="Chemistry")
	$totalt=27;
if($subject=="Mathematics")
	$totalt=26;
echo "Subject - $subject <br>";
echo "<table>";
for($i=1;$i<=$totalt;$i++){
	$q="select * from advanced_$subject where Topic_No=$i";
	$s=$conn->query($q);
	while($r=$s->fetch_assoc())
		$topic=$r["Topic_Name"];
	$len=strlen($i);
	while(!feof($fp)){
		$ch=fgets($fp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
	}
	if($check=="Y")
		$checked="checked";
	else
		$checked="";
	echo "<tr><td style='text-align:right'><input type=checkbox name=$i value=$i $checked></td><td style='text-align:left'>$topic</td></tr>";
	rewind($fp);
	}
fclose($fp);
echo "<tr><td colspan=2><input type=submit value='Update And Close' name=bt></td></tr>";
if(isset($_POST["bt"])){
	$fp=fopen("Uploads/SyllabusMeter/$subject/$id.txt","r+");
	$record="";
	for($i=1;$i<=$totalt;$i++){
		if(isset($_POST["$i"]))
			$y="Y";
		else
			$y="N";
	$record=$record."$i $y \r\n";	
	}
	fwrite($fp,$record);
	fclose($fp);
	echo "<script language=javascript>window.close()</script>";
}
?>
</center>
</form>
</body>
</html>