<?php include_once 'inc/header.inc.php'; ?>
<?php 
if (! empty($_POST)){

$reg = @$_POST['reg'];
$log = @$_POST['log'];
//deklarasi variabel untuk mengecek error
//check ketersediaan username
// //registration form

if ($reg) {
$fn = $_POST['fname'];
$ln = $_POST['lname'];
$un = $_POST['username'];
$em = $_POST['email'];
$em2 = $_POST['email2'];
$pswd = $_POST['password'];
$pswd2 = $_POST['password2'];
$d = date("y-m-d");
	if ($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {

		if ($em==$em2) {
// Check if user already exists
			$u_check = "SELECT username FROM users WHERE username='$un'";
			$hasil1 = mysqli_query($conn, $u_check);
// Count the amount of rows where username = $un
			$check = mysqli_num_rows($hasil1);
//Check whether Email already exists in the database
			$e_check = "SELECT email FROM users WHERE email='$em'";
			$hasil2 = mysqli_query($conn, $e_check);
//Count the number of rows returned
			$email_check = mysqli_num_rows($hasil2);
				if ($check == 0) {
  					if ($email_check == 0) {
//check all of the fields have been filed in

// check that passwords match
						if ($pswd==$pswd2) {
// check the maximum length of username/first name/last name does not exceed 25 characters
							if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
									echo "The maximum limit for username/first name/last name is 25 characters!";
							}
							else
							{
// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
								if (strlen($pswd)>30||strlen($pswd)<5) {
								echo "Your password must be between 5 and 30 characters long!";
								}
								else
								{
//encrypt password and password 2 using md5 before sending to database
								$pswd = md5($pswd);
								$pswd2 = md5($pswd2);
								$query = "INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `sign_up_date`, `activated`, `bio`, `profile_pic`, `friend_array`) VALUES (NULL, '$un', '$fn', '$ln', '$em', '$pswd', '$d', '0', 'Write something about yourself.', '', 'no');";
								mysqli_query($conn, $query);?>
								<h2>Welcome to findFriends</h2><a href="index.php">Login</a> to your account to get started ..."
							<?php	
								}
							}
						}
						else 
						{
						echo "Your passwords don't match!";
						}
					}
else
{
echo "email sudah terpakai";
}
}
else
{
 echo "Username sudah terpakai";
}
}
else
{
echo "email tidak sama";
}
}
else {
echo "Please fill in all of the fields";
}
}



//user login code
if ($log) {
	
}
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	$user_login =  $_POST["user_login"]; // filter everything but numbers and letters
    $password_login = $_POST["password_login"]; // filter everything but numbers and letters
	$md5password_login = md5($password_login);
	$sql = "SELECT `id` FROM `users` WHERE username='$user_login' AND password='$md5password_login'"; // query the person
	//Check for their existance
	$select = mysqli_query($conn, $sql);
	$userCount = mysqli_num_rows($select); //Count the number of rows returned
	if ($userCount == 1) {
		while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
	}
		 $_SESSION["id"] = $id;
		 $_SESSION["user_login"] = $user_login;
		 $_SESSION["password_login"] = $password_login;
		header('location: profile.php');
         exit("<meta http-equiv=\"refresh\" content=\"0\">");
		} else {
		echo 'That information is incorrect, try <a href="index.php">login</a> again?';
		exit();
	}
echo $userCount;
}
}

 ?>


<div style=" width : 800px; margin: 0px auto;">
<table >
	<tr>
		<td width="60%" valign="top">
			<h2>Already a member? sign in below!</h2>
			<form action="index.php" method="POST">
				<input id="userlogin" type="text" name="user_login" size="25" placeholder="Username" /><br /><br />
				<input type="password" name="password_login" size="25" placeholder="Password" /><br /><br />
				<input type="submit" name="log" value="Login">
			</form>
			
		</td>
		<td width="40%" valign="top">
			<h2>Sign up below!</h2>
			<form action="index.php" method="POST">
				<input type="text" name="fname" size="25" placeholder="first name" /><br /> <br />
				<input type="text" name="lname" size="25" placeholder="last name" /><br /> <br />
				<input type="text" name="username" size="25" placeholder="username" /><br /> <br />
				<input type="text" name="email" size="25" placeholder="email address" /><br /> <br />
				<input type="text" name="email2" size="25" placeholder="confirm email address" /><br /> <br />
				<input type="password" name="password" size="25" placeholder="password" /><br /> <br />
				<input type="password" name="password2" size="25" placeholder="confirm password" /><br /> <br />
				<input type="submit" name="reg" value="Sign up!" />
				
			</form>
		</td>
	</tr>
</table>
<?php
 include_once 'inc/footer.inc.php' ?>