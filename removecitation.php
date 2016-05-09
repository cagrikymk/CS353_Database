<?php
	include('configdb.php');
	include('session.php');

	$citation_id=$_GET["auth_id"];
	$publication_id=$_GET["pub_id"];
	$result = FALSE;
	$result = mysql_query("DELETE FROM citation WHERE publication_id = '".$publication_id."' AND citation_id = '".$citation_id."';");
	
	if($result == TRUE) {
		echo "Citation is removed!";
	}		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>