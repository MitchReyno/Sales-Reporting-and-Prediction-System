<?php
	 $currentpage = "stock";
	   include 'base.php';
	  require_once("require.php");
	$conn = mysqli_connect($servername, $username, $password, $database);
?>

<?php startblock('title') ?>
	Add stock
<?php endblock() ?>

<?php startblock('body') ?>
	<script>
	  function back(){
		location.replace("stock.php");
	  }
	</script>
	<?php

	$button = false;
	?>
	<div>
	  <form action="add_stock.php" method="post">
	  <div class="row">
	   <div class="col-lg-6">
			  <h3>Product data</h3>
			<div class="row">
			  <div class="col-lg-6"><label for="prodname">Product name:</label>
			  </div>
			  <div class="col-lg-6">
			  <input type="text" name="prodname" id="prodname" required/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitprice">Price per unit</label></div>
			  <div class="col-lg-6"><input type="text" name="unitprice" id="unitprice" required/></div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitinstock">Unit in stock:</label>
			  </div>
			  <div class="col-lg-6"><input type="text" name="unitinstock" id="unitinstock" required/>
			  </div>
			</div>
			<div class="row">
			  <div class="col-lg-6"><label for="unitonorder">Unit on order:</label></div>
			  <div class="col-lg-6"><input type="text" name="unitonorder" id="unitonorder" required/>
			  </div>
			</div>
		   <div class="row">
			  <div class="col-lg-6"><label for="recordedlevel">Recorded level:</label></div>
			  <div class="col-lg-6"><input type="text" name="recordedlevel" id="recordedlevel" required/>
			  </div>
			</div>
			  <button type="submit" class="btn btn-primary "> Submit </button>
			  <button type="reset" class="btn btn-primary "> Reset </button>
		  </div>
		</div>
		<div class="row">
		  <div class="col-lg-6"></div>
		  <div class="col-lg-6">
			<?php
			if(!$button)
			  echo "<input type='button' class='btn btn-primary' onclick='back()' value='Back'/>";
			?>
		  </div>
		</div>
	  </form>
	</div>
	<div>
	  <?php
	  if(isset($_POST["product_name"])&&isset($_POST["unit_price"])&&isset($_POST["unit_in_stock"])&&isset($_POST["unit_on_order"])&&isset($_POST["recorded_level"])){
		$idquery = "Select product_id from products order by product_id DESC LIMIT 1";
		$lastidsup = mysqli_query($conn,$idquery);
		$rownum1 = mysqli_fetch_assoc($lastidsup);
		$lastIDsup = $rownum1["product_id"];

		$newIDsup = $lastIDsup + 1;

		$prodname=$_POST["product_name"];
		$unitprice=$_POST["unit_price"];
		$unitinstock=$_POST["unit_in_stock"];
		$unitonorder=$_POST["unit_on_order"];
		  $recordedlevel=$_POST["recorded_level"];

		$query1forsup = "INSERT INTO products (product_id, product_name, unit_price, unit_in_stock, unit_on_order, recorded_level) VALUES('$newIDsup','$prodname','$unitprice','$unitinstock','$unitonorder','$recordedlevel')";

		$result1 = mysqli_query($conn,$query1forsup);

		if($result1){
		  echo "<h2>New product has been added successfully!</h2>";

		}
	  }
	  ?>
	</div>
<?php endblock() ?>
