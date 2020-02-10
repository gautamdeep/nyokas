<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Sales</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Sales</li>
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
                <table id="" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Customer</th>
                            <th>Sales Date</th>
                            <th style="width: 80px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($records as $k=>$r) { ?>
                        <tr>
                            <td><strong><?php echo $k+1 ?></strong></td>
                            <td><strong><?php echo $r->customername ?></strong></td>
                            <td><?php echo $r->salesdate ?></td>
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
        <div class="modal-content" style="width:900px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Sale Items</strong></h3>
            </div>
            <div class="modal-body">
                <div class="box span3">
                    <div class="box-content">
                        <table id="example-datatable" class="table table-striped table-borderless table-vcenter">
                             <thead>
                                <th>Sno</th>
                                <th>Product Model</th>
                                <th>Product Type</th>
                                <th>Serial No.</th>
                                <th>Warranty Card No.</th>
                                <th>MRP</th>
                                <th>Discount</th>
                                <th>VAT</th>
                                <th>TAX</th>
                                <th>Commision</th>
                                <th>Actual Price</th>
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
            url: '<?php echo base_url("ajax/get_sales"); ?>',
            method: 'get',
            data: {'id': id},
            success: function( data ){
                $('#insertrows').html(data);
            }
        });
    });
});
</script>