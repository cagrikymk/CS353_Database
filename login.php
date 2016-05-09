<?php
include("configdb.php");
session_start();   //starting the session for user profile page
$error = 0;
function SignIn()
{
$ID = strtolower($_POST['user']);
$Password = strtolower($_POST['pass']);
if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{
	$query = mysql_query("SELECT *  FROM student where  lower(sname) = '$ID' AND lower(sid) = '$Password'");
	$row = mysql_fetch_array($query);
	if(!empty($row['sname']) AND !empty($row['sid']))
	{
		
		$_SESSION['user_name'] = $row['sname'];
		$_SESSION['user_id'] = $row['sid'];
		header("location: welcome.php");
		$error = 0;
		

	}
	else
	{
		$_SESSION['errors'] = array("Your username or password was incorrect.");
		header("Location:index.php");
	}
}
}
 if($_SERVER["REQUEST_METHOD"] == "POST") 
{
	SignIn();
}
mysql_close($con);
?>

<html>
<head>
<title>Sign-In</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="body-color">
<script type="text/javascript">
function validateForm()
{
	var a=document.forms["LoginForm"]["user"].value;
	var b=document.forms["LoginForm"]["pass"].value;
	if (a=="" || b==""){
	  alert("Please Fill All Required Field");
	  return false;
	}
	return true;
}
</script>
<div id="main">

<fieldset ><legend>LOG-IN INTERNSHIP SYSTEM</legend>
<form name="LoginForm" method="POST"  action="">
User <br>
<input id="user" type="text" name="user" size="40"><br>
Password 
<br><input id = "pass" type="password" name="pass" size="40"><br>
<input id="button" type="submit" onclick="return validateForm();" name="submit" value="Log-In">
<?php if (isset($_SESSION['errors'])):  ?>
    <div class="form-errors">
        <?php foreach($_SESSION['errors'] as $error): ?>
            <p><?php echo $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</form>
</fieldset>
</div>

</body>
</html> 
