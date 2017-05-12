<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,
								   initial-scale=1.0" />
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5
	  elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page
		via file:// -->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
  </head>
  <body class = "container">
	<script>
	  function supll(){
		location.replace("alter_users.php");
	  }
	</script>
	<h2> User details:</h2>
	<?php
	  $currentpage = "users";
	   include 'base.php';
	  require_once("require.php");
	$conn = mysqli_connect($servername, $username, $password, $database2);
	?>
	<?php
	  $query1 = "select * from login order by username";
	  $result = mysqli_query($conn , $query1);
	if($result){
	  echo"<div class='row'>";
	  echo"<div class='col-lg-12'>";
	  echo"<table class='table table-striped table-hover'>";
	  echo"<tr>"
		."<th >ID</th>"
		."<th >User Name</th>"
		."<th >Password</th>"
		."<th >Edit</th>"
		."</tr>";
	  while($row = mysqli_fetch_assoc($result)){
		echo"<form method = 'post' action = 'alter_users.php'>";
		echo"<tr>";
		echo"<td>",$row["id"],"</td>";
		echo"<td>",$row["username"],"</td>";
		echo"<td>",$row["password"],"</td>";
		echo"<td><button type = 'submit' class='btn btn-primary '>Edit</button></td>";
		echo"<td><input type = 'hidden' name='hidden0' value = " . $row["username"] . "/></td>";
		echo"<td><input type = 'hidden' name='hidden1' value = " . $row["password"] . "/></td>";
		echo"<td><input type = 'hidden' name='id' value = " . $row["id"] . "/></td>";
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

  </body>
</html>
