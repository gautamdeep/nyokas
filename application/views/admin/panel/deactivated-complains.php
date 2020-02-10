<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Deactivated Complains</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Deactivated Complain</li>
                        <li><a href="">List</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Table Styles Header -->

    <!-- Tables Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="block">
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <!-- <th>CallID</th> -->
                            <th class="hidden-xs">Client</th> 
                            <th>Complain By</th>
                            <th>Contact</th>
                            <th>Qty</th>
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
                                <a href="<?php echo base_url("panel/deactivated_complain/".$r->id) ?>" data-toggle="tooltip" title="View Complain" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-eye"></i></a>
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