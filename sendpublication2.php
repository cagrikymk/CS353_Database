<?php

	include('session.php');
	include('configdb.php');
	$publication_id = 0;
	$event_id; 
	$title; $subject; $event_name;
   	if (isset($_POST["title"]) AND isset($_POST["subject"]) ) {
		$title = $_POST['title']; 
		$subject = $_POST['subject']; 
		$type = $_POST['paper_type'];
		$event_id = $_POST['event_id'];
		$sql1 = "SELECT name FROM event WHERE event_id = '" .$event_id. "'";
		$res = mysql_query($sql1, $con);
		$res1 = mysql_fetch_array($res);
		$event_name = $res1['name'];
		
		if(!empty($_POST['title']) AND !empty($_POST['subject'])) {
			   $sql1 = "INSERT INTO publication(publication_date, subject, title, type, status) VALUES ('" .date("Y-m-d"). "', '".$subject."', '".$title. "', '".$type. "', 'on submit')";
			   $result = mysql_query($sql1, $con);
				if($result == TRUE) {
					$sql1 = "SELECT publication_id FROM publication WHERE subject = '" .$subject. "' AND title = '" .$title. "'";
					$res = mysql_query($sql1, $con);
					$res1 = mysql_fetch_array($res);
					$publication_id = $res1['publication_id'];
					$sql1 = "INSERT INTO submit VALUES ('".$user_id."', '" .$publication_id. "', '" .$event_id. "', '" .date("Y-m-d"). "' );";
					$result = mysql_query($sql1, $con);
					$added = true;
					header("Location: sendpublication3.php?pub_id=" . $publication_id . "&event_name=". $event_name. "&event_id=". $event_id);
					if($result == FALSE) {
						echo "There is an error!";
					}
				}		
				else
					echo "There is an error!";			   
		  
		}
	}
	
?>
