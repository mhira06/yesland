$(function () {
	$("#tbl_documents_request").DataTable({
		"aaSorting": []
	});
	
	$(document).on("click", ".documents_request_action", function(){
		documentsRequestId = $(this).attr("data-id");
		action = $(this).attr("data-action");
		$("#tbl_documents_request>tbody>tr").removeClass("bg-secondary");
		$(this).closest('tr').addClass("bg-secondary"); 
		selectedStatus = "";
		actionDesc = "";
		switch(action){
			case "view":
				view_transaction_history(documentsRequestId);
			break;
			
			case "cancel":
				selectedStatus = "23";
				actionDesc = "Cancel";
			break;
		}
		
		if(action != "view"){
			data = {
				documents_request_id : documentsRequestId,
				selected_status : selectedStatus, 
				action_desc : actionDesc
			};
			update_documents_request(data, actionDesc);
		}
	});
});

function view_transaction_history(id){
	$.confirm({
		title : "Documents Request History", 
		content: function () {
			var self = this;
			return $.ajax({
				url      : base_url + "/ajax/load_documents_request_history.php",
				method   : 'GET', 
				data     : {
					documents_request_id : id
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
		buttons: {
			close : {
				text : "Close", 
				btnClass : "btn-danger"
			}
		}
	});
}
function update_documents_request(data, desc){
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
					save_document_status(data);
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

function save_document_status(data){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/save_documents_request_status.php",
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