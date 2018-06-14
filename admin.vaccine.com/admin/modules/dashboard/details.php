<?php

include("../db.php");


Class Details{
			public static function get_order_items($order_id){

		global $db;

		$data=$db->GetArray("SELECT * FROM tb_order_items where order_id=$order_id");

		?>

			<div class="material-datatables">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<!-- <th>#</th> -->
					
						<th><b>Vaccine Name</th>
						<th><b>No of boxes ordered</th>
						<th><b>Date of order</b></th>
					</tr>
				</thead>
				<tbody>	

		<?php
		
		foreach ($data as $row) { ?>

		<tr>
					<td><?php
						$vaccine_id=$row["vaccine_id"];
						$vaccine_name=$db->GetOne("SELECT vaccine_name from tb_inventory_vaccines where vaccine_id='".$row["vaccine_id"]."'");
						echo $vaccine_name;
					 ?> </td>
					<td><?php echo $row['total_amount']; ?> </td>
					<td><?php 

						$date=$db->GetOne("select date_of_order from tb_orders where order_id=$order_id");
						echo $date; ?> </td>
				
					
				</tr>
			<?php	} ?>

				</tbody>
			</table>	
<?php 	}


public static function process_order($order_id){
	   global $db;
		$data['waiting_type']='2';

		$where_clause='order_id='.$order_id;
		$db->AutoExecute('tb_orders',$data,"UPDATE",$where_clause);

		$response["success"]=1;
		return json_encode($response);
}

}

?>