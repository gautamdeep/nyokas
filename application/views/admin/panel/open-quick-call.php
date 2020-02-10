<?php
    $this->load->helper('mr_robot');
    $callstatus= get_rows('call_status');
    $brands= get_rows('brands');
    //echo print_r($record);
?>
<div id="page-content">
<?php include APPPATH.'views/admin/inc/content_header.php';?>
<div class="row">
<div class="col-md-12">
    <div class="block">
        <a href="<?php echo base_url('panel/calls'); ?>" class="btn btn-primary">View All</a>
        <a href="#" class="btn btn-danger pull-right" id="delete-this-call">Delete</a>
        <?php 
        	if($this->session->flashdata('message')){ ?> 
        	<script>
                alertify.success('<?php echo $this->session->flashdata('message'); ?>');
            </script>
        <?php } ?>

        <!-- General Elements Content -->
        <?php $url = isset($record->id)? 'panel/call/'.$record->id:'panel/call'; ?>
        <form action="<?php echo base_url($url) ?>" method="post" class="form-horizontal">
            <input type="hidden" name="callid" id="callid" value="<?php echo isset($record->id) ? $record->id: ''; ?>">

            <fieldset>
                <legend>Client Information</legend>
                <a href="#modal-fade" title="" class="btn btn-effect-ripple btn-xs btn-info view-modal search-customer" data-toggle="modal" data-id="" >
                    <?php echo (empty($record)) ? 'Select ' : 'Change ';?> <i class="fa fa-search" aria-hidden="true"></i>
                </a>
                <a href="<?php echo base_url('panel/client'); ?>" class="btn btn-xs btn-success" id="">Add New</a>
                <div id="client-info"></div>
            </fieldset>
            <div id="call-info"></div>
            <!-- <div id="client-property"></div>
            <div id="property-complain"></div> -->
            <div id="ajax-workactivity"></div>
            
        </form>
        <!-- END General Elements Content -->
    </div><!-- END General Elements Block -->
</div>
</div><!-- END Form Components Row -->
</div><!-- END Page content -->
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
</div>


<script type="text/javascript">
$( document ).ready(function(){
    // var callid = $( "#callid" ).val()
    // if(callid != '')
    //     $("#call-info").load("<?php //echo base_url().'ajax_call/load_call_info_n_activity'; ?>");


    $('a.search-customer').click(function(e){
        // var id = $(this).attr('data-id');
        $.ajax({
            url: '<?php echo base_url(); ?>'+'ajax_call/search_client_list',
            method: 'get',
            // data: {'id': id},
            success: function( data ){
                $('#searched-customer').html(data);
                // var callid = <?php //echo $record->id; ?>;
// // $( "#ajax-workactivity" ).load( "<?php //echo base_url('ajax_complain/workactivity_form') ?>", {'complain_id': complainid});
// $( "#ajax-workactivity" ).load( "<?php //echo base_url('ajax_call/workactivity_form') ?>", {'call_id': callid }, function(){
//     $(".js-example-placeholder-single").select2({
//       placeholder: "Select",
//       allowClear: true
//     });

//     $(".js-example-placeholder-multiple").select2({
//       placeholder: "Select"
//     });
// });
            }
        });
    });
});
</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>