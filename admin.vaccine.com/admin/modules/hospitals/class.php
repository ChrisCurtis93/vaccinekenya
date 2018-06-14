<?php

include("../../data/db.php");

Class hospitals{

	public static function get_all_hospitals(){
		global $db;

		$data=$db->GetArray("SELECT * FROM tb_users_hospitals WHERE active_status=1");

		?>
		<div class="material-datatables">
			<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
				<thead>
					<tr>
						<th>#</th>
					
						<th><b>Hospital Name</th>
						<th><b>County</th>
						<th><b>Person In Charge</th>
						<th><b>Phone</th>
						<th><b>Email</th>	
					</tr>
				</thead>
				<tbody>	
		<?php 
				foreach ($data as $row) { ?>

				<tr>
					<td><?php echo $row['hospital_id']; ?> </td>
					<td><?php echo $row['hospital_name']; ?> </td>
					<td><?php 
						$county_name=$db->GetOne("SELECT county_name FROM tb_counties WHERE 
							county_id=".$row['hospital_county']);
						echo $county_name;
					 ?> </td>
					
					<td><?php echo $row['person_in_charge_name']; ?> </td>
					<td><?php echo $row['hospital_phonenumber']; ?> </td>
					<td><?php echo $row['hospital_email']; ?> </td>	
				</tr>
			<?php	} ?>

				</tbody>
			</table>
	

<?php	}
}

?>