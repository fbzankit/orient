<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <form role="search" class="sr-input-func">
                                    <input type="text" placeholder="Search..." class="search-int form-control">
                                    <a href="#"><i class="fa fa-search"></i></a>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                </li>
                                <li><span class="bread-blod">All Students</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--</div>-->
    <!--</div>-->
    <div class="single-pro-review-area mt-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline12-list">
                        <div class="sparkline12-hd">
                            <div class="main-sparkline12-hd">
                                <h1>Add Category</h1>
                            </div>
                        </div>
                        <div class="sparkline12-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="all-form-element-inner" style="min-width: 400px;">
                                            <?php
                                            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add_$category');
//                                            if (isset($category['cat_name'])) {
//                                                echo form_open_multipart('admin/category/category_update', $attributes);
                                                ?>
                                                    <!--<input type="hidden" name="cat_id" value="<?php echo $category['cat_id']; ?>"-->
                                                <?php
//                                            } else {
                                                echo form_open_multipart('admin/category/add_category/'.$catIdUrl.'/'.$levelUrl.'', $attributes);
//                                            }
                                            ?>
                                            <div class="form-group-inner">
                                                <div class="row" style="margin-bottom: 5px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Parent Category</label>
                                                    </div>
                                                    <?php if (isset($category)) { ?>
                                                        <input type="hidden" name="parent_cat_id" value="<?php echo $category['cat_id']; ?>">
                                                        <input type="hidden" name="parent_cat_lvl" value="1">
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <p><strong><?php echo $category['cat_name']; ?></strong></p>
                                                        </div>
                                                    <?php } else {
                                                        ?>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <select name="parent_cat_id" class="form-control">
                                                                <option value="0" selected="">Select Parent Category</option>
                                                                <?php
                                                                                                                        
                                                                foreach ($categories as $category) { ?>
                                                                    <option value="<?php echo $category->cat_id ?>"><?php echo $category->cat_name ?></option>                                        
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                                <div class="row"  style="margin-bottom: 5px;">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Category Name</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="cat_name"  value="<?php
//                                                        if (isset($category->cat_name)) {
//                                                            echo $category->cat_name;
//                                                        }
                                                        ?>" placeholder="Enter Category Name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Category Image</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input name="cat_image"  class="" type="file">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                <button class="btn btn-white" type="submit">Cancel</button>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>