<?php
	include('configdb.php');
	include('session.php');

	$auth_id=$_GET["auth_id"];
	$pub_id=$_GET["pub_id"];
	$event_id = $_GET["event_id"];
	$result = FALSE;
	$sql1 = "INSERT INTO submit VALUES ('".$auth_id."', '" .$pub_id. "', '" .$event_id. "', '" .date("Y-m-d"). "' );";
	$result = mysql_query($sql1, $con);
	
	if($result == TRUE) {
		echo "Author is added!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>