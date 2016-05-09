<?php
	 include('session.php');
	 include('configdb.php');
	 
   $sql1 = "SELECT name, surname,researcher_field,education_level, sum(citation_no) as citations FROM publication_public NATURAL JOIN submit NATURAL JOIN authors_public GROUP BY name, surname,researcher_field, education_level ORDER BY citations DESC; ";
   $authorscitation = mysql_query($sql1, $con);
   $rows = 15 + mysql_num_rows($authorscitation) * 10;
   
  $sql1 = "SELECT name, surname,researcher_field,education_level, count(S.user_id) as subscribe_no FROM subscribe as S, authors_public as A WHERE S.author_id = A.user_id  GROUP BY S.author_id, name, surname,researcher_field, education_level ORDER BY subscribe_no DESC; ";
   $authorssubs = mysql_query($sql1, $con);
   $rows2 = 15 + mysql_num_rows($authorssubs) * 10;
   

   
   
   
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
   <title>Reports</title>
</head>
<body>

<div id='cssmenu'>
<ul>
	 <?php 
	if($usertype == "user") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
		echo "<li><a href='#'><span>Subscribe</span></a></li>";
		echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li class='active'><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if($usertype == "author") {
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='sendpublication.php'><span>Send Publication</span></a></li>";
	   echo "<li><a href='viewpublications.php'><span>View Your Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Join an Event</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li class='active'><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if ($usertype == "editor"){
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
		echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='assignpaper.php'><span>Check Publications of Your Event</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li class='active'><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else{
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='#'><span>Check Assigned Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li class='active'><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}

   ?>
</ul>
</div>

<h1>Authors who have been cited most:</h1> 
<?php 

echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>Citation number</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authorscitation)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td>" . $myauthors['citations'] . "</td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div>"
?>

<h1>Authors who have been subscribed most:</h1> 
<?php 

echo '<div class="CSSTableGenerator" >';
 

	echo '<table  border = 1 style="height:'. $rows2 .'px;">	  
	<tr>
	<th>Name</th>
	<th>Research Field</th>
	<th>Education Level</th>
	<th>subscribe number</th>
	</tr>';
	while($myauthors = mysql_fetch_array($authorssubs)) {
		echo "<tr>";
		echo "<td>" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		echo "<td>" . $myauthors['education_level'] . "</td>";
		echo "<td>" . $myauthors['subscribe_no'] . "</td>";
		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div>"
?>



</body>
<html>
