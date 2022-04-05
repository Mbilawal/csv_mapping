<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE9)|!(IE)]><!-->
<html xmlns="https://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->
<head>
<!-- Basic Page Needs -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title><?php echo $title; ?></title>
<!-- Mobile Specific Metas -->
<?php if(!empty($header_script)){ echo $header_script; } //header slice ?>
<!--[if lt IE 9]>
        <script src="javascript/html5shiv.js"></script>
        <script src="javascript/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	html, body {
    		font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    	}
    </style>
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
<?php if(!empty($header)){ echo $header; } //header slice ?>
<?php if(!empty($content)){ echo $content; } //content ?>
<?php if(!empty($footer)){ echo $footer; } //footer slice ?>
<?php if(!empty($footer_script)){ echo $footer_script; } //footer_script slice ?>
<?php if(!empty($custom_script)){ echo $custom_script; } //footer_script slice ?>
</body>
</html>