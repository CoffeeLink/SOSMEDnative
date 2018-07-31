 <?php
 include_once 'inc/connect.inc.php'; 

 session_start();
 if (!isset($_SESSION["user_login"])){
$username = "";
}
 
 else {
 	$username = $_SESSION["user_login"];
} 	
?>

<html>
<head>
	<title>Sosmed</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<div class="headerMenu">
	<div id="wrapper">
		<div class="logo">
			<img src="golek_bolo.png">
		</div>

		<?php 
			if(isset($_SESSION["user_login"])){
		?>		 
		<div id="menu">
			<a href="profile.php"/>Profile</a>
			<a href="account_settings.php">Account Setting</a>
			<a href="logout.php"/>Logout</a>  
					</div>
		<?php
		 
			}
			else{
				
			}
		 ?>
	</div>
</div>
<div id="wrapper2">



