updateItem = "";
$(function () {
	$("#tbl_items").DataTable({
		"aaSorting": [],
		columnDefs: [
            {
				width: 25, 
				targets: 0 
			}, 
			{
				width: 25, 
				targets: 1 
			}
		]
	});
	
	$(document).on("click", ".items_action", function(){
		itemsSizeId = $(this).attr("data-items_size");
		$(this).closest('tr').addClass("bg-secondary");
		load_items_details(itemsSizeId);
	});
	
	$(document).on("change", ".items_size", function(){
		selectedSizes = $(this).val();
		itemsCount = $(this).attr("data-items_count");
		itemsColor = $("#slt_items_color_" + itemsCount).val();
		$.ajax({
			method : "POST", 
			url : base_url + "/ajax/load_items_stock_input.php",
			data : {
				size : selectedSizes, 
				item_count : itemsCount, 
				item_color : itemsColor
			}, 
			success : function(response){
				$("#div_items_stock_" + itemsCount).html(response);
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
	
	$(document).on("click", "#btn_add_items_color", function(){
		itemsCount = $("#hdn_items_colors_count").val();
		newItemCount = (parseInt(itemsCount) + 1);
		$.ajax({
			method : "GET", 
			url : base_url + "/ajax/load_items_color_input.php",
			data : {
				item_count : newItemCount
			}, 
			success : function(response){
				$("#div_items_color").append(response);
				$("#hdn_items_colors_count").val(newItemCount);
				$("#slt_items_color_" + newItemCount).select2({
					theme: 'bootstrap4'
				});
				$("#slt_items_sizes_" + newItemCount).select2({
					theme: 'bootstrap4'
				});
				
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
	$(document).on("click", "#btn_remove_items_color", function(){
		itemsCount = $("#hdn_items_colors_count").val();
		newItemCount = (parseInt(itemsCount) - 1);
		if(newItemCount > 0){
			$("#div_items_color_input_" + itemsCount).remove();
			$("#hdn_items_colors_count").val(newItemCount);
		}
		
	});
	
	$(document).on("change", ".check_item", function(){
		if ($(this).is(":checked")) {
			$(this).closest('tr').addClass("bg-secondary"); 
		}
		else{
			$(this).closest('tr').removeClass("bg-secondary");
			$(this).prop('checked', false)
		}
	});
	
	$("#btn_item_delete").on("click", function(){
		error = "";
		selectedItem = [];
		$(".check_item:checkbox:checked").each(function(){
			selectedItem.push($(this).val());
		});
		if(selectedItem.length <= 0){
			error = "No Selected Item";
		}
		
		if(error != ""){
			$.alert({
				title : "ERROR", 
				content : error, 
				type : 'red'
			})
		}
		
		if(error == ""){
			deleteItem = $.confirm({
				title : "Confirm", 
				content: function () {
					var self = this;
					return $.ajax({
						url      : base_url + "/ajax/load_remarks_form.php",
						method   : 'GET', 
						data     : {}
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
				buttons: {
					yes : {
						text : "YES", 
						btnClass : "btn-success", 
						action : function(){
							this.showLoading();
							remarks = $("#txtarea_remarks").val();
							delete_item(selectedItem, remarks);
							return false;
						}
					}, 
					no : {
						text : "NO", 
						btnClass : "btn-danger"
					}
				}
			})
		}
	});
	
	$(document).on("change", "#slt_update_items_type", function(){
		selectedItemType = $(this).val();
		if(selectedItemType != ""){
			url = "pages/maintenance/items.php";
			url += "?action=update_items";
			url += "&item_type=" + selectedItemType;
			location.href = base_url + "/" + url;
		}
	});
	
	$(document).on("change", "#slt_update_items", function(){
		selectedItemType = $("#slt_update_items_type").val();
		selectedItem = $(this).val();
		if(selectedItemType != ""){
			url = "pages/maintenance/items.php";
			url += "?action=update_items";
			url += "&item_type=" + selectedItemType;
			url += "&item=" + selectedItem;
			location.href = base_url + "/" + url;
		}
	});
});

function delete_item(items, remarks){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/delete_items.php",
		data : {
			items : items,
			remarks : remarks
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
							deleteItem.close();
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
	})
}

function load_items_details(itemSize){
	updateItem = $.confirm({
		title : "Items Details", 
		content: function () {
			var self = this;
			return $.ajax({
				url      : base_url + "/ajax/load_items_details.php",
				method   : 'GET', 
				data     : {
					items_size_id : itemsSizeId
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
			save : {
				text : "Save", 
				btnClass : "btn-success", 
				action : function(){
					this.showLoading();
					 var formData = new FormData($("#frm_items_stock")[0]);
					update_items(formData, itemsSizeId);
					return false;
					//$("#btn_update_items_" + itemsSizeId).closest('tr').removeClass("bg-secondary");
				}
			}, 
			close : {
				text : "Close", 
				btnClass : "btn-danger", 
				action : function(){
					$("#btn_update_items_" + itemsSizeId).closest('tr').removeClass("bg-secondary");
				}
			}
		}
	});
}

function update_items(data, itemSize){
	 $.ajax({
		type:'POST',
		url: base_url + "/action/save_items_update.php",
		data: data,
		dataType : "JSON", 
		cache:false,
		contentType: false,
		processData: false,
		success:function(data){
			output = data.output;
			message = data.message;
			header = data.header;
			if(output == "success"){
				$.alert({
					title : header, 
					content : message, 
					buttons : {
						Okay : {
							text : "Okay", 
							action : function(){
								location.reload();
								//$("#btn_update_items_" + itemSize).click();
							}
						}
					}
					
				});
			}
			else{
				displayMessage = alert_message(message, output);
				$("#div_transaction_result").html(displayMessage);
				updateItem.hideLoading();
			}
			
			//load_items_details(itemSize);
			
			//console.log("success");
			//console.log(data);
		},
		error: function(xhr){
			updateItem.close();
			$.alert({
				title : "ERROR", 
				content : xhr.responseText, 
				type : 'red', 
				buttons : {
					Okay : {
						text : "Okay", 
						action : function(){
							load_items_details(itemSize);
							//$("#btn_update_items_" + itemSize).click();
						}
					}
				}
				
			});
			
		}
	});
}