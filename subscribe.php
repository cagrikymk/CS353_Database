<?php
	 include('session.php');
	 include('configdb.php');
	 
   $sql1 = "SELECT * FROM author natural join user natural join researcher WHERE user_id NOT IN (SELECT author_id FROM subscribe as S WHERE S.user_id ='$user_id' ) AND user_id !='$user_id' ";
   $authors = mysql_query($sql1, $con);
   $apps1 = mysql_num_rows($authors);
   $rows = 15 + mysql_num_rows($authors) * 10;
   
  $sql2 = "SELECT * FROM author natural join user natural join researcher WHERE user_id IN (SELECT author_id FROM subscribe as S WHERE S.user_id ='$user_id' ) ";
   $authors2 = mysql_query($sql2, $con);
   $apps2 = mysql_num_rows($authors2);
   $rows2 = 15 + mysql_num_rows($authors2) * 10;
   
   
   
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
   <title>Subscribe</title>
</head>
<body>

<div id='cssmenu'>
<ul>
	 <?php 
	if($usertype == "user") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
		echo "<li class='active'><a href='#'><span>Subscribe</span></a></li>";
		echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if($usertype == "author") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li class='active'><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='sendpublication.php'><span>Send Publication</span></a></li>";
	   echo "<li><a href='viewpublications.php'><span>View Your Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Join an Event</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if ($usertype == "editor"){
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li class='active'><a href='subscribe.php'><span>Subscribe</span></a></li>";
		echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='assignpaper.php'><span>Check Publications of Your Event</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else{
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li class='active'><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
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

<h1>You Can subscribe these authors:</h1> 
<?php 

echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>Subscribe</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authors)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$myauthors['user_id']."', 'subsauthor')\">Subscribe!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div>"
?>

<h1>You subscribed:</h1> 
<?php 

echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows2 .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>Subscribe</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authors2)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td><button class=\"button button1\" onclick=\"request('".$myauthors['user_id']."', 'cancelsubs')\">Cancel!</button></td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div>"
?>


</body>
<html>
