<style type="text/css">
	.kt-portlet__body {
	  padding: 20px;
	  background-color: #fff;
	}
</style>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Dashboard </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="" class="kt-subheader__breadcrumbs-link"> </a>

					<!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
				</div>
			</div>
			<div class="kt-subheader__toolbar">
				<div class="kt-subheader__wrapper">
					<a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="" data-placement="left" data-original-title="Select dashboard daterange">
						<span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Month:</span>&nbsp;
						<span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date"></span>

						<!--<i class="flaticon2-calendar-1"></i>-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24"></rect>
								<path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
								<path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000"></path>
							</g>
						</svg> 
					</a>
				</div>
			</div>
		</div>
	</div>
    
	<!-- end:: Subheader -->
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

		<!--Analytis-->

		<div class="kt-portlet">
			<div class="kt-portlet__body  kt-portlet__body--fit">
				<div class="row row-no-padding row-col-separator-lg">
					<div class="col-md-12 col-lg-3 col-xl-3">

						<!--begin::Total Product-->
						<div class="kt-widget24">
							<div class="kt-widget24__details">
								<div class="kt-widget24__info">
									<h4 class="kt-widget24__title">
										Total Contacts
									</h4>
									<span class="kt-widget24__desc">
									</span>
								</div>
								<span class="kt-widget24__stats kt-font-brand" id="total_gapi_user"><?= $totalUsers; ?></span>
							</div>
						</div>

						<!--end::Total Product-->
					</div>
					<div class="col-md-12 col-lg-3 col-xl-3">

						<!--begin::Primary Category-->
						<div class="kt-widget24">
							<div class="kt-widget24__details">
								<div class="kt-widget24__info">
									<h4 class="kt-widget24__title">
										Total CSV Upload
									</h4>
								</div>
								<span class="kt-widget24__stats kt-font-warning" id="total_gapi_session"><?= $totalcsv; ?></span>
							</div>
						</div>

						<!--end::Primary Category-->
					</div>
					
					<div class="col-md-12 col-lg-3 col-xl-3">

						<!--begin::Parent Category-->
						<div class="kt-widget24">
							<div class="kt-widget24__details">
								<div class="kt-widget24__info">
									<h4 class="kt-widget24__title">
										Total Pending Contacts
									</h4>
									<span class="kt-widget24__desc">
									</span>
								</div>
								<span class="kt-widget24__stats kt-font-success" id="total_gapi_bounce"><?= ceil($total_pending); ?></span>
							</div>
						</div>

						<!--end::Parent Category-->
					</div>
					<div class="col-md-12 col-lg-3 col-xl-3">
						<!--begin::Total Brand-->
						<div class="kt-widget24">
							<div class="kt-widget24__details">
								<div class="kt-widget24__info">
									<h4 class="kt-widget24__title">
										Total Duplicate Contacts
									</h4>
									<span class="kt-widget24__desc">
									</span>
								</div>
								<span class="kt-widget24__stats kt-font-danger" id="total_gapi_page"><?= $total_duplicate; ?></span>
							</div>
						</div>

						<!--end::Total Brand-->
					</div>
					
				</div>
			</div>
		</div>

		<!--End Analytis-->

		<!--Begin::Dashboard 1-->
		<div class="row" style="margin-top: 10px;">
			<div class="col-lg-12 col-xl-12 order-lg-12 order-xl-12">
				<div id="analysis_graph"></div>
			</div>
		</div>		

		<div class="col-md-6">
			<div id="usersContainer"></div>
		</div>

		<!-- END Charts Section -->
		
		<div class="row note_row">
			<?php 
			foreach ($sticky_notes as $key => $note) :
				$status = ($note['note_status'] == 2) ? 'kt-callout--warning' :  (($note['note_status'] == 1) ? 'kt-callout--success' : (($note['note_status'] == 3) ? 'kt-callout--danger' : 'kt-callout--info'));
				$status_desc = ($note['note_status'] == 2) ? 'Pending' :  (($note['note_status'] == 1) ? 'Success' : (($note['note_status'] == 3) ? 'Out Dated' : 'In Progress'));
				$status_class = ($note['note_status'] == 2) ? 'warning' :  (($note['note_status'] == 1) ? 'success' : (($note['note_status'] == 3) ? 'danger' : 'brand'));				
				?>
				<div class="col-lg-4">
					<div class="kt-portlet kt-callout <?php echo $status; ?>" style="height: 280px !important;" id="note_id_<?php echo $note['note_id']; ?>" data-status="<?php echo $note['note_status']; ?>">
						<?php
						$note_user = ucfirst(get_user_details('user_name', $note['note_user'])). '  <small>User</small>';
						?>
						<div class="pull-left">
							<b>
							<?php echo trim($note_user); ?>
							</b>
							<div class="dropdown dropdown-inline pull-right">
								<button type="button" id="note_id_btn_<?php echo $note['note_id']; ?>" class="btn btn-<?php echo $status_class; ?> btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="flaticon-more-1"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item update-note-status" href="javascript:;" data-id="<?php echo $note['note_id']; ?>" data-status="0"><i class="fa fa-cog"></i> In Progress </a>
									<a class="dropdown-item update-note-status" href="javascript:;" data-id="<?php echo $note['note_id']; ?>" data-status="2"><i class="flaticon2-crisp-icons-1"></i> Pending </a>
									<a class="dropdown-item update-note-status" href="javascript:;" data-id="<?php echo $note['note_id']; ?>" data-status="1"><i class="fa fa-check"></i> Success </a>
									<a class="dropdown-item update-note-status" href="javascript:;" data-id="<?php echo $note['note_id']; ?>" data-status="3"><i class="flaticon2-exclamation"></i> Out Dated </a>
								</div>
							</div>
						</div>
						<div class="kt-portlet__body" style="margin-top:-20px;padding: 10px !important;">
							<div class="kt-callout__body">
								<div class="kt-callout__content">
									<hr>
									<p>
										Quantity : <b><?php echo $note['note_quantity']; ?></b><br>
										Amount : <b><?php echo $note['note_amount']; ?></b><br>
										Status  :  <b id="note_id_txt_<?php echo $note['note_id']; ?>"><?php echo $status_desc; ?></b><br>
										Due Date : <b><?php echo $note['note_date']; ?></b><br>
										<?php echo $note['note_meta']; ?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php 
			endforeach; 
			?>
		</div>

		<!--End::Dashboard 1-->
	</div>
	<!-- end:: Content -->
</div>