<?php

include("./data/db.php");

Class Details{

	
	public static function get_all_orders($user_id){
		global $db;
		$get_orders=$db->GetArray("SELECT * FROM tb_orders where hospital_id=$user_id and waiting_type !=0");

		?>

		<div class="material-datatables">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<!-- <th>#</th> -->
					
						<th><b>Order No</th>
						<th><b>Date of application</th>
						<th><b>Details</th>
						<th><b>Requestion status</th>
					
						<!-- <th><b>Email</th>	 -->
					</tr>
				</thead>
				<tbody>	

		<?php
		
		foreach ($get_orders as $row) { ?>

		<tr>
					<td><?php echo $row['order_no']; ?> </td>
					<td><?php echo $row['date_of_order']; ?> </td>
					<td><a class="label label-sm label-success" onclick="showAjaxModal('./modules/dashboard/order-details.php?order_id=<?php echo $row["order_id"] ?>')">details</a></td>
					
					<td><?php 
						if($row["waiting_type"]=="1"){
							echo "pending order";
						}else{ ?>
							<a class="label label-sm label-danger" >processed order</a>
						<?php	//echo "processed order";
						}
							
					 ?> </td>
						
					
				</tr>
			<?php	} ?>

				</tbody>
			</table>		

	<?php 	}


	

}

?>