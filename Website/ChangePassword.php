<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:26pt;font-weight:bold}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center;color:White}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
if(isset($_SESSION["AdminLogin"])){
	$username=$_SESSION["AdminID"];
	$conn=new mysqli("localhost","root","","Admin");
	echo "
		CHANGE YOUR PASSWORD
		<form method='post'>
		<table bgcolor=#1b82b2>
		<tr><td>Enter Your Current Password - </td><td><input type=password name=pcurrent></td></tr>
		<tr><td>Enter Your New Password - </td><td><input type=password name=pnew></td></tr>
		<tr><td>Confirm Your Password - </td><td><input type=password name=pconfirm></td></tr>
		<tr><td colspan=2><input type=Submit value=Submit name=bt></td></tr>
		</table>
		</form>
		";
	if(isset($_POST["bt"])){
		$pcurrent=$_POST["pcurrent"];$pnew=$_POST["pnew"];$pconfirm=$_POST["pconfirm"];
		$q="select * from AdminList where username='$username' and password='$pcurrent'";
		$select=$conn->query($q);
		if(!$select->num_rows==1)
			echo "Please Enter The Correct Current Password";
		else{
			if(!$pnew==$pconfirm)
				echo "Passwords Do Not Match";
			else{
				$p="update AdminList set password='$pnew' where username='$username'";
				if($conn->query($p))
					echo "Password Changed Successfully";
				else
					echo "Password could not be changed";			
			}
		}
	}
	$conn->close();
}
elseif(isset($_SESSION["StudentLogin"])){
	$username=$_SESSION["StudentID"];
	$conn=new mysqli("localhost","root","","Student");
	echo "
		CHANGE YOUR PASSWORD
		<form method='post'>
		<table bgcolor=#1b82b2>
		<tr><td>Enter Your Current Password - </td><td><input type=password name=pcurrent></td></tr>
		<tr><td>Enter Your New Password - </td><td><input type=password name=pnew></td></tr>
		<tr><td>Confirm Your Password - </td><td><input type=password name=pconfirm></td></tr>
		<tr><td colspan=2><input type=Submit value=Submit name=bt></td></tr>
		</table>
		</form>
		";
	if(isset($_POST["bt"])){
		$pcurrent=$_POST["pcurrent"];$pnew=$_POST["pnew"];$pconfirm=$_POST["pconfirm"];
		$q="select * from StudentList where username='$username' and password='$pcurrent'";
		$select=$conn->query($q);
		if(!$select->num_rows==1)
			echo "Please Enter The Correct Current Password";
		else{
			if(!$pnew==$pconfirm)
				echo "Passwords Do Not Match";
			else{
				$p="update StudentList set password='$pnew' where username='$username'";
				if($conn->query($p))
					echo "Password Changed Successfully";
				else
					echo "Password could not be changed";			
			}
		}
	}
	$conn->close();
}
else
	echo "You are not allowed to access the Website";
?>
</center>
</body>
</html>