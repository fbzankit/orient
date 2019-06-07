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
                                <li><span class="bread-blod">Zones</span>
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
                                <h1>AddZone</h1>
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
                                                if(isset($zone['zone_name'])){
                                                    echo form_open_multipart('admin/zone/zone_update', $attributes); 
                                                ?>
                                            <input type="hidden" name="zone_id" value="<?php echo $zone['zone_id']; ?>"
                                                <?php 
                                                
                                                }else{
                                                    echo form_open_multipart('admin/zone/add_zone', $attributes);
                                                }
                                                
                                            ?>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Select Zone</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="zone_name" class="form-control">
                                                         <option value="" selected="">Select Zone</option>
                                                         <?php foreach ($zonesAll as $zone) { ?>
                                                            <option value="<?php  echo $zone['id']; ?>" 
                                                                <?php  if(isset($states['id']) && $states['id'] == $zone['id']){ echo "selected"; } ?> >
                                                                <?php echo $zone['name']; ?>
                                                            </option> 
                                                        <?php  } ?>                                      
                                                    </select> 
                                                </div>

                                                        <!-- <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="zone_name"  value="<?php if(isset($zone['zone_name'])){ echo $zone['zone_name']; } ?>" placeholder="Enter Zone Name" class="form-control">
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Person Name</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="zone_head_name"  value="<?php if(isset($zone['zone_head_name'])){ echo $zone['zone_head_name']; } ?>" placeholder="Enter Zonal Head Name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Zone States</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="zone_states"  value="<?php if(isset($zone['zone_states'])){ echo $zone['zone_states']; } ?>" placeholder="Enter multiple Zone States by comma separate ex: state-1, state-2" class="form-control">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Designation</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="designation"  value="<?php if(isset($zone['designation'])){ echo $zone['designation']; } ?>" placeholder="Enter Designation" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Zone Code</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="zone_code"  value="<?php if(isset($zone['zone_code'])){ echo $zone['zone_code']; } ?>" placeholder="Enter Zone Code" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Emp Id</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="username"  value="<?php if(isset($zone['username'])){ echo $zone['username']; } ?>" placeholder="Enter Username" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                            <label class="login2 pull-right pull-right-pro">Password</label>
                                                        </div>
                                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="password" name="password"  value="<?php if(isset($zone['password'])){ echo $zone['password']; } ?>" placeholder="Enter Password" class="form-control">
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