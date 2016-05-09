<script>
	$(document).ready(function(){
		alert("sas");
		$('#button').trigger('click');
	});

</script>

<?php
	include('configdb.php');
	include('session.php');

	$event_id=$_GET["event_id"];
	$publication_id=($_POST['publication_id']);
	$reviewer_id=($_POST['reviewer_id']);
	$sql1 = "SELECT publication_id FROM assignpaper WHERE editor_id ='".$user_id."' AND publication_id = '".$publication_id."';";
	$result1 = mysql_query($sql1, $con);
	$row = mysql_fetch_array($result1);
	
	if(empty($row['publication_id'])) {
		$result = FALSE;
		$sql1 = "INSERT INTO assignpaper VALUES('".$user_id."', '".$reviewer_id."', '".$publication_id."');";
		$result = mysql_query($sql1, $con);
		
		if($result == TRUE) {
			$sql1 = "UPDATE publication SET status = 'on review' WHERE publication_id = '".$publication_id."' ;";
			$result = mysql_query($sql1, $con);
			echo "Paper is assigned!";	
		}		
		else
			echo "There is an error0!";
	}
	else {
		$sql1 = "UPDATE assignpaper SET reviewer_id = '".$reviewer_id."' WHERE publication_id = '".$publication_id."';";
		$result = mysql_query($sql1, $con);;
		
		if($result == TRUE) {
			echo "Paper is assigned to another reviewer!";	
		}		
		else
			echo "There is an error1!";		
	}
	mysql_close($con);
echo "<form name='myform' method='POST'  action='assignpaper1.php'>";

	echo "<input id='event_id' hidden readonly type='text' value='".$event_id."' name='event_id' size='40'>";
	echo "<input id='button' type='submit' name='submit' value='GO BACK'>";
	echo "</form>";

?>