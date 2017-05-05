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
		<h3>Weekly Reports</h3>
		<p>Some content.</p>
	  </div>
	  <div id="Monthly" class="tab-pane fade">
		<h3>Monthly Reports</h3>
		<p>Some content in menu 1.</p>
	  </div>
	  <div id="Annual" class="tab-pane fade">
		<h3>Annual Reports</h3>
		<p>Some content in menu 2.</p>
	  </div>
	</div>
	<fieldset>
		<input type="button" value="Convert to CSV"/>
	</fieldset>
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
<?php endblock() ?>
