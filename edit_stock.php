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
		   && isset($_POST["prodname"]) && isset($_POST["unitprice"]) && isset($_POST["unitstock"]) && isset($_POST["unitonorder"]) && isset($_POST["recordedlevel"])){
		  $num = $_POST["hidden2"];
		  $num1=sanitise_input($num);
		  $num1 = preg_replace('/[^A-Za-z0-9\-]/', '', $num1);
		  $prodname = $_POST["prodname"];
		  $unitprice = $_POST["unitprice"];
		  $unitstock = $_POST["unitstock"];
		  $unitonorder = $_POST["unitonorder"];
		  $recordedlevel = $_POST["recordedlevel"];
		  $deleteQuery1 = "UPDATE products SET prodname= '$prodname', unitprice='$unitprice', unitstock ='$unitstock', unitonorder = '$unitonorder', recordedlevel = '$recordedlevel' where product_id ='$num1' ";

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
			  <input type="text" name="prodname" id="prodname" value = "<?php  echo $row['product_name']; ?>"/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitprice">Unit price:</label></div>
			  <div class="col-lg-6"><input type="text" name="unitprice" id="unitprice" value = "<?php echo $row['unit_price']; ?>"/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitstock">Unit in stock:</label>
			  </div>
			  <div class="col-lg-6"><input type="text" name="address" id="address" value = "<?php echo $row['address']; ?>"/>
			  </div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitonorder">Unit on order:</label></div>
			  <div class="col-lg-6"><input type="text" name="unitonorder" id="unitonorder" value = "<?php echo $row['unitonorder']; ?>"/>
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
