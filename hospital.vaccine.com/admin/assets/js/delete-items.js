function delete_user(userId){

	swal({
                 
    				title: "Are You Sure?",
    				type: 'warning',
    				text: "You won't be able to revert this!",
    				showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function(result) {
       
    		var url="./phpdata/customers/delete-customer?userId="+userId;

			$.ajax({
			url:url,
			type:"GET",
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("User status", response.message,"success",1000);
					jQuery('#modal_ajax_md').modal('toggle');
					open_module('./modules/customers/all.php');


				}else{
					swal("Not deleted",response.message,"error");

				}
			}

		});
                });
}