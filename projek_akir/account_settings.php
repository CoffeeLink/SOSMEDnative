<?php 

include_once ("inc/header.inc.php");
if ($username){

 
}
else{
die("you must be logged in");

}



if (! empty($_POST)) {

$updateinfo = @$_POST['updateinfo'];
$senddata = @$_POST['senddata'];
if ($senddata) {
$old_password = $_POST['oldpassword'];
$new_password = $_POST['newpassword'];
$repeat_password = $_POST['newpassword2'];
	$query = "SELECT * FROM users WHERE username='$username'";
	$password_query = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($password_query)) {
		$db_password = $row ['password'];

		  $old_password_md5 = md5($old_password);
        
       
        if ($old_password_md5 == $db_password) {
         if ($new_password == $repeat_password) {
            if (strlen($new_password) <= 4) {
             echo "Sorry! But your password must be more than 4 character long!";
            }
            else
            {
          $new_password_md5 = md5($new_password);
           $update_query = "UPDATE users SET password='$new_password_md5' WHERE username='$username'";
           $password_update_query = mysqli_query($conn, $update_query);
           echo "Success! Your password has been updated!";

            }
         }
         else
         {
          echo "Your two new passwords don't match!";
         }
        }
        else
        {
         echo "The old password is incorrect!";
        }
  }
}
  //user input
	

 if ($updateinfo) {
   $firstname = $_POST['fname'];
   $lastname = $_POST['lname'];
   $bio = $_POST['aboutyou'];


   if (strlen($firstname) < 3) {
    echo "Your first name must be 3 more more characters long.";
   }
   else
   if (strlen($lastname) < 5) {
    echo "Your last name must be 5 more more characters long.";
   }
   else
   {
   
    $info_submit_query = "UPDATE users SET first_name='$firstname', last_name='$lastname', bio='$bio' WHERE username='$username'";
    $result_submit = mysqli_query($conn, $info_submit_query	);
    echo "Your profile info has been updated!";
    }
  }
  else
  {
   //Do nothing
  }
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
  //Profile Image upload script
  if (isset($_FILES['profilepic'])) {
   if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"] < 1048576)) //1 Megabyte
  {
   $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $rand_dir_name = substr(str_shuffle($chars), 0, 15);
   mkdir("userdata/profile_pic/$rand_dir_name");

   if (file_exists("userdata/profile_pic/$rand_dir_name/".@$_FILES["profilepic"]["name"]))
   {
    echo @$_FILES["profilepic"]["name"]." Already exists";
   }
   else
   {
    move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pic/$rand_dir_name/".$_FILES["profilepic"]["name"]);

    $profile_pic_name = @$_FILES["profilepic"]["name"];
    $profile_pic_query = "UPDATE users SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'";
    $result_profile_pic = mysqli_query($conn, $profile_pic_query);
    header("Location: account_settings.php");
    
   }
  }
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
  }
}

	$info = "SELECT first_name, last_name, bio FROM users WHERE username='$username'";
  	$get_info = mysqli_query($conn, $info);
  	$get_row = mysqli_fetch_assoc($get_info);
  	$dbfirstname = $get_row['first_name'];
  	$dblastname = $get_row['last_name'];
  	$dbbio = $get_row	['bio'];
	
  	//user input
  	
 ?>

<h2>Edit your account settings below</h2>
<hr />
<p>UPLOAD YOUR PROFILE PHOTO :</p>
<form action="" method="post"	enctype="multipart/form-data">
<img src="<?php echo $profile_pic; ?>" width="70">
<input type="file" name="profilepic" /><br />
<input type="submit" name="uploadpic" value="Upload Image" />
	
</form>
<hr />
<form action="account_settings.php" method="post">
<p>CHANGE YOUR PASSWORD:</p> <br />
Your Old Password  :<input type="password" name="oldpassword" id="oldpassword" size="40" /> <br />
Your New Password :<input type="password" name="newpassword" id="newpassword" size="40" /> <br />
Repeat Password    :<input type="password" name="newpassword2" id="newpassword2" size="40" /> <br />
<input type="submit" name="senddata" id="senddata"  value="Update password" />
</form>
<hr />
<p>UPDATE YOUR PROFILE INFO:</p> <br />
<form action="account_settings.php" method="post">
First Name : <input type="text" name="fname" id="fname" size="40" value="<?php echo $dbfirstname; ?>" /> <br />
Last Name : <input type="text" name="lname" id="lname" size="40" value="<?php echo $dblastname; ?>" /> <br />
About You : <textarea name="aboutyou" id="aboutyou" cols="40" rows="7" ><?php 	echo $dbbio; ?></textarea> <br />
<hr />
<input type="submit" name="updateinfo" id="updateinfo"  value="Update Information" />
<br />
<br />

</form>