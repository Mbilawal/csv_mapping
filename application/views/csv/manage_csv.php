<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					CSV </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home">
						<i class="flaticon2-shelter"></i>
					</a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						<!-- New Page  -->
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Manage CSV
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<a href="javascript:;" class="btn btn-brand btn-sm btn-pill" id="client_csv_upload_btn" data-toggle="kt-tooltip" data-skin="dark" title="New Icon">
							<i class="flaticon2-plus"></i>
							New CSV Upload
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Name</th>
						<th>Total Recipant</th>
						<th>Pending Contacts</th>
						<th>Successfull Contacts</th>
						<th>Created Date</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php 
							foreach($csv_arr as $key => $value){ ?>
								<tr class="user_list_row" id="<?php echo $value['id']; ?>">
									<td class="icon_row_icon_class">
										<?php echo $value['csv_name']; ?>	
									</td>
									<td class="icon_row_icon">
										<?php echo $value['total_csv_records']; ?>	
									</td>
									<td class="icon_row_icon">
										<?php echo get_csv_pending_contacts($value['id']); ?>	
									</td>
									<td class="icon_row_icon">
										<?php echo get_csv_upload_contacts($value['id']); ?>	
									</td>
									<td class="icon_row_icon">
										<?php echo $value['created_date']; ?>	
									</td>
									<td class="user_list_row_action">
										<!-- Action -->
										<!-- Edit User -->
										<button class="btn btn-label-primary btn-sm btn-icon btn-pill edit_icon" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" title="View <b>CSV Contacts</b>">
											<a href="<?php echo SURL; ?>csv/view/<?php echo $value['id']; ?>" target="_blank"><i class="fa fa-eye"></i></a>
										</button>

										<button class="btn btn-label-danger btn-sm btn-icon btn-pill edit_icon" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" title="<b>Remove</b>">
											<a href="<?php echo SURL; ?>csv/delete/<?php echo $value['id']; ?>" target="_blank"><i class="fa fa-trash"></i></a>
										</button>

										<button class="btn btn-label-success btn-sm btn-icon btn-pill edit_icon" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" title="<b>Export</b>">
											<a href="<?php echo SURL; ?>csv/export/<?php echo $value['id']; ?>" target="_blank"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
										</button>
									</td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end:: Content -->
</div>

<!--begin::Modal-->
<div class="modal fade" id="edit_icon_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Campaign</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- user Name -->
					<div class="form-group col-md-11">
						<label>Icon class</label>
						<input id="icon_upd" type="text" name="icon_upd" class="form-control" required>
					</div>
					<div class="form-group col-md-11">
						<label>Icon link</label>
						<input id="icon_link_upd" type="text" name="icon_link_upd" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="icon_id_upd" id="icon_id_upd" value="" />
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary update_social_icon" id="update_social_icon">Save changes</button>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="myModal_csv" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form  action="<?php echo SURL; ?>campaign/upload_csv_file" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload CSV file</h4>
                </div>
                <div class="modal-body">
                    <span id="lead_forward_response_msg"></span>
                    <div class="clear-fix"></div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                            <input type="file" name="csv_file" id="csv_file" class="form-control"/>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csv_client_id" id="csv_client_id"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="padding-top:11px; padding-bottom:5px;">Close</button>
                    <button type="submit" class="btn btn-success"  id="forward_champion_sbt_btn" style="padding-top:11px; padding-bottom:5px;">Upload</button>
                </div>
            </div>
        </form>
        <!-- Modal content-->

    </div>
</div>
<!-- End Modal -->


