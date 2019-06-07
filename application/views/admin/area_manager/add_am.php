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
                                <li><span class="bread-blod">Area Manager</span>
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
                                <h1>Add Area Manager</h1>
                               
                            </div>
                        </div>
                         <?php
                                echo "<div class='text-danger' align='center'>";
                                echo validation_errors();
                                echo "</div>";
                                ?> 
                        <div class="sparkline12-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="all-form-element-inner" style="min-width: 400px;">
                                            <?php
                                            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add_member');
                                            if (isset($area_managers['am_name'])) {
                                                echo form_open_multipart('admin/area_manager/am_update/'.$state_idd, $attributes);
                                                ?>
                                                <input type="hidden" name="am_id" value="<?php echo $area_managers['am_id']; ?>">
                                                <!-- <input type="hidden" name="state_id" value="<?php echo $area_managers['state_id']; ?>"> -->
                                                <?php
                                            } else {
                                               echo form_open_multipart('admin/area_manager/add_am/'.$state_idd, $attributes);
                                               ?>
                                               <!-- <input type="hidden" name="state_id" value="<?php echo $states['state_id']; ?>"> -->
                                           <?php } ?>

                                           <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Districts</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                <div class="chosen-select-single">
                                                    <select  data-placeholder="Choose Districts..." class="chosen-select" name="areas[]" multiple="" tabindex="-1">
                                                        <?php foreach ($areasAll as $area) { ?>
                                                            <option value="<?php  echo $area['id']; ?>" 
                                                                <?php  if(isset($areas['id']) && $areas['id'] == $area['id']){ echo "selected"; } ?> >
                                                                <?php echo $area['name']; ?>
                                                            </option> 
                                                        <?php  } ?>    
                                                    </select>
                                                </div>
                                            </div>
                                                <!-- <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12"> -->
                                                    <!-- <strong><?php echo $states['state_name']; ?></strong> -->
                                                    <!-- <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="state_id" class="form-control">
                                                         <option value="" selected="">Select State</option>
                                                         <?php foreach ($states as $state) {  ?>
                                                            <option value="<?php  echo $state['state_id']; ?>" 
                                                                <?php  if(isset($area_managers['state_id']) && $area_managers['state_id'] == $state['state_id']){ echo "selected"; } ?> >
                                                                <?php echo $state['state_name']; ?>
                                                            </option>
                                                        <?php  } ?>                                      
                                                    </select>
                                                </div> -->
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Area Name</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="am_name"  value="<?php
                                                    if (isset($area_managers['am_name'])) {
                                                        echo $area_managers['am_name'];
                                                    }
                                                    ?>" placeholder="Enter Area Manager Name" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Person Name</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="am_head_name"  value="<?php
                                                    if (isset($area_managers['am_head_name'])) {
                                                        echo $area_managers['am_head_name'];
                                                    }
                                                    ?>" placeholder="Enter Head Area Manager Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Areas</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="am_areas"  value="<?php
                                                    if (isset($area_managers['am_areas'])) {
                                                        echo $area_managers['am_areas'];
                                                    }
                                                    ?>" placeholder="Enter Areas Name by Comma Separeted Ex: Area-1,Area-2" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Designation</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="designation"  value="<?php
                                                    if (isset($area_managers['designation'])) {
                                                        echo $area_managers['designation'];
                                                    }
                                                    ?>" placeholder="Enter Designation" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Area Code</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="am_code"  value="<?php
                                                    if (isset($area_managers['am_code'])) {
                                                        echo $area_managers['am_code'];
                                                    }
                                                    ?>" placeholder="Enter Area Code" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Emp Id</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="username"  value="<?php
                                                    if (isset($area_managers['username'])) {
                                                        echo $area_managers['username'];
                                                    }
                                                    ?>" placeholder="Enter Username" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Password</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="password" name="password"  value="<?php
                                                    if (isset($area_managers['password'])) {
                                                        echo $area_managers['password'];
                                                    }
                                                    ?>" placeholder="Enter Password" class="form-control">
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