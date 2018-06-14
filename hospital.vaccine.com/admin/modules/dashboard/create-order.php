<?php

include("./class.php");

@session_start();

if(!isset($_REQUEST['order_id'])){
	$order_details=json_decode(Dashboard::generate_order_number($_SESSION["user"]["userid"]));

}else{
	$order_details=json_decode(Dashboard::get_order_details($_REQUEST['order_id']));
}

//echo Dashboard::order_items();

?>




<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 ">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title">New Order<br>Order No:<?php echo $order_details->{'order_no'} ?></h4>
					<?php
						$order_id=$order_details->{'order_id'};
						$url='./modules/dashboard/view-order-items.php?order_id='.$order_id;
					?>
					 <a class="btn btn-info" style="float: right;" onclick="view_more_modal_details('<?php echo $url; ?>')" id="back_to_vaccines">View Order Items</a>

					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-3">
                                    <div class="card-content">
                                      <?php echo Dashboard::order_items($order_details->{'order_id'}); ?> 
                                   
                                    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>