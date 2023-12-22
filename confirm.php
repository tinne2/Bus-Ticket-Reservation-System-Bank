<?php
session_start();

{
	$link = mysql_connect('localhost', 'root', '');
	$db_selected = mysql_select_db('bank', $link);

	$name=$_POST['name'];
	$cardno=$_POST['cardno'];
	$pinno=$_POST['pinno'];

	

	$fare      =$_POST['price'];
    $seatNo    = $_POST['seatno'];
    $coachNo   = $_POST['coachid'];
    $from      = $_POST['from'];
    $to        = $_POST['to'];
    $date      = $_POST['date'];
    $time      = $_POST['time'];
	
	$totalPrice=$fare*$seatNo;


$result = mysql_query("SELECT * FROM account WHERE card_no='$cardno'");
	if(mysql_num_rows($result) == 0) echo "invalid_cardno";
$result1 = mysql_query("SELECT * FROM account WHERE account_no='$accountno'");

while($row1 = mysql_fetch_array($result1))
	{
		$balanceadmin = $row1['balance'];
	}

while($row = mysql_fetch_array($result))
	{
		if($name == $row['name'] && $pinno == $row['pinno'] )
			{
				$balanceuser = $row['balance'];
				if($balanceuser >=$payment)
					{
						$balanceuser = $balanceuser-$totalPrice;
						$balanceadmin = $balanceadmin+$totalPrice;
						$updateuser = "UPDATE account SET balance='$balanceuser' where card_no='$cardno'" ;
						$updateadmin = "UPDATE account SET balance='$balanceadmin' where account_no='$accountno'" ;
					
						if (mysql_query($updateuser,$link)) 
							{	if (mysql_query($updateadmin,$link)) 
									{echo "success";
									 //header("Location: http://localhost/ann/user/bsure.php?price=$price&quantity=$quantity&movie=$movie&date=$date&time=$time$catagory=catagory,&type=$type");
										}
									else echo "user_update_but_admin_update_fail";	
							}
						else echo "user_update_fail";	
					
					}
				else
					echo "have_not_enough_balance";
			}
		//else  echo "invelid_name_or_pin";	
	}
}
?>