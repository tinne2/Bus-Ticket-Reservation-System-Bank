<!DOCTYPE html>
<html>
<head>
	<style type="text/css">

	* {
		margin: 0;
		padding: 0;
	}
	body {
		line-height: 1.5em;
		font-family: arial;
		height:100%;
	}

	#main-content {
		margin: 20px auto;
		width: 95%;
		min-height:100%;
	position:relative;
	}


	footer {
		width:95%;
		height:20px;
		position:absolute;
		bottom: 10px;
		left: 2%;
		border-top: 1px solid #ededed;
		padding: 5px;
		text-align: right;

	}



	/*** header **/
	header {
		width: 100%;
		overflow: hidden;
		height: 130px;
		overflow: hidden;
		border-bottom: 4px solid #C8C8C8;
	}

	.company-info {
		width: 50%;
		float: right;
		overflow: hidden;
	}

	.company-info .company-info-wrapper {
		float: right;
	}

	.company-info .company-info-wrapper p,
	.company-info .company-info-wrapper h2{
		text-align: right;
	}
	.invoice-info {
		width: 50%;
		float: left;
		overflow: hidden;

	}

	.invoice-info .invoice-info-wrapper {
		float: left;
	}

	.invoice-info .invoice-info-wrapper table{
		float: left;	
	}
	.invoice-info .invoice-info-wrapper table tr:first-child th{
		font-size: 25px;	
		text-align: left;
		padding-bottom: 10px;
	}

	.invoice-info .invoice-info-wrapper table tr:first-child {
		border: none;
		height: 10px;
	}

	.invoice-info .invoice-info-wrapper table tr td{
		text-align: left;
		font-weight: normal;
	}
	.invoice-info .invoice-info-wrapper table tr td:first-child {
		text-align: left;
		font-weight: bold;
	}



	table#order {
		width: 100%;
		border-collapse: collapse;
		border: 1px solid #ededed;
		
	}

	table#order td, table#order th {
		border: 1px solid #ededed;
		font-size: 16px;
		padding: 7px;
	}

	#order .order-total td:first-child{
		text-align: right;
		  padding-right: 20px;
		font-weight: bold;
		border: none;
	}
	</style>
</head>
<body>


<section id="main-content">
	<header>
	<div class="company-info">
		<div class="company-info-wrapper">
			<h2>Online Bus Ticket Reservation</h2>
			<p>
				Bahaddar Hat, Chittagong <br />
				Phone: +8801811000000
			</p>
		</div>
	</div>

	<div class="invoice-info">
		<div class="invoice-info-wrapper">
			<table>
				<tr>
					<th colspan="2">Invoice</th>
				</tr>
				<tr>
					<td>Booking ID</td>
					<td><b>:</b> @booking-id</td> <!-- show booking id -->
				</tr>
				<tr>
					<td>Date</td>
					<td><b>:</b> <?php echo date('d/m/Y') ?></td>
				</tr>
			</table>
		</div>
	</div>
</header>

<table id="order">
	<tr>
		<th> Sl# </th>
		<th> Coach No </th>
		<th> Seat No </th>
		<th> Boarding Point </th>
		<th> Dropping Point </th>
		<th> Date </th>
		<th> Time </th>
		<th> Fare/seat </th>
	</tr>		
	
	<tr>
		<td> @sl </td>
		<td> @coach-no </td>
		<td> @seat-no </td>
		<td> @boarding-point </td>
		<td> @droping-point </td>
		<td> @booking-date </td>
		<td> @booking-time </td>
		<td> Tk. @fare-per-seat </td>
	</tr>

	<tr class="order-total">
		<td colspan="7">Total</td>
		<td>Tk. @total</td>
	</tr>
</table>	

</section>
<footer>
		<p>
			
		</p>
	</footer>

</body>
</html>