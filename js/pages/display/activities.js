submitAnswer = "";
$(function () {
	$(document).on("click", ".activities_action", function(){
		activitiesId = $(this).attr("data-id");
		selectedStatus = $(this).attr("data-status");
		statusDesc = selectedStatus == "6" ? "join" : "not join";
		submitAnswer = $.confirm({
			title : "Confirm (" + statusDesc + ")", 
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
						submit_activities_answer(activitiesId, selectedStatus, remarks);
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
});

function submit_activities_answer(actitivity, statusId, remarks){
	$.ajax({
		method : "POST", 
		url : base_url + "/action/submit_activities_answer.php",
		data : {
			actitivity : actitivity, 
			status_id : statusId,
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