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
                    <div class="product-payment-inner-st">
                        <ul id="myTabedu1" class="tab-review-design">
                            <?php if (!isset($product['Name'])) { ?>
                                <li class="active"><a href="javascript:void(0);">Add Product</a></li>
                            <?php } else { ?>
                                <li class="active"><a href="javascript:void(0);">Edit Product</a></li>
                            <?php } ?>

                            <?php if (!empty($this->session->flashdata('msg'))) { ?>
                                <div class="alert alert-info" role="alert">
                                    <strong><?php echo $this->session->flashdata('msg'); ?> </strong>
                                </div>
                            <?php } ?>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div id="dropzone1" class="pro-ad">
                                                <?php
                                                $attributes = array('class' => 'dropzone dropzone-custom needsclick add-professors dz-clickable', 'id' => 'add_product');
                                                if (isset($product['Name'])) {
                                                    echo form_open_multipart('admin/product/product_update', $attributes);
                                                    ?>
                                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>"
                                                    <?php
                                                } else {
                                                    echo form_open_multipart('admin/product/add_product', $attributes);
                                                }
                                                ?>
                                                       <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <?php if (isset($product['Name'])) { ?>
                                                            <div class="form-group">
                                                                <p><strong></strong></p>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="form-group" id="main-cat-div">
                                                                <select name="mainCatId" id="main-cat" class="form-control">
                                                                    <option value="none" selected="" disabled="">Select Category</option>
                                                                    <?php
                                                                    foreach ($categories as $category) {
                                                                        echo "<option value='" . $category->cat_id . "'>" . $category->cat_name . "</option>";
                                                                    }
                                                                    ?>                                                                    
                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="sub-cat-div">
                                                                <select name="subCatId"  id="sub-cat" class="form-control">
                                                                    <option value="none" selected="" disabled="">Select Sub Category</option>

                                                                </select>
                                                            </div>
                                                            <div class="form-group" id="sub-sub-cat-div">
                                                                <select name="catId" id="sub-sub-cat" class="form-control">
                                                                    <option value="none" selected="" disabled="">Select Sub Sub Category</option>

                                                                </select>
                                                            </div>
<!--                                                        <div class="form-group" id="sub-sub-sub-cat-div" style="visibility: none;">
                                                                <select name="catId1" id="catId" class="form-control">
                                                                    <option value="0" selected="" disabled="">Select Sub Sub Sub Category</option>

                                                                </select>
                                                            </div>-->
                                                        <?php } ?>
                                                        <div class="form-group">
                                                            <input name="name" type="text" value="<?php if (isset($product['Name'])) { echo $product['Name']; } ?>" class="form-control" placeholder="Product Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="itemCode" value="<?php if (isset($product['ItemCode'])) { echo $product['ItemCode']; } ?>" type="text" class="form-control" placeholder="Enter Item Code">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="product_qty" value="<?php if (isset($product['product_qty'])) { echo $product['product_qty']; } ?>" type="number" class="form-control" placeholder="Enter Product Quantity">
                                                        </div>
                                                        <?php
                                                        if (isset($product['Name'])) {
                                                            
                                                        } else {
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <?php } ?>

                                                        <div class="form-group">
                                                            <input name="gst" type="text"  value="<?php if (isset($product['GST'])) { echo $product['GST']; } ?>" id="getField" class="form-control" placeholder="Enter GST Val (%)">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="image" type="file" class="form-control" >
                                                            <?php if (isset($product['Image'])) {
//                                                                 print_r($product);die; 
                                                                 ?>
                                                            <input type="hidden" name="old_image" value="<?php echo $product['Image']; ?>">
                                                                
                                                            <?php } ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="number"  value="<?php if (isset($product['MasterPack'])) { echo $product['MasterPack']; } ?>" class="form-control" name="masterPack" placeholder="Enter Master Pack">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text"  value="<?php if (isset($product['weight'])) { echo $product['weight']; } ?>" class="form-control" name="weight" placeholder="Enter Weight">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="mrp"  value="<?php if (isset($product['MRP'])) { echo $product['MRP']; } ?>" id="mrp" type="text" class="form-control" placeholder="Enter Maximum Retail Price">
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="billingPrice"  value="<?php if (isset($product['BillingPrice'])) { echo $product['BillingPrice']; } ?>" id="billingPrice" type="text" class="form-control" placeholder="Enter Billing Price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="payment-adress">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
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
</div>
</div>