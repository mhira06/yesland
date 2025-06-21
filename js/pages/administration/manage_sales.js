var importSales = "";
$(function () {
	$("#tbl_sales").DataTable({
		"aaSorting": []
	});
	
	$(document).on("click", "#a_client", function(){
		clientsForm = $.confirm({
			title : "Client Details", 
			content: function () {
				var self = this;
				return $.ajax({
					url      : base_url + "/ajax/load_clients_form.php",
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
			columnClass: 'col-md-offset-3 col-md-6 col-md-offset-3', 
			containerFluid: true, 
			buttons : {
				save : {
					text : "Save", 
					btnClass : "btn-success", 
					action : function(){
						this.showLoading();
						formData = $("#frm_clients").serialize();
						submit_clients_data(formData);
						return false;
					}
				}, 
				close : {
					text : "Close", 
					btnClass : "btn-danger"
				}
			}
		});
	});
	
	$(document).on("click", ".view_sales", function(){
		summaryType = $(this).attr("data-summary");
		salesAction = $("#hdn_sales_action").val();
		url = "action/search_sales.php";
		url += "?action=" + salesAction;
		url += "&summary=" + summaryType;
		location.href = base_url + "/" + url;
	});
	
	$(document).on("click", "#btn_download", function(){
		$.confirm({
			title : "Download Options", 
			content: function () {
				var self = this;
				return $.ajax({
					url      : base_url + "/ajax/load_downloads_form.php",
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
			buttons : {
				save : {
					text : "Download", 
					btnClass : "btn-success", 
					action : function(){
						this.showLoading();
						action = $("#hdn_sales_action").val();
						downloadType = $("#slt_download_type").val();
						downloadFileType = $("#slt_download_file_type").val();
						url = "downloads/";
						url += downloadFileType + "/";
						url += downloadFileType + "_sales_list.php";
						url += "?action=" + action;
						url += "&type=" + downloadType;
						location.href = base_url + "/" + url;
						this.close();
						return false;
					}
				}, 
				close : {
					text : "Close", 
					btnClass : "btn-danger"
				}
			}
		});
	});
	
	$(document).on("click", ".sales_action", function(){
		action = $(this).attr("data-action");
		salesId = $(this).attr("data-id");
		$(this).closest('tr').addClass("bg-secondary");
		switch(action){
			case "cancel":
				selectedStatus = "11";
				actionDesc = "Cancel";
			break;
		}
		data = {
			sales_id : salesId, 
			status_id : selectedStatus
		}
		update_sales(data, actionDesc)
	});
	
	$(document).on("click", "#btn_import", function(){
		importSales = $.confirm({
			title : "Import Options", 
			content: function () {
				var self = this;
				return $.ajax({
					url      : base_url + "/ajax/load_import_form.php",
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
			buttons : {
				save : {
					text : "Import", 
					btnClass : "btn-success", 
					action : function(){
						this.showLoading();
						var formData = new FormData($("#frm_import_sales")[0]);
						upload_sales(formData);
						return false;
					}
				}, 
				close : {
					text : "Close", 
					btnClass : "btn-danger"
				}
			}
		});
	});
});
function upload_sales(data){
	$.ajax({
		type:'POST',
		url: base_url + "/action/save_import_sales.php",
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
				importSales.hideLoading();
			}
			
			//load_items_details(itemSize);
			
			//console.log("success");
			//console.log(data);
		},
		error: function(xhr){
			$.alert({
				title : "ERROR", 
				content : xhr.responseText, 
				type : 'red', 
				buttons : {
					Okay : {
						text : "Okay", 
						action : function(){
							importSales.hideLoading();
							//$("#btn_update_items_" + itemSize).click();
						}
					}
				}
				
			});
			
		}
	});
}

function update_sales(data, desc){
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
					save_sales_status(data);
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

function save_sales_status(data){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/save_sales_status.php",
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
				type : 'red', 
				buttons : {
					okay : {
						text : "YES", 
						btnClass : "btn-success", 
						action : function(){
							submitAnswer.hideLoading();
						}
					}
				}
			})
		}
	})
}

function submit_clients_data(data){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/save_clients_data.php",
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
						text : "OKAY", 
						btnClass : "btn-success", 
						action : function(){
							clientsForm.close();
							if(output == "success"){
								location.reload();
							}
							else{
								$("#a_client").click();
								//clientsForm.open();
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