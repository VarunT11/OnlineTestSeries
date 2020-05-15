<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:22pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
select{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<form method=post>
<?php
session_start();
if(!isset($_SESSION["StudentLogin"]))
	echo "Please <a href='Student_Login.php'>Login</a> or <a href='StudentNewAccount.php'>Sign Up</a> to access the Website";
else{
	echo "
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
		<tr><td colspan=3><input type=submit value='Proceed' name=bt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'></td></tr>
		</table>
	";
}
if(isset($_POST["bt"])){
	if(!isset($_POST["subject"]) or $_POST["totalq"]=="")
		die("Please Fill Up All The Deatils");
	$_SESSION["subject"]=$_POST["subject"];$_SESSION["qtype"]=$_POST["qtype"];$_SESSION["totalq"]=$_POST["totalq"];
	$_SESSION["PaperEntry"]="True";
	$_SESSION["PaperMethod"]="2";
	echo "<script language=javascript>
			window.open('StudentPaperIntro.php', '_blank','width=1500, height=900');
		</script>";
}
?>
</form>
</center>
</body>
</html>