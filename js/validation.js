
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
	
	// validate signup form on keyup and submit
	$("#add_school_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			school_name: "required",
			principal: "required",
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			school_name: "Please enter your school name",
			principal: "Please enter your principal",
			email: "Please enter a valid email address"
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_school_year_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			school_id: {
				comboboxNotNone: true
			},
			school_year:{
				digits: true,
				required:true,
				minlength: 4,
				maxlength: 4
			},
			school_week:{
				lessthan: true,
				digits: true,
				required:true
			},
			school_year_title:{
				required:true
			}
		},
		messages: {
			school_id: "Please enter your school name",
			school_year_title: "Please enter school year title"
		}
	});


	// validate add school year form on keyup and submit
	$("#add_student_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			section_id: {
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
			username:{				
				required:true
			},
			password:{				
				required:true
			},
			password_confirm: {
			  	equalTo: "#reg_password"
			},
			student_uni_id: {
				required:true
			}
		},
		messages: {
			section_id: "Please enter section name",
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			email: "Please enter your email",
			username: "Please enter username",
			password: "Please enter password",
			student_uni_id: "Please enter student university id."
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_teacher_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			name_suffix: {
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
			username:{				
				required:true
			},			
			password:{				
				required:true
			},
			password_confirm: {
				required:true,
			  	equalTo: "#reg_password"
			}
		},
		messages: {			
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			email: "Please enter your email",
			birth_date: "Please enter your brith date",
			birth_place: "Please enter your brith place",
			username: "Please enter username",
			password: "Please enter password"
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_course_category_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			category_title: {
				required: true
			}
		},
		messages: {			
			category_title: "Please enter course category title"
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_course_section_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			section_title: {
				required: true
			}
		},
		messages: {			
			section_title: "Please enter course section"
		}
	});
	// validate add school year form on keyup and submit
	$("#add_course_class_room_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			class_room_title: {
				required: true
			}
		},
		messages: {			
			class_room_title: "Please enter course class room"
		}
	});
	// validate add school year form on keyup and submit
	$("#add_courses_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			
			course_title:{				
				required: true
			},
		max_hours:{				
			required:true,
			digits: true,
			lessthan: true
		}
			
		},
		messages: {			
			course_title: "Please enter course title"
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_courses_subject_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			school_id: {
				comboboxNotNone: true
			},
			school_year_id:{				
				comboboxNotNone: true
			},
			subject_title:{				
				required:true
			},
			subject_code:{				
				required:true
			}
		},
		messages: {			
			subject_title: "Please enter subject title",
			subject_code: "Please enter subject code"
		}
	});
	
	// validate add school year form on keyup and submit
	$("#add_course_class_form").validate({
		submitHandler: function(form) {
			form.submit();
		},
		rules: {
			
			school_year_id:{				
				comboboxNotNone: true
			},
			course_id:{				
				comboboxNotNone: true
			},
			category_id:{				
				comboboxNotNone: true
			},
			primary_teacher_id:{				
				comboboxNotNone: true
			},
			class_room_id:{				
				comboboxNotNone: true
			},
			section_id:{				
				comboboxNotNone: true
			}
		}
	});
	
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
	
	$("#add_student_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					if(CI.controller_name == 'list_student'){
						parent.reload_datatable();
					}else{
						window.location.href = CI.base_url+'list_student';
					}
				}
			});
		},
		rules: {
			section_id: {
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
			username:{				
				required:true
			},
			password:{				
				required:true
			},
			password_confirm: {
			  	equalTo: "#reg_password"
			},
			student_uni_id: {
				required:true
			}
		},
		messages: {
			section_id: "Please enter section name",
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			email: "Please enter your email",
			username: "Please enter username",
			password: "Please enter password",
			student_uni_id: "Please enter student university id."
		}
	});
	//code to hide topic selection, disable for demo
	//var newsletter = $("#newsletter");
	// newsletter topics are optional, hide at first
	//var inital = newsletter.is(":checked");
	//var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
	//var topicInputs = topics.find("input").attr("disabled", !inital);
	// show when newsletter is checked
	/*newsletter.click(function() {
		topics[this.checked ? "removeClass" : "addClass"]("gray");
		topicInputs.attr("disabled", !this.checked);
	});*/
	
	$("#add_campus_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						parent.reload_datatable();
						$('#myModal').delay(1000).modal('hide');
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
			campus_name: {
				required: true
			},
			campus_location: {
				required: true
			}
		},
		messages: {
			campus_name: "Please enter campus name",
			campus_location: "Please enter campus location"
		}
	});
	
	$("#add_school_year_form_datatable").validate({
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
			school_id: {
				comboboxNotNone: true
			},
			school_year: {
				digits: true,
				required:true,
				minlength: 4,
				maxlength: 4
			},
			school_week:{
				lessthan: true,
				digits: true,
				required:true
			},
			school_year_title:{			
				required:true
			}
		},
		messages: {
			school_id: "Please enter your school name",
			school_year_title: "Please enter school year title"	
		}
	});
	
	if(CI.controller_name == 'list_student')
	{
		
	}
		
	$("#add_teacher_form_datatable").validate({
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
			elsd_id: {
				required: true
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
			username:{				
				required:true
			},			
			password:{				
				required:true
			},
			password_confirm: {
				required:true,
				equalTo: "#reg_password"
			}
		},
		messages: {
			elsd_id: "Please enter ELSD ID",
			first_name: "Please enter your first name",
			last_name: "Please enter your last name",
			email: "Please enter your email",
			username: "Please enter username",
			password: "Please enter password"
		}
	});
	
	$("#add_course_form_datatable").validate({
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
			course_title:{				
				required: true
			},
			max_hours:{				
				required:true,
				digits: true,
				lessthan: true
			}
		},
		messages: {
			course_title: "Please enter course title"
		}
	});
	
	$("#add_section_form_datatable").validate({
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
			section_title: {
				required: true
			}
		},
		messages: {
			section_title: "Please enter course section"
		}
	});
	
	$("#add_class_room_form_datatable").validate({
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
			class_room_title: {
				required: true
			}
		},
		messages: {
			class_room_title: "Please enter course class room"
		}
	});
	
	$("#add_course_class_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						if(CI.controller_name == 'list_course_class'){
							parent.reload_datatable();
						}else{
							window.location.href = CI.base_url+'list_course_class';
						}
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
			
			school_year_id:{				
				comboboxNotNone: true
			},
			course_id:{				
				comboboxNotNone: true
			},
			primary_teacher_id:{				
				comboboxNotNone: true
			},
			class_room_id:{				
				comboboxNotNone: true
			},
			section_id:{				
				comboboxNotNone: true
			}
		}
	});

	$('#add_course_class_form_datatable #reg_section_id').change(function(event) {
		
		if($(this).val() == "")
		{
		    return false;
		}
		getsectionshifttime($(this).val());
	});
	
	$('#add_course_class_form_datatable #reg_course_id').change(function(event) {
		
		if($(this).val() == "")
		{
		    return false;
		}
		getcourseDays($(this).val());
	});

	$('#add_student_form_datatable #reg_section_id').change(function(event) {
		
		if($(this).val() == "")
		{
		    return false;
		}
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			
		};

		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: CI.base_url+'list_course_class/get_section_time/'+$(this).val(), // the url where we want to POST
			data 		: formData, // our data object
			success: function(data) {
				var objData = $.parseJSON(data);
				
				$('#add_student_form_datatable #section_time').text(objData.section_time);
			}
		});
	});
	
	$("#add_grade_type_form_datatable").validate({
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
			grade_type: {
				required: true
			},
			total_percentage: {
				required: true,
				number: true
			},
			total_percentage: {
				number: true
			}
		},
		messages: {
			grade_type: "Please enter grade type",
			total_percentage: "Please enter percentage"
		}
	});
	
	$("#add_grade_type_exam_form_datatable").validate({
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
			exam_type_name: {
				required: true
			},
			exam_marks: {
				number: true
			},
			exam_percentage: {
				number: true
			},
			
		},
		messages: {
			exam_type_name: "Please enter grade exam type"
		}
	});
	
	
	$("#add_grade_range_form_datatable").validate({
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
			grade_min_range: {
				required: true
			},
			grade_max_range: {
				required: true
			},
			grade_name: {
				required: true
			}
		},
		messages: {
			grade_min_range: "Please enter minimum ragne",
			grade_max_range: "Please enter maximum range",
			grade_name: "Please enter grade"
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
		}
	});

	$("#sis_settings_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						alert('Something went wrong.');
					}else{
						$(form).find("div.show_msg").html(data).show();
						setTimeout('$("div.show_msg").slideUp(800)', 2000);
					}
				}
			});			
		},
		rules: {
			attendance_time_limit: {
				required: true,number: true
			},
			grade_time_limit: {
				required: true,number: true
			},
			session_time: {
				required: true,number: true
			}
		},
		messages: {
			//user_roll_name: "Please enter role."
		}
	});

	$("#portal_settings_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						alert('Something went wrong.');
					}else{
						$(form).find("div.show_msg").html(data).show();
						setTimeout('$("div.show_msg").slideUp(800)', 2000);
					}
				}
			});			
		},
		rules: {
			min_experience: {
				required: true,number: true
			},
			min_referee_count: {
				required: true,number: true
			}
		},
		messages: {
			//user_roll_name: "Please enter role."
		}
	});

	$("#elsd_id_setting_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						alert('Something went wrong.');
					}else{
						$(form).find("div.show_msg").html(data).show();
						setTimeout('$("div.show_msg").slideUp(800)', 2000);
					}
				}
			});			
		},
		rules: {
			elsd_year: {
				required: true,number: true
			},
			elsd_number: {
				required: true,number: true
			}
		},
		messages: {
			//user_roll_name: "Please enter role."
		}
	});
	
	if(CI.controller_name == 'list_user')
	{
	}	
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

	$('#add_user_form_datatable #reg_email').keyup(function(){
		$('#add_user_form_datatable #reg_username').val($(this).val());
	});	
	
	if(CI.controller_name == 'workshops')
	{
		$('#reg_time').timepicker({});
	}
	
	$("#add_workshop_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			presenter: {
				comboboxNotNone: true
			},
			guest_speaker:{				
				required:true
			},
			title:{				
				required:true
			},
			attendee_limit:{				
				required:true
			},
			topic:{				
				required:false,
			},
			venue:{				
				required:false
			},
			time:{				
				required:true
			},
			start_date: {
				required:true
			},
			semester: {
				comboboxNotNone: true
			},
			workshop_type_id: {
				comboboxNotNone: true
			},
			status: {
				comboboxNotNone: true
			}			
		},
		messages: {
			presenter: "Please selct presenter",
			guest_speaker: "Please enter guest speaker name",
			title: "Please enter your title",
			attendee_limit: "Please enter attendee limit",
			time: "Please enter time",
			start_date: "Please select date",
			semester: "Please select semester",
			workshop_type_id: "Please select required",
			status: "Please select status"
		}
	});

	$("#add_workshop_form_datatable #guest").change(function(){
		var guest = $(this).prop('checked');
		if (guest == true) 
		{
			$("#add_workshop_form_datatable #presenter_box").hide();
			$("#add_workshop_form_datatable #presenter_box #presenter").attr("disabled", "true");
			$("#add_workshop_form_datatable #guest_speaker_box").show();
			$("#add_workshop_form_datatable #guest_speaker_box #guest_speaker").removeAttr("disabled");
		}else{
			$("#add_workshop_form_datatable #presenter_box").show();
			$("#add_workshop_form_datatable #presenter_box #presenter").removeAttr("disabled");
			$("#add_workshop_form_datatable #guest_speaker_box").hide();
			$("#add_workshop_form_datatable #guest_speaker_box #guest_speaker").attr("disabled", "true");
		}
	});
	
	$("#add_attendee_form").validate({
		submitHandler: function(form) {
			//form.submit();
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
			attendee: {
				comboboxNotNone: true
			},
			workshop_id: {
				comboboxNotNone: true
			}			
		},
		messages: {
			attendee: "Please selct attendee",
			workshop_id: "Please select workshop"
		}
	});
	
	$("#add_contractors_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_contractors();
				}
			});
		},
		rules: {
			contractor:{				
				required:true
			}			
		},
		messages: {
			contractor: "Please enter contractor"
		}
	});

	$("#add_curriculum_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					location.reload();
				}
			});
		},
		rules: {
			unit:{				
				required:true
			},
			task:{				
				required:true
			},
			page:{				
				required:true
			}
		},
		messages: {
			unit: "Please enter unit",
			task: "Please enter task",
			page: "Please enter page"
		}
	});
	
	$("#add_workshop_type_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			type:{				
				required:true
			}			
		},
		messages: {
			type: "Please enter workshop type"
		}
	});
	
	$("#add_duties_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			user_roll_id: {
				comboboxNotNone: true
			},
			duties:{				
				required:true
			}			
		},
		messages: {
			user_roll_id: "Please select role",
			duties: "Please enter duties"
		}
	});
	
	
	
	//edit_profile Validations
	if($("#orig_status").val() > 12)
	{
		var $edit_validator = $("#edit_profile").validate({
				
			  rules: {
				title: {
				  required: true
				},
				first_name: {
				  required: true
				},
				last_name: {
				  required: true
				},
				gender: {
				  required: true
				},
				username: {
				  required: true
				},
				confirm_password: {
					equalTo: "#password"
				},
				user_roll_id: {
				  comboboxNotNone: true
				},
				contractor: {
				  required: true
				},
				cell_phone: {
				  required: true
				}
			  },
			  messages: {
				title: "Please select title",
				first_name:"Please enter first name",
				last_name:"Please enter last anme",
				gender:"Please select gender",
				username:"Please enter User Name",
				confirm_password: {
					equalTo: "Please enter the same password"
				},			
				user_roll_id:"Please select KSU role",
				system_roll_id:"Please select System role",
				returning:"Please select returning employee",
				contractor:"Please select contracor",
				cell_phone:"Please enter your mobile"
			  },
			  errorPlacement: function(label, element) {
					$('<span class="arrow"></span>').insertBefore(element);
					$('<span class="error"></span>').insertAfter(element).append(label)
				}
			});
	}
	else
	{
		var $edit_validator = $("#edit_profile").validate({
			  rules: {
				title: {
				  required: true
				},
				first_name: {
				  required: true
				},
				last_name: {
				  required: true
				},
				gender: {
				  required: true
				},
				contractor: {
				  required: true
				}
			  },
			  messages: {
				title: "Please select title",
				first_name:"Please enter first name",
				last_name:"Please enter last anme",
				gender:"Please select gender",
				contractor:"Please select contracor"
			  },
			  errorPlacement: function(label, element) {
					$('<span class="arrow"></span>').insertBefore(element);
					$('<span class="error"></span>').insertAfter(element).append(label)
				}
			});
	}
	
	$("#add_user_qualifications").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			qualification_id: {
				comboboxNotNone: true
			},
			subject_related:{
				comboboxNotNone: true
			}
		},
		messages: {
			qualification_id: "Please select Qualification",
			subject_related: "Please select English Related",
			date: "Please select Date"
		}
	});
	
	$("#add_user_certificate").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			certificate_id: {
				comboboxNotNone: true
			}
		},
		messages: {
			qualification_id: "Please select certificate",
			date: "Please select Date"
		}
	});
	
	$("#add_user_experience").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			company: {
				required:true
			},
			position:{
				required:true
			},
			start_date:{			
				required:true
			},
			end_date:{
				required:true
			},
			departure_reason:{			
				required:true
			}
		},
		messages: {
			company: "Please enter company",
			position: "Please enter position",
			start_date: "Please select start date",
			end_date: "Please select end ate",
			departure_reason: "Please enter leaving reason"
		}
	});
	
	$("#add_user_reference").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			company_name: {
				required:true
			},
			name:{
				required:true
			},
			email:{			
				required:true
			}
		},
		messages: {
			company_name: "Please enter company",
			name: "Please enter name",
			email: "Please enter email"
		}
	});
	
	$("#add_emergency_contact").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			name: {
				required:true
			},
			relation:{
				required:true
			},
			contact_number:{			
				required:true
			}
		},
		messages: {
			name: "Please enter name",
			relation: "Please enter relation",
			contact_number: "Please enter contact number"
		}
	});
	
	$("#add_appointment").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			date: {
				required:true
			},
			time:{
				required:true
			},
			details:{			
				required:true
			}
		},
		messages: {
			date: "Please select date",
			time: "Please enter time",
			details: "Please enter details"
		}
	});

	$("#add_email_message_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			subject: {
				required:true
			},
			message:{			
				required:true
			}
		},
		messages: {
			subject: "Please enter subject",
			details: "Please enter message"
		}
	});

	$("#add_donations").validate({
		rules: {
			date_of_donation:{
				required:true
			},
			name_of_association:{
				required:true
			},
			name_of_donator:{
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
			'campus_id[]': {
				required:true,
				minlength: 1
			},
			roll_id: {
				comboboxNotNone: true
			},
			name:{
				required:true
			}/*,
			file:{			
				required:true
			}*/
		},
		messages: {
			'campus_id[]': "Please select campus",
			roll_id: "Please select roll",
			name: "Please enter name",
			file: "Please select file"
		}
	});
	
	$("#add_document_model").validate({
		ignore: '',
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					window.location.href = CI.base_url+'documents';
				}
			});
		},
		rules: {
			'campus_id[]': {
				required:true,
				minlength: 1
			},
			roll_id: {
				comboboxNotNone: true
			},
			name:{
				required:true
			}/*,
			file:{			
				required:true
			}*/
		},
		messages: {
			'campus_id[]': "Please select campus",
			roll_id: "Please select roll",
			name: "Please enter name",
			file: "Please select file"
		}
	});
	
	$("#add_contracted_numbers_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			contractor_id: {
				comboboxNotNone: true
			},
			campus_id: {
				comboboxNotNone: true
			},
			user_roll_id: {
				comboboxNotNone: true
			},
			contracted_numbers:{				
				required:true
			}			
		},
		messages: {
			contractor_id: "Please select contractor",
			campus_id: "Please select campus",
			user_roll_id: "Please select role",
			contracted_numbers: "Please enter number"
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
	
	var $add_emp_validator = $("#add_employee").validate({
		  rules: {
			status: {
		      required: true,
		    }, 
		    first_name: {
		      required: true
		    },
			last_name: {
		      required: true
		    },
			gender: {
		      comboboxNotNone: true
		    },
			birth_date: {
		      required: true,
		    },
		    expected_arrival_date: {
		      required: true,
		    },
			nationality: {
			  //required: true,
		      comboboxNotNone: true,
		    },
		    visa_type: {
			  //required: true,
		      comboboxNotNone: true,
		    },
			worked_at_ksu_before: {
			  //required: true,
		      comboboxNotNone: true,
		    },
		    cell_phone: {
		      required: true,
		    }
		  },
		  messages: {
			status: "Please select status",
			first_name:"Please enter first name",
			last_name:"Please enter last name",
			gender:"Please select gender",
			username:"Please enter User Name",
			birth_date:"Please select birthdate",
			expected_arrival_date:"Please Select Expected Arrival Date",
			nationality:"Please select nationality",
			visa_type:"Please select visa type",
			worked_at_ksu_before:"Please Select Worked at KSU before?",
			cell_phone:"Please enter mobile"
		  },
		  errorPlacement: function(label, element) {
				//$('<span class="arrow"></span>').insertBefore(element);
				$('<span class="error"></span>').insertAfter(element).append(label)
			}
		});
	$("#add_employee").on( "submit", function() {
		
		var hasError = false;
		var first_error_input_id = '';
		$("#add_employee #references li,#add_employee #experiences li,#add_employee #certificates li,#add_employee #qualifications li").find('input[type="text"],select').each(function(){

			if(typeof $(this).closest('div.select2-container').html() == 'undefined') {
				if($(this).val() == '' && $(this).attr('id') != "departure_reason"){
					
					//$(this).before('<span class="error"><label for="" generated="true" class="error">This field is required.</label></span>');
					if(!$(this).hasClass('error')){
						$(this).addClass('error');
					}
					hasError = true;
					if(first_error_input_id == ''){
						first_error_input_id = $(this);
					}
				}else{
					$(this).removeClass('error');
				}
			}
		});
		if(hasError) {
			var $valid = $("#add_employee").valid();
	  		if($valid) {
				first_error_input_id.focus();
			}
			return false;
		}
		//alert('ttttt');
		//return false;
	});
		
	$("#add_obs_comment").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			comment:{				
				required:true
			}			
		},
		messages: {
			comment: "Please enter comment."
		}
	});
		
	$("#add_course_class_comment").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			comment:{				
				required:true
			}			
		},
		messages: {
			comment: "Please enter comment."
		}
	});
	
	$("#add_obs_score").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			score:{				
				comboboxNotNone: true
			},
			et_score:{				
				comboboxNotNone: true
			}
		},
		messages: {
			score: "Please select Observation Score.",
			et_score: "Please select EdTech Score."
		}
	});
	
	$("#add_nationality_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_nationality();
				}
			});
		},
		rules: {
			nationality:{				
				required:true
			}			
		},
		messages: {
			duties: "Please enter nationality"
		}
	});

	$("#add_chairs_documents").validate({
		
		rules: {
			type:{
				comboboxNotNone: true
			},
			department:{				
				comboboxNotNone: true
			}
		},
		messages: {
			type: "Please enter type",
			department: "Please enter department"
		}
	});

	$("#add_center_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					//$('#myModal').delay(1000).modal('hide');
					//parent.reload_datatable_centers();

					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable_centers();
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
			centreID:{				
				required:true
			},
			name:{				
				required:true
			},
			countryID:{				
				comboboxNotNone: true
			},
			region:{				
				required:true
			},
			typeID:{				
				comboboxNotNone: true
			},
			status:{				
				required:true
			},			
		},
		messages: {
			centreID: "Please enter Centre ID",
			name: "Please enter Center name",
			countryID: "Please select Country",
			region: "Please enter Region",
			typeID: "Please select Type",
			status: "Please select Status",
		}
	});
	
	$("#add_qualification_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_qualification();
				}
			});
		},
		rules: {
			qualification:{				
				required:true
			}			
		},
		messages: {
			duties: "Please enter qualification"
		}
	});
	
	$("#add_department_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_department();
				}
			});
		},
		rules: {
			department_name:{				
				required:true
			}			
		},
		messages: {
			department_name: "Please enter department name"
		}
	});

	$("#add_chair_doc_departments_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			department_name:{				
				required:true
			}			
		},
		messages: {
			department_name: "Please enter department name"
		}
	});

	$("#add_chair_doc_types_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			type_name:{				
				required:true
			}			
		},
		messages: {
			type_name: "Please enter type name"
		}
	});

	$("#add_chair_doc_actions_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			action_name:{				
				required:true
			}			
		},
		messages: {
			action_name: "Please enter action name"
		}
	});
	
	$("#add_job_title_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_job_title();
				}
			});
		},
		rules: {
			job_title:{				
				required:true
			}			
		},
		messages: {
			job_title: "Please enter job title"
		}
	});

	$("#add_complaint_type_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_complaint_type();
				}
			});
		},
		rules: {
			type:{				
				required:true
			}			
		},
		messages: {
			type: "Please enter type"
		}
	});

	$("#add_complaint_assignment_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_complaint_assignment();
				}
			});
		},
		rules: {
			department:{				
				'department[]': {
					required:true,
					minlength: 1
				},
			}			
		},
		messages: {
			department: "Please select department"
		}
	});
	
	$("#add_qualification_type_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_qualification_type();
				}
			});
		},
		rules: {
			type:{				
				required:true
			}			
		},
		messages: {
			type: "Please enter type name"
		}
	});

	$("#add_section_time_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable_section_time();
				}
			});
		},
		rules: {
			section_time:{				
				required:true
			}			
		},
		messages: {
			section_time: "Please enter section time"
		}
	});
	
	$("#add_note_form_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			note_type:{				
				required:true
			},
			department:{				
				comboboxNotNone: true
			},
			detail:{				
				required:true
			}
		},
		messages: {
			note_type: "Please select note type",
			department: "Please select department",
			detail: "Please enter detail"
		}
	});
	$("#add_comment_datatable").validate({
		submitHandler: function(form) {
			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					parent.reload_datatable();
				}
			});
		},
		rules: {
			note_type:{				
				required:true
			},
			department:{				
				comboboxNotNone: true
			},
			detail:{				
				required:true
			}
		},
		messages: {
			note_type: "Please select note type",
			department: "Please select department",
			detail: "Please enter detail"
		}
	});
	$('#add_note_form_datatable select#department_id,#add_comment_datatable select#department').change(function (){
		//alert($(this).val());
		if(parseInt($(this).val()) == '8'){
			$('#add_note_form_datatable #professional_development_cat').show();
			$('#add_comment_datatable #professional_development_cat').show();
			$('#add_note_form_datatable #professional_development_cat select#category').select2('enable');
			$('#add_comment_datatable #professional_development_cat select#category').select2('enable');
		}else {
			$('#add_note_form_datatable #professional_development_cat').hide();
			$('#add_comment_datatable #professional_development_cat').hide();
			$('#add_note_form_datatable #professional_development_cat select#category').select2('disable').select2('val', '');
			$('#add_comment_datatable #professional_development_cat select#category').select2('disable').select2('val', '');
		}
		if(parseInt($(this).val()) == '3'){
			$('#add_note_form_datatable #academic_admin_cat').show();
			$('#add_comment_datatable #academic_admin_cat').show();
			$('#add_note_form_datatable #academic_admin_cat select#category').select2('enable');
			$('#add_comment_datatable #academic_admin_cat select#category').select2('enable');
		}else{
			$('#add_note_form_datatable #academic_admin_cat').hide();	
			$('#add_comment_datatable #academic_admin_cat').hide();	
			$('#add_note_form_datatable #academic_admin_cat select#category').select2('disable').select2('val', '');
			$('#add_comment_datatable #academic_admin_cat select#category').select2('disable').select2('val', '');
		}
		if(parseInt($(this).val()) == '2'){
			$('#add_note_form_datatable #academic_hr_cat').show();
			$('#add_comment_datatable #academic_hr_cat').show();
			$('#add_note_form_datatable #academic_hr_cat select#category').select2('enable');
			$('#add_comment_datatable #academic_hr_cat select#category').select2('enable');
		}else{
			$('#add_note_form_datatable #academic_hr_cat').hide();	
			$('#add_comment_datatable #academic_hr_cat').hide();	
			$('#add_note_form_datatable #academic_hr_cat select#category').select2('disable').select2('val', '');
			$('#add_comment_datatable #academic_hr_cat select#category').select2('disable').select2('val', '');
		}
	});
	$('#add_comment_datatable select#department_id,#add_note_form_datatable select#department_id').change(function (){
		if(parseInt($(this).val()) == '2'){
			$('#add_comment_datatable #cat_div').show();
			$('#add_comment_datatable #cat_div select#category').select2('enable');
			$('#add_note_form_datatable #cat_div').show();
			$('#add_note_form_datatable #cat_div select#category').select2('enable');
		}else{
			$('#add_comment_datatable #cat_div').hide();
			$('#add_comment_datatable #cat_div select#category').select2('disable').select2('val', '');
			$('#add_note_form_datatable #cat_div').hide();
			$('#add_note_form_datatable #cat_div select#category').select2('disable').select2('val', '');
		}
	});

	$('#add_note_form_datatable select#note_type,#add_note_form_datatable select#department_id,#add_note_form_datatable select#category').change(function (){
		var category = parseInt($('#add_note_form_datatable select#category').val());
		var note_type = $('#add_note_form_datatable select#note_type').val();
		var department_id = parseInt($('#add_note_form_datatable select#department_id').val());
		if(note_type == 'Information' && department_id == '2' && category == '10'){
			$('#add_note_form_datatable #cat_daily_absence_lateness_main').show();
			//$('#add_note_form_datatable #cat_daily_absence_lateness_main select#category').select2('enable');
		}else{
			$('#add_note_form_datatable #cat_daily_absence_lateness_main').hide();
			//$('#add_note_form_datatable #cat_daily_absence_lateness_main select#category').select2('disable').select2('val', '');
		}
	});

	// process the form
	$('#save_status').click(function(event) {

		if($('#comment').val() == "")
		{
			$('#iderror').html('<span class="error"><label for="" generated="true" class="error">Please enter comment.</label></span>');
		    return false;
		}
		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'status' 	: $('#status').val(),
			'comment' 	: $('#comment').val(),
			'user_id' 	: $('input[name=ori_user_id]').val(),
			'orig_status' 	: $('input[name=orig_status]').val()
		};

		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: CI.base_url+'list_user/save_user_status', // the url where we want to POST
			data 		: formData, // our data object
			success: function(data) {
				location.reload();
			}
		})
		
		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
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
	
	$("#line_managers_dt_submit").on( "submit", function(e) {
		$(this).find('select#line_manager_attendance').each(function(){
			if($(this).val() == ''){
				alert('Please select all user attendance.');
				e.preventDefault();
				return false;
			}
		});
		
	});

	$("#add_complaint_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						
						if(CI.controller_name == 'complaint'){
							location.reload();
						}else{
							window.location.href = CI.base_url+'complaint';
						}
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
			student_id: {
				required:true
			},
			validity:{
				required:true
			},
			priority:{
				required:true
			},
			comments: {
				required:true
			}
		},
		messages: {
			student_id: "Enter Student ID",
			validity: "Please select validity",
			priority: "Please select priority",
			comments: "Please enter comments"
		}
	});
	
	$('#add_complaint_form_datatable #complaint_type').change(function (){
		if($(this).val() == '1'){
			$('div#attendance').show();
		}else{
			$('div#attendance').hide();
		}
		if($(this).val() == '2' || $(this).val() == '3'){
			$('div#exam_grade').show();
		}else{
			$('div#exam_grade').hide();
		}
		if($(this).val() == '4'){
			$('div#teachers').show();
		}else{
			$('div#teachers').hide();
		}
	});
	
	$(document).ready(function(){	
		if($('#add_complaint_form_datatable #complaint_type'))
		{
			var complaint_type_seleval = $('#add_complaint_form_datatable #complaint_type');
				
			if(complaint_type_seleval.val() != undefined)	
			{
				var grdtypeval = $('#add_complaint_form_datatable #grade_type').val();
				if(grdtypeval != undefined)	
				{	
					getGradetypeComponent(grdtypeval,$('#component').attr('data-val'));
				}
				
				if(complaint_type_seleval.val() == '1'){
					$('div#attendance').show();
				}else{
					$('div#attendance').hide();
				}
				if(complaint_type_seleval.val() == '2' || complaint_type_seleval.val() == '3'){
					$('div#exam_grade').show();
				}else{
					$('div#exam_grade').hide();
				}
				if(complaint_type_seleval.val() == '4'){
					$('div#teachers').show();
				}else{
					$('div#teachers').hide();
				}
			}		
		}	
	});
	
	$("#add_section_time_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			section_time:{				
				required:true
			}			
		},
		messages: {
			section_time: "Please enter section time."
		}
	});

	$("#add_pma_scores_form_datatable").validate({
		submitHandler: function(form) {
			//form.submit();
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
				
		},
		messages: {
			
		}
	});

	$("#add_my_attandance_comment").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					$('#myModal').delay(1000).modal('hide');
					location.reload();
				}
			});
		},
		rules: {
			comment:{				
				required:true
			}			
		},
		messages: {
			comment: "Please enter comment."
		}
	});

	$("#attendance_time_settings_form").validate({
		submitHandler: function(form) {
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
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
				
		},
		messages: {
			
		}
	});

	$("#add_academic_periods_form_datatable").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable_academic_periods();
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
			school_id: {
				comboboxNotNone: true
			},
			school_year:{
				digits: true,
				required:true,
				minlength: 4,
				maxlength: 4
			},
			school_week:{
				lessthan: true,
				digits: true,
				required:true
			},
			school_year_title:{
				required:true
			}
		},
		messages: {
			school_id: "Please enter your school name",
			school_year_title: "Please enter school year title"
		}
	});

	$("#add_campus_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable_school_campus();
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
			campus_name: {
				required: true
			},
			campus_location: {
				required: true
			}
		},
		messages: {
			campus_name: "Please enter campus name",
			campus_location: "Please enter campus location"
		}
	});

	$("#add_role_form").validate({
		submitHandler: function(form) {
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						parent.reload_datatable_role();
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
		}
	});

	$("#add_appointment_form_datatable").validate({
		submitHandler: function(form) {			
			//form.submit();
			jQuery(form).ajaxSubmit({
				success: function(data){
					if(data == ''){
						$('#myModal').delay(1000).modal('hide');
						location.reload();
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
			date:{				
				required:true
			},
			time:{				
				required:true
			}
		},
		messages: {
			date: "Please select date",
			time: "Please select time",
		}
	});
	
	$('#add_complaint_form_datatable #student_id').blur(function(event) {
		$.ajax({
			type:'post',
			url: CI.base_url+'complaint/get_StudentTeacher/'+$(this).val(),
			data: [],
				success: function(data) {
					$('#add_complaint_form_datatable #teacher_id').html(data);
					$('#add_complaint_form_datatable #teacher_id').select2();	
				}
		});
	});
	
	$('#add_note_form_datatable #category').change(function(event) {
		$.ajax({
			type:'post',
			url: CI.base_url+'list_active_staff/get_category_comment_count/'+$(this).val()+'/'+$('#add_note_form_datatable #user_id').val(),
			data: [],
				success: function(data) {
					$('#add_note_form_datatable #cat_comment_count').html(data);
					$('#add_note_form_datatable #cat_comment_count_main').show();
				}
		});
	});
});	
if(CI.controller_name == 'schedule')
{
	$('#close_view_model').click(function(event) {
		var _href = $(this).attr('href');
		var id = _href.replace(/\D+/g, '');
		$('#myModal').modal('hide');
		$('#myModal2').modal({
		  remote: CI.base_url+'schedule/add_appointment/'+id
		});
		//return false;
	});
}
function check_edit_school_form(id){
	// validate add school year form on keyup and submit
	
	return false;
}

function getCenterData(center_number){
	if(center_number == "") return;
	$.ajax({
		type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url 		: CI.base_url+'list_user/get_center_data/'+center_number, // the url where we want to POST
		success: function(data) {
			var objData = $.parseJSON(data);
			$('#center_found_msg').html('');
			$('#centernumber_message').html('');
			if(objData.typeID > 0)
			{
				$('#center_found_msg').html('<p style="color:blue">'+objData.name+', '+objData.country+', '+objData.type+'</p>');
				
				if(objData.typeID == 3){
					$('#centernumber_message').html('<p style="color:red">WARNING!<br> This center offers both Online and In class certification, please check or uncheck the correct value for "In class" below.</p>');
				}				
			}
			else
			{	
				$('#center_found_msg').html('<p style="color:red">WARNING!<br> No data available.Please check the center number is correct or add a new center to the list of centers.</p>');
			}
		}
	});
}

var iscenternumber = 0;
function check_qualification(qualifications_id){
	$.ajax({
		type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
		url 		: CI.base_url+'list_user/check_qualificatrion/'+qualifications_id, // the url where we want to POST
		success: function(data) {
		
			if (data == '1') {
				iscenternumber = 1;
				$('#center_mesg_div').show();
				$('#center_number_div').html('<label for="center_number">Center Number</label>');
				$('#institute').addClass('center_number');
				getCenterData($("#institute").val());
			}
			else
			{
				iscenternumber = 0;
				$('#center_found_msg').html('');
				$('#centernumber_message').html('');
				$('#center_mesg_div').hide();
				$('#center_number_div').html('<label for="institute">Institute</label>');
				$('#institute').removeClass('center_number');
			}
		}
	});
}

$("#certificate_id").change(function () {
    check_qualification($(this).val());
});
$("#qualification_id").change(function () {
    check_qualification($(this).val());
});

$("#institute").change(function() {
	if(iscenternumber == 1)
	{
		getCenterData($("#institute").val());
	}	
});

$('.btn-delet').on('click', function () {
	return confirm('Are you sure want to delete?');
});
function getSubmitExamType(valexamtype,submitexammarktype){
	$("#submitexamtype").val(valexamtype);
	$("#submitexammarktype").val(submitexammarktype);
}