<html>
<head>
<style type="text/css">
body{font-family:Calibri;font-size:25pt}
td{font-family:Calibri;font-size:22pt;text-align:center}
</style>
</head>
<body bgcolor="#B3D5F2">
<center>
<?php
session_start();
if($_SESSION["TimeMethod"]==1)
echo "<table><tr><td>".$_SESSION["Current_Question"]."</td></tr></table>";
else
echo "QUESTION";
?>
</center>
</body>
</html>