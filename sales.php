<?php
  $currentpage = "sales";
  include 'base.php';
?>

<?php startblock('title') ?>
  Sales Records
<?php endblock() ?>

<?php startblock('body')
?>
<script>
  function sales(){
	location.replace("add_sales.php");
  }
</script>
<?php
	if (!$conn) {
		echo '<p>Could not connect to the database</p>';
	} else {
		$query = 'SELECT * FROM orders ORDER BY order_id;';
		$result = @mysqli_query($conn, $query);
		if (!$result){
			echo '<p>No sales records found</p>';
		} else {
			echo'
						<h2>View current sales records:</h2>
						  <fieldset>
							<p><label for="order_id_search">Search by ID: </label><input type="text" name="order_id_search" ng-model="s.order_id" /></p>
						</fieldset>';
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
				  <th>ID</th>
				  <th>Order Date</th>
				  <th>Requested Date</th>
				  <th>Shipping Date</th>
				</tr>
				<tr ng-repeat="d in data | filter: s">
				  <td>{{d.Order_ID}}</td>
				  <td>{{d.order_date}}</td>
				  <td>{{d.req_date}}</td>
				  <td>{{d.shipping_date}}</td>
				</tr>

			</table>';
		}
	}
?>
<?php endblock() ?>
