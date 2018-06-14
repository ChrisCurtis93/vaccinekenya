function update_customer(userId){

		
		var user_name=document.getElementById("update_name").value;
		var user_email=document.getElementById("update_email").value;
		var user_phoneNumber=document.getElementById("update_phoneNumber").value;
		var user_id=document.getElementById("update_id_no").value;
		var user_pin=document.getElementById("update_pin_number").value;
		var user_dob=document.getElementById("update_dob").value;
		var user_kin=document.getElementById("update_next_of_kin").value;
		var user_kin_id=document.getElementById("update_next_of_kin_rln").value;
		var user_kin_phone=document.getElementById("update_next_of_kin_phone").value;
		
		//more details
		var gender=document.getElementById("update_gender").value;
		
		var job_cat=document.getElementById("update_job_cat").value;
			//	swal(agent_id);
		var values="name="+user_name+"&email="+user_email+"&phone="+user_phoneNumber+"&id="+user_id+"&kra_pin="+user_pin;
		var values_1="&dob="+user_dob+"&next_of_kin="+user_kin+"&next_of_kin_id="+user_kin_id+"&next_of_kin_phone="+user_kin_phone;
	//	var values_2="&company="+company+"&plan="+plan+"&agent_id="+agent_id;
	//	var values_3="&premium_paid="+premium_paid+"&sum_insured="+sum_insured+"&premium_freq="+premium_freq;
		var value_4="&gender="+gender+"&job_cat="+job_cat+"&user_id="+userId;
		var url="./phpdata/customers/update-customer-details.php?"+values+values_1+value_4;
		

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



    function update_plan(selectedPlan,user_id){
       
//selectedPlan,user_id
    
        var premium_paid=document.getElementById("update_premium_paid").value;
        var sum_insured=document.getElementById("update_sum_insured").value;
        var policy_start=document.getElementById("update_policy_start").value;
        var policy_no=document.getElementById("update_policy_no").value;
        var term_of_policy=document.getElementById("update_policy_term").value;

       //  swal(selectedPlan+' '+user_id+' '+premium_paid+' '+sum_insured+' '+policy_start);
        // var premium_freq=document.getElementById("update_premium_freq").value;
       
        // var company=document.getElementById("update_select_company").value;
        // var plan=document.getElementById("update_select_plan").value;
        

            
        
    
        var values_2="premium_paid="+premium_paid+"&sum_insured="+sum_insured
        +"&policy_start="+policy_start+"&selected_plan_id="+selectedPlan;
        var values_3="&policy_no="+policy_no+"&term_of_policy="+term_of_policy;
        // term_of_policy+"&premium_freq="+premium_freq;
        // var values_3="&premium_paid="+premium_paid+"&sum_insured="+sum_insured;
        // var value_4="&policy_start="+policy_start+"&selected_plan_id=7";
        // //+selectedPlan;
        var url="./phpdata/customers/update-transcation-details.php?"+values_2+values_3;
        

            $.ajax({
            url:url,
            type:"GET",
            url:url,
            dataType:"json",
            success: function(response){

                var newData = response.success;
                if(newData==1){

                    swal("Policy status", response.message,"success");
                    showAjaxModal('./modules/customers/customer-transcation-details.php?id='+user_id);

                }else{
                    swal("User status",response.message,"warning");

                }
            }

        });

}

   function update_policy_status(id){
 	var value=document.getElementById(id).value;
 	newId='#'+id;



   	
   	if(!document.getElementById(id).checked){
   			swal({
                 
    				title: "Are You Sure?",
    				type: 'warning',
    				text: "are you sure you want to deactivate this plan",
    				showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function() {

                	  var url="./phpdata/customers/update-active-status.php?active=0&id="+id;
        

            $.ajax({
            url:url,
            type:"GET",
            url:url,
            dataType:"json",
            success: function(response){

                var newData = response.success;
                if(newData==1){
                	$(newId).prop('checked',false);
                }else{
                    swal("User status",response.message,"warning");

                }
            }

        });


       				//$(newId).prop('checked',false);
                },function(dismiss){
                	$(newId).prop('checked',true);
                });
   	}
   	if(document.getElementById(id).checked){
   			swal({
                 
    				title: "Are You Sure?",
    				type: 'warning',
    				text: "are you sure you want to activate this plan",
    				showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    closeOnCancel: false
                }).then(function() {
                	 var url="./phpdata/customers/update-active-status.php?active=1&id="+id;
        

            $.ajax({
            url:url,
            type:"GET",
            url:url,
            dataType:"json",
            success: function(response){

                var newData = response.success;
                if(newData==1){
                	$(newId).prop('checked',true);
                }else{
                    swal("User status",response.message,"warning");

                }
            }

        });
       			//	$(newId).prop('checked',true);
                },function(dismiss){
                	$(newId).prop('checked',false);
                });
   	}
}

	