$(function () {
	$("#tbl_ordered_items").DataTable({
		"aaSorting": []
	});
	
	$(document).on("click", ".online_ordering_action", function(){
		orderId = $(this).attr("data-id");
		quantity = $(this).attr("data-quantity");
		action = $(this).attr("data-action");
		$("#tbl_ordered_items>tbody>tr").removeClass("bg-secondary");
		$(this).closest('tr').addClass("bg-secondary"); 
		selectedStatus = "";
		actionDesc = "";
		switch(action){
			case "view_history":
				view_transaction_histy(orderId);
			break;
			
			case "cancel":
				selectedStatus = "16";
				actionDesc = "Cancel";
			break;
			
			case "disapprove":
				selectedStatus = "17";
				actionDesc = "Disapprove";
			break;
			
			case "ready_for_pick":
				selectedStatus = "14";
				actionDesc = "Ready for pick-up";
			break;
			
			case "claimed":
				selectedStatus = "9";
				actionDesc = "Claim";
			break;
		}
		
		if(action != "view_history"){
			data = {
				order_id : orderId,
				selected_status : selectedStatus, 
				quantity : quantity
			};
			update_order(data, actionDesc);
		}
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

function update_order(data, desc){
	submitAnswer = $.confirm({
		title : "Confirm (" + desc + ")", 
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
					data.remarks = remarks;
					data.action_desc = desc;
					save_order_status(data);
					return false;
				}
			}, 
			no : {
				text : "NO", 
				btnClass : "btn-danger"
			}
		}
	});
}

function save_order_status(data){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/save_order_status.php",
		data : data, 
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
							submitAnswer.close();
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