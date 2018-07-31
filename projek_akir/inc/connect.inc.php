<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "idang_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
// mysqli_connect("localhost", "root", "") or die ("ga konek");
// mysql_select_db("idang_db") or die ("ga bisa select");

 ?>