function birthday_mailer(user_id){
	var url="./phpdata/customers/add-customer.php?user_id="+user_id;
	$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){
					$.html()

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
}