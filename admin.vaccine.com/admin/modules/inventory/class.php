<?php

include("../../data/db.php");

Class Inventory{

	public static function get_all_vaccines(){
		global $db;

		$data=$db->GetArray("SELECT * FROM tb_inventory_vaccines WHERE active_status=1");

		?>

		<div class="material-datatables">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<th>#</th>
					
						<th><b>Vaccine Name</th>
						<th><b>Current Inventory</th>
						<th><b>Update Inventory</th>
							
					</tr>
				</thead>
				<tbody>	
		<?php 
				foreach ($data as $row) { ?>

				<tr>
					<td><?php echo $row['vaccine_id']; ?> </td>
					<td><?php echo $row['vaccine_name']; ?> </td>	
					<td><?php echo Inventory::get_stock_count($row['vaccine_id']); ?> </td>	
				</tr>
			<?php	} ?>

				</tbody>
			</table>
	
<?php	}

 public static function get_stock_count($vaccine_id){
 	global $db;
 	$stock_in=$db->GetOne("SELECT SUM(quantity_moved) as total from tb_inventory_stocks_in where vaccine_id=$vaccine_id");
 	$stock_out=$db->GetOne("SELECT SUM(quantity_moved) as total from tb_inventory_stocks_out where vaccine_id=$vaccine_id");

 	if($stock_out==null){
 		$stock_out=0;
 	}

 	return $stock_in-$stock_out;
 }
}

?>