<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Settings </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						Meta Tags Setting </a>
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
						<i class="kt-font-brand fa fa-cog fa-spin"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						Meta Tags Setting
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form name="add_new_setting" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6 form-group">
							<div class="alert alert-warning">Place a ' [TOKEN] ' keyword in title and description for dynamic replacement of name.</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Page</label>
							<div class="kt-ion-range-slider">
								<select name="status" id="view_page" class="select2 form-control">
									<option value="home"> Home </option>
									<option value="about_us"> About Us </option>
									<option value="blog"> Blog </option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Meta Title</label>
							<input type="text" name="meta_tag_title" class="form-control meta_tag_title" id="meta_tag_title" value="<?=$meta_setting['title'];?>">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Meta Description</label>
							<textarea name="meta_tag_description" class="form-control meta_tag_description" id="meta_tag_description"><?=$meta_setting['description'];?></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group text-right">
							<button type="reset" name="reset" class="reset btn btn-default btn-sm"><i class="flaticon-refresh"></i>Reset</button>
							<button type="button" id="save_meta_tag_setting_btn" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-check"></i>Save</button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>
		
	</div>
	<!-- end:: Content -->
</div>