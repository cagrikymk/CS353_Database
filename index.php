<?php
include("configdb.php");
session_start();   //starting the session for user profile page
$error = 0;
$usertable = "";
function SignIn()
{
$ID = strtolower($_POST['user']);
$Password = strtolower($_POST['pass']);
if(!empty($_POST['user']))   //checking the 'user' name which is from Sign-In.html, is it empty or have some text
{

	$usertype = $_POST['usertype']; // make value
	switch ($usertype)
	{
	case 1:
	  $usertable = "author";
	  break;
	case 2:
	  $usertable = "editor";
	  break;
	case 3:
	  $usertable = "reviewer";
	  break;
	default:
	  $usertable = "user";
	}
		
	$query = mysql_query("SELECT * FROM user WHERE  lower(username) = '$ID' AND lower(password) = $Password");
	$row = mysql_fetch_array($query);
	$query2 = mysql_query("SELECT user_id FROM user NATURAL JOIN $usertable WHERE  lower(username) = '$ID' AND lower(password) = $Password");
	$row2 = mysql_fetch_array($query2);
	if(( $usertype == 0 OR !empty($row2['user_id'])) AND!empty($row['username']) AND !empty($row['password']))
	{

		$_SESSION['user_type'] = $usertable;
		$_SESSION['user_name'] = $row['username'];
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['surname'] = $row['surname'];
		header("location: welcome_" . $usertable . ".php");
		$error = 0;
		

	}
	else
	{
		$_SESSION['errors'] = array("Your username or password or user type was incorrect.");
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
<label for="User type"> User type : </label>
  <select id="user_selection" name="usertype"  >
     <option value="0">Select User type</option>
     <option value="0">Regular User</option>
     <option value="1">Author</option>
     <option value="2">Editor</option>
	  <option value="3">Reviewer</option>
</select>
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
