<?php

include("../db.php");
global $db;

 $db->debug=0;


Class FormData{
	public static function hospital_name($orderId){

		global $db;
		$hospital_id=$db->GetOne("SELECT hospital_id FROM tb_orders WHERE order_id='".$orderId."'");

		$hospital_namea=$db->GetOne("SELECT hospital_name FROM tb_users_hospitals WHERE hospital_id=$hospital_id");

		return $hospital_namea;

	}
  public static function hospital_id($orderId){

    global $db;
    $hospital_id=$db->GetOne("SELECT hospital_id FROM tb_orders WHERE order_id='".$orderId."'");

    return $hospital_id;

  }

  public static function order_number($orderId){
      global $db;
    $order_no=$db->GetOne("SELECT order_no FROM tb_orders WHERE order_id='".$orderId."'");

    return $order_no;

  }

   public static function phone_number($hospital_id){

    global $db;
    $phone=$db->GetOne("SELECT hospital_phonenumber FROM tb_users_hospitals WHERE hospital_id='".$hospital_id."'");

    return $phone;

  }

  public static function person_in_charge($client_id){
      global $db;
      $client_name=$db->GetOne("SELECT person_in_charge_name FROM tb_users_hospitals WHERE hospital_id=$client_id");

      return $client_name;
  }

	public static function business_name($client_id){
		global $db;

		$biz_name=$db->GetOne("SELECT business_name FROM tb_users where user_id=$client_id");

		return $biz_name;
	}

  public static function payment_method($order_id){
      global $db;
        ?>
        <table>
          <tr>
            <th>Order No</th>
            <th>Transaction Type</th>
            <th>Transaction Code</th>
          </tr>
          <tbody>
          <tr>
            <td><?php echo $order_id; ?></td>
            <td><?php $type=$db->GetOne("SELECT transaction_type FROM `tb_app_sales` WHERE order_id='".$order_id."'");
                              echo $type; ?> </td>
            <td><?php $code=$db->GetOne("SELECT transaction_code FROM `tb_app_sales` WHERE order_id='".$order_id."'");
                              echo $code; ?> </td>
          <tr>
          </tbody>
        </table>

  <?php }

	public static function branch_name($orderId){
		global $db;
		$employee_id=$db->GetOne("SELECT employee_id FROM tb_app_orders WHERE order_no='".$orderId."'");
		$branch_id=$db->GetOne("SELECT outlet_posted FROM tb_employees WHERE id=$employee_id");

		$branch_name=$db->GetOne("SELECT tb_shop_name FROM tb_shops WHERE tb_shop_id=$branch_id");

		return $branch_name;

	}
	public static function cashier_name($orderId){
		global $db;
		$employee_id=$db->GetOne("SELECT employee_id FROM tb_app_orders WHERE order_no='".$orderId."'");
		$employee_name=$db->GetOne("SELECT employee_name FROM tb_employees WHERE id='".$employee_id."'");

		return $employee_name;

	}

	public static function get_order_items($order_id){

    global $db;

    $data=$db->GetArray("SELECT * FROM tb_order_items where order_id=$order_id");

    ?>

      <div>
      <table cellpadding="6">
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
      <?php } ?>

        </tbody>
      </table>  

     </div> 
<?php   }

	public static function payment_details($orderId){
		global $db;

		$results=$db->GetOne("SELECT * FROM tb_app_sales WHERE order_id='".$orderId."'");

		foreach ($results as $row) {

		}
	}

	public static function get_client_email($client_id){
		global $db;

		$email=$db->GetOne("SELECT email FROM tb_users where user_id=$client_id");

		return $email;
	}

  public static function get_discount_amount($order_id){
      global $db;
      $discount_amount=$db->GetOne("SELECT discount FROM tb_app_sales WHERE order_id='".$order_id."'");

      return $discount_amount;
  }
  public static function get_amount_total($order_id){
      global $db;
      $amount_total=$db->GetOne("SELECT amount_total FROM tb_app_sales WHERE order_id='".$order_id."'");

      return $amount_total;
  }

}

?>
