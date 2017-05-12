<?php
  $currentpage = "sales";
  include 'base.php';
require_once("require.php");
  $conn = mysqli_connect($servername, $username, $password, $database);
?>

<?php startblock('head') ?>
	Edit sales
<?php endblock() ?>


<?php startblock('body') ?>

<form method="post" action="edit.php">
   <?php if (!$conn) {
	echo '<p>Could not connect to the database</p>';
  } else {

  echo"connected to database";

  if(isset($_GET['id'])){
	  $id = $_GET['id'];
	  echo"<p>ID",$id,"</p>";

	$query = "SELECT order_date,req_date,shipping_date FROM orders WHERE Order_ID=".$id;
	  $result = mysqli_query($conn, $query);
	  if (!$result){
		echo '<p>No sales records found</p>';
	  } else {
	  $row = mysqli_fetch_assoc($result);
	  }
  }
}

	?>
  <p><label for="orderdate"><strong>Order Date</strong></label>
		<input type="date" name="orderdate" value="<?php echo $row['order_date'];?>"  />
	</p>

	<p><label for="reqdate"><strong>Request Date</strong></label>
		  <input type="date" name="reqdate" value="<?php echo $row['req_date' ];?>"/>
	</p>

	<p><label for="shipdate"><strong>Shipping Date</strong></label>
		  <input type="date" name="shipdate" value="<?php echo $row['shipping_date'];?>"/>
	</p>

  <button type="submit" class="btn btn-primary "> Submit Order</button>
</form>
<?php

  if(isset($_GET['id'])){
	  $id = $_GET['id'];
	  echo"<p>ID",$id,"</p>";


	  if(!$conn){
	  echo "Problem with data base! Check back later!";
	}else{
	  echo "connected to database";

	  $errMsg=" \n";
	   function sanitise_input($data) {
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
	   return $data;
	   }

   if(isset($_POST["orderdate"])&&isset($_POST["reqdate"])&&isset($_POST["shipdate"])){



			  $orderdate=$_POST["orderdate"];
			  $reqdate=$_POST["reqdate"];
			  $shipdate=$_POST["shipdate"];

			  $orderdate=sanitise_input($orderdate);
			  $reqdate=sanitise_input($reqdate);
			  $shipdate=sanitise_input($shipdate);


	 $query1 =
		 "UPDATE orders SET order_date='$orderdate',req_date='$reqdate',shipping_date='$shipdate' where Order_ID = ".$id;
	  $result1 = mysqli_query($conn, $query1);

	 if ($result1){
	  echo"sucess";
	  header("location:sales.php");
		}else{
		echo"error";

	 }
		}
  }
  }

  ?>
<?php endblock() ?>
