<?php
	include('configdb.php');
	include('session.php');

	$inst_id=$_GET["inst_id"];
	$result = FALSE;
	$result = mysql_query("DELETE FROM memberof WHERE institution_id ='".$inst_id."' AND researcher_id = '".$user_id."'");
	
	if($result == TRUE) {
		echo "Cancellation is succesfull!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>