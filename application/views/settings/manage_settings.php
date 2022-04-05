<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Settings </h3>
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
						<i class="kt-font-brand fa fa-cog"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Global Settings
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<a href="<?php echo SURL."setting/add-setting/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" title="New Setting" data-skin="dark">
							<i class="flaticon2-plus"></i>
							New Setting
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Meta</th>
						<th>Value</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php 
							foreach ($settings_array as $key => $value) {
								?>
								<tr class="setting_list_row" id="<?php echo $value['setting_id']; ?>">
									<td class="setting_list_row_meta">
										<!-- Meta -->
										<?php echo $value['setting_meta']; ?>
									</td>
									<td class="setting_list_row_value">
										<!-- Value -->
										<?php echo $value['setting_value']; ?>	
									</td>
									<td class="setting_list_row_action">
										<!-- Action -->
										<!-- Edit setting -->
										<button class="btn btn-label-primary btn-pill btn-sm btn-icon edit_setting" data-toggle="kt-tooltip" title="Edit <?php echo $value['setting_meta']; ?>" data-skin="dark">
											<i class="fa fa-edit"></i>
										</button>
										<!-- Delete setting -->
										<button class="btn btn-label-danger btn-pill btn-sm btn-icon delete_setting" data-toggle="kt-tooltip" title="Delete <?php echo $value['setting_meta']; ?>" data-skin="dark">
											<i class="fa fa-trash"></i>
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
<div class="modal fade" id="edit_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Setting</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Setting Meta -->
					<div class="form-group col-md-6">
						<label>Meta</label>
						<input id="setting_meta_upd" type="text" name="setting_meta_upd" class="form-control" required>
					</div>
					<!-- Setting Value -->
					<div class="form-group col-md-6">
						<label>Value</label>
						<input id="setting_value_upd" type="text" name="setting_value_upd" class="form-control">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="setting_id_upd" id="setting_id_upd">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary update_setting_details" id="update_setting_details">Save changes</button>
			</div>
		</div>
	</div>
</div>