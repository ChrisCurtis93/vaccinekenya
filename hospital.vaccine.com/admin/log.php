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

                    <div id="loading_point" class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">                                         
                                        </div>
                
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="#" action="#">
                                <div class="card card-login card-hidden">
									<div class="card-header text-center" data-background-color="purple">
                                        <h4 class="card-title">Hospital Order System</h4>
                                        <div class="social-line">
                                        
                                        </div>
                                    </div>
                                    <!--<p class="category text-center">
                                        Or Be Classical
                                    </p>-->
                                    <div class="card-content">
										
							
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email address</label>
                                                <input type="email" class="form-control" id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <a href="#" class="btn btn-rose btn-simple btn-wd btn-lg" id="lnklog">Log In</a>
                                        <a href="register.php" class="btn btn-blue btn-simple btn-wd btn-sm" id="lnklog"><b>New Hospital? Click Here to Register</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                   
                </div>
            </footer>
        </div>
    </div>
</body>

</body>
<?php require_once("./js.php"); ?>
</html>
