<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
</style>
<body bgcolor="#B3D5F2"><center>
<?php
session_start();
function Update_File($Topic){
			global $qtyp;global $FilePath;global $select_2;global $i;global $new;global $conn;
				while($row=$select_2->fetch_assoc()){
				if(!file_exists("$FilePath".$row["$Topic"])){
					$file=$row["$Topic"];
					$Update_Query_2="update $qtyp set $Topic='$file' where QNum=$i";
					if(!$conn->query($Update_Query_2))
						die("Error in Updating Database<br>">$conn->error);
					}
				else{
					$file="$new.$Topic.".pathinfo("$FilePath".$row["$Topic"],PATHINFO_EXTENSION);
					$Update_Query_2="update $qtyp set $Topic='$file' where QNum=$i";
					if(!$conn->query($Update_Query_2))
						die("Error in Updating Database<br>">$conn->error);
					rename("$FilePath".$row["$Topic"],"$FilePath/$file");
				}				
		}}
if(!isset($_SESSION["AdminLogin"]))
	echo "You are not Authorized to Access the website.";
elseif($_SESSION["AdminLogin"]=="true"){
	echo "<form method=post><input type=checkbox name=cnfrm>Are You Sure that you want to Delete the Question
	<br><input type=submit value=Delete name=bt>
	</form>";
	}
if(isset($_POST["bt"])){
if(isset($_POST["cnfrm"])){
	$subject=$_SESSION["subject"];$qtyp=$_SESSION["qtyp"];$qnum=$_SESSION["qnum"];
	$conn=new mysqli("localhost","root","","$subject");
	$total_question_query="select * from $qtyp";$select_1=$conn->query($total_question_query);$totalq=$select_1->num_rows;
	$delete_query="delete from $qtyp where QNum=$qnum";
	if(!$conn->query($delete_query))
		die("Error in Deleting Question<br>".$conn->error);	
	else
		echo "Question Deleted Successfully<br>";
	
	$FilePath="Uploads/Questions/$subject/$qtyp/";		
	for($i=($qnum+1);$i<=$totalq;$i++){
	$Data_Query="select * from $qtyp where QNum=$i";
	$select_2=$conn->query($Data_Query);
	$new=$i-1;
		$Update_Query_1="update $qtyp set QNum=$new where QNum=$i";
			Update_File("Question");
		if($qtyp=="Single_Correct_Type"){
			Update_File("Option_A");
			Update_File("Option_B");
			Update_File("Option_C");
			Update_File("Option_D");
			}
		if($qtyp=="Multiple_Correct_Type"){
			Update_File("Option_A");
			Update_File("Option_B");
			Update_File("Option_C");
			Update_File("Option_D");
			}
	if(!$conn->query($Update_Query_1) or !$conn->error)
		echo "<br>Database Updated Successfully";
	else
		echo "<br>Error In Updating Database<br>".$conn->error;
	}
}
else
	echo "Please Confirm before Deleting the Question";
}	
?>
</center>
</body>
</html>