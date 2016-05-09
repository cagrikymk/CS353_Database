<?php
	 include('session.php');
	 include('configdb.php');
	 
   $sql1 = "SELECT * FROM event NATURAL JOIN participate  WHERE user_id = '$user_id'";
   $events = mysql_query($sql1, $con);
   $event_id = $_POST['event_id'] OR $_GET["event_id"];
?>
<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>

   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" type="text/css" href="tablecsscode.css">
	   <link rel="stylesheet" href="styles.css">

   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <script type="text/javascript">
	function request(){
		
				var e1 = document.getElementById("event_id");
				var event = e1.options[e1.selectedIndex].value;
				var e2 = document.getElementById("publication_id");
				var pub = e2.options[e2.selectedIndex].value;
				var e3 = document.getElementById("reviewer_id");
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


			xmlhttp.open("GET", "" + assignpaperquery + ".php?event_id="+inst_id+"&publication_id="+pub + "&reviewer_id="+reviewer,true);
			xmlhttp.send();
	}
	function goBack() {
					
     		window.location="welcome.php";
	}
	
	function selectPub(x) {	
		document.getElementById("publication_id").value = x.id;
	}
	function selectReviewer(x) {
		document.getElementById("reviewer_id").value = x.id;		
	}
	
	function changeColour(x) {
			
	}
</script>
   <title>Join an Event</title>
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
	   echo "<li><a href='viewpublications.php'><span>View Your Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	   echo "<li class='active'><a href='#'><span>Join an Event</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else if ($usertype == "editor"){
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
		echo "<li><a href='searchpublication.php'><span>Search Publication</span></a></li>";
	   echo "<li><a href='joinevent.php'><span>Apply for an Event</span></a></li>";
	   echo "<li class='active'><a href='#'><span>Check Publications of Your Event</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}
	else{
	     echo "<li><a href='welcome_" . $usertype .  ".php'><span>Home</span></a></li>";
	   echo "<li><a href='subscribe.php'><span>Subscribe</span></a></li>";
	   echo "<li><a href='#'><span>Search Publication</span></a></li>";
	   echo "<li class='active'><a href='#'><span>Apply for an Event</span></a></li>";
	   echo "<li><a href='#'><span>Check Assigned Publications</span></a></li>";
	   echo "<li><a href='joininstitution.php'><span>Join an Institution</span></a></li>";
	    echo "<li><a href='#'><span>My Info</span></a></li>";
		echo "<li><a href='reports.php'><span>Reports</span></a></li>";
	    echo "<li class='last'><a href='logout.php'><span>Logout</span></a></li>";
	}

   ?>
</ul>
</div>
<?php
echo "<form name='myform' method='POST'  action='assignpaper1.php'>";

echo "<br><br><label for='Event'> Select Event: </label>";
  echo "<select id='event_id' name='event_id'  >";
  
	while(@($myevent = mysql_fetch_array($events))) {
	  if($myevent['event_id'] == $event_id) {
		echo "<option selected value='".$myevent['event_id']."'>".$myevent['name']."--</option>";		  
	  }
	  else {
		echo "<option value='".$myevent['event_id']."'>".$myevent['name']."</option>";		  
	  }

	}
	echo "</select>";
	echo "<input id='button' type='submit' name='submit' value='Select Event'>";
	
  ?>
</form>
<?php
	 $sql2 = "SELECT DISTINCT publication_id, title  FROM submit as S NATURAL JOIN publication as P JOIN event as E ON E.event_id = S.event_id JOIN assignpaper as AP ON AP.publication_id = P.publication_id WHERE E.event_id = '$event_id'";
	$publications = mysql_query($sql2, $con);
		
	
	echo '<br><table><td>SELECT PUBLICATION<br><div class="CSSTableGenerator" >';
	 $sql2 = "SELECT DISTINCT publication_id, title  FROM submit as S NATURAL JOIN publication as P JOIN event as E ON E.event_id = S.event_id WHERE E.event_id = '$event_id'";
	$publications = mysql_query($sql2, $con);
	@$rows = 15 + mysql_num_rows($publications) * 10;
	echo '<table id ="reviewerTable" border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>ID</th>
	<th>title</th>
	</tr>';
	while(@($mypub = mysql_fetch_array($publications))) {
		echo "<tr id = '".$mypub['publication_id'] ."' onClick=\"selectPub(this)\">";
		echo "<td >" . $mypub['publication_id'] . "</td>";
		echo "<td >" . $mypub['title'] . "</td>";
		//echo "<td id = '".$mypub['publication_id'] ."'><button class=\"button button1\" onclick=\"selectPub(this)\">Select!</button></td>";

		echo "</tr>";
	}
echo "</table>
	</div></td>";

 ?>
 
<?php 

echo '<td>SELECT REVIEWER<br><div class="CSSTableGenerator" >';
 	 $sql2 = "SELECT DISTINCT U.user_id, U.name, U.surname, RES.researcher_field FROM participate as P NATURAL JOIN event as E JOIN user as U ON P.user_id = U.user_id JOIN reviewer as R ON R.user_id = U.user_id JOIN researcher as RES ON RES.user_id = U.user_id WHERE E.event_id = '$event_id' ";
	$authors = mysql_query($sql2, $con);
	@$rows = 15 + mysql_num_rows($authors) * 10;
	echo '<table id ="reviewerTable" border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>ID</th>
	<th>Name</th>
	<th>Research Field</th>
	</tr>';
	while(@($myauthors = mysql_fetch_array($authors))) {
		echo "<tr id = '".$myauthors['user_id'] ."' onClick=\"selectReviewer(this)\" >";
		echo "<td>" . $myauthors['user_id'] . "</td>";
		echo "<td >" . $myauthors['name'] . " " . $myauthors['surname'] . "</td>";
		echo "<td>" . $myauthors['researcher_field'] . "</td>";
		//echo "<td id = '".$myauthors['user_id'] ."'><button class=\"button button1\" onclick=\"selectReviewer(this)\">Select!</button></td>";

		//echo "<td><a href=\"cancel.php?cid=".$myauthors['cid']."\">Cancel</a></td>";
		echo "</tr>";
	}
echo "</table>
	</div></td></table>";
?>

 <br><form name="submitassignForm" method="POST"  action="assignpaperquery.php?event_id=<?php echo $event_id?>">
Publication id: <br> <br>
<input id="publication_id" readonly type="text" name="publication_id" size="40"><br> 
Reviewer id: <br> <br>
<input id="reviewer_id" readonly type="text" name="reviewer_id" size="40"><br> 
<input id="button" type="submit" name="submit" value="Assign paper">
</form>

<?php
	 $sql2 = "SELECT DISTINCT publication_id, title  FROM submit as S NATURAL JOIN publication as P JOIN event as E ON E.event_id = S.event_id JOIN assignpaper as AP ON AP.publication_id = P.publication_id WHERE E.event_id = '$event_id' AND P.status != 'accepted';";
	$publications = mysql_query($sql2, $con);
		
	
	echo '<br><td>ASSIGNED PUBLICATIONS<br><div class="CSSTableGenerator" >';
	 $sql2 = "SELECT DISTINCT publication_id, title, reviewer_id  FROM submit as S NATURAL JOIN publication NATURAL JOIN assignpaper as P JOIN event as E ON E.event_id = S.event_id WHERE E.event_id = '$event_id'";
	$publications = mysql_query($sql2, $con);
	@$rows = 15 + mysql_num_rows($publications) * 10;
	echo '<table id ="reviewerTable" border = 1 style="height:'. $rows .'px;">	  
	<tr>
	<th>ID</th>
	<th>title</th>
	<th>Reviewer ID</th>
	</tr>';
	while(@($mypub = mysql_fetch_array($publications))) {
		echo "<tr id = '".$mypub['publication_id'] ."' onClick=\"selectPub(this)\">";
		echo "<td >" . $mypub['publication_id'] . "</td>";
		echo "<td >" . $mypub['title'] . "</td>";
		echo "<td >" . $mypub['reviewer_id'] . "</td>";
		//echo "<td id = '".$mypub['publication_id'] ."'><button class=\"button button1\" onclick=\"selectPub(this)\">Select!</button></td>";

		echo "</tr>";
	}
echo "</table>
	</div></td>";
			mysql_close($con);


 ?>


</body>
</html>
