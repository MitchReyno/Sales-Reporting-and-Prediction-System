<?php
	$currentpage = "reports";
	include 'base.php';
?>

<?php startblock('title') ?>
	Stock
<?php endblock() ?>

<?php startblock('body') ?>
<h2>View reports:</h2></br>
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#Weekly">Weekly</a></li>
		<li><a data-toggle="tab" href="#Monthly">Monthly</a></li>
		<li><a data-toggle="tab" href="#Annual">Annual</a></li>
	</ul>

	<div class="tab-content">
	  <div id="Weekly" class="tab-pane fade in active">
		<?php include 'reports/week.php'; ?>
	  </div>
	  <div id="Monthly" class="tab-pane fade">
		<?php include 'reports/month.php'; ?>
	  </div>
	  <div id="Annual" class="tab-pane fade">
		<?php include 'reports/year.php'; ?>
	  </div>
	</div>
	<script>
	function load(){

	var url = document.location.toString();
	if (url.match('#')) {
		$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show')
	}

	//Change hash for page-reload
	$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').on('shown', function (e) {
		window.location.hash = e.target.hash;
	});
	}
	window.onload = load;
	window.onhashchange = load;
</script>
<script src="./js/csvgenerate.js"></script>
<?php endblock() ?>
