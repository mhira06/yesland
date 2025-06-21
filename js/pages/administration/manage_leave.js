approveLeave = "";
$(function () {
	$("#tbl_leave_list").DataTable({
		"aaSorting": []
	});
	
	$(document).on("click", ".leave_action", function(){
		leaveId = $(this).attr("data-id");
		action = $(this).attr("data-action");
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
						action : action
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
				approve : {
					text : "Approve", 
					btnClass : "btn-success", 
					action : function(){
						remarks = remarks = $("#txtarea_remars").val();
						approve_leave(leaveId, "3", remarks);
						return false;
					}
				}, 
				disapprove : {
					text : "Disapprove", 
					btnClass : "btn-danger", 
					action : function(){
						remarks = remarks = $("#txtarea_remars").val();
						approve_leave(leaveId, "4", remarks);
						return false;
					}
				}, 
				close : {
					text : "Close", 
					btnClass : "btn-warning", 
					action : function(){
						$("#btn_view_" + leaveId).closest('tr').removeClass("bg-secondary");
					}
				}
			}
		});
	});
});


function approve_leave(leave, selected_status, remarks){
	statusDesc = selected_status == "3" ? "approve" : "disapprove"
	approveLeave = $.confirm({
		title : "Confirm", 
		content : "Are you sure you want to <b>"+statusDesc+"</b> this leave?", 
		buttons: {
			yes : {
				text : "YES", 
				btnClass : "btn-success", 
				action : function(){
					this.showLoading();
					$.ajax({
						method : "POST", 
						url : base_url + "/action/approve_leave.php",
						data : {
							leave : leave, 
							selected_status : selected_status, 
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
										text : "Okay", 
										btnClass : "btn-success", 
										action : function(){
											approveLeave.close();
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