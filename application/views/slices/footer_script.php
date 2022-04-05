<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#716aca",
				"light": "#ffffff",
				"dark": "#282a3c",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
	var site_url = '<?php echo SURL; ?>';
</script>
<!-- end::Global Config -->
<!--begin::Global Theme Bundle(used by all pages) -->
<!--begin:: Vendor Plugins -->
<script src="<?php echo ASSETS; ?>plugins/general/jquery/dist/jquery.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/popper.js/dist/umd/popper.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/js-cookie/src/js.cookie.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/perfect-scrollbar/dist/perfect-scrollbar.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/wnumb/wNumb.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>plugins/general/block-ui/jquery.blockUI.js" type="text/javascript"></script>
<?php
if ($LOGIN_PAGE !== 'true') { ?>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/bootstrap-datepicker.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/bootstrap-timepicker.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-maxlength/src/bootstrap-maxlength.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-select/dist/js/bootstrap-select.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-switch/dist/js/bootstrap-switch.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/bootstrap-switch.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/select2/dist/js/select2.full.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/ion-rangeslider/js/ion.rangeSlider.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/typeahead.js/dist/typeahead.bundle.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/handlebars/dist/handlebars.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/inputmask/dist/jquery.inputmask.bundle.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/inputmask/dist/inputmask/inputmask.date.extensions.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/nouislider/distribute/nouislider.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/owl.carousel/dist/owl.carousel.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/autosize/dist/autosize.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/dropzone/dist/dropzone.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/dropzone.init.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/quill/dist/quill.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/@yaireo/tagify/dist/tagify.polyfills.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/@yaireo/tagify/dist/tagify.min.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/summernote/dist/summernote.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/markdown/lib/markdown.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/bootstrap-markdown.init.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/bootstrap-notify.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/jquery-validation/dist/additional-methods.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/jquery-validation.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/toastr/build/toastr.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/dual-listbox/dist/dual-listbox.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/raphael/raphael.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/morris.js/morris.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/plugins/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/waypoints/lib/jquery.waypoints.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/counterup/jquery.counterup.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/general/sweetalert2/dist/sweetalert2.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/js/global/integration/plugins/sweetalert2.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/jquery.repeater/src/lib.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/jquery.repeater/src/jquery.input.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/general/jquery.repeater/src/repeater.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/general/dompurify/dist/purify.js" type="text/javascript"></script> -->
	<!--end:: Vendor Plugins -->
	<script src="<?php echo ASSETS; ?>js/scripts.bundle.js" type="text/javascript"></script>
	<!--begin:: Vendor Plugins for custom pages -->
	<script src="<?php echo ASSETS; ?>plugins/custom/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/core/main.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/daygrid/main.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/google-calendar/main.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/interaction/main.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/list/main.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/@fullcalendar/timegrid/main.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/flot/dist/es5/jquery.flot.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.categories.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.pie.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.stack.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.crosshair.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/flot/source/jquery.flot.axislabels.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/js/global/integration/plugins/datatables.init.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-autofill/js/dataTables.autoFill.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jszip/dist/jszip.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/pdfmake/build/pdfmake.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/pdfmake/build/vfs_fonts.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons/js/buttons.colVis.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons/js/buttons.flash.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-buttons/js/buttons.print.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-colreorder/js/dataTables.colReorder.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-rowgroup/js/dataTables.rowGroup.min.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-rowreorder/js/dataTables.rowReorder.min.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript"></script>
	<script src="<?php echo ASSETS; ?>plugins/custom/datatables.net-select/js/dataTables.select.min.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jstree/dist/jstree.js" type="text/javascript"></script> -->
	<script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/jquery.vmap.js" type="text/javascript"></script>
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/maps/jquery.vmap.world.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/maps/jquery.vmap.russia.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/maps/jquery.vmap.usa.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/maps/jquery.vmap.germany.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/jqvmap/dist/maps/jquery.vmap.europe.js" type="text/javascript"></script> -->
	<!-- <script src="<?php echo ASSETS; ?>plugins/custom/uppy/dist/uppy.min.js" type="text/javascript"></script> -->
	<!--end:: Vendor Plugins for custom pages -->
	<!--end::Global Theme Bundle -->
	<!--begin::Page Vendors(used by this page) -->
	<!--end::Page Vendors -->
	<!--begin::Page Scripts(used by this page) -->
	<script src="<?php echo ASSETS; ?>js/pages/dashboard.js" type="text/javascript"></script>
	<!--end::Page Scripts -->
	<script src="<?php echo ASSETS; ?>highcharts/highcharts.js"></script>
	<script src="<?php echo ASSETS; ?>highcharts/exporting.js"></script>
<?php
}
?>


<!-- Image Uploader -->
<script src="<?php echo ASSETS; ?>image_uploader_lib/fileinput.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>image_uploader_lib/sortable.js" type="text/javascript"></script>
<script src="<?php echo ASSETS; ?>image_uploader_lib/theme.js" type="text/javascript"></script>

<!-- <script src="<?php echo ASSETS; ?>js/pages/custom/login/login-general.js" type="text/javascript"></script> -->
<script src="<?php echo ASSETS; ?>js/pages/custom/wizard/wizard-1.js" type="text/javascript"></script>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip({
			html: true
		})
	})
</script>

<!--begin::Page Scripts(used by this page) -->
<!-- <script src="<?php echo SURL; ?>assets/js/pages/custom/user/add-user.js" type="text/javascript"></script> -->
<!--end::Page Scripts -->
<script type="text/javascript">
	// Login Script... 
	$(document).ready(function() {
		/* ************************************** */
		/*              LOGIN SECTION             */
		/* ************************************** */
		// On click Subimt Login button... 

		$('body').on('click', '#login_btn_process', function() {
			$('#login_err').hide();
			var username = $('#login_username').val();
			var password = $('#login_password').val();
			if (username == '') {
				$('#login_username').css('border-bottom-color', 'red');
				return false;
			} else {
				$('#login_username').css('border-bottom-color', 'lightgreen');
			}
			if (password == '') {
				$('#login_password').css('border-bottom-color', 'red');
				return false;
			} else {
				$('#login_password').css('border-bottom-color', 'lightgreen');
			}
			$.ajax({
				url: '<?php echo SURL; ?>login/login-process/',
				type: 'POST',
				data: {
					username: username,
					password: password
				},
				success: function(response) {
					var obj = $.parseJSON(response);
					if (obj.success == 'true') {
						window.location.replace(obj.url);
					} else {
						$('#login_err').text(obj.message);
						$('#login_err').show();
					}
				}
			})

		});
		// END on Click Submit Login Button...
		/* ************************************** */
		/*            END LOGIN SECTION           */
		/* ************************************** */
		
		$('#kt_slider_3').ionRangeSlider({
			type: "double",
			grid: true,
			min: 0,
			max: 10000,
			from: 0,
			to: 0,
			prefix: "$"
		});


		$('#summernote').summernote({
			height: 150,   //set editable area's height
		  	// airMode: true,
			codemirror: { // codemirror options
			    theme: 'monokai'
			}
		});

		dashboard_picker();

		setTimeout(function() {
			$('.select2').selectpicker('refresh');
		}, 3000);

	});

	function dashboard_picker() {
        if ($('#kt_dashboard_daterangepicker').length == 0) {
            return;
        }

        var picker = $('#kt_dashboard_daterangepicker');
        var start = moment();
        var end = moment();

        function cb(start, end, label) {
            var title = '';
            var range = '';

            if ((end - start) < 100 || label == 'Today') {
                title = 'Today:';
                range = start.format('MMM D');
            } else if (label == 'Yesterday') {
                title = 'Yesterday:';
                range = start.format('MMM D');
            } else {
                range = start.format('MMM D') + ' - ' + end.format('MMM D');
            }

            $('#kt_dashboard_daterangepicker_date').html(range);
            $('#kt_dashboard_daterangepicker_title').html(title);
        }

        picker.daterangepicker({
            direction: KTUtil.isRTL(),
            startDate: start,
            endDate: end,
            opens: 'left',
            ranges: {
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end, '');
    }

	// delete_newsletter...
	$('body').on('click', '.delete_newsletter', function() {
		
		var email = $(this).attr('data_id');

		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>newsletter/delete_newsletter',
			method  : 'POST',
			data    : {
						email : email
					},
			async   : false,
			success : function(response) {
				var obj = $.parseJSON(response);
				if (obj.success == true) {
					var user_list_row_id = $('#'+email);
					user_list_row_id.remove();
				} else {
					swal.fire("Error!", "Something Went Wrong", "error");
				}
			}
		});
		// END Ajax Call...
	});
	// END delete_newsletter...


	// update_order...
	$('body').on('click', '#upd_order_status_detail', function() {
		
		var id = $('#order_id').val();
		var status = $('#order_status_val').val();

		swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Update Status",
			cancelButtonText: "Cancel",
			reverseButtons: true
		}).then(function(result){
			if (result.value) {
				
				// Ajax Call...
				$.ajax({
					url     : '<?php echo SURL; ?>order/update_order_status/',
					method  : 'POST',
					data    : {
								id:id,status:status
							},
					async   : false,
					success : function(response) {
						if (response == 1) {
							swal.fire("Success!", "Order Updated", "success");
							$('#update_order_modal').modal('hide');
							// setTimeout(function() {
							// 	window.location.href = "<?php echo SURL?>order/index/";
							// }, 2000);
						
						} else {
							swal.fire("Error!", "Something Went Wrong", "error");
						}
					}
				});
				// END Ajax Call...

			} else if (result.dismiss == "cancel") {
				swal.fire({
					"title": "", 
					"text": "Cancel this!", 
					"type": "warning",
					"confirmButtonClass": "btn btn-secondary"
				});
			}
		});

	});
	// END update_order...

	
	// update_order...
	$('body').on('change', '#main_cate_select', function() {
		
		var value = $('#main_cate_select').val();

		if(value!=""){

			// Ajax Call...
			$.ajax({
				url     : '<?php echo SURL; ?>product/get_primary_category_select/',
				method  : 'POST',
				data    : {value:value},
				async   : false,
				success : function(response) {
					setTimeout(function() {
						$('.pri_cate_selections_row').show();
						$('.pri_cate_selections').html(response);
						$('.select2').selectpicker('refresh');
					}, 1000);
				}
			});
			// END Ajax Call...
		}else{
			$('.pri_cate_selections_row').hide();
		}
	});
	// END update_order...

	// Add New Template...
	$('body').on('click', '#add_new_template', function() {
		var title    	= $('.title').val();
		var subject 	= $('.subject').val();
		var body 		= $('#summernote').summernote('code');
		
		// Checks goes here...
		// End Checks...
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>email_templates/add_email_template_process/',
			method  : 'POST',
			data    : {
						title:title,
						subject:subject,
						body:body,
						status:status
					},
			async   : false,
			success : function(response) {

				if (response == 1) {
					swal.fire("Success!", "Template Added", "success");
					
					setTimeout(function() {
						window.location.href = "<?php echo SURL?>email_templates/index/";
					}, 2000);
				
				} else {
					swal.fire("Error!", "Something Went Wrong", "error");
				}
			}
		});
		// END Ajax Call...
	});
	// END Add New Template...
	
	// Add New Template...
	$('body').on('click', '.send_email_campaign', function() {
		
		var template_id = $(this).attr('data_id');

		// Checks goes here...
		// End Checks...
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>email_templates/send_email_process/',
			method  : 'POST',
			data    : {
						template_id:template_id
					},
			async   : false,
			success : function(response) {

				if (response == 1) {
					swal.fire("Success!", "Email Send to All Subscriber", "success");
				
				} else {
					swal.fire("Error!", "Something Went Wrong", "error");
				}
			}
		});
		// END Ajax Call...
	});
	// END Add New Template...
	
	// upd_new_template...
	$('body').on('click', '#upd_new_template', function() {
		
		var title    	= $('.upd_title').val();
		var subject 	= $('.upd_subject').val();
		var body 		= $('#summernote').summernote('code');
		var id 			= $('.upd_id').val();

		alert(body);
		die;
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>email_templates/edit_email_template_process/',
			method  : 'POST',
			data    : {
						id:id,status:status,title:title,subject:subject,body:body
					},
			async   : false,
			success : function(response) {
				if (response == 1) {
					swal.fire("Success!", "Template Updated", "success");
					
					setTimeout(function() {
						window.location.href = "<?php echo SURL?>email_templates/index/";
					}, 2000);
				
				} else {
					swal.fire("Error!", "Something Went Wrong", "error");
				}
			}
		});
		// END Ajax Call...
	});
	// END upd_new_template...

	// Edit New Order...
	$('body').on('click', '#edit_new_order', function() {
		
		var order_id = $('#order_id').val();

		var postData = $('#edit_new_order_form').serializeArray();
		// Checks goes here...
		// End Checks...
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>order/edit_new_order_process/',
			method  : 'POST',
			data    : postData,
			async   : false,
			success : function(response) {
				if (response == 1) {
					swal.fire("Success!", "Order Edit", "success");
					
					setTimeout(function() {
						window.location.href = "<?php echo SURL?>order/view_order/"+order_id;
					}, 2000);
				
				} else {
					swal.fire("Error!", "Something Went Wrong", "error");
				}
			}
		});
		// END Ajax Call...
	});
	// END Edit New product...
	
	// Edit New Order...
	$('body').on('click', '.daterangepicker', function() {
		
		var date_range = $('#kt_dashboard_daterangepicker_date').text();

		// Highchart Container orders Analysis...
        $.ajax({ 
            url : "<?php echo SURL?>dashboard/get_order_graphs/",
            type: "POST",
            data : {date_range:date_range},
            success:function(response) 
            { 
               
                var res = response.split('||');
                var datas = res[0];
                var datax = res[1];

                Highcharts.chart('order_analysis_graph', {
                    title: {
                        text: 'Order Response Statistics'
                    },
                    subtitle: {
                        text: ''
                    },
                    yAxis: {
                        title: {
                            text: 'Numbers'
                        }
                    },
                    xAxis: {
                        categories: JSON.parse(datax)
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    plotOptions: {
                        series: {
                            label: {
                                connectorAllowed: false
                            },
                        }
                    },
                    series: JSON.parse(datas),
                    responsive: {
                        rules: [{
                            condition: {
                                
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }
                });

                
            }
        });


        // Highchart Container orders Analysis...
        $.ajax({ 
            url : "<?php echo SURL?>dashboard/get_analytics_report/",
            type: "POST",
            data : {date_range:date_range},
            success:function(response){ 
               
                var res = response.split('||');
                var data2 = res[0];
                var data3 = res[1];
                var data4 = res[2];
                var data5 = res[3];

                $('#total_gapi_user').html(data2);
                $('#total_gapi_session').html(data3);
                $('#total_gapi_bounce').html(data4);
                $('#total_gapi_page').html(data5);
                
            }
        });

        $.ajax({ 
            url : "<?php echo SURL?>dashboard/get_product_graphs/",
            type: "POST",
            data : {date_range:date_range},
            success:function(response) 
            { 
               
                var res = response.split('||');
                var datas = res[0];
                var datax = res[1];

                Highcharts.chart('product_analysis_graph', {
                    chart: {
					    type: 'column'
					},
					title: {
					    text: 'SMS Campaign Statistics'
					},
					xAxis: {
					    categories: JSON.parse(datax)
					},
					yAxis: {
					    min: 0,
					    title: {
					      text: 'Total consumption'
					    }
					},
					tooltip: {
					    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
					    shared: true
					},
					plotOptions: {
					    column: {
					      stacking: 'percent'
					    }
					},
					series: JSON.parse(datas),
					responsive: {
                        rules: [{
                            condition: {
                                
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }
                });

                
            }
        });
	    // Highchart Container orders Analysis...

	});
	// END Edit New product... 


	// update_order...
	$('body').on('change', '.brand_type', function() {
		
		var value = $(this).val();

		if(value == "manual"){
			$('#add_brand_modal').modal('show');
			$('.brand_type_system').hide();
		}else{
			$('.brand_type_system').show();
		}
	});
	// END update_order...


	// update_order...
	$('body').on('click', '.upd_order_status', function() {
		
		$('#update_order_modal').modal('show');
		$('.select2').selectpicker('refresh');
		
	});
	// END update_order...


	// update_order...
	$('body').on('change', '.color_type', function() {
		
		var value = $(this).val();

		if(value == "manual"){
			$('#add_color_modal').modal('show');
			$('.color_system').hide();
		}else{
			$('.color_system').show();
		}
	});
	// END update_order...
	
	$('body').on('click', '#add_new_brand_m', function() {
		var name    	= $('#name_m').val();
		var shop_id  	= $('#shop_name_m').val();
		var gender  	= $('#gender_m').val();
		var shop_name  	= $("#shop_name_m option:selected").text();
		if (name == '') {
			$('#name').css('border-color', 'red');
			return false;
		} else {
			$('#name').css('border-color', 'lightgreen');
		}
		if (shop_name == '') {
			$('#shop_name').css('border-color', 'red');
			return false;
		} else {
			$('#shop_name').css('border-color', 'lightgreen');
		}

		// Checks goes here...
		// End Checks...
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>brand/add_new_brand_process/',
			method  : 'POST',
			data    : {
						brand:name,
						shop_name:shop_name,
						shop_id:shop_id,
						gender:gender
					},
			async   : false,
			success : function(response) {
				$('#add_brand_modal').modal('hide');

				// Ajax Call...
				$.ajax({
					url     : '<?php echo SURL; ?>product/get_brand_process/',
					method  : 'POST',
					data    : "",
					async   : false,
					success : function(res) {
						$('.upd_brand_respone').html(res);
						$('.select2').selectpicker('refresh');
					}
				});
				// END Ajax Call...

			}
		});
		// END Ajax Call...
	});


	$('body').on('click', '#add_new_color', function() {
		var name    	= $('#color').val();
		if (name == '') {
			$('#color').css('border-color', 'red');
			return false;
		} else {
			$('#color').css('border-color', 'lightgreen');
		}

		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>product/add_new_color_process/',
			method  : 'POST',
			data    : {
						name:name,
					},
			async   : false,
			success : function(response) {
				$('#add_color_modal').modal('hide');
				$('.color_type_system').html(response);
				$('.select2').selectpicker('refresh');
			}
		});
		// END Ajax Call...
	});


	$("body").on("click",".custom_check",function(){

		var check = $(this).val();
		if(check == 'manual'){
			$('.manual_image_link').show();
			$('.auto_image_link').hide();
		}else{
			$('.manual_image_link').hide();
			$('.auto_image_link').show();
		}	

	});	

	$("body").on("click",".is_feature_code",function(){

		var category_id 	= $(this).attr("data_id");

		if($('.is_feature'+category_id).is(':checked')){
			var feature = 1;
		}else{
            var feature = 0;
		}

		$.ajax({
			url     : '<?php echo SURL; ?>coupons_code/update_feature_category/',
			method  : 'POST',
			data    : {
						category_id:category_id,feature:feature
					},
			async   : false,
			success : function(response) {
			}
		});
		
	});


	$('#login_password').keypress(function (e) {
	 	var key = e.which;
	 	if(key == 13)  // the enter key code
	  	{
	    	$('#login_btn_process').click();
	    	return false;  
	  	}
	});   
	

	$("body").on("click","#client_csv_upload_btn",function(e){
	
		$('#myModal_csv').modal('show');
		
	});
</script>