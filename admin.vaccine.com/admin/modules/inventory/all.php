<?php
	include("./class.php");
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title"><b>
						<a onclick="showAjaxModalMd('./modules/inventory/add-new-vaccine.php')" 
						class="btn btn-primary col-md-2">Add New Vaccine</a>
					</h4>
					<h4 class="card-title" style="float: left;"><b></h4>
					<div class="row">
						<div class="col-md-12">
							<?php echo Inventory::get_all_vaccines(); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>