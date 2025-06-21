$(function () {
	$("#tbl_leave_list").DataTable({
		"aaSorting": []
	});
	
	$(document).on("change", ".check_leave", function(){
		statusId = $(this).attr("data-status");
		if ($(this).is(":checked") && statusId == "1") {
			$(this).closest('tr').addClass("bg-secondary"); 
		}
		else{
			$(this).closest('tr').removeClass("bg-secondary");
			$(this).prop('checked', false)
		}
	});
	
	$("#tbl_leave_list tr").click(function(event) {
		if (event.target.type !== 'checkbox') {
			$(':checkbox', this).trigger('click');
		}
	});
	submitPending = "";
	$("#btn_submit_pending").on("click", function(){
		error = "";
		selectedLeave = [];
		$(".check_leave:checkbox:checked").each(function(){
			selectedLeave.push($(this).val());
		});
		if(selectedLeave.length <= 0){
			error = "No Selected Leave";
		}
		
		if(error != ""){
			$.alert({
				title : "ERROR", 
				content : error, 
				type : 'red'
			})
		}
		if(error == ""){
			submitPending = $.confirm({
				title : "Confirm", 
				content : "Are you sure you want to proceed?", 
				buttons: {
					yes : {
						text : "YES", 
						btnClass : "btn-success", 
						action : function(){
							this.showLoading();
							submit_pending_leave(selectedLeave);
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
	
	$("#btn_cancel_leave").on("click", function(){
		error = "";
		selectedLeave = [];
		$(".check_leave:checkbox:checked").each(function(){
			selectedLeave.push($(this).val());
		});
		if(selectedLeave.length <= 0){
			error = "No Selected Leave";
		}
		
		if(error != ""){
			$.alert({
				title : "ERROR", 
				content : error, 
				type : 'red'
			})
		}
		if(error == ""){
			submitPending = $.confirm({
				title : "Confirm", 
				content : "Are you sure you want to cancel selected leave?", 
				buttons: {
					yes : {
						text : "YES", 
						btnClass : "btn-success", 
						action : function(){
							this.showLoading();
							cancel_leave(selectedLeave);
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
	
	$(document).on("click", ".leave_action", function(){
		leaveId = $(this).attr("data-id");
		$(this).closest('tr').addClass("bg-secondary");
		$.confirm({
			title : "Leave Details", 
			content: function () {
				var self = this;
				return $.ajax({
					url      : base_url + "/ajax/load_leave_transaction_details.php",
					method   : 'GET', 
					data     : {
						leave_id : leaveId, 
						action : "view"
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
						$("#btn_view_" + leaveId).closest('tr').removeClass("bg-secondary");
					}
				}
			}
		});
	});
});

function submit_pending_leave(leave){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/submit_pending_leave.php",
		data : {
			leave : leave
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
							submitPending.close();
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

function cancel_leave(leave){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/cancel_leave.php",
		data : {
			leave : leave
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
							submitPending.close();
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