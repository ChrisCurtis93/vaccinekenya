<!DOCTYPE html>
<html lang="en">
<?php
	@session_start();
	$userid = $_SESSION['user']['userid'];
	$log = $_SESSION['user']['log'];
	if ($log != "log"){
		@header ("Location: log");
	}
	require_once("./css.php"); 
	require_once("./data/class.php"); 
?>
<header>

</header>
<body>
    <div class="wrapper">
		<?php require_once("./navbar.php"); ?>
		<div class="main-panel">
			<?php require_once("./header.php"); ?>
			<div class="content" id="container">
                <?php require_once("modules/dashboard/index.php"); ?>
			</div>
			<?php require_once("./modal.php"); ?>
			<?php require_once("./modal-md.php"); ?>
			<!-- <?php require_once("./footer.php"); ?> -->
			
		</div>
	</div>
	
</body>
<?php require_once("./js.php"); ?>
<script type="text/javascript">
	function open_module(path){
		 var myDiv=document.getElementById('container');
		// perfectScrollbar('#this_header');
		$("#container").html('<div style="text-align:center;margin-top:200px;"><img src="assets/img/70.gif" style="height: 80px; weight: 80px;" /> </div>');
		var promise=Smartjax.ajax({
			url: path,
			data:{ },
			type: 'POST',
			force:true,
			store: false,
		});
		promise.then(function (apiResult) {
			$("#container").html(apiResult)
		},function(){
			$("#container").html("failed!!");
		})
	}
							
	function showAjaxModal(url){
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/img/70.gif" style="height: 80px; weight: 80px;" /> </div>');		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});			
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response){
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}

	function showAjaxModalMd(url){
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax_md .modal-body').html('<div style="text-align:center;margin-top:200px; float:center;"><img src="assets/img/70.gif" style="height: 80px; weight: 80px;" /> </div>');		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax_md').modal('show', {backdrop: 'true'},'center');			
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response){
				jQuery('#modal_ajax_md .modal-body').html(response);
			}
		});
	}
	function refreshModule(path){
		$("#graphContainer").html('<div style="text-align:center;margin-top:200px;"><img src="assets/img/70.gif" style="height: 80px; weight: 80px;" /> </div>');
		var promise=Smartjax.ajax({
			url: path,
			data:{ },
			type: 'POST',
			force:true,
			store: false,
		});
		promise.then(function (apiResult) {
			$("#graphContainer").html(apiResult)
		},function(){
			$("#graphContainer").html("failed!!");
		})
	}

	function refreshTwice(path){
		$("#graphContainer").html('<div style="text-align:center;margin-top:200px;"><img src="assets/img/70.gif" style="height: 80px; weight: 80px;" /> </div>');
		var promise=Smartjax.ajax({
			url: path,
			data:{ },
			type: 'POST',
			force:true,
			store: false,
		});
		promise.then(function (apiResult) {
			$("#graphContainer").html(apiResult)
			refreshModule(path);
		},function(){
			$("#graphContainer").html("failed!!");
		})
	}

	function view_more_modal_details(url){
		$.ajax({
			url: url,
			success: function(response){
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	
</script>

<input id="branchValue" value="" hidden></input>
</html>