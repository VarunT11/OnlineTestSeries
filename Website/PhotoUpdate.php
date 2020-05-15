<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:26pt;font-weight:bold}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black;border-radius:5pt}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{font-family:Calibri;font-size:22pt;text-align:center;color:white}
th{font-family:Calibri;font-size:22pt;color:White;}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
if(isset($_SESSION["AdminLogin"])){
	$username=$_SESSION["AdminID"];
	$conn=new mysqli("localhost","root","","Admin");
	$q="select Profile_Photo from AdminList where username='$username'";$select=$conn->query($q);
	while($row=$select->fetch_assoc())
		$oldphoto=$row["Profile_Photo"];
	echo "
		UPDATE YOUR PROFILE PHOTO
		<form method='post' enctype='multipart/form-data'>
		<table bgcolor=#1b82b2>
		<tr><td>Upload Your Image - </td><td><input type=file name=file></td></tr>
		<tr><td colspan=2><input type=Submit value=Submit name=bt></td></tr>
		</table>
		</form>
		";
	if(isset($_POST["bt"])){
		if(is_uploaded_file($_FILES["file"]["tmp_name"])){
		unlink($oldphoto);
		$Path="Uploads/Admin/Photos/$username.".pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["file"]["tmp_name"],$Path);
		$q="update set Profile_Photo='$Path' where username='$username'";
		echo "File Uploaded Successfully";
		}
		else
			echo "Error in Uploading File";
	}
	$conn->close();
}
elseif(isset($_SESSION["StudentLogin"])){
	$username=$_SESSION["StudentID"];
	$conn=new mysqli("localhost","root","","Student");
	$q="select Profile_Photo from StudentList where username='$username'";$select=$conn->query($q);
	while($row=$select->fetch_assoc())
		$oldphoto=$row["Profile_Photo"];
	echo "
		UPDATE YOUR PROFILE PHOTO
		<form method='post' enctype='multipart/form-data'>
		<table bgcolor=#1b82b2>
		<tr><td>Upload Your Image - </td><td><input type=file name=file></td></tr>
		<tr><td colspan=2><input type=Submit value=Submit name=bt></td></tr>
		</table>
		</form>
		";
	if(isset($_POST["bt"])){
		if(is_uploaded_file($_FILES["file"]["tmp_name"])){
		unlink($oldphoto);
		$Path="Uploads/Students/Profile_Photos/$username.".pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["file"]["tmp_name"],$Path);
		$q="update set Profile_Photo='$Path' where username='$username'";
		echo "File Uploaded Successfully";
		}
		else
			echo "Error in Uploading File";
	}
	$conn->close();
}
else
	echo "You are not allowed to access the Website";
?>
</center>
</body>
</html>