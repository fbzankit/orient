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
                                <li><span class="bread-blod"></span>
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
                    <div class="product-status-wrap drp-lst">
                        <h4>Sales Managers List</h4>
                        <?php if(!empty($this->session->flashdata('msg'))){ ?>
                        <div class="alert alert-info" role="alert">
                            <strong><?php echo $this->session->flashdata('msg'); ?> </strong>
                        </div>
                        <?php } ?>
                        <div class="add-product">
                            <a href="<?php echo base_url() ?>admin/sales_manager/add_sm/<?php echo $am_idd; ?>">Add Sales Manager</a>
                        </div>
                        <?php
                        echo "<div class='text-danger' align='center'>";
                        echo validation_errors();
                        echo "</div>";
                        ?> 
                        <div class="asset-inner">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Sales Manager Name</th>
                                        <th>Area manager Name</th>
                                        <!-- <th>Status</th> -->
                                        <th>Action</th>
                                    </tr>
                                    <?php
                                    $i = 1;

                                    
                                    foreach ($sales_managers as $key => $sales_manager) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="<?php echo base_url() ?>admin/executive/index/<?php echo $sales_manager->sm_id; ?>"><?php echo $sales_manager->sm_name; ?></a></td>
                                            <td><?php echo $sales_manager->sm_name; ?></td>
                                           <!--  <td>
                                                <?php if ($state->state_status == 'A') { ?>
                                                    <a href="<?php echo base_url() ?>admin/state/state_update_status/<?php echo $state->state_id; ?>/<?php echo 'I'; ?>" class="pd-setting">Active</a>
                                                <?php } elseif ($state->state_status == 'I') { ?>
                                                    <a href="<?php echo base_url() ?>admin/state/state_update_status/<?php echo $state->state_id; ?>/<?php echo 'A'; ?>" class="ds-setting">Disabled</a>
                                                <?php } ?>
                                            </td> -->
                                            <td>
                                                <a href="<?php echo base_url() ?>admin/sales_manager/sm_edit/<?php echo $sales_manager->sm_id; ?>" data-toggle="tooltip" title=""  class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="<?php echo base_url() ?>admin/sales_manager/sm_del/<?php echo $sales_manager->sm_id; ?>" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure to delete?')" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody></table>
                        </div>
                        <div class="custom-pagination">
                            <nav aria-label="Page navigation exsmple">
                                <ul class="pagination">
                                    <?php // echo $links; ?>
                                    <!--                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">Next</a></li>-->
                                </ul>
                            </nav>
                        </div>
                        <!-- <div class="row">
                            <?php if ($total_rows > $per_page) { ?>
                                <div class="col-sm-5 hidden-xs">
                                    <div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
                                        <strong><?php echo ((($curr_page - 1) * $per_page) + 1); ?></strong>
                                        <strong><?php echo ($curr_page * $per_page); ?></strong> of 
                                        <strong><?php echo $total_rows; ?></strong>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-sm-7 col-xs-12 clearfix">
                                <div class="dataTables_paginate paging_bootstrap" id="ecom-products_paginate">
                                    <?php // echo $links; ?>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>