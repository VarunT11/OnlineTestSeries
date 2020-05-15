<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
textarea{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{font-family:Calibri;font-size:22pt;text-align:center}
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
}
echo "<table width=100%><tr><td><b>Query ID</b> - $queryID </td><td> <b>Name</b> - $name</td></tr>";
date_default_timezone_set("Asia/Calcutta");
$tim=getdate($timeofquery);
$time=$tim["hours"].":".$tim["minutes"].":".$tim["seconds"]."  ".$tim["mday"]." ".$tim["month"]." ".$tim["year"].", ".$tim["weekday"];
echo "<tr><td colspan=2><b>Time Of Query</b> - $time</td></tr>";
echo "<tr><td><b>Contact Number</b> - $number </td><td> <b>Email ID</b> - $email</td></tr>";
echo "<tr><td colspan=2><b>Query - </b></td></tr>";
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
echo "<tr><td>Your Reply - </td><td><textarea name=Reply rows=4 cols=30></textarea></td></tr><br>";
echo "<tr><td>Query Resolved -</td><td> Yes<input type=radio name='Resolved' value='Yes'> &nbsp &nbsp No<input type=radio name='Resolved' value='No'></td></tr>";
echo "<tr><td colspan=2><input type=submit value='Submit and Close' name=bt></td></tr></table>";
if(isset($_POST["bt"])){
	$value=$_POST["Resolved"];
	$reply_1=$_POST["Reply"];$reply="";
	$length=strlen($reply_1);
	for($i=0;$i<$length;$i++){
	$ch=substr($reply_1,$i,1);
	if($ch=="\n")
		$reply=$reply."|";
	else
		$reply=$reply.$ch;
	}
	if($value=="Yes"){
		$rep=fopen("Uploads/Guests/Queries_Reply.txt","a+");
		fwrite($rep,"$queryID $reply \r\n");
	}
	$changequery="update guestquery set Resolved='$value' where QueryID=$queryID";
	$conn->query($changequery);
	echo "<script language=javascript>window.close()</script>";
}
?>
</form>
</body>
</html>