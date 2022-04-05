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
						New Setting </a>
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
						New Global Setting
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form name="add_new_setting" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4 form-group">
							<label>Meta</label>
							<input type="text" name="setting_meta" class="form-control setting_meta" id="setting_meta" required>
						</div>
						<div class="col-md-4 form-group">
							<label>Value</label>
							<input type="text" name="setting_value" class="form-control setting_value" id="setting_value">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 form-group text-right">
							<button type="reset" name="reset" class="reset btn btn-default btn-sm"><i class="flaticon-refresh"></i>Reset</button>
							<button type="button" id="add_new_setting" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-plus"></i>Add</button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>
		
	</div>
	<!-- end:: Content -->
</div>