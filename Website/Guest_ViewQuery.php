<html>
<style type="text/css">
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center;color:white}
</style>
<body bgcolor="#B3D5F2">
<form method=post>
<?php
session_start();
$queryID=$_SESSION["Current_ID"];
$conn=new mysqli("localhost","root","","Guest");
$dataquery="select * from guestquery where queryID=$queryID";
$select=$conn->query($dataquery);
while($row=$select->fetch_assoc()){
	$name=$row["Name"];
	$timeofquery=$row["TimeOfQuery"];
	$dob=$row["Date_Of_Birth"];
	$number=$row["Contact_Number"];
	$email=$row["Email_ID"];
	$resolved=$row["Resolved"];
}
echo "<table width=100% bgcolor='#1172DF'><tr><td><b>Query ID</b> - $queryID </td><td> <b>Name</b> - $name</td></tr>";
date_default_timezone_set("Asia/Calcutta");
$tim=getdate($timeofquery);
$time=$tim["hours"].":".$tim["minutes"].":".$tim["seconds"]."  ".$tim["mday"]." ".$tim["month"]." ".$tim["year"].", ".$tim["weekday"];
echo "<tr><td colspan=2><b>Time Of Query</b> - $time</td></tr>";
echo "<tr><td><b>Contact Number</b> - $number </td><td> <b>Email ID</b> - $email</td></tr>";
echo "<tr><td colspan=2><b>Your Query - </b></td></tr>";
$fp=fopen("Uploads/Guests/Queries.txt","r+");
$length=strlen($queryID);
$start=$length+1;
while(!feof($fp)){
	$ch=fgets($fp);
	if(substr($ch,0,$length)==$queryID)
		$query_1=substr($ch,$start);
}
$query="";
$len=strlen($query_1);
for($j=0;$j<$len;$j++){
	$ch=substr($query_1,$j,1);
	if($ch=="|")
		$query=$query."<br>";
	else
		$query=$query.$ch;
}
echo "<tr><td colspan=2>$query</td></tr><br>";
if($resolved=="No")
	$Current_Status="Unresolved";
else
	$Current_Status="Resolved";
echo "<tr><td><b>Current Status</b> -</td><td>$Current_Status</td></tr>";
if($resolved=="Yes"){
	echo "<tr><td colspan=2><b>Admin's Reply</b> - </td></tr>";
	$fp=fopen("Uploads/Guests/Queries_Reply.txt","r+");
	$length=strlen($queryID);
	$start=$length+1;
	while(!feof($fp)){
	$ch=fgets($fp);
	if(substr($ch,0,$length)==$queryID)
		$reply_1=substr($ch,$start);
	}
	$reply="";
	$len=strlen($reply_1);
	for($j=0;$j<$len;$j++){
	$ch=substr($reply_1,$j,1);
	if($ch=="|")
		$reply=$reply."<br>";
	else
		$reply=$reply.$ch;
}
echo "<tr><td colspan=2>$reply</td></tr><br>";
	
}
echo "<tr><td colspan=2><input type=submit value='Close' name=bt></td></tr></table>";
if(isset($_POST["bt"])){
	echo "<script language=javascript>window.close()</script>";
}
?>
</form>
</body>
</html>