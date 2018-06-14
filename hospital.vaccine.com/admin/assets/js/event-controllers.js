function registration(){
	var hosi_name=document.getElementById('hosi_name').value;
	var county=document.getElementById('county').value;
	var poboxnumber=document.getElementById('poboxnumber').value;
	var code=document.getElementById('postcode_num').value;

	 var contact_person_name=document.getElementById('contact_person_name').value;
	 var phone=document.getElementById('contact_person_phone').value;
	 var email=document.getElementById('contact_person_email').value;
	 var login_password=document.getElementById('login_password').value;
	 var login_password_confirm=document.getElementById('login_password_confirm').value;

	 // alert(hosi_name+","+county+","+poboxnumber+","+postcode_num+","+contact_person_name+
	 // 	","+contact_person_phone+","+contact_person_email+","+login_password+","+login_password_confirm);
	
	
	if(login_password===login_password_confirm){
	// 	var data=JSON.stringify([{
	// 	"hospital_name":hosi_name,
	// 	"county":county,
	// 	"box":poboxnumber,
	// 	"code":postcode_num,
	// 	"contact_name":contact_person_name,
	// 	"phone":contact_person_phone,
	// 	"email":contact_person_email,
	// 	"password":login_password
	// }]);

	// var xhr = new XMLHttpRequest();
	// xhr.withCredentials = true;

	// xhr.addEventListener("readystatechange", function () {
	//   if (this.readyState === 4) {
	//     console.log(this.responseText);
	//   }
	// });

	// xhr.open("POST", "./data/apis/login-processor/register-hospital.php");
	// xhr.setRequestHeader("Content-Type", "application/json");
	// xhr.setRequestHeader("Cache-Control", "no-cache");
	// xhr.send(data);
	var variables="hosi_name="+hosi_name+"&contact_person_name="+contact_person_name+"&county="+
	county+"&box="+poboxnumber+"&email="+email+"&password="+login_password+"&code="+code+
	"&phone="+phone;
	var url="./data/apis/login-processor/register-hospital.php?"+variables;
		$.ajax({
			type:"POST",
			url:url,
			dataType:"json",

			success:function(response){
				if(response.success==1){
					$("#loading_point").html("<div role='alert' class='alert alert-success margin-top-30 col-md-offset-3 col-sm-offset-1'><strong>Failed!</strong>"+response.message+"</div>");
					window.load('./log.php');
				}else{
					$("#loading_point").html("<div role='alert' class='alert alert-danger margin-top-30 col-md-offset-3 col-sm-offset-1'><strong>Failed!</strong>"+response.message+"</div>");
				}
			}
		});
	}else{
		$("#loading_point").html("<div role='alert' class='alert alert-danger margin-top-30 col-md-offset-3 col-sm-offset-1'><strong>Failed!</strong>Passwords don't match!!.</div>");
	}
}

function add_to_order(order_id,vaccine_id,input_id){
	 type = ['', 'info', 'success', 'warning', 'danger', 'rose', 'primary'];
	var input_data=document.getElementById(input_id).value;

	//alert(input_data);
	variables="vaccine_id="+vaccine_id+"&order_id="+order_id+"&total_amount="+input_data;

		var url="./modules/dashboard/add-order-item.php?"+variables;
		$.ajax({
			type:"POST",
			url:url,
			dataType:"json",

			success:function(response){
				if(response.success==1){
					  $.notify({
            icon: "notifications",
            message: "Item added to cart"

        }, {
            type: type[5],
            timer: 500,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
				}else{
					
				}
			}
		});
}

function delete_order_item(id){
	variables="id="+id;

		var url="./modules/dashboard/delete-order-item.php?"+variables;
		$.ajax({
			type:"POST",
			url:url,
			dataType:"json",

			success:function(response){
				if(response.success==1){
				}else{
					console.log("error while deleting order item");
				}
			}
		});
}

function post_order_details(order_id){
	variables="order="+order_id;

		var url="./modules/dashboard/post-order.php?"+variables;
		$.ajax({
			type:"POST",
			url:url,
			dataType:"json",

			success:function(response){
				if(response.success==1){
					swal('Order Status','Your order has been posted successfully','success');
					$('#modal_ajax').modal('hide');
					reload();
				}else{
					console.log("error while deleting order item");
				}
			}
		});
}

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