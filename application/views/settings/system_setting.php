<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Custom Field </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home">
						<i class="flaticon2-shelter"></i>
					</a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-system_setting">
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
						Manage Setting Field
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<button name="submit" class="add_system_setting btn btn-bold btn-success btn-sm"><i class="flaticon2-plus"></i>Add Setting Field</button>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Field Name</th>
						<th>Field Value</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php 
							foreach ($system_setting_arr as $key => $value) { ?>
								<tr class="system_setting_row" id="<?php echo $value['_id']; ?>">
									<td class="system_setting_row_name">
										<!-- Phone -->
										<?php echo $value['name']; ?>	
									</td>
									<td class="system_setting_row_value">
										<!-- Phone -->
										<?php echo $value['value']; ?>	
									</td>
									<td class="system_setting_row_action">
										<!-- Edit system_setting -->
										<button class="btn btn-label-primary btn-sm btn-icon btn-pill edit_system_setting"  data_id="<?php echo $value['_id']; ?>" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" title="Edit <b><?php echo $value['name']; ?></b>">
											<i class="fa fa-edit"></i>
										</button>
										<button class="btn btn btn-label-danger uppercase btn-circle delete_system_setting" data_id="<?php echo $value['_id']; ?>"><i class="fa fa-trash"></i></button>
										
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
<div class="modal fade" id="edit_system_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form name="edit_new_system_setting" method="post" enctype="multipart/form-data">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Setting Field</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body" id="upd_system_setting_body">
				
			</div>
			<div class="modal-footer">
				<input type="hidden" name="system_setting_id_upd" id="system_setting_id_upd" value="" />
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary update_system_setting_details" id="update_system_setting_details">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>


<!--move_child_category::Modal-->
<div class="modal fade" id="add_system_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xs" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add_exampleModalLabel_manual">Add Setting Field</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- user Name -->
					<div class="form-group col-md-12">
						<label>Field Name</label>
						<input type="text" class="form-control" name="field_name" id="field_name" /> 
					</div>
					<div class="form-group col-md-12">
						<label>Field Value</label>
						<input type="text" class="form-control" name="field_value" id="field_value" /> 
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary add_system_setting_manual" id="add_system_setting_manual">Save</button>
			</div>
		</div>
	</div>
</div>