<?php
	include('configdb.php');
	include('session.php');

	$event_id=$_GET["event_id"];
	$result = FALSE;
	$result = mysql_query("DELETE FROM participate WHERE event_id ='".$event_id."' AND user_id = '".$user_id."'");
	
	if($result == TRUE) {
		echo "Cancellation is succesfull!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>