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
                <a href="<?php echo base_url('panel/call'); ?>" class="btn btn-primary">Add New</a>
                <button class="btn btn-primary" id="printme">Print Table</button>
                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text"  class="form-control input-datepicker" id="start-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                </div>

                <div class="input-group">
                    <span class="input-group-addon"></span>
                    <input type="text"  class="form-control input-datepicker" id="end-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                </div>
                <button id="search-period">Search</button>
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th id="sn">Sn</th>
                            <!-- <th class="hidden-xs">CallID</th> -->
                            <th id="client">Client</th> 
                            <th id="pinfo" style="width: 150px;">Property Info</th>
                            <th id="regby">Reg. By</th>
                            <th id="callinfo">Call Info</th>
                            <th id="job">Job Assign</th>
                            <th id="status" style="width: 150px;">Status</th>
                            <!-- <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th> -->
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

<!-- END Page Content -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script> -->
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<!-- <script src="//cdn.datatables.net/plug-ins/1.10.19/filtering/row-based/range_dates.js"></script> -->
<!-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/datetime-moment.js"></script> -->
<script>
$(function(){ UiTables.init(); });
// $(document).ready(function() {
//     $("#example-datatable").dataTable().fnDestroy();
//     $('#example-datatable').dataTable({
//         "columns": [
//             { "data": "sn" },
//             { "data": "client" },
//             { "data": "pinfo" },
//             { "data": "regby" },
//             { "data": "callinfo" },
//             { "data": "job" },
//             { "data": "status" }
//         ]
//     });
// });    
// $(document).ready(function () {
//     $("#example-datatable").dataTable().fnDestroy();
//     $('#example-datatable').dataTable({
//         // 'searching':false,
//         // 'paging':false,
//         'ordering':false
//     });
// });
 
function fetch_data(is_date_search, start_date='', end_date=''){
    // alert(is_date_search+start_date+end_date)
    // var dataTable = $('#example-datatable').dataTable({
        $.fn.dataTable.ext.errMode = 'throw';
    $('#example-datatable').dataTable({
        // "processing" : true,
        // "serverSide" : true,
        // "ajax" : {
        //     url: '<?php echo base_url(); ?>'+'ajax_call/fetch_call_history',
        //     type: "POST",
        //     data: {is_date_search:is_date_search, start_date:start_date, end_date:end_date}
        // },
        "ajax": "<?php echo base_url(); ?>'+'ajax_call/fetch_test'"
        // "columns": [
        //         { "data": "sn" },
        //         { "data": "client" },
        //         { "data": "pinfo" },
        //         { "data": "regby" },
        //         { "data": "callinfo" },
        //         { "data": "job" },
        //         { "data": "status" }
        //     ]
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
<script>

function printData()
{
   var divToPrint=document.getElementById("example-datatable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

// $('button').on('click',function(){
//     $("table tr td").css('border-bottom', '#ddd solid 1px');
//     $("table").css('font-size', '12px');
//     $("table tr th").css('text-align', 'left');
//     printData();
// })
</script>