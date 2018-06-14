<?php
require_once('./data/db.php');
class App{
	public static function get_title(){
		global $db;
		return $db->GetOne("select ");
	} 
	public static function get_app_details(){
		$details = array();
		$details["app_details"]["name"] = "NAGALAS";
		$details["app_details"]["short_name"] = "NCS";
		$details["app_details"]["developer"] = "AT4 DEVELOPERS";
		$details["app_details"]["copyright"] = "<p class='copyright pull-right'>
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href='http://www.creative-tim.com/'>AT4</a> DEVLOPERS</p>";
		return $details;
	}

	public static function counties(){
		global $db;
		$results = $db->GetArray("SELECT * FROM `tb_counties` order by county_name ASC");
		foreach($results as $row){?>
			<option value="<?php echo $row["county_id"]; ?>"><?php echo $row["county_name"]; ?></option>
		<?php }
	}
}

class clsGlobal{
	public function get_kenyacounties(){
		global $db;
		$data = $db->GetArray("select * from pb_kenyacounties");
		foreach($data as $row){ ?>
			<option value="<?php echo $row["county"]; ?>"> <?php echo $row["county"]; ?> </option>
		<?php }
	}
}

class Logs{
	public static function register_log($userid, $action){
		global $db;
		$data = array();
		$data['userid'] = $userid;
		$data['action'] = $action;
		$data['actiontime'] = $db->GetOne("select now();");
		$db->AutoExecute('pb_logs',$data, 'INSERT');
	}
}
class Menu{
	public function create_menu($userdepartment){
		global $db;
		$data = $db->GetArray("call pb_app_createmenu($userdepartment);");
		if($data){
			foreach($data as $row){ ?>
				<li>
                    <a data-toggle="collapse" href="#<?php echo $row["Id"]; ?>">
						<i class="material-icons"> <?php echo $row["Icon"]; ?> </i> 
						<p> <?php echo $row["Menu"]; ?>
							<b class="caret"></b>
						</p>
					</a>
					<div class="collapse" id="<?php echo $row["Id"]; ?>">
						<ul class="nav">
							<?php $this-> create_submenu($userdepartment, $row["Id"]); ?>
						</ul>
					</div>
				</li>
			<?php }
		}
	}
	
	public function create_submenu($userdepartment, $menuid){
		global $db;
		$data = $db->GetArray("call pb_app_createsubmenu($userdepartment, $menuid);");
		foreach($data as $row){ ?>
			<li>
                <a href="#" onclick="open_module('<?php echo $row["FileName"]; ?>')"><?php echo $row["SubMenu"]; ?></a>
            </li>
		<?php 
		}
	}
}

class User{
	public static function get_details($id){
		global $db;
		$row = $db->GetRow("select * from tb_users_hospitals where hospital_id = {$id}");
		if($row){
			$details = array();
			$details["user_details"]["names"] = $row["hospital_name"];
			$details["user_details"]["id"] = $row["hospital_id"];
			$details["user_details"]["email"] = $row["hospital_email"];
		}
		return $details;
	}
	
	public static function checknew_messages($id){
		global $db;
		return $db->getOne("select count(*) as count from pb_app_messages where recieverid = {$id} and state = 'new'");
	}
	
	public static function get_messages($id){
		global $db;
		$data = $db->GetArray("select * from pb_app_messages where recieverid = {$id}");
		if($data){
			foreach($data as $row){ ?>
				<li class="unread">
					<a href="javascript:;" class="unread" onclick="open_module('./modules/account/messages.php');">
						<div class="clearfix">
							<div class="thread-image">
								<img src="./assets/images/avatar-2.jpg" alt="">
							</div>
							<div class="thread-content">
								<span class="author">Nicole Bell</span>
								<span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
								<span class="time"> Just Now</span>
							</div>
						</div>
					</a>
				</li>
			<?php }
		}else{?>
			<div class="thread-content">
				<span class="author">No Messages to Read</span><br/>
				<span class="preview">You have No new messages, If you believe there is a problem with your messages, <a href="#"> Click here </a> to report the problem.</span>
			</div>
		<?php }
	}
}

class SystemData{
	public static function get_userscount(){
		global $db;
		return $db->getOne("select count(*) as count from pb_app_users");
	}
	
	public static function get_documentscount(){
		global $db;
		return $db->getOne("select count(*) as count from pb_documents");
	}
}


?>