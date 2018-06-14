<?php

include('./form.php');

echo Mail::generate_pdf($_REQUEST['order_id']);
?>