<?php

	include('configdb.php');
	include('session.php');
	$publication_id=$_GET["pub_id"];
	$title; $subject; 
	$event_name = $_GET["event_name"];
	$event_id = $_GET["event_id"];
	$sql1 = "SELECT * FROM publication WHERE publication_id = '" .$publication_id. "'";
	$pub = mysql_query($sql1, $con);
	$mypub = mysql_fetch_array($pub)

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
	   echo "<li class='active'><a href='#'><span>Search Publication</span></a></li>";
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
<h2>Title: <?php echo $mypub['title']; ?></h2>
<h2>Subject: <?php echo $mypub['subject']; ?></h2>
<h2>Event Name: <?php echo $event_name; ?></h2>


 

 
<?php 
	$sql1 = "SELECT * FROM author NATURAL JOIN user NATURAL JOIN researcher WHERE user_id NOT IN (SELECT user_id FROM author NATURAL JOIN submit WHERE publication_id = '" .$publication_id. "')";
	$authors = mysql_query($sql1, $con);
	$rows = 15 + mysql_num_rows($authors) * 10;
	
	echo '<table>  
	<tr>
	<th></th>
	<th></th>
	</tr>';
	echo "<tr><td><h1>Add authors to this publication:</h1>";
	echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>Add</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authors)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$myauthors['user_id']."', '".$publication_id. "', '".$event_id. "', 'addauthortopub')\">Add!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div></td>";
	
	$sql1 = "SELECT * FROM publication WHERE publication_id NOT IN (SELECT citation_id FROM citation WHERE publication_id = '" .$publication_id. "')";
	$pubs = mysql_query($sql1, $con);
	$rows = 15 + mysql_num_rows($pubs) * 10;
	echo "<td><h1>Add citation to this publication:</h1>";
	echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Title</th>
	<th>Subject</th>
	<th>Add</th>
	</tr>';
	while($mypubs = mysql_fetch_array($pubs)) {
		echo "<tr>";
		echo "<td>" . $mypubs['title']. "</td>";
		echo "<td>" . $mypubs['subject'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$mypubs['publication_id']."', '".$publication_id. "', '-', 'addcitation')\">Add!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div></td></tr>";
	

?>

<?php 
	$sql1 = "SELECT * FROM author NATURAL JOIN user NATURAL JOIN researcher WHERE user_id IN (SELECT user_id FROM author NATURAL JOIN submit WHERE publication_id = '" .$publication_id. "')";
	$authors = mysql_query($sql1, $con);
	$rows = 15 + mysql_num_rows($authors) * 10;
	
	echo '<table>  
	<tr>
	<th></th>
	<th></th>
	</tr>';
	echo "<tr><td><h1>Authors of publication:</h1>";
	echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>Remove</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authors)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$myauthors['user_id']."', '".$publication_id. "', '".$event_id. "', 'removeauthortopub')\">Remove!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div></td>";
	
	$sql1 = "SELECT * FROM publication WHERE publication_id IN (SELECT citation_id FROM citation WHERE publication_id = '" .$publication_id. "')";
	$pubs = mysql_query($sql1, $con);
	$rows = 15 + mysql_num_rows($pubs) * 10;
	echo "<td><h1>Citations of publication:</h1>";
	echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Title</th>
	<th>Subject</th>
	<th>Remove</th>
	</tr>';
	while($mypubs = mysql_fetch_array($pubs)) {
		echo "<tr>";
		echo "<td>" . $mypubs['title']. "</td>";
		echo "<td>" . $mypubs['subject'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$mypubs['publication_id']."', '".$publication_id. "', '-', 'removecitation')\">Remove!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div></td></tr>";
	

mysql_close($con); 

?>



</body>
<html>
