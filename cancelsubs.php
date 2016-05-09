<?php
	include('configdb.php');
	include('session.php');

	$auth_id=$_GET["auth_id"];
	$result = FALSE;
	$result = mysql_query("DELETE FROM subscribe WHERE author_id ='".$auth_id."' AND user_id = '".$user_id."'");
	
	if($result == TRUE) {
		echo "Cancellation is succesfull!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>