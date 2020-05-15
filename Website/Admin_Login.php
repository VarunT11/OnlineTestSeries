<html>
<style type="text/css">
input{font-family:Calibri;font-size:15pt;background-color:Cream;border-color:Black}
legend{font-family:Calibri;font-size:18pt}
td{font-family:Calibri;font-size:15pt}
h1{font-size:30pt}
body{font-family:Calibri;font-size:15pt}
e{font-family:'Tempus Sans ITC';font-size:15pt;color:White;background-color:red;border:5pt;border-color:white}
</style>
<body bgcolor="#B3D5F2"><center>
<table>
<legend>
<h1>ADMIN LOGIN</h1>
Login Using Your Registered Details
</legend>
<br>
<form name=frm method="post">
<tr><td>Enter Your Username</td><td>  <input type=text name="user"></td></tr>
<tr><td>Enter Your Password</td><td>  <input type=password name="password"></td></tr>
<tr><td colspan=2 style="text-align:center"><input type="submit" value="Log In" name="bt" style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:20pt;color:White"></td></tr>
</form>
</table>
<?php
if(isset($_POST["bt"])){
	$user=$_POST["user"];$password=$_POST["password"];
	$conn=new mysqli("localhost","root","","Admin");
	$q="select * from AdminList where username='$user' and password='$password'";
	$select=$conn->query($q);
	if($select->num_rows=="1"){
		session_start();
		$_SESSION["AdminLogin"]="true";
		while($row=$select->fetch_assoc()){
			$_SESSION["AdminID"]=$row["username"];
			$_SESSION["AdminPhoto"]=$row["Profile_Photo"];
			$name=$row["Name"];
			$len=strlen($name);
			$firstname="";
			for($i=0;$i<$len;$i++)
			{
				$chr=substr($name,$i,1);
				if($chr==" ")
					break;
				else
					$firstname=$firstname.$chr;
			}
			$_SESSION["AdminName"]=$firstname;
		}
		echo "<script language=javascript>
		window.open('http://localhost/PHP/Test/Admin_HomePage.php','_parent')
		</script>";
	}
	else {echo "<e>Incorrect Username or Password</e>";}
}
?>
</center>
</body>
</html>