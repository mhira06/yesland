<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	include($rootFolder."/classes/menu.php");
	$function = new Functions();
	$menu = new Menu();
	$select = new Select();
	$generate = new Generate();
	$session = isset($_SESSION[PROJECT]) ? $_SESSION[PROJECT] : array();
	$sessionUser = isset($session["user"]) ? $session["user"] : array();
	$logintType = isset($sessionUser["login_type"]) ? $sessionUser["login_type"] : "";
	if(ID == ""){
		redirect();
	}
	
	if($logintType != "1"){
		redirect();
	}
	$action = $function->get("action");
	//$function->echo_array($sessionUser);
	//echo $employeeType;
	//$userTypeDetails = $select->get_user_type($userType);
	
	$page = "users";
	$title = "Users";
?>
<!DOCTYPE html>
<html lang="en">
	<?php
		$head = root_url("pages/defaults/head.php");
		//echo $head;
		include($head);
	?>
	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">
		<?php
			$header = root_url("pages/defaults/header.php");
			//echo $header;
			include($header);
			$sideMenu = root_url("pages/defaults/side_menu.php");
			include($sideMenu);
		?>
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0">Users</h1>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
									<li class="breadcrumb-item"><a href="javascript:void(0)">Maintenance</a></li>
									<li class="breadcrumb-item active">Users</li>
								</ol>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<section class="content">
					<div class="container-fluid">
					<?php
						switch($action){
							case "add":
							case "edit":
							?>
								<div class = "row">
									<div class="col-md-12">
										
									<?php
										$usersListPage = root_url("pages/includes/maintenance/users/users_registration_form.php");
										include($usersListPage);
									?>
									</div>
								</div>
							<?php
							break;
							
							default:
						?>
							<div class = "row">
								<div class="col-md-12">
								<?php
									$usersListPage = root_url("pages/includes/maintenance/users/users_list.php");
									include($usersListPage);
								?>
								</div>
							</div>
						<?php
							break;
						}
					?>
					</div>
				</section>
			</div>
			<?php
				$footer = root_url("pages/defaults/footer.php");
				include($footer);
			?>
		</div>
	<?php
		$js = root_url("pages/defaults/main_js.php");
		include($js);
		$pageJs = root_url("pages/defaults/page_js.php");
		include($pageJs);
	?>
		<script src="<?php echo $js ?>/pages/maintenance/users.js"></script>
	</body>
</html>
