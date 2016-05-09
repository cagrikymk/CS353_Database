<?php
	include('configdb.php');
	include('session.php');

	$cid=$_GET["cid"];
	$result = FALSE;
	$result1 = mysql_query("SELECT * FROM company WHERE quota > 0 AND cid = '".$cid."';");
	if(mysql_num_rows($result1) != 0)
		$result = mysql_query("INSERT INTO apply VALUES('".$user_id."', '".$cid."');");
	
	if($result == TRUE) {
		mysql_query("UPDATE company SET quota = quota - 1 WHERE cid = '".$cid."';");
		echo "Application is succesfull!";
	}
		
	else
		echo "There is an error!";
	mysql_close($con);
	//header("Location: welcome.php");
?>
