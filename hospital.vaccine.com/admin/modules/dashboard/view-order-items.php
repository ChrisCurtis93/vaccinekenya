<?php

include('./class.php');


?>
<script type="text/javascript">
	$('#back_to_vaccines').show();
</script>
<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 ">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title"></h4>
					 <a class="btn btn-info" style="float: right;" onclick="post_order_details('<?php echo $_REQUEST["order_id"]; ?>')">Post Order</a>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-3">
                                    <div class="card-content">

                                    	<?php
                                    	$url='./modules/dashboard/create-order.php?order_id='.$_REQUEST['order_id'];
                                    	?>

					  					<a class="btn btn-danger" style="float: right;margin-bottom: 20px;" onclick="view_more_modal_details('<?php echo $url; ?>')" id="back_to_vaccines">Back</a>	<br><br><br>
                                     <?php echo Dashboard::view_order_items($_REQUEST['order_id']); ?>
                                    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>