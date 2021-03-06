<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Purchase Stock</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Purchase</li>
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
                            <th>Sno</th>
                            <th>Purchase Order</th>
                            <th>Purchase Date</th>
                            <th>Authorized By</th>
                            <th>Prepared By</th>
                            <th style="width: 80px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($records as $k=>$r) { ?>
                        <tr>
                            <td><strong><?php echo $k+1 ?></strong></td>
                            <td><strong><?php echo $r->purchaseorder ?></strong></td>
                            <td><?php echo $r->purchasedate ?></td>
                            <td><?php echo $r->authorizedby ?></td>
                            <td><?php echo $r->preparedby ?></td>
                            <td class="text-center">
                                <a href="#modal-fade" title="View Stock Items" class="btn btn-effect-ripple btn-xs btn-info view-modal" data-toggle="modal" data-id="<?php echo $r->id;?>" >
                                <i class="fa fa-eye"></i>
                            </a>
                                <!-- <a href="<?php echo base_url("panel/stock/".$r->id) ?>" data-toggle="tooltip" title="Edit Complain" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a> -->
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
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Purchase Items</strong></h3>
            </div>
            <div class="modal-body">
                <div class="box span3">
                    <div class="box-content">
                        <table class="table table-striped table-borderless table-vcenter">
                             <thead>
                                <th>Sno</th>
                                <th>Product Model</th>
                                <th>Product Type</th>
                                <th>Quantity</th>
                                <th>MRP</th>
                            </thead>
                            <tbody id="insertrows">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>
<script type="text/javascript">
$(function(){
    $('a.view-modal').click(function(e){
        var id = $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url("ajax/get_purchases"); ?>',
            method: 'get',
            data: {'id': id},
            success: function( data ){
                $('#insertrows').html(data);
            }
        });
    });
});
</script>