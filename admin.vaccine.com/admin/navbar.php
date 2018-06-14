<?php 
  $obj = new Menu();
?>
<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
  <div class="logo">
       <!--  <a href="http://www.creative-tim.com/" class="simple-text"> -->
            <?php echo User::get_details($_SESSION['user']['userid'])["user_details"]["names"]; ?>
        </a>
    </div>
  <div class="logo logo-mini">
    <a href="#" class="simple-text"></a>
  </div>
  <div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="assets/img/default-avatar.png" />
      </div>
      <div class="info">
        <a data-toggle="collapse" href="#collapseExample" class="collapsed"> <?php echo User::get_details($_SESSION['user']['userid'])["user_details"]["names"]; ?> <b class="caret"></b></a>
      
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Edit Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li id="agent_id" name="agent_id"><?php echo User::get_details($_SESSION['user']['userid'])["user_details"]["id"]; ?></li>
          </ul>
                </div>
            </div>
        </div>
    <ul class="nav">
      <li class="active">
        <a href="./">
          <i class="material-icons"> dashboard </i>
          <p>Dashboard</p>
        </a>
      </li>
    
        
        <li>
        
      </li>
      
      <li>
                                                 <a href="#" onclick="open_module('./modules/hospitals/all.php')"><i class="material-icons">assessment</i>Hospitals</a>
                                               </li>
       <li>
                                           <a href="#" onclick="open_module('./modules/inventory/all.php')"><i class="material-icons">date_range</i>Inventory</a>
                                  </li>
   
                                 
                                <li>
                                                 <a href="#"><i class="material-icons">assessment</i>Statistical reports</a>
                                               </li>
                              
      
      
      <?php //$obj->create_menu(User::get_details($_SESSION['user']['userid'])["user_details"]["departmentid"]); ?>
    </ul>
  </div>
</div>