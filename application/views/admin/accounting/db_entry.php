<?php
    $this->load->helper('mr_robot');
    $categories = get_rows('account_category');
?>
<script type="text/javascript" src="<?php echo base_url('assets/nepali-date/nepali.datepicker.v2.2.min.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/nepali-date/nepali.datepicker.v2.2.min.css');?>" />

<div id="page-content">
<div class="content-header">
    <div class="row">
    <div class="col-sm-6">
        <div class="header-section">
            <h1>DB Entry</h1>
        </div>
    </div>

    <div class="col-sm-6 hidden-xs">
        <div class="header-section">
            <ul class="breadcrumb breadcrumb-top">
                <li>Dashboard</li>
                <li>DB</li>
                <li><a href=""><?php echo isset($record->id) ? 'Update': 'Entry'; ?></a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-12">
    <div class="block">
        <!-- <a href="<?php //echo base_url('panel/calls'); ?>" class="btn btn-primary">View All</a> -->
        <?php 
        	if($this->session->flashdata('message')){ ?> 
        	<script>
                alertify.success('<?php echo $this->session->flashdata('message'); ?>');
            </script>
        <?php } ?>

        <!-- General Elements Content -->
        <?php $url = isset($record->id)? 'panel/call/'.$record->id:'accounting/db_entry'; ?>
        <form action="<?php echo base_url($url) ?>" method="post" id="db-entry-form" class="form-horizontal" onsubmit="return false">
            <!-- <input type="hidden" name="callid" id="callid" value="<?php //echo isset($record->id) ? $record->id: ''; ?>"> -->
            <div class="form-inline">
                <label>Date-NEP</label>
                <input type="text" class="form-control" id="date-nep" name="date-nep" value="2076-04-01" min="2076-04-01" id="nepaliDate" class="nepali-calendar" value="2069-08-02"/>
                <label>Date-ENG</label>
                <input type="text" class="form-control" id="date-eng" name="date-eng"/>
                <!-- <label>Date-NEP</label>
                <input type="date" class="form-control" id="date-nep" name="date-nep" value="2076-04-01" min="2076-04-01" max="2076-06-3">
                <label>Date-ENG</label>
                <input type="date" class="form-control" id="date-eng" name="date-eng" value="2018-07-22" min=" 2018-01-01" max="2018-12-31"> -->
            </div>
            <div id="db-entry-table">
            <table id="" class="table table-striped table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 50px">Sn</th>
                        <!-- <th class="hidden-xs">CallID</th> -->
                        <th style="width: 250px">Category</th> 
                        <th style="width: 120px">Bill Type</th>
                        <th style="width: 150px">Amount</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                
            </table>
            </div>
        </form>
        <!-- END General Elements Content -->
    </div><!-- END General Elements Block -->
</div>
</div><!-- END Form Components Row -->
</div><!-- END Page content -->
<!-- <div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title"><strong>Search Client</strong></h3>
        </div>
        <div class="modal-body">
            <div class="box span3">
                <div class="box-content">
                    <div id="searched-customer">Please wait...</div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?php echo base_url('panel/client'); ?>"" class="btn btn-success" id="add-new">Add New Client</a>
            <button type="button" class="btn btn-effect-ripple btn-danger" id="close" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div> -->


<style type="text/css">
    .form-inline {margin-bottom:20px;}
    .form-inline label{margin-right:20px;}
    .form-inline input{margin-right:30px;}
    .table tbody > tr > th, .table tbody > tr > td { padding:0;}
    .table .form-control {
        padding: 0 4px;
        margin: 0;
        border: 0;
        background-color: transparent;
    }
</style> 
<script type="text/javascript">
$("#db-entry-form").submit(function(e) {
    e.preventDefault();
});
$(document).ready(function(){
    load_entry();
});
$('#date-nep').focusout(function(){
    load_entry();
    $('.alert').close();
}); 
function load_entry(){
    var datenep = $('#date-nep').val();

    $.ajax({
        url: '<?php echo base_url(); ?>'+'accounting/ajax_search_entry',
        method: 'post',
        data: {'datenep': datenep},
        success: function( data ){
            $('#db-entry-table').html(data);
    // var startdate = $('#start-date').val();
    // var enddate = $('#end-date').val();
    // if(startdate != '' && enddate !=''){
    //     $("#example-datatable").dataTable().fnDestroy();
    //     fetch_data('yes', startdate, enddate);
    // }else{
    //     alert("Both Date is Required");
    // }
        }
    });
}

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

        $('#nepaliDate5').nepaliDatePicker({
            npdMonth: true,
            npdYear: true,
            npdYearCount: 10
        });
        $('#date-nep').nepaliDatePicker({
            ndpEnglishInput: 'date-eng'
        });
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

<!-- <script src="<?php //echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script> -->