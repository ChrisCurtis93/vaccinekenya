function add_customer(){

		
		var user_name=document.getElementById("name").value;
		var user_email=document.getElementById("email").value;
		var user_phoneNumber=document.getElementById("phoneNumber").value;
		var user_id=document.getElementById("id_no").value;
		var user_pin=document.getElementById("pin_number").value;
		var policy_number=document.getElementById("policy_number").value;
		var user_dob=document.getElementById("dob").value;
		var user_kin=document.getElementById("next_of_kin").value;
		var user_kin_id=document.getElementById("next_of_kin_rln").value;
		var user_kin_phone=document.getElementById("next_of_kin_phone").value;
		var company=document.getElementById("select_company").value;
		var plan=document.getElementById("select_plan").value;
		///var agent_id=document.getElementById("agent_id").value;
		var premium_paid=document.getElementById("premium_paid").value;
		var sum_insured=document.getElementById("sum_insured").value;
		var premium_freq=document.getElementById("premium_freq").value;
		//more details
		var gender=document.getElementById("gender").value;
		var term_of_policy=document.getElementById("term_of_policy").value;
		var policy_start=document.getElementById("policy_start").value;
		var job_cat=document.getElementById("job_cat").value;
			//	swal(agent_id);
		var values="name="+user_name+"&email="+user_email+"&phone="+user_phoneNumber+"&id="+user_id+"&kra_pin="+user_pin;
		var values_1="&dob="+user_dob+"&next_of_kin="+user_kin+"&next_of_kin_id="+user_kin_id+"&next_of_kin_phone="+user_kin_phone;
		var values_2="&company="+company+"&plan="+plan+"&agent_id="+agent_id+
		"&policy_no="+policy_number;
		var values_3="&premium_paid="+premium_paid+"&sum_insured="+sum_insured+"&premium_freq="+premium_freq;
		var value_4="&gender="+gender+"&term_of_policy="+term_of_policy+"&policy_start="+policy_start+"&job_cat="+job_cat;
		var url="./phpdata/customers/add-customer.php?"+values+values_1+values_2+values_3+value_4;
		

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("Customer status", response.message,"success");
					open_module('./modules/customers/all.php');

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});

	}

		function get_insurance_company(){
	
		var company=document.getElementById("select_company").value;
		
		return company;
	}
	function get_insurance_plan(){
		var plan=document.getElementById("select_plan").value;
		return plan;
	}

function add_plan(user_id){


		var plan=document.getElementById("add_select_plan").value;
		///var agent_id=document.getElementById("agent_id").value;
		var premium_paid=document.getElementById("add_premium_paid").value;
		var sum_insured=document.getElementById("add_sum_insured").value;
		var premium_freq=document.getElementById("add_premium_freq").value;
		var company=document.getElementById("add_select_company").value;
		var add_policy_no=document.getElementById("add_policy_no").value;

		var policy_term=document.getElementById("add_term_of_policy").value;
		var policy_start=document.getElementById("add_policy_start").value;

		var values_2="&company="+company+"&plan="+plan+"&customer_id="+user_id
		+"&policy_no="+add_policy_no;
		var values_4="&policy_term="+policy_term+"&policy_start="+policy_start;
		var values_3="&premium_paid="+premium_paid+"&sum_insured="+sum_insured+"&premium_freq="+premium_freq;

		var url="./phpdata/customers/add-customer-plan.php?"+values_2+values_3+values_4;
		//swal(url);

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					swal("PLan status", response.message,"success");
					open_module('./modules/customers/all.php');

				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
}


function update_api(){
	var api_data=document.getElementById("update_api").value;
	var url="./modules/apps/update-api-data.php?api="+api_data;
	$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){
					swal("Api status","Api Updated Successfully","success");
					location.reload();
				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
}

function update_app(){
	var app_data=document.getElementById("update_app").value;
	var url="./modules/apps/update-app-data.php?app="+app_data;
	$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){
					swal("APP status","APP Updated Successfully","success");
					location.reload();
				}else{
					swal("User status",response.message,"warning");

				}
			}

		});
}

