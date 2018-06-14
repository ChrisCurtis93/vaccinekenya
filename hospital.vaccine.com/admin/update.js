function update_stock_item(stockId){

		var stock_to_update=document.getElementById("stock_to_update").value;
		
		
		
		var values="stock_to_update="+stock_to_update+"&stock_item_id="+stockId;
		var url="./phpdata/stocks/update-stock-item.php?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					//swal("Stock status", response.message,"success");
					showAjaxModal('./modules/stocks/update-stock-items.php?stockId='+stockId);
					open_module('./modules/stocks/all-stocks.php');						

				}else{
					swal("Stock status",response.message,"warning");

				}
			}

		});	

}

function move_stock_item(stockId){
	var stock_to_move=document.getElementById("stock_to_move").value;
	var remaining_to_move=document.getElementById("remaining_to_move").value;
	
	
		
		if(parseInt(remaining_to_move)>=parseInt(stock_to_move)){
			var values="stock_to_move="+stock_to_move+"&stock_item_id="+stockId;
			var url="./phpdata/stocks/move-stock-item.php?"+values;
				$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					//swal("Stock status", response.message,"success");
					showAjaxModal('./modules/stocks/move-stock-item.php?stockId='+stockId);
					open_module('./modules/stocks/all-stocks.php');						

				}else{
					swal("Stock status",response.message,"warning");

				}
			}

		});
		
		}else{
			
		swal("Move update","You cannot move more than what is remaining","warning");
		
		}
		
			
}

		
function return_stock_item(stockId){
	var stock_to_return=document.getElementById("stock_to_return").value;
	var last_out=document.getElementById("last_out").value;	
		
		if(parseInt(last_out)>=parseInt(stock_to_return)){
		
		if(parseInt(last_out)>0){
		
			if(stock_to_return>=0){
				var values="stock_to_return="+stock_to_return+"&stock_item_id="+stockId;
			var url="./phpdata/stocks/return-stock-item.php?"+values;

			$.ajax({
			url:url,
			type:"GET",
			url:url,
			dataType:"json",
			success: function(response){

				var newData = response.success;
				if(newData==1){

					//swal("Stock status", response.message,"success");
					showAjaxModal('./modules/stocks/return-stock-item.php?stockId='+stockId);
					open_module('./modules/stocks/all-stocks.php');						

				}else{
					swal("Stock status",response.message,"warning");

				}
			}
			});
			}else{
				swal("Close update","You cannot return more than what you took","warning");
			}
			
		}else{
			swal("Close update","You cannot return more than what you took","warning");
		}
		
			
		}else{
			
			swal("Close update","Order closed","warning");
		
		
		}
		
		
}
	

	