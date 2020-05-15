<html>
<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
select{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
</style>
<body bgcolor="#B3D5F2"><center>
<?php
session_start();
if(!isset($_SESSION["AdminLogin"]))
	echo "You are not Authorized to Access the website.";
elseif($_SESSION["AdminLogin"]=="true"){
	$subject=$_SESSION["subject"];$qtyp=$_SESSION["qtyp"];$qnum=$_SESSION["qnum"];
	$_SESSION["FileUpload_Path"]="Uploads/Questions/$subject/$qtyp/";
	if($qtyp=="Single_Correct_Type")
		$option="<option value='Question'>Question</option>
		<option value='Option_A'>Option A</option>
		<option value='Option_B'>Option B</option>
		<option value='Option_C'>Option C</option>
		<option value='Option_D'>Option D</option>
		<option value='Topic'>Topic</option><option value='Answer'>Answer</option>";
	if($qtyp=="Multiple_Correct_Type")
		$option="<option value='Question'>Question</option>
		<option value='Option_A'>Option A</option>
		<option value='Option_B'>Option B</option>
		<option value='Option_C'>Option C</option>
		<option value='Option_D'>Option D</option>
		<option value='Topic'>Topic</option><option value='Answers'>Answers</option>";

	if($qtyp=="Integer_Type")
		$option="<option value='Question'>Question</option>
		<option value='Topic'>Topic</option><option value='Answer'>Answer</option>";	
	if($qtyp=="True_False_Type")
		$option="<option value='Question'>Question</option>
		<option value='Topic'>Topic</option><option value='Answer'>Answer</option>";	
		
		echo "<form method=post enctype='multipart/form-data'>";
		echo "Choose the Field that you want to Update - <select name='fld'>$option</select>";
		echo "<br><input type='submit' style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Proceed' name='bt'></form>";
		
		
if(isset($_POST["bt"]) or isset($_POST["bt2"])){
			$fld=$_POST["fld"];
			$_SESSION["fld"]=$fld;

			if($fld=="Question" || $fld=="Option_A" || $fld=="Option_B" || $fld=="Option_C" || $fld=="Option_D" || $fld=="Option_P" || $fld=="Option_Q" || $fld=="Option_R" || $fld=="Option_S" || $fld=="Option_T"){
				echo "<form method=post enctype='multipart/form-data'>";
				echo "Enter the Field Value - <input type='text' name='fldval'> <br>OR<br> Choose the file - <input type='file' name='fldfile'>";
				echo "<br><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Update Question' name='bt1'></form>";}
			if($fld=="Topic")
			{	echo "<form method=post enctype='multipart/form-data'>";
				echo "Enter the Field Value - <input type='text' name='fldval'>";
				echo "<br><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Update Question' name='bt1'></form>";
			}
			if($fld=="Answer")
			{	echo "<form method=post enctype='multipart/form-data'>";
				if($qtyp=="Single_Correct_Type")
					echo "CORRECT ANSWER - Option A<input type=radio name='fldval' value='A'>
								Option B<input type=radio name='fldval' value='B'>
								Option C<input type=radio name='fldval' value='C'>
								Option D<input type=radio name='fldval' value='D'><br>";
				if($qtyp=="Integer_Type")
					echo "CORRECT ANSWER - <input type=text name=fldval>";
				if($qtyp=="True_False_Type")
					echo "CORRECT ANSWER - True<input type=radio name='fldval' value='true'>
								False<input type=radio name='fldval' value='false'>";
				echo "<br><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Update Question' name='bt1'></form>";
			}
			if($fld=="Answers")
			{
				echo "<form method=post enctype='multipart/form-data'>";
				if($qtyp=="Multiple_Correct_Type")
					echo "CORRECT ANSWERS - Option A<input type=checkbox name='fldvalA' value='fldvalA'>
								Option B<input type=checkbox name='fldvalB' value='fldvalB'>
								Option C<input type=checkbox name='fldvalC' value='fldvalC'>
								Option D<input type=checkbox name='fldvalD' value='fldvalD'><br>";
				echo "<br><input type=submit style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Update Question' name='bt1'></form>";
			}
		}
		if(isset($_POST["bt1"])){
			$fld=$_SESSION["fld"];
			function get_ext($file){
				$ext=pathinfo($_FILES["$file"]["name"],PATHINFO_EXTENSION);
				return $ext;}
			function FileUpload($file,$name){
				$path=$_SESSION["FileUpload_Path"]."$name";
				move_uploaded_file($_FILES["$file"]["tmp_name"],$path);}
			$conn=new mysqli("localhost","root","","$subject");
			$Value="";

			if($fld=="Question" OR $fld=="Option_A" OR $fld=="Option_B" OR $fld=="Option_C" OR $fld=="Option_D" OR $fld=="Option_P" OR $fld=="Option_Q" OR $fld=="Option_R" OR $fld=="Option_S" OR $fld=="Option_t"){
				if(file_exists(pathinfo($_FILES["fldfile"]["name"],PATHINFO_DIRNAME))){$Value=$qnum.".$fld.".get_ext("fldfile");FileUpload("fldfile",$Value);}else{$Value=$_POST["fldval"];}
				}
				
			if($fld=="Topic" || $fld=="Answer"){$Value=$_POST["fldval"];}
			if($fld=="Answers"){
				if($qtyp=="Multiple_Correct_Type"){
					if(isset($_POST["fldvalA"]))$Value=$Value.$_POST["fldvalA"]." ";
					if(isset($_POST["fldvalB"]))$Value=$Value.$_POST["fldvalB"]." ";
					if(isset($_POST["fldvalC"]))$Value=$Value.$_POST["fldvalC"]." ";
					if(isset($_POST["fldvalD"]))$Value=$Value.$_POST["fldvalD"]." ";
				}
			}

			else
				$q="UPDATE `$qtyp` SET $fld='$Value' WHERE `$qtyp`.`QNum` = $qnum";
			
			if($conn->query($q))
				echo "Question Updated Successfully";
			else
				echo "Error in Updating Question<br>".$conn->error;
			$conn->close();
		}
}
	
?>
</center>
</body>
</html>