<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
	session_start();
	date_default_timezone_set("Asia/Calcutta");
	header("Refresh:1");
		$_SESSION["End_Time"]=$_SESSION["Start_Time"]+$_SESSION["Time_Of_Paper"];
		$_SESSION["Current_Time"]=time();
		$_SESSION["Time_Left"]=$_SESSION["End_Time"]-$_SESSION["Current_Time"];
		$TotalSeconds_Left=$_SESSION["Time_Left"];
		$Hours_Left=floor($TotalSeconds_Left/3600);
		if($Hours_Left<10)
			$Hours_Left="0".$Hours_Left;
		$LeftSeconds_Left=($TotalSeconds_Left%3600);
		$Minutes_Left=floor($LeftSeconds_Left/60);
		if($Minutes_Left<10)
			$Minutes_Left="0".$Minutes_Left;
		$Seconds_Left=($LeftSeconds_Left%60);
		if($Seconds_Left<10)
			$Seconds_Left="0".$Seconds_Left;
		echo "$Hours_Left:$Minutes_Left:$Seconds_Left";
		if($_SESSION["Time_Left"]=="0"){
				echo "<script language=javascript>";
				$_SESSION["TimeMethod"]="End";
				echo "window.open('StudentPaper.php','_parent')";
				echo "</script>";
		}
?>
</center>
</body>
</html>