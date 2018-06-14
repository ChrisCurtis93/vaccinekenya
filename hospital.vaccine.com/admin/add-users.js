function add_user(){

		
		var user_name=document.getElementById("name").value;
		var user_email=document.getElementById("email").value;
		var user_phoneNumber=document.getElementById("phoneNumber").value;
		var branchName=get_user_branch();
		var userCategory=get_user_category();
		
		swal(userCategory);
				
		var values="name="+user_name+"&email="+user_email+"&phone="+user_phoneNumber+"&branch="+branchName+"&category="+userCategory;
		var url="./modules/users/add-new-user.php?"+values;
		
		if(userCategory=='4'){
			var admin_password=document.getElementById("admin_password").value;
			var confirm_password=document.getElementById("confirm_admin_password").value;
			
			if(admin_password===confirm_password){
			
			var admin_url="./phpdata/create-new-admin.php?"+values+"&password="+admin_password;
			
			$.ajax({
			url:admin_url,
			type:"GET",
			url:admin_url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Admin status", response.message,"success");
					open_module('./modules/users/all.php');

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
			}
			else{
				swal("passwords dont match");
			}
			
			

		}else{
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
					swal("User status",response.message,"warning");

				}
			}

		});

			
		}



	}

	function get_user_category(){
	
		var user_branch=document.getElementById("select_user_category").value;
		
		if(parseInt(user_branch)==4){
		
			$("#adminSecretPassword").show();
		}else{
			$("#adminSecretPassword").hide();
		
		}
		
		return user_branch;
	}
	function get_user_branch(){
		var user_branch=document.getElementById("select_branch").value;
		return user_branch;
	}
	
	function get_user_branch_table(){
		var user_branch=document.getElementById("select_branch_table").value;
		return user_branch;
	}
	function add_table(){

		var tab_name=document.getElementById("table_name").value;
		var branchName=get_user_branch_table();

		var values="table_name="+tab_name+"&branchId="+branchName;
		var url="./modules/tables/add-table.php?"+values;


		$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Table status", response.message,"success");
						open_module('./modules/tables/all.php');

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
	}
	
		function add_menu_category(){

		var menu_cat_name=document.getElementById("menu_cat_name").value;
		var cat_branch=document.getElementById("cat_branch").value;
		
	//	swal(cat_branch);
		

		var values="menuCatName="+menu_cat_name+"&cat_branch="+cat_branch;
		var url="./phpdata/admin-add-menu-category.php?"+values;


		$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Menu category status", response.message,"success");
						open_module('./modules/menus/all-menu-items.php');

				}else{
					swal("Menu category status",response.message,"warning");

				}
			}

		});
	}
		function get_menu_name(){
		var user_branch=document.getElementById("select_menu").value;
		return user_branch;
	}
	function add_new_sub_menu(){

	
		var sub_menu_name=document.getElementById("sub_menu_name").value;
		var menu_name=get_menu_name();

		var values="sub_menu_name="+sub_menu_name+"&menu_name_id="+menu_name;
		var url="./phpdata/add-sub-menu.php?"+values;


		$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Sub menu status", response.message,"success");
						open_module('./modules/menus/all-sub-menu-categories.php');

				}else{
					swal("Sub menu status",response.message,"warning");

				}
			}

		});
	}
	function add_sub_menu_item(){
		

		var item_name=document.getElementById("sub_menu_item_name").value;
		var sub_menu_name=document.getElementById("select_sub_menu_name").value;
		

		var values="sub_item_name="+item_name+"&sub_cat_id="+sub_menu_name;
		var url="./phpdata/add-sub-menu-item?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Sub menu item status", response.message,"success");
						open_module('./modules/menus/all-sub-menu-items.php');

				}else{
					swal("Sub menu item status",response.message,"warning");

				}
			}

		});

	}
	
	
	function add_branch(){
		

		var branchName=document.getElementById("branch_name").value;
		

		var values="branch_name="+branchName;
		var url="./phpdata/branch/add-new-branch.php?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Branch status", response.message,"success");
						open_module('./modules/branches/all.php');

				}else{
					swal("Branch status",response.message,"warning");

				}
			}

		});

	}
	
	
	
	function add_stock_item(){
		

		var branch_stock=document.getElementById("branch_stock").value;
		var stock_item_name=document.getElementById("stock_item_name").value;
		var unit_price=document.getElementById("unit_price").value;
		var quantity=document.getElementById("quantity").value;
		var unit_measure=document.getElementById("unit_measure").value;

		var values="branch_stock="+branch_stock+"&stock_item_name="+stock_item_name+"&unit_price="+unit_price+"&quantity="+quantity+"&unit_measure="+unit_measure;
		var url="./phpdata/stocks/add-new-stock-item.php?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Stock item status", response.message,"success");
						open_module('./modules/stocks/all-stocks.php');

				}else{
					swal("Stock item status",response.message,"warning");

				}
			}

		});

	}
	
	
	function add_stock_category(){
		

		var stock_cat_branch=document.getElementById("stock_cat_branch").value;
		var stock_cat_name=document.getElementById("stock_cat_name").value;

		var values="branch_name="+stock_cat_branch+"&cat_name="+stock_cat_name;
		var url="./phpdata/stocks/add-new-stock-category.php?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Stock Category status", response.message,"success");
						open_module('./modules/stocks/all-stock-category.php');

				}else{
					swal("Stock Category  status",response.message,"warning");

				}
			}

		});

	}
	
	function generate_report(){
		var from_date=document.getElementById("from_date").value;
		var to_date=document.getElementById("to_date").value;
		var branch=document.getElementById("select_report_branch").value;
	
		var values="from="+from_date+"&to="+to_date+"&branch="+branch;
		
		var url="./modules/reports/generate-branch-report.php?"+values;
		
		window.location = url;
	}

	function add_printer(){

		var printer_name=document.getElementById("printer_name").value;
		var printer_mac=document.getElementById("printer_mac").value;
		var branchId=document.getElementById("select_branch_printer").value;
		var station=document.getElementById("select_station").value;

		

		var values="printer_name="+printer_name+"&printer_mac="+printer_mac+"&branchId="+branchId+"&station="+station;
		var url="./phpdata/printer/add-printer.php?"+values;


		$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Printer status", response.message,"success");
						open_module('./modules/printers/all-printers.php');

				}else{
					swal("Printer status",response.message,"warning");

				}
			}

		});
	}
	