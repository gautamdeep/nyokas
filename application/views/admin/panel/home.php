<!-- Page content -->
<div id="page-content">
<!-- First Row -->
    <div class="row">
        <!-- Simple Stats Widgets -->
        <div class="col-sm-6 col-lg-3">
            <a href="javascript:void(0)" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background">
                        <i class="gi gi-headset text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong><span data-toggle="counter" data-to="<?php echo isset($total_newcomplain)?$total_newcomplain:''; ?>"></span></strong>
                    </h2>
                    <span class="text-muted">NEW COMPLAIN</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="<?php echo base_url('panel/notice'); ?>" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-success">
                        <i class="gi gi-message_new text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h3 text-success">
                        <strong><span data-toggle="counter" data-to="<?php echo $notice; ?>"></span></strong>
                    </h2>
                    <span class="text-muted">NOTICE</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="<?php echo base_url('account/new_request'); ?>" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-warning">
                        <i class="gi gi-user_add text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h3 text-warning">
                        <strong>+ <span data-toggle="counter" data-to="<?php echo $total_accountrequest; ?>"></span></strong>
                    </h2>
                    <span class="text-muted">New Account Request</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3">
            <a href="<?php echo base_url('panel/complains'); ?>" class="widget">
                <div class="widget-content widget-content-mini text-right clearfix">
                    <div class="widget-icon pull-left themed-background-danger">
                        <i class="gi gi-wallet text-light-op"></i>
                    </div>
                    <h2 class="widget-heading h3 text-danger">
                        <strong><span data-toggle="counter" data-to="<?php echo $total_complains; ?>"></span></strong>
                    </h2>
                    <span class="text-muted">PENDING COMPLAIN</span>
                </div>
            </a>
        </div>
        <!-- END Simple Stats Widgets -->
    </div>
    <!-- END First Row -->
   
    <!-- Tables Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="block">
                <h3>Pending Complains</h3>
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <!-- <th class="hidden-xs">CallID</th> -->
                            <th>Client</th> 
                            <th>Complain By</th>
                            <th>Property</th>
                            <th>Model no.</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($complains as $k=>$r) { ?>
                        <tr>
                            <td><strong><?php echo $k+1 ?></strong></td>
                            <!-- <td class="hidden-xs"><strong><?php echo $r->callid ?></strong></td> -->
                            <td><?php echo $r->businessname; ?></td>
                            <td><?php echo $r->complainer ?> <strong><?php echo $r->complainerphone ?></strong></td>
                            <td><?php echo $r->brand.'-'.$r->type ?></td>
                            <td><?php echo $r->model_number ?></td>
                            <td><?php $date1=strtotime($r->reg_datetime);
                                $date2 = strtotime(date('Y-m-d'));
                                $secs = $date2 - $date1; 
                                $days = round($secs/86400);
                                echo $days;
                                echo ($days=='1')?' day':' days';
                            ?></td>
                            <td><?php echo ucfirst($r->work_status) ?></td>

                            <td class="text-center">
                                <a href="<?php echo base_url("panel/complain/".$r->id) ?>" data-toggle="tooltip" title="View Complain" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <!-- <a href="<?php echo base_url("admin/delete/complains/".$r->id) ?>" data-toggle="tooltip" title="Delete Complain" class="btn btn-effect-ripple btn-xs btn-danger"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a> -->
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <!-- END Partial Responsive Content -->
            </div>
            <!-- END Partial Responsive Block -->
        </div>
    </div>
    <!-- END Tables Row -->

</div>

<!-- END Page Content -->
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>
