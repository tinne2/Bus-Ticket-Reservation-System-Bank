<?php
mysql_connect("localhost","root","") or die("Cannot Connect to the database!");
mysql_select_db("bank") or die("Cannot Connect to the database!");

$User_Name=($_POST['username']);
$Father_Name=($_POST['fathername']);
$Date_of_Birth=($_POST['dateofbirth']);
$Gender=($_POST['gender']);
$Nominee_Name=($_POST['nomineename']);
$Balance=($_POST['balance']);
$Card_No=($_POST['cardno']);
$PIN_No=($_POST['pinno']);
$Address=($_POST['address']);


$save=mysql_query("INSERT INTO account(id,user_name,father_name,date_of_birth,gender,nominee_name,balance,card_no,pin_no,address) VALUES ('','$User_Name','$Father_Name','$Date_of_Birth','$Gender','$Nominee_Name','$Balance(tk)','$Card_No','$PIN_No','$Address')");


if($save==1){
  echo "<SCRIPT LANGUAGE='JavaScript'>
  window.alert('New User Added Successfully')
  window.location.href='register.php';
  </SCRIPT>";
  }
  else
  {
  echo"<SCRIPT LANGUAGE='JavaScript'>
   window.alert('Failed To Data Insert')
  window.location.href='register.php';
  </SCRIPT>";
  }
  ?>