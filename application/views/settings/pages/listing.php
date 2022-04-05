<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Pages </h3>
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
						Pages
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<a href="<?= SURL . "setting/create-default-pages/" ?>" class="btn btn-danger btn-sm btn-pill" data-toggle="kt-tooltip" title="Create Default Pages!" data-skin="dark">
							<i class="fa fa-cog"></i>
							Create Defaults
						</a>
						<a href="<?= SURL . "setting/add-page/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" title="New page" data-skin="dark">
							<i class="flaticon2-plus"></i>
							New Page
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Name</th>
						<th>Page Slug</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						foreach ($pages_array as $key => $value) {
						?>
							<tr class="page_list_row" id="<?= (string)$value['_id']; ?>">
								<td class="page_list_row_name">
									<!-- name -->
									<?= $value['name']; ?>
								</td>
								<td class="page_list_row_page_slug">
									<!-- page_slug -->
									<?= $value['page_slug']; ?>
								</td>
								<td class="page_list_row_status">
									<!-- status -->
									<?= $value['status']; ?>
								</td>
								<td class="page_list_row_action">
									<!-- Action -->
									<!-- Edit page -->
									<a href="<?= SURL ?>setting/edit-page/<?= (string)$value['_id']; ?>" class="btn btn-label-primary btn-pill btn-sm btn-icon edit_page" data-toggle="kt-tooltip" title="Edit <?= $value['name']; ?>" data-skin="dark">
										<i class="fa fa-edit"></i>
									</a>
									<?php
									if (!in_array($value['name'], $default_pages)) {
									?>
										<!-- Delete page -->
										<button class="btn btn-label-danger btn-pill btn-sm btn-icon delete_page" data-id="<?= (string)$value['_id']; ?>" data-toggle="kt-tooltip" title="Delete <?= $value['name']; ?>" data-skin="dark">
											<i class="fa fa-trash"></i>
										</button>
									<?php
									}
									?>
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