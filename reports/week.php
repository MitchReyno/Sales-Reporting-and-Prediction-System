<?php
	if(!isset($_POST['wdate']))
	{
		$dates = array("Monday"=>date('d/m/Y',strtotime('previous week Monday')),"Tuesday"=>date('d/m/Y',strtotime('previous week Tuesday')),"Wednesday"=>date('d/m/Y',strtotime('previous week Wednesday')),"Thursday"=>date('d/m/Y',strtotime('previous week Thursday')),"Friday"=>date('d/m/Y',strtotime('previous week Friday')),"Saturday"=>date('d/m/Y',strtotime('previous week Saturday')),"Sunday"=>date('d/m/Y',strtotime('previous week Sunday')));
	}
	else
	{
		$dates = array("Monday"=>date('d/m/Y',strtotime("monday this week", strtotime($_POST['wdate']))),"Tuesday"=>date('d/m/Y',strtotime("monday this week +1 day", strtotime($_POST['wdate']))),"Wednesday"=>date('d/m/Y',strtotime("monday this week +2 day", strtotime($_POST['wdate']))),"Thursday"=>date('d/m/Y',strtotime("monday this week +3 day", strtotime($_POST['wdate']))),"Friday"=>date('d/m/Y',strtotime("monday this week +4 day", strtotime($_POST['wdate']))),"Saturday"=>date('d/m/Y',strtotime("monday this week +5 day", strtotime($_POST['wdate']))),"Sunday"=>date('d/m/Y',strtotime("monday this week +6 day", strtotime($_POST['wdate']))));
	}
 ?>
<form action="./reports.php#Weekly" method="post">
	<h3>Enter date to display report for that week:</h3>
	<input type="date" name="wdate" value="<?php if (isset($_POST['wdate'])){echo $_POST['wdate'];}else{echo date('Y-m-d',strtotime('today'));}?>"/>
	<input type="submit" value="Submit"/>
</form>
<h3>Weekly report for the week beginning with <strong><em>Monday <?php echo $dates["Monday"]; ?></em></strong></h3>
<table class='table table-striped table-hover' id="weektable">
	<tr>
		<?php
			foreach ($dates as $d => $d_value)
			{
				echo '<th>'.$d.' '.$d_value.'</th>';
			}
		?>
		<th>Weekly total</th>
		<th>Predicted total sales for following week</th>
	</tr>
	<tr>
		<?php
			$query = "SELECT orders.order_date AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEARWEEK(orders.order_date, 1) = YEARWEEK(STR_TO_DATE('".$dates["Monday"]."', '%d/%m/%Y'), 1) GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
			$data = array();
			$result = mysqli_query($conn, $query);
			while ($row = @mysqli_fetch_assoc($result)){
				$data += [$row['date'] => $row['totalsales']];
			}
			$weektotal = 0;
			foreach ($dates as $d => $d_value)
			{
				$formatteddate = DateTime::createFromFormat('d/m/Y', $d_value)->format('Y-m-d');
				$formatteddate = (string)$formatteddate;
				$daytotal = 0;
				if(array_key_exists($formatteddate, $data))
				{
					$daytotal = $data[$formatteddate];
				}
				echo '<td>';
				if($daytotal == 0)
				{
					echo "-";
				}
				else
				{
					echo "$".number_format($daytotal, 2);
				}
				echo '</td>';
				$weektotal = $weektotal + $daytotal;
			}
		echo '<td>$'.number_format($weektotal, 2).'</td>';
		$newdate = str_replace('/', '-', $dates["Monday"]);
		$newdate = date('d-m-Y', strtotime($newdate.' + 1 week'));
		$query = "Select
  Week(orders.order_date) As date,
  Sum(products.unit_price * order_details.Quantity - order_details.Discount) As
  totalsales
From
  orders Inner Join
  order_details
	On order_details.Order_ID = orders.Order_ID Inner Join
  products
	On order_details.product_id = products.product_id
Where
 orders.order_date < Str_To_Date('".$newdate."',
  '%d-%m-%Y') and orders.order_date >= date_add(Str_To_Date('".$newdate."', '%d-%m-%Y'), interval- 4 week)
Group By
  YearWeek(orders.order_date, 1)
Order By
  orders.order_date
  desc limit 4;";
		$result = mysqli_query($conn, $query);
		$predictedamount = 0;
		$divisor = 0;
		while($row = @mysqli_fetch_assoc($result)){
			$predictedamount = $predictedamount + $row['totalsales'];
			$divisor = $divisor + 1;
		}
		if($divisor==0){
			$predictedamount = 0;
		} else {
			$predictedamount = $predictedamount / $divisor;
		}
		echo '<td id="predictedweek">$'.number_format($predictedamount, 2).'</td>';
		?>
	</tr>
</table>


<?php
	echo '<h3>Total weekly sales: $'.number_format($weektotal, 2).'</h3>';
?>
<fieldset>
	<p><input type="button" value="Convert to CSV" onclick="genWeekCSV()"/></p>
	<p><textarea readonly id="csvweekoutput" rows="4" cols="70"></textarea></p>
</fieldset>
