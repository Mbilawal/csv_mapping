<style type="text/css">
	span.kt-switch.kt-switch--default{
		margin:0 27px 0 -10px;
	}
	.kt-media.kt-media--xl img{
		background: #eee;
	}
</style>
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
						Global Setting </a>
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
						Global Setting
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form class="kt-form" name="add_new_setting" method="post" enctype="multipart/form-data" action="<?=SURL?>setting/save_global_settings">
					<div class="row">
						<div class="form-group row col-md-12">
							<label class="col-3 col-form-label">Allow Country Change</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_country_change'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_country_change">
										<input type="hidden" name="allow_country_change" value="<?= $global_setting['allow_country_change'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
							<label class="col-3 col-form-label">Allow Currency Change</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_currency_change'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_currency_change">
										<input type="hidden" name="allow_currency_change" value="<?= $global_setting['allow_currency_change'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="form-group row col-md-12">
							<label class="col-3 col-form-label">Allow Shopping Cart</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_shopping_cart'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_shopping_cart">
										<input type="hidden" name="allow_shopping_cart" value="<?= $global_setting['allow_shopping_cart'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
							<label class="col-3 col-form-label">Allow Account Block</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_account_block'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_account_block">
										<input type="hidden" name="allow_account_block" value="<?= $global_setting['allow_account_block'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group row col-md-12">
							<label class="col-3 col-form-label">Allow Messaging</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_message'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_message">
										<input type="hidden" name="allow_message" value="<?= $global_setting['allow_message'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
							<label class="col-3 col-form-label">Allow Feedback</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_feedback'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_feedback">
										<input type="hidden" name="allow_feedback" value="<?= $global_setting['allow_feedback'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group row col-md-12">
							<label class="col-3 col-form-label">Allow Fashion Week</label>
							<div class="col-3">
								<span class="kt-switch kt-switch--default">
									<label>
										<input type="checkbox" <?= $global_setting['allow_fashion_week'] == 'on' ? 'checked="checked"' : '' ?> data-type="allow_fashion_week">
										<input type="hidden" name="allow_fashion_week" value="<?= $global_setting['allow_fashion_week'] == 'on' ? 'on' : 'off' ?>">
										<span></span>
									</label>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 form-group">
							<h5>Logo</h5>
							<input type="file" id="siteLogoInp">
							<input type="hidden" name="site_logo" id="siteLogo" value="<?=$global_setting['site_logo']?>" class="form-control">
							<br><br>
							<a href="javascript:;" class="kt-media kt-media--xl kt-media--circle">
								<img alt="image" id="siteLogoView" src="<?=$global_setting['site_logo']?>">
							</a>
						</div>

						<div class="col-md-3 form-group">
							<h5>Copyright</h5>
							<input type="text" name="copyright_text" id="copyright_text" value="<?=$global_setting['copyright_text']?>" class="form-control">
						</div>

						<div class="col-md-3 form-group">
							<h5>Custom Offer</h5>
							<input type="text" name="custom_offer" id="custom_offer" value="<?=$global_setting['custom_offer']?>" class="form-control">
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 form-group">
							<h5>Section one</h5>
						</div>
						<div class="col-md-4 form-group">
							<h5>Section two</h5>
						</div>
						<div class="col-md-4 form-group">
							<h5>Section three</h5>
						</div>

						<?php 
						$zz = 1;
						foreach ($global_setting['top_offer'] as $data){ ?>
							<div class="col-md-2 form-group">
								<h5>Bg color</h5>
								<input type="text" name="s<?php echo $zz; ?>_bg_color" id="s<?php echo $zz; ?>_bg_color" value="<?=$data['bgcolor']?>" class="form-control">
							</div>
							<div class="col-md-2 form-group">
								<h5>Front color</h5>
								<input type="text" name="s<?php echo $zz; ?>_fr_color" id="s<?php echo $zz; ?>_fr_color" value="<?=$data['color']?>" class="form-control">
							</div>
							<?php
							$zz++;
						} ?>
						<div class="col-md-8 form-group">
							<label>Shop Men Contents</label>
              				<textarea name="shop_men_content" class="form-control" rows="4"><?=$global_setting['shop_men_content']?></textarea>
						</div>
						<div class="col-md-2 form-group">
							<label>Display</label>
              				<select name="shop_men_content_status" class="select2 form-control">
								<option value="1" <?= $global_setting['shop_men_content_status'] == '1' ? 'selected' : ''  ?> > Show </option>
								<option value="0" <?= $global_setting['shop_men_content_status'] == '0' ? 'selected' : ''  ?> > Hide </option>
							</select> 		
						</div>

						<div class="col-md-8 form-group">
							<label>Shop Women Contents</label>
							<textarea name="shop_women_content" class="form-control" rows="4"><?=$global_setting['shop_women_content']?></textarea>
						</div>
						<div class="col-md-2 form-group">
							<label>Display</label>
              				<select name="shop_women_content_status" class="select2 form-control">
								<option value="1" <?= $global_setting['shop_women_content_status'] == '1' ? 'selected' : ''  ?> > Show </option>
								<option value="0" <?= $global_setting['shop_women_content_status'] == '0' ? 'selected' : ''  ?> > Hide </option>
							</select> 		
						</div>

						<div class="col-md-8 form-group">
							<label>Manual Shop</label>
							<textarea name="manual_shop" class="form-control" rows="4"><?=$global_setting['manual_shop']?></textarea>
						</div>

						<div class="col-md-12 form-group text-right">
							<button type="submit" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-check"></i>Save</button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>
	</div>
	<!-- end:: Content -->
</div>