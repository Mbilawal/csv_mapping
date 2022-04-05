<div class="nabg_nps">  
</div>
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-plus"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Mapping CSV
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="custom-container">
            	<div class="three_colms addqacont">
                    <div class="row">  
                        <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-offset-0 col-xs-12 addqacont_iner">
                            <div class="col_cus_dgn" style="min-height: 600px;">
                                <form id="upd_qa_admin_frm" action="" method="post">
                                    <?php
            				        if($this->session->flashdata('err_message')){ ?>

                            			<div class="alert alert-danger">
                            			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            			    <?php echo $this->session->flashdata('err_message'); ?>
                            			</div>
            			                <?php
            				        }
            				        if($this->session->flashdata('ok_message')){ ?>

                            			<div class="alert alert-success alert-dismissable">
                            			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            			    <?php echo $this->session->flashdata('ok_message'); ?>
                            			</div>
            			                <?php 
            			            }
            			            ?>
                        
                                    <div class="hd_short_border_botm">
                                    	<!-- <h3>Duplication Check</h3> -->
                                    </div>
                                    <div class="col_cus_bd">
                                    	
                                    </div>
                                    <div class="hd_short_border_botm">
                                    	<h3>Map CSV Fields</h3>
                                    </div>
                                    <div class="col_cus_bd">
                                    	<ul class="bdy_RightLeft">
                                            <?php 
                        					if(count($csv_fields)>0){
                        					    for($i=0; $i<count($csv_fields); $i++){

                                                    if($csv_fields[$i] !=""){
                        				            ?>
                                                    <li>

                                                        <div class="col-md-8 form-group">
                                                            <label><?php echo $csv_fields[$i];?></label>
                                                            <div class="col-lg-9 col-xl-9"> 
                                                                <select name="lead_fields[]" class="select2 form-control lead_fields">
                                                                    <option value="0">Ignore</option>
                                                                    <option value="home_phone">Phone</option>
                                                                    <option value="email">Email</option>
                                                                    <option value="first_name">First Name</option>
                                                                    <option value="last_name">Last Name</option>
                                                                    <option value="address">Address</option>
                                                                    <option value="postal_code">Postal Code</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                    }
                                                }
                                            } 
                                            ?>
                                            <li>
                                                <div class="BodyLeftSide">&nbsp;</div>
                                                <div class="BodyRightSide"> 
                                                    <button type="submit" class="btn btn-info btn_withoutIcon pull-right">Save</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <input type="hidden" name="file_name_path" value="<?php echo $file_name_path;?>" />
                                    <input type="hidden" name="file_name" value="<?php echo $file_name;?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal_csv_progress_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CSV Upload Status</h4>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="custom-container">
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" id="csv_progressbar"   style="width:0%">
                        0%
                      </div>
                    </div>
                    <br/>
                    <label style="color:#72b572;" ><span id="total_csv_leads" >0</span> Contacts are found in csv</label><br />
                    <label style="color:#72b572;"><span id="total_processed_records" >0</span> Contacts are processed</label><br />
                    <label style="color:#72b572;"><span id="total_empty_phone" >0</span> Empty phone number in csv</label><br />
                    <label style="color:#72b572;"><span id="total_new_leads" >0</span> Contacts are new uploaded</label><br />
                    <label style="color:#72b572;"><span id="all_duplicates" >0</span> Duplicates are found</label><br />
                    <label style="color:#72b572;"><span id="total_duplicate_records" >0</span> Duplicate are uploaded</label>
                </div>
            </div>
        </div>
        <!-- Modal content-->
    
    </div>
</div>
<!-- End Modal -->



