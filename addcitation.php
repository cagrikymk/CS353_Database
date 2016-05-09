<?php
	include('configdb.php');
	include('session.php');

	$citation_id=$_GET["auth_id"];
	$publication_id=$_GET["pub_id"];
	$result = FALSE;
	$result = mysql_query("INSERT INTO citation VALUES('".$publication_id."', '".$citation_id."');");
	
	if($result == TRUE) {
		echo "Citation is added!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>