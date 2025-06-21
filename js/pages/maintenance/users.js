$(function () {
	$("#tbl_users").DataTable({
		"aaSorting": []
	});
	$(document).on("change.datetimepicker", "#txt_users_birthday", function(){
		date = $(this).val();
		dateNow = moment(new Date());
		
		age = dateNow.diff(date, 'years');
		$("#txt_users_age").val(age);
		//console.log(age);
	});
	
	$(document).on("change", "#slt_users_type", function(){
		generate_users_number();
		load_company_details();
	});
	
	$(document).on("click", ".users_action", function(){
		usersId = $(this).attr("data-id");
		usersType = $(this).attr("data-users_type");
		action = $(this).attr("data-action");
		switch(action){
			case "update_leave":
				update_leave(usersId);
			break;
		}
	});
});

function update_leave(id){
	leaveForm = $.confirm({
		title : "Users Leave Form", 
		content: function () {
			var self = this;
			return $.ajax({
				url      : base_url + "/pages/loads/load_leave_details.php",
				method   : 'GET', 
				data     : {
					users_id : id
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
				text : "SAVE", 
				btnClass : "btn-success", 
				action : function(){
					this.$$save.prop('disabled', true);
					this.$$cancel.prop('disabled', true);
					$("#div_leave_transaction_result").html(loading);
					formData = $("#frm_leave_details").serialize();
					$.ajax({
						url : base_url + "/action/save_users_leave.php", 
						type : "POST", 
						data : formData, 
						dataType : "JSON",
						success : function(response){
							output = response.output;
							message = response.message;
							displayMessage = alert_message(message, output);
							$("#div_leave_transaction_result").html(displayMessage);
							leaveForm.$$save.prop('disabled', false);
							leaveForm.$$cancel.prop('disabled', false);
							
							//leaveForm.close();
							
						}, 
						error : function(xhr){
							$.alert({
								title : "ERROR", 
								content : xhr.responseText
							});
						}
					});
					return false;
				}
			}, 
			cancel : {
				text : "CLOSE", 
				btnClass : "btn-danger"
			}
		}
	});
}
function generate_users_number(){
	userType = $("#slt_users_type").val();
	$.ajax({
		url : base_url + "/ajax/get_users_number.php", 
		type : "GET", 
		data : {
			users_type : userType
		}, 
		dataType : "json", 
		success : function(response){
			usersNumberDisplay = response.display;
			usersNumberValue = response.value;
			
			$("#txt_users_number").val(usersNumberDisplay);
			$("#hdn_users_number").val(usersNumberValue);
			$("#txt_users_name").val(usersNumberDisplay);
			//console.log(response);
			//$response = response;
			
		}, 
		error : function(xhr){
			console.log(xhr);
		}
	});
}

function load_company_details(){
	userType = $("#slt_users_type").val();
	$.ajax({
		url : base_url + "/ajax/load_users_company_details.php", 
		type : "GET", 
		data : {
			users_type : userType
		}, 
		success : function(response){
			$("#div_another_company_info").html(response);
			$("#txt_users_date_hired").datetimepicker({
				format: 'YYYY-MM-DD'
			});
			
			$("#slt_users_status").select2({
				theme: 'bootstrap4'
			});
			if(userType == "1"){
				$("#slt_users_rate_type").select2({
					theme: 'bootstrap4'
				});
			}
			//console.log(response);
			//$response = response;
			
		}, 
		error : function(xhr){
			console.log(xhr);
		}
	});
}
