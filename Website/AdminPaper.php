<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
textarea{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
select{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
td{font-family:Calibri;font-size:22pt;text-align:center}
</style>
<body bgcolor="#B3D5F2"><center>
<?php
session_start();
if(!isset($_SESSION["AdminLogin"]))
	echo "You are not Authorized to Access the website.";
elseif($_SESSION["AdminLogin"]=="true"){
echo "
<form method='post' enctype='multipart/form-data'>
Choose the Subject - <input type=radio name='subject' value='Physics'>PHYSICS &nbsp
					 <input type=radio name='subject' value='Chemistry'>CHEMISTRY &nbsp
					 <input type=radio name='subject' value='Mathematics'>MATHEMATICS
<br>
Choose the type of Question - <select name='qtyp'>
<option value='Single_Correct_Type'>Single Correct Type</option>
<option value='Multiple_Correct_Type'>Multiple Correct Type</option>
<option value='Integer_Type'>Integer Answer Type</option>
<option value='True_False_Type'>True-False Type</option>
</select>
<br>
<input type='Submit' value='Proceed' name='bt' style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'>
</form>";
}
if(isset($_POST["bt"])){
	if(!isset($_POST["subject"]))
		die("Please Fill All The Fields");
	$qtyp=$_POST["qtyp"];$subject=$_POST["subject"];
	$_SESSION["qtyp"]=$qtyp;$_SESSION["subject"]=$subject;
	$_SESSION["FileUpload_Path"]="Uploads/Questions/$subject/$qtyp/";
		echo "
		<form method='post' enctype='multipart/form-data'>
		<table width=100%>
		<tr><td colspan=3>Enter the Question</td></tr><tr><td colspan=3><textarea cols=60 rows=4 name='question'></textarea></td></tr><tr><td colspan=3>OR</td></tr><tr><td colspan=3> Choose the file <input type='file' name='qfile'></td></tr>
		<tr><td colspan=3>
		Enter the Name of The Topic - <input type='text' name='topic'>
		</td></tr>";
		if($qtyp=="Single_Correct_Type"){
			echo "
				<tr><td>Enter Option A - <input type='text' name='optionA'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileA'></td></tr>
				<tr><td>Enter Option B - <input type='text' name='optionB'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileB'></td></tr>
				<tr><td>Enter Option C - <input type='text' name='optionC'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileC'></td></tr>
				<tr><td>Enter Option D - <input type='text' name='optionD'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileD'></td></tr>
				<tr><td colspan=3>CORRECT ANSWER - Option A<input type=radio name='Ans' value='A'>
								Option B<input type=radio name='Ans' value='B'>
								Option C<input type=radio name='Ans' value='C'>
								Option D<input type=radio name='Ans' value='D'>
				</td></tr>				
		";}
			if($qtyp=="Multiple_Correct_Type"){
			echo "
				<tr><td>Enter Option A - <input type='text' name='optionA'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileA'></td></tr>
				<tr><td>Enter Option B - <input type='text' name='optionB'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileB'></td></tr>
				<tr><td>Enter Option C - <input type='text' name='optionC'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileC'></td></tr>
				<tr><td>Enter Option D - <input type='text' name='optionD'></td><td>OR</td><td>Choose the file - <input type='file' name='ofileD'></td></tr>
				<tr><td colspan=3>CORRECT ANSWER - Option A<input type=checkbox name='AnsA' value='A'>
								Option B<input type=checkbox name='AnsB' value='B'>
								Option C<input type=checkbox name='AnsC' value='C'>
								Option D<input type=checkbox name='AnsD' value='D'><br>
			";}
		if($qtyp=="Integer_Type")
			echo "<tr><td colspan=3>Enter Correct Answer - <input type='text' name='Ans'></td></tr>";
		if($qtyp=="True_False_Type")
			echo "<tr><td>Choose the Correct - </td><td> True<input type='radio' name='Ans' value='true'></td><td> False<input type='radio' name='Ans' value='false'></td></tr>";
		echo "<tr><td colspan=3><input type='submit' value='Submit Question' name='bt1' style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'></td></tr></table></form>";
}
	function get_ext($file){
		$ext=pathinfo($_FILES["$file"]["name"],PATHINFO_EXTENSION);
		return $ext;		
	}
	function FileUpload($file,$name){
		$path=$_SESSION["FileUpload_Path"]."$name";
		move_uploaded_file($_FILES["$file"]["tmp_name"],$path);
	}	

if(isset($_POST["bt1"])){
	$qtyp=$_SESSION["qtyp"];$subject=$_SESSION["subject"];	
	$conn=new mysqli("localhost","root","","$subject");
	$p="select * from $qtyp";$select=$conn->query($p);$i=$select->num_rows;
	$i=$i+1;
	if(file_exists(pathinfo($_FILES["qfile"]["name"],PATHINFO_DIRNAME))){$Question=$i.".Question.".get_ext("qfile");FileUpload("qfile",$Question);}else{$Question=$_POST["question"];}
	$Topic=$_POST["topic"];
	if($qtyp=="Single_Correct_Type"){
		if(file_exists(pathinfo($_FILES["ofileA"]["name"],PATHINFO_DIRNAME))){$Option_A=$i.".Option_A.".get_ext("ofileA");FileUpload("ofileA",$Option_A);}else{$Option_A=$_POST["optionA"];}
		if(file_exists(pathinfo($_FILES["ofileB"]["name"],PATHINFO_DIRNAME))){$Option_B=$i.".Option_B.".get_ext("ofileB");FileUpload("ofileB",$Option_B);}else{$Option_B=$_POST["optionB"];}
		if(file_exists(pathinfo($_FILES["ofileC"]["name"],PATHINFO_DIRNAME))){$Option_C=$i.".Option_C.".get_ext("ofileC");FileUpload("ofileC",$Option_C);}else{$Option_C=$_POST["optionC"];}
		if(file_exists(pathinfo($_FILES["ofileD"]["name"],PATHINFO_DIRNAME))){$Option_D=$i.".Option_D.".get_ext("ofileD");FileUpload("ofileD",$Option_D);}else{$Option_D=$_POST["optionD"];}
		$Answer=$_POST["Ans"];
			$query="insert into $qtyp values($i,'$Question','$Option_A','$Option_B','$Option_C','$Option_D','$Answer','$Topic')";
	;}
	if($qtyp=="Multiple_Correct_Type"){
		if(file_exists(pathinfo($_FILES["ofileA"]["name"],PATHINFO_DIRNAME))){$Option_A=$i.".Option_A.".get_ext("ofileA");FileUpload("ofileA",$Option_A);}else{$Option_A=$_POST["optionA"];}
		if(file_exists(pathinfo($_FILES["ofileB"]["name"],PATHINFO_DIRNAME))){$Option_B=$i.".Option_B.".get_ext("ofileB");FileUpload("ofileB",$Option_B);}else{$Option_B=$_POST["optionB"];}
		if(file_exists(pathinfo($_FILES["ofileC"]["name"],PATHINFO_DIRNAME))){$Option_C=$i.".Option_C.".get_ext("ofileC");FileUpload("ofileC",$Option_C);}else{$Option_C=$_POST["optionC"];}
		if(file_exists(pathinfo($_FILES["ofileD"]["name"],PATHINFO_DIRNAME))){$Option_D=$i.".Option_D.".get_ext("ofileD");FileUpload("ofileD",$Option_D);}else{$Option_D=$_POST["optionD"];}
		$Answer="";
		if(isset($_POST["AnsA"]))$Answer=$Answer.$_POST["AnsA"]." ";
		if(isset($_POST["AnsB"]))$Answer=$Answer.$_POST["AnsB"]." ";
		if(isset($_POST["AnsC"]))$Answer=$Answer.$_POST["AnsC"]." ";
		if(isset($_POST["AnsD"]))$Answer=$Answer.$_POST["AnsD"]." ";
			$query="insert into $qtyp values($i,'$Question','$Option_A','$Option_B','$Option_C','$Option_D','$Answer','$Topic')";
	;}
	if($qtyp=="Integer_Type" or $qtyp=="True_False_Type"){
		$Answer=$_POST["Ans"];
			$query="insert into $qtyp values($i,'$Question','$Answer','$Topic')";
	}
	if($conn->query($query))
		echo "Question Submitted Successfully";
	else
		echo "Error in Submitting Question ".$conn->error;
}
?>
</center>
</body>
</html>