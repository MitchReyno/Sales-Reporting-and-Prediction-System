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
						<p><label for="product_id_search">Search by ID: </label><input type="text" name="product_id_search" ng-model="s.product_id" /></p>
						<p><label for="product_name_search">Search by Name: </label><input type="text" name="product_name_search" ng-model="s.product_name" /></p>
					</fieldset>
					';
				$emparray = array();
				while ($row = @mysqli_fetch_assoc($result)){
					$emparray[] = $row;


				}
				$new = json_encode($emparray);
				$new = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$new);
				$new = str_replace('"', "'", $new);
				echo '
					<table class="table table-striped table-hover" ng-init="data = '.$new.'">
						<tr>
							<th>Product ID</th>
							<th>Name</th>
							<th>Price/Unit</th>
							<th>Stock level</th>
							<th>Amount on order</th>
							<th>Amount available</th>
						</tr>
						<tr ng-repeat="d in data | filter: s">
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
