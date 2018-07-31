<?php 
include_once 'inc/connect.inc.php'; 

$post= $_POST['post'];
$username = 'test123';
$added = 'test123';
// $username = $_SESSION['user_login'];
// $check = "SELECT `first_name` FROM `users` WHERE username='$username'";
// $added_by = mysqli_query($conn, $check);
// echo $username;
// echo "<br />".$added_by;
if($post != ""){
	$date_added = date("Y-m-d");
	$user_posted_to = $username;
	$added_by = $added;

	$sqlCommand = "INSERT INTO `posts` (`id`, `body`, `date_added`, `added_by`, `user_posted_to`) VALUES (NULL, '$post', '$date_added', '$added_by', '$user_posted_to')";
	mysqli_query($conn, $sqlCommand);
}
else
{
	echo "You must enter something in the post field before you can send it ...";
}
?>
