function delete_user(value){

	alert(value);

swal({

		title:"Delete",
		text:"Are you sure you want to delete",
		type:"warning",
		showCancelButton:true,
		confirmButtonColor:'#DD6B55',
		confirmButtonText:'Yes, delete it',
		closeOnConfirm:false,
		closeOnCancel:false

}function(isConfirm){

if(isConfirm){
		var url="./phpdata/admin-delete-user.php?userId="+value;


		$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("User status", response.message,"success");
					open_module('./modules/users/all.php');

				}else{
					swal("Not deleted",response.message,"error");

				}
			}

		});
}else{
swal("Delete canceled","user not deleted","cancel");

}

});

	
	}
