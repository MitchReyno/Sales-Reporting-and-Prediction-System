<?php
	$currentpage = "home";
	include 'base.php';
?>

<?php startblock('title') ?>
	Suppliers
<?php endblock() ?>


<?php startblock('body') ?>
	<script>
	  function supll(){
		location.replace("add_suppliers.php");
	  }
	</script>
	<h2>View Supplier details:</h2>
	<div class="row">
	  <div class="col-lg-12">
		<fieldset>
		  <input type="button" class="btn btn-primary" onclick="supll()" value="Add Suppliers" name = "addssups"/>
		</fieldset>
	  </div>
	</div>
	<?php
	  $currentpage = "suppliers";
	   //include 'base.php';
	  require_once("require.php");
	$conn = mysqli_connect($servername, $username, $password, $database);
	?>
	<?php
	  $query1 = "select * from suppliers order by company_name Limit 30";
	  $result = mysqli_query($conn , $query1);
	if($result){
	  echo"<div class='row'>";
	  echo"<div class='col-lg-12'>";
	  echo"<table class='table table-striped table-hover'>";
	  echo"<tr>"
		."<th >Supplier ID</th>"
		."<th >Company Name</th>"
		."<th >Contact Number</th>"
		."<th >Address</th>"
		."<th >City</th>"
		."<th >Edit</th>"
		."</tr>";
	  while($row = mysqli_fetch_assoc($result)){
		echo"<form method = 'post' action = 'edit_sup.php'>";
		echo"<tr>";
		echo"<td>",$row["supplier_id"],"</td>";
		echo"<td>",$row["company_name"],"</td>";
		echo"<td>",$row["contact_num"],"</td>";
		echo"<td>",$row["address"],"</td>";
		echo"<td>",$row["city"],"</td>";
		echo"<td><button type = 'submit' class='btn btn-primary '>Edit</button></td>";
		echo"<td><input type = 'hidden' name='hidden' value = " . $row["supplier_id"] . "/></td>";
		echo"</tr>";
		echo"</form>";
	  }
	  echo "</table>";
	  echo "</div>";
	  echo "</div>";
	}else{
	  echo "Wrong with the query!";
	}




	?>
<?php endblock() ?>
