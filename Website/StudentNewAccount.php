<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:20pt}
input{font-family:Calibri;font-size:18pt;background-color:Cream;border-color:Black}
legend{font-family:Calibri;font-size:25pt}
td{font-family:Calibri;font-size:18pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<table>
<legend>CREATE NEW ACCOUNT</legend>
<form name=frm method="post" enctype="multipart/form-data">
<tr><td>Enter Your Name</td><td><input type=text name="nm"></td></tr>
<tr><td>Enter Your Username</td><td><input type=text name="user"></td></tr>
<tr><td>Enter Your Password</td><td><input type=password name="password"></td></tr>
<tr><td>Enter Your Date of Birth</td><td><input type=date name="DOB"></td></tr>
<tr><td>Upload Your Image</td><td><input type="file" name="file"></td></tr>
<tr><td colspan=2><input type="submit" value="Create Account" name="bt"  style="background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:'Tempus Sans ITC';font-size:20pt;color:White"></td></tr>
</table>
</form>
<?php
if(isset($_POST["bt"])){
	$nm=$_POST["nm"];$user=$_POST["user"];$password=$_POST["password"];$dob=$_POST["DOB"];
	$Path="Uploads/Students/Profile_Photos/$user.".pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	if($nm=="" or $user=="" or $password=="" or $dob=="")
		die("Please Fill Up All The Deatils");
	$conn=new mysqli("localhost","root","","Student");
	$q="insert into StudentList values('$user','$nm','$password','$dob','$Path')";
	$select=$conn->query($q);
	if($select){echo "Account Created Successfully";move_uploaded_file($_FILES["file"]["tmp_name"],$Path);}
	else {echo "Error in Account Creation<br>Error : ".$select->error();}
}
?>
</center>
</body>
</html>