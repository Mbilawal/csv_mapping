<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Menus </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						New Menu </a>
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
						<i class="kt-font-brand flaticon2-plus"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						New Menu
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form name="add_new_menu" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4 form-group">
							<label>Title</label>
							<input type="text" name="menu_title" class="form-control menu_title" id="menu_title" placeholder="Manage Products..." required>
						</div>
						<div class="col-md-8 form-group">
							<label>Description</label>
							<input type="text" name="description" class="form-control description" id="description" required placeholder="(Admin / User)">
						</div>
						<div class="col-md-4 form-group">
							<label>Parent</label>
							<select name="parent_id" class="form-control parent_id" id="parent_id">
								<option value="0"> ~ No Parent ~ </option>
								<?php
								foreach ($parents_arr as $parent) :
									if ($parent['parent_id'] == 0) :
										?>
											<option value="<?php echo $parent['id']; ?>"><?php echo $parent['menu_title'] . " - " . substr($parent['description'], 0, 50); ?></option>
										<?php
									endif;
								endforeach;
								?>
							</select>
						</div>
						<div class="col-md-4 form-group">
							<label>Icon Class</label>
							<input type="text" name="icon_class_name" class="form-control icon_class_name" id="icon_class_name" placeholder="fa fa-plus" required>
						</div>
						<div class="col-md-4 form-group">
							<label>Link</label>
							<input type="text" name="url_link" class="form-control url_link" id="url_link" placeholder="setting/add_menu" required>
						</div>
						<div class="col-md-4 form-group">
							<label>Display Order</label>
							<input type="number" name="display_order" class="form-control display_order" id="display_order" placeholder="1 / 2 / 3 ..." required>
						</div>
						<div class="col-md-4 form-group">
							<label>Status</label>
							<select name="status" class="form-control status" id="status">
								<option value="1">Active</option>
								<option value="2">In Active</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group text-right">
							<button type="reset" name="reset" class="reset btn btn-default btn-sm"><i class="flaticon-refresh"></i>Reset</button>
							<button type="button" id="add_new_menu" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-plus"></i>Add</button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>

	</div>
	<!-- end:: Content -->
</div>
