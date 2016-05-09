<?php
	 include('session.php');
	 include('configdb.php');
	mysql_close($con);
   
 
?>
<!doctype html>
<html lang=''>
<head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <title>WELCOME <?php echo $fullname; ?></title>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Home</span></a></li>
   <li><a href='subscribe.php'><span>Subscribe</span></a></li>
   <li><a href='searchpublication.php'><span>Search Publication</span></a></li>
   <li><a href='#'><span>My Info</span></a></li>
   <li class='last'><a href='logout.php'><span>Logout</span></a></li>
</ul>
</div>
 <h>WELCOME <?php echo $fullname; ?> </h>


</body>
<html>
