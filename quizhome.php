<html>
<head>
<title>Quiz Home</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["name"]))
{
	header('Location:login.php');
}
echo "Welcome ".$_SESSION["name"];
?>
<p style = "float:right"><a href="logout.php" style = "text-decoration:none"><?php echo "Log out"; ?></a></p>
<p></p>
<hr>
<br><br><br><br>
<div style = "text-align:center;">
<p><a href = "quiz1.php" style="text-decoration:none;">Quiz 1</a></p><br>
<p><a href = "quiz2.php" style="text-decoration:none;">Quiz 2</a></p><br>
<p><a href = "quiz3.php" style="text-decoration:none;">Quiz 3</a></p>
</div>
</body>
</html>