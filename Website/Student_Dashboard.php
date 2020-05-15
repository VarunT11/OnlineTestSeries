<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center}
th{font-family:Calibri;font-size:22pt;color:White;}
a{font-family:Calibri;font-size:22pt;text-decoration:none;color:Black}
a:hover{text-decoration:underline}</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
if(!isset($_SESSION["StudentLogin"]))
	echo "Please <a href='Student_Login.php'>Login</a> or <a href='StudentNewAccount.php'>Sign Up</a> to access the Website";
else{
	$today=getdate();
	$examdate=mktime(0,0,0,5,20,2018);
	$currentdate=mktime(0,0,0,$today["mon"],$today["mday"],$today["year"]);
	$daysleft=floor(($examdate-$currentdate)/(3600*24));
	
	$location="Uploads/SyllabusMeter";
	$id=$_SESSION["StudentID"];
	$pfp=fopen("$location/Physics/$id.txt","a+");
	$cfp=fopen("$location/Chemistry/$id.txt","a+");
	$mfp=fopen("$location/Mathematics/$id.txt","a+");
	if(filesize("$location/Physics/$id.txt")==0){
		for($i=1;$i<=28;$i++)
			fwrite($pfp,"$i N \r\n");
	}
	if(filesize("$location/Chemistry/$id.txt")==0){
		for($i=1;$i<=27;$i++)
			fwrite($cfp,"$i N \r\n");
	}
	if(filesize("$location/Mathematics/$id.txt")==0){
		for($i=1;$i<=26;$i++)
			fwrite($mfp,"$i N \r\n");
	}
	$totalchap=81;
	$completedchap=0;
	for($i=1;$i<=28;$i++){
		$len=strlen($i);
		while(!feof($pfp)){
		$ch=fgets($pfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedchap=$completedchap+1;
		rewind($pfp);}
	for($i=1;$i<=27;$i++){
		$len=strlen($i);
		while(!feof($cfp)){
		$ch=fgets($cfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedchap=$completedchap+1;
		rewind($cfp);}
	for($i=1;$i<=26;$i++){
		$len=strlen($i);
		while(!feof($mfp)){
		$ch=fgets($mfp);
		if(substr($ch,0,$len)==$i and substr($ch,$len,1)==" ")
			$check=substr($ch,($len+1),1);
		}
		if($check=="Y")
			$completedchap=$completedchap+1;
		rewind($mfp);}	
	$syllabusmeter=floor(($completedchap/$totalchap)*100);
	echo "
	<img src='Pictures/Picture1.png' width=100%>
	<br>
	<table bgcolor=white align=right width=36%>
	<tr><th style='color:Black;font-size:23pt'>DAYS LEFT FOR THE EXAM</th></tr>
	<tr><td style='color:Blue;font-size:23pt'>$daysleft</td></tr>
	</table>
	<table bgcolor=white align=right width=32%>
	<tr><th style='color:Black;font-size:23pt'><a href='Student_SyllabusMeter.php' style='font-size:23pt'>SYLLABUS METER</a></th></tr>
	<tr><td style='color:Blue;font-size:23pt'>$syllabusmeter %</td></tr>
	</table>
	<table bgcolor=white align=right width=32%>
	<tr><th style='color:Black;font-size:23pt'>NUMBER OF SUBJECTS</th></tr>
	<tr><td style='color:Blue;font-size:23pt'>3</td></tr>
	</table>
	<table bgcolor=#09b529 width=100%>
	<tr><th colspan=3>TEST FROM THE QUESTION BANK</th><th>SELF PRACTICE TEST</th></tr>
	<tr><td><a href='StudentPaper1.php'>Single Topic</a></td>
	<td><a href='StudentPaper3.php'>Multiple Topics</a></td>
	<td><a href='StudentPaper2.php'>All Topics</a></td>
	<td><a href='StudentSelfPractice_Home.php'>Self Practice Test</a></td></tr>
	</table>
	<table bgcolor=#1b82b2 align=left width=100%>
	<tr><th colspan=2>MY ACCOUNT</th></tr>
	<tr>
	<td><a href='PhotoUpdate.php'>Update Photo</a></td>
	<td><a href='ChangePassword.php'>Change Password</a></td>
	</tr>
	</table>
	";
}
?>
</center>
</body>
</html>