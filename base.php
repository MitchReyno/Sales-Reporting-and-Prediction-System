<?php
	require_once 'ti.php';
	$username = "User";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>People Health Pharmacy -
		<?php startblock('title') ?><?php endblock() ?>
	</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,
								   initial-scale=1.0" />
	<link href="css/base.css" rel="stylesheet" />
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
		<header>
			<a href="./index.php">
			<img id="banner" src="http://www.nationalcollegeofpharmacy.org/images/banner.jpg" alt="People Health Pharmacy"/>
				<h1>People Health Pharmacy</h1></a>
			<?php include "menu.php";
				menu($currentpage, $username);
			?>
		</header>
		<section>
			<?php startblock('body') ?>

			<?php endblock() ?>
		</section>
		<!-- jQuery - required for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- All Bootstrap plug-ins file -->
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
