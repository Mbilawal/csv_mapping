<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Roles </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home">
						<i class="flaticon2-shelter"></i>
					</a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						<!-- New Page  -->
						Edit Role
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end:: Subheader -->
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="kt-portlet" id="kt_portlet">
					<div class="kt-portlet__head bg-chead">
						<div class="kt-portlet__head-label">
							<span class="kt-portlet__head-icon color-cfont">
								<i class="flaticon2-plus"></i>
							</span>
							<h3 class="kt-portlet__head-title color-cfont">
								Edit Role
								<small style="color: white;">Follow the steps below:</small>
							</h3>
						</div>
					</div>
					<!--- Kt-portlet__body tag-->
					<div class="kt-portlet__body kt-portlet__body--fit">
						<div class="kt-grid  kt-wizard-v1 kt-wizard-v1--white" id="kt_wizard_v1" data-ktwizard-state="step-first">
							<div class="kt-grid__item">

								<!--begin: Form Wizard Nav -->
								<div class="kt-wizard-v1__nav">
									<div class="kt-wizard-v1__nav-items">
										<a class="kt-wizard-v1__nav-item" href="javascript:;" data-ktwizard-type="step" data-ktwizard-state="current">
											<div class="kt-wizard-v1__nav-body">
												<div class="kt-wizard-v1__nav-icon">
													<i class="flaticon2-user-1"></i>
												</div>
												<div class="kt-wizard-v1__nav-label">
													1) Setup Role
												</div>
											</div>
										</a>
										<a class="kt-wizard-v1__nav-item" href="javascript:;" data-ktwizard-type="step">
											<div class="kt-wizard-v1__nav-body">
												<div class="kt-wizard-v1__nav-icon">
													<i class="flaticon-list"></i>
												</div>
												<div class="kt-wizard-v1__nav-label">
													2) Assign Rights
												</div>
											</div>
										</a>
									</div>
								</div>

								<!--end: Form Wizard Nav -->
							</div>
							<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v1__wrapper">

								<!--begin: Form Wizard Form-->
								<form class="kt-form" id="kt_form">

									<!--begin: Form Wizard Step 1-->
									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
										<div class="kt-heading kt-heading--md">Setup Your Role</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v1__form">
												<div class="form-group">
													<label>Name</label>
													<input type="text" class="form-control role_name" name="role_name" placeholder="Admin / User" value="<?php echo $pre_role['role_name']; ?>">
													<span class="form-text text-muted">Please enter role name.</span>
												</div>
												<div class="form-group">
													<label>Description</label>
													<input type="text" class="form-control role_description" name="role_description" placeholder="For users / admin" value="<?php echo $pre_role['role_description']; ?>">
													<span class="form-text text-muted">Please enter description about role.</span>
												</div>
											</div>
										</div>
									</div>
									<!--end: Form Wizard Step 1-->
									<?php $pre_rights = explode(',', $pre_role['role_rights']); ?>
									<!--begin: Form Wizard Step 2-->
									<div class="kt-wizard-v1__content" data-ktwizard-type="step-content">
										<div class="kt-heading kt-heading--md">Assign Rights to Role</div>
										<div class="kt-form__section kt-form__section--first">
											<div class="kt-wizard-v1__form">
												<?php
												foreach ($menu_array as $value) {
													$parent_menu = $value['parent'];
													$child_menu = $value['child'];
												?>
													<div class="row menus_list">
														<div class="col-xl-4">
															<label class="kt-checkbox kt-checkbox--solid kt-checkbox--success">
																<input type="checkbox" class="check-all permissions" name="permissions" value="<?php echo $parent_menu['id']; ?>" <?php echo (in_array($parent_menu['id'], $pre_rights)) ? 'checked' : ''; ?>>
																<?php echo $parent_menu['menu_title']; ?>
																<small>
																	<?php echo ($parent_menu['description'] == '') ? '' : $parent_menu['description']; ?>
																</small>
																<span></span>
															</label>
															<div class="row">
																<?php
																foreach ($child_menu as $row) {
																?>
																	<div class="col-md-4">
																		<label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
																			<input type="checkbox" class="permissions" name="permissions" value="<?php echo $row['id']; ?>" data-id="<?php echo $parent_menu['id']; ?>" <?php echo (in_array($row['id'], $pre_rights)) ? 'checked' : ''; ?>>
																			<?php echo $row['menu_title']; ?>
																			<small>
																				<?php echo ($row['description'] == '') ? '' : $row['description']; ?>
																			</small>
																			<span></span>
																		</label>
																	</div>
																<?php
																}
																?>
															</div>
														</div>
													</div>
												<?php
												}
												?>
												<div class="row">
													<div class="col-md-8">
													</div>
													<div class="col-md-4">
														<label>Status</label>
														<select name="status" class="form-control status">
															<option value="1" <?php echo ($pre_role['status'] == 1) ? 'selected' : ''; ?>>Active</option>
															<option value="0" <?php echo ($pre_role['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!--end: Form Wizard Step 2-->

									<!--begin: Form Actions -->
									<div class="kt-form__actions">
										<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
											Previous
										</div>
										<div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
											Submit
										</div>
										<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
											Next Step
										</div>
										<input type="hidden" name="pre_role_id" class="pre_role_id" value="<?php echo $pre_role['id']; ?>">
									</div>

									<!--end: Form Actions -->
								</form>
							</div>
						</div>
					</div>
					<!--- End Kt-portlet__body tag-->
				</div>
			</div>
		</div>
	</div>
</div>
