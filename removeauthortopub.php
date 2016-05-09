<?php
	include('configdb.php');
	include('session.php');

	$auth_id=$_GET["auth_id"];
	$pub_id=$_GET["pub_id"];
	$event_id = $_GET["event_id"];
	$result = FALSE;
	$sql1 = "DELETE FROM submit WHERE user_id = '".$auth_id."' AND publication_id = '" .$pub_id. "' AND event_id ='" .$event_id. "';";
	$result = mysql_query($sql1, $con);
	
	if($result == TRUE) {
		echo "Author is deleted!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>