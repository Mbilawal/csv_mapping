<!-- ******************************** -->
<!--          Global Modals           -->
<!-- ******************************** -->
<!-- Report Reference Modal -->
<!-- ******************************** -->
<!--           END Global Modals      -->
<!-- ******************************** -->
<script type="text/javascript"> // ON Page LOAD..
	var HOST_URL = '<?=SURL?>';
    $(document).ready(function() {
    	$('.form-control').addClass('form-control-sm');
    	$('.form-control').attr('style','border-radius:5px !important;width:100% !important;');
    	// DataTables Declaration.
        $('.dataTable_call').dataTable();
        $('.dataTable_call_no_search_length').dataTable({
        	"bFilter" : false,               
			"bLengthChange": false,
			"paging":false,
			"info":false
        });
        $('.dataTable_call, .dataTable_call_no_search_length').parent('div').addClass('table-responsive');
        // END DataTables Declaration...
        // Parent Menu Activation...
        $('.kt-menu__item--active').parent('ul').parent('div').parent('li').addClass('kt-menu__item--active kt-menu__item--open');
        // END Parent Menu Activation...
        // Select2 Declaration...
        $('.select2').select2();
        // END Select2 Declaration...
        // Datepicker Declaration...
 		$('.datepicker').datepicker({ 
 			todayHighlight: true,
            autoclose: true,
            orientation: 'bottom left',
            todayBtn: true,
            format: 'yyyy-mm-dd'
 		});       
        // END Datepicker Declaration...
        // Datepicker Declaration...
 		$('.datetimepicker').datetimepicker({
 			todayHighlight: true,
            autoclose: true,
            orientation: 'bottom left',
            todayBtn: true,
            format: 'yyyy-mm-dd hh:ii:ss'
 		});       
        // END Datepicker Declaration... 
        // Month Picker Declaration...
        $('.monthpicker').datepicker({
            autoclose: true,
            format: 'M-yyyy',
            minViewMode: 'months',
            orientation: 'bottom left'
 		});       
        // END Month Picker Declaration...
		// Year Picker Declaration...
		$('.yearpicker').datepicker({
            autoclose: true,
            format: 'yyyy',
            minViewMode: 'years',
            orientation: 'bottom left'
 		});       
        // END Month Picker Declaration...
		//Call Summernote rich text editing
	    var $summernote = $('.summernote').summernote({
	        height: 250,
	        //Call image upload
	        callbacks: {
	            onImageUpload: function (files) {
	                sendFile($summernote, files[0]);
	            }
	        }
	    });

	    //ajax upload pictures
	    function sendFile($summernote, file) {
	        var formData = new FormData();
	        formData.append("file", file);
	        $.ajax({
	            url: "<?= SURL ?>product/upload_img",//The path is the method of uploading pictures in your controller, I will write in the controller below
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            type: 'POST',
	            success: function (data) {
	                $summernote.summernote('insertImage', data, function ($image) {
	                    $image.attr('src', data);
	                });
	            }
	        });
	    }
    }); 
 

    // Required Function for select2...
	function formatRepo(repo) {
        if (repo.loading) return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'><b>" + repo.full_name + "</b></div>";
        if (repo.description) {
            markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
        }
        markup += "</div></div>";
        return markup;
    }
    function formatRepoSelection(repo) {
        return repo.full_name || repo.text;
    }
	// END required functions for select2..
	function encodeImageFileAsURL(inputId, renderId, assignId) {
		var filesSelected = document.getElementById(inputId).files;
		if (filesSelected.length > 0) {
			var fileToLoad = filesSelected[0];
			var fileReader = new FileReader();
			fileReader.onload = function(fileLoadedEvent) {
				var srcData = fileLoadedEvent.target.result; // <--- data: base64
				$('#'+renderId).attr('src', srcData);
				$('#'+assignId).val(srcData);
			}
			fileReader.readAsDataURL(fileToLoad);
		}
  	}
</script>
<?php
if(in_array('SYSTEM_SETTING', $PAGES_ALLOWED)) { ?>
<script type="text/javascript">

	// Add New Offer...
	$('body').on('click', '.add_system_setting', function() {
		$('#add_system_setting_modal').modal('show');
		$('.select2').selectpicker('refresh');
	});
	// END Add New system_setting...

	// Add New system_setting Process...
	$('body').on('click', '#add_system_setting_manual', function() {

		var field_name   = $('#field_name').val();
		var field_value  = $('#field_value').val();
		
		var formdata = new FormData();

		formdata.append('field_value',field_value);
		formdata.append('field_name',field_name);


		if (field_value == '') {
			$('#field_value').css('border-color', 'red');
			return false;
		} else {
			$('#field_value').css('border-color', 'lightgreen');
		}
		if (field_name == '') {
			$('#field_name').css('border-color', 'red');
			return false;
		} else {
			$('#field_name').css('border-color', 'lightgreen');
		}

		// Checks goes here...
		// End Checks...
		// Ajax Call...
		$.ajax({
				url : "<?php echo SURL?>setting/add_new_system_setting",
				type: "POST",
				data : formdata,
				cache: false,
				contentType: false,
				processData: false,
				success:function(response) 
				{	
					swal.fire("Success!", "system_setting Added Successfully", "success");
					window.location.href = "<?php echo SURL?>setting/system_setting";

				}
			});
		// END Ajax Call...
	});
	// END Add New system_setting...

	// Edit system_setting...
	$('body').on('click', '.edit_system_setting', function() {
		var system_setting_id = $(this).attr('data_id');
		// Ajax Call...
		$.ajax({
			url     : '<?php echo SURL; ?>setting/get_system_setting/',
			method  : 'POST',
			data    : {
						system_setting_id:system_setting_id
					},
			async   : false,
			success : function(response) {
				$('#system_setting_id_upd').val(system_setting_id);
				$('#upd_system_setting_body').html(response);
				$('#edit_system_setting_modal').modal('show');
				$('.select2').selectpicker('refresh');
			}
		});
		// END Ajax Call...
	});
	// END Edit system_setting...

	$('body').on('click', '.delete_system_setting', function(e) {
		var system_setting_id = $(this).attr('data_id');
		swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Delete Permanently",
			cancelButtonText: "Cancel",
			reverseButtons: true
		}).then(function(result){
			if (result.value) {
				$.ajax({
					url  : '<?php echo SURL; ?>setting/delete_system_setting',
					data : {system_setting_id:system_setting_id},
					type : "POST",
					success: function(output) {
						swal.fire({
							"title": "", 
							"text": "The Field has been deleted successfully!", 
							"type": "success",
							"confirmButtonClass": "btn btn-secondary"
						});
						window.location.replace('<?php echo SURL; ?>setting/system_setting');
						
					}
				});
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

	// Edit system_setting Process...
	$('body').on('click', '#update_system_setting_details', function() {
		
		var field_name    = $('#field_name_upd').val();
		var field_value  = $('#field_value_upd').val();
		var system_setting_id = $('#system_setting_id_upd').val();
		
		var formdata = new FormData();
		formdata.append('field_name',field_name);
		formdata.append('system_setting_id',system_setting_id);
		formdata.append('field_value',field_value);

		
		if (field_name == '') {
			$('#field_name_upd').css('border-color', 'red');
			return false;
		} else {
			$('#field_name_upd').css('border-color', 'lightgreen');
		}
		if (field_value == '') {
			$('#field_value_upd').css('border-color', 'red');
			return false;
		} else {
			$('#field_value_upd').css('border-color', 'lightgreen');
		}

		// Ajax Call...
		$.ajax({
			url : "<?php echo SURL?>setting/update_system_setting",
			type: "POST",
			data : formdata,
			cache: false,
			contentType: false,
			processData: false,
			success:function(response) 
			{	
				$('#edit_system_setting_modal').modal('hide');
				swal.fire("Success!", "Field Updated", "success");
				window.location.href = "<?php echo SURL?>setting/system_setting";
			}
		});
		// END Ajax Call...
	});
	// END Add New system_setting...
	
</script>
<?php }

if(in_array('CAMPAIGN', $PAGES_ALLOWED)) { ?>

	<script type="text/javascript">
	  
	    $("#upd_qa_admin_frm").submit(function(event){

	        event.preventDefault();
	        
	        var postData = $('#upd_qa_admin_frm').serializeArray();
	        $("#myModal_csv_progress_modal").modal('show');
	        
	        $.ajax({
	            url : "<?php echo SURL?>campaign/lead_csv_fields_process",
	            type: "POST",
	            data : postData,
	            success:function(response){   
	               	alert('CSV Uploaded Successfully');
	               	setTimeout(function(){                                   
	                   location.href = "<?php echo SURL;?>csv";
	               	}, 1000);
	            }
	        });
	    }); 

	    function process_csv_records(csv_id,total_new_leads){

	        $.ajax({
	            url : "<?php echo SURL?>campaign/lead_csv_fields_uploading/"+csv_id+'/'+total_new_leads,
	            type: "POST",
	            success:function(response) {

	                var csv_arr                     = JSON.parse(response);

	                var total_records               = parseInt(csv_arr.total_csv_records);
	                var processed_records           = parseInt(csv_arr.total_processed_records);
	                var total_empty_phone           = parseInt(csv_arr.total_empty_phone);
	                var total_new_leads             = parseInt(csv_arr.total_new_records);
	                var all_duplicates              = parseInt(csv_arr.all_duplicates);
	                var total_duplicate_records     = parseInt(csv_arr.total_duplicate_records);
	                var csv_id                      = csv_arr.id;

	                var progress = ( total_new_leads * 100 ) / total_records;
	                document.getElementById("csv_progressbar").style.width = progress+'%';

	                $("#csv_progressbar").html(parseInt(progress)+'%');

	                $("#total_csv_leads").html(total_records);

	                $("#total_processed_records").html(processed_records);

	                $("#total_empty_phone").html(total_empty_phone);

	                $("#total_new_leads").html(total_new_leads);

	                if($('#myModal_csv_progress_modal').hasClass('in')){

	                }else{

	                   $("#myModal_csv_progress_modal").modal('show');
	                    
	                }
	                
	                if( processed_records > 0 ) {

	                    process_csv_records(csv_id,total_new_leads);

	                }else{

	                    console.log('completed');

	                }

	            }
	        });

	    } 


	    // Edit system_setting Process...
		$('body').on('change', '.csv_id', function() {
			
			var csv_id = $(this).val();
			var sending_type = $('#sending_type').val();
			
			if(csv_id!=""){

				$.ajax({
					url : "<?php echo SURL?>campaign/get_total_participant",
					type: "POST",
					data : {csv_id:csv_id,sending_type:sending_type},
					success:function(response_data) 
					{
						$('#total_contacts').val(response_data);
					}
				});
			}
			
		});
		// END Add New system_setting...

		//subject_
		$('body').on('change', '#sending_type', function() {
			
			var type = $(this).val();
			
			if(type == 'email'){
				$('.subject_').css('display','block');
			}else{
				$('.subject_').css('display','none');
			}	

		});


		$('body').on('click', '#add_new_icon', function() {
			
			$('#add_new_icon').css('display','none');

			var sending_type   = $('#sending_type').val();
			var csv_id   = $('#csv_id').val();
			var sms_text = $('.text_message').val();
			var name 	 = $('#ca_name').val();
			var subject  = $('#subject').val();
			
			if(csv_id == ''){
				alert('Please select CSV');
				return;
			}

			if(name == ''){
				alert('Please Add Campaign Name');
				return;
			}

			if(sms_text == ''){
				alert('Please Add Text Message');
				return;
				// sms_text = 'Imhere';
			}

			if(sending_type == 'email' && subject == ''){
				alert('Please Add Subject');
				return;	
			}

			if(csv_id != "" && sms_text != "" && name != ""){

				$.ajax({
					url : "<?php echo SURL?>twilio_api/sms",
					type: "POST",
					data : {csv_id:csv_id,sms_text:sms_text,name:name,sending_type:sending_type,subject:subject},
					success:function(response) 
					{
						if(response == 202){
							alert('Campaign Send and on the Review Stage');
						}else{

							var csv_arr                     = JSON.parse(response);

			                var total_records               = parseInt(csv_arr.total_csv_records);
			                var processed_records           = parseInt(csv_arr.total_processed_records);
			                var total_not_sent_phone        = parseInt(csv_arr.total_not_sent_phone);
			                var total_sent_leads            = parseInt(csv_arr.total_sent_leads);
			                var total_pending_phone         = parseInt(csv_arr.total_pending_phone);
			                var campaign_id                      = csv_arr.campaign_id;

			                var total_leads = total_sent_leads + total_not_sent_phone;

			                var progress = ( total_leads * 100 ) / total_records;
			                document.getElementById("csv_progressbar").style.width = progress+'%';

			                $("#csv_progressbar").html(parseInt(progress)+'%');
			                $("#total_csv_leads").html(total_records);
			                $("#total_processed_records").html(processed_records);
			                $("#total_sent_leads").html(total_sent_leads);
			                $("#total_not_sent_leads").html(total_not_sent_phone);
			                $("#total_pending_leads").html(total_pending_phone);
			                

			                if($('#myModal_csv_progress_modal').hasClass('in')){
			                }else{
			                   $("#myModal_csv_progress_modal").modal('show');
			                }

			                if( total_pending_phone > 0 ) {
			                    process_campaign_records(campaign_id,total_sent_leads);
			                }else{
			                    console.log('completed');
			                }
						}


						// $('#total_contacts').val(response_data);
					}
				});
			}
			
		});


		function process_campaign_records(campaign_id,total_new_leads){

	        $.ajax({
	            url : "<?php echo SURL?>twilio_api/lead_campaign_uploading",
	            type: "POST",
	            data: {campaign_id:campaign_id},
	            success:function(response) {

	                var csv_arr                     = JSON.parse(response);

	                var total_records               = parseInt(csv_arr.total_records);
	                var processed_records           = parseInt(csv_arr.total_processed_records);
	                var total_not_sent_phone        = parseInt(csv_arr.total_not_sent_phone);
	                var total_sent_leads            = parseInt(csv_arr.total_sent_leads);
	                var total_pending_phone         = parseInt(csv_arr.total_pending_phone);
	                var campaign_id                 = csv_arr.campaign_id;

	                var total_leads = total_sent_leads + total_not_sent_phone;

		            var progress = ( total_leads * 100 ) / total_records;
	                // var progress = ( total_sent_leads * 100 ) / total_records;
	                document.getElementById("csv_progressbar").style.width = progress+'%';

	                $("#csv_progressbar").html(parseInt(progress)+'%');
	                $("#total_csv_leads").html(total_records);
	                $("#total_processed_records").html(processed_records);
	                $("#total_sent_leads").html(total_sent_leads);
	                $("#total_not_sent_leads").html(total_not_sent_phone);
	                $("#total_pending_leads").html(total_pending_phone);

	                if($('#myModal_csv_progress_modal').hasClass('in')){
	                }else{
	                   $("#myModal_csv_progress_modal").modal('show');
	                }
	                
	                if( total_pending_phone > 0 ) {
	                    process_campaign_records(campaign_id,total_sent_leads);
	                }else{
	                    console.log('completed');
	                }
	            }
	        });

	    } 

	</script>
<?php } 

if(in_array('DASHBOARD', $PAGES_ALLOWED)) { ?>
	<script type="text/javascript">
	  $(document).ready(function() {
	        
	        var time ='';                
            $.ajax({ 
                url : "<?php echo SURL; ?>campaign/get_client_campaigns_graphs/",
                type: "POST",
                data : {time:time},
                success:function(response) 
                { 
                   
                    var res = response.split('||');
                    var datas = res[0];
                    var datax = res[1];

                    Highcharts.chart('analysis_graph', {
                        title: {
                            text: 'CSV UPLOAD Statistics'
                        },
                        subtitle: {
                            text: ''
                        },
                        yAxis: {
                            title: {
                                text: 'Number of Events'
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
        
		});
	   
	</script>
<?php } 

if(in_array('CAMPAIGN_LOGS', $PAGES_ALLOWED)) { ?>

	<script type="text/javascript">

		$(document).ready(function() {
	        
	        var time ='';
	        var campaign_id = $('#campaign_id').val();


	        $.ajax({ 
	            url : "<?php echo SURL; ?>campaign/get_client_campaigns_analysis/",
	            type: "POST",
	            data : {time:time,campaign_id:campaign_id},
	            success:function(response) 
	            {   
	                $("#analysis_div").html(response);

	                
	                $.ajax({ 
	                    url : "<?php echo SURL; ?>campaign/get_client_campaigns_graphs/",
	                    type: "POST",
	                    data : {time:time,campaign_id:campaign_id},
	                    success:function(response) 
	                    { 
	                       
	                        var res = response.split('||');
	                        var datas = res[0];
	                        var datax = res[1];

	                        Highcharts.chart('analysis_graph', {
	                            title: {
	                                text: 'CSV UPLOAD Statistics'
	                            },
	                            subtitle: {
	                                text: ''
	                            },
	                            yAxis: {
	                                title: {
	                                    text: 'Number of CSV'
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
	            }
	        });    
		});

	</script>

<?php } 

if (in_array('EMAIL_LISTING', $PAGES_ALLOWED)) { ?>

<script src="<?php echo JS_FRONT;?>series-label.js"></script>
<script src="<?php echo JS_FRONT;?>export-data.js"></script>

<script>
    $(document).on("click", ".contact_filter_pagination li a", function(e){
        
        e.preventDefault();

        var page = $(this).data("ci-pagination-page");
        $('#pageno').val(page);

        var keyword = $(".campaign_search").val();
        var tab = $("#campaign_tab").val();
        var client_id = $("#client_id").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/email_campaign_search/"+page,
            type: "POST",
            data : {client_id:client_id,keyword:keyword,tab:tab},
            success:function(response) 
            { 
                var res =response.split("||");
                $('#response_pagination').html(res['1']);
                $('#table_body').html('<div class="xD_table_row"><div class="xD_table_cell xD_table_head" style="width: 40%;"><span class="xD_text">Campaign Name</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">No of Recipients</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">&nbsp;</span></div></div>');
                $('#table_body').append(res['0']);
            }
        });
        
    }); 


    $("body").on("click",".ardCta .btn",function(e){
		e.preventDefault();
		$(".accord-Review-body").removeClass("active");
		$(this).closest(".accord-Review-box").find(".accord-Review-body").addClass("active");
	});

	$("body").on("click",".send_now_radio",function(){
		$(".send_now_checked").show();
		$(".Schedule_for_late_checked").hide();
	});
	
	$("body").on("click",".Schedule_for_late_radio",function(){
		$(".Schedule_for_late_checked").show();
		$(".send_now_checked").hide();
	});

	$("body").on("click",".listTitl_btn",function(){
		var this_val_id = $(this).attr("val");
		$(this).closest("li").find(".listTitl_btn").removeClass("active");
		$(this).addClass("active");
		$(this).closest("li").find("input").val(this_val_id);
	});

    $("body").on("click", ".duplicate_campaign", function(){
        
        var campaign_id = $(this).attr('val');
     
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/duplicate_campaign",
            type: "POST",
            data : {campaign_id:campaign_id},
            success:function(response) 
            { 
                $(".campaign_search_button").trigger('click'); 
            }
        });                   

    });


    $("body").on("click", ".delete_campaign", function(){
        
        var campaign_id = $(this).attr('val');

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/delete_campaign",
            type: "POST",
            data : {campaign_id:campaign_id},
            success:function(response) 
            { 
                $(".campaign_search_button").trigger('click');
            }
        });

    });


    $("body").on("click", ".archive_campaign", function(){
        
        var campaign_id = $(this).attr('val');

   
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/update_campaign_status",
            type: "POST",
            data : {campaign_id:campaign_id},
            success:function(response) 
            { 
              $(".campaign_search_button").trigger('click');
            }
        });
    });


    $("body").on("click", ".campaign_search_button", function(){
        
        var keyword = $(".campaign_search").val();
        var tab = $("#campaign_tab").val();
        var client_id = $("#client_id").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/email_campaign_search",
            type: "POST",
            data : {client_id:client_id,keyword:keyword,tab:tab},
            success:function(response) 
            { 
              
                var res = response.split("||");

                $('#response_pagination').html(res['1']);
                $('#table_body').html('<div class="xD_table_row"><div class="xD_table_cell xD_table_head" style="width: 40%;"><span class="xD_text">Campaign Name</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">No of Recipients</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">&nbsp;</span></div></div>');
                $('#table_body').append(res['0']);
            }
        });

    });


    $("body").on("keyup", ".campaign_search", function(){
        
        var keyword = $(".campaign_search").val();
        var tab = $("#campaign_tab").val();
        var client_id = $("#client_id").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/email_campaign_search",
            type: "POST",
            data : {client_id:client_id,keyword:keyword,tab:tab},
            success:function(response) 
            { 
              
                var res = response.split("||");
              
                $('#response_pagination').html(res['1']);
                $('#table_body').html('<div class="xD_table_row"><div class="xD_table_cell xD_table_head" style="width: 40%;"><span class="xD_text">Campaign Name</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">No of Recipients</span><span class="xD_sort"></span></div><div class="xD_table_cell xD_table_head" style="width: 20%;"><span class="xD_text">&nbsp;</span></div></div>');
                $('#table_body').append(res['0']);
            }
        });

    });


    $("body").on("click", ".campaign_tab_button", function(){

        $(".campaign_tab_button").removeClass('active');
        $(this).addClass('active');
        $("#campaign_tab").val($(this).attr('val'));
        $(".campaign_search_button").trigger('click');

    });


    $("body").on("click", ".time_value", function(){

        $("#time_selected").html($(this).html());
        
        var time = $(this).attr('value');
        var campaign_id = $('#campaign_id').val();
        var client_id = $("#client_id").val();
        
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_campaigns_analysis/",
            type: "POST",
            data : {client_id:client_id,time:time,campaign_id:campaign_id},
            success:function(response) 
            {  
               $("#analysis_div").html(response); 
            }
        });

    });


    $("body").on("click", ".view_results", function(){

        $('#campaign_id').val($(this).attr('value'));

        var time ='';
        var campaign_id = $('#campaign_id').val();
        var client_id = $("#client_id").val();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_campaigns_analysis/",
            type: "POST",
            data : {client_id:client_id,time:time,campaign_id:campaign_id},
            success:function(response) 
            {   
                $("#analysis_graph").html('<p style="width:100%;text-align:center;font-weight:bold;color:red;"><img src="<?php echo IMG;?>graphloading.gif"></p>');
                $("#analysis_div").html(response);

                $('#email_analyse_tab').addClass('active');
                $('#analyze_email').addClass('in active');

                $('#email_manage_tab').removeClass('active');
                $('#manage_email').removeClass('in active'); 

                $('#unsubscribe_tab').removeClass('active');
                $('#unsubscribe').removeClass('in active');

                $.ajax({ 
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_campaigns_graphs/",
                    type: "POST",
                    data : {client_id:client_id,time:time,campaign_id:campaign_id},
                    success:function(response) 
                    { 
                       
                        var res = response.split('||');
                        var datas = res[0];
                        var datax = res[1];

                        Highcharts.chart('analysis_graph', {
                            title: {
                                text: 'Email Campaign Response Statistics'
                            },
                            subtitle: {
                                text: ''
                            },
                            yAxis: {
                                title: {
                                    text: 'Number of Events'
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
            }
        });      

    });


    $("body").on("click", "#email_analyse_tab", function(){

        
        $('#campaign_id').val('');
        var time ='';
        var campaign_id = $('#campaign_id').val();
        var client_id = $("#client_id").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_campaigns_analysis/",
            type: "POST",
            data : {client_id:client_id,time:time,campaign_id:campaign_id},
            success:function(response) 
            {   

                var client_id = $("#client_id").val();
                
                $("#analysis_graph").html('<p style="width:100%;text-align:center;font-weight:bold;color:red;"><img src="<?php echo IMG;?>graphloading.gif"></p>');
                $("#analysis_div").html(response);

                $('#email_analyse_tab').addClass('active');
                $('#analyze_email').addClass('in active');

                $('#email_manage_tab').removeClass('active');
                $('#manage_email').removeClass('in active'); 

                $('#unsubscribe_tab').removeClass('active');
                $('#unsubscribe').removeClass('in active');

                $.ajax({ 
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_campaigns_graphs/",
                    type: "POST",
                    data : {client_id:client_id,time:time,campaign_id:campaign_id},
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success:function(response) 
                    { 
                       
                        var res=response.split('||');
                        var datas=res[0];
                        var datax =res[1];
                        //$("#analysis_graph").html('');
                        Highcharts.chart('analysis_graph', {
                            title: {
                                text: 'Email Campaign Response Statistics'
                            },
                            subtitle: {
                                text: ''
                            },
                            yAxis: {
                                title: {
                                    text: 'Number of Events'
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
            }
        });
    });

    $("body").on("click", "#unsubscribe_tab", function(){
        
        var client_id = $("#client_id").val();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_unsubscribe_contacts/",
            type: "POST",
            data : {client_id:client_id},
            success:function(response) 
            {   
                var res = response.split('*||*');
                $('#unsub_ajax').html(res[0]);
                $('#unsubscribe_tab').addClass('active');
                $('#unsubscribe').addClass('in active');
                $('#email_manage_tab').removeClass('active');
                $('#manage_email').removeClass('in active'); 
                $('#email_analyse_tab').removeClass('active');
                $('#analyze_email').removeClass('in active'); 

            }
        });
    });

    $(document).on("click", ".unsub_pagination li a", function(e){
        
        e.preventDefault();

        var page = $(this).data("ci-pagination-page");

        var client_id = $("#client_id").val();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_unsubscribe_contacts/"+page,
            type: "POST",
            data : {client_id:client_id},
            success:function(response) 
            {   
                var res = response.split('*||*');
                $('#unsub_ajax').html(res[0]);
                $('#unsubscribe_tab').addClass('active');
                $('#unsubscribe').addClass('in active');
                $('#email_manage_tab').removeClass('active');
                $('#manage_email').removeClass('in active'); 
                $('#email_analyse_tab').removeClass('active');
                $('#analyze_email').removeClass('in active'); 

            }
        });
        
    }); 

    $("body").on("click", ".resub", function(){
        
        var unsub_id = $(this).attr('unsub_id');
        var lead_id = $(this).attr('contact_id');
        var lead_email = $(this).attr('lead_email');
        var group_id = $(this).attr('group_id');

        if($('#consent_confirm').is(':checked')){

            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/remove_contact_unsub_list",
                type: "POST",
                data : {unsub_id:unsub_id,lead_id:lead_id,group_id:group_id,lead_email:lead_email},
                success:function(response) 
                { 
                    $('#inv_row'+unsub_id).remove();
                }
            });

        }else{

            return false;
        }

    });
</script>

<?php } 


if (in_array('ADD_EMAIL_campaign', $PAGES_ALLOWED)) { ?>

<!-- Jquery Confirm -->
<script src="https://callersiq.com/assets/js_front/jquery-confirm.min.js"></script>

<script>


    var csv_array = new Array();
    var dont_csv_array = new Array();
    var editor_type = "";

    $(document).ready(function(e) {
  
        $('#sender_select').trigger("change");
        
        $('#temp_name_div').show();

        $(function () {
            $('#datetimepicker1').datetimepicker();
        });

        resizeChosen();
        jQuery(window).on('resize', resizeChosen);
        
        $(document).on("click", ".creat_list_pagi li a", function(e){
            
            e.preventDefault();
            var page = $(this).data("ci-pagination-page");
            $('#pageno').val(page);
            var where_clause = $('#where_clause').val();

            var page = $('#pageno').val();
           
            // $(".sd-loader").show();
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/"+page,
                type: "POST",
                data : {where_clause:where_clause},
                success:function(response) 
                { 
                    res = response.split("*||*");
                    $('.table_box_body').html(res[1]);
                    $('#page_links').html(res[3]);

                    // $(".sd-loader").hide();
                    set_table_box_width();

                    var total_contacts = $("#result_total_contacts").val();

                    if(total_contacts != 0){

                        $(".lead_checkbox").prop('checked', true);
                        $('.check_all').prop('checked', true);
                        $('#table_default_header').hide();
                        $('#bulk_changes_div').show();
                        $("#is_bulk_total").val('1'); 
                        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                    }else{

                        $(".lead_checkbox").prop('checked', false);
                        $('.check_all').prop('checked', false);

                        $('#bulk_changes_div').hide();
                        $('#table_default_header').show();
                        $("#is_bulk_total").val('0');
                        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                    } 

                    $('#listing_modal').modal('show');
                }
            });
        }); 


    });
</script>

<script type="text/javascript">

    $("body").on("click",".save_campaign_btn",function(){

        var client_id = $("#lead_client_id").val();
        var redirect = $(this).attr('id');
        var tab_id  = $(this).attr('tab-id');

        // verifying data
        if(redirect=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        

                    }
                });

            }
        }
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }

            var email_contents = $('#template_builder').val()
            
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    
                    $('#campaign_id').val(response_data);
                    $('#design_ancher').removeClass('active');
                    $('#ct_Design').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#recipients_ancher').removeClass('tab_disabled');

                    $("#review_subject").html($("#email_subject").val());
                    $("#review_pretext").html($("#preview_text").val());
                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#settings_ancher').removeClass('active');
                    $('#ct_Settings').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#review_ancher').removeClass('tab_disabled');

                    //setting saved data in review tab fields
                    $("#review_from").html($("#from_email").val());
                    


                    
                }
            });

            // verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();

            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            if(email_contents ==''){}
            if(campaign_name ==''){}
            if(email_subject ==''){}
            if(preview_text ==''){}
            if(sender_id ==''){}
            if(csv_array ==''){}


            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }

    });

    $("body").on("click",".save_campaign_next_btn",function(){

        var client_id   = $("#lead_client_id").val();
        
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            
            var redirect        = 'settings_ancher';
            var tab_id          = 'ct_Settings';

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }

            var email_contents = $('#template_builder').val()
            
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    
                    $('#campaign_id').val(response_data);
                    $('#design_ancher').removeClass('active');
                    $('#ct_Design').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#recipients_ancher').removeClass('tab_disabled');

                    $("#review_subject").html($("#email_subject").val());
                    $("#review_pretext").html($("#preview_text").val());
                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            var redirect        = 'recipients_ancher';
            var tab_id          = 'ct_Recipients';

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#settings_ancher').removeClass('active');
                    $('#ct_Settings').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#review_ancher').removeClass('tab_disabled');

                    //setting saved data in review tab fields
                    $("#review_from").html($("#from_email").val());
                    


                    
                }
            });

            verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            var redirect        = 'review_ancher';
            var tab_id          = 'ct_Review';

            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();
            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            var redirect        = 'schedule_ancher';
            var tab_id          = 'ct_SendOrSchedule';

            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }

        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }       

    });

    $("body").on("click",".save_campaign_back_btn",function(){

        if($("li.active").attr('id')=='design_ancher'){
            
            
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            $('#settings_ancher').removeClass('active');
            $('#ct_Settings').removeClass('in active');
            $('#design_ancher').addClass('active');
            $('#ct_Design').addClass('in active');
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#settings_ancher').addClass('active');
            $('#ct_Settings').addClass('in active');
            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#recipients_ancher').addClass('active');
            $('#ct_Recipients').addClass('in active');
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#review_ancher').addClass('active');
            $('#ct_Review').addClass('in active');
            
        }

        
        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }

    });

    $("body").on("click","#schedule_campaign",function(){
            
        var client_id           = $('#lead_client_id').val();
        var sender              = $('#sender_select').val();
        var unsub_group         = $('#suppression_list_id').val();

        var campaign_name = $('#campaign_name').val();
        var from_name = $('#from_name').val();
        var from_email = $('#from_email').val();
        var email_subject = $('#email_subject').val();
        var preview_text = $('#preview_text').val();

        var email_contents = $('#template_builder').val()
        
        var email_contents_html = email_contents;

        if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){

            var check_sender = verify_sender(); 

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                type: "POST",
                data : {client_id:client_id},
                success:function(response_data){ 

                    if(response_data == '1'){

                        var schedule = $('#email_schedule').val();
                        if(schedule !=''){
                            
                            var campaign_id = $('#campaign_id').val();
                            var total_recipients = $('#t_resp').text();
                            check_sender = $('#sender_Verified_bit').val();
                            $.ajax({
                                url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_schedule",
                                type: "POST",
                                data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                success:function(response_data) 
                                { 
                                    check_sender = $('#sender_Verified_bit').val();
                                    if( check_sender !== 0 && check_sender !== '0' ){

                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has successfully been scheduled. If you scheduled a large list it may take some time to send the emails.</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                                        setTimeout(function(){
                                       
                                            location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                        }, 5000);

                                    }else{

                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-warning" role="alert"> <b>You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid.This campaign will be saved as a draft. Kindly verify your email address and schedule again...</b></div></div>');
                                    }
                                }
                            }); 
                        }

                    }else{

                        $.confirm({
                            title: 'Alert',
                            content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                            icon: 'fa fa-warning',
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            opacity: 0.5,
                            buttons: {
                                confirm: {
                                    text: 'Ok, sure!',
                                    btnClass: 'btn-red',
                                    action: function (){ },
                                    cancel: function (){ }
                                }
                            }
                            
                        });

                    }
                }
            }); 
        }else{

            $.alert({
                title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                content: 'Please complete the missing information before scheduling this campaign.',
            });

            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#review_ancher').addClass('active');
            $('#ct_Review').addClass('in active');

            // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }

        }
        }
               
    });
    
    $("body").on("click","#send_test_email_design_tab",function(){

        var check_sender = verify_sender(); 
        if( check_sender !== 0 && check_sender !== '0' ){


            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text = $('#preview_text').val();
            var test_email_address = $('#send_test_email_design').val();

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Campaign Name Empty.</b></div>');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>From Name Empty.</b></div>');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>From Email Empty.</b></div>');
            }else{
                $('#from_email').removeClass('error');
            }
            if(email_subject==''){
                $('#email_subject').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Email Subject Empty.</b></div>');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(test_email_address==''){

                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Send Email Empty.</b></div>');
            }

            var email_contents = $('#template_builder').val()
            

            var client_id = $('#lead_client_id').val();
            
            if(campaign_name !='' && from_name !='' && from_email !='' && email_subject !='' && test_email_address !=''){
                $('#response_message').html('');
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            if(test_email_address !=''){

                                var campaign_id = $('#campaign_id').val();
                                $('#send_test_email_design_tab').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/send_email_test",
                                    type: "POST",
                                    data : {test_email_address:test_email_address,client_id:client_id,email_subject:email_subject,from_name:from_name,from_email:from_email,preview_text:preview_text,email_contents:email_contents},
                                    success:function(response_data) 
                                    {   
                                        $.alert({
                                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                            content: 'Test email sent successfully!',
                                        });
                                        $('#send_test_email_design_tab').html('Send Email');
                                        $('#send_test_email_design').val('');
                                        
                                    }
                                });    
                            }

                        }else{

                            $.confirm({
                                title: 'Alert',
                                content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                                icon: 'fa fa-warning',
                                animation: 'zoom',
                                closeAnimation: 'zoom',
                                opacity: 0.5,
                                buttons: {
                                    confirm: {
                                        text: 'Ok, sure!',
                                        btnClass: 'btn-red',
                                        action: function (){ },
                                        cancel: function (){ }
                                    }
                                }
                            });
                        }
                    }
                });

            }   
        }    

    });

    $("body").on("click","#send_test_email",function(){

        var check_sender = verify_sender(); 
        if( check_sender !== 0 && check_sender !== '0' ){

            var client_id = $('#lead_client_id').val();
            
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                type: "POST",
                data : {client_id:client_id},
                success:function(response_data){ 

                    if(response_data == '1'){

                        var test_email_address = $('#test_email_address').val();
                        if(test_email_address !=''){

                                            
	                        var campaign_id = $('#campaign_id').val();

	                        $('#send_test_email').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');

	                        $.ajax({
	                            url : "<?php echo SURL?>sendgrid_campaigns/send_test_email",
	                            type: "POST",
	                            data : {test_email_address:test_email_address,campaign_id:campaign_id},
	                            success:function(response_data) 
	                            {   

	                                $.alert({
	                                    title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
	                                    content: 'Test email sent successfully!',
	                                });
	                                $('#send_test_email').html('Send Email');
	                                $('#test_email_address').val('');
	                            }
	                        });
	                
                        }

                    }else{

                        $.confirm({
                            title: 'Alert',
                            content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                            icon: 'fa fa-warning',
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            opacity: 0.5,
                            buttons: {
                                confirm: {
                                    text: 'Ok, sure!',
                                    btnClass: 'btn-red',
                                    action: function (){ },
                                    cancel: function (){ }
                                }
                            }
                        });
                    }
                }
            });  
        }     

    });
    
    $("body").on("click",".edit_recipients",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#recipients_ancher').addClass('active');
        $('#ct_Recipients').addClass('in active');
          
    });

    
    $("body").on("click",".edit_settings",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#settings_ancher').addClass('active');
        $('#ct_Settings').addClass('in active');
          
    });

    $("body").on("click",".edit_design",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#design_ancher').addClass('active');
        $('#ct_Design').addClass('in active');
          
    });

     
    $("body").on("click","#sendnow_btn",function(){

        var client_id = $('#lead_client_id').val();
        var total_recipients = $('#t_resp').text();
        
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
            type: "POST",
            data : {client_id:client_id},
            success:function(response_data){ 

                if(response_data == '1'){ 

                    $.confirm({
                        title: 'Confirmation',
                        content: 'Are you sure want to Send This Email Campaign Instantly?',
                        icon: 'fa fa-warning',
                        animation: 'zoom',
                        closeAnimation: 'zoom',
                        opacity: 0.5,
                        buttons: {
                            confirm: {
                                text: 'Yes, sure!',
                                btnClass: 'btn-red',
                                action: function ()
                                { 
                                    var campaign_id = $('#campaign_id').val();
                                    if(campaign_id !=''){

                                        $(".loader-image3").show();
                                        $.ajax({
                                            url : "<?php echo SURL?>sendgrid_campaigns/sendnow_email_campaign",
                                            type: "POST",
                                            data : {campaign_id:campaign_id, csv_array:csv_array, schedule:"send_now", total_recipients:total_recipients,dont_csv_array:dont_csv_array},
                                            success:function(response_data) 
                                            {   
                                                $(".loader-image3").hide();

                                                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has successfully been scheduled. If you scheduled a large list it may take some time to send the emails.</b> </br> You will be redirectly to campaign listing page within 5 seconds....</div></div>');

                                                setTimeout(function(){
                                                   
                                                    location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                                }, 5000);
                                            }
                                        });
                                    }
                                }
                            },
                            cancel: function (){
                            }
                        }
                    });

                }else{

                    $.confirm({
                        title: 'Alert',
                        content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                        icon: 'fa fa-warning',
                        animation: 'zoom',
                        closeAnimation: 'zoom',
                        opacity: 0.5,
                        buttons: {
                            confirm: {
                                text: 'Ok, sure!',
                                btnClass: 'btn-red',
                                action: function (){ },
                                cancel: function (){ }
                            }
                        }
                    });

                }
            }
        });       

    });


    $("body").on("click",".Include_csv",function(){

        var contact_id = $(this).attr('val');
        
        $(this).addClass('active');
        $(this).addClass('inc-ex_disabled');
        
        $('#csv_ex'+contact_id).removeClass('active');
        $('#csv_ex'+contact_id).removeClass('inc-ex_disabled');
        
        var name = $('#csv_span_'+contact_id).html();
        var no_of_leads = $('#csvno_span_'+contact_id).html();

        var html ='<li id="sendto_list_csv'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
        
        $('#sendto_list').append(html);
        $( "#dont_send_list_csv_"+contact_id ).remove();
        csv_array.push(contact_id);

        var t_resp = parseInt($('#t_resp').html()) + parseInt(no_of_leads);
        $('#t_resp').html(t_resp);

        dont_csv_array = $.grep(dont_csv_array, function(value){
            return value != contact_id;
        });
     
    });

    $("body").on("click",".Exclude_csv",function(){

        var contact_id = $(this).attr('val');

        $(this).addClass('active');
        $(this).addClass('inc-ex_disabled');
        
        $('#csv_in'+contact_id).removeClass('active');
        $('#csv_in'+contact_id).removeClass('inc-ex_disabled');
        
        var name = $('#csv_span_'+contact_id).html();
        var no_of_leads = $('#csvno_span_'+contact_id).html();
        var html ='<li id="dont_send_list_csv_'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="d_remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
        
        $('#dont_send_list').append(html);
        $( "#sendto_list_csv"+contact_id).remove();

        for(var i=0; i<csv_array.length; i++){

            if(csv_array[i] == contact_id){

                var t_resp = parseInt($('#t_resp').html()) - parseInt(no_of_leads);
                $('#t_resp').html(t_resp);
            }
        };

        csv_array = $.grep(csv_array, function(value){
            return value != contact_id;
        });

        dont_csv_array.push(contact_id);
       
    });

    $("body").on("click",".remove_csv",function(){

        var contact_id = $(this).attr('val');
        var no_of_leads = $('#csvno_span_'+contact_id).html();

        $( "#sendto_list_csv"+contact_id ).remove();
        $('#csv_in'+contact_id).removeClass('active');
        $('#csv_in'+contact_id).removeClass('inc-ex_disabled');

        //removing contact from array
        csv_array = $.grep(csv_array, function(value){
            return value != contact_id;
        });

        $('#t_resp').html(parseInt($('#t_resp').html()) - parseInt(no_of_leads));
        $("#review_t_resp").html($("#t_resp").html());
        $("#review_sendto").html($("#sendto_list").html());
           
    });

    $("body").on("click",".d_remove_csv",function(){

        var contact_id = $(this).attr('val');
        $( "#dont_send_list_csv_"+contact_id ).remove();
        $('#csv_ex'+contact_id).removeClass('active'); 
        $('#csv_ex'+contact_id).removeClass('inc-ex_disabled');
        $("#review_dont_sendto").html($("#dont_send_list").html()); 

        //removing contact from array
        dont_csv_array = $.grep(dont_csv_array, function(value){
            return value != contact_id;
        });

    });

    $("body").on("click","#csv_Search",function(){

        var client_id = $("#lead_client_id").val();
        var keyword = $("#csv_Search_input").val();
       
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/search_email_campaign_lists",
            type: "POST",
            data : {client_id:client_id,keyword:keyword},
            success:function(response_data) 
            {
                
                $('#csv_lists').html(response_data);

                //disabling already added csvs and leads
                for(var z=0; z<csv_array.length ;z++){

                    $('#csv_in'+csv_array[z]).addClass('active');
                    $('#csv_in'+csv_array[z]).addClass('inc-ex_disabled');   
                }

                //disabling already added csvs and leads
                for(var z=0; z<dont_csv_array.length ;z++){

                    $('#csv_ex'+dont_csv_array[z]).addClass('active');
                    $('#csv_ex'+dont_csv_array[z]).addClass('inc-ex_disabled');   
                }

                
            }
        });
        
    });

    
    $("body").on("keyup","#csv_Search_input",function(){

        var client_id = $("#lead_client_id").val();
        var keyword = $("#csv_Search_input").val();
       
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/search_email_campaign_lists",
            type: "POST",
            data : {client_id:client_id,keyword:keyword},
            success:function(response_data) 
            {
                
                $('#csv_lists').html(response_data);

                //disabling already added csvs and leads
                for(var z=0; z<csv_array.length ;z++){

                    $('#csv_in'+csv_array[z]).addClass('active');
                    $('#csv_in'+csv_array[z]).addClass('inc-ex_disabled');   
                }

                //disabling already added csvs and leads
                for(var z=0; z<dont_csv_array.length ;z++){

                    $('#csv_ex'+dont_csv_array[z]).addClass('active');
                    $('#csv_ex'+dont_csv_array[z]).addClass('inc-ex_disabled');   
                }

            }
        });
        
    });

    function set_table_box_width(){
    
        var i = 0;
        $(".tbh_item").each(function(index, element){

            if($(this).hasClass("tbs-xs")){
                i = i+70; 
            } 
            if($(this).hasClass("tbs-sm")){
                i = i+140; 
            }
            if($(this).hasClass("tbs-md")){
                i = i+210; 
            }
            if($(this).hasClass("tbs-lg")){
                i = i+280; 
            }
            if($(this).hasClass("tbs-xlg")){
                i = i+350; 
            }      
        });

        var width_of_tablebox = i;
        $(".table_box_header_iner").width(width_of_tablebox);
        $(".table_box_body_iner").width(width_of_tablebox);
       
        if(width_of_tablebox > $(window).width()){
            $(".table_box_header").width(width_of_tablebox);
            $(".table_box_body").width(width_of_tablebox);
        }else{
            $(".table_box_header").css("width","100%");
            $(".table_box_body").css("width","100%");
        }
    }

    $(window).resize(function(){
        set_table_box_width();
    });

    function resizeChosen(){

        $(".chosen-container").each(function() {
            $(this).attr('style', 'width: 100%');
        }); 
    }

    function delay(callback, ms){

        var timer = 0;
        return function(){

            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function (){
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    $("body").on("click","#create_new_list",function(){

         var count_list = $(".total_list").val();

        if(count_list < 5){

            $('#create_new_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            $('#table_ajax_data').html('');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
                type: "POST",
                data : "",
                success:function(response) 
                {   
                    res = response.split("*||*");
                    $('#table_ajax_data').html(res[0]);

                    // get_inv_srch();
                    set_table_box_width();
                    
                    $('#create_new_list').html('Create New List');
                    $('#listing_modal').modal('show');

                    var total_contacts = $("#result_total_contacts").val(); 
                    if(total_contacts != 0){

                        $(".lead_checkbox").prop('checked', true);
                        $('.check_all').prop('checked', true);
                        $('#table_default_header').hide();
                        $('#bulk_changes_div').show();
                        $("#is_bulk_total").val('1'); 
                        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                    }else{
                        
                        $(".lead_checkbox").prop('checked', false);
                        $('.check_all').prop('checked', false);

                        $('#bulk_changes_div').hide();
                        $('#table_default_header').show();
                        $("#is_bulk_total").val('0');
                        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                    }
                }
            });

        }else{
            $.alert({
                title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                content: "Your list could not create a new list because you've reached your limit of 5 lists. To create a new list, you'll need to delete existing lists to make room.",
            });
        }
         
    });

    $("body").on("click",".listing-apply-filters-btn",function(){
       
        var res = $('#builder_inventory_champion').queryBuilder('getMongo');
        $('#result').removeClass('hide').find('pre').html(
            JSON.stringify(res, undefined, 2)
        );

        var html_data = JSON.stringify(res, undefined, 2);

        $('#where_clause').val(html_data);
        // $(".sd-loader").show();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
              
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_links').html(res[3]);

                // $(".sd-loader").hide();

                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);

                set_table_box_width();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);

                    $('#bulk_changes_div').hide();
                    $('#table_default_header').show();
                    $("#is_bulk_total").val('0');
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 

                $('#listing_modal').modal('show');
            }
        });

    });

    $("body").on("click",".listing-reset-filters-btn",function(){
      
        // $(".sd-loader").show();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
            type: "POST",
            data : "",
            success:function(response) 
            {  
              
                var res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
             
                // $(".sd-loader").hide();
                // get_inv_srch();
                set_table_box_width();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);

                    $('#bulk_changes_div').hide();
                    $('#table_default_header').show();
                    $("#is_bulk_total").val('0');
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 

                $('#listing_modal').modal('show');
            }
        });
    
    });


    $("body").on("click",".check_all",function(){

        var total_contacts=$('#result_total_contacts').val();
        // if(total_contacts > 0){

            if($(this).is(":checked")){

                $(".lead_checkbox").prop('checked', true);
                $('#response_total_counter').html($('input.lead_checkbox:checked').length);
                $('#table_default_header').hide();
                $('#bulk_changes_div').show();
                $(".check_all").prop('checked', true);
                $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');

            }else{

                $(".lead_checkbox").prop('checked', false);
                $('#response_total_counter').html($('input.lead_checkbox:checked').length);
                $('#table_default_header').show();
                $("#is_bulk_total").val('0');
                $('#bulk_changes_div').hide();
                $(".check_all").prop('checked', false);
            }
        // }

    });


    $("body").on("click",".lead_checkbox",function(){

        if($(this).is(":checked")){

            var total_contacts=$('#result_total_contacts').val();
            $('#response_total_counter').html($('input.lead_checkbox:checked').length);
            $('#bulk_changes_div').show();
            $('#table_default_header').hide();
            $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
            $("#is_bulk_total").val('0');

        }else{

            var total_contacts=$('#result_total_contacts').val();
            $(".check_all").prop('checked', false);
            $('#response_total_counter').html($('input.lead_checkbox:checked').length);
            $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
            $("#is_bulk_total").val('0');

            if($('input.lead_checkbox:checked').length < 1){
                $('#table_default_header').show();
                $('#bulk_changes_div').hide(); 
            }
        }



		/*if($(this).is(':checked')) {

			$('#bulk_changes_div').show();
			$('#main_table_div').hide();
			$("#checkAll_outer").prop('checked', true);
			$("#checkAll_inner").prop('checked', true);
		}

		$(this).prop('checked', this.checked);

		var total_chcked = $('.lead_checkbox:checked').length;
		var total_contacts = $("#response_total_counter").text();

		$("#no_of_bulk_contacts").val(total_chcked);
		$("#is_bulk_total").val('no');

		$("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');*/
      
    });


    $("body").on("click","#all_bulk_contacts",function(e){

        var total_contacts = $("#result_total_contacts").val(); 
        $("#is_bulk_total").val('1'); 
        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
        $(".lead_checkbox").prop('checked', true);
        $('.check_all').prop('checked', true);
    
    });


    $("body").on("click","#clear_selection",function(e){

        var total_contacts=$('#result_total_contacts').val();
        $(".lead_checkbox").prop('checked', false);
        $('.check_all').prop('checked', false);

        $('#bulk_changes_div').hide();
        $('#table_default_header').show();
        $("#is_bulk_total").val('0');
        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
        
    });


    $("body").on("click","#save_list",function(){
        
        var postData = $('#selection_form').serializeArray();
        var where_clause = $('#where_clause').val();
        var list_name = $('#list_name').val();
        var list_type = $('#list_type').val();
        var check = $("#is_bulk_total").val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'where_clause', value: where_clause});
        postData.push({name: 'list_name', value: list_name});
        postData.push({name: 'list_type', value: list_type});

        if(list_name !='' ){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_list_name/",
                type: "POST",
                data:{list_name:list_name},
                success:function(response_data) 
                {
                    if(response_data == '0'){

                        $.ajax({ 
                            url : "<?php echo SURL?>sendgrid_campaigns/add_new_list/",
                            type: "POST",
                            data : postData,
                            success:function(response) 
                            {   
                                $('#csv_Search_input').trigger('keyup');
                                $('#listing_modal').modal('hide');

                                
                            }
                        });
                        

                    }else{

                        $.alert({
                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                            content: "There is already a list with this name. Please enter another name",
                        });
                        $('#list_name').css('border', 'solid 1px red');
                    }
                    
                }
            }); 
            

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });

    function update_contacts_records(data){

        var data_arr = JSON.parse(data)
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/update_list_contacts_records/"+data_arr.client_id+"/"+data_arr.sendgrid_list_id+"/"+data_arr.callersiq_list_id+"/"+data_arr.contacts_counter,
            type: "POST",
            success:function(response_data) 
            {   
                if(response_data == '0' || response_data == ''){
                    
                    setTimeout(function(){ 

                        update_contacts_records(response); 

                    }, 3000);
                    update_contacts_records(data);

                }else{
                    $('#csv_Search_input').trigger('keyup');
                    // $(".sd-loader").hide();
                    $('#listing_modal').modal('hide');
                }
            }
        });

    }

    $("body").on("click","#add_contact_list",function(){
        
        var postData = $('#selection_form').serializeArray();
        var where_clause = $('#eddit_where_clause').val();
        var check = $("#is_bulk_total").val();
        var list_id = $('#list_id').val();
        var client_id = $('#lead_client_id').val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'where_clause', value: where_clause});
        postData.push({name: 'list_id', value: list_id});
        postData.push({name: 'client_id', value: client_id});
        
        if(list_id !=''){

            $('#save_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/add_contact_list/",
                type: "POST",
                data : postData,
                success:function(response) 
                {  

                    $('#csv_Search_input').trigger('keyup');

                    $('#save_list').html('Save List');
                    $('#listing_modal').modal('hide');
                }
            });

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });    


    $("body").on("click","#delete_list_contact",function(){
        
        var postData = $('#selection_form').serializeArray();
        var list_id = $('#list_id').val();
        var check = $("#is_bulk_total").val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'list_id', value: list_id});

        if(list_id !=''){

            $('#save_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/remove_list_contact/",
                type: "POST",
                data : postData,
                success:function(response) 
                {  

                    $('#csv_Search_input').trigger('keyup');

                    $('#save_list').html('Save List');
                    $('#listing_modal').modal('hide');
                }
            });

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });

   
    $("body").on("click",".delete_csv",function(){

        var id = $(this).attr('val');
        var total_list = $(".total_list").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/delete_contact_list",
            type: "POST",
            data : {id:id},
            success:function(response) 
            { 
                $('#csv_span_'+id).html();
                var no_of_leads = $('#csvno_span_'+id).html();

                //count all list
                total_list = parseInt(total_list) - 1;
                $(".total_list").val(total_list); 
                    
                $( "#dont_send_list_csv_"+id).remove();
                $( "#sendto_list_csv"+id).remove();

                for(var i=0;i< csv_array.length;i++){

                    if(csv_array[i] == id){

                        var t_resp = parseInt($('#t_resp').html()) - parseInt(no_of_leads);
                        $('#t_resp').html(t_resp);
                    }
                };

                csv_array = $.grep(csv_array, function(value){
                    return value != id;
                });

                $('#csv_span_'+id).parent().remove();
            }
        });
                  
    });

    $(document).ready(function(e) {
        $("body").on("click",".li_select_chs",function(){
            $(this).closest(".c_chosen").addClass("chos_li_selected");
        });
        $("body").on("click",".remove_slct_chsn",function(){
            var this_selected = $(this).closest(".c_chosen").find(".c_chosne_btn");
            if(this_selected.length < 2){
                $(this).closest(".c_chosen").removeClass("chos_li_selected");
            }
        });
    });


    $("body").on("click",".edit_list",function(){

        $(".loader-image3").show();
        var str = $(this).attr('id').split("_");
        var id = str[2];
        $('#list_id').val(id);

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/",
            type: "POST",
            data : {id:id},
            success:function(response) 
            {   

                res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
                set_table_box_width();
                $('#listing_modal').modal('show');
                $(".loader-image3").hide();
                // get_inv_srch();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        }); 

    });


    $("body").on("click",".listing-eddit-reset-filters-btn",function(){
        
        $(".loader-image3").show();
        var id = $('#list_id').val();

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/",
            type: "POST",
            data : {id:id},
            success:function(response) 
            {   
                res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
                set_table_box_width();
                $('#listing_modal').modal('show');
                // $(".loader-image3").hide();
                // get_inv_srch();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });
    
    });


    $("body").on("click", ".remove_list_pagi li a", function(e){

        e.preventDefault();
        var page = $(this).data("ci-pagination-page");
        $('#pageno_list').val(page);
        var id = $('#list_id').val();
        var page = $('#pageno_list').val();

        $(".loader-image5").show();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/"+page,
            type: "POST",
            data : {id:id},
            success:function(response) 
            { 
                res = response.split("*||*");
                $('.table_box_body').html(res[1]);
                $('#page_link_list').html(res[3]);
                set_table_box_width();
                // $(".loader-image5").hide();

                var total_contacts = $("#result_total_contacts").val(); 
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                }

                $('#listing_modal').modal('show');
            }
        });
    
    });


    $("body").on("click", ".addmore_list_pagi li a", function(e){

        e.preventDefault();
        var page = $(this).data("ci-pagination-page");

        $('#pageno_eddit_list').val(page);
        var page = $('#pageno_eddit_list').val();

        var html_data = $('#eddit_where_clause').val();
        
        // $(".sd-loader").show();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_addmore_contacts_listing/"+page,
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_link_list').html(res[3]);

                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);
                
                $(".newclckhvr").html('<div class="tbh-data"><a href="javascript:void(0)" id="add_contact_list" class="btn btn-danger" id="save_menu">Add Contact to List</a></div>');
                // get_inv_srch();

                set_table_box_width();
                // $(".sd-loader").hide();
                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });

    });

    $("body").on("click",".listing-eddit-apply-filters-btn",function(){
       
        var res = $('#builder_inventory_champion').queryBuilder('getMongo');
        $('#result').removeClass('hide').find('pre').html(
            JSON.stringify(res, undefined, 2)
        );

        var html_data = JSON.stringify(res, undefined, 2);
        $('#eddit_where_clause').val(html_data);
        // $(".sd-loader").show();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_addmore_contacts_listing/",
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_link_list').html(res[3]);

                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);
                
                $(".newclckhvr").html('<div class="tbh-data"><a href="javascript:void(0)" id="add_contact_list" class="btn btn-danger" id="save_menu">Add Contact to List</a></div>');
                // get_inv_srch();

                set_table_box_width();
                // $(".sd-loader").hide();
               var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });

    }); 

    $('#sender_select').on("change",function(){

        var sender_id = $(this).val();
        $('#delete_sender_modal_btn').remove();
        $('.resend_sender_email_btn').remove();

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_sendgrid_sender_by_id/"+sender_id,
            type: "POST",
            success:function(response_data){
                var data = JSON.parse(response_data); 
                $('#from_name').val(data.from_name);
                $('#from_email').val(data.from_email);
                $('#reply_email').val(data.reply_to);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#state').val(data.state);
                $('#zip_code').val(data.zipcode);
                $('#country').val(data.country);

                if(response_data != 0){
                    $(".delete_sender_btn").prepend('<button type="button" class="btn btn-danger btn-sm resend_sender_email2" id="delete_sender_modal_btn">Delete sender</button>');
                }


                if(data.verified == '0' || data.verified == 0){

                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                    });

                    $(".delete_sender_btn").prepend('<button type="button" class="btn btn-warning btn-sm resend_sender_email2 resend_sender_email_btn">Resend verification email</button>');
                }
                
            }
        }); 
    });
    
    $(".field_validator").keyup(function(){
        
        var attr_value = $(this).val();

        if(attr_value != ""){
            $(this).closest('div').removeClass('error');
            $(this).addClass('field_success');
        }

    });

    $('#create_new_sender').on("click",function(){
        var sender_name     = $("#sender_name").val();
        var from_name       = $("#newsender_from_name").val();
        var from_email      = $("#newsender_from_email").val();
        var reply_email     = $("#newsender_reply_email").val();
        var address         = $("#newsender_address").val();
        var city            = $("#newsender_city").val();
        var state           = $("#newsender_state").val();
        var zipcode         = $("#newsender_zip_code").val();
        var country         = $("#newsender_country").val();
        var client_id       = $("#lead_client_id").val();
        
        if(sender_name !="" && from_name != "" && from_email != "" && reply_email != "" && address != "" && city != "" && state != "" && zipcode != "" && country != ""){
           
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/sendgrid_create_new_sender/",
                type: "POST",
                data: {client_id:client_id,sender_name:sender_name,from_name:from_name,from_email:from_email,reply_email:reply_email,address:address,city:city,state:state,zipcode:zipcode,country:country},
                success:function(response_data){
                    var data = JSON.parse(response_data); 
                    $('#sender_select').append('<option value="'+data.sender_id+'">'+data.nickname+'</option>');
                    $('#sender_select').val(data.sender_id);
                    $('#sender_select').trigger("change");
                    $("#Add_sender_modal").modal("hide");

                    /*$.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                    });*/

                }
            }); 

        }else{
              
            if(sender_name ==""){
                $("#sender_name").closest('div').addClass('error');
            }else{
                $("#sender_name").closest('div').removeClass('error');
                $("#sender_name").addClass('field_success');             
            }
        
            if(from_name == ""){
                $("#newsender_from_name").closest('div').addClass('error');
            }else{
                $("#newsender_from_name").closest('div').removeClass('error');
                $("#newsender_from_name").addClass('field_success');
            }

            if(from_email == ""){
                $("#newsender_from_email").closest('div').addClass('error');
            }else{
                $("#newsender_from_email").closest('div').removeClass('error');
                $("#newsender_from_email").removeClass('error_email');
                $("#newsender_from_email").addClass('field_success');
            }

            if(reply_email == ""){
                $("#newsender_reply_email").closest('div').addClass('error');
            }else{
                $("#newsender_reply_email").closest('div').removeClass('error');
                $("#newsender_reply_email").addClass('field_success');
            }

            if(address == ""){
                $("#newsender_address").closest('div').addClass('error');
            }else{
                $("#newsender_address").closest('div').removeClass('error');
                $("#newsender_address").addClass('field_success');
            }

            if( city == ""){
                $("#newsender_city").closest('div').addClass('error');
            }else{
                $("#newsender_city").closest('div').removeClass('error');
                $("#newsender_city").addClass('field_success');
            }

            if(state == ""){
                $("#newsender_state").closest('div').addClass('error');
            }else{
                $("#newsender_state").closest('div').removeClass('error');
                $("#newsender_state").addClass('field_success');
            }

            if(zipcode == ""){
                $("#newsender_zip_code").closest('div').addClass('error');
            }else{
                $("#newsender_zip_code").closest('div').removeClass('error');
                $("#newsender_zip_code").addClass('field_success');
            }

            if(country == ""){
                $("#newsender_country").closest('div').addClass('error');
            }else{
                $("#newsender_country").closest('div').removeClass('error');
                $("#newsender_country").addClass('field_success');
            }

        }
    });

    $("body").on("click","#create_new_group",function(){
        var client_id = $('#lead_client_id').val();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/check_unsub_counter/"+client_id,
            type: "POST",
            success:function(response_data){
                if(response_data == '2'){

                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "Unsubscribe groups limit exceeded.You can only create 2 custom unsubscribe groups",
                    });

                }else{
                    
                    if( group_name          == '' ){  $("#group_name").css("border-color","#ccc");  }
                    if( group_description   == '' ){  $("#group_description").css("border-color","#ccc"); }

                    $('#add_unsub_group').modal('show');
                }
            }
        });
        
    });

    $('.supression_groups_listings').on("click",function(){

        var sendgrid_id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#suppression_list_id').val(sendgrid_id);
        $('#unsubs_listing').html('<li><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'</li>');
    });

    $('#save_group').on("click",function(){
        var group_name = $('#group_name').val();
        
        var group_description = $('#group_description').val();
        

        if( group_name != '' && group_description != ''){

            $('#group_name').val('');
            $('#group_description').val('');

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_unsub_group_name",
                type: "POST",
                data : {group_name:group_name},
                success:function(response_data){
                    if(response_data == '0'){

                        $.ajax({
                            url : "<?php echo SURL?>sendgrid_campaigns/add_new_suppression_group",
                            type: "POST",
                            data : {group_name:group_name,group_description:group_description},
                            success:function(response_data){
                                get_suppression_group();
                                $('#add_unsub_group').modal('hide');
                                $.alert({
                                    title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                    content: "Unsubscribe group created successfully!",
                                });
                            }
                        }); 

                    }else{
                        
                        $.alert({
                                    title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                    content: "There is already a unsub group with this name. Please enter another name",
                        });
                    }
                }
            });

        }else{

            if( group_name          == '' ){  $("#group_name").css("border-color","red");  }
            if( group_description   == '' ){  $("#group_description").css("border-color","red"); }
        }
    });

    function get_suppression_group(){

        var client_id = $('#lead_client_id').val();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_sendgrid_supression_groups_listings/"+client_id,
            type: "POST",

            success:function(response_data) 
            {
                $('#group_lists').html(response_data);
                
                
            }
        });
    }

    function verify_sender(){

        var sender = $('#sender_select').val();
        if(sender != '' || sender != '0'){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                type: "POST",
                success:function(response_data) 
                {
                    if(response_data == '0'){
                        
                        $.alert({
                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                            content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                        });
                    }

                    $('#sender_Verified_bit').val(response_data);
                    
                }
            }); 

            return $('#sender_Verified_bit').val();
        }else{

            $.alert({
                title: '<img src="https://s3.us-east-2.amazonaws.com/callersiq.asset/img/logo-light.png">',
                content: "Please select sender from settings tab.",
            });
            return 0;
        }
            
    }

    $('body').on('click','.delete_unsub_group', function(){

        var id              = $(this).attr('data-id');
        var sendgrid_id     = $(this).attr('sendgrid-id');
        
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/delete_unsubcribe_group/",
            type: "POST",
            data: {id:id,sendgrid_id:sendgrid_id},
            success:function(response_data) 
            {
                $('#unsub_list_'+id).remove();
            }
        });
 
    });

    $('body').on('click','.resend_sender_email_btn', function(){
    
        var sender = $('#sender_select').val();
        if(sender != '' || sender != '0'){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/resend_sender_verification/"+sender,
                type: "POST",
                success:function(response_data) 
                {
                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "Sender verification email sent successfully. Please check your email for a verification link from Sendgrid",
                    });
                    
                }
            }); 

        }else{

            $.alert({
                title: '<?php echo IMG; ?>logo.png">',
                content: "Please select sender from settings tab.",
            });
        }

    });

    $('body').on('click','#add_sender_modal_btn', function(){

        $('#sender_name').val('');
        $('#newsender_from_name').val('');
        $('#newsender_from_email').val('');
        $('#newsender_reply_email').val('');
        $('#newsender_address').val('');
        $('#newsender_city').val('');
        $('#newsender_state').val('');
        $('#newsender_zip_code').val('');
        $('#newsender_country').val('');
        $('#Add_sender_modal').modal('show');

         $("#create_new_sender").css('display',"none");

        if($('#sender_name').hasClass('field_success') || $('#sender_name').closest('div').hasClass('error')){

            $('#sender_name').removeClass('field_success');
            $("#sender_name").closest('div').removeClass('error');

        }

        if($('#newsender_from_name').hasClass('field_success') || $('#newsender_from_name').closest('div').hasClass('error')){

            $('#newsender_from_name').removeClass('field_success');
            $("#newsender_from_name").closest('div').removeClass('error');
            
        }

        if($('#newsender_from_email').hasClass('field_success') || $('#newsender_from_email').closest('div').hasClass('error')){

            $('#newsender_from_email').removeClass('field_success');
            $("#newsender_from_email").closest('div').removeClass('error');
            $("#newsender_from_email").removeClass('error_email');
            $('#email_verfication_res').html('');
            
        }

        if($('#newsender_reply_email').hasClass('field_success') || $('#newsender_reply_email').closest('div').hasClass('error')){

            $('#newsender_reply_email').removeClass('field_success');
            $("#newsender_reply_email").closest('div').removeClass('error');
            
        }

        if($('#newsender_address').hasClass('field_success') || $('#newsender_address').closest('div').hasClass('error')){

            $('#newsender_address').removeClass('field_success');
            $("#newsender_address").closest('div').removeClass('error');
            
        }

        if($('#newsender_city').hasClass('field_success') || $('#newsender_city').closest('div').hasClass('error')){

            $('#newsender_city').removeClass('field_success');
            $("#newsender_city").closest('div').removeClass('error');
            
        }

        if($('#newsender_state').hasClass('field_success') || $('#newsender_state').closest('div').hasClass('error')){

            $('#newsender_state').removeClass('field_success');
            $("#newsender_state").closest('div').removeClass('error');
            
        }

        if($('#newsender_zip_code').hasClass('field_success') || $('#newsender_zip_code').closest('div').hasClass('error')){

            $('#newsender_zip_code').removeClass('field_success');
            $("#newsender_zip_code").closest('div').removeClass('error');
            
        }

        if($('#newsender_country').hasClass('field_success') || $('#newsender_country').closest('div').hasClass('error')){

            $('#newsender_country').removeClass('field_success');
            $("#newsender_country").closest('div').removeClass('error');
            
        }

        if($('#Add_sender_modal').hasClass('field_success') || $('#Add_sender_modal').closest('div').hasClass('error')){

            $('#Add_sender_modal').removeClass('field_success');
            $("#Add_sender_modal").closest('div').removeClass('error');
            
        }

    });

    $('body').on('click','#delete_sender_modal_btn', function(){

        var sender_id = $('#sender_select').val();

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/delete_sender",
            type: "POST",
            data : {sender_id:sender_id},
            success:function(response_data){

                $('#sender_select option[value="'+sender_id+'"]').remove();
                $('#sender_select').trigger("change");
            }
        });

    });

    $("body").on("blur","#newsender_from_email",function(e){

        var sender_email = $(this).val();
        var email_length= sender_email.length;
            
        if(email_length > 3){
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            
            
            if(pattern.test(sender_email)){
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/verfiy_sender_email_address",
                    type: "POST",
                    data : {sender_email:sender_email},
                    success:function(response_data){
                        
                        if(response_data == "yes"){
                            
                            $("#create_new_sender").css('display','none');
                            $("#email_verfication_res").html("<p>Email already exist please enter another email</p>");
                            $("#newsender_from_email").addClass('error_email');

                        }else{
                            $("#email_verfication_res").closest('div').removeClass('error');
                            $("#newsender_from_email").removeClass('error_email');
                            $("#create_new_sender").css('display','inline-block');
                            $("#email_verfication_res").html('');
                            $("#newsender_from_email").addClass('field_success');
                        }
                    }
                });

            }else{
                $("#create_new_sender").css('display','none');
                $("#email_verfication_res").html("<p>Please enter a valid email address</p>");
                $("#newsender_from_email").addClass('error_email');
            }
        }else{

            $("#newsender_from_email").closest('div').addClass('error');

        }

    });

    $("body").on("blur","#sender_name",function(e){

        var sender_name = $(this).val();
        var sender_name_length = sender_name.length;
            
        if(sender_name_length > 0){

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/verfiy_sender_name",
                type: "POST",
                data : {sender_name:sender_name},
                success:function(response_data){
                    
                    if(response_data == "yes"){
                        
                        $("#sender_name_verfication_res").html("<p>Name already exist please enter unique name</p>");
                        $("#sender_name").addClass('error_email');

                    }else{
                        $("#sender_name_verfication_res").closest('div').removeClass('error');
                        $("#sender_name").removeClass('error_email');
                        $("#sender_name_verfication_res").html('');
                        $("#sender_name").addClass('field_success');
                    }
                }
            });

        }else{

            $("#sender_name").closest('div').addClass('error');

        }

    });

    $("body").on("click",".save_draft_btn",function(){

        var client_id   = $("#lead_client_id").val();
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            
            var redirect        = 'settings_ancher';
            var tab_id          = 'ct_Settings';

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }

            var email_contents = $('#template_builder').val()
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    setTimeout(function(){
                   
                        location.href = "<?php echo SURL;?>sendgrid_campaigns";

                    }, 5000);

                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            var redirect        = 'recipients_ancher';
            var tab_id          = 'ct_Recipients';

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    setTimeout(function(){
                   
                        location.href = "<?php echo SURL;?>sendgrid_campaigns";

                    }, 5000);
                    
                }
            });

            verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            var redirect        = 'review_ancher';
            var tab_id          = 'ct_Review';

            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();
            var email_contents = $('#template_builder').val()
            
            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                                                setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                        }
                    }
                }); 
            
            }

            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            var redirect        = 'schedule_ancher';
            var tab_id          = 'ct_SendOrSchedule';

            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();
            var email_contents = $('#template_builder').val()

            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                            
                            // if(schedule !=''){
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    
                                            setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                            // }
                        }
                    }
                }); 
            
            }
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();
            var email_contents = $('#template_builder').val()

            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                            
                            // if(schedule !=''){
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    
                                            setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                            // }
                        }
                    }
                }); 
            
            }

        }

        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }

    });

	function set_table_box_width(){
    
        var i = 0;
        $(".tbh_item").each(function(index, element){

            if($(this).hasClass("tbs-xs")){
                i = i+70; 
            } 
            if($(this).hasClass("tbs-sm")){
                i = i+140; 
            }
            if($(this).hasClass("tbs-md")){
                i = i+210; 
            }
            if($(this).hasClass("tbs-lg")){
                i = i+280; 
            }
            if($(this).hasClass("tbs-xlg")){
                i = i+350; 
            }      
        });

        var width_of_tablebox = i;
        $(".table_box_header_iner").width(width_of_tablebox);
        $(".table_box_body_iner").width(width_of_tablebox);
       
        if(width_of_tablebox > $(window).width()){
            $(".table_box_header").width(width_of_tablebox);
            $(".table_box_body").width(width_of_tablebox);
        }else{
            $(".table_box_header").css("width","100%");
            $(".table_box_body").css("width","100%");
        }
    }

    $(window).resize(function(){
        set_table_box_width();
    });

    function conrezise(){

		var windowwidth = $(window).width();
		$(".colapsbody").width(windowwidth);

		$(".table_box_iner").scroll(function(){

		  	var ss =  $(this).scrollLeft();
		  	var rto = windowwidth+ss;
		  	var getwid = $(".table_box_body_iner").width()-windowwidth;

		  	if(ss < getwid){
				$(".colapsbody").css("margin-left",ss+"px");
		  	}

		});
	}
		
	$(document).ready(function(e) {

		if($(window).width() < 992){
		   	conrezise(); 
		}
	  	
	  	$(window).resize(function(){
	   		conrezise();
	  	});

	});

</script>
<?php }

if (in_array('EDIT_EMAIL_AMPAIGN', $PAGES_ALLOWED)) {?>

<!-- Jquery Confirm -->
<script src="https://callersiq.com/assets/js_front/jquery-confirm.min.js"></script>

<script>

    
    var csv_data = <?php echo "'".json_encode($campaign_data['campaign_lists'])."'";?>;
    if(csv_data == 'null'){  csv_array = new Array(); }
    else{ csv_array = JSON.parse(csv_data); }

    $.each(csv_array, function(index,value){
        if(value != ""){

            var contact_id = value;
        
            $('#csv_in'+value).addClass('active');
            $('#csv_in'+value).addClass('inc-ex_disabled');  
            
            var name = $('#csv_span_'+contact_id).html();
            var no_of_leads = $('#csvno_span_'+contact_id).html();

            var html ='<li id="sendto_list_csv'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
            
            $('#sendto_list').append(html);
            $('#review_sendto').append(html);
            

            var t_resp = parseInt($('#t_resp').html()) + parseInt(no_of_leads);
            $('#t_resp').html(t_resp);
            $('#review_t_resp').html(t_resp); 
            
        }
    });


    var dont_csv_data = <?php echo "'".json_encode($campaign_data['campaign_exclude_lists'])."'";?>;
    if(dont_csv_data == 'null'){  dont_csv_array = new Array(); }
    else{ dont_csv_array = JSON.parse(dont_csv_data); }

    $.each(dont_csv_array, function(index,value){
        if(value != ""){

            var contact_id = value;
        
            $('#csv_ex'+value).addClass('active');
            $('#csv_ex'+value).addClass('inc-ex_disabled');  
            
            var name = $('#csv_span_'+contact_id).html();

            var html ='<li id="dont_send_list_csv_'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="d_remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
            
            $('#dont_send_list').append(html);
            $('#review_dont_sendto').append(html);

        }
    });
    var editor_type = "";


    $(document).ready(function(e) {

        $('#sender_select').trigger("change");
        $('#temp_name_div').show();

        $(function () {
            $('#datetimepicker1').datetimepicker();
        });

        resizeChosen();
        jQuery(window).on('resize', resizeChosen);
        
        $(document).on("click", ".creat_list_pagi li a", function(e){
            
            e.preventDefault();
            var page = $(this).data("ci-pagination-page");
            $('#pageno').val(page);
            var where_clause = $('#where_clause').val();

            var page = $('#pageno').val();
           
            // $(".sd-loader").show();
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/"+page,
                type: "POST",
                data : {where_clause:where_clause},
                success:function(response) 
                { 
                    res = response.split("*||*");
                    $('.table_box_body').html(res[1]);
                    $('#page_links').html(res[3]);

                    // $(".sd-loader").hide();
                    set_table_box_width();

                    var total_contacts = $("#result_total_contacts").val();

                    if(total_contacts != 0){

                        $(".lead_checkbox").prop('checked', true);
                        $('.check_all').prop('checked', true);
                        $('#table_default_header').hide();
                        $('#bulk_changes_div').show();
                        $("#is_bulk_total").val('1'); 
                        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                    }else{

                        $(".lead_checkbox").prop('checked', false);
                        $('.check_all').prop('checked', false);

                        $('#bulk_changes_div').hide();
                        $('#table_default_header').show();
                        $("#is_bulk_total").val('0');
                        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                    } 
                    $('#listing_modal').modal('show');
                }
            });
        }); 

    });
</script>

<script type="text/javascript">

    $("body").on("click",".save_campaign_btn",function(){

        var client_id = $("#lead_client_id").val();
        var redirect = $(this).attr('id');
        var tab_id  = $(this).attr('tab-id');

        // verifying data
        if(redirect=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        

                    }
                });

            }
        }
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }


            var email_contents = $('#template_builder').val()
            
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    
                    $('#campaign_id').val(response_data);
                    $('#design_ancher').removeClass('active');
                    $('#ct_Design').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#recipients_ancher').removeClass('tab_disabled');

                    $("#review_subject").html($("#email_subject").val());
                    $("#review_pretext").html($("#preview_text").val());
                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#settings_ancher').removeClass('active');
                    $('#ct_Settings').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#review_ancher').removeClass('tab_disabled');

                    //setting saved data in review tab fields
                    $("#review_from").html($("#from_email").val());
                    


                    
                }
            });

            // verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();
            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
   
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            if(email_contents ==''){}
            if(campaign_name ==''){}
            if(email_subject ==''){}
            if(preview_text ==''){}
            if(sender_id ==''){}
            if(csv_array ==''){}


            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }

    });

    $("body").on("click",".save_campaign_next_btn",function(){

        var client_id   = $("#lead_client_id").val();
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            
            var redirect        = 'settings_ancher';
            var tab_id          = 'ct_Settings';

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }

                var email_contents = $('#template_builder').val()
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    
                    $('#campaign_id').val(response_data);
                    $('#design_ancher').removeClass('active');
                    $('#ct_Design').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#recipients_ancher').removeClass('tab_disabled');

                    $("#review_subject").html($("#email_subject").val());
                    $("#review_pretext").html($("#preview_text").val());
                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            var redirect        = 'recipients_ancher';
            var tab_id          = 'ct_Recipients';

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#settings_ancher').removeClass('active');
                    $('#ct_Settings').removeClass('in active');
                    $('#'+redirect).addClass('active');
                    $('#'+tab_id).addClass('in active');
                    $('#'+redirect+' a').removeClass('tab_disabled');

                    $('#review_ancher').removeClass('tab_disabled');

                    //setting saved data in review tab fields
                    $("#review_from").html($("#from_email").val());
                    


                    
                }
            });

            verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            var redirect        = 'review_ancher';
            var tab_id          = 'ct_Review';

            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();
            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            var redirect        = 'schedule_ancher';
            var tab_id          = 'ct_SendOrSchedule';

            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');
            
        }

        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }    

    });
    

     $("body").on("click",".save_draft_btn",function(){

        var client_id   = $("#lead_client_id").val();
        
        if($("li.active").attr('id')=='design_ancher'){
            
            var campaign_id     = $('#campaign_id').val();
            var campaign_name   = $('#campaign_name').val();
            var email_subject   = $('#email_subject').val();
            var preview_text    = $('#preview_text').val();
            
            var redirect        = 'settings_ancher';
            var tab_id          = 'ct_Settings';

            if(campaign_name ==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }

            if(email_subject ==''){
                $('#email_subject').addClass('error');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(preview_text ==''){
                $('#preview_text').addClass('error');
            }else{
                $('#preview_text').removeClass('error');
            }

                var email_contents = $('#template_builder').val()
            var email_contents_html = email_contents;

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/save_email_campaign_process",
                type: "POST",
                data : {client_id:client_id,campaign_id:campaign_id,campaign_name:campaign_name,email_contents:email_contents,email_contents_html:email_contents_html,editor_type:editor_type,email_subject:email_subject,preview_text:preview_text},
                success:function(response_data) 
                {
                    $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    setTimeout(function(){
                   
                        location.href = "<?php echo SURL;?>sendgrid_campaigns";

                    }, 5000);

                }
            });
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            var campaign_id = $('#campaign_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name = $('#from_name').val();
            var from_email = $('#from_email').val();
            var reply_email = $('#reply_email').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var zipcode = $('#zip_code').val();
            var country = $('#country').val();
            var sender_id = $('#sender_select').val();

            var redirect        = 'recipients_ancher';
            var tab_id          = 'ct_Recipients';

            if(sender_id==''){
                $('#sender_select').addClass('error');
            }else{
                $('#sender_select').removeClass('error');
            }

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
            }else{
                $('#from_email').removeClass('error');
            }

                
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/update_email_campaign_settings",
                type: "POST",
                data : {campaign_id:campaign_id,campaign_name:campaign_name,from_name:from_name,from_email:from_email,address:address,city:city,state:state,zipcode:zipcode,country:country,reply_email:reply_email,sender_id:sender_id},     
                success:function(response_data) 
                {   

                    $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    setTimeout(function(){
                   
                        location.href = "<?php echo SURL;?>sendgrid_campaigns";

                    }, 5000);
                    
                }
            });

            verify_sender();
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            var redirect        = 'review_ancher';
            var tab_id          = 'ct_Review';

            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            $('#schedule_ancher').removeClass('tab_disabled');

            //setting saved data in review tab fields
            $("#review_t_resp").html($("#t_resp").html());
            $("#review_sendto").html($("#sendto_list").html());
            $("#review_dont_sendto").html($("#dont_send_list").html());
            $(".no-recipients-error").hide();

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();

                var email_contents = $('#template_builder').val()

            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                                                setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                        }
                    }
                }); 
            
            }

            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            var redirect        = 'schedule_ancher';
            var tab_id          = 'ct_SendOrSchedule';

            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();
                var email_contents = $('#template_builder').val()
            

            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                            
                            // if(schedule !=''){
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    
                                            setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                            // }
                        }
                    }
                }); 
            
            }
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#'+redirect).addClass('active');
            $('#'+tab_id).addClass('in active');
            $('#'+redirect+' a').removeClass('tab_disabled');

            //Save as Draft
            var client_id     = $('#lead_client_id').val();
            var sender        = $('#sender_select').val();
            var unsub_group   = $('#suppression_list_id').val();
            var campaign_name = $('#campaign_name').val();
            var from_name     = $('#from_name').val();
            var from_email    = $('#from_email').val();
            var email_subject = $('#email_subject').val();
            var preview_text  = $('#preview_text').val();
                var email_contents = $('#template_builder').val()
            

            var email_contents_html = email_contents;

            if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
                
                var check_sender = verify_sender(); 
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            var schedule = $('#email_schedule').val();
                            
                            // if(schedule !=''){
                                
                                var campaign_id      = $('#campaign_id').val();
                                var total_recipients = $('#t_resp').text();
                                check_sender         = $('#sender_Verified_bit').val();

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_draft",
                                    type: "POST",
                                    data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                    success:function(response_data) 
                                    { 
                                        check_sender = $('#sender_Verified_bit').val();
                                        if( check_sender !== 0 && check_sender !== '0' ){

                                            $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has been successfully saved as a draft</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                    
                                            setTimeout(function(){
                                           
                                                location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                            }, 5000);

                                        }
                                    }
                                }); 
                            // }
                        }
                    }
                }); 
            
            }

        }

        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }

    });

    
    $("body").on("click",".save_campaign_back_btn",function(){

        if($("li.active").attr('id')=='design_ancher'){
            
            
        
        }else if($("li.active").attr('id') =='settings_ancher'){
            
            $('#settings_ancher').removeClass('active');
            $('#ct_Settings').removeClass('in active');
            $('#design_ancher').addClass('active');
            $('#ct_Design').addClass('in active');
            
        }else if($("li.active").attr('id')=='recipients_ancher'){
            
            $('#recipients_ancher').removeClass('active');
            $('#ct_Recipients').removeClass('in active');
            $('#settings_ancher').addClass('active');
            $('#ct_Settings').addClass('in active');
            
        }else if($("li.active").attr('id')=='review_ancher'){
            
            $('#review_ancher').removeClass('active');
            $('#ct_Review').removeClass('in active');
            $('#recipients_ancher').addClass('active');
            $('#ct_Recipients').addClass('in active');
            
        }else if($("li.active").attr('id')=='schedule_ancher'){
            
            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#review_ancher').addClass('active');
            $('#ct_Recipients').addClass('in active');
            
        }

        
        // verifying data
        if($("li.active").attr('id')=='review_ancher'){

            if( $("#sender_select").val() == ''){

                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
            }else{

                
                var sender = $('#sender_select').val();
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                    type: "POST",
                    success:function(response_data) 
                    {
                        if(response_data == '0'){

                            $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                            
                            $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                        }else{

                            $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                            $('#resend_sender_email').html('');
                        }

                        if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                        else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                    }
                });

            }
        }

    });

    $("body").on("click","#schedule_campaign",function(){
            
        var client_id           = $('#lead_client_id').val();
        var sender              = $('#sender_select').val();
        var unsub_group         = $('#suppression_list_id').val();

        var campaign_name = $('#campaign_name').val();
        var from_name = $('#from_name').val();
        var from_email = $('#from_email').val();
        var email_subject = $('#email_subject').val();
        var preview_text = $('#preview_text').val();
            var email_contents = $('#template_builder').val()
        
        var email_contents_html = email_contents;

        if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
            
            var check_sender = verify_sender(); 
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                type: "POST",
                data : {client_id:client_id},
                success:function(response_data){ 

                    if(response_data == '1'){

                        var schedule = $('#email_schedule').val();
                        if(schedule !=''){
                            
                            var campaign_id = $('#campaign_id').val();
                            var total_recipients = $('#t_resp').text();
                            check_sender = $('#sender_Verified_bit').val();
                            $.ajax({
                                url : "<?php echo SURL?>sendgrid_campaigns/add_email_campaign_schedule",
                                type: "POST",
                                data : {campaign_id:campaign_id,csv_array:csv_array, schedule:schedule, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,dont_csv_array:dont_csv_array},
                                success:function(response_data) 
                                { 
                                    check_sender = $('#sender_Verified_bit').val();
                                    if( check_sender !== 0 && check_sender !== '0' ){

                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has successfully been scheduled. If you scheduled a large list it may take some time to send the emails.</b> </br> You will be redirected to campaign listing page within 5 seconds....</div></div>');
                                        setTimeout(function(){
                                       
                                            location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                        }, 5000);

                                    }else{

                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-warning" role="alert"> <b>You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid.This campaign will be saved as a draft. Kindly verify your email address and schedule again...</b></div></div>');



                                    }

                                    
                                }
                            }); 
                        }

                    }else{

                        $.confirm({
                            title: 'Alert',
                            content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                            icon: 'fa fa-warning',
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            opacity: 0.5,
                            buttons: {
                                confirm: {
                                    text: 'Ok, sure!',
                                    btnClass: 'btn-red',
                                    action: function (){ },
                                    cancel: function (){ }
                                }
                            }
                            
                        });

                    }
                }
            }); 
        
        }else{

            $.alert({
                title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                content: 'Please complete the missing information before scheduling this campaign.',
            });

            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#review_ancher').addClass('active');
            $('#ct_Review').addClass('in active');

            // verifying data
            if($("li.active").attr('id')=='review_ancher'){

                if( $("#sender_select").val() == ''){

                    $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                }else{

                    
                    var sender = $('#sender_select').val();
                    
                    $.ajax({
                        url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                        type: "POST",
                        success:function(response_data) 
                        {
                            if(response_data == '0'){

                                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                                
                                $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                            }else{

                                $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                                $('#resend_sender_email').html('');
                            }

                            if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                            if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                            if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        }
                    });

                }

            }
        }
                
    });
    
    $("body").on("click","#send_test_email_design_tab",function(){

        var check_sender = verify_sender();

        if( check_sender !== 0 && check_sender !== '0' ){

            var campaign_id         = $('#campaign_id').val();
            var campaign_name       = $('#campaign_name').val();
            var from_name           = $('#from_name').val();
            var from_email          = $('#from_email').val();
            var email_subject       = $('#email_subject').val();
            var preview_text        = $('#preview_text').val();
            var test_email_address  = $('#send_test_email_design').val();

            if(campaign_name==''){
                $('#campaign_name').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Campaign Name Empty.</b></div>');
            }else{
                $('#campaign_name').removeClass('error');
            }
            if(from_name==''){
                $('#from_name').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>From Name Empty.</b></div>');
            }else{
                $('#from_name').removeClass('error');
            }
            if(from_email==''){
                $('#from_email').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>From Email Empty.</b></div>');
            }else{
                $('#from_email').removeClass('error');
            }
            if(email_subject==''){
                $('#email_subject').addClass('error');
                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Email Subject Empty.</b></div>');
            }else{
                $('#email_subject').removeClass('error');
            }

            if(test_email_address==''){

                $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-danger" role="alert"> <b>Send Email Empty.</b></div>');
            }
                var email_contents = $('#template_builder').val()
            

            var client_id = $('#lead_client_id').val();
            
            if(campaign_name !='' && from_name !='' && from_email !='' && email_subject !='' && test_email_address !=''){
                $('#response_message').html('');
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                    type: "POST",
                    data : {client_id:client_id},
                    success:function(response_data){ 

                        if(response_data == '1'){

                            if(test_email_address !=''){
                                var campaign_id = $('#campaign_id').val();

                                $('#send_test_email_design_tab').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');

                                $.ajax({
                                    url : "<?php echo SURL?>sendgrid_campaigns/send_email_test",
                                    type: "POST",
                                    data : {test_email_address:test_email_address,client_id:client_id,email_subject:email_subject,from_name:from_name,from_email:from_email,preview_text:preview_text,email_contents:email_contents},
                                    success:function(response_data) 
                                    {   
                                        $.alert({
                                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                            content: 'Test email sent successfully!',
                                        });
                                        $('#send_test_email_design_tab').html('Send Email');
                                        $('#send_test_email_design').val('');
                                        
                                    }
                                });
                            }

                        }else{

                            $.confirm({
                                title: 'Alert',
                                content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                                icon: 'fa fa-warning',
                                animation: 'zoom',
                                closeAnimation: 'zoom',
                                opacity: 0.5,
                                buttons: {
                                    confirm: {
                                        text: 'Ok, sure!',
                                        btnClass: 'btn-red',
                                        action: function (){ },
                                        cancel: function (){ }
                                    }
                                }
                            });
                        }
                    }
                });

            }   
        }    

    });

    $("body").on("click","#send_test_email",function(){

        var check_sender = verify_sender(); 
        if( check_sender !== 0 && check_sender !== '0' ){

            var client_id = $('#lead_client_id').val();
            
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                type: "POST",
                data : {client_id:client_id},
                success:function(response_data){ 

                    if(response_data == '1'){

                        var test_email_address = $('#test_email_address').val();
                        if(test_email_address !=''){

                            var campaign_id = $('#campaign_id').val();

                            $('#send_test_email').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');

                            $.ajax({
                                url : "<?php echo SURL?>sendgrid_campaigns/send_test_email",
                                type: "POST",
                                data : {test_email_address:test_email_address,campaign_id:campaign_id},
                                success:function(response_data) 
                                {   

                                    $.alert({
                                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                        content: 'Test email sent successfully!',
                                    });
                                    $('#send_test_email').html('Send Email');
                                    $('#test_email_address').val('');
                                }
                            });
                        }

                    }else{

                        $.confirm({
                            title: 'Alert',
                            content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                            icon: 'fa fa-warning',
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            opacity: 0.5,
                            buttons: {
                                confirm: {
                                    text: 'Ok, sure!',
                                    btnClass: 'btn-red',
                                    action: function (){ },
                                    cancel: function (){ }
                                }
                            }
                        });
                    }
                }
            });  
        }     

    });
    
    $("body").on("click",".edit_recipients",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#recipients_ancher').addClass('active');
        $('#ct_Recipients').addClass('in active');
          
    });

    
    $("body").on("click",".edit_settings",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#settings_ancher').addClass('active');
        $('#ct_Settings').addClass('in active');
          
    });

    $("body").on("click",".edit_design",function(){

        $('#review_ancher').removeClass('active');
        $('#ct_Review').removeClass('in active');
        $('#design_ancher').addClass('active');
        $('#ct_Design').addClass('in active');
          
    });

     
    $("body").on("click","#sendnow_btn",function(){

        var client_id           = $('#lead_client_id').val();
        var total_recipients    = $('#t_resp').text();
        var sender              = $('#sender_select').val();
        var unsub_group         = $('#suppression_list_id').val();

        
        var campaign_name = $('#campaign_name').val();
        var from_name = $('#from_name').val();
        var from_email = $('#from_email').val();
        var email_subject = $('#email_subject').val();
        var preview_text = $('#preview_text').val();

            var email_contents = $('#template_builder').val()
        var email_contents_html = email_contents;

        if(email_contents_html !='' && campaign_name !=''  && email_subject !=''  && preview_text !='' && csv_array !='' ){
            
            $.ajax({

                url : "<?php echo SURL?>sendgrid_campaigns/get_client_record",
                type: "POST",
                data : {client_id:client_id},
                success:function(response_data){ 

                    if(response_data == '1'){ 

                        var campaign_id = $('#campaign_id').val();
                        if(campaign_id !=''){
                            var check_sender = verify_sender();
                            $(".loader-image3").show();
                            $.ajax({
                                url : "<?php echo SURL?>sendgrid_campaigns/sendnow_email_campaign",
                                type: "POST",
                                data : {campaign_id:campaign_id,csv_array:csv_array, total_recipients:total_recipients,check_sender:check_sender,sender:sender,unsub_group:unsub_group,schedule:'now'},
                                success:function(response_data) 
                                {   
                                    $(".loader-image3").hide();
                                    check_sender = $('#sender_Verified_bit').val();
                                    if( check_sender !== 0 && check_sender !== '0' ){

                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-success" role="alert"> <b>Your campaign has successfully been scheduled. If you scheduled a large list it may take some time to send the emails.</b> </br> You will be redirectly to campaign listing page within 5 seconds....</div></div>');

                                        setTimeout(function(){
                                           
                                            location.href = "<?php echo SURL;?>sendgrid_campaigns";

                                        }, 5000);

                                    }else{
                                        
                                        $('#response_message').html('<div class="row" style="margin-top: 50px;"><div class="alert alert-warning" role="alert"> <b>You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid.This campaign will be saved as a draft. Kindly verify your email address and schedule again...</b></div></div>');
                                    }
                                }
                            });
                        }
                                  

                    }else{

                        $.confirm({
                            title: 'Alert',
                            content: 'Before sending an email campaign you must update your Company Name and Address fields. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?php echo SURL;?>leads/settings" target="_blank">Go to Settings</a> This information will be added to the footer of the email template as required by ICANN guidelines.',
                            icon: 'fa fa-warning',
                            animation: 'zoom',
                            closeAnimation: 'zoom',
                            opacity: 0.5,
                            buttons: {
                                confirm: {
                                    text: 'Ok, sure!',
                                    btnClass: 'btn-red',
                                    action: function (){ },
                                    cancel: function (){ }
                                }
                            }
                        });

                    }
                }

            });
        }else{

            $.alert({
                title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                content: 'Please complete the missing information before scheduling this campaign.',
            });

            $('#schedule_ancher').removeClass('active');
            $('#ct_SendOrSchedule').removeClass('in active');
            $('#review_ancher').addClass('active');
            $('#ct_Review').addClass('in active');
            // verifying data
            if($("li.active").attr('id')=='review_ancher'){

                if( $("#sender_select").val() == ''){

                    $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                }else{

                    
                    var sender = $('#sender_select').val();
                    
                    $.ajax({
                        url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                        type: "POST",
                        success:function(response_data) 
                        {
                            if(response_data == '0'){

                                $('#review_from_icon').html('<button class="unverify-icon" >X</button>');
                                
                                $('#resend_sender_email').html('<button class="btn btn-success resend_sender_email_btn" style="min-width: 100px;padding: 10px 25px;" >Resend verification email </button>');

                            }else{

                                $('#review_from_icon').html('<img src="<?php echo IMG;?>success.png">');
                                $('#resend_sender_email').html('');
                            }

                            if( $("#email_subject").val() == '' ){ $('#review_subject_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_subject_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                            if( $("#preview_text").val() == '' ){ $('#review_pretext_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_pretext_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                            if( $("#review_t_resp").html() == '0' ){ $('#review_t_resp_icon').html('<button class="unverify-icon" >X</button>'); }
                            else{ $('#review_t_resp_icon').html('<img src="<?php echo IMG;?>success.png">'); }

                        }
                    });

                }
            }
        } 
    
    });


    $("body").on("click",".Include_csv",function(){

        var contact_id = $(this).attr('val');
        
        $(this).addClass('active');
        $(this).addClass('inc-ex_disabled');
        
        $('#csv_ex'+contact_id).removeClass('active');
        $('#csv_ex'+contact_id).removeClass('inc-ex_disabled');
        
        var name = $('#csv_span_'+contact_id).html();
        var no_of_leads = $('#csvno_span_'+contact_id).html();

        var html ='<li id="sendto_list_csv'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
        
        $('#sendto_list').append(html);
        $( "#dont_send_list_csv_"+contact_id ).remove();
        csv_array.push(contact_id);

        var t_resp = parseInt($('#t_resp').html()) + parseInt(no_of_leads);
        $('#t_resp').html(t_resp);

        dont_csv_array = $.grep(dont_csv_array, function(value){
            return value != contact_id;
        });

        
        
    });

    $("body").on("click",".Exclude_csv",function(){

        var contact_id = $(this).attr('val');

        $(this).addClass('active');
        $(this).addClass('inc-ex_disabled');
        
        $('#csv_in'+contact_id).removeClass('active');
        $('#csv_in'+contact_id).removeClass('inc-ex_disabled');
        
        var name = $('#csv_span_'+contact_id).html();
        var no_of_leads = $('#csvno_span_'+contact_id).html();
        var html ='<li id="dont_send_list_csv_'+contact_id+'"><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'<span class="d_remove_csv sg-right-cion" val="'+contact_id+'" class="sg-right-cion"><i class="fa fa-times" aria-hidden="true"></i></span></li>';
        
        $('#dont_send_list').append(html);
        $( "#sendto_list_csv"+contact_id).remove();

        for(var i=0; i<csv_array.length; i++){

            if(csv_array[i] == contact_id){

                var t_resp = parseInt($('#t_resp').html()) - parseInt(no_of_leads);
                $('#t_resp').html(t_resp);
            }
        };

        csv_array = $.grep(csv_array, function(value){
            return value != contact_id;
        });

        dont_csv_array.push(contact_id);
       
    });

    $("body").on("click",".remove_csv",function(){

        var contact_id = $(this).attr('val');
        var no_of_leads = $('#csvno_span_'+contact_id).html();

        $( "#sendto_list_csv"+contact_id ).remove();
        $('#csv_in'+contact_id).removeClass('active');
        $('#csv_in'+contact_id).removeClass('inc-ex_disabled');

        //removing contact from array
        csv_array = $.grep(csv_array, function(value){
            return value != contact_id;
        });

        $('#t_resp').html(parseInt($('#t_resp').html()) - parseInt(no_of_leads));
        $("#review_t_resp").html($("#t_resp").html());
        $("#review_sendto").html($("#sendto_list").html());
           
    });

    $("body").on("click",".d_remove_csv",function(){

        var contact_id = $(this).attr('val');
        $( "#dont_send_list_csv_"+contact_id ).remove();
        $('#csv_ex'+contact_id).removeClass('active'); 
        $('#csv_ex'+contact_id).removeClass('inc-ex_disabled');
        $("#review_dont_sendto").html($("#dont_send_list").html()); 

        //removing contact from array
        dont_csv_array = $.grep(dont_csv_array, function(value){
            return value != contact_id;
        });

    });

    $("body").on("click","#csv_Search",function(){

        var client_id = $("#lead_client_id").val();
        var keyword = $("#csv_Search_input").val();
       
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/search_email_campaign_lists",
            type: "POST",
            data : {client_id:client_id,keyword:keyword},
            success:function(response_data) 
            {
                
                $('#csv_lists').html(response_data);

                //disabling already added csvs and leads
                for(var z=0; z<csv_array.length ;z++){

                    $('#csv_in'+csv_array[z]).addClass('active');
                    $('#csv_in'+csv_array[z]).addClass('inc-ex_disabled');   
                }

                //disabling already added csvs and leads
                for(var z=0; z<dont_csv_array.length ;z++){

                    $('#csv_ex'+dont_csv_array[z]).addClass('active');
                    $('#csv_ex'+dont_csv_array[z]).addClass('inc-ex_disabled');   
                }

                
            }
        });
        
    });

    
    $("body").on("keyup","#csv_Search_input",function(){

        var client_id = $("#lead_client_id").val();
        var keyword = $("#csv_Search_input").val();
       
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/search_email_campaign_lists",
            type: "POST",
            data : {client_id:client_id,keyword:keyword},
            success:function(response_data) 
            {
                
                $('#csv_lists').html(response_data);

                //disabling already added csvs and leads
                for(var z=0; z<csv_array.length ;z++){

                    $('#csv_in'+csv_array[z]).addClass('active');
                    $('#csv_in'+csv_array[z]).addClass('inc-ex_disabled');   
                }

                //disabling already added csvs and leads
                for(var z=0; z<dont_csv_array.length ;z++){

                    $('#csv_ex'+dont_csv_array[z]).addClass('active');
                    $('#csv_ex'+dont_csv_array[z]).addClass('inc-ex_disabled');   
                }

            }
        });
        
    });


    

    

    function set_table_box_width(){
    
        var i = 0;
        $(".tbh_item").each(function(index, element){

            if($(this).hasClass("tbs-xs")){
                i = i+70; 
            } 
            if($(this).hasClass("tbs-sm")){
                i = i+140; 
            }
            if($(this).hasClass("tbs-md")){
                i = i+210; 
            }
            if($(this).hasClass("tbs-lg")){
                i = i+280; 
            }
            if($(this).hasClass("tbs-xlg")){
                i = i+350; 
            }      
        });

        var width_of_tablebox = i;
        $(".table_box_header_iner").width(width_of_tablebox);
        $(".table_box_body_iner").width(width_of_tablebox);
       
        if(width_of_tablebox > $(window).width()){
            $(".table_box_header").width(width_of_tablebox);
            $(".table_box_body").width(width_of_tablebox);
        }else{
            $(".table_box_header").css("width","100%");
            $(".table_box_body").css("width","100%");
        }
    }


    $(window).resize(function(){
        set_table_box_width();
    });

    
    function resizeChosen(){

        $(".chosen-container").each(function() {
            $(this).attr('style', 'width: 100%');
        }); 
    }

    function delay(callback, ms){

        var timer = 0;
        return function(){

            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function (){
                callback.apply(context, args);
            }, ms || 0);
        };
    }



    $("body").on("click","#create_new_list",function(){

        var count_list = $(".total_list").val();

        if(count_list < 5){
        
            $('#create_new_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            $('#table_ajax_data').html('');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
                type: "POST",
                data : "",
                success:function(response) 
                {   
                    res = response.split("*||*");
                    $('#table_ajax_data').html(res[0]);

                    // get_inv_srch();
                    set_table_box_width();
                    
                    $('#create_new_list').html('Create New List');
                    $('#listing_modal').modal('show');

                    var total_contacts = $("#result_total_contacts").val(); 
                    if(total_contacts != 0){

                        $(".lead_checkbox").prop('checked', true);
                        $('.check_all').prop('checked', true);
                        $('#table_default_header').hide();
                        $('#bulk_changes_div').show();
                        $("#is_bulk_total").val('1'); 
                        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                    }else{
                        
                        $(".lead_checkbox").prop('checked', false);
                        $('.check_all').prop('checked', false);

                        $('#bulk_changes_div').hide();
                        $('#table_default_header').show();
                        $("#is_bulk_total").val('0');
                        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                    }


                }
            });

        }else{

            $.alert({
                title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                content: "Your list could not create a new list because you've reached your limit of 5 lists. To create a new list, you'll need to delete existing lists to make room.",
            });
        }
         
    });

    $("body").on("click",".listing-apply-filters-btn",function(){
       
        var res = $('#builder_inventory_champion').queryBuilder('getMongo');
        $('#result').removeClass('hide').find('pre').html(
            JSON.stringify(res, undefined, 2)
        );

        var html_data = JSON.stringify(res, undefined, 2);

        $('#where_clause').val(html_data);
        // $(".sd-loader").show();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
              
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_links').html(res[3]);
                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);
                $('#listing_modal').modal('show');
                set_table_box_width();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);

                    $('#bulk_changes_div').hide();
                    $('#table_default_header').show();
                    $("#is_bulk_total").val('0');
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });

    });

    $("body").on("click",".listing-reset-filters-btn",function(){
      
        // $(".sd-loader").show();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing/",
            type: "POST",
            data : "",
            success:function(response) 
            {  
              
                var res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
                $('#listing_modal').modal('show');
                set_table_box_width();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);

                    $('#bulk_changes_div').hide();
                    $('#table_default_header').show();
                    $("#is_bulk_total").val('0');
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });
    
    });


    $("body").on("click",".check_all",function(){

        var total_contacts=$('#result_total_contacts').val();
        // if(total_contacts > 0){
            if($(this).is(":checked")){

                $(".lead_checkbox").prop('checked', true);
                $('#response_total_counter').html($('input.lead_checkbox:checked').length);
                $('#table_default_header').hide();
                $('#bulk_changes_div').show();
                $(".check_all").prop('checked', true);
                $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');

            }else{

                $(".lead_checkbox").prop('checked', false);
                $('#response_total_counter').html($('input.lead_checkbox:checked').length);
                $('#table_default_header').show();
                $("#is_bulk_total").val('0');
                $('#bulk_changes_div').hide();
                $(".check_all").prop('checked', false);
            }
        // }

    });


    $("body").on("click",".lead_checkbox",function(){

        if($(this).is(":checked")){

            var total_contacts=$('#result_total_contacts').val();
            $('#response_total_counter').html($('input.lead_checkbox:checked').length);
            $('#bulk_changes_div').show();
            $('#table_default_header').hide();
            $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
            $("#is_bulk_total").val('0');

        }else{

            var total_contacts=$('#result_total_contacts').val();
            $(".check_all").prop('checked', false);
            $('#response_total_counter').html($('input.lead_checkbox:checked').length);
            $("#new_bulk_record_div").html('Total '+$('input.lead_checkbox:checked').length+' contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
            $("#is_bulk_total").val('0');

            if($('input.lead_checkbox:checked').length < 1){
                $('#table_default_header').show();
                $('#bulk_changes_div').hide(); 
            }
        }
        
    });


    $("body").on("click","#all_bulk_contacts",function(e){

        var total_contacts = $("#result_total_contacts").val(); 
        $("#is_bulk_total").val('1'); 
        $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
        $(".lead_checkbox").prop('checked', true);
        $('.check_all').prop('checked', true);
    
    });


    $("body").on("click","#clear_selection",function(e){

        var total_contacts=$('#result_total_contacts').val();
        $(".lead_checkbox").prop('checked', false);
        $('.check_all').prop('checked', false);

        $('#bulk_changes_div').hide();
        $('#table_default_header').show();
        $("#is_bulk_total").val('0');
        $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
        
    });


    $("body").on("click","#save_list",function(){
        
        var postData = $('#selection_form').serializeArray();
        var where_clause = $('#where_clause').val();
        var list_name = $('#list_name').val();
        var list_type = $('#list_type').val();
        var check = $("#is_bulk_total").val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'where_clause', value: where_clause});
        postData.push({name: 'list_name', value: list_name});
        postData.push({name: 'list_type', value: list_type});

        if(list_name !='' ){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_list_name/",
                type: "POST",
                data:{list_name:list_name},
                success:function(response_data) 
                {
                    if(response_data == '0' || response_data == 0 ){

                        $.ajax({ 
                            url : "<?php echo SURL?>sendgrid_campaigns/add_new_list/",
                            type: "POST",
                            data : postData,
                            success:function(response) 
                            {   
                                $('#csv_Search_input').trigger('keyup');
                                $('#listing_modal').modal('hide');

                                
                            }
                        });
                        

                    }else{

                        $.alert({
                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                            content: "There is already a list with this name. Please enter another name",
                        });
                        $('#list_name').css('border', 'solid 1px red');
                    }
                    
                }
            }); 
            

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });

    function update_contacts_records(data){

        var data_arr = JSON.parse(data)
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/update_list_contacts_records/"+data_arr.client_id+"/"+data_arr.sendgrid_list_id+"/"+data_arr.callersiq_list_id+"/"+data_arr.contacts_counter,
            type: "POST",
            success:function(response_data) 
            {   
                if(response_data == '0' || response_data == ''){
                    
                    setTimeout(function(){ 

                        update_contacts_records(response); 

                    }, 3000);
                    update_contacts_records(data);

                }else{
                    $('#csv_Search_input').trigger('keyup');
                    // $(".sd-loader").hide();
                    $('#listing_modal').modal('hide');
                }
            }
        });


    }


    
    $("body").on("click","#add_contact_list",function(){
        
        var postData = $('#selection_form').serializeArray();
        var where_clause = $('#eddit_where_clause').val();
        var check = $("#is_bulk_total").val();
        var list_id = $('#list_id').val();
        var client_id = $('#lead_client_id').val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'where_clause', value: where_clause});
        postData.push({name: 'list_id', value: list_id});
        postData.push({name: 'client_id', value: client_id});
        
        if(list_id !=''){

            $('#save_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/add_contact_list/",
                type: "POST",
                data : postData,
                success:function(response) 
                {  

                    $('#csv_Search_input').trigger('keyup');

                    $('#save_list').html('Save List');
                    $('#listing_modal').modal('hide');
                }
            });

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });    


    $("body").on("click","#delete_list_contact",function(){
        
        var postData = $('#selection_form').serializeArray();
        var list_id = $('#list_id').val();
        var check = $("#is_bulk_total").val();

        postData.push({name: 'check', value: check});
        postData.push({name: 'list_id', value: list_id});

        if(list_id !=''){

            $('#save_list').html('<img src="<?php echo IMG; ?>uploading.gif" width="20" height="20" style="margin-top: -2px;"/>');
            
            $.ajax({ 
                url : "<?php echo SURL?>sendgrid_campaigns/remove_list_contact/",
                type: "POST",
                data : postData,
                success:function(response) 
                {  

                    $('#csv_Search_input').trigger('keyup');

                    $('#save_list').html('Save List');
                    $('#listing_modal').modal('hide');
                }
            });

        }else{ 

            $('#list_name').css('border', 'solid 1px red');
        }
        
    });

   
    $("body").on("click",".delete_csv",function(){

        var id = $(this).attr('val');
        var total_list = $(".total_list").val();

        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/delete_contact_list",
            type: "POST",
            data : {id:id},
            success:function(response) 
            { 
                $('#csv_span_'+id).html();
                var no_of_leads = $('#csvno_span_'+id).html();

                //update list count
                total_list = parseInt(total_list) - 1;
                $(".total_list").val(total_list);
                    
                $( "#dont_send_list_csv_"+id).remove();
                $( "#sendto_list_csv"+id).remove();

                for(var i=0;i< csv_array.length;i++){

                    if(csv_array[i] == id){

                        var t_resp = parseInt($('#t_resp').html()) - parseInt(no_of_leads);
                        $('#t_resp').html(t_resp);
                    }
                };

                csv_array = $.grep(csv_array, function(value){
                    return value != id;
                });

                $('#csv_span_'+id).parent().remove();
            }
        });
    });

    
    function get_inv_srch(){
        
        var sql_import_export = "";
      
        $("h1").animate({
            "margin-left": "100px"
        }, "slow");
        
        /*$.ajax({
            url: "<?php echo SURL; ?>sendgrid_campaigns/get_all_search_fields",
            data: "",
            type:"post",
            dataType: "json",
            success: function(response){
                
                warkdand = [];
                var filter = [];

                $.each(response, function(index, itemData){

                    var test = {};
                    var oprts = [];

                    test.id = itemData.id;
                    test.label = itemData.label;
                    test.type = itemData.type;
                    
                    if(itemData.field){
                        test.field = itemData.field;
                    }
                    if(itemData.operators){
                        test.operators = itemData.operators;
                    }
                    if(itemData.multiple){
                        test.multiple = itemData.multiple;
                    }
                    if(itemData.plugin){
                        test.plugin = itemData.plugin;
                        test.plugin_config = itemData.plugin_config;
                    }
                    if(itemData.input){
                        test.input = itemData.input;
                        if(itemData.values){
                            test.values = itemData.values
                        }
                    }
                    warkdand.push(test);
                });
         
                $('#builder_inventory_champion').queryBuilder({
                    plugins: [
                        'chosen-selectpicker',
                    ],
                    operators: [
                        'equal', 'not_equal', 'is_null','not_contains','between','contains','begins_with','ends_with','in','not_in','is_not_empty','is_empty','greater_or_equal','less_or_equal'
                    ],
                    filters: warkdand
                });
            }
        });*/
        
    }


    $(document).ready(function(e) {
        $("body").on("click",".li_select_chs",function(){
            $(this).closest(".c_chosen").addClass("chos_li_selected");
        });
        $("body").on("click",".remove_slct_chsn",function(){
            var this_selected = $(this).closest(".c_chosen").find(".c_chosne_btn");
            if(this_selected.length < 2){
                $(this).closest(".c_chosen").removeClass("chos_li_selected");
            }
        });
    });


    $("body").on("click",".edit_list",function(){

        $(".loader-image3").show();
        var str = $(this).attr('id').split("_");
        var id = str[2];
        $('#list_id').val(id);

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/",
            type: "POST",
            data : {id:id},
            success:function(response) 
            {   

                res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
                set_table_box_width();
                $('#listing_modal').modal('show');
                // $(".loader-image3").hide();
                // get_inv_srch();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        }); 

    });


    $("body").on("click",".listing-eddit-reset-filters-btn",function(){
        
        $(".loader-image3").show();
        var id = $('#list_id').val();

        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/",
            type: "POST",
            data : {id:id},
            success:function(response) 
            {   
                res = response.split("*||*");
                $('#table_ajax_data').html(res[0]);
                set_table_box_width();
                $('#listing_modal').modal('show');
                // $(".loader-image3").hide();
                // get_inv_srch();

                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });
    
    });


    $("body").on("click", ".remove_list_pagi li a", function(e){

        e.preventDefault();
        var page = $(this).data("ci-pagination-page");
        $('#pageno_list').val(page);
        var id = $('#list_id').val();
        var page = $('#pageno_list').val();

        $(".loader-image5").show();
        $.ajax({ 
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_contacts_listing_record/"+page,
            type: "POST",
            data : {id:id},
            success:function(response) 
            { 
                res = response.split("*||*");
                $('.table_box_body').html(res[1]);
                $('#page_link_list').html(res[3]);
                set_table_box_width();
                $(".loader-image5").hide();

                var total_contacts = $("#result_total_contacts").val(); 
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                }
            }
        });
    
    });


    $("body").on("click", ".addmore_list_pagi li a", function(e){

        e.preventDefault();
        var page = $(this).data("ci-pagination-page");

        $('#pageno_eddit_list').val(page);
        var page = $('#pageno_eddit_list').val();

        var html_data = $('#eddit_where_clause').val();
        
        // $(".sd-loader").show();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_addmore_contacts_listing/"+page,
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_link_list').html(res[3]);

                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);
                
                $(".newclckhvr").html('<div class="tbh-data"><a href="javascript:void(0)" id="add_contact_list" class="btn btn-danger" id="save_menu">Add Contact to List</a></div>');
                // get_inv_srch();

                set_table_box_width();
                // $(".sd-loader").hide();
                var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });

    });

    $("body").on("click",".listing-eddit-apply-filters-btn",function(){
       
        var res = $('#builder_inventory_champion').queryBuilder('getMongo');
        $('#result').removeClass('hide').find('pre').html(
            JSON.stringify(res, undefined, 2)
        );

        var html_data = JSON.stringify(res, undefined, 2);
        $('#eddit_where_clause').val(html_data);
        // $(".sd-loader").show();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_addmore_contacts_listing/",
            type: "POST",
            data : {where_clause:html_data},
            success:function(response) 
            { 
                var res = response.split("*||*");
                $('.table_box_body').html(res[1]); 
                $('#page_link_list').html(res[3]);

                $('#response_total_contacts').html(res[4]);
                $('#result_total_contacts').val(res[4]);
                
                $(".newclckhvr").html('<div class="tbh-data"><a href="javascript:void(0)" id="add_contact_list" class="btn btn-danger" id="save_menu">Add Contact to List</a></div>');
                get_inv_srch();

                set_table_box_width();
                // $(".sd-loader").hide();
               	var total_contacts = $("#result_total_contacts").val();
                if(total_contacts != 0){

                    $('#table_default_header').hide();
                    $('#bulk_changes_div').show();
                    $("#is_bulk_total").val('1'); 
                    $(".lead_checkbox").prop('checked', true);
                    $('.check_all').prop('checked', true);
                    $("#new_bulk_record_div").html('Total '+total_contacts+' contact(s) are selected. <a href="javascript:avoid;" id="clear_selection">Clear selection.</a>');
                }else{
                    
                    $('#table_default_header').show();
                    $('#bulk_changes_div').hide();
                    $("#is_bulk_total").val('0');
                    $(".lead_checkbox").prop('checked', false);
                    $('.check_all').prop('checked', false);
                    $("#new_bulk_record_div").html('Total 0 contact(s) on this page are selected. <br> <a href="javascript:avoid;" id="all_bulk_contacts">Select all <span id="total_bulk_contacts">'+total_contacts+'</span> contacts.<a/>');
                } 
            }
        });

    }); 


    

    $('#sender_select').on("change",function(){
        
        var sender_id = $(this).val();

        $('#delete_sender_modal_btn').remove();
        $('.resend_sender_email_btn').remove();
    
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_sendgrid_sender_by_id/"+sender_id,
            type: "POST",
            success:function(response_data){
                var data = JSON.parse(response_data); 
                $('#from_name').val(data.from_name);
                $('#from_email').val(data.from_email);
                $('#reply_email').val(data.reply_to);
                $('#address').val(data.address);
                $('#city').val(data.city);
                $('#state').val(data.state);
                $('#zip_code').val(data.zipcode);
                $('#country').val(data.country);
                
                if(response_data != 0){

                    $(".delete_sender_btn").prepend('<button type="button" class="btn btn-danger btn-sm resend_sender_email2" id="delete_sender_modal_btn">Delete sender</button>');
                }

                
                
                if( data.verified == '0' || data.verified == 0){

                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                    });

                    $(".delete_sender_btn").prepend('<button type="button" class="btn btn-warning btn-sm resend_sender_email2 resend_sender_email_btn">Resend verification email</button>');
                }
                
            }
        }); 
    });

    $(".field_validator").keyup(function(){
        
        var attr_value = $(this).val();

        if(attr_value != ""){
            $(this).closest('div').removeClass('error');
            $(this).addClass('field_success');
        }


    });

    $('#create_new_sender').on("click",function(){
        
        var sender_name     = $("#sender_name").val();
        var from_name       = $("#newsender_from_name").val();
        var from_email      = $("#newsender_from_email").val();
        var reply_email     = $("#newsender_reply_email").val();
        var address         = $("#newsender_address").val();
        var city            = $("#newsender_city").val();
        var state           = $("#newsender_state").val();
        var zipcode         = $("#newsender_zip_code").val();
        var country         = $("#newsender_country").val();
        var client_id       = $("#lead_client_id").val();
        
        if(sender_name !="" && from_name != "" && from_email != "" && reply_email != "" && address != "" && city != "" && state != "" && zipcode != "" && country != ""){
         // alert('all fields are filled!');   
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/sendgrid_create_new_sender/",
                type: "POST",
                data: {client_id:client_id,sender_name:sender_name,from_name:from_name,from_email:from_email,reply_email:reply_email,address:address,city:city,state:state,zipcode:zipcode,country:country},
                success:function(response_data){
                    var data = JSON.parse(response_data); 
                    $('#sender_select').append('<option value="'+data.sender_id+'">'+data.nickname+'</option>');
                    $('#sender_select').val(data.sender_id);
                    $('#sender_select').trigger("change");
                    $("#Add_sender_modal").modal("hide");

                    // $.alert({
                    //     title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                    //     content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                    // });

                }
            }); 

        }else{
            //alert('fields are not filled!');  
            if(sender_name ==""){
                $("#sender_name").closest('div').addClass('error');
            }else{
                // $("#sender_name").keyup(function(){
                    $("#sender_name").closest('div').removeClass('error');
                    $("#sender_name").addClass('field_success');
                // });          
            }

            if(from_name == ""){
                $("#newsender_from_name").closest('div').addClass('error');
            }else{
                $("#newsender_from_name").closest('div').removeClass('error');
                $("#newsender_from_name").addClass('field_success');
            }

            if(from_email == ""){
                $("#newsender_from_email").closest('div').addClass('error');
            }else{
                $("#newsender_from_email").closest('div').removeClass('error');
                $("#newsender_from_email").removeClass('error_email');
                $("#newsender_from_email").addClass('field_success');
            }

            if(reply_email == ""){
                $("#newsender_reply_email").closest('div').addClass('error');
            }else{
                $("#newsender_reply_email").closest('div').removeClass('error');
                $("#newsender_reply_email").addClass('field_success');
            }

            if(address == ""){
                $("#newsender_address").closest('div').addClass('error');
            }else{
                $("#newsender_address").closest('div').removeClass('error');
                $("#newsender_address").addClass('field_success');
            }

            if( city == ""){
                $("#newsender_city").closest('div').addClass('error');
            }else{
                $("#newsender_city").closest('div').removeClass('error');
                $("#newsender_city").addClass('field_success');
            }

            if(state == ""){
                $("#newsender_state").closest('div').addClass('error');
            }else{
                $("#newsender_state").closest('div').removeClass('error');
                $("#newsender_state").addClass('field_success');
            }

            if(zipcode == ""){
                $("#newsender_zip_code").closest('div').addClass('error');
            }else{
                $("#newsender_zip_code").closest('div').removeClass('error');
                $("#newsender_zip_code").addClass('field_success');
            }

            if(country == ""){
                $("#newsender_country").closest('div').addClass('error');
            }else{
                $("#newsender_country").closest('div').removeClass('error');
                $("#newsender_country").addClass('field_success');
            }

        }

    });

    $("body").on("click","#create_new_group",function(){
        var client_id = $('#lead_client_id').val();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/check_unsub_counter/"+client_id,
            type: "POST",
            success:function(response_data){
                if(response_data == '2'){

                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "Unsubscribe groups limit exceeded.You can only create 2 custom unsubscribe groups",
                    });

                }else{
                    
                    if( group_name          == '' ){  $("#group_name").css("border-color","#ccc");  }
                    if( group_description   == '' ){  $("#group_description").css("border-color","#ccc"); }

                    $('#add_unsub_group').modal('show');
                }
            }
        });
        

    });

    

    $('.supression_groups_listings').on("click",function(){

        var sendgrid_id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        $('#suppression_list_id').val(sendgrid_id);
        $('#unsubs_listing').html('<li><span class="sg-left-cion"><i class="fa fa-check" aria-hidden="true"></i></span>'+name+'</li>');
    });

    $('#save_group').on("click",function(){
        var group_name = $('#group_name').val();
        
        var group_description = $('#group_description').val();
        

        if( group_name != '' && group_description != ''){

            $('#group_name').val('');
            $('#group_description').val('');

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_unsub_group_name",
                type: "POST",
                data : {group_name:group_name},
                success:function(response_data){
                    if(response_data == '0'){

                        $.ajax({
                            url : "<?php echo SURL?>sendgrid_campaigns/add_new_suppression_group",
                            type: "POST",
                            data : {group_name:group_name,group_description:group_description},
                            success:function(response_data){
                                get_suppression_group();
                                $('#add_unsub_group').modal('hide');
                                $.alert({
                                    title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                    content: "Unsubscribe group created successfully!",
                                });
                            }
                        }); 

                    }else{
                        
                        $.alert({
                                    title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                                    content: "There is already a unsub group with this name. Please enter another name",
                        });
                    }
                }
            });

        }else{

            if( group_name          == '' ){  $("#group_name").css("border-color","red");  }
            if( group_description   == '' ){  $("#group_description").css("border-color","red"); }
        }
    });

    function get_suppression_group(){

        var client_id = $('#lead_client_id').val();
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/get_client_sendgrid_supression_groups_listings/"+client_id,
            type: "POST",

            success:function(response_data) 
            {
                $('#group_lists').html(response_data);
                
                
            }
        });
    }

    function verify_sender(){

        var sender = $('#sender_select').val();
        if(sender != '' || sender != '0'){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/check_sender/"+sender,
                type: "POST",
                success:function(response_data) 
                {
                    if(response_data == '0'){
                        
                        $.alert({
                            title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                            content: "You will need to verify your email address before sending this campaign. Please check your email for a verification link from Sendgrid",
                        });
                    }

                    $('#sender_Verified_bit').val(response_data);
                    
                }
            }); 

            return $('#sender_Verified_bit').val();
        }else{

            $.alert({
                title: '<img src="https://s3.us-east-2.amazonaws.com/callersiq.asset/img/logo-light.png">',
                content: "Please select sender from settings tab.",
            });
            return 0;
        }
            
    }

    $('body').on('click','.delete_unsub_group', function(){

        var id              = $(this).attr('data-id');
        var sendgrid_id     = $(this).attr('sendgrid-id');
         
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/delete_unsubcribe_group/",
            type: "POST",
            data: {id:id,sendgrid_id:sendgrid_id},
            success:function(response_data) 
            {
                $('#unsub_list_'+id).remove();
            }
        });
 
    });

    $('body').on('click','.resend_sender_email_btn', function(){
    
        var sender = $('#sender_select').val();
        if(sender != '' || sender != '0'){
            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/resend_sender_verification/"+sender,
                type: "POST",
                success:function(response_data) 
                {
                    $.alert({
                        title: '<img src="<?php echo IMG; ?>logo.png" style="width:100px">',
                        content: "Sender verification email sent successfully. Please check your email for a verification link from Sendgrid",
                    });
                    
                }
            }); 

        }else{

            $.alert({
                title: '<img src="https://s3.us-east-2.amazonaws.com/callersiq.asset/img/logo-light.png">',
                content: "Please select sender from settings tab.",
            });
        }

    });

    $('body').on('click','#add_sender_modal_btn', function(){

        $('#sender_name').val('');
        $('#newsender_from_name').val('');
        $('#newsender_from_email').val('');
        $('#newsender_reply_email').val('');
        $('#newsender_address').val('');
        $('#newsender_city').val('');
        $('#newsender_state').val('');
        $('#newsender_zip_code').val('');
        $('#newsender_country').val('');
        $('#Add_sender_modal').modal('show');

        $("#create_new_sender").css('display',"none");

        if($('#sender_name').hasClass('field_success') || $('#sender_name').closest('div').hasClass('error')){

            $('#sender_name').removeClass('field_success');
            $("#sender_name").closest('div').removeClass('error');

        }

        if($('#newsender_from_name').hasClass('field_success') || $('#newsender_from_name').closest('div').hasClass('error')){

            $('#newsender_from_name').removeClass('field_success');
            $("#newsender_from_name").closest('div').removeClass('error');
            
        }

        if($('#newsender_from_email').hasClass('field_success') || $('#newsender_from_email').closest('div').hasClass('error')){

            $('#newsender_from_email').removeClass('field_success');
            $("#newsender_from_email").closest('div').removeClass('error');
            $("#newsender_from_email").removeClass('error_email');
            $('#email_verfication_res').html('');
            
        }

        if($('#newsender_reply_email').hasClass('field_success') || $('#newsender_reply_email').closest('div').hasClass('error')){

            $('#newsender_reply_email').removeClass('field_success');
            $("#newsender_reply_email").closest('div').removeClass('error');
            
        }

        if($('#newsender_address').hasClass('field_success') || $('#newsender_address').closest('div').hasClass('error')){

            $('#newsender_address').removeClass('field_success');
            $("#newsender_address").closest('div').removeClass('error');
            
        }

        if($('#newsender_city').hasClass('field_success') || $('#newsender_city').closest('div').hasClass('error')){

            $('#newsender_city').removeClass('field_success');
            $("#newsender_city").closest('div').removeClass('error');
            
        }

        if($('#newsender_state').hasClass('field_success') || $('#newsender_state').closest('div').hasClass('error')){

            $('#newsender_state').removeClass('field_success');
            $("#newsender_state").closest('div').removeClass('error');
            
        }

        if($('#newsender_zip_code').hasClass('field_success') || $('#newsender_zip_code').closest('div').hasClass('error')){

            $('#newsender_zip_code').removeClass('field_success');
            $("#newsender_zip_code").closest('div').removeClass('error');
            
        }

        if($('#newsender_country').hasClass('field_success') || $('#newsender_country').closest('div').hasClass('error')){

            $('#newsender_country').removeClass('field_success');
            $("#newsender_country").closest('div').removeClass('error');
            
        }

        if($('#Add_sender_modal').hasClass('field_success') || $('#Add_sender_modal').closest('div').hasClass('error')){

            $('#Add_sender_modal').removeClass('field_success');
            $("#Add_sender_modal").closest('div').removeClass('error');
            
        }


        // $('#newsender_from_email').css('border','1px solid #ccc');
        // $('#email_verfication_res').html('');
        
    });

    $("body").on("blur","#newsender_from_email",function(e){

        var sender_email = $(this).val();
        var email_length= sender_email.length;
            
        if(email_length > 3){
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            
            
            if(pattern.test(sender_email)){
                
                $.ajax({
                    url : "<?php echo SURL?>sendgrid_campaigns/verfiy_sender_email_address",
                    type: "POST",
                    data : {sender_email:sender_email},
                    success:function(response_data){
                        
                        if(response_data == "yes"){
                            
                            $("#create_new_sender").css('display','none');
                            $("#email_verfication_res").html("<p>Email already exist please enter another email</p>");
                            $("#newsender_from_email").addClass('error_email');

                        }else{
                            $("#email_verfication_res").closest('div').removeClass('error');
                            $("#newsender_from_email").removeClass('error_email');
                            $("#create_new_sender").css('display','inline-block');
                            $("#email_verfication_res").html('');
                            $("#newsender_from_email").addClass('field_success');
                        }
                    }
                });

            }else{
                $("#create_new_sender").css('display','none');
                $("#email_verfication_res").html("<p>Please enter a valid email address</p>");
                $("#newsender_from_email").addClass('error_email');
            }
        }else{

            $("#newsender_from_email").closest('div').addClass('error');

        }

    });


    $("body").on("blur","#sender_name",function(e){

        var sender_name = $(this).val();
        var sender_name_length = sender_name.length;
            
        if(sender_name_length > 0){

            $.ajax({
                url : "<?php echo SURL?>sendgrid_campaigns/verfiy_sender_name",
                type: "POST",
                data : {sender_name:sender_name},
                success:function(response_data){
                    
                    if(response_data == "yes"){
                        
                        $("#sender_name_verfication_res").html("<p>Name already exist please enter unique name</p>");
                        $("#sender_name").addClass('error_email');

                    }else{
                        $("#sender_name_verfication_res").closest('div').removeClass('error');
                        $("#sender_name").removeClass('error_email');
                        $("#sender_name_verfication_res").html('');
                        $("#sender_name").addClass('field_success');
                    }
                }
            });

        }else{

            $("#sender_name").closest('div').addClass('error');

        }

    });

    $('body').on('click','#delete_sender_modal_btn', function(){

        var sender_id = $('#sender_select').val();

     
        $.ajax({
            url : "<?php echo SURL?>sendgrid_campaigns/delete_sender",
            type: "POST",
            data : {sender_id:sender_id},
            success:function(response_data){

                $('#sender_select option[value="'+sender_id+'"]').remove();
                $('#sender_select').trigger("change");
            }
        });
  

    });

</script>
<?php } 
