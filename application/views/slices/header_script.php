<!--begin::Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
<!--end::Fonts -->
<!--begin::Page Vendors Styles(used by this page) -->
<!--end::Page Vendors Styles -->
<!--begin::Global Theme Styles(used by all pages) -->
<!--begin:: Vendor Plugins -->
<?php
if ($LOGIN_PAGE != 'true') {
?>
    <link href="<?php echo ASSETS ?>plugins/general/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo ASSETS ?>plugins/general/tether/dist/css/tether.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo ASSETS ?>plugins/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo ASSETS ?>plugins/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo ASSETS ?>plugins/general/select2/dist/css/select2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/nouislider/distribute/nouislider.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/owl.carousel/dist/assets/owl.carousel.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo ASSETS ?>plugins/general/owl.carousel/dist/assets/owl.theme.default.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php echo ASSETS ?>plugins/general/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php echo ASSETS ?>plugins/general/quill/dist/quill.snow.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="<?php echo ASSETS ?>plugins/general/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo ASSETS ?>plugins/general/summernote/dist/summernote.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/animate.css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/toastr/build/toastr.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/dual-listbox/dist/dual-listbox.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/morris.js/morris.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/sweetalert2/dist/sweetalert2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/general/socicon/css/socicon.css" rel="stylesheet" type="text/css" />
<?php
}
?>
<link href="<?php echo ASSETS ?>plugins/general/plugins/line-awesome/css/line-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/general/plugins/flaticon/flaticon.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/general/plugins/flaticon2/flaticon.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
<!--end:: Vendor Plugins -->
<link href="<?php echo ASSETS ?>css/style.bundle.css" rel="stylesheet" type="text/css" />
<!--begin:: Vendor Plugins for custom pages -->
<link href="<?php echo ASSETS ?>plugins/custom/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/@fullcalendar/core/main.css" rel="stylesheet" type="text/css" />
<?php
if ($LOGIN_PAGE != 'true') {
?>
    <!-- <link href="<?php echo ASSETS ?>plugins/custom/@fullcalendar/daygrid/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/custom/@fullcalendar/list/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS ?>plugins/custom/@fullcalendar/timegrid/main.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo ASSETS ?>plugins/custom/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo ASSETS; ?>highcharts/highcharts.css">
<?php
}
?>
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-rowreorder-bs4/css/rowReorder.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-scroller-bs4/css/scroller.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/datatables.net-select-bs4/css/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/jstree/dist/themes/default/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ASSETS ?>plugins/custom/jqvmap/dist/jqvmap.css" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo ASSETS ?>plugins/custom/uppy/dist/uppy.min.css" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo ASSETS ?>css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
<!--end:: Vendor Plugins for custom pages -->
<!--end::Global Theme Styles -->
<!--begin::Layout Skins(used by all pages) -->
<!--end::Layout Skins -->
<link rel="shortcut icon" href="<?php echo ASSETS ?>media/logos/favicon.ico" />
<link href="<?php echo ASSETS; ?>/css/pages/login/login-4.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo ASSETS ?>css/custom.css">

<!-- Image Uploader -->
<link href="<?php echo ASSETS ?>image_uploader_lib/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<link href="<?php echo ASSETS ?>image_uploader_lib/theme.css" media="all" rel="stylesheet" type="text/css"/>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4M23WY2BLT"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4M23WY2BLT');
</script>