<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
  <!-- begin:: Subheader -->
  <div class="kt-subheader kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
      <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
          Manage Meta Tag </h3>
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
            Manage Meta Tag
          </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
          <div class="kt-portlet__head-wrapper">
            <a href="<?php echo SURL."setting/add_meta_tag/" ?>" class="btn btn-brand btn-sm btn-pill" data-toggle="kt-tooltip" data-skin="dark" title="New Email Template">
              <i class="flaticon2-plus"></i>
              New Meta Tag
            </a>
          </div>
        </div>
      </div>
      
    </div>
    <div class="kt-portlet kt-portlet--mobile">
      <div class="kt-portlet__body">
        <div class="table-responsive">
          <table class="table table-hover table-striped dataTable_callajax">
            <thead>
              <tr>
                <th>#</th>
                <!-- <th>Image</th> -->
                <th>Page</th>
                <th>Meta Title</th>
                <th>Title</th>
                <th>Meta Description</th>
                <th>Created Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $i = ($this->uri->segment(3) == '') ? 1 : ($this->uri->segment(3) - 1) * 50 + 1;
              foreach ($meta_tag_arr as $key => $value) { ?>
                <tr class="meta_tag_list_row" id="<?php echo $value['_id'];?>">
                  <td><?=$i?></td>
                  <td class="meta_tag_page"><?=ucfirst($value['page']);?></td>
                  <td class="meta_tag_title"><?=ucfirst($value['title']);?></td>
                  <td class="meta_tag_title_name"><?=ucfirst($value['title_name']);?></td>
                  <td class="meta_tag_description"><?=$value['description'];?></td>
                  <td><?=convert_mongo_date($value['created_date']);?></td>
                  <td> 
                    <button class="btn btn-label-primary btn-pill btn-sm btn-icon edit_meta_tag" data-toggle="kt-tooltip" title="Edit <?php echo $value['title']; ?>" data-skin="dark">
                    <i class="fa fa-edit"></i>
                    </button>
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


<!--begin::Modal-->
<div class="modal fade" id="edit_tag_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Meta Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 form-group">
            <label>Page</label>
            <select name="page_id_upd" class="form-control page_id_upd" id="page_id_upd">
              <option value="home-men"> Home Men</option>
              <option value="home-women"> Home Women</option>
              <option value="about_us"> About Us </option>
              <option value="blog"> Blog </option>
              <option value="shop"> Shop </option>
              <option value="sign-in"> Sign-in </option>
              <option value="sign-up"> Sign-up </option>
              <option value="designers"> Designers </option>
              <option value="contact-us"> Contact-us </option>
              <option value="about-us"> About-us </option>
              <option value="news"> News </option>
              <option value="fashion-week"> Fashion-week </option>
              <option value="help"> Help </option>
              <option value="product"> Product </option>
              <option value="wishlist"> Wishlist </option>
              <option value="custom-pages"> Custom-pages </option>
              <option value="custom-pages"> Compare </option>
            </select>
          </div>
        </div>
        <div class="row">
          <!-- Menu Title -->
          <div class="form-group col-md-12">
            <label>Meta Title</label>
            <input id="menu_title_upd" type="text" name="menu_title_upd" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <!-- Menu Title -->
          <div class="form-group col-md-12">
            <label>Title</label>
            <input id="menu_title_name_upd" type="text" name="menu_title_name_upd" class="form-control" required>
          </div>
        </div>
        <div class="row">
          <!-- Menu Description -->
          <div class="form-group col-md-12">
            <label>Meta Description</label>
            <input id="menu_description_upd" type="text" name="menu_description_upd" class="form-control" required>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="tag_id_upd" id="tag_id_upd">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_meta_tag_details" id="update_meta_tag_details">Save changes</button>
      </div>
    </div>
  </div>
</div>
