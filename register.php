<?php  session_start(); 

	if ( ! isset($_SESSION['login_user']) )
	{
		header('Location: index.php');
	}
	
	require_once('connection.php');

	$errors;

	

	if ( isset ( $_POST['Submit'] ) )
	{
		if ( 
				(empty($username = $_POST['username'])) || 
				(empty($fathername = $_POST['fathername'])) ||
				(empty($date_of_birth = $_POST['date_of_birth'])) ||
				(empty($fathername = $_POST['fathername'])) ||
				(empty($gender = $_POST['gender'])) ||
				(empty($nomineename = $_POST['nomineename'])) ||
				(empty($balance = $_POST['balance'])) ||
				(empty($account_no = $_POST['account_no'])) ||
				(empty($cardno = $_POST['cardno'])) ||
				(empty($pinno = $_POST['pinno'])) ||
				(empty($address = $_POST['address']))

			) {
			
			$errors = "Please fill up all field correctly.";
		}
		else {
			
			$query 	= "INSERT INTO account(user_name, father_name, date_of_birth, gender, nominee_name, balance, account_no, card_no, pin_no, address)";
		    $query 	.= "values ('{$username}','{$fathername}','{$date_of_birth}','{$gender}','{$nomineename}',{$balance},{$account_no},{$cardno},{$pinno},'{$address}')";


		    $result = mysql_query($query, $connection);			
			

			if ($result) {

				$errors = "Account has benn registered successfully.";

			} 

				mysql_close($connection);

		}
	}
	else {

	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Register - Bank</title>
	<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
	<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
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

	<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
	});
	</script>

	<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
		$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
	});
	</script>


	<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
	});
	</script>


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

	<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
 

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


</head>
<body> 

	<!-- Start: page-top-outer -->
	<div id="page-top-outer">    

		<!-- Start: page-top -->
		<div id="page-top">

			<!-- start logo -->
			<div id="logo">
			<a href=""><img src="images/Capture.JPG" width="156" height="40" alt="" /></a>
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
			
			<div class="nav-divider">&nbsp;</div>		

			<a href="logout.php" id="logout"><img src="images/shared/nav/image_04.gif" width="70" height="20"  /></a>  <!--w=64,h=14-->
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
				<a href="" id="acc-stats">Statistics</a> 
			</div>
			</div>
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		<ul class="current"><li><a href="register.php"><b>Register New Account</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--	<div class="select_sub">
		<ul class="sub">
				<li><a href="#nogo">Dashboard Details 1</a></li>
				<li><a href="#nogo">Dashboard Details 2</a></li>
				<li><a href="#nogo">Dashboard Details 3</a></li>
			</ul>
		</div>-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>
		<!--<ul class="select"><li><a href="busadd.php"><b>Bus Add</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--<div class="select_sub show">
			<ul class="sub">
				<li><a href="#nogo">View all products</a></li>
				<li class="sub_show"><a href="#nogo">Add product</a></li>
				<li><a href="#nogo">Delete products</a></li>
			</ul>
		</div>-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>
		<ul class="select"><li><a href="viewacc.php"><b>View Account</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--<div class="select_sub show">
			<ul class="sub">
				<li><a href="#nogo">View all products</a></li>
				<li class="sub_show"><a href="#nogo">Add product</a></li>
				<li><a href="#nogo">Delete products</a></li>
			</ul>
		</div>-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<!--<ul class="select"><li><a href="busmodify.php"><b>Bus Modify</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo">Categories Details 1</a></li>
				<li><a href="#nogo">Categories Details 2</a></li>
				<li><a href="#nogo">Categories Details 3</a></li>
			</ul>
		</div>-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<!--<ul class="select"><li><a href="busdelete.php"><b>Bus Delete</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<!--<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo">News details 1</a></li>
				<li><a href="#nogo">News details 2</a></li>
				<li><a href="#nogo">News details 3</a></li>
			</ul>
		</div>-->
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
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


<div id="page-heading"><h1>Register New Account</h1></div>


	
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
	<?php echo ( isset( $errors ) )? $errors : ' ' ?>

	<tr valign="top">
	<td>
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">User Name</th>
			<td><input type="text" class="inp-form" name="username" /></td>
			<td></td>
		</tr>
	
		</tr>
		<tr>
		<th valign="top">Father Name</th>
		<td><input type="text" class="inp-form" name="fathername" /></td>
		
		</td>
		<td></td>
		</tr> 
		
		</td>
		<td></td>
		</tr> 

		</tr>
		<tr>
		<th valign="top">Date Of Birth</th>
		<td><input type="text" class="inp-form" name="date_of_birth" data-beatpicker="true"/></td>

		
		</td>
		<td></td>
		</tr> 
		
		</td>
		<td></td>
		</tr> 

		<tr>
		<th valign="top">Gender</th>
				<td><input type="text" class="inp-form" name="gender" /></td>
         </td>
		<td></td>
		</tr> 		
	
			<tr>
			<th valign="top">Nominee Name</th>
			<td><input type="text" class="inp-form" name="nomineename" /></td>
			<td></td>
		</tr>
	
		<tr>
		<th valign="top">Balance</th>
		<td><input type="text" class="inp-form" name="balance" /></td>
			<td></td>
		</tr>
	
		<tr>
		<th valign="top">Account No</th>
		<td><input type="text" class="inp-form" name="account_no" /></td>
			<td></td>
		</tr>
		
		<tr>
		<th valign="top">Card No</th>
		<td><input type="text" class="inp-form" name="cardno" /></td>
			<td></td>
		</tr>
		
				
		
		<tr>
			<th valign="top">PIN No</th>
			<td><input type="text" class="inp-form" name="pinno" /><p>&nbsp; </p></td>
			<td></td>
		</tr>
		<tr>
		<th valign="top">Address</th>
		<td><input type="text" class="inp-form" name="address" /></td>
			<td></td>
		</tr>
		
		<tr>
		<th>&nbsp;</th>
		<td valign="top">
           <input type="submit" value="Submit"  name="Submit"  class="form-submit" />
			
		</td>
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




