<html>
<head>
<title>Sign Up</title>
<style>
.error{
	color:red;
}
</style>
<head>
<?php
$nameerr = $emailerr = $contacterr = $pass2err = $gendererr =  "";
$name = $email = $contact = $pass2 = $pass1 = $gender =  "";
$pass1err = "";
$error = 0;
$con = mysql_connect('localhost:3306','root','root');
mysql_select_db('quiz');
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
	//Name
	if(empty($_POST['name']))
	{
		$nameerr = "Name is required";
	}
	else
	{
		$name = test_input($_POST["name"]);
	}
	if(!preg_match("/^[a-zA-Z ]*$/",$name)&&strlen($name)>0){
	 $nameerr = "Only letters and white space allowed";
	}
	
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
	
	
	//Contact
	if(empty($_POST['contact']))
	{
		$contacterr = "Contact is required";
	}
	else
	{
		$contact = test_input($_POST["contact"]);
	}
	if(!is_numeric($contact)&&strlen($contact)>0){
	 $contacterr = "Only digits allowed";
	}
	else
	{
		if(!(strlen($contact)==10)&&strlen($contact)>0)
		{
			$contacterr = "Enter 10 digits";
		}
	}
	
	
	
	//Gender
	if(empty($_POST["gender"]))
	{
		$gendererr = "Gender is required";
	}
	else{
	    $gender = test_input($_POST["gender"]);
	}
	
	
	//Password1
	if(empty($_POST["pass1"]))
	{
		$pass1err = "Password is Required";
	}
	else{
		$pass1 = test_input($_POST["pass1"]);
	}
	if(strlen($pass1)<8)
	{
		$pass1err = "Minimum 8 characters required"; 
	}
	
	//Password2
	if(empty($_POST["pass2"]))
	{
		$pass2err = "Password is Required";
	}
	else{
		$pass2 = test_input($_POST["pass2"]);
	}
	if($pass1!=$pass2)
	{
		$pass2err = "Passwords do not match"; 
	}
	
	
	//database inserion
	if(empty($nameerr)&&empty($emailerr)&&empty($gendererr)&&empty($contacterr)&&empty($pass1err)&&empty($pass2err)&&empty($error))
	{
		$que = mysql_query("select email from users where email = '$email'");
	$cou = mysql_num_rows($que);
	if($cou!=0)
	{
		$error=1;
	}
	if(empty($error))
	{
	$sql = "insert into users(name,email,contact,gender,password) values('$name','$email','$contact','$gender',md5('$pass1'))";
	$retval = mysql_query($sql,$con);
	if($retval)
	{
		header('Location:login.php');
	}
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

<body>
<div>
<h2>Sign Up</h2>
<?php
if($error)
{
?>
<span class = "error"><?php echo "E-mail is already registered"; ?></span><br><br>
<?php
}
?>
<form method="post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
Name : <input type="text" name="name"><span class="error">*<?php echo $nameerr; ?></span><br><br>
E-mail : <input type="text" name="email"><span class="error">*<?php echo $emailerr; ?></span><br><br>
Contact Number: <input type="text" name="contact"><span class="error">*<?php echo $contacterr; ?></span><br><br>
Password : <input type="password" name="pass1" placeholder = "Length greater than 7"><span class="error">*<?php echo $pass1err; ?></span><br><br>
Re-enter Password : <input type="password" name="pass2"><span class="error">*<?php echo $pass2err; ?></span><br><br>
Gender : <input type="radio" name="gender" value="male">Male
<input type="radio" name="gender" value="female">Female <span class="error">*<?php echo $gendererr; ?></span><br><br>
<input type="submit" value="Sign Up">
<br>
</form>
<p><a href = "login.php">Log in</a></p>
</div>
</body>
</html>