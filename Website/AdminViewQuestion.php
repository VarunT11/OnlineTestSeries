<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
th{font-family:Calibri;font-size:25pt;text-align:center}
td{font-family:Calibri;font-size:22pt;text-align:center}
a{font-family:Calibri;font-size:22pt;text-decoration:none;color:Blue}
a:hover{text-decoration:underline}
</style>
<body bgcolor="#B3D5F2"><center>
<?php
session_start();
	$qtyp=$_SESSION["qtyp"];$subject=$_SESSION["subject"];$qnum=$_SESSION["qnum"];
	function display($column){
		global $row;global $subject;global $qtyp;
		if(!file_exists("Uploads/Questions/$subject/$qtyp/".$row["$column"]))
			$dis=$row["$column"];	
		else
			$dis="<img src='Uploads/Questions/$subject/$qtyp/".$row["$column"]."'>";
		return $dis;	
	}	
	$conn=new mysqli("localhost","root","","$subject");
	$q="select * from $qtyp where QNum='$qnum'";
	$select=$conn->query($q);
	if($select->num_rows==1){
		while($row=$select->fetch_assoc()){
			echo "
			Topic -".$row["Topic"]."
			<br>".display("Question");
		if($qtyp=="Single_Correct_Type" or $qtyp=="Multiple_Correct_Type"){
		echo "
		<table width=60%>
		<tr><td>A</td><td>".display("Option_A")."</td><td>B</td><td>".display("Option_B")."</tr>
		<tr><td>C</td><td>".display("Option_C")."</td><td>D</td><td>".display("Option_D")."</tr>
		</table>
		";
		}
		if($qtyp=="Multiple_Correct_Type")$suffix="s";else $suffix="";
			echo "Correct Answer - ".$row["Answer$suffix"];
			echo "<br><a href='AdminUpdateQuestion.php'>Update the Question</a>";
			echo "<br><a href='AdminDeleteQuestion.php'>Delete the Question</a>";
	}}
?>
</center>
</body>
</html>