<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
input{font-family:Calibri;font-size:22pt;background-color:Cream;border-color:Black}
table{border-radius:5pt;border=1;border-color:black;border-style:solid}
td{border-radius:5pt;font-family:Calibri;font-size:22pt;text-align:center;color:white}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
$subject=$_SESSION["subject"];
if($_SESSION["PaperMethod"]=="1")
$topic=$_SESSION["topic"];
$qtype=$_SESSION["qtype"];
$totalq=$_SESSION["totalq"];
	if($qtype=="Single_Correct_Type" or $qtype=="True_False_Type")
		$time=2*$totalq;
	if($qtype=="Multiple_Correct_Type")
		$time=4*$totalq;
	if($qtype=="Integer_Type")
		$time=3*$totalq;
	$_SESSION["Time_Of_Paper"]=$time*60;
	echo "Practice Test<br>";
	echo "<table bgcolor='#1172DF' width=80%>";
	echo "<tr><td>Subject</td><td>$subject</td></tr>";
	if($_SESSION["PaperMethod"]=="1")
		echo "<tr><td>Topic</td><td>$topic</td></tr>";
	if($_SESSION["PaperMethod"]=="3"){
		$total_topic=$_SESSION["Paper_Topic_Num"];
		echo "<tr><td rowspan=$total_topic>TOPICS</td><td>".$_SESSION["1.PaperTopic"]."</td></tr>";
		for($i=2;$i<=$total_topic;$i++)
			echo "<tr><td>".$_SESSION["$i.PaperTopic"]."</td></tr>";
	}
		echo "<tr><td>Question Type</td><td>$qtype</td></tr>";
		echo "<tr><td>Number of Questions</td><td>$totalq</td></tr>";
		echo "<tr><td>Total Time</td><td>$time Minutes</td></tr>";
	echo "</table>";
	echo "<form method=post><input type=submit value='Start Test' name=bt style='background-color:#159DE4;border-type:Outset;border-color:#B9BEC4;border-size:0;font-family:".'Tempus Sans ITC'.";font-size:25pt;color:White'></form>";

	
if(isset($_POST["bt"])){
	function redirect($url){ob_start();header('Location: '.$url);ob_end_flush();}
	$conn=new mysqli("localhost","root","","$subject");
	if($_SESSION["PaperMethod"]=="1"){
		$qquery="select * from $qtype where Topic='$topic'";
	}
	if($_SESSION["PaperMethod"]=="2"){
		$qquery="select * from $qtype";
	}
	if($_SESSION["PaperMethod"]=="3"){
		$total_topics=$_SESSION["Paper_Topic_Num"];
		$topic_query="";
		$topic_query=$topic_query."Topic='".$_SESSION["1.PaperTopic"]."' ";
		for($i=2;$i<=$total_topics;$i++){
			$topic_query=$topic_query."or Topic='".$_SESSION["$i.PaperTopic"]."' ";
		}
		$len=strlen($topic_query);
		$newval="";
		for($i=0;$i<$len;$i++){
			$chr=substr($topic_query,$i,1);
			if($chr=="_")
				$newval=$newval." ";
			else
				$newval=$newval.$chr;
		}
		$topic_query=$newval;
		echo $topic_query;
		$qquery="select * from $qtype where $topic_query";
	}
	$qdata=$conn->query("$qquery");
	$num_questions=$qdata->num_rows;
	$i=1;
	while($i<=$num_questions and $row=$qdata->fetch_assoc()){
		$_SESSION["Question_$i"]=$row["QNum"];
		$i++;
	}
		$filepath="Uploads/Questions/$subject/$qtype/";
	function DisplayImage($filename){
		global $filepath;
		$file=$filepath.$filename;
		if(file_exists("$file"))
			$return="<img src='".$file."'>";
		else
			$return=$filename;
		return $return;
		}
	for($i=1;$i<=$totalq;$i++){
		$_SESSION["Number_$i"]=rand(1,$num_questions);
		for($j=1;$j<$i;$j++)
			if($_SESSION["Number_$i"]===$_SESSION["Number_$j"])
				while($_SESSION["Number_$i"]===$_SESSION["Number_$j"]){
					$_SESSION["Number_$i"]=rand(1,$num_questions);}
		$num=$_SESSION["Number_$i"];
		$_SESSION["Paper_Question_$i"]=$_SESSION["Question_$num"];}
	for($i=1;$i<=$totalq;$i++){
		$question=$_SESSION["Paper_Question_$i"];
		$k=$i;
		$qdquery="select * from $qtype where QNum=$question";
		$qddata=$conn->query($qdquery);
		 while($row=$qddata->fetch_assoc()){
		 	$a=$row["Question"];$_SESSION["Question_$k"]=DisplayImage("$a");
			if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type"){
				$a=$row["Option_A"];$_SESSION["Option_A_$k"]=DisplayImage("$a");
				$a=$row["Option_B"];$_SESSION["Option_B_$k"]=DisplayImage("$a");
				$a=$row["Option_C"];$_SESSION["Option_C_$k"]=DisplayImage("$a");
				$a=$row["Option_D"];$_SESSION["Option_D_$k"]=DisplayImage("$a");
				if($qtype=="Single_Correct_Type")$_SESSION["$i.'_Answer_Correct'"]=$row["Answer"];
				if($qtype=="Multiple_Correct_Type")$_SESSION["$i.'_Answer_Correct'"]=$row["Answers"];
			}
				if($qtype=="Integer_Type" or $qtype=="True_False_Type")$_SESSION["$i.'_Answer_Correct'"]=$row["Answer"];
		}
	}
		$_SESSION["PaperStart"]="Start";
		$_SESSION["TimeMethod"]=1;
		$_SESSION["AttemptMethod"]=1;
		$_SESSION["PaperQuestionNum"]=1;
		$_SESSION["Current_Question"]=$_SESSION["Question_1"];
			if($qtype=="Single_Correct_Type" or $qtype=="Multiple_Correct_Type"){
				$_SESSION["Current_Option_A"]=$_SESSION["Option_A_1"];
				$_SESSION["Current_Option_B"]=$_SESSION["Option_B_1"];
				$_SESSION["Current_Option_C"]=$_SESSION["Option_C_1"];
				$_SESSION["Current_Option_D"]=$_SESSION["Option_D_1"];}
		$_SESSION["Start_Time"]=time();
		redirect("StudentPaper.php");
}
?>
</center>
</body>
</html>