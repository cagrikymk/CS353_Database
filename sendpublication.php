<?php

	include('session.php');
	include('configdb.php');
	$pupCreated = false;		
	$sql1 = "SELECT * FROM event";
	$events = mysql_query($sql1, $con);
	$publication_id;
	$event_id;
?>
<!doctype html>
<html lang=''>
<head>

   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" type="text/css" href="tablecsscode.css">
   <link rel="stylesheet" href="styles.css">

   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <script type="text/javascript">
	function request(auth_id,publication_id,event_id, reason){
			if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
			else{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");  // code for IE6, IE5
			}
			xmlhttp.onreadystatechange = function() {
			    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				window.location.reload();
				alert(xmlhttp.responseText);
			    }
			};
			xmlhttp.open("GET", "" + reason + ".php?auth_id="+auth_id+ "&pub_id=" + publication_id+ "&event_id=" + event_id,true);
			xmlhttp.send();
	}
	function goBack() {
     		window.location="welcome.php";
	}
</script>
   <title>Search Publication</title>
</head>
<body>

<div id='cssmenu'>
<ul>
	 <?php 
	if($usertype == "user") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
		echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
		echo "<li class='active'><a href='#'><span>Search Publication</span></a></li>";
		echo "<li class='last'><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
		echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if($usertype == "author") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li class='active'><a href='sendpublication.php'><span>Send Publication</span></a></li>";
	   echo "<li><a href='viewpublications.php'><span>View Your Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Join an Event</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if ($usertype == "editor"){
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
		echo "<li class='active'><a href='#'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='#'><span>Check Publications of Your Event</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else{
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='#'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='#'><span>Check Assigned Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}

   ?>
</ul>
</div>
<form name="submitPublicationForm" method="POST"  action="sendpublication2.php">
Title: <br> <br>
<input id="title" type="text" name="title" size="40"><br> 
Subject: <br> <br>
<input id="subject" type="text" name="subject" size="40"><br> 
<label for="Publication type"> Publication Type: </label>
  <select id="paper_type" name="paper_type"  >
     <option value="0">Technical Report</option>
     <option value="1">Conference Paper</option>
</select> <br>
<label for="Event"> Select Event: </label>
  <select id="event_id" name="event_id" >
  <?php
	while($myevent = mysql_fetch_array($events)) {
	  echo "<option value='".$myevent['event_id']."'>".$myevent['name']."</option>";
	}
  ?>
</select> <br> 
<input id="button" type="submit" name="submit" value="Create Publication">

 
<?php 
mysql_close($con); 

?>



</body>
<html>
