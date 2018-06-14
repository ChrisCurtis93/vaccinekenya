<?php

include("./modules/db.php");


Class DashBoard{
		public static function get_all_orders(){
		global $db;
		$get_orders=$db->GetArray("SELECT * FROM tb_orders where  waiting_type=1");

		?>

		<div class="material-datatables">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<!-- <th>#</th> -->
					
						<th><b>Order No</th>
						<th><b>Hospital Name</th>
						<th><b>Date of application</th>
						<th><b>Details</th>
						<th><b>Download Requestion form</th>
						<th><b>Process</th>	
					</tr>
				</thead>
				<tbody>	

		<?php
		
		foreach ($get_orders as $row) { ?>

		<tr>
					<td><?php echo $row['order_no']; ?> </td>
					<td><?php 
						$hospital_id=$row['hospital_id'];
						$hospital_name=$db->GetOne("SELECT hospital_name from tb_users_hospitals where hospital_id=$hospital_id");
						echo $hospital_name;
					?> </td>
					<td><?php echo $row['date_of_order']; ?> </td>
					<td><a class="label label-sm label-success" onclick="showAjaxModal('./modules/dashboard/order-details.php?order_id=<?php echo $row["order_id"] ?>')">details</a></td>
					
					<td><a class="label label-sm label-info" onclick="download_pdf('<?php echo $row["order_id"]; ?>')">download</a></td>
					 <td><a class="label label-sm label-danger" onclick="process_order('<?php echo $row["order_id"] ?>')">process</a></td>
						
					
				</tr>
			<?php	} ?>

				</tbody>
			</table>		

	<?php 	}

}

?>