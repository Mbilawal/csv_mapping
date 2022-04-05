<?php
/* top heder Menu or side bar code goes here...! */
$urI = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
?>
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
	<div class="kt-header-mobile__logo">
		<a href="<?php echo SURL; ?>" class="text-light fa-2x" style="font-weight: bold;">
			<span class="text-danger"></span>
			<img alt="Logo" src="<?php echo ASSETS; ?>media/company-logos/catwalker.png" style="width: 100% !important;">
		</a>
	</div>
	<div class="kt-header-mobile__toolbar">
		<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
		<button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
		<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
	</div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

		<!-- begin:: Aside -->
		<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
		<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

			<!-- begin:: Aside -->
			<div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
				<div class="kt-aside__brand-tools">
					<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler"><span></span></button>
				</div>
				<div class="kt-aside__brand-logo" style="margin-left: 10px;">
					<a href="<?php echo SURL; ?>" class="text-light fa-2x" style="font-weight: bold;">
						<span class="text-danger"></span>
			<!-- 			<img alt="Logo" src="<?php echo ASSETS; ?>media/company-logos/catwalker.png" style="width: 100% !important;"> -->
					</a>
				</div>
			</div>

			<!-- end:: Aside

			begin:: Aside Menu -->
			<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
				<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
					<ul class="kt-menu__nav ">

						<li class="kt-menu__item <?php echo ($urI == SURL.'dashboard') ? ('kt-menu__item--active') : (''); ?>" aria-haspopup="true">
							<a href="<?php echo SURL; ?>dashboard" class="kt-menu__link ">
								<i class="kt-menu__link-icon fa fa-desktop"></i>
								<span class="kt-menu__link-text">Dashboard</span>
							</a>
						</li>
						<li class="kt-menu__item <?php echo ($urI == SURL.'csv') ? ('kt-menu__item--active') : (''); ?>" aria-haspopup="true">
							<a href="<?php echo SURL; ?>csv" class="kt-menu__link ">
								<i class="kt-menu__link-icon fa fa-file"></i>
								<span class="kt-menu__link-text">CSV</span>
							</a>
						</li>
						<li class="kt-menu__item" aria-haspopup="true">
							<a href="<?php echo SURL; ?>login/log_out" class="kt-menu__link ">
								<i class="kt-menu__link-icon fa fa-sign-out"></i>
								<span class="kt-menu__link-text">Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<!-- end:: Aside Menu -->
		</div>

		<!-- end:: Aside -->
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

			<!-- begin:: Header -->
			<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

				<!-- begin: Header Menu -->
				<button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
				<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
					<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
					</div>
				</div>

				<!-- end: Header Menu -->

				<!-- begin:: Header Topbar -->
				<div class="kt-header__topbar">

					<!--begin: Search -->

					<!--begin: Search -->
					<div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
						<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
							<span class="kt-header__topbar-icon">
								<i class="flaticon2-search-1"></i>
							</span>
						</div>
						<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
							<div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
								<form method="get" class="kt-quick-search__form">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
										<input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
										<div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
									</div>
								</form>
								<div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">
								</div>
							</div>
						</div>
					</div>

					<!--end: Search -->

				<!-- end:: Header Topbar -->
			</div>

			<!-- end:: Header -->
		</div>
