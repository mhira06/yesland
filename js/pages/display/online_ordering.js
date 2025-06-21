removePending = "";
$(function () {
	$("#tbl_ordered_items").DataTable({
		"aaSorting": []
	});
	
	$(document).on("change", ".available_color", function(){
		$(".color_label").removeClass("bg-success");
		if ($(this).is(":checked")) {
			$(this).closest('label').addClass("bg-success"); 
			selectedColor = $(this).val();
			$.ajax({
				method : "GET", 
				url : base_url + "/ajax/load_items_available_sizes.php",
				data : {
					items_colors : selectedColor
				}, 
				success : function(response){
					$("#hdn_items_colors_id").val(selectedColor);
					$("#div_items_sizes").html(response);
				}, 
				error : function(xhr){
					$.alert({
						title : "ERROR", 
						content : xhr.responseText, 
						type : 'red'
					})
				}
			});
			$.ajax({
				method : "GET", 
				url : base_url + "/ajax/load_items_image.php",
				data : {
					items_colors : selectedColor
				}, 
				dataType : "JSON", 
				success : function(response){
					if(response.items_image != ""){
						$("#img_items").attr("src", response.items_image);
					}
					
				}, 
				error : function(xhr){
					$.alert({
						title : "ERROR", 
						content : xhr.responseText, 
						type : 'red'
					})
				}
			})
		}
	});
	
	$(document).on("click", ".available_sizes", function(){
		selectedItemSizes = $(this).attr("data-id");
		$(".available_sizes").removeClass("bg-success");
		
		$("#btn_sizes_" + selectedItemSizes).addClass("bg-success");
		
		$.ajax({
			method : "GET", 
			url : base_url + "/ajax/load_items_stock_details.php",
			data : {
				items_size : selectedItemSizes
			}, 
			dataType : "JSON", 
			success : function(response){
				price = response.price;
				availableStock = response.stock;
				$("#hdn_items_sizes_id").val(selectedItemSizes);
				$("#hdn_items_available_stock").val(availableStock);
				$("#h_price").html("₱ "+price);
				$("#spn_available").html(availableStock);
				
			}, 
			error : function(xhr){
				$.alert({
					title : "ERROR", 
					content : xhr.responseText, 
					type : 'red'
				})
			}
		})
	});
	
	
	$(document).on("click", "#btn_add_to_cart", function(){
		formData = $("#frm_order_items").serialize();
		$.ajax({
			method : "POST", 
			url : base_url + "/action/save_to_cart.php",
			data : formData, 
			dataType : "JSON", 
			success : function(response){
				output = response.output;
				message = response.message;
				header = response.header;
				$.alert({
					title : header, 
					content : message, 
					buttons : {
						okay : {
							text : "Okay", 
							btnClass : "btn-success", 
							action : function(){
								if(output == "success"){
									location.href = base_url + "/pages/display/online_ordering.php";
								}
							}
						}
					}
				})
				
			}, 
			error : function(xhr){
				$.alert({
					title : "ERROR", 
					content : xhr.responseText, 
					type : 'red'
				})
			}
		})
	});
	
	$(document).on("keyup", ".order_quantity", function(){
		selectedQuantity = $(this).val();
		selectedItemsOrder = $(this).attr("data-order_id");
		selectedPrice = $(this).attr("data-price");
		error = "";
		if(selectedItemsOrder <= 0){
			error = "Invalid Quantity";
		}
		if(error != ""){
			$.alert({
				title : "ERROR", 
				content : error, 
				type : 'red'
			});
		}
		
		if(error == ""){
			subTotal = (selectedQuantity * selectedPrice);
			$("#td_sub_total_" + selectedItemsOrder).html("₱ " + subTotal);
			totalQty = 0;
			totalPrice = 0;
			$('.order_quantity').each(function(i, obj) {
				quantity = $(this).val();
				price = $(this).attr("data-price");
				totalQty = parseInt(totalQty) + parseInt(quantity);
				subTotal = (parseFloat(quantity) * parseFloat(price));
				totalPrice = parseFloat(totalPrice) + parseFloat(subTotal)
			});
			
			$("#td_quantity").html(totalQty);
			$("#td_price").html("₱ " + totalPrice);
		}
	});
	
	$(document).on("click", ".remove_items", function(){
		selectedOrderId = $(this).attr("data-id");
		selectedQuantity = $(this).attr("data-quantity");
		removePending = $.confirm({
			title : "Confirm", 
			content : "Are you sure you want to remove this item?", 
			buttons: {
				yes : {
					text : "YES", 
					btnClass : "btn-success", 
					action : function(){
						this.showLoading();
						$.ajax({
							method : "POST", 
							url : base_url + "/action/remove_ordered_items.php",
							data : {
								items_order : selectedOrderId, 
								quantity : selectedQuantity
							}, 
							dataType : "JSON", 
							success : function(response){
								output = response.output;
								message = response.message;
								header = response.header;
								$.alert({
									title : header, 
									content : message, 
									buttons : {
										okay : {
											text : "YES", 
											btnClass : "btn-success", 
											action : function(){
												removePending.close();
												if(output == "success"){
													location.reload();
												}
											}
										}
									}
								})
							}, 
							error : function(xhr){
								$.alert({
									title : "ERROR", 
									content : xhr.responseText, 
									type : 'red'
								})
							}
						});
						//remove_items(selectedLeave);
						return false;
					}
				}, 
				no : {
					text : "NO", 
					btnClass : "btn-danger"
				}
			}
		});
	});
	
	$(document).on("click", ".cancel_order", function(){
		selectedOrderId = $(this).attr("data-id");
		selectedQuantity = $(this).attr("data-quantity");
		removePending = $.confirm({
			title : "Confirm", 
			content : "Are you sure you want to cancel this order?", 
			buttons: {
				yes : {
					text : "YES", 
					btnClass : "btn-success", 
					action : function(){
						this.showLoading();
						$.ajax({
							method : "POST", 
							url : base_url + "/action/cancel_ordered_items.php",
							data : {
								items_order : selectedOrderId, 
								quantity : selectedQuantity
							}, 
							dataType : "JSON", 
							success : function(response){
								output = response.output;
								message = response.message;
								header = response.header;
								$.alert({
									title : header, 
									content : message, 
									buttons : {
										okay : {
											text : "YES", 
											btnClass : "btn-success", 
											action : function(){
												removePending.close();
												if(output == "success"){
													location.reload();
												}
											}
										}
									}
								})
							}, 
							error : function(xhr){
								$.alert({
									title : "ERROR", 
									content : xhr.responseText, 
									type : 'red'
								})
							}
						});
						//remove_items(selectedLeave);
						return false;
					}
				}, 
				no : {
					text : "NO", 
					btnClass : "btn-danger"
				}
			}
		});
	});
	
	$(document).on("click", ".view_history", function(){
		orderId = $(this).attr("data-id");
		$("#tbl_ordered_items>tbody>tr").removeClass("bg-secondary");
		$(this).closest('tr').addClass("bg-secondary");
		$.confirm({
			title : "Order History Details", 
			content: function () {
				var self = this;
				return $.ajax({
					url      : base_url + "/ajax/load_ordered_items_history.php",
					method   : 'GET', 
					data     : {
						order_id : orderId
					}
				}).done(function (response) {
					self.setContent(response);
				}).fail(function(xhr){
					console.log(xhr);
					self.setContent('Something went wrong.');
				});
			}, 
			onContentReady : function(){
				$(".jconfirm-content").css("overflow", "hidden");
			},
			columnClass: 'col-md-offset-3 col-md-6 col-md-offset-3', 
			containerFluid: true, 
			buttons : {
				close : {
					text : "Close", 
					btnClass : "btn-danger", 
					action : function(){
						$("#tbl_ordered_items>tbody>tr").removeClass("bg-secondary");
					}
				}
			}
		});
	});
});