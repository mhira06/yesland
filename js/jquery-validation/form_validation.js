$(function () {
	$('#frm_change_password').validate({
		rules: {
			txt_old_password: {
				required: true, 
				remote : {
					url: base_url + "/ajax/check_old_password.php",
					type: "POST",
					cache: false,
					dataType: "json",
					error : function(xhr){
						console.log(xhr.responseText);
					}
				}
			},
			txt_new_password: {
				required: true,
				minlength: 8
			},
			txt_confirm_password: {
				required: true,
				minlength: 8, 
				equalTo : "#txt_new_password"
			},
		},
		messages: {
			txt_old_password: {
				required: "Required"
			},
			txt_new_password: {
				required: "Required",
				minlength: "Your password must be at least 8 characters long"
			},
			txt_confirm_password: {
				required: "Required",
				minlength: "Your password must be at least 8 characters long", 
				equalTo : "Not equal to new password."
			}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.col-sm-10').append(error);
			element.closest('.validate-input').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}, 
		submitHandler : function (form) {
			formData = $("#frm_change_password").serialize();
			formMethod = $("#frm_change_password").attr("method");
			formAction = $("#frm_change_password").attr("action");
			$.ajax({
				url : formAction, 
				type : formMethod, 
				data : formData, 
				dataType : "json", 
				success : function(response){
					output = response.output;
					message = response.message;
					displayMessage = alert_message(message, output);
					$("#div_result").html(displayMessage);
					if(output == "success"){
						$("#txt_old_password").val("");
						$("#txt_new_password").val("");
						$("#txt_confirm_password").val("");
						changePasswordSource = $("#hdn_change_password_source").val()
						if(changePasswordSource == "login"){
							location.href = base_url + "/pages/display/dashboard.php";
						}
					}
				}, 
				error : function(xhr){
					$.alert({
						title : "Error", 
						content : xhr.contentText, 
						buttons : {
							okay : {
								text : "OKAY", 
								btnClass : "btn-primary"
							}
						}
					});
				}
			});
			return false;
		}
	});
	
	$('#frm_users').validate({
		rules: {
			txt_users_first_name : "required", 
			txt_users_last_name : "required",
			txt_users_birthday : "required", 
			slt_users_type : "required", 
			slt_users_status : "required", 
			txt_users_position : "required", 
			txt_users_date_hired : "required", 
			slt_users_rate_type : {
				required : function(element){
					return $("#slt_users_type").val() == "1";
				}
			},
			txt_users_rate_value : {
				required : function(element){
					return $("#slt_users_type").val() == "1";
				}
			},
			slt_users_login_type : "required", 
			txt_users_password : {
				required : function(element){
					return $("#hdn_action").val() == "add";
				}
			}
		},
		messages: {
			txt_users_first_name : "Required Field", 
			txt_users_last_name : "Required Field",
			txt_users_birthday : "Required Field", 
			slt_users_type : "Required Field", 
			slt_users_status : "Required Field", 
			txt_users_position : "Required Field", 
			txt_users_date_hired : "Required Field",
			slt_users_rate_type : {
				required : "Required Field"
			},
			txt_users_rate_value : {
				required : "Required Field"
			},
			slt_users_login_type : "Required Field", 
			txt_users_password : {
				required : "Required Field"
			}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.col-sm-9').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	$('#slt_users_type').on('change', function () {
		$(this).valid();
	});
	
	$('#slt_users_status').on('change', function () {
		$(this).valid();
	});
	
	$('#slt_users_rate_type').on('change', function () {
		$(this).valid();
	});
	
	$('#slt_users_login_type').on('change', function () {
		$(this).valid();
	});
	
	$('#frm_request_leave').validate({
		rules: {
			slt_leave_type : "required", 
			txt_leave_date : {
				required : true
			}, 
			txtarea_leave_reason : "required"
		}, 
		messages : {
			slt_leave_type : "Required", 
			txt_leave_date : {
				required : "Required"
			}, 
			txtarea_leave_reason : "Required"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	$('#slt_leave_type').on('change', function () {
		$(this).valid();
	});
	
	$('#frm_activities').validate({
		rules: {
			txt_activities_title : "required", 
			txt_activities_desc : "required", 
			txt_activities_location : "required", 
			txt_activities_dates : "required", 
			"slt_activities_attendees[]" : "required", 
			txt_activities_date_end : "required"
		}, 
		messages : {
			txt_activities_title : "Required Field", 
			txt_activities_desc : "Required Field", 
			txt_activities_location : "Required Field", 
			txt_activities_dates : "Required Field", 
			"slt_activities_attendees[]" : "Required Field", 
			txt_activities_date_end : "Required Field"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	$('#slt_activities_attendees').on('change', function () {
		$(this).valid();
	});
	
	$('#frm_add_sales').validate({
		rules: {
			slt_sales_client : "required", 
			txt_sales_project : "required", 
			txt_sales_location : "required", 
			txt_sales_date_reservation : "required", 
			txt_sales_price : "required", 
			txt_sales_quantity : "required", 
			slt_sales_agent : "required"
		}, 
		messages : {
			slt_sales_client : "Required Field", 
			txt_sales_project : "Required Field", 
			txt_sales_location : "Required Field", 
			txt_sales_date_reservation : "Required Field", 
			txt_sales_price : "Required Field", 
			txt_sales_quantity : "Required Field", 
			slt_sales_agent : "Required Field"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});

	$('#slt_sales_client').on('change', function () {
		$(this).valid();
	});
	
	$('#slt_sales_agent').on('change', function () {
		$(this).valid();
	});
	
	$('#frm_documents_request').validate({
		rules: {
			slt_documents_request_document_type : "required", 
			txt_documents_request_other_document : {
				required :  function(element){
					return $("#slt_documents_request_document_type :selected").text() == "Others";
				}
			}, 
			txt_documents_request_date_need : "required", 
			txtarea_document_request_purpose : "required"
		}, 
		messages : {
			slt_documents_request_document_type : "Required Field", 
			txt_documents_request_other_document : {
				required : "Required Field"
			}, 
			txt_documents_request_date_need : "Required Field", 
			txtarea_document_request_purpose : "Required Field"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	$('#slt_documents_request_document_type').on('change', function () {
		$(this).valid();
	});
	
	$('#frm_items').validate({
		rules: {
			slt_items_type : "required", 
			txt_items_name : "required"
		}, 
		messages : {
			slt_items_type : "Required Field", 
			txt_items_name : "Required Field", 
			items_size : "Required Field"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
			element.closest('.col-sm-10').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
			
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	$('#frm_update_items').validate({
		rules: {
			slt_update_items_type : "required", 
			slt_update_items : "required"
		}, 
		messages : {
			slt_update_items_type : "Required Field", 
			slt_update_items : "Required Field", 
			items_size : "Required Field"
		}, 
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.input').append(error);
			element.closest('.col-sm-10').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
			
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
	
	jQuery.validator.addClassRules({
		items_size : {
			required: true
		}
	});
	
	$('.items_size').on('change', function () {
		$(this).valid();
	});
});