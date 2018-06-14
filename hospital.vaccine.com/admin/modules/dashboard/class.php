<?php

include("../../data/db.php");

Class Dashboard{

	public static function order_items($order_id){

		global $db;

		$get_vaccines=$db->GetArray("SELECT * FROM tb_inventory_vaccines WHERE active_status=1");

		foreach ($get_vaccines as $row) { ?>

			  <div class="col-lg-12">
                            <div class="card card-stats">
                               <!--  <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">grade</i>
                                </div> -->
                                <div class="card-content">
                                    <div class="input-group">
                                            <span class="input-group-addon">
                                              <!--   <i class="material-icons">lock_outline</i> -->
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label"><?php echo "Enter the total Number of ".$row["vaccine_name"] ?></label>

                                                <div class="row">
                                                	
                                                		  <input type="number" class="form-control" 
                                                		  id="<?php echo $row["vaccine_name"] ?>" name="<?php echo $row["vaccine_name"] ?>">
                                                		<a class="btn btn-success" onclick="add_to_order('<?php echo $order_id; ?>','<?php echo $row["vaccine_id"]; ?>','<?php echo $row["vaccine_name"] ?>')">Add To Order</a>
                                                	
                                                </div>
                                              

                                            </div>
                                        </div>
                                </div>
                               <!--  <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-danger">warning</i>
                                        <a href="#pablo"></a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
			
	<?php	}
	}

	public static function generate_order_number($user_id){
		global $db;

		$get_last_record=$db->GetOne("SELECT order_id from tb_orders order by order_id desc");
		if($get_last_record==null){
			$get_last_record="1";
		}else{
			$get_last_record +=1;
		}

		$new_order_number=$get_last_record."/".$user_id."/".date("m/Y");

		$data=array();
		$data["order_no"]=$new_order_number;
		$data["hospital_id"]=$user_id;

		$db->AutoExecute("tb_orders",$data,"INSERT");

		$json_data["order_id"]=$get_last_record;
		$json_data["order_no"]=$new_order_number;

		return json_encode($json_data);
	}

	public static function add_order_item($order_id,$vaccine_id,$input){
		global $db;
		$data=array();

		$data["order_id"]=$order_id;
		$data["vaccine_id"]=$vaccine_id;
		$data["total_amount"]=$input;
		$data["active_status"]="1";

		$db->AutoExecute("tb_order_items",$data,"INSERT");

		$response["success"]=1;
		return json_encode($response);
	}

	public static function view_order_items($order_id){
		global $db;
		
		$get_order_items=$db->GetArray("SELECT * FROM `tb_order_items` INNER join tb_inventory_vaccines ON tb_inventory_vaccines.vaccine_id=tb_order_items.vaccine_id WHERE tb_order_items.active_status=1 and tb_order_items.order_id=$order_id");
		foreach ($get_order_items as $row) { ?>

			
			 <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="delete_order_item('<?php echo $row["order_item_id"]; ?>')">
                      <i class="material-icons">close</i>
                  </button>
                  <span>
                      <b><?php echo $row["vaccine_name"]."<br>Boxes ordered:".$row["total_amount"];  ?> </span>
              </div>	
	<?php	}
	}

	public static function delete_order_item($order_item_id){
		global $db;
		$data['active_status']='0';

		$where_clause='order_item_id='.$order_item_id;
		$db->AutoExecute('tb_order_items',$data,"UPDATE",$where_clause);

		$response["success"]=1;
		return json_encode($response);
	}

	public static function get_order_details($order_id){
		global $db;
		$get_order_details=$db->GetRow("SELECT * FROM tb_orders WHERE order_id=$order_id");

		return json_encode($get_order_details);
	}

	public static function post_order($order_id){
		global $db;

		$data['waiting_type']='1';
		$data['date_of_order']=$db->GetOne('Select now();');
		$where_clause='order_id='.$order_id;

		$db->AutoExecute('tb_orders',$data,"UPDATE",$where_clause);

		$response["success"]=1;
		return json_encode($response);
	}

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
}

?>