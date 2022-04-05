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
								<i class="flaticon-users-1"></i>
							</span>
							<h3 class="kt-portlet__head-title color-cfont">
								Roles
							</h3>
						</div>
						<div class="kt-portlet__toolbar">
							<a href="<?php echo site_url(); ?>setting/add-new-role/" class="btn btn-brand btn-icon btn-sm" data-skin="brand" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="New Role" style="margin-top: 10px;"><i class="flaticon2-plus" aria-hidden="true"></i></a>
						</div>
					</div>
					<!--- Kt-portlet__body tag-->
					<div class="kt-portlet__body kt-portlet__body--fit">
						<div class="kt-section">
							<div class="kt-section__content text-center">
								<table class="table table-striped table-responsive table-center dataTable_call_no_search_length">
									<thead class="thead-dark">
										<tr>
											<td style="width:10%;">#</td>
											<td style="width: 30%;">Name</td>
											<td style="width: 30%;">Description</td>
											<td style="width: 100%;">Status</td>
											<td style="width: 100%;">Actions</td>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										foreach ($roles_array as $row) {
										?>
											<tr id="<?php echo $row['id']; ?>">
												<td><?php echo $i; ?></td>
												<td><?php echo $row['role_name']; ?></td>
												<td><?php echo $row['role_description']; ?></td>
												<td><?php echo ($row['status'] == 1) ? '<span class="kt-badge kt-badge--inline kt-badge--success">Active</span>' : '<span class="kt-badge kt-badge--inline kt-badge--danger">Inactive</span>'; ?></td>
												<td>
													<div class="btn-group" role="group" aria-label="Actions">
														<a href="<?php echo SURL; ?>setting/edit-role/<?php echo $row['id']; ?>" class="btn btn-primary btn-elevate btn-pill btn-elevate-air btn-icon btn-sm" title="Edit">
															<i class="flaticon2-edit"></i>
														</a>
														<a href="javascript:;" data-id="<?php echo $row['id']; ?>" class="btn btn-danger btn-elevate btn-pill btn-elevate-air delete_role btn-icon btn-sm" title="Delete">
															<i class="flaticon-delete"></i>
														</a>
													</div>
												</td>
											</tr>
										<?php
											$i++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--- End Kt-portlet__body tag-->
				</div>
			</div>
		</div>
	</div>
</div>
