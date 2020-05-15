<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
input{font-family:Calibri;font-size:22pt;background-color:White;border:0;font-weight:bold}
input:hover{text-decoration:underline}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:18pt;text-align:center;color:blue}
th{font-family:Calibri;font-size:22pt;color:Black;}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<center>
<?php
session_start();
if(!isset($_SESSION["StudentLogin"]))
	echo "You are Not Authorised to Access The Website";
else{
	$location="Uploads/SyllabusMeter";
	$id=$_SESSION["StudentID"];
	$pfp=fopen("$location/Physics/$id.txt","a+");
	$cfp=fopen("$location/Chemistry/$id.txt","a+");
	$mfp=fopen("$location/Mathematics/$id.txt","a+");
	$completedchem=0;
	$completedmaths=0;
	$completedphysics=0;
	
	for($i=1;$i<=28;$i++){
		$len=strlen($i);
		while(!feof($pfp)){
		$ch=fgets($pfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedphysics=$completedphysics+1;
		rewind($pfp);}
	for($i=1;$i<=27;$i++){
		$len=strlen($i);
		while(!feof($cfp)){
		$ch=fgets($cfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedchem=$completedchem+1;
		rewind($cfp);}
		for($i=1;$i<=26;$i++){
		$len=strlen($i);
		while(!feof($mfp)){
		$ch=fgets($mfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedmaths=$completedmaths+1;
		rewind($mfp);}
	
	
	
	$total_meter=floor((($completedchem+$completedmaths+$completedphysics)/81)*100);
	$physics_meter=floor((($completedphysics)/28)*100);
	$chemistry_meter=floor((($completedchem)/27)*100);
	$maths_meter=floor((($completedmaths)/26)*100);
	
	echo "<table bgcolor=white width=100%>
	<tr><th>SYLLABUS METER</th></tr>
	<tr><td>$total_meter %</td></tr>
	</table><br>
	Click On The Subject Name to Update Your Progress
	<br>
	<table bgcolor=white width=33% align=left>
	<tr><th><input type=submit name='pbt' value='PHYSICS'></th></tr>
	<tr><td>$physics_meter %</td></tr>
	</table>
	<table bgcolor=white width=33% align=left>
	<tr><th><input type=submit name='cbt' value='CHEMISTRY'></th></tr>
	<tr><td>$chemistry_meter %</td></tr>
	</table>
	<table bgcolor=white width=33% align=left>
	<tr><th><input type=submit name='mbt' value='MATHEMATICS'></th></tr>
	<tr><td>$maths_meter %</td></tr>
	</table>
	<br>
	";
	if(isset($_POST["pbt"])){
		$_SESSION["Current_Subject"]="Physics";
		echo "<script language=javascript>
			var myWindow;
			myWindow = window.open('Student_SyllabusMeterUpdate.php', '_blank', 'width=1500, height=900');
			</script>";}
	if(isset($_POST["cbt"])){
		$_SESSION["Current_Subject"]="Chemistry";
		echo "<script language=javascript>
			var myWindow;
			myWindow = window.open('Student_SyllabusMeterUpdate.php', '_blank', 'width=1500, height=900');
			</script>";}
	if(isset($_POST["mbt"])){
		$_SESSION["Current_Subject"]="Mathematics";
		echo "<script language=javascript>
			myWindow = window.open('Student_SyllabusMeterUpdate.php', '_blank', 'width=1500, height=900');
			</script>";}
}
?>
</center>
</form>
</body>
</html>