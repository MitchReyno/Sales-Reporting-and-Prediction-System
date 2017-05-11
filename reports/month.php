<?php
	if(!isset($_POST['month']) || !isset($_POST['year']))
	{
		$month = date('n');
		$year = date('Y');
		$query = "SELECT DAY(orders.order_date) AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEAR(orders.order_date) = YEAR(CURDATE()) AND MONTH(orders.order_date) = MONTH(CURDATE()) GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
	}
	else
	{
		$month = date('n', strtotime($_POST['month']));
		$year = $_POST['year'];
		$query = "SELECT DAY(orders.order_date) AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEAR(orders.order_date) = ".$_POST['year']." AND MONTHNAME(test.orders.order_date) = '".$_POST['month']."' GROUP BY orders.order_date, YEARWEEK(orders.order_date, 1) ORDER BY orders.order_date;";
	}
 ?>
<form action="./reports.php#Monthly" method="post">
	<h3>Enter month to display report:</h3>
	<select name="month">
		<option value="January"<?php if($month==1){echo ' selected';}?>>Jan</option>
		<option value="February"<?php if($month==2){echo ' selected';}?>>Feb</option>
		<option value="March"<?php if($month==3){echo ' selected';}?>>Mar</option>
		<option value="April"<?php if($month==4){echo ' selected';}?>>Apr</option>
		<option value="May"<?php if($month==5){echo ' selected';}?>>May</option>
		<option value="June"<?php if($month==6){echo ' selected';}?>>Jun</option>
		<option value="July"<?php if($month==7){echo ' selected';}?>>Jul</option>
		<option value="August"<?php if($month==8){echo ' selected';}?>>Aug</option>
		<option value="September"<?php if($month==9){echo ' selected';}?>>Sep</option>
		<option value="October"<?php if($month==10){echo ' selected';}?>>Oct</option>
		<option value="November"<?php if($month==11){echo ' selected';}?>>Nov</option>
		<option value="December"<?php if($month==12){echo ' selected';}?>>Dec</option>
	</select>
	<select name="year"><?php
	 $currentYear = date('Y');

		foreach (range($currentYear, 1950) as $value) {
			echo "<option value=\"".$value."\"";
			if ($value == $year){echo " selected";}
			echo ">" . $value . "</option> ";

		}
?>
	</select>
	<input type="submit" value="Submit"/>
</form>
<h3>Monthly report for <?php echo "<em><strong>".date('F', mktime(0, 0, 0, $month, 10))." ".$year."</strong></em>"; ?></h3>

<table class='table table-striped table-hover' id="monthtable">
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
			$monthdata = array();
			while ($row = @mysqli_fetch_assoc($result)){
				$monthdata += [$row['date'] => $row['totalsales']];
			}
			$monthtotal = 0;
			for ($i = 1; $i < date('N', mktime(0, 0, 0, $month, 1, $year)); $i++)
			{
				echo '<td class="blank"></td>';
			}
			for($i = 1; $i <= date('t', $month); $i++)
			{
				$dailytotal = 0;
				if (array_key_exists($i, $monthdata))
				{
					$dailytotal = $monthdata[$i];
				}
				echo '<td><h5>'.$i.'</h5></br>
					<p>';
				if($dailytotal == 0)
				{
					echo "-";
				}
				else
				{
					$monthtotal = $monthtotal + $dailytotal;
					echo "$".number_format($dailytotal, 2);
				}
				echo '</p></td>';
				if (date('N' , mktime(0, 0, 0, $month, $i, $year)) == 7)
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
<?php
	echo '<h3>Total monthly sales: <span id="monthtotal">$'.number_format($monthtotal, 2).'</span></h3>';
?>
<fieldset>
	<p><input type="button" value="Convert to CSV" onclick=<?php echo '"genMonthCSV('.$month.','.$year.')"';?>/></p>
	<p><textarea readonly id="csvmonthoutput" rows="4" cols="70"></textarea></p>
</fieldset>

