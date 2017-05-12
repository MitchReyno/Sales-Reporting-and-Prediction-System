<?php



function menu($currentpage, $username){


  echo '
  <ul class="nav nav-pills">
  <li';

  if ($currentpage == "home") echo ' class="active"';

  echo '><a href="./index.php">Home</a></li>
  <li';

  if ($currentpage == "sales") echo' class ="active"';

  echo '><a href="./sales.php">Sales Records</a></li>
  <li';

  if ($currentpage == "stock") echo' class ="active"';

  echo'><a href="./stock.php">Stock</a></li>
  <li class="dropdown';
	if ($currentpage == "reports") {echo' active';}
	echo '">
	  <a class="dropdown-toggle"';

	echo' data-toggle="dropdown" href="#">Reports<span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
	<li><a href="./reports.php#Weekly">Weekly</a></li>
	<li><a href="./reports.php#Monthly">Monthly</a></li>
	<li><a href="./reports.php#Annual">Annual</a></li>
	</ul>
  </li>';

  echo '<li';

  if ($currentpage == "suppliers") echo' class ="active"';

  echo'><a href="./suppliers_view.php">Suppliers</a></li>';

	if($_SESSION['loginuser'] == "admin"){
		echo '<li';

  if ($currentpage == "users") echo' class ="active"';

  echo'><a href="./users_view.php">Users</a></li>';
	}

  echo '
  <li class="dropdown" id="user-dropdown" >
   <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	  Hi '.$username.' <span class="caret"></span>
	</a>

	<ul class="dropdown-menu">
	<li><a href="admin_login.php">Admin login</a></li>
	<li class="divider"></li>
	<li><a href="logout.php">Log Out</a></li>
	</ul>
  </li>

  </ul>';
}
?>

<!-- <li class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
Settings <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="#">Configuration</a></li>
<li><a href="#">Preferences</a></li>
<li class="divider"></li>
<li><a href="#">About</a></li>
</ul>
</li>-->
