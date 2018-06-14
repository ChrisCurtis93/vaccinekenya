function add_vaccine(){
	var vaccine_name=document.getElementById("add_new_vaccine").value;
	var inventory=document.getElementById("vaccine_stock_in").value;

	var variables="name="+vaccine_name+"&inventory="+inventory;
	var url="./data/apis/inventory/add-vaccine.php?"+variables;
		//swal(url);

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("status", response.message,"success");
					open_module('./modules/inventory/all.php');

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
}