<?php  session_start(); 
use SunMailer\Mailer;
use SunMailer\View;
 require 'SunMailer/autoload.php';
 require_once("dompdf/dompdf_config.inc.php");
	if ( ! isset($_SESSION['user_id']) )
	{
		header('Location: index.php');
	}
	
	require_once('connection.php');

	if( isset($_POST['fare'])) $_SESSION['fare'] = $_POST['fare'];

	if( isset($_POST['coachid'])) $_SESSION['coachid'] = $_POST['coachid'];

	if( isset($_POST['seatno'])) $_SESSION['seatno'] = $_POST['seatno'];

	if( isset($_POST['from'])) $_SESSION['from'] = $_POST['from'];	

	if( isset($_POST['to'])) $_SESSION['to'] = $_POST['to'];	

	if( isset($_POST['date'])) $_SESSION['date'] = $_POST['date'];	

	if( isset($_POST['time'])) $_SESSION['time'] = $_POST['time'];	
	

	$errors;

	if (isset($_POST['Submit']))
	{
		if ( 
		(empty($username = $_POST['username'])) ||
		(empty($cardno = $_POST['cardno'])) ||
		(empty($pinno = $_POST['pinno'])) ||
		(empty($_SESSION['fare']))
		){
			
			$errors = "Please fill up all field correctly.";
		} else {

			//var_dump($_POST);die();

			$query = "select * from account where user_name ='{$username}' and card_no = '{$cardno}' and pin_no = '{$pinno}' LIMIT 1";
			
				
$result = mysql_query($query, $connection);
			$row = mysql_num_rows($result);
			
			


			if ($row == 1) {

				while($account = mysql_fetch_assoc ($result) )
   				{
   					if($account['balance'] >= $_SESSION['fare'])
   					{
   						$currentBalance = $account['balance'] - $_SESSION['fare'];
						
   						$updateQuery = "update account set balance ='{$currentBalance}' where id = {$account['id']}";
   						//$updateQuery1 = "update account set balance ='{$balance_admin_current}' where account_no = '{$account_noadmin}'";

						$updateResult = mysql_query($updateQuery, $connection);
						//$updateResult1 = mysql_query($updateQuery1, $connection);
						$query1 = "select balance from account where id=1";
						$result1 = mysql_query($query1, $connection);
						$v=mysql_fetch_assoc($result1);
						//var_dump($v);die();
						$a=$v['balance']+$_SESSION['fare'];
						
						$queryupdate="update account set balance=$a where id=1";
										
						mysql_query($queryupdate, $connection);
						
						if ($updateResult)
						{
						
							$coachNo   = $_SESSION['coachid'];
					        $seatNo    = $_SESSION['seatno'];
					        $from      = $_SESSION['from'];
					        $to        = $_SESSION['to'];
					        $date      = $_SESSION['date'];             
					        $time      = $_SESSION['time'];
                            $name      = $_SESSION['name'];
                             $email      = $_SESSION['email'];

					        $connection = mysql_connect("localhost", "root", "");

					        $db = mysql_select_db("ticketreservation", $connection);

					        $query = "INSERT INTO booking(coach_no, seat_no, boarding_point, droping_point, booking_date, booking_time,name,email) VALUES ('{$coachNo}','{$seatNo}' ,'{$from}','{$to}','{$date}' ,'{$time}', '{$name}', '{$email}')";

					        $result = mysql_query($query, $connection);
							$lastBooked = mysql_insert_id();
							

					        if ($result) {
							 /*********** Start of pdf report *************/
		   
		   $totalSeatBooked = explode(',', $seatNo);
		   
		   $farePerSeat = $_SESSION['fare'] / count($totalSeatBooked);

		  
		
		
		
		$_SESSION['reportorder']=[
				'sl'				=>	1,
				'booking-id'		=> $lastBooked,
				'coach-no'			=>  $coachNo,
				'seat-no'			=>	$seatNo,
				'boarding-point'	=>	$from,
				'droping-point'		=> 	$to,
				'booking-date'		=> 	$date,
				'booking-time'		=> 	$time,
				'fare-per-seat'		=> 	$farePerSeat,
				'total'				=>	$_SESSION['fare']

		];
	
		
		   /******** End of pdf report ****/	
		   
							//search user email
							$userID = $_SESSION['user_id'];
 $query = "SELECT * FROM user1 where id=$userID LIMIT 1";

					        $result = mysql_query($query, $connection);
							$user=mysql_fetch_assoc($result);
							$userEmail = $user['Email'];
							
           Mailer::send($userEmail, null, 'Confirmation Email', 'Your seat has been booked successfully.');	
		   
		  					
							
					           header("Location: /bus-ticket/Ticketreservation/user/seat6.php?checkout=success&busid={$coachNo}&from={$from}&to={$to}&date={$date}&time={$time}");
					        } else {
					            header("Location: /bus-ticket/Ticketreservation/user/seat6.php?checkout=error&busid={$coachNo}&from={$from}&to={$to}&date={$date}&time={$time}");
					        }

					        // reset session
					        unset($_SESSION['fare']);
					        unset($_SESSION['coachid']);
					        unset($_SESSION['seatno']);
					        unset($_SESSION['from']);
					        unset($_SESSION['to']);
					        unset($_SESSION['date']);
						}
   					}
   					else {
   						$errors = "Insufficient balance. Please, Recharge your account.";
   					}
   				}

				$query = "Update account set balance ='{$username}' and card_no = '{$cardno}' and pin_no = '{$pinno} LIMIT 1";

			} else {
			
				$errors = "Please, Insert a valid card.";

			}
		}
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Page</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
 
<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
});
</script>  


<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>


<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(function() {
	$("input.file_1").filestyle({ 
	image: "images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
});
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script> 

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
        $(function()
{

// initialise the "Select date" link
$('#date-pick')
	.datePicker(
		// associate the link with a date picker
		{
			createButton:false,
			startDate:'01/01/2005',
			endDate:'31/12/2020'
		}
	).bind(
		// when the link is clicked display the date picker
		'click',
		function()
		{
			updateSelects($(this).dpGetSelected()[0]);
			$(this).dpDisplay();
			return false;
		}
	).bind(
		// when a date is selected update the SELECTs
		'dateSelected',
		function(e, selectedDate, $td, state)
		{
			updateSelects(selectedDate);
		}
	).bind(
		'dpClosed',
		function(e, selected)
		{
			updateSelects(selected[0]);
		}
	);
	
var updateSelects = function (selectedDate)
{
	var selectedDate = new Date(selectedDate);
	$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
}
// listen for when the selects are changed and update the picker
$('#d, #m, #y')
	.bind(
		'change',
		function()
		{
			var d = new Date(
						$('#y').val(),
						$('#m').val()-1,
						$('#d').val()
					);
			$('#date-pick').dpSetSelected(d.asString());
		}
	);

// default the position of the selects to today
var today = new Date();
updateSelects(today.getTime());

// and update the datePicker to reflect it...
$('#d').trigger('change');
});
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
<style type="text/css">
<!--
.style3 {color: #0080C0}
-->
</style>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="images/logo-dbbl.jpg" width="156" height="40" alt="" /></a>	</div>

		</table>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<!--<div class="showhide-account"><img src="images/shared/nav/nav_myaccount.gif" width="95" height="16" alt="" /></div> <!--w=93,h=14-->
			<div class="nav-divider">&nbsp;</div>
			

			<a href="logout.php" id="logout"><img src="images/shared/nav/image_04.gif" width="70" height="20" alt="" /></a>  <!--w=64,h=14-->
			<div class="clear">&nbsp;</div>
		
			<!--  start account-content -->	
			<div class="account-content">
			<div class="account-drop-inner">
				<a href="" id="acc-settings">Settings</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-details">Personal details </a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-project">Project details</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-inbox">Inbox</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-stats">Statistics</a>			</div>
			</div>
			<!--  end account-content -->
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		<ul class="current"><li><a href=""><b>User Payment</b><!--[if IE 7]><!--></a><!--<![endif]-->
		
		</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>
		
		</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>
	
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
	
		</li>
		</ul>
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1>Payment</h1></div>
<!--  start product-table ..................................................................................... -->
 <form action="" method="post">
 
        
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">

	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
		

		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<?php echo ( isset( $errors ) )? $errors : ' ' ?>
		<tr>
			<th valign="top">Name on card</th>
			<td><input type="text" class="inp-form" name="username" /></td>
			<td></td>
		</tr>
		
		</tr>
		<tr>
			<th valign="top">Card number</th>
			<td><input type="password" class="inp-form" name="cardno" /></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Pin Number</th>
			<td><input type="password" class="inp-form" name="pinno" /></td>
			<td></td>
		</tr>
		
			
		
		</td>
		<th>&nbsp;</th>
		<td valign="top">
           <input type="submit" value="Submit"  name="Submit"  class="form-submit" />
		<td></td>
	</tr>
	</table>
		</form>

	<!-- end id-form  -->

	</td>
	<td>

	<!-- end related-activities -->

</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>



<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>

<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	Admin Skin &copy;  <a href=""></a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>




