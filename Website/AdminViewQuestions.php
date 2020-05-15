<html>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
select{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
th{font-family:Calibri;font-size:23pt;text-align:center}
td{font-family:Calibri;font-size:22pt;text-align:center}
</style>
<body bgcolor="#B3D5F2"><center>
<form method=post>
<?php
session_start();
if(!isset($_SESSION["AdminLogin"]))
	echo "You are not Authorized to Access the website.";
elseif($_SESSION["AdminLogin"]=="true"){
$_SESSION["TotalQuestions"]=0;
echo "
Choose the Subject - <select name='subject'>
<option value='Physics'>Physics</option>
<option value='Chemistry'>Chemistry</option>
<option value='Mathematics'>Mathematics</option>
</select>
<br>
Choose the type of Question - <select name='qtyp'>
<option value='Single_Correct_Type'>Single Correct Type</option>
<option value='Multiple_Correct_Type'>Multiple Correct Type</option>
<option value='Integer_Type'>Integer Answer Type</option>
<option value='True_False_Type'>True-False Type</option>
</select>
<br>
<input type='submit' style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White' value='Proceed' name='bt'>
<br>";
}
if(isset($_POST["bt"])){
	$qtyp=$_POST["qtyp"];$subject=$_POST["subject"];
	$_SESSION["subject"]=$subject;$_SESSION["qtyp"]=$qtyp;
		if(!isset($qtyp) or !isset($subject))
			die("Please Select all the Fields");
	$conn=new mysqli("localhost","root","","$subject");
		$q="select * from $qtyp";
		$select=$conn->query($q);
		$_SESSION["totalq"]=$select->num_rows;
		if($select->num_rows>0){
			$TotalQuestions=$select->num_rows;
			echo "Subject - $subject &nbsp&nbsp Type - $qtyp<br>Total Questions - $TotalQuestions<br>
				 <table width=100%><tr><th>Question Number</th><th>Question</th></tr>";
				while($row=$select->fetch_assoc()){
					$i=$row["QNum"];
					if(!file_exists("Uploads/Questions/$subject/$qtyp/".$row["Question"]))
						echo "<tr><td><input type=submit value=$i name=$i></td><td>".$row["Question"]."</td></tr>";
					else{
						echo "<tr><td><input type=submit value=$i name=$i></td><td><img src='Uploads/Questions/$subject/$qtyp/".$row["Question"]."'></td></tr>";
					}
				}
			echo "</table>";	
	}
		else
			echo "0 Questions Available";
}
if(isset($_SESSION["totalq"])){
for($i=1;$i<=$_SESSION["totalq"];$i++)
	if(isset($_POST["$i"])){
		$_SESSION["qnum"]=$i;
		echo "<script language=javascript>window.open('AdminViewQuestion.php','_blank','width=1600,height=800');</script>";
	}
}
?>
</form>
</center>
</body>
</html>