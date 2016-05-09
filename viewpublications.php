<?php
	 include('session.php');
	include('configdb.php');
	$empty = true;
	$rows = 0;
	$sql1 = "SELECT * FROM publication NATURAL JOIN submit WHERE user_id = '".$user_id. "';";
   $publications = mysql_query($sql1, $con);
   $rows = 15 + mysql_num_rows($publications) * 10;
	if (isset($_POST["search_keyword"])) {
		$keyword = strtolower($_POST['search_keyword']); 
		if(!empty($_POST['search_keyword'])) {
		   $sql1 = "SELECT * FROM publication NATURAL JOIN submit WHERE user_id = '".$user_id. "' AND lower(subject) LIKE '%" .$keyword. "%';";
		   $publications = mysql_query($sql1, $con);
		   if($publications != NULL) {
			   $rows = 15 + mysql_num_rows($publications) * 10;
			  $empty = false;
		   }
		   else {
			  $rows = 0;
			  $empty = true;
		   }

		}
		else {
			$empty = false;
			$sql1 = "SELECT * FROM publication NATURAL JOIN submit WHERE user_id = '".$user_id. "';";
		   $publications = mysql_query($sql1, $con);
		   $rows = 15 + mysql_num_rows($publications) * 10;
		}	
	}

		  
   mysql_close($con); 
 
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
	function request(auth_id, reason){
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
			
			xmlhttp.open("GET", "" + reason + ".php?auth_id="+auth_id,true);
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
	   echo "<li><a href='#'><span>Search Publication</span></a></li>";
	   echo "<li><a href='sendpublication.php'><span>Send Publication</span></a></li>";
	   echo "<li class='active'><a href='viewpublications.php'><span>View Your Publications</span></a></li>";
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
<form name="SearchForm" method="POST"  action="">
Subject: <br>
<input id="search_keyword" type="text" name="search_keyword" size="40"><br> 
<input id="button" type="submit" name="submit" value="Search">

<h1>Publications:</h1> 
<?php 

echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Title</th>
	<th>Date</th>
	<th>Subject</th>
	<th>Status</th>
	<th>Feedbacks</th>
	</tr>';
	//if( $empty == false) {
		while($pups = mysql_fetch_array($publications)) {
			echo "<tr>";
			echo "<td>" . $pups['title']. "</td>";
			echo "<td>" . $pups['publication_date'] . "</td>";
			echo "<td>" . $pups['subject'] . "</td>";
			echo "<td>" . $pups['status'] . "</td>";
			echo "<td><a href=\"feedbacks.php?cid=".$pups['publication_id']."\">Feedbacks</a></td>";
			echo "</tr>";
		}		
	//}

echo "</table>
	</div>"
?>



</body>
<html>
