<?php
	 include('session.php');
	 include('configdb.php');
  
   
 
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
   <li><a href='#'><span>Search Authors</span></a></li>
   <li class='last'><a href='#'><span>My Info</span></a></li>
</ul>
</div>

</body>
<html>
