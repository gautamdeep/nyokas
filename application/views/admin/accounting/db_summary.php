<script type="text/javascript" src="<?php echo base_url('assets/nepali-date/nepali.datepicker.v2.2.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/nepali-date/nepali.datepicker.v2.2.min.css');?>" />
<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>DB Summary</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>DB</li>
                        <li><a href="">Summary</a></li>
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
                        <input type="text" id="start-date" class="nepali-calendar ndp-nepali-calendar" value="2076-06-01" onfocus="showNdpCalendarBox('nepaliDate5')">
                       <!--  <input type="text"  class="form-control input-datepicker" id="start-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="2076-04-01" min="2076-04-01" max="2076-06-3" readonly="readonly"> -->
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">To</span>
                        <input type="text" id="end-date" class="nepali-calendar ndp-nepali-calendar" value="2076-06-30" onfocus="showNdpCalendarBox('nepaliDate5')">
                        <!-- <input type="text"  class="form-control input-datepicker" id="end-date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="2076-04-01" min="2076-04-01" max="2076-06-3" readonly="readonly"> -->
                    </div>
                </div>
                <button id="search-period" type="submit" class="btn btn-success" style="padding: 6px 19px!important"><i class="fa fa-search"></i>
                </button>
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th>Date-Nep</th>
                            <th>Category</th> 
                            <th>Bill Type</th>
                            <th>Amount</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

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
    $('#example-datatable').dataTable().fnDestroy();
    $('#example-datatable').dataTable({
        "processing" : true,
        "serverSide" : false,
        "ajax" : {
            url: '<?php echo base_url('accounting/ajax_db_summary'); ?>',
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
<script>
    $(document).ready(function(){
        $('#nepaliDateD').nepaliDatePicker({
            disableBefore: '12/08/2073',
            disableAfter: '12/20/2073'
        });
        $('#nepaliDateD1').nepaliDatePicker({
            disableDaysBefore: '10',
            disableDaysAfter: '10'
        });

        $('#start-date').nepaliDatePicker({
            npdMonth: true,
            npdYear: true,
            npdYearCount: 10
        });
        $('#end-date').nepaliDatePicker({
            npdMonth: true,
            npdYear: true,
            npdYearCount: 10
        });
        // $('#start_date').nepaliDatePicker({
        //     ndpEnglishInput: 'start-date'
        // });
        $('#nepaliDate1').nepaliDatePicker({
            onChange: function(){
                alert($('#nepaliDate1').val());
            }
        });
        $('#nepaliDate2').nepaliDatePicker();
        $('#nepaliDate3').nepaliDatePicker({
            onFocus: false,
            npdMonth: true,
            npdYear: true,
            ndpTriggerButton: true,
            ndpTriggerButtonText: 'Date',
            ndpTriggerButtonClass: 'btn btn-primary btn-sm'
        });

        $('#date-eng').change(function(){
            $('#date-nep').val(AD2BS($('#date-eng').val()));
        });

        $('#englishDate9').change(function(){
            $('#nepaliDate9').val(AD2BS($('#englishDate9').val()));
        });

        $('#nepaliDate9').change(function(){
            $('#englishDate9').val(BS2AD($('#nepaliDate9').val()));
        });
    });
</script>