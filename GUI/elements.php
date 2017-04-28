<?php
	function head($title, $script){

		if ($title) {
			$title = ' - '.$title;
		}
		echo '

			<!-- meta tags -->
			<meta charset="UTF-8" />
			<meta name="description" content="A website for managing sales for People Health Pharmacy" />
			<meta name="keywords" content="People Health Pharmacy, Sales, Stock keeping" />
			<meta name="author" content="DP2 Group" />

			<title>People Health Pharmacy'.$title.'</title>

			<link href="styles/style.css" rel="stylesheet" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<!-- HTML5 shiv and respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: respond.js doesnt work if you view this page via file:// -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.min.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
			';

		if ($script){
			echo '<script src="scripts/'.$script.'.js"></script>';
		}

	};

	function headerelement(){
		echo '	<header>
					<nav>
						<a href="./index.php">Home</a>
						<a href="./index.php">Home</a>
						<a href="./index.php">Home</a>
						<a href="./index.php">Home</a>
					</nav>
				</header>';
	}

	function bootend(){
		echo '<!-- jQuery - required for Bootstraps JavaScript plugins) -->
		<script src="js/jquery.min.js"></script>
		<!-- Bootstrap plug-in file -->
		<script src="js/bootstrap.min.js"></script>';
	}

?>
