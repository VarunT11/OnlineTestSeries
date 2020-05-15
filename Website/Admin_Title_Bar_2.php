<html>
<head>
<style type="text/css">
td{font-family:'Calibri';font-size:23pt;color:Black;text-align:center}
a{border-radius:5pt;border-style:ridge;border-color:Black;font-family:'Tempus Sans ITC';font-size:27pt;background-color:Green;color:White;text-decoration:none}
a:hover{border-style:outset;border-color:Green;}
</style>
<script language=javascript>
function Refresh()
{
window.open("http://localhost/PHP/Test/Home_Page.php","_parent")
}
</script>
</head>
<body bgcolor="#1736F4">
<?php
session_start();
if(isset($_SESSION["AdminLogin"]) and $_SESSION["AdminLogin"]=="true")
{
	echo "<table width='100%' style='border-style:Outset;border-radius:5pt;border-color:Black;background-color:#B3C1DF'>";
	echo "<tr><td>Hello ".$_SESSION["AdminName"]."</td><td rowspan=2><img src='".$_SESSION["AdminPhoto"]."' height='100pt' width='80pt' border=Black></td></tr><tr><td><a onclick='Refresh()' href='LogOutSuccess.php' target='Main_Target'>LOG OUT</a></td></tr>";
	echo "</table>";
}
?>
</body>
</html>