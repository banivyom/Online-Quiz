<html><head>
<title>Log in</title>
<style>
.error
{
	color:red;
}
</style>
</head>
<body>
<?php
session_start();
$email = $pass = "";
$error=0;
$emailerr = $passerr = "";
$con = mysql_connect('localhost:3306','root','root');
mysql_select_db('quiz');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	//E-mail
	if(empty($_POST['email']))
	{
		$emailerr = "Email is required";
	}
	else
	{
		$email = test_input($_POST["email"]);
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)&&strlen($email)>0){
	 $emailerr = "Invalid email format";
	}
	
	//Password
	if(empty($_POST["pass"]))
	{
		$passerr = "Password is Required";
	}
	else{
		$pass = test_input($_POST["pass"]);
	}
	if(strlen($pass)<8)
	{
		$passerr = "Minimum 8 characters required"; 
	}
	if(empty($passerr)&&empty($emailerr))
	{
		$sql = mysql_query("select email and password from users where email = '$email' and password = md5('$pass');",$con);
		$cou = mysql_num_rows($sql);
		if($cou!=1)
		{
			$error = 1;
		}
		else{
		    $que = mysql_query("select name from users where email = '$email';",$con);
			$row = mysql_fetch_array($que);
			$_SESSION["name"] = $row["name"];
			header('Location:quizhome.php');
		}
	}
}


function test_input($x)
{
	$x = trim($x);
	$x = stripslashes($x);
	$x = htmlspecialchars($x);
	return $x;
}
?>

<h2>Log In</h2>
<?php
if($error)
{
?>
<span class = "error"><?php echo "Invalid email or password" ;?></span><br><br>
<?php
}
?>
<form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
E-mail : <input type="text" name="email"><span class="error"><?php echo $emailerr; ?></span><br><br>
Password : <input type="password" name="pass"><span class="error"><?php echo $passerr; ?></span><br><br>
<input type="submit" value = "Log in">
</form>
<a href="signup.php">Sign Up</a>
</body>
</html>