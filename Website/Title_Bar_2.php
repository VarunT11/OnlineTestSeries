<html>
<head>
<style type="text/css">
td{font-family:'Calibri';font-size:28pt;color:Black;text-align:center}
a{border-radius:5pt;border-style:ridge;border-color:Black;font-family:'Tempus Sans ITC';font-size:28pt;background-color:Green;color:White;text-decoration:none}
a:hover{border-style:outset;border-color:Green}
</style>
<script language=javascript>
function Refresh()
{
window.open("http://localhost/PHP/Test/Home_Page.php","_parent")
}
</script>
</head>
<body bgcolor="#44B0F4">
<?php
session_start();
if(!isset($_SESSION["StudentLogin"]) or $_SESSION["StudentLogin"]=="False")
{
	echo "<table cellpadding=3pt width=100% align=center>";
	echo "<tr><td><a href='Student_Login.php' target='Main_Target'>LOG IN</a></td><td><a href='StudentNewAccount.php' target='Main_Target'>SIGN UP</a></td></tr>";
	echo "<tr><td colspan=2><a href='Admin_Login.php' target='Main_Target'>ADMIN LOGIN</a></td></tr>";
	echo "</table>";
}
if(isset($_SESSION["StudentLogin"]) and $_SESSION["StudentLogin"]=="True")
{
	echo "<table width=100% style='border-radius:5pt;border-style:Outset;border-color:Black;background-color:#B3C1DF'>";
	echo "<tr><td>Hello ".$_SESSION["StudentName"]."</td><td rowspan=2><img src='".$_SESSION["StudentPhoto"]."' height='100pt' width='80pt' border=Black></td></tr><tr><td><a onclick='Refresh()' href='LogOutSuccess.php' target='Main_Target'>LOG OUT</a></td></tr>";
	echo "</table>";
}
?>
</body>
</html>