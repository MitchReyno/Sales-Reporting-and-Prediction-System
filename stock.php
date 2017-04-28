<?php
	$currentpage = "stock";
	include 'base.php';
?>

<?php startblock('title') ?>
	Stock
<?php endblock() ?>

<?php startblock('body') ?>
	<?php
		if (!$conn) {
			echo '<p>Could not connect to the database</p>';
		} else {
			$query = 'SELECT * FROM products ORDER BY product_id;';
			$result = @mysqli_query($conn, $query);
			if (!$result){
				echo '<p>No stock records found</p>';
			} else {
				echo '
					<h2>View current stock inventory:</h2>
					<fieldset>
						<input type="button" value="Change stock"/>
					</fieldset>
					';
				$emparray = array();
				while ($row = @mysqli_fetch_assoc($result)){
					$emparray[] = $row;


				}
				$new = json_encode($emparray);
				$new = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$new);
				echo '
					<table class="table table-striped table-hover" data-ng-init=\'data = '.$new.'\'>
						<tr>
							<th>Product ID</th>
							<th>Name</th>
							<th>Price/Unit</th>
							<th>Stock level</th>
							<th>Amount on order</th>
							<th>Amount available</th>
						</tr>
						<tr data-ng-repeat="d in data">
							<td>{{d.product_id}}</td>
							<td>{{d.product_name}}</td>
							<td>{{d.unit_price}}</td>
							<td>{{d.unit_in_stock}}</td>
							<td>{{d.unit_on_order}}</td>
							<td>{{d.recorded_level}}</td>
						</tr>
					';
				echo '
					</table>';
			}
		}
	?>

<?php endblock() ?>
