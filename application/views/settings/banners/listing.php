<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Banners </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home">
						<i class="flaticon2-shelter"></i>
					</a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						<!-- New Banner  -->
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
					Banners
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<!-- <a href="<?= SURL . "setting/create-default-banners/" ?>" class="btn btn-danger btn-sm btn-pill" data-toggle="kt-tooltip" title="Create Default Banners!" data-skin="dark">
							<i class="fa fa-cog"></i>
							Create Defaults
						</a> -->
						<a href="<?= SURL . "setting/add-banner/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" title="New banner" data-skin="dark">
							<i class="flaticon2-plus"></i>
							New Banner
						</a>
					</div>
				</div>
			</div>
			<div class="kt-portlet__body">
				<table class="table table-hover table-bordered dataTable_call">
					<thead>
						<th>Name</th>
						<th>Pages</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php
						foreach ($banners_array as $key => $value) {
						?>
							<tr class="banner_list_row" id="<?= (string)$value['_id']; ?>">
								<td class="banner_list_row_name">
									<!-- name -->
									<?= $value['name']; ?>
								</td>
								<td class="banner_list_row_pages">
									<!-- name -->
									<?php if(!empty($value['pages'])){
											$str = '';
											foreach ($value['pages'] as $data) { 
												$str .= $data.',';
									 		}
									 		$str_tem = rtrim($str,',');
									 		echo $str_tem;
									}  ?>
								</td>
								<td class="banner_list_row_status">
									<!-- status -->
									<?= $value['status']; ?>
								</td>
								<td class="banner_list_row_action">
									<!-- Action -->
									<!-- Edit banner -->
									<a href="<?= SURL ?>setting/edit-banner/<?= (string)$value['_id']; ?>" class="btn btn-label-primary btn-pill btn-sm btn-icon edit_banner" data-toggle="kt-tooltip" title="Edit <?= $value['name']; ?>" data-skin="dark">
										<i class="fa fa-edit"></i>
									</a>
									<?php
									if (!in_array($value['name'], $default_banners)) {
									?>
										<!-- Delete banner -->
										<button class="btn btn-label-danger btn-pill btn-sm btn-icon delete_banner" data-toggle="kt-tooltip" title="Delete <?= $value['name']; ?>" data-skin="dark">
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