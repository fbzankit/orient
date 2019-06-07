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
                                <li><span class="bread-blod">State Heads</span>
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
                                <h1>Add State</h1>
                            </div>
                        </div>
                         <?php if(!empty($this->session->flashdata('msg'))){ ?>
                            <div class="alert alert-info" role="alert">
                                <strong><?php echo $this->session->flashdata('msg'); ?> </strong>
                            </div>
                        <?php } ?>
                        <div class="sparkline12-graph">
                            <div class="basic-login-form-ad">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="all-form-element-inner" style="min-width: 400px;">
                                            <?php
                                            
                                            $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'add_member');
                                            if(isset($states['state_name'])){
                                                echo form_open_multipart('admin/state_head/state_update/'.$zone_idd, $attributes); 
                                                ?>
                                                <input type="hidden" name="state_id" value="<?php echo $states['state_id']; ?>"
                                                <?php 
                                                
                                            }else{
                                                echo form_open_multipart('admin/state_head/add_state/'.$zone_idd, $attributes);
                                            }  ?>
                                            

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Select States</label>
                                                    </div> 
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <div class="chosen-select-single">
                                                            <select  data-placeholder="Choose States..." class="chosen-select" name="states[]" multiple="" tabindex="-1">
                                                                <?php foreach ($statesAll as $state) { ?>
                                                                    <option value="<?php  echo $state['id']; ?>" 
                                                                        <?php  if(isset($states['id']) && $states['id'] == $state['id']){ echo "selected"; } ?> >
                                                                        <?php echo $state['name']; ?>
                                                                    </option> 
                                                                <?php  } ?>    
                                                            </select>
                                                        </div>
                                                        <!-- <select name="zone_id" class="form-control">
                                                         <option value="" selected="">Select Zone</option>
                                                         <?php foreach ($zones as $zone) { ?>
                                                            <option value="<?php  echo $zone['zone_id']; ?>" 
                                                                <?php  if(isset($states['zone_id']) && $states['zone_id'] == $zone['zone_id']){ echo "selected"; } ?> >
                                                                <?php echo $zone['zone_name']; ?>
                                                            </option> 
                                                        <?php  } ?>                                      
                                                    </select> -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Person Name</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="state_name"  value="<?php if(isset($states['state_name'])){ echo $states['state_name']; } ?>" placeholder="Enter multiple States by comma separate ex: city-1, city-2" class="form-control">

                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Person Name</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="state_head_name"  value="<?php if(isset($states['state_head_name'])){ echo $states['state_head_name']; } ?>" placeholder="Enter State Head Name" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">States Name</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="state_cities"  value="<?php if(isset($states['state_cities'])){ echo $states['state_cities']; } ?>" placeholder="Enter multiple State Cities by comma separate ex: city-1, city-2" class="form-control">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Designation</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="designation"  value="<?php if(isset($states['designation'])){ echo $states['designation']; } ?>" placeholder="Enter Designation" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">State Code</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="state_code"  value="<?php if(isset($states['state_code'])){ echo $states['state_code']; } ?>" placeholder="Enter State Code" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Emp Id</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="text" name="username"  value="<?php if(isset($states['username'])){ echo $states['username']; } ?>" placeholder="Enter Username" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Password</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <input type="password" name="password"  value="<?php if(isset($states['password'])){ echo $states['password']; } ?>" placeholder="Enter Password" class="form-control">
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