<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
legend{font-family:Calibri;font-size:30pt}
td{font-family:Calibri;font-size:22pt;text-align:center}
th{font-family:Calibri;font-size:25pt}
</style>
<body bgcolor="#B3D5F2">
<form method=post>
<center>
<?php
session_start();
$conn=new mysqli("localhost","root","","guest");
$fp=fopen("Uploads/Guests/Queries.txt","r+");
$newqueries="select * from guestquery where Resolved='No'";
$newquery_select=$conn->query($newqueries);
$unresolved_queries=$newquery_select->num_rows;
$n=1;
if(($unresolved_queries)=="0")
	echo "All Queries Resolved";
else
{
	echo "<legend>Unresolved Queries</legend>";
	echo "<table width=100%><tr><th>Query ID</th><th>Name</th><th>Query</th></tr>";
	while($row=$newquery_select->fetch_assoc())
	{
		$queryID=$row["QueryID"];
		$_SESSION["Query$n"]=$queryID;$n++;
		$name=$row["Name"];
		$email=$row["Email_ID"];
		echo "<tr><td>$queryID</td><td>$name</td><td><input type=submit value='View Query' name='$queryID' style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:20pt;color:White'></td></tr>";
	}
	echo "</table>";
}
for($i=1;$i<=$unresolved_queries;$i++)
{
	$queryID=$_SESSION["Query$i"];
	if(isset($_POST["$queryID"])){
		$_SESSION["Current_ID"]=$queryID;
		echo "<script language=javascript>
			var myWindow;
			myWindow = window.open('Admin_QueryResolve.php', '_blank', 'width=1500, height=900');
		</script>";
	}
}
?>
</center>
</form>
</body>
</html>