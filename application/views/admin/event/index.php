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
                    <div class="product-status-wrap drp-lst">
                        <h4>Event List </h4>
                        <?php if(!empty($this->session->flashdata('msg'))){ ?>  
                        <div class="alert alert-info" role="alert">
                            <strong><?php echo $this->session->flashdata('msg'); ?> </strong>
                        </div>
                        <?php } ?>
                        <div class="add-product">
                            <a href="<?php echo base_url() ?>admin/event/add_event">Add Event</a>
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
                                        <th>Event Name</th>
                                        <th>Event Location</th>
                                        <th>Event Date</th>
                                        <th>Event Image</th>
                                        <th>Actions</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                      foreach ($events as $event) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $event->event_heading; ?></td>
                                            <td><?php echo $event->event_location; ?></td>
                                            <td><?php echo $event->select_date; ?></td>
                                            <td><img src="<?php echo '/includes/img/event/'.$event->event_image; ?>" alt=""></td> 
                                            <td>
                                                <a href="<?php echo base_url() ?>admin/event/event_edit/<?php echo $event->event_id; ?>" data-toggle="tooltip" title=""  class="pd-setting-ed" data-original-title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="<?php echo base_url() ?>admin/event/event_del/<?php echo $event->event_id; ?>" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure to delete?')" class="pd-setting-ed" data-original-title="Trash"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody></table>
                        </div>
                        <div class="custom-pagination">
                            <nav aria-label="Page navigation example">
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
<!--                        <div class="row">
                            <?php // if ($total_rows > $per_page) { ?>
                                <div class="col-sm-5 hidden-xs">
                                    <div class="dataTables_info" id="ecom-products_info" role="status" aria-live="polite">
                                        <strong><?php // echo ((($curr_page - 1) * $per_page) + 1); ?></strong>
                                        <strong><?php // echo ($curr_page * $per_page); ?></strong> of 
                                        <strong><?php // echo $total_rows; ?></strong>
                                    </div>
                                </div>
                            <?php // } ?>
                            <div class="col-sm-7 col-xs-12 clearfix">
                                <div class="dataTables_paginate paging_bootstrap" id="ecom-products_paginate">
                                    <?php // echo $links; ?>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>