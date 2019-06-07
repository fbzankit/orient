
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
    <div class="product-status mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Library List</h4>
                        <div class="add-product">
                            <a href="<?php echo base_url() ?>admin/banner/add_banner">Add Banner</a>
                        </div>
                        <div class="asset-inner">
                            <table>
                                <tbody><tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Setting</th>
                                    </tr>
                                    <?php 
                                    $i = 1;
                                    foreach ($banners as $banner) { 
                                        
                                        ?>
                                        <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><img src="<?php echo '/includes/img/banner/'.$banner->image; ?>" alt=""></td>
                                        <td>
                                            <!-- <a href="<?php echo base_url() ?>admin/banner/banner_edit/<?php echo $banner->id; ?>" data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> -->
                                            <a href="<?php echo base_url() ?>admin/banner/banner_del/<?php echo $banner->id; ?>" data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; } ?>
                                    
                                </tbody></table>
                        </div>
<!--                        <div class="custom-pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>