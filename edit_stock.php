<?php
$currentpage = "stock";
	  include 'base.php';
	  require_once("require.php");
	  $conn = mysqli_connect($servername, $username, $password, $database);
?>

<?php startblock('title') ?>
	Edit stock
<?php endblock() ?>



<?php startblock('body') ?>
	<?php


	  function sanitise_input($data) {
		 $data = trim($data);
		 $data = stripslashes($data);
		 $data = htmlspecialchars($data);
	   return $data;
	   }

	  if(isset($_POST["hidden"])){
		$num = $_POST["hidden"];
		$num1=sanitise_input($num);
		$num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
		$query1 = "select * from products where product_id ='$num1'";
		$result = mysqli_query($conn,$query1);
		$row = mysqli_fetch_assoc($result);
	  }else{
		$row['product_name'] = "-----";
		$row['unit_price'] = "-----";
		$row['unit_in_stock'] = "-----";
		$row['unit_on_order'] = "-----";
		  $row['recorded_level'] = "-----";
	  }

		if(isset($_POST["delete"]) && isset($_POST["hidden2"])){
		  $num = $_POST["hidden2"];
		  $num1=sanitise_input($num);
		  $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
		  $deleteQuery1 = "Delete from products where product_id ='$num1' ";
		  //$deleteQuery2="Delete from product_supplier where supplier_id ='$num1'";
		  $result2 = mysqli_query($conn,$deleteQuery1);
		  //$result3 = mysqli_query($conn,$deleteQuery2);
		  if($result2/* && $result3*/){
			echo "<h3>Product data has been dropped successfully!</h3>";
		  }
		}else{
		}

		 if(isset($_POST["update"]) && isset($_POST["hidden2"])
		   && isset($_POST["product_name"]) && isset($_POST["unit_price"]) && isset($_POST["unit_in_stock"]) && isset($_POST["unit_on_order"]) && isset($_POST["recorded_level"])){
		  $num = $_POST["hidden2"];
		  $num1=sanitise_input($num);
		  $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
		  $prodname = $_POST["product_name"];
		  $unitprice = $_POST["unit_price"];
		  $unitstock = $_POST["unit_in_stock"];
		  $unitonorder = $_POST["unit_on_order"];
		  $recordedlevel = $_POST["recorded_level"];
		  $deleteQuery1 = "UPDATE products SET product_name= '$prodname', unit_price='$unitprice', unit_in_stock ='$unitstock', unit_on_order = '$unitonorder', recorded_level = '$recordedlevel' where product_id ='$num1' ";

		  $result2 = mysqli_query($conn,$deleteQuery1);

		  if($result2){
			echo "<h3>Product data has been updated successfully!</h3>";
		  }else{
			echo "wrong";
		  }
		}else{
		}


	?>
	<div>
	  <form action="edit_stock.php" method="post">
	  <div class="row">
	   <div class="col-lg-6">
			  <h3>Stock Data</h3>
			<div class="row">
			  <div class="col-lg-6"><label for="prodname">Product name:</label>
			  </div>
			  <div class="col-lg-6">
			  <input type="text" name="product_name" id="prodname" value = "<?php  echo $row['product_name']; ?>"/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitprice">Unit price:</label></div>
			  <div class="col-lg-6"><input type="text" name="unit_price" id="unitprice" value = "<?php echo $row['unit_price']; ?>"/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitsinstock">Unit in stock:</label>
			  </div>
			  <div class="col-lg-6"><input type="text" name="unit_in_stock" id="unitsinstock" value = "<?php echo $row['unit_in_stock']; ?>"/>
			  </div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitonorder">Unit on order:</label></div>
			  <div class="col-lg-6"><input type="text" name="unit_on_order" id="unitonorder" value = "<?php echo $row['unit_on_order']; ?>"/>
			  </div>
			</div>
		   <div class="row">
			  <div class="col-lg-6"><label for="recordedlevel">Recorded level:</label></div>
			  <div class="col-lg-6"><input type="text" name="recorded_level" id="recordedlevel" value = "<?php echo $row['recorded_level']; ?>"/>
			  </div>
			</div>
			<div class="row">
			  <div class="col-lg-6">
				<div class="row">
				  <div class="col-lg-6">
					<input type="submit" name="update" class="btn btn-primary" value ="Edit stock"/>
				  </div>
				</div>
			  </div>
			  <div class="col-lg-6">
				<input type = 'hidden' name='hidden2' value = "<?php echo $num ?>" />
				<input type="submit" name="delete" class="btn btn-primary" value ="Delete stock"/>
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col-lg-6"></div>
		  <div class="col-lg-6">
			<?php

			  echo "<input type='button' class='btn btn-primary' onclick='back()' value='Back'/>";
			?>
		  </div>
		</div>
	  </form>
	</div>
<?php endblock() ?>
