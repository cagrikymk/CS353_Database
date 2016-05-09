<?php
	include('configdb.php');
	include('session.php');

	$event_id=$_GET["event_id"];
	$result = FALSE;
	$result = mysql_query("INSERT INTO participate VALUES('".$user_id."', '".$event_id."');");
	
	if($result == TRUE) {
		echo "You joined!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>