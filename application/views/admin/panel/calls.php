<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><?php echo ($this->uri->segment(2)=='completed_complains')?
                     'Completed Complains':(($this->uri->segment(2)=='deactivated_complains') ?'Deactivated Complains':'Calls'); ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Call</li>
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
                <a href="<?php echo base_url('panel/call'); ?>" class="btn btn-primary">Add New</a>
                <!-- <button class="btn btn-primary" id="printme">Print me</button> -->
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <!-- <th class="hidden-xs">CallID</th> -->
                            <th>Client</th> 
                            <th style="width: 150px;">Property Info</th>
                            <th>Reg. By</th>
                            <th>Call Info</th>
                            <th>Job Assign</th>
                            <th style="width: 150px;">Status</th>
                            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($calls as $k=>$r) { 
                        ?>
                        <tr>
                             <td><strong><?php echo $k+1 ?></strong></td>
                            <!-- <td class="hidden-xs"><strong><?php echo $r->callid ?></strong></td> -->
                            <td><?php echo strtoupper($r->businessname); ?><br><?php echo $r->address ?></td> 
                            <td>
                                Call On: <?php echo $r->propertytype ?><br>
                                Call for: <?php echo $r->calltype ?><br>
                                Source: <?php echo $r->callsource ?><br>
                                Term: <?php echo $r->callterm ?>
                            </td>
                            <td>
                                <?php echo $r->regby_name ?> <br><strong><?php echo $r->regby_phone ?></strong><br>

                                Reg Date: <?php echo $r->reg_datetime ?><br>
                                <?php $date1=strtotime($r->reg_datetime);
                                $date2 = strtotime(date('Y-m-d'));
                                $secs = $date2 - $date1; 
                                $days = round($secs/86400);
                                // echo $days;
                                echo ($days=='0')?'Today':($days=='1')? $days.' day ago':$days.' days ago';
                            ?>
                            </td>
                            <td>
                                <?php echo $r->calldetail ?><br>
                                <?php echo !empty($r->internalnote)? "# ".$r->internalnote:""; ?>
                            </td>
                            <td><?php echo $r->jobassign ?></td>
                            <td>
                                <?php echo $r->callstatus ?><br>
                                <?php echo $r->priority ?><br>
                                Due Date: <?php echo $r->duedatetime ?>
                            </td>

                            <td class="text-center">
                                <a href="<?php echo base_url("panel/call/".$r->id) ?>" data-toggle="tooltip" title="Edit Call" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
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
<style type="text/css">
.form-group {
    display: inline-block;
    margin-bottom: 0px;
    vertical-align: middle;
}
.input-group {
    width: 250px;
    float:left;
    display: inline-table;
    vertical-align: middle;

}
.toolbar {
    float: left;
}

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

<script>$(function(){ UiTables.init(); });</script>
<script>
$(document).ready(function() {
    $('#example-datatable').dataTable().fnDestroy();
    $('#example-datatable').dataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );


// function printData()
// {
//    var divToPrint=document.getElementById("example-datatable");
//    newWin= window.open("");
//    newWin.document.write(divToPrint.outerHTML);
//    newWin.print();
//    newWin.close();
// }

// $('button').on('click',function(){
//     $("table tr td").css('border-bottom', '#ddd solid 1px');
//     $("table").css('font-size', '12px');
//     $("table tr th").css('text-align', 'left');
//     printData();
// })
</script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>