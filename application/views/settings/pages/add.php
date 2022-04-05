<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	<!-- begin:: Subheader -->
	<div class="kt-subheader   kt-grid__item" id="kt_subheader">
		<div class="kt-container  kt-container--fluid ">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
					Pages </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<a href="javascript:;" class="kt-subheader__breadcrumbs-link">
						<?= ($EDIT == 'true' ? 'Edit' : 'New') ?> Page </a>
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
						<?= ($EDIT == 'true' ? 'Edit' : 'New') ?> Page
					</h3>
				</div>
			</div>
			<div class="kt-portlet__body">
				<!-- Form Starts Here -->
				<form action="<?= SURL ?>setting/<?= ($EDIT == 'true' ? 'edit-page-process' : 'add-page-process') ?>/" name="add_new_page" method="post" enctype="multipart/form-data">
					<?php
					if ($page_data['name'] == 'header') {
					?>
						<h4 class="text-info form-group">Top Header</h4>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Name</label>
								<input type="text" name="page_name" class="form-control page_name" id="page_name" required value="<?= $page_data['name'] ?>" disabled="disabled">
							</div>
							<div class="col-md-8 form-group">
								<label>Description</label>
								<textarea name="page_desc" class="form-control page_desc" id="summernote">
									<?= $page_data['desc'] ?>
								</textarea>
							</div>
							<div class="col-md-3 form-group">
								<label>Status</label>
								<select name="page_status" class="form-control page_status" id="page_status" required value="<?= $page_data['status'] ?>">
									<option value="show">Show</option>
									<option value="hide">Hide</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>Background Color</label>
								<input type="color" name="page_bgcolor" class="form-control page_bgcolor" id="page_bgcolor" value="<?= $page_data['bgcolor'] ?>">
							</div>
							<div class="col-md-3 form-group">
								<label>Font Color</label>
								<input type="color" name="page_fontcolor" class="form-control page_fontcolor" id="page_fontcolor" value="<?= $page_data['fontcolor'] ?>">
							</div>
						</div>
						<br>
						<h6 class="text-info form-group">Header Items</h6>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Title</label>
								<input type="text" id="itemTitle" class="itemTitle form-control">
							</div>
							<div class="col-md-4 form-group">
								<label>Link</label>
								<input type="text" id="itemLink" class="itemLink form-control">
							</div>
							<div class="col-md-4 form-group">
								<a href="javascript:;" id="addItemToTable" class="btn btn-sm btn-icon btn-brand addItemToTable mt-4 btn-circle"><i class="fa fa-plus"></i></a>
							</div>
							<div class="col-md-6 form-group">
								<table class="table table-border">
									<thead>
										<th>Title</th>
										<th>Link</th>
										<th>Action</th>
									</thead>
									<tbody class="tableItems">
										<?php
										foreach ($page_data['items'] as $item) {
											?>
											<tr>
												<td><?=$item['title']?></td>
												<td><?=$item['link']?></td>
												<td>
													<a href="javascript:;" class="btn btn-sm btn-icon btn-label-danger deleteItem">
														<i class="fa fa-trash"></i>
													</a>
													<input type="hidden" name="page_items[]" value="<?=$item['title']?>;;<?=$item['link']?>">
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<hr><br>
						<h4 class="text-info form-group">Main Header</h4>
						<div class="row">
							<div class="col-md-3 form-group">
								<label>Background Color</label>
								<input type="color" name="page_bgcolor_mhead" class="form-control page_bgcolor_mhead" id="page_bgcolor_mhead" value="<?= $page_data['bgcolor_mhead'] ?>">
							</div>
							<div class="col-md-3 form-group">
								<label>Font Color</label>
								<input type="color" name="page_fontcolor_mhead" class="form-control page_fontcolor_mhead" id="page_fontcolor_mhead" value="<?= $page_data['fontcolor_mhead'] ?>">
							</div>
						</div>
						<hr><br>
						<h4 class="text-info form-group">Menu Bar</h4>
						<div class="row">
							<div class="col-md-3 form-group">
								<label>Background Color</label>
								<input type="color" name="page_bgcolor_menu" class="form-control page_bgcolor_menu" id="page_bgcolor_menu" value="<?= $page_data['bgcolor_menu'] ?>">
							</div>
							<div class="col-md-3 form-group">
								<label>Font Color</label>
								<input type="color" name="page_fontcolor_menu" class="form-control page_fontcolor_menu" id="page_fontcolor_menu" value="<?= $page_data['fontcolor_menu'] ?>">
							</div>
						</div>

						<hr><br>
						<h4 class="text-info form-group">Mobile Menu Bar</h4>
						<div class="row">
							<div class="col-md-3 form-group">
								<label>Background Color</label>
								<input type="color" name="mobile_page_bgcolor_menu" class="form-control mobile_page_bgcolor_menu" id="mobile_page_bgcolor_menu" value="<?= $page_data['mobile_bgcolor_menu'] ?>">
							</div>
							<div class="col-md-3 form-group">
								<label>Font Color</label>
								<input type="color" name="mobile_page_fontcolor_menu" class="form-control mobile_page_fontcolor_menu" id="mobile_page_fontcolor_menu" value="<?= $page_data['mobile_fontcolor_menu'] ?>">
							</div>
						</div>

						<h4>Top Second Banner</h4><br>
						<div class="row">
							<div class="col-md-12 form-group">
								<textarea class="form-control summernote" name="top_second_banner" id="top_second_banner" placeholder="Top Second Banner....."><?= stripcslashes($page_data['top_second_banner']) ?></textarea>
							</div>
						</div>

						<h4>Third Banner</h4><br>
						<div class="row">
							<div class="col-md-12 form-group">
								<textarea class="form-control summernote" name="page_third_banner" id="page_third_banner" placeholder="Third Banner....."><?= stripcslashes($page_data['page_third_banner']) ?></textarea>
							</div>
						</div>

						<h4>Fourth Banner</h4><br>
						<div class="row">
							<div class="col-md-12 form-group">
								<textarea class="form-control summernote" name="page_fourth_banner" id="page_fourth_banner" placeholder="Fourth Banner....."><?= stripcslashes($page_data['page_fourth_banner']) ?></textarea>
							</div>
						</div>
					<?php
					} elseif ($page_data['name'] == 'footer') {
					?>
						<div class="row">
							<div class="col-md-2 form-group">
								<label>Name</label>
								<input type="text" name="page_name" class="form-control page_name" id="page_name" required value="<?= $page_data['name'] ?>" disabled="disabled">
							</div>

							<div class="col-md-3 form-group">
								<label>Status</label>
								<select name="page_status" class="form-control page_status" id="page_status" required value="<?= $page_data['status'] ?>">
									<option value="show">Show</option>
									<option value="hide">Hide</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>Background Color</label>
								<input type="color" name="page_bgcolor" class="form-control page_bgcolor" id="page_bgcolor" value="<?= $page_data['bgcolor'] ?>">
							</div>
							<div class="col-md-3 form-group">
								<label>Font Color</label>
								<input type="color" name="page_fontcolor" class="form-control page_fontcolor" id="page_fontcolor" value="<?= $page_data['fontcolor'] ?>">
							</div>
							<div class="col-md-8 form-group">
								<label>Description</label>
								<textarea  type="text" name="page_desc" class="form-control page_desc summernote" id="page_desc"><?= $page_data['desc'] ?></textarea>
							</div>
						</div>
						<hr>
						<h4 class="text-info form-group">Footer Items</h4>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Section Name 1</label>
								<input type="text" name="section_name_1" class="section_name_1 form-control" value="<?= $page_data['section_name_1'] ?>" />
							</div>
							<div class="col-md-4 form-group">
								<label>Section Name 2</label>
								<input type="text" name="section_name_2" class="section_name_2 form-control" value="<?= $page_data['section_name_2'] ?>" />
							</div>
							<div class="col-md-4 form-group">
								<label>Section Name 3</label>
								<input type="text" name="section_name_3" class="section_name_3 form-control" value="<?= $page_data['section_name_3'] ?>" />
							</div>
							<div class="col-md-3 form-group">
								<label>Title</label>
								<input type="text" id="itemTitle" class="itemTitle form-control">
							</div>
							<div class="col-md-3 form-group">
								<label>Section</label>
								<select name="section" class="form-control section" id="section" required value="<?= $page_data['section'] ?>">
									<option value="1">Section 1</option>
									<option value="2">Section 2</option>
									<option value="3">Section 3</option>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>Link <span class="add_custom_link"  data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" title="<b>Add custom Link</b>">
											<i class="fa fa-edit"></i>
										</span></label>
								<select id="itemLink" class="itemLink form-control section">
									<?php
									foreach (get_filters('page_slug', 'pages', 500) as $pages_slug) { 
										if($pages_slug!=""){
										?>
										<option value="<?=$pages_slug?>"><?=ucfirst($pages_slug)?></option>
										<?php
										}
									} ?>	
								</select>
							</div>
							<div class="col-md-3 form-group">
								<a href="javascript:;" id="addItemToTable" class="btn btn-sm btn-icon btn-brand addItemToTable mt-4 btn-circle"><i class="fa fa-plus"></i></a>
							</div>
							<div class="col-md-6 form-group">
								<table class="table table-border">
									<thead>
										<th>Title</th>
										<th>Link</th>
										<th>Section</th>
										<th>Action</th>
									</thead>
									<tbody class="tableItems">
										<?php
										foreach ($page_data['items'] as $item) {
											?>
											<tr>
												<td><?=$item['title']?></td>
												<td><?=$item['link']?></td>
												<td><?=$item['section']?></td>
												<td>
													<a href="javascript:;" class="btn btn-sm btn-icon btn-label-danger deleteItem"><i class="fa fa-trash"></i></a>
													<input type="hidden" name="page_items[]" value="<?=$item['title']?>;;<?=$item['link']?>;;<?=$item['section']?>">
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php
					} elseif ($page_data['name'] == 'home men' || $page_data['name'] == 'home women') {
					?>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Name</label>
								<input type="text" name="page_name" class="form-control page_name" id="page_name" required value="<?= $page_data['name'] ?>" <?= ($EDIT == 'true' ? 'disabled="disabled"' : '') ?>>
							</div>
							<div class="col-md-3 form-group">
								<label>Status</label>
								<select name="page_status" class="form-control page_status" id="page_status" required value="<?= $page_data['status'] ?>">
									<option value="show">Show</option>
									<option value="hide">Hide</option>
								</select>
							</div>
						</div>
						<h4>Section #1</h4><br>
						<div class="row">
							<div class="col-md-12 form-group">
								<label>Description</label>
								<textarea class="form-control summernote" name="page_desc" id="page_desc" placeholder="Description....."><?= stripcslashes($page_data['desc']) ?></textarea>
							</div>
						</div>
						<h4>Section #2</h4><br>
						<div class="row">
							<div class="col-md-3 form-group">
								<label>Image</label>
								<input type="file" id="itemImageInp" class="itemImage form-control">
								<input type="hidden" name="itemImage" id="itemImage">
								<input type="hidden" name="section" id="section">
								<br><br>
								<a href="javascript:;" class="kt-media kt-media--xl kt-media--circle">
									<!-- <img alt="image" id="itemImageView" src=""> -->
								</a>
							</div>
							<div class="col-md-3 form-group">
								<label>Title</label>
								<input type="text" id="itemTitle" class="itemTitle form-control">
							</div>
							<div class="col-md-3 form-group">
								<label>Link</label>
								<input type="text" id="itemLink" class="itemLink form-control">
							</div>
							<div class="col-md-3 form-group">
								<a href="javascript:;" id="addItemToTable" class="btn btn-sm btn-icon btn-brand addItemToTable mt-4 btn-circle"><i class="fa fa-plus"></i></a>
							</div>
							
							<div class="col-md-6 form-group">
								<table class="table table-border">
									<thead>
										<th>Image</th>
										<th>Title</th>
										<th>Link</th>
										<th>Action</th>
									</thead>
									<tbody class="tableItems">
										<?php
										foreach ($page_data['items'] as $item) {
											?>
											<tr>
												<td>
													<a href="javascript:;" class="kt-media kt-media--xl kt-media--circle">
														<img alt="image" src="<?=$item['image']?>">
													</a>
												</td>
												<td><?=$item['title']?></td>
												<td><?=$item['link']?></td>
												<td>
													<a href="javascript:;" class="btn btn-sm btn-icon btn-label-danger deleteItem"><i class="fa fa-trash"></i></a>
													<input type="hidden" name="page_items[]" value="<?=$item['title']?>;;<?=$item['link']?>;;;;<?=$item['image']?>">
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					<?php
					} else {
					?>
						<div class="row">
							<div class="col-md-4 form-group">
								<label>Name</label>
								<input type="text" name="page_name" class="form-control page_name" id="page_name" required value="<?= $page_data['name'] ?>" <?= ($EDIT == 'true' ? 'disabled="disabled"' : '') ?>>
							</div>
							<div class="col-md-3 form-group">
								<label>Status</label>
								<select name="page_status" class="form-control page_status" id="page_status" required value="<?= $page_data['status'] ?>">
									<option value="show">Show</option>
									<option value="hide">Hide</option>
								</select>
							</div>
							<div class="col-md-12 form-group">
								<label>Description</label>
								<textarea class="form-control summernote" name="page_desc" id="page_desc" placeholder="Description....."><?= stripcslashes($page_data['desc']) ?></textarea>
							</div>
							<div class="col-md-12 form-group">
								<label>Css</label>
								<textarea class="form-control summernote" name="page_css" id="page_css" placeholder="css....."><?= stripcslashes($page_data['css']) ?></textarea>
							</div>
						</div>
					<?php
					}
					?>
					
					<div class="row">
						<div class="col-md-12 form-group text-right">
							<input type="hidden" name="page_id" value="<?= (string)$page_data['_id'] ?>">
							<button type="submit" id="add_new_page" name="submit" class="submit btn btn-success btn-sm"><i class="fa fa-<?= ($EDIT == 'true' ? 'check' : 'plus') ?>"></i><?= ($EDIT == 'true' ? 'Update' : 'Add') ?></button>
						</div>
					</div>
				</form>
				<!-- END Form -->
			</div>
		</div>

	</div>
	<!-- end:: Content -->
</div>


<!--begin::Modal-->
<div class="modal fade" id="add_custom_link_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">custom Link</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<!-- user Name -->
					<div class="form-group col-md-10">
						<label>Link</label>
						<input id="name_m" type="text" name="name_m" class="form-control name_m" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<input type="hidden" name="link_id_upd" id="link_id_upd" value="" />
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary add_custom_link_m" id="add_custom_link_m">Add</button>
			</div>
		</div>
	</div>
</div>