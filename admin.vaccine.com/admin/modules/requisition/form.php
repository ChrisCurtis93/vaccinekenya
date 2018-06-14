<?php

include("../db.php");

include("./class.php");
Class Mail{
		public static function mailer($order_id,$reciever_email,$file_name){

		$obj=json_decode($file_name);
		$name        = FormData::client_name(FormData::client_id($order_id));;
		$email       =	$reciever_email;
		$to          = "<$email>";
		$from        = FormData::get_client_email(FormData::client_id($order_id));
		$subject     = "Purchase Invoice";
		$mainMessage = "This is an email for order no:".$order_id;
		$fileatt     = $obj->{'file_name'};
		$fileatttype = "application/pdf";
		$fileattname = FormData::business_name(FormData::client_id($order_id)).'-'.$obj->{'time'}.'.pdf';;
		$headers = "From: $from";
		// File
		$file = fopen($fileatt, 'rb');
		$data = fread($file, filesize($fileatt));
		fclose($file);
		// This attaches the file
		$semi_rand     = md5(time());
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
		$headers      .= "\nMIME-Version: 1.0\n" .
		"Content-Type: multipart/mixed;\n" .
		" boundary=\"{$mime_boundary}\"";
		$message = "This is a multi-part message in MIME format.\n\n" .
		"-{$mime_boundary}\n" .
		"Content-Type: text/plain; charset=\"iso-8859-1\n" .
		"Content-Transfer-Encoding: 7bit\n\n" .
		$mainMessage  . "\n\n";
		$data = chunk_split(base64_encode($data));
		$message .= "--{$mime_boundary}\n" .
		"Content-Type: {$fileatttype};\n" .
		" name=\"{$fileattname}\"\n" .
		"Content-Disposition: attachment;\n" .
		" filename=\"{$fileattname}\"\n" .
		"Content-Transfer-Encoding: base64\n\n" .
		$data . "\n\n" .
		"-{$mime_boundary}-\n";
		// Send the email
		if(mail($to, $subject, $message, $headers)) {
			$response['success']=1;
		   $response['mail_status']="email has been sent";
		}
		else {
			$response['success']=0;
		    $response['mail_status']="email not sent";
		}

	}

	public static function generate_pdf($order_id){
		 global $db;
       	 ob_start();

       	 date_default_timezone_set('Africa/Nairobi');

       	 ?>
       	 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin: 50px;
     margin-right: 50px;



}


td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

.hea{
		margin-top: 20px;
		border: 1px;
    margin-left: 50px;
}

.orders{
 margin-left: 40%;
 /* margin-top: 20px; */
 float:center;
}
.balances{

    float: left;
    margin-left: 50px;
}

.total_tables{
  margin-left: 50%;
	  float: left;
}
.info_table{
	margin-left: 3%;
	margin-top: 3%;
	 float: left;
	 font-family: arial, sans-serif;
	 border-collapse: collapse;
	 width: 40%;
}
.info_table .td{
	border: 1px solid #ffffff;
	text-align: left;
	padding: 8px;
}
</style>


       	 <div>

					 <table class="info_table">
						 	<tr><td>HOSPITAL NAME: <?php echo FormData::hospital_name($order_id); ?></td></tr>
							<tr><td>DATE OF TODAY: <?php echo date('d-M-Y'); ?></td></tr>
							<tr><td>Person in charge: <?php echo FormData::person_in_charge(FormData::hospital_id($order_id)); ?></td></tr>
							<tr><td>Phone Number: <?php echo FormData::phone_number(FormData::hospital_id($order_id)); ?></td></tr>
							<tr><td>Order Number: <?php echo FormData::order_number($order_id); ?></td></tr>
					 </table>

 		 </div>

 		 <div class="orders"><h2>REQUISTION FORM</h2></div>
		<!--  <div><?php echo FormData::payment_method($order_id); ?> </div> -->

<!-- <table cellpadding="6">
<div><h4>Orders</h4></div>
  <tr>

    <th>Product Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Amount</th>
    <th>VAT(%)</th>
		<th>VAT</th>

  </ -->tr>

  <?php



  ?>
   <?php echo FormData::get_order_items($order_id); ?>




</table>

	<?php

        $body = ob_get_clean();

        $body = iconv("UTF-8","UTF-8//IGNORE",$body);

        include("mpdf/mpdf.php");
        $mpdf=new \mPDF('c','A4','','' , 0, 0, 0, 0, 0, 0);

        //write html to PDF
        $mpdf->WriteHTML($body);

        //output pdf

        $today=date('d-m-y-H-i-s');
        $file_name='forms/'.FormData::hospital_name($order_id).'-'.$today.'.pdf';
        $mpdf->Output($file_name,'D');

        // $response['file_name']=$file_name;
        // $response['time']=$today;

    //    return json_encode($response);
	 ?>
<?php	}
}

?>
