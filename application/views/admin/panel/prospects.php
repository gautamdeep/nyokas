<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Complains</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Complain</li>
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
                <a href="<?php echo base_url('panel/complain'); ?>" class="btn btn-primary">Add New</a>
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>CallID</th>
                            <th class="hidden-xs">Client</th> 
                            <th>Complain By</th>
                            <th>Contact</th>
                            <th>Qty</th>
                            <th>Loadshd.</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($complains as $k=>$r) { ?>
                        <tr>
                            <td><strong><?php echo $k+1 ?></strong></td>
                            <td><strong><?php echo $r->callid ?></strong></td>
                            <td class="hidden-xs"><?php echo $r->clientname; ?></td>
                            <td><strong><?php echo $r->cfirstname ?></strong></td>
                            <td><?php echo $r->address ?> <strong><?php echo $r->cphone ?></strong></td>
                            <td><?php echo '1' ?></td>
                            <td><?php echo $r->loadshedding; ?></td>
                            <td><?php $date1=strtotime($r->reg_datetime);
                                $date2 = strtotime(date('Y-m-d'));
                                $secs = $date2 - $date1; 
                                $days = round($secs/86400);
                                echo $days;
                                echo ($days=='1')?' day':' days';
                            ?></td>
                            <td><?php echo ucfirst($r->work_status) ?></td>

                            <td class="text-center">
                                <a href="<?php echo base_url("panel/complain/".$r->id) ?>" data-toggle="tooltip" title="Edit Complain" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
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