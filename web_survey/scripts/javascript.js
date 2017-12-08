/*
 * 	form validation functions
 */
function is_empty(textbox, alertbox) {
	with(textbox) {
		if (value==null || value=="") {
			if (alertbox!="") {
				alert(alertbox);
			}
			return true;
		} else {
			return false;
		}
	}
}

function login_validation(form) {
	if (is_empty(form.user_name, "'UserID' cannot be empty!")) {
		form.user_name.focus();
		return false;
	};
	if (is_empty(form.user_pass, "'Password' cannot be empty!")) {
		form.user_pass.focus();
		return false;
	};
}

function bad_email(textbox) {
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(textbox.value)) {
		alert('Please provide a valid email address.');
		return true;
	};
}
	    
function send_email_validation(form) {
	if (is_empty(form.recipient, "'Contact Name' cannot be empty!")) {
		form.recipient.focus();
		return false;
	};
	if (is_empty(form.email_address, "'Email Address' cannot be empty!") || bad_email(form.email_address)) {
		form.email_address.focus();
		return false;
	};
	if (is_empty(form.email_subject, "'Subject' cannot be empty!")) {
		form.email_subject.focus();
		return false;
	};
	if (is_empty(form.email_body, "'Text Body' cannot be empty!")) {
		form.email_body.focus();
		return false;
	};
}

function change_password_validation(form) {
	if (is_empty(form.user_name, "'Enter UserID' cannot be empty!")) {
		form.user_name.focus();
		return false;
	};
	if (is_empty(form.user_pass, "'Current Password' cannot be empty!")) {
		form.user_pass.focus();
		return false;
	};
	if (is_empty(form.password1, "'New Password' cannot be empty!")) {
		form.password1.focus();
		return false;
	};
	if (is_empty(form.password2, "'Verify Password' cannot be empty!")) {
		form.password2.focus();
		return false;
	};
	if (form.password1.value != form.password2.value) {
		alert("Passwords do not match!");
		form.password1.value="";
		form.password2.value="";
		form.password1.focus();
		return false;
	};
}

function create_account_validation(form) {
	if (is_empty(form.contact_name, "'Contact Name' cannot be empty!")) {
		form.contact_name.focus();
		return false;
	};
	if (is_empty(form.contact_email, "'User Email' cannot be empty!") || bad_email(form.contact_email)) {
		form.contact_email.value="";
		form.contact_email.focus();
		return false;
	};
	if (is_empty(form.user_name, "'LogonID' cannot be empty!")) {
		form.user_name.focus();
		return false;
	};
	if (is_empty(form.password1, "'Password' cannot be empty!")) {
		form.password1.focus();
		return false;
	};
	if (is_empty(form.password2, "'Verify Password' cannot be empty!")) {
		form.password2.focus();
		return false;
	};
	if (form.password1.value != form.password2.value) {
		alert("Passwords do not match!");
		form.password1.value="";
		form.password2.value="";
		form.password1.focus();
		return false;
	};
}

function reset_password_validation(form) {
	if (is_empty(form.user_name, "'UserID' cannot be empty!")) {
		form.user_name.focus();
		return false;
	};
	if (is_empty(form.contact_email, "'Email Address' cannot be empty!")) {
		form.user_email.focus();
		return false;
	};
}

function form_validation(thisform) {
	if (thisform.name == "form_login") {
		return login_validation(thisform);
	};
	if (thisform.name == "form_send_email") {
		return send_email_validation(thisform);
	};
	if (thisform.name == "form_reset_password") {
		return reset_password_validation(thisform);
	};
	if (thisform.name == "form_create_account") {
		return create_account_validation(thisform);
	};
	if (thisform.name == "form_change_password") {
		return change_password_validation(thisform);
	};
	return false;
}
