<?php
	if(!isset($_POST['month']) || !isset($_POST['year']))
	{
		$month = date('n');
		$year = date('Y');
		echo $month;
		$query = "SELECT orders.order_date AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEAR(orders.order_date) = YEAR(CURDATE()) AND MONTH(orders.order_date) = MONTH(CURDATE()) GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
	}
	else
	{
		$month = date('n', strtotime($_POST['month']));
		$year = $_POST['year'];
		$query = "SELECT orders.order_date AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEAR(orders.order_date) = ".$_POST['year']." AND MONTHNAME(test.orders.order_date) = '".$_POST['month']."' GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
	}
 ?>
<form action="./reports.php#Monthly" method="post">
	<h3>Enter date to display report for that week:</h3>
	<select name="month">
		<option value="January">Jan</option>
		<option value="February">Feb</option>
		<option value="March">Mar</option>
		<option value="April">Apr</option>
		<option value="May">May</option>
		<option value="June">Jun</option>
		<option value="July">Jul</option>
		<option value="August">Aug</option>
		<option value="September">Sep</option>
		<option value="October">Oct</option>
		<option value="November">Nov</option>
		<option value="December">Dec</option>
	</select>
	<select name="year"><?php
	 $currentYear = date('Y');
		foreach (range($currentYear, 1950) as $value) {
			echo "<option value=\"".$value."\">" . $value . "</option> ";

		}
?>
	</select>
	<input type="submit" value="Submit"/>
</form>
<h3>Weekly report for the week beginning with Monday </h3>

<table class='table table-striped table-hover'>
	<tr>
		<th>Monday</th>
		<th>Tuesday</th>
		<th>Wednesday</th>
		<th>Thursday</th>
		<th>Friday</th>
		<th>Saturday</th>
		<th>Sunday</th>
	</tr>
	<tr>
		<?php
		$result = mysqli_query($conn, $query);
			for ($i = 1; $i < date('N', mktime(0, 0, 0, date('n', $month), 1, $year)); $i++)
			{
				echo '<td></td>';
			}
			for($i = 1; $i <= date('t', $month); $i++)
			{
				echo '<td><em>'.$i.'</em>
					<p>';
				echo '</p></td>';
				if (date('N' , mktime(0, 0, 0, date('n', $month), $i, $year)) == 7)
				{
					echo '</tr>';
					if ($i != date('t', $month))
					{
						echo '<tr>';
					}
				}
			}
		?>
	</tr>
</table>
