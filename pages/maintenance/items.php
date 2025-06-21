<?php
	$rootFolder = $_SERVER['DOCUMENT_ROOT']."/ylr_portal";
	include($rootFolder."/classes/functions.php");
	include($rootFolder."/classes/menu.php");
	$function = new Functions();
	$menu = new Menu();
	$select = new Select();
	if(ID == ""){
		redirect();
	}
	//$function->echo_array($sessionUser);
	//echo $employeeType;
	//$userTypeDetails = $select->get_user_type($userType);
	$userDetails = $select->get_user_details(ID);
	$action = $function->get("action");
	$page = "items";
	$title = "Online Ordering Items";
	$action = $function->get("action");
	$pageName = $action == "" ? $page : $action;
	$session = isset($_SESSION[PROJECT][$pageName]) ? $_SESSION[PROJECT][$pageName] : array();
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
								<h1 class="m-0">Online Ordering (Items)</h1>
							</div><!-- /.col -->
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-right">
									<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
									<li class="breadcrumb-item"><a href="<?php echo base_url("pages/display/dashboard.php"); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active">Items</li>
								</ol>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<section class="content">
					<div class="container-fluid">
					<?php
						switch($action){
							case "add_item":
							?>
								<div class = "row">
									<div class = "col-12">
									<?php
										$itemsColorCount = 1;
										$selectedColor = "";
										$selectedImage = "";
										$selectedItemSize = array();
										$itemStockList = array();
										$itemsTypeList = $select->get_active_items_type_list();
										$colorList = $select->get_active_colors_list();
										$sizesList = $select->get_active_sizes_list();
										$itemsForm = root_url("pages/includes/maintenance/items/items_form.php");
										include($itemsForm);
									?>
									</div>
								</div>
							<?php
							break;
							
							case "update_items":
								$selectedItemType = $function->get("item_type");
								$selectedItem = $function->get("item");
								$itemsTypeList = $select->get_active_items_type_list();
								$colorList = $select->get_active_colors_list();
								$sizesList = $select->get_active_sizes_list();
								$itemsList = array();
								$totalItemColorCount = 0;
								$itemsColorList = array();
								if($selectedItemType != ""){
									$itemsCondition = "items_type_id = '".$selectedItemType."'";
									$itemsList = $select->get_active_items_list("", $itemsCondition);
									
								}
								if($selectedItem != ""){
									$itemsColorCondition = "items_id = '".$selectedItem."'";
									$itemsColorList = $select->get_active_items_color_list("", $itemsColorCondition);
									$totalItemColorCount = count($itemsColorList);
								}
								$itemsUpdateForm = root_url("pages/includes/maintenance/items/items_update_form.php");
								include($itemsUpdateForm);
							break;
							
							default:
								$selectedItemsType = isset($session["items_type"]) ? $session["items_type"] : array();
								$selectedItems = isset($session["items"]) ? $session["items"] : array();
								$selectedColors = isset($session["colors"]) ? $session["colors"] : array();
								$selectedSize = isset($session["sizes"]) ? $session["sizes"] : array();
							?>
								<div class = "row">
									<div class = "col-12">
									<?php
										//$function->echo_array($session);
										$itemsTypeList = $select->get_active_items_type_list();
										$itemsList = $select->get_active_items_list();
										$colorList = $select->get_active_colors_list();
										$sizesList = $select->get_active_sizes_list();
										$itemSearhForm = root_url("pages/includes/maintenance/items/items_search_form.php");
										include($itemSearhForm);
									?>
									</div>
								</div>
								
								<div class = "row">
									<div class = "col-12">
									<?php
										$searchCondition = isset($session["search_condition"]) ? $session["search_condition"] : "";
										//$searchCondition = "";
										$itemsStockList = $select->get_active_items_stock_list("", $searchCondition);
										$itemsListView = root_url("pages/includes/maintenance/items/items_list.php");
										include($itemsListView);
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
		<script src="<?php echo $js ?>/pages/maintenance/items.js"></script>
	</body>
</html>
