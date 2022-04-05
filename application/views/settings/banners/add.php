<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Banners </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						<?= ($EDIT == 'true' ? 'Edit' : 'New') ?> Banner </a>
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
						<?= ($EDIT == 'true' ? 'Edit' : 'New') ?> Banner
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form action="<?= SURL ?>setting/<?= ($EDIT == 'true' ? 'edit-banner-process' : 'add-banner-process') ?>/" name="add_new_banner" method="post" enctype="multipart/form-data">
				
					<div class="row">
						<div class="col-md-3 form-group">
							<label>Name</label>
							<input type="text" name="banner_name" class="form-control banner_name" id="banner_name" required value="<?= $banner_data['name'] ?>">
						</div>
						<div class="col-md-3 form-group">
							<label>Status</label>
							<select name="banner_status" class="form-control banner_status" id="banner_status" required value="<?= $banner_data['status'] ?>">
								<option value="show">Show</option>
								<option value="hide">Hide</option>
							</select>
						</div>
						<div class="col-md-3 form-group">
							<label>Pages</label>
							<?php $banner_data['pages'] = (array) $banner_data['pages'];?>
							<select name="banner_pages[]" class="form-control banner_pages" id="banner_pages" required multiple>
								<?php
								foreach (get_filters('page_slug', 'pages', 500) as $page) {
									if($page!=""){ ?>
									<option value="<?=$page?>" <?=(in_array($page, $banner_data['pages']))?'selected':''?> ><?=ucfirst($page)?></option>
									<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="col-md-3 form-group">
							<label>Background Color</label>
							<input type="color" name="banner_bgcolor" class="form-control banner_bgcolor" id="banner_bgcolor" value="<?= $banner_data['bgcolor'] ?>">
						</div>
						<div class="col-md-3 form-group">
							<label>Font Color</label>
							<input type="color" name="banner_fontcolor" class="form-control banner_fontcolor" id="banner_fontcolor" value="<?= $banner_data['fontcolor'] ?>">
						</div>
						<div class="col-md-12 form-group">
							<label>Description</label>
							<textarea class="form-control summernote" name="banner_desc" id="banner_desc" placeholder="Description....."><?= stripcslashes($banner_data['desc']) ?></textarea>
						</div>
						<div class="col-md-12 form-group">
							<label>Custom CSS</label>
							<textarea class="form-control summernote" name="custom_css" id="custom_css" placeholder="Custom CSS"><?= stripcslashes($banner_data['custom_css']) ?></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 form-group text-right">
							<input type="hidden" name="banner_id" value="<?= (string)$banner_data['_id'] ?>">
							<button type="submit" id="add_new_banner" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-<?= ($EDIT == 'true' ? 'check' : 'plus') ?>"></i><?= ($EDIT == 'true' ? 'Update' : 'Add') ?></button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>

	</div>
	<!-- end:: Content -->
</div>