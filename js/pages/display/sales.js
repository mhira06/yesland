$(function () {
	$("#tbl_sales").DataTable({
		"aaSorting": []
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
});

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
