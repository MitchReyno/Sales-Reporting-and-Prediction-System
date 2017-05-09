<?php
	if(!isset($_POST['wdate']))
	{
		$dates = array("Monday"=>date('d/m/Y',strtotime('previous week Monday')),"Tuesday"=>date('d/m/Y',strtotime('previous week Tuesday')),"Wednesday"=>date('d/m/Y',strtotime('previous week Wednesday')),"Thursday"=>date('d/m/Y',strtotime('previous week Thursday')),"Friday"=>date('d/m/Y',strtotime('previous week Friday')),"Saturday"=>date('d/m/Y',strtotime('previous week Saturday')),"Sunday"=>date('d/m/Y',strtotime('previous week Sunday')));
	}
	else
	{
		$dates = array("Monday"=>date('d/m/Y',strtotime("monday this week", strtotime($_POST['wdate']))),"Tuesday"=>date('d/m/Y',strtotime("tuesday this week", strtotime($_POST['wdate']))),"Wednesday"=>date('d/m/Y',strtotime("wednesday this week", strtotime($_POST['wdate']))),"Thursday"=>date('d/m/Y',strtotime("thursday this week", strtotime($_POST['wdate']))),"Friday"=>date('d/m/Y',strtotime("friday this week", strtotime($_POST['wdate']))),"Saturday"=>date('d/m/Y',strtotime("saturday this week", strtotime($_POST['wdate']))),"Sunday"=>date('d/m/Y',strtotime("sunday this week", strtotime($_POST['wdate']))));
		echo '<p>'.$_POST['wdate'].'</p>';
	}
 ?>
<form action="./reports.php#Weekly" method="post">
	<h3>Enter date to display report for that week:</h3>
	<input type="date" name="wdate" value="<?php if (isset($_POST['wdate'])){echo $_POST['wdate'];}else{echo date('Y-m-d',strtotime('today'));}?>"/>
	<input type="submit" value="Submit"/>
</form>
<h3>Weekly report for the week beginning with <strong><em>Monday <?php echo $dates["Monday"]; ?></em></strong></h3>
<table class='table table-striped table-hover'>
	<tr>
		<?php
			foreach ($dates as $d => $d_value)
			{
				echo '<th>'.$d.' '.$d_value.'</th>';
			}
		?>
		<th>Weekly total</th>
	</tr>
	<tr>
		<?php
			$query = "SELECT orders.order_date AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEARWEEK(orders.order_date, 1) = YEARWEEK(STR_TO_DATE('".$dates["Monday"]."', '%d/%m/%Y'), 1) GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
			$result = mysqli_query($conn, $query);
			$table = array();
			while ($row = @mysqli_fetch_assoc($result)){
				$table[] = $row;
			}
			$weektotal = 0;
			foreach ($dates as $d => $d_value)
			{
				$daytotal = 0;
				foreach($table as $tablerow)
				{
					if(date('d/m/Y', strtotime($tablerow['date'])) == $d_value)
					{
						$daytotal = $tablerow['totalsales'];
						break;
					}
				}
				echo '<td>$'.$daytotal.'</td>';
				$weektotal = $weektotal + $daytotal;
			}
		echo '<td>$'.$weektotal.'</td>';
		?>
	</tr>
</table>
