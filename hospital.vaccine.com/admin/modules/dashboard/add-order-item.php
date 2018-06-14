<?php

include("./class.php");

echo Dashboard::add_order_item($_REQUEST["order_id"],$_REQUEST["vaccine_id"],$_REQUEST["total_amount"]);

?>