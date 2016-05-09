<?php
	include('configdb.php');
	include('session.php');

	$auth_id=$_GET["auth_id"];
	$result = FALSE;
	$result = mysql_query("INSERT INTO subscribe VALUES('".$user_id."', '".$auth_id."');");
	
	if($result == TRUE) {
		echo "Application is succesfull!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>