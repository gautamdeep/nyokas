<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><?php echo ($this->uri->segment(2)=='completed_complains')?
                     'Completed Complains':(($this->uri->segment(2)=='deactivated_complains') ?'Deactivated Complains':'Calls History'); ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Calls</li>
                        <li><a href="">History</a></li>
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
                <div class="form-group">
                    <div class="input-group" style="margin-right: 2px;">
                        <span class="input-group-addon">From</span>
                        <input type="text"  class="form-control input-datepicker" id="start-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" readonly="readonly">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">To</span>
                        <input type="text"  class="form-control input-datepicker" id="end-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" readonly="readonly">
                    </div>
                </div>
                <button id="search-period" type="submit" class="btn btn-success" style="padding: 6px 19px!important"><i class="fa fa-search"></i>
</button>
               <!--  <div class="input-group">
                    <button ><span class="input-group-addon"><i class="fa fa-search"></i></span></button>
                </div> -->
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <!-- <th id="sn">Sn</th> -->
                            <!-- <th class="hidden-xs">CallID</th> -->
                            <th id="client">Client</th> 
                            <th id="pinfo" style="width: 150px;">Property Info</th>
                            <th id="regby">Reg. By</th>
                            <th id="callinfo">Call Info</th>
                            <th id="job">Job Assign</th>
                            <th id="status" style="width: 150px;">Status</th>
                            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($calls as $k=>$r) { 
                        ?>
                        <tr>
                             <!-- <td><strong><?php echo $k+1 ?></strong></td> -->
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
                            <td></td>
                            <!--  -->
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
/*.toolbar {
    float: left;
}*/

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<!-- END Page Content -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

<script>
$(function(){ UiTables.init(); });

$(document).ready(function() {
    $('#example-datatable').dataTable().fnDestroy();
    $('#example-datatable').dataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );

function fetch_data(is_date_search, start_date='', end_date=''){
    // alert(is_date_search+start_date+end_date)
    // var dataTable = $('#example-datatable').dataTable({
    $('#example-datatable').dataTable().fnDestroy();
    $('#example-datatable').dataTable({
        "processing" : true,
        "serverSide" : false,
        "ajax" : {
            url: '<?php echo base_url('ajax_call/call_history'); ?>',
            type: "POST",
            data: {is_date_search:is_date_search, start_date:start_date, end_date:end_date},
            dataSrc: ""
        },
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    });

}

$('#search-period').click(function(){
    var startdate = $('#start-date').val();
    var enddate = $('#end-date').val();
    if(startdate != '' && enddate !=''){
        $("#example-datatable").dataTable().fnDestroy();
        fetch_data('yes', startdate, enddate);
    }else{
        alert("Both Date is Required");
    }
}); 

</script>
