<!-- Jquery Confirm -->
<link rel="stylesheet" href="https://callersiq.com/assets/css_front/jquery-confirm.min.css">

<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
  <!-- begin:: Subheader -->
  <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          Page Item </h3>
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
            <i class="kt-font-brand flaticon2-line-chart"></i>
          </span>
          <h3 class="kt-portlet__head-title">
            Manage Page Item
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            
          </div>
        </div>
      </div>
      
    </div>
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
          <span class="kt-portlet__head-icon">
            
          </span>
          <h3 class="kt-portlet__head-title">
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <strong class="pull-right">Total Page Item# <?=count($item_data);?></strong>
          </div>
        </div>
      </div>

      <div class="kt-portlet__body">
        <div class="table-responsive">
          <table class="table table-hover table-striped dataTable_callajax">
            <thead>
              <tr>
                <th>#</th>
                <!-- <th>Image</th> -->
                <th>Title</th>
                <th>Link</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = ($this->uri->segment(3) == '') ? 1 : ($this->uri->segment(3) - 1) * 50 + 1;
              foreach ($item_data as $key => $value) { ?>
                <tr class="product_list_row" id="<?php echo $value['_id'];?>">
                  <td><?=$i?></td>
                  <td><?=ucfirst($value['title']);?></td>
                  <td><?=$value['link'];?></td>
                  <td>
                    <a target="_self" href="<?=SURL;?>setting/edit_page_item/<?=$value['title'];?>" class="btn-sm btn-link btn-label-danger"><i class="fa fa-edit"></i></a> 
                  </td>
                </tr>
                <?php
                $i++;
              }
              ?>
            </tbody>
          </table>
        </div>
        <?php
        if ($page_links) {
          ?>
          <div class="kt-pagination kt-pagination--success">
            <?=$page_links?>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
  <!-- end:: Content -->
</div>
