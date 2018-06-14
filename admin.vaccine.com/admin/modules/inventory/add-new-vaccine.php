<?php    
?>


<div class="container-fluid" >
	<div class="row">
		<div class="col-md-12 ">
			<div class="card">
				<div class="card-header card-header-icon" data-background-color="green">
					<i class="material-icons">person</i>
				</div>
				<div class="card-content">
					<h4 class="card-title">Add Vaccine</h4>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-sm-offset-3">
					<!--	  <form id="RegisterValidation" action="#" method="" > -->
                                   
                                    <div class="card-content">
                                         <div class="label-floating">
                                            <label class="control-label">
                                                Vaccine Name
                                                <small>*</small>
                                            </label>
                                            <input class="form-control" name="add_new_vaccine"  id="add_new_vaccine" type="text" required="true"/>
                                        </div>
                                    
                                         <div class="label-floating">
                                            <label class="control-label">
                                                Initial Inventory
                                                <small>*</small>
                                            </label>
                                            <input class="form-control" name="vaccine_stock_in"  id="vaccine_stock_in" type="number" required="true"/>
                                        </div>
                                     
                                        <div class="category form-category">
                                            <small>*</small> Required fields</div>
                                        <div class="form-footer text-right">
                                            <div class="checkbox pull-left">
                                               
                                            </div>
                                            <a href="#" class="btn btn-danger btn-fill" onclick="add_vaccine()">Add Vaccine</a>
                                        </div>
                                    </div>
                             <!--   </form> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>