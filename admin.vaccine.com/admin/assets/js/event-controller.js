function process_order(order_id){
	variables="order="+order_id;

	var url="./modules/dashboard/process-order.php?"+variables;
		$.ajax({
			type:"POST",
			url:url,
			dataType:"json",

			success:function(response){
				if(response.success==1){
						  $.notify({
            icon: "notifications",
            message: "order has been processed"

        }, {
            type: type[5],
            timer: 500,
            placement: {
                from: 'bottom',
                align: 'right'
            }
        });
				}else{
					console.log("error while processing order item");
				}
			}
		});
}

function download_pdf(order_id){
	window.open("./modules/requisition/requistion-form.php?order_id="+order_id);
}