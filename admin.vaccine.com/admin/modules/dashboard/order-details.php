<?php
	include('./details.php');
	@session_start();

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title"><b></h4>
					<h4 class="card-title" style="float: left;"><b></h4>
					<div class="row">
						<div class="col-md-12">
							<?php echo Details::get_order_items($_REQUEST["order_id"]); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>