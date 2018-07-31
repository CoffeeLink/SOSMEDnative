<?php 
include_once 'inc/header.inc.php'; 
if($username == ""){
	header("location: index.php");

}
else{
if (isset($_GET["u"])) {
	$username = mysql_real_escape_string($_GET["u"]);
	if (ctype_alnum($username)) {
 	//check user exists
	$check = "SELECT `username`, `first_name` FROM `users` WHERE username='$username'";
	$hasil = mysqli_query($conn, $check); 
	
	if (mysqli_num_rows($hasil)===1) {
	$get = mysqli_fetch_assoc($hasil);
	$username = $_POST['user_login'];
	$firstname = $get['first_name'];	
	}
	else
	{
	
	exit();
	}
	}
}
$post = @$_POST['post'];
if ($post != "") {
$date_added = date("Y-m-d");
$added_by = $username;
$user_posted_to = $username;

$sqlCommand = "INSERT INTO posts VALUES('', '$post','$date_added','$added_by','$user_posted_to')";  
$query = mysqli_query($conn, $sqlCommand); 

}
//Check whether the user has uploaded a profile pic or not
  $check_pic = "SELECT profile_pic FROM users WHERE username='$username'";
  $result_check_pic = mysqli_query($conn, $check_pic);
  $get_pic_row = mysqli_fetch_assoc($result_check_pic);
  $profile_pic_db = $get_pic_row['profile_pic'];
  if ($profile_pic_db == "") {
  $profile_pic = "image/default_pic.jpg";
  }
  else
  {
  $profile_pic = "userdata/profile_pic/".$profile_pic_db;
  }
?>
<br />
<div class="postForm">
	<form action="profile.php" method="post">
	<textarea id="post" name="post" rows="5" cols="85"></textarea>
	<input type="submit" name="send" value="Post" style="background-color: #DCE5EE; float: right; border: 1px solid #666; color:#666; height: 73px; width: 65px;"></input>
			
	</form>
</div>
<div class="profilePosts">
	<?php 
	$getposts = "SELECT * FROM `posts` WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10";
	$result_getposts = mysqli_query($conn, $getposts);
	while ($row = mysqli_fetch_assoc($result_getposts)) {
		$id = $row['id'];
		$body = $row['body'];
		$date_added = $row['date_added'];
		$added_by = $row['added_by'];
		$user_posted_to = $row['user_posted_to'];
		$get_user_info = "SELECT * FROM users WHERE username='$added_by'";
		$result_get_user = mysqli_query($conn, $get_user_info);
        $get_info = mysqli_fetch_assoc($result_get_user);
        $profilepic_info = $get_info['profile_pic'];
        if ($profilepic_info == "") {
            $profilepic_info = "./image/default_pic.jpg";
        }
        else
        {
        $profilepic_info = "./userdata/profile_pic/".$profilepic_info;
        }
		echo "<div style='float: left; background-color: #DCE5EE;'> <img src='$profilepic_info' height='60'>
             </div>
			 <div class='posted_by' style='background-color: #DCE5EE;'>
			 Posted by:
             <a href='profile.php'>$added_by</a> on $date_added</div>
             <br /><br />
             <div  style='max-width: 600px; background-color: #DCE5EE;'>
             $body<br /><p /><p />
             </div>
             <hr />
             <br />
						";
	}
	 ?>
</div>
 <img src="<?php echo $profilepic_info ?>" height="250" width="200" alt="<?php echo $username; ?>'s Profile" title="<?php echo $username; ?>'s Profile"/>
 <br />
 <div class="textHeader" ><b><?php echo $username; ?>'s profile</b></div>
 <div class="profileLeftSideContent">
 	<?php 	

 			$about_query="SELECT bio FROM users WHERE username='$username'";
 			$result_about_query=mysqli_query($conn, $about_query);
 			$get_result = mysqli_fetch_assoc($result_about_query);
 			$about_user = $get_result['bio'];
 			echo $about_user;	
 	 ?>

</div>
<!-- <img src="<?php ; ?> height="250" width="200" alt="<?php $username;  ?>'s Profile" title="<??>"">
 <div class="textHeader" ><b><?php $username; ?>'s Friends</b></div>
 --> 
 <div class="profileLeftSideContent">
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;	
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;	
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;	
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;
 <img src="#" height="50" width="40"/>&nbsp;&nbsp;
 	
 </div>
<?php } ?>
