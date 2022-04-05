<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Menus </h3>
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
						Menus
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<a href="<?php echo SURL . "setting/add-menu/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" title="New menu" data-skin="dark">
							<i class="flaticon2-plus"></i>
							New Menu
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call_no_search_length">
					<thead>
						<th>Title</th>
						<th>Description</th>
						<th>Parent</th>
						<th>Icon</th>
						<th>Link</th>
						<th>Display Order</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						foreach ($menus_array as $key => $value) {
						?>
							<tr class="menu_list_row" id="<?php echo $value['id']; ?>">
								<td class="menu_list_row_title">
									<!-- Title -->
									<?php echo $value['menu_title']; ?>
								</td>
								<td class="menu_list_row_description">
									<!-- Description -->
									<?php echo substr($value['description'], 0, 70); ?>
								</td>
								<td class="menu_list_row_parent">
									<!-- Parent -->
									<?php echo get_menu_detail_by_id($value['parent_id'], 'menu_title'); ?>
								</td>
								<td class="menu_list_row_icon_class_name">
									<!-- Icon Class Name -->
									<i class="<?php echo $value['icon_class_name']; ?>"></i>&nbsp;<?php echo $value['icon_class_name']; ?>
								</td>
								<td class="menu_list_row_url_link">
									<!-- Url Link -->
									<a href="<?php echo SURL. $value['url_link']; ?>" target="_blank"><?php echo $value['url_link']; ?></a>

								</td>
								<td class="menu_list_row_display_order">
									<!-- Display Order -->
									<?php echo $value['display_order']; ?>
								</td>
								<td class="menu_list_row_status">
									<!-- Status -->
									<?php
									if ($value['status'] == 1) :
										?>
										<span class="btn btn-label-success btn-sm">Active</span>
										<?php
									elseif ($value['status'] == 2):
										?>
										<span class="btn btn-label-danger btn-sm">In Active</span>
										<?php
									endif;
									?>
								</td>
								<td class="menu_list_row_action">
									<!-- Action -->
									<!-- Edit menu -->
									<button class="btn btn-label-primary btn-pill btn-sm btn-icon edit_menu" data-toggle="kt-tooltip" title="Edit <?php echo $value['menu_title']; ?>" data-skin="dark">
										<i class="fa fa-edit"></i>
									</button>
									<!-- Delete menu -->
									<button class="btn btn-label-danger btn-pill btn-sm btn-icon delete_menu" data-toggle="kt-tooltip" title="Delete <?php echo $value['menu_title']; ?>" data-skin="dark">
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
<div class="modal fade" id="edit_menu_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- Menu Title -->
					<div class="form-group col-md-4">
						<label>Title</label>
						<input id="menu_title_upd" type="text" name="menu_title_upd" class="form-control" required>
					</div>
					<!-- Menu Description -->
					<div class="form-group col-md-8">
						<label>Description</label>
						<input id="menu_description_upd" type="text" name="menu_description_upd" class="form-control" required>
					</div>
					<!-- Menu Parent -->
					<div class="col-md-4 form-group">
						<label>Parent</label>
						<select name="menu_parent_id_upd" class="form-control menu_parent_id_upd" id="menu_parent_id_upd">
							<option value="0"> ~ No Parent ~ </option>
							<?php
							foreach ($menus_array as $parent) :
								?>
								<option value="<?php echo $parent['id']; ?>"><?php echo $parent['menu_title'] . " - " . substr($parent['description'], 0, 50); ?></option>
								<?php
							endforeach;
							?>
						</select>
					</div>
					<!-- Menu Icon Class -->
					<div class="col-md-4 form-group">
						<label>Icon Class</label>
						<input type="text" name="menu_icon_class_name_upd" class="form-control menu_icon_class_name_upd" id="menu_icon_class_name_upd" placeholder="fa fa-plus" required>
					</div>
					<!-- Menu Link -->
					<div class="col-md-4 form-group">
						<label>Link</label>
						<input type="text" name="menu_url_link_upd" class="form-control menu_url_link_upd" id="menu_url_link_upd" placeholder="setting/add_menu" required>
					</div>
					<!-- Menu Display Order -->
					<div class="col-md-4 form-group">
						<label>Display Order</label>
						<input type="number" name="menu_display_order_upd" class="form-control menu_display_order_upd" id="menu_display_order_upd" placeholder="1 / 2 / 3 ..." required>
					</div>
					<!-- Menu Status -->
					<div class="col-md-4 form-group">
						<label>Status</label>
						<select name="menu_status_upd" class="form-control menu_status_upd" id="menu_status_upd">
							<option value="1">Active</option>
							<option value="2">In Active</option>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="menu_id_upd" id="menu_id_upd">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary update_menu_details" id="update_menu_details">Save changes</button>
			</div>
		</div>
	</div>
</div>
