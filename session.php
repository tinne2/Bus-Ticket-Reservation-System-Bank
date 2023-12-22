<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("bank", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];/*$user_check=$_SESSION['login_user'];*/
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select admin_id from admin where admin_id='$user_check'", $connection);/*$user_check*/
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['admin_id'];
if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>