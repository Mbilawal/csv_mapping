"use strict";



// Class definition

var KTWizard1 = function () {

	// Base elements

	var wizardEl;

	var formEl;

	var validator;

	var wizard;



	// Private functions

	var initWizard = function () {

		// Initialize form wizard

		wizard = new KTWizard('kt_wizard_v1', {

			startStep: 1

		});



		// Validation before going to next page

		wizard.on('beforeNext', function (wizardObj) {

			if (validator.form() !== true) {

				wizardObj.stop();  // don't go to the next step

			}

		})



		// Change event

		wizard.on('change', function (wizard) {

			setTimeout(function () {

				KTUtil.scrollTop();

			}, 500);

		});

	}



	var initValidation = function () {

		validator = formEl.validate({

			// Validate only visible fields

			ignore: ":hidden",



			// Validation rules

			rules: {

				//= Step 1

				role_name: {

					required: true

				},

				role_description: {

					required: true

				},



				//= Step 2

				permissions: {

					required: true

				},

			},



			// Display error  

			invalidHandler: function (event, validator) {

				KTUtil.scrollTop();



				swal.fire({

					"title": "",

					"text": "There are some errors in your submission. Please correct them.",

					"type": "error",

					"confirmButtonClass": "btn btn-secondary"

				});

			},



			// Submit valid form

			submitHandler: function (form) {



			}

		});

	}



	var initSubmit = function () {

		var btn = formEl.find('[data-ktwizard-type="action-submit"]');


		btn.on('click', function (e) {
			var permissions = [];
			$('input[type=checkbox]').each(function () {
				if ($(this).is(":checked")) {
					permissions.push($(this).val());
				}
			});
			var role_description = $('.role_description').val();
			var role_name = $('.role_name').val();
			var status = $('.status').val();
			var roleId = $('.pre_role_id').val();

			e.preventDefault();

			if (validator.form()) {

				// See: src\js\framework\base\app.js
				KTApp.progress(btn);
				//KTApp.block(formEl);
				// See: https://malsup.com/jquery/form/#ajaxSubmit
				if (parseFloat(roleId) > 0) {
					formEl.ajaxSubmit({
						url : site_url + 'setting/update-role-process/',
						data: { role_name: role_name, role_description: role_description, permissions: permissions, status: status, roleId: roleId },
						type: 'post',
						success: function (output) {
							var obj = $.parseJSON(output);
							KTApp.unprogress(btn);
							if (obj.success == 'true') {
								swal.fire({
									"title": "",
									"text": "The Role has been updated successfully!",
									"type": "success",
									"confirmButtonClass": "btn btn-secondary"
								});
								window.location.replace(site_url + "setting/manage-roles/");
							} else {
								swal.fire({
									"title": "",
									"text": "Some thing went wrong, try again later!",
									"type": "warning",
									"confirmButtonClass": "btn btn-secondary"
								});
							}

						}

					});
				} else {
					formEl.ajaxSubmit({
						url: site_url + 'setting/add-new-role-process/',
						data: { role_name: role_name, role_description: role_description, permissions: permissions, status: status },
						type: 'post',
						success: function (output) {
							var obj = $.parseJSON(output);
							KTApp.unprogress(btn);
							if (obj.success == 'true') {
								swal.fire({
									"title": "",
									"text": "The Role has been added successfully!",
									"type": "success",
									"confirmButtonClass": "btn btn-secondary"
								});
								window.location.replace(site_url + "setting/manage-roles/");
							} else {
								swal.fire({
									"title": "",
									"text": "Some thing went wrong, try again later!",
									"type": "warning",
									"confirmButtonClass": "btn btn-secondary"
								});
							}

						}

					});
				}

			}

		});

	}



	return {

		// public functions

		init: function () {

			wizardEl = KTUtil.get('kt_wizard_v1');

			formEl = $('#kt_form');



			initWizard();

			initValidation();

			initSubmit();

		}

	};

}();



jQuery(document).ready(function () {

	KTWizard1.init();

});
