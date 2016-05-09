<?php
	include('configdb.php');
	include('session.php');

	$inst_id=$_GET["inst_id"];
	$result = FALSE;
	$result = mysql_query("INSERT INTO memberof VALUES('".$user_id."', '".$inst_id."');");
	
	if($result == TRUE) {
		echo "You joined!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>