<!DOCTYPE html>
<html lang="en">
<?php
	require_once("css.php");
	require_once("data/class.php");
?>

<body>

    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
             
            </div>
        
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="assets/img/login.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">

                <div class="container">

                    <div id="loading_point" class="col-md-8">                                         
                                        </div>
                
                    <div class="row">
                        <div class="col-md-8  col-sm-2 col-md-offset-2 col-sm-offset-1">
                            <form method="#" action="#">
                                <div class="card card-login card-hidden">
									<div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">Hospital Registration</h4>
                                        <div class="social-line">
                                        
                                        </div>
                                    </div>
                                    <!--<p class="category text-center">
                                        Or Be Classical
                                    </p>-->
                                    <div class="card-content">
									   <div class="row">
                
                                        <div class="col-md-6">
                                             <div class="input-group">
                                                 <span class="input-group-addon">
                                                     <i class="material-icons">my_location</i>
                                                  </span>
                                                  <div class="form-group label-floating">
                                                       <label class="control-label">Hospital Name</label>
                                                 <input type="text" class="form-control" id="hosi_name" name="hosi_name">
                                                 </div>
                                              </div> 

                                             <div class="form-group label-floating">
                                                <label class="control-label">
                                                   Select County
                                                    <small>*</small>
                                                </label>
                                              <select name="county" id="county" class="form-control" required="required">
                                                     <?php echo App::counties();?> 
                                               </select>
                                        </div>   
                                             <div   class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">inbox</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Box No.</label>
                                                        <input type="number" class="form-control" id="poboxnumber" name="poboxnumber">
                                                     </div>
                                             </div>
                                              <div   class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Postal Code.</label>
                                                        <input type="number" class="form-control" id="postcode_num" name="postcode_num">
                                                     </div>
                                             </div>

                                      
                                        </div> 
                                            
                                        <div class="col-md-6">
                                             <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">fingerprint</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Contact Person Name</label>
                                                    <input type="text" class="form-control" id="contact_person_name" name="contact_person_name">
                                                </div>
                                             </div>
                                             <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Contact Person Phone number</label>
                                                    <input type="number" class="form-control" id="contact_person_phone" name="contact_person_phone">
                                                </div>
                                             </div>

                                              <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">mail</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Contact Person email</label>
                                                        <input type="text" class="form-control" id="contact_person_email" name="contact_person_email">
                                                    </div>
                                             </div>

                                              <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">login password</label>
                                                        <input type="password" class="form-control" id="login_password" name="login_password">
                                                    </div>
                                             </div>

                                              <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">lock_outline</i>
                                                    </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">confirm password</label>
                                                        <input type="password" class="form-control" id="login_password_confirm" name="login_password_confirm">
                                                    </div>
                                             </div>
                                        </div>                          
                                       </div>	
							         
                                       
                                        
                                        

                                        
                                    </div>
                                    <div class="footer text-center">
                                          <a href="log.php" class="btn btn-blue btn-simple btn-wd btn-sm" id="lnklog"><b>Already Have an Account? Click Here to Login</a>
                                        <a href="#" class="btn btn-rose btn-wd btn-lg" id="register_hospital" onclick="registration()">Register</a>
                                      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <?php echo App::get_app_details()["app_details"]["copyright"]; ?>
                </div>
            </footer>
        </div>
    </div>
</body>

</body>
<?php require_once("./js.php"); ?>
</html>
