<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Cities </h3>
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
						Cities
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<a href="<?php echo SURL."setting/add-city/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" title="New City" data-skin="dark">
							<i class="flaticon2-plus"></i>
							New City
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Meta</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php 
							foreach ($cities_array as $key => $value) {
								?>
								<tr class="city_list_row" id="<?php echo $value['city_id']; ?>">
									<td class="city_list_row_meta">
										<!-- Meta -->
										<?php echo $value['city_meta']; ?>
									</td>
									<td class="city_list_row_action">
										<!-- Action -->
										<!-- Edit city -->
										<button class="btn btn-label-primary btn-pill btn-sm btn-icon edit_city" data-toggle="kt-tooltip" title="Edit <?php echo $value['city_meta']; ?>" data-skin="dark">
											<i class="fa fa-edit"></i>
										</button>
										<!-- Delete city -->
										<button class="btn btn-label-danger btn-pill btn-sm btn-icon delete_city" data-toggle="kt-tooltip" title="Delete <?php echo $value['city_meta']; ?>" data-skin="dark">
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
<div class="modal fade" id="edit_city_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- City Meta -->
					<div class="form-group col-md-6">
						<label>Meta</label>
						<input id="city_meta_upd" type="text" name="city_meta_upd" class="form-control" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="city_id_upd" id="city_id_upd">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary update_city_details" id="update_city_details">Save changes</button>
			</div>
		</div>
	</div>
</div>