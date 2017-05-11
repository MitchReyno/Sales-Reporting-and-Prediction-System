<?php
	if(!isset($_POST['yyear']))
	{
		$year = date('Y');
	}
	else
	{
		$year = $_POST['yyear'];
	}
 ?>
<form action="./reports.php#Annual" method="post">
	<h3>Enter year to display report:</h3>
	<select name="yyear">
		<?php
			foreach (range(date('Y'), 1950) as $value) {
					echo "<option value=\"".$value."\"";
					if ($value == $year){echo " selected";}
					echo ">" . $value . "</option> ";
			}
		?>
	</select>
	<input type="submit" value="Submit"/>
</form>
<h3>Annual report for <em><strong><?php echo $year; ?></strong></em></h3>
<table class='table table-striped table-hover' id='yeartable'>
	<tr><th>Month</th><th>Total sales amount</th></tr>
	<?php
	$query = "SELECT MONTH(orders.order_date) AS date, SUM(products.unit_price * order_details.Quantity - order_details.Discount) AS totalsales FROM orders INNER JOIN order_details ON order_details.Order_ID = orders.Order_ID INNER JOIN products ON order_details.product_id = products.product_id
WHERE YEAR(orders.order_date) = ".$year." GROUP BY MONTH(orders.order_date) ORDER BY orders.order_date;";
	$result = mysqli_query($conn, $query);
	$monthsales = array();

	while($row = @mysqli_fetch_assoc($result))
	{
		$monthsales += [$row['date'] => $row['totalsales']];
	}
	$annualsales = 0;
	for($i = 1; $i <= 12; $i++)
	{
		echo '<tr><td>';
		echo date('F', mktime(0, 0, 0, $i, 1, $year));
		echo '</td><td>';
		if(array_key_exists($i, $monthsales)){
			echo "$".number_format($monthsales[$i], 2);
			$annualsales += $monthsales[$i];
		} else
		{
			echo "-";
		}
		echo '</td></tr>';
	}
	?>
</table>
<?php
	echo '<h3>Total annual sales: <span id="yeartotal">$'.number_format($annualsales, 2).'</span></h3>';
$query = "Select
  year(orders.order_date) as year,
  Sum(products.unit_price * order_details.Quantity - order_details.Discount) As
  totalsales
From
  orders Inner Join
  order_details
	On order_details.Order_ID = orders.Order_ID Inner Join
  products
	On order_details.product_id = products.product_id
Where
  orders.order_date < Str_To_Date('01-01-".($year+1)."', '%d-%m-%Y') and orders.order_date >= date_add(Str_To_Date('01-01-".($year+1)."', '%d-%m-%Y'), interval- 4 year)
Group By
 Year(orders.order_date)
Order By
  year Desc
Limit 4";
		$result = mysqli_query($conn, $query);
		$predictedamount = 0;
		$divisor = 0;
		while($row = @mysqli_fetch_assoc($result)){
			$predictedamount = $predictedamount + $row['totalsales'];
			$divisor = $divisor +1;
		}
		if($divisor==0){
			$predictedamount = 0;
		} else {
			$predictedamount = $predictedamount / $divisor;
		}
		echo '<h3 id="predictedyear">Predicted sales for following year: $'.number_format($predictedamount,2).'</h3>';
?>
<fieldset>
	<p><input type="button" value="Convert to CSV" onclick=<?php echo '"genYearCSV('.$year.')"';?>/></p>
	<p><textarea readonly id="csvyearoutput" rows="4" cols="70"></textarea></p>
</fieldset>
