<html>
<head>
<title>Quiz 1</title>


<?php
$con = mysql_connect('localhost:3306','root','root');
mysql_select_db('quiz');
$question = mysql_query("SELECT * FROM `quizone`;");
session_start();
$error1 = $error2 = $done = 0;
if(!isset($_SESSION["name"]))
{
	$error1=1;
}
$ans1=$ans2=$ans3=$ans4=$ans5="";
if($_SERVER["REQUEST_METHOD"]=='POST')
{
	$x=$score=0;
	while($row = mysql_fetch_assoc($question))
	{
		if($row["ans"] == $_POST["a$x"])
			$score++;
		$x = $x+1;
	}
	
	$done=1;
}

?>
</head>
<body>
<div id="yo">
<a href="quizhome.php">Home</a>
<h1 style="text-align:center">Quiz 1</h1>
<a href = "logout.php">Logout</a>
<hr>

<?php
$x = $b = 0;
echo '<form action="quiz1.php", method="post">';

while ($row = mysql_fetch_assoc($question))
{
   echo ($x+1).". ". $row['que'] . '<br />';
   echo '<input type="radio" name="a'.$x.'" value=1 />' .$row['option1'] . '<br>';
   echo '<input type="radio" name="a'.$x.'" value=2 />' .$row['option2'] . '<br>';
   echo '<input type="radio" name="a'.$x.'" value=3 />' .$row['option3'] . '<br>';
   echo '<input type="radio" name="a'.$x.'" value=4 />' .$row['option4'] . '<br><br>';
   $x = $x + 1;
}
?>
<br>

<input type="submit" name="Submit" value="Submit" />
</form>

</div>
<?php 
if($error1)
{
?>
<script>
document.getElementById("yo").innerHTML = "You need to login first!";
</script> 
<?php
echo '<br><a href = "login.php">Login</a>';
}
elseif($done)
{
?>
<script>
document.getElementById("yo").innerHTML = "Your score is <?php echo "$score/5"; ?>";
</script>
<?php
}
?>
</body>
</html>