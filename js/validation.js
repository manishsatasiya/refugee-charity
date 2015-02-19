
$(document).ready(function(){	
	/*$('select').each(function(index){
		var select_option_count = $(this).children().length;
		
		if(select_option_count > 10){
			if(!$(this).hasClass('select2')){
				$(this).addClass('select2');
			}
		}else{
			if(!$(this).hasClass('select2-wrapper')){
			$(this).addClass('select2-wrapper');
				
			}
		}
	});
	
	$('select.select2').select2();	
	$(".select2-wrapper").select2({minimumResultsForSearch: -1});
	
	$('select').change(function(){
		$(this).removeClass('error');
		$(this).next('span.error').remove();
	});*/

	//HTML5 editor
	//$('.text-editor').wysihtml5();
});

/*$.validator.setDefaults({
	submitHandler: function() { return true }
});*/

$(document).ready(function() {
	ComponentsPickers.init();
	$.validator.addMethod('comboboxNotNone', function(value, element) {
        return (value != '0');
    }, 'Please select an option.');
	
	$.validator.addMethod('lessthan', function(value, element) {
        return (value > '0');
    }, 'Please enter valid value.');

	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			username: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			confirm_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			agree: "Please accept our policy"
		}
	});

	$("#add_role_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable();
					}else{
						$(".containerfdfdf").show();
						$(".containerfdfdf").html(data);
						$('.containerfdfdf').find('p').css('color', 'red');
						$('.containerfdfdf').find('p').css('background-image', 'url("images/delete.png")');
						$('.containerfdfdf').find('p').css('background-repeat', 'no-repeat');
						$('.containerfdfdf').find('p').css('padding-left', '20px');
						
					}
				}
			});
			
		},
		rules: {
			user_roll_name: {
				required: true
			}
		},
		messages: {
			user_roll_name: "Please enter role."
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});

	$("#add_user_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable();
					}else{
						$(".containerfdfdf").show();
						$(".containerfdfdf").html(data);
						$('.containerfdfdf').find('p').css('color', 'red');
						$('.containerfdfdf').find('p').css('background-image', 'url("images/delete.png")');
						$('.containerfdfdf').find('p').css('background-repeat', 'no-repeat');
						$('.containerfdfdf').find('p').css('padding-left', '20px');
					}
				}
			});
			
		},
		rules: {
			user_roll_id: {
				comboboxNotNone: true
			},
			first_name:{				
				required:true
			},
			last_name:{				
				required:true
			},
			email:{				
				required:true,
				email: true
			},
			/*username:{				
				required:true
			},			
			password:{				
				required:true
			},
			password_confirm: {
				required:true,
				equalTo: "#reg_password"
			}*/
		},
		messages: {
			user_roll_id: "Please select role",
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			email: "Please enter your email",
			username: "Please enter username",
			password: "Please enter password"
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});

	$('#add_user_form_datatable #reg_email').change(function(){
		$('#add_user_form_datatable #reg_username').val($(this).val());
	});		
	
	$("#add_donations").validate({
		rules: {
			date_of_donation:{
				required:true
			},
			name_of_association:{
				required:true
			},
			what_was_donated_please_specify:{
				required:true
			},
			name_aid_of_receiver_from:{
				required:true
			},
			month:{
				comboboxNotNone: true
			},
			year: {
				comboboxNotNone: true
			}
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});

	$("#add_home_visit").validate({
		rules: {
			date_of_visit:{
				required:true
			},
			association_name:{
				required:true
			},
			location_of_visit:{
				required:true
			},
			id_no:{
				required:true
			},
			full_name_of_family_visited:{
				required:true
			},
			name_of_visitor_from_association:{
				required:true
			},
			another_visit_short_reason:{
				required:true
			},
			pictures_video_taken:{
				required:true
			},
			special_case:{
				required:true
			},
			level_of_need:{
				required:true
			},
			month:{
				comboboxNotNone: true
			},
			year: {
				comboboxNotNone: true
			}
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});

	$("#add_refugee").validate({
		rules: {
			association_name:{
				required:true
			},
			location_of_association:{
				required:true
			},
			full_name:{
				required:true
			},
			age:{
				required:true
			},
			gender:{
				required:true
			},
			nationality:{
				required:true
			},
			marital_status:{
				required:true
			},
			are_you_able_to_work:{
				required:true
			},
			need_of_medicationequipment:{
				required:true
			},
			where_do_you_live_location:{
				required:true
			},
			do_you_live_in_tent_house:{
				required:true
			},
			name_administrator:{
				required:true
			},
			special_case:{
				required:true
			},
			telephone_no:{
				required:true
			},
			total_number_of_people_in_house:{
				digits:true
			},
			month:{
				comboboxNotNone: true
			},
			year: {
				comboboxNotNone: true
			}
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});
	
	$("#add_document").validate({
		ignore: '',
		rules: {
			name:{
				required:true
			}/*,
			file:{			
				required:true
			}*/
		},
		messages: {
			name: "Please enter name",
			file: "Please select file"
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});

	$("#add_privilege_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			user_roll_id: {
				comboboxNotNone: true
			}
		},
		errorElement: 'span', //default input error message container
	    errorClass: 'help-block help-block-error', // default input error message class
	    focusInvalid: false, // do not focus the last invalid input
	    highlight: function (element) { // hightlight error inputs
            $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
            $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error'); // set success class to the control group
        }
	});
	
	$(document).ready(function(){	

		$("#show_dp").datepicker({
			format: 'D dd MM yyyy'
		});
		
		$('.input-append.date').datepicker({
			autoclose: true,
			format: 'D dd MM yyyy',
			todayHighlight: true
	    });
		$(document).on('change','#date', function (ev) {
			//alert('fsf');
			//alert($(this).attr('name'));
			$(this).removeClass('error');
			$(this).next('span.error').remove();
		});
		
		$("#date_year").datepicker( {
			format: " yyyy",
			viewMode: "years", 
			minViewMode: "years"
		});
		$('#show_dp_today').datepicker({
			autoclose: true,
			format: 'dd MM yyyy',
			todayHighlight: true
	    });

	});
	
	$('#btn_user_password_update').click(function(event) {

		if($('#user_password').val() == "")
		{
			$('#error_div').html('<span class="error"><label for="" generated="true" class="error">Please enter password.</label></span>');
		    return false;
		}
		else if($('#user_password_confirm').val() == "")
		{
			$('#error_div').html('<span class="error"><label for="" generated="true" class="error">Please enter Confirm password.</label></span>');
		    return false;
		}
		else if($('#user_password').val() != $('#user_password_confirm').val())
		{
			$('#error_div').html('<span class="error"><label for="" generated="true" class="error">password & confirm pass must be same.</label></span>');
		    return false;
		}
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'user_password' 	: $('#user_password').val(),
			'user_password_confirm' 	: $('#user_password_confirm').val(),
			'user_id' 	: $('input[name=user_staff_id]').val()
		};
		
		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: CI.base_url+'list_user/save_user_pass', // the url where we want to POST
			data 		: formData, // our data object
			success: function(data) {
				$('#error_div').html('');
				$('#message_div').html('<div class="alert alert-success"><button data-dismiss="alert" class="close"></button>'+data+'</div>');
				$('#user_password').val('');
				$('#user_password_confirm').val('');
			}
		})
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});
});	

$('.btn-delet').on('click', function () {
	return confirm('Are you sure want to delete?');
});