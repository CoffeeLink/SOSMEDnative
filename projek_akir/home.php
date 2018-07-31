<?php 
include("./inc/header.inc.php");
if(isset($_SESSION['user_login'])){
	?>
<h2>Welcome!, <?php echo $_SESSION['user_login'];  ?></h2>
<?php 

echo "<br /> Would you like to logout? <a href='logout.php'>Logout</a>";
}
else{
?>

<meta http-equiv="refresh" content="0; url=http://localhost/projek_akir/index.php" />
<?php
 }?> 

