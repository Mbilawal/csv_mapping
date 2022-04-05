<style type="text/css">
	.btn{
		font-size: 11px;
	}
	input[type="radio"], input[type="checkbox"]{
		width: 20px;
		height: 20px;
	}
	tr#bulk_changes_div{
		border: 1px solid #eee;
	   
	}
	.newsylecss{
	    background-image: repeating-linear-gradient(135deg,#f04b51,#f04b51 24px,#f2545b 0,#f2545b 48px);
	    color: #fff;
	    border-radius: 5px;
	}

</style>
<style type="text/css">
    .fltrblk-match-text {
        display: block;
        position: relative;
        width: 100%;
    }
    .fltrblk-match-text .fltrblk-match-text__input--xxl, .fltrblk-match-text .fltrblk-match-text__placeholder--xxl {
        font-size: 32px;
        /*line-height: 40px;*/
        /*padding: 16px;*/
    }
    .fltrblk-match-text .fltrblk-match-text__placeholder {
        border-color: transparent;
        color: #7c98b6;
        display: block;
        position: relative;
        word-wrap: break-word;
        text-transform: uppercase;
    }

    .fltrblk-form__control {
        /*padding: 9px 10px;*/
        border-radius: 3px;
        border: 1px solid #cbd6e2;
        font-size: 16px;
        transition: all .15s ease-out;
        background-color: #f5f8fa;
        color: #33475b;
        display: block;
        height: 40px;
        line-height: 22px;
        text-align: left;
        vertical-align: middle;
        width: 100%;
    }
    .fltrblk-match-text .fltrblk-match-text__input {
        background: transparent;
		display: block;
		left: 0;
		position: absolute;
		top: 0;
		width: 100%;
		text-transform: uppercase;
    }

    #no_of_bulk_contacts {
     	text-transform: uppercase;
    }
    .fltrblk-text-area--no-resize {
        display: inline-block;
        resize: none;
    }
    .fltrblk-text-area {
        height: auto;
        min-height: 40px;
    }
    .loadinghehe{
        display: table !important;
        position: relative !important;
        min-height: 200px;
        min-width: 100%;
    }
    .loadinghehe .loader-img22 > img {
        top: 200px !important;
    }
    .radio label, .checkbox label {
        min-height: 20px;
        padding-left: 5px;
    }
    .toggle-off.btn {
        padding-left: 20px;
    }
</style>

<style>
    .fanci_mod .modal-header h4 {
        color:#000;
        font-size: 36px;
        line-height: 1;
        padding: 20px 0 0;
    }
    .fanci_mod .modal-header {
        text-align: center;
    }
    .cal_cent_radio_main {
        float: left;
        width: 100%;
    }
    .ccrm_radiobn {
        float: left;
        width: 100%;
        padding: 15px 15px 15px 55px;
        position: relative;
    }
    .ccrm_radiobn_sec {
        position: absolute;
        height: 17px;
        width: 17px;
        margin: auto;
        top: -3px;
        left: 16px;
        bottom: 0;
    }
    .fanci_mod .modal-footer {
        text-align: center;
        padding-bottom: 14px;
    }
    .fanci_mod .modal-footer .btn {
        padding: 10px 35px;
    }
    .fanci_mod .modal-footer .btn.mod-green-btn {
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#74b41e+0,168bc5+100 */
        background: rgb(116,180,30); /* Old browsers */
        background: -moz-linear-gradient(-45deg,  rgba(116,180,30,1) 0%, rgba(22,139,197,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg,  rgba(116,180,30,1) 0%,rgba(22,139,197,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg,  rgba(116,180,30,1) 0%,rgba(22,139,197,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#74b41e', endColorstr='#168bc5',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        color: #fff;
    }
    .fanci_mod .modal-footer .btn.mod-gray-btn {
        /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#666666+0,353535+100 */
        background: rgb(102,102,102); /* Old browsers */
        background: -moz-linear-gradient(-45deg,  rgba(102,102,102,1) 0%, rgba(53,53,53,1) 100%); /* FF3.6-15 */
        background: -webkit-linear-gradient(-45deg,  rgba(102,102,102,1) 0%,rgba(53,53,53,1) 100%); /* Chrome10-25,Safari5.1-6 */
        background: linear-gradient(135deg,  rgba(102,102,102,1) 0%,rgba(53,53,53,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#666666', endColorstr='#353535',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
        color: #fff;
    }
    .ccrm_radiobn .deals_items {
        margin-bottom: 0;
    }
    input.secsy_radio {
        width: 100%;
        height: 100%;
        z-index: 2;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }
    span.secsy_radio_span {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        border-radius: 50%;
        z-index: 1;
        border: 2px solid #808080;
    }
    input.secsy_radio:checked + .secsy_radio_span {
        background: #808080;
    }
    .fanci_mod .modal-body > p {
        font-size: 22px;
        color: #000;
    }
    .fanci_mod .modal-footer .btn.mod-white-btn {
        background: #fff;
        border-right: 2px solid #ccc;
        border-left: 2px solid #ccc;
        border-radius: 6px;
    }
    @media(max-width:480px){
        .fanci_mod .modal-header h4 {
            font-size: 22px;
        }
        .fanci_mod .modal-header h4 img {
            width: 60px;
        }
        .fanci_mod .modal-footer .btn {
            width: 60%;
            margin-bottom: 10px;
        }   
    }
</style>
<div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
	
	<!-- begin:: Content -->
	<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 order-lg-6 order-xl-6">
				<div class="kt-portlet__body">
					<div class="kt-portlet kt-portlet--mobile">
						<div class="kt-portlet__head kt-portlet__head--lg">
							<div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
									<i class="kt-font-category flaticon2-line-chart"></i>
								</span>
								<h3 class="kt-portlet__head-title">
									Manage Cron Job List
								</h3>
							</div>
							<div class="kt-portlet__head-toolbar">
								<div class="kt-portlet__head-wrapper">
									
								</div>
							</div>
						</div>
						<div class="kt-portlet__body">
							<div class="table-responsive">
								<table class="table table-hover table-striped dataTable_callajax">
									<thead>
										<tr id="bulk_changes_div" class="newsylecss">
											<th>Sr#1</th>
											<th>Name</th>
											<th>Collection Record</th>
											<th>Action</th>
										</tr>						
									</thead>
									<tbody>
										<tr class="category_list_row">
											<td>1</td>
			                                <td class="category_list_row_child">Remove Products Collection</td>
											<td><?= number_format(round(count_collection('catwalker_products'),2)) ?></td>
											<td class="category_list_row_brand">
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="products" title="<b>Remove Products Collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="category_list_row">
											<td>2</td>
			                                <td class="category_list_row_child">Remove Products Price Collection</td>
			                                <td><?= number_format(round(count_collection('catwalker_product_prices'),2)) ?></td>
											<td class="category_list_row_brand">
												
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top"  data_id="product_price" title="<b>Remove Products Price Collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="category_list_row">
											<td>3</td>
			                                <td class="category_list_row_child">Remove Category Collection</td>
											<td><?= number_format(round(count_collection('catwalker_categories'),2)) ?></td>
											<td class="category_list_row_brand">
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top"  data_id="category" title="<b>Remove Category Collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="category_list_row">
											<td>4</td>
			                                <td class="category_list_row_child">Remove Category Detail collection</td>
											<td><?= number_format(round(count_collection('catwalker_categories_detail'),2)) ?></td>
											<td class="category_list_row_brand">
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top"  data_id="category_detail" title="<b>Remove Category Detail collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="category_list_row">
											<td>7</td>
			                                <td class="category_list_row_child">Remove Brand collection</td>
											<td><?= number_format(round(count_collection('catwalker_brands'),2)) ?></td>
											<td class="category_list_row_brand">
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top"  data_id="brand" title="<b>Remove Brand collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
										<tr class="category_list_row">
											<td>8</td>
			                                <td class="category_list_row_child">Remove Shop collection</td>
											<td><?= number_format(round(count_collection('catwalker_shops'),2)) ?></td>
											<td class="category_list_row_brand">
												<button class="btn btn-danger btn-sm btn-icon btn-pill newclckhvr" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top"  data_id="shop" title="<b>Remove Shop collection</b>">
													<i class="fas fa-trash"></i>
												</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 order-lg-6 order-xl-6">
				<div class="kt-portlet__body">
				
					<!-- begin:: Content -->
					<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
						
						<div class="kt-portlet kt-portlet--mobile">
							<div class="kt-portlet__head kt-portlet__head--lg">
								<div class="kt-portlet__head-label">
									<span class="kt-portlet__head-icon">
										<i class="kt-font-category flaticon2-line-chart"></i>
									</span>
									<h3 class="kt-portlet__head-title">
										Manage Importing Script
									</h3>
								</div>
								<div class="kt-portlet__head-toolbar">
									<div class="kt-portlet__head-wrapper">
										
									</div>
								</div>
							</div>
							<div class="kt-portlet__body">
								<div class="table-responsive">
									<table class="table table-hover table-striped dataTable_callajax">
										<thead>
											<tr id="bulk_changes_div" class="newsylecss">
												<th>Sr#1</th>
												<th>Name</th>
												<th>Action</th>
											</tr>						
										</thead>
										<tbody>
											<tr class="category_list_row">
												<td>1</td>
				                                <td class="category_list_row_child">Cache Clear</td>
												<td class="category_list_row_brand">
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Cache Clear">
														<a target="_blank" style="color:#fff" title="Child Category" href="https://24urbanshop.com/clearcache">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>
											<tr class="category_list_row">
												<td>2</td>
				                                <td class="category_list_row_child">Importing Data</td>
												<td class="category_list_row_brand">	
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Importing Data">
														<a target="_blank" style="color:#fff" title="Child Category" href="https://24urbanshop.com/storeMenuData">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>
											<tr class="category_list_row">
												<td>3</td>
				                                <td class="category_list_row_child">Update Product Count In Categories</td>
												<td class="category_list_row_brand">	
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Importing Data">
														<a target="_blank" style="color:#fff" title="Update Count Product" href="<?= SURL ?>update_table/update_count_product">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>
											<tr class="category_list_row">
												<td>4</td>
				                                <td class="category_list_row_child">Create Collections Indexing</td>
												<td class="category_list_row_brand">	
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Importing Data">
														<a target="_blank" style="color:#fff" title="Indexing Collection" href="<?= SURL ?>setting/create_indexing">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>

											<tr class="category_list_row">
												<td>5</td>
				                                <td class="category_list_row_child">Update Shop Time Sorting</td>
												<td class="category_list_row_brand">	
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Shop Time Sort">
														<a target="_blank" style="color:#fff" title="Shop Time Sort" href="<?= SURL ?>update_table/Update_shop_time_sorting">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>

											<tr class="category_list_row">
												<td>6</td>
				                                <td class="category_list_row_child">Update Product Color Hexa Format</td>
												<td class="category_list_row_brand">	
													<button class="btn btn-success btn-sm btn-icon btn-pill" data-toggle="kt-tooltip" data-html="true" data-skin="dark" data-placement="top" data_id="" title="Update Color">
														<a target="_blank" style="color:#fff" title="Shop Time Sort" href="<?= SURL ?>update_table/color_convert">
															<i class="fa fa-tag"></i>
														</a>
													</button>
												</td>
											</tr>

											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- end:: Content -->

				</div>
			</div>
		</div>
	</div>
	<!-- end:: Content -->
</div>

<!-- Modal -->
<div id="myModal_nwfltr" class="modal fade" role="dialog">
    <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content" id="response_bulk_type_data">

    	<div class="modal-header newsylecss">
            <h4 class="modal-title" id="titledivbulk"><b>Permanently delete collection?</b> <br><p><small style="color: #ffd2d2;">Use the text field below to confirm the number of record you want to delete.</small></p></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
	        <div class="row">
            	<div class="col-xl-2 col-md-2"></div>
            	<div class="col-xl-8 col-xl-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0 col-xs-12 col-xs-offset-0">
            		<div class="fltrblk-match-text">
            			<input type="hidden" id="no_of_bulk_contacts" value="">
            			<input type="hidden" id="bulk_match_validate" value="">
		        		<label class="form-control fltrblk-form__control fltrblk-match-text__placeholder fltrblk-match-text__placeholder--xxl" style="height: 74px;">Bilawal</label>
		        		<textarea id="confirm_delete_count" class="form-control fltrblk-form__control fltrblk-text-area fltrblk-match-text__input fltrblk-match-text__input--xxl fltrblk-text-area--no-resize" style="height: 74px;"></textarea>
		        	</div>
            	</div>
            </div>
        </div>
        <div id="just_chill"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger bulk_update_btn" data-type="delete" id="confirm_bulk_delete_btn" disabled>Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- Modal content-->

    </div>
</div>
<!-- END  Modal --> 