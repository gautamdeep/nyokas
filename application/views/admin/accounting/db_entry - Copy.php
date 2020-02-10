<?php
    $this->load->helper('mr_robot');
    $categories = get_rows('account_category');
?>
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
        <form action="<?php echo base_url($url) ?>" method="post" class="form-horizontal">
            <!-- <input type="hidden" name="callid" id="callid" value="<?php //echo isset($record->id) ? $record->id: ''; ?>"> -->
            <div class="form-inline">
                <label>Date-NEP</label>
                <input type="date" class="form-control" id="date-nep" name="date-nep" value="2076-04-01" min="2076-04-01" max="2076-06-3">
                <label>Date-ENG</label>
                <input type="date" class="form-control" id="date-eng" name="date-eng" value="2018-07-22" min=" 2018-01-01" max="2018-12-31">
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
            <div class="form-group form-actions">
                <div class="col-md-9">
                <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="continue">Save &amp; Continue</button>
                <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="add">Save &amp; Add New</button>
                <button type="submit" class="btn btn-effect-ripple btn-primary" name="submit" value="view">Save &amp; View</button>
                <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
               <!--  <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="update">Update</button> -->
                </div>
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
$('#date-nep').focusout(function(){
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
}); 
</script>

<!-- <script src="<?php //echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script> -->