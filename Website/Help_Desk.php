<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:28pt}
input{font-family:Calibri;font-size:15pt;background-color:Cream;border-color:Black}
textarea{font-family:Calibri;font-size:15pt;background-color:Cream;border-color:Black}
table{background-color:#087BD4;border-style:solid;border:1;border-color:Black}
td{font-family:Calibri;font-size:15pt;text-align:center;color:Silver}
th{font-family:Calibri;font-size:20pt;text-align:center;font-weight:bold;color:Gold}
</style>
</head>
<body bgcolor="#B3D5F2">
<form method=post>
<center>WANT HELP ?</center>
<table align=right width=55%>
<tr><th colspan=2>Fill Up This Form, We will Contact You Shortly</th></tr>
<tr><td>Name</td><td><input type=text name="Name"></td></tr>
<tr><td>Date of Birth</td><td><input type=date name="DOB"></td></tr>
<tr><td>Contact Number</td><td><input type=text name="Number"></td></tr>
<tr><td>Email ID</td><td><input type=text name="Email"></td></tr>
<tr><td>Query</td><td><textarea rows=3 cols=30 name="Query"></textarea></td></tr>
<tr><td style="text-align:center" colspan=2><input type=submit value="Submit" name=bt1 style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:20pt;color:White"></td></tr>
</table>
<table align=center width=44%>
<tr><th colspan=2>Check Query Status</th></tr>
<tr><td>Enter Your Query ID</td><td style="text-align:center"><input type=text name="queryID"></td></tr>
<tr><td>Enter Your Date Of Birth</td><td style="text-align:center"><input type=date name="DatePass"></td></tr>
<tr><td colspan=2><input type=submit value="Check Query Status" name=bt2 style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:16pt;color:White"></td></tr>
</table>
<table align=center width=44%>
<tr><th colspan=2>Contact Us</th></tr>
<tr><td>Phone Number</td><td style="text-align:center">9580132139</td></tr>
<tr><td>Email ID</td><td style="text-align:center">varun.2011t@gmail.com</td></tr>
</table>
</form>
<?php
session_start();
function alert($x){
	echo "<script language=javascript>
	alert('$x')
	</script>";
}
if(isset($_POST["bt1"])){
$name=$_POST["Name"];
$dob=$_POST["DOB"];
$query_1=$_POST["Query"];$query="";
$length=strlen($query_1);
for($i=0;$i<$length;$i++){
	$ch=substr($query_1,$i,1);
	if($ch=="\n")
		$query=$query."|";
	else
		$query=$query.$ch;
}
$number=$_POST["Number"];
$email=$_POST["Email"];
$time=time();
if($name=="" or $dob=="" or $query=="" or $email=="" or $number=="")
	alert("Please Fill Up All The Details");
else{
		$conn=new mysqli("localhost","root","","guest");
		$num_query="select * from guestquery";$select=$conn->query($num_query);
		$n=$select->num_rows;
		$queryID=$n+1;
		$fp=fopen("Uploads/Guests/Queries.txt","a+");
		$q="insert into guestquery values($queryID,'$time','$name','$dob','$number','$email','No')";
		if($conn->query($q))
		{
			fwrite($fp,"$queryID $query \r\n");
			alert("Data Submitted Successfully. Your Query ID is $queryID. Please Keep It For Future Reference.");
		}
		else
		{
			$error=$conn->error;
			alert("$error");
		}
		fclose($fp);
}
}
if(isset($_POST["bt2"])){
	$queryID=$_POST["queryID"];
	if($queryID=="")$queryID=0;
	$DatePass=$_POST["DatePass"];
	$conn=new mysqli("localhost","root","","Guest");
	$ViewQuery="select * from guestquery where QueryID=$queryID and Date_Of_Birth='$DatePass'";
	$select=$conn->query($ViewQuery);
	if($select->num_rows==1){
		$_SESSION["Current_ID"]=$queryID;
		echo "<script language=javascript>
			var myWindow;
			myWindow = window.open('Guest_ViewQuery.php', '_blank', 'width=1500, height=900');
		</script>";
	}
	else
		alert("Incorrect Query ID or Date Of Birth");
}
?>
</body>
</html>