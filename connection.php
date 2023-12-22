
<?php
	$connection=mysql_connect('localhost','root','');

	if($connection==true)
	{
		mysql_select_db('bank',$connection);
	} else {
		die('Check Your Database Connection.');
	}
?>

