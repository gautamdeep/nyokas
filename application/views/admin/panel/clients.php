<?php 
    if($this->session->flashdata('message')){ ?> 
    <script>
        alertify.success('<?php echo $this->session->flashdata('message'); ?>');
    </script>
<?php } ?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Clients</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Client</li>
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
                <a href="<?php echo base_url('panel/client'); ?>" class="btn btn-primary">Add New</a>
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>Business</th>
                            <th>Address</th>
                            <th>Landmark</th>
                            <th>Phone</th>
                            <th>Name</th>
                            <th>Representative</th>
                            <!-- <th>Loadshd.</th> -->
                            
                            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($clients as $k=>$r) { ?>
                        <tr>
                            <td><strong><?php echo $k+1 ?></strong></td>
                            <td><strong><?php echo $r->businessname ?></strong></td>
                            <td><strong><?php echo $r->address.', '.$r->city; ?></strong></td>
                            <td><strong><?php echo $r->landmark; ?></strong></td>
                            <td><strong><?php echo $r->phone1; ?></strong></td>
                            <td><?php echo $r->firstname.' '.$r->lastname ?></td>
                            <td><?php echo $r->repfirstname.' '.$r->replastname ?></td>
                            <!-- <td><?php echo $r->loadshedding; ?></td> -->
                            <td class="text-center">
                                <a href="<?php echo base_url("panel/client/".$r->id) ?>" data-toggle="tooltip" title="Edit Client" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <!-- <a href="<?php echo base_url("admin/delete/clients/".$r->id) ?>" data-toggle="tooltip" title="Delete Complain" class="btn btn-effect-ripple btn-xs btn-danger"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a> -->
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