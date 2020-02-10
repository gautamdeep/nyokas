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
                <div id="client-info">
                <table class="inputtable2">
                    <tr class="inputrow">
                        <td>
                            <label class="firstlabel">Client Name: </label>
                            <input type="hidden" name="clientid" id="clientid" value="<?php echo (empty($record) ? '' : $record->clientid);?>" >
                            <label id="businessname"><?php echo (empty($record) ? '' : $record->businessname);?></label>                            
                        </td>
                        <td>
                            <label class="firstlabel">Full Name: </label>
                            <label id="fullname"><?php echo (empty($record) ? '' : $record->firstname.' '.$record->lastname);?></label>                            
                        </td>
                   
                        <td>
                            <label class="firstlabel">City/Address: </label>
                            <label id="address"><?php echo (empty($record) ? '' : $record->address);?></label>
                        </td>
                        <td>
                            <label class="firstlabel">Landmark: </label>
                            <label id="landmark"><?php echo (empty($record) ? '' : $record->landmark);?></label>
                        </td>
                    </tr>
                </table>
                </div>
            </fieldset>
            <fieldset>
<legend>Call Information</legend>
<table class="inputtable2">
<tr class="inputrow">
<td>
    <label class="firstlabel">Property Type</label>
    <select name="propertytypeid">
        <option value="1">— Select Product —</option>
        <?php 
        $propertytypes = get_rows('property_types');
        foreach($propertytypes as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->propertytypeid)) &&  $row->id == $record->propertytypeid? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
        
    </select>
</td>
<td>
    <label class="firstlabel">Call Type</label>
    <select name="calltypeid">
        <option value="1">— Select Any Type —</option>
        <?php 
        $calltypes = get_rows('call_types');
        foreach($calltypes as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->calltypeid)) &&  $row->id == $record->calltypeid? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
<td>
    <label class="firstlabel">Term</label>
    <select name="term">
        <option value="0">— Select Term —</option>
        <?php 
        $callterm = get_rows('call_term');
        foreach($callterm as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->term)) &&  $row->id == $record->term? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
<td>
    <label class="firstlabel">Source</label>
    <select name="callsource">
        <option value="0">— Select Source —</option>
         <?php 
        $callsource = get_rows('call_source');
        foreach($callsource as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->callsource)) &&  $row->id == $record->callsource? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
 

</tr>
<tr class="inputrow">

<td>
    <label class="firstlabel">Reg.By</label>
    <input type="text" name="regby_name" value="<?php echo (isset($record->regby_name)) ? $record->regby_name:''; ?>" >
</td>
<td>
    <label class="firstlabel">Reg.Phone</label>
    <input type="text" name="regby_phone" value="<?php echo (isset($record->regby_phone)) ? $record->regby_phone:''; ?>" >
</td>
<td>
    <label class="firstlabel" for="text-input">Reg Date/Time</label>
    <input type="text" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($record->reg_datetime)? 'value="'.$record->reg_datetime.'"':''; ?> ">
</td>
<td>
    <label class="firstlabel" for="text-input">Due Date/Time</label>
    <input type="text" id="date" name="duedatetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($record->duedatetime)? 'value="'.$record->duedatetime.'"':''; ?> ">
</td>
</tr>
<tr>
<td>
    <label class="firstlabel">Urgent</label>
    <input type="checkbox" class="checkmark" name="priority" <?php echo (!empty($record->priority)) ? 'checked':''; ?>>
</td>

<td colspan="2">
    <label class="firstlabel">Call Detail</label>
    <textarea name="calldetail" placeholder="Call Detail"><?php echo (isset($record->calldetail)) ? $record->calldetail:''; ?></textarea>
</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Call Activity</legend>
<table class="inputtable2">
<tr class="inputrow">
<td>
    <label class="firstlabel">Status</label>
    <select name="callstatus">
        <option value="0">— Select Call Status —</option>
        <?php 
         $callstatus = get_rows('call_status');
        foreach($callstatus as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->callstatus)) &&  $row->id == $record->callstatus? 'selected':$row->id==2? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
</tr>
<tr>
<td>
    <label class="firstlabel">Job Assign To</label>
    <select name="jobassign">
        <option value="0">— Select Technician —</option>
        <?php 
        $employee = get_rows('employees',array('post'=>'Technician'));
        foreach($employee as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->job_assign)) &&  $row->id == $record->job_assign? 'selected':''; ?>>
            <?php echo $row->firstname; ?>
        </option>
        <?php } ?>
    </select>
</td>

</tr>
<tr>
<td rowpan="2">
    <label class="firstlabel">Internal Note</label>
    <textarea name="internalnote" style="width:435px"><?php echo (isset($record->internalnote)) ? $record->internalnote:''; ?></textarea>
</td>
</tr>
</table>
<div id="ajax-callactivity-form"></div>

<table class="inputtable2">
<tr class="inputrow">
<td>
    <input type="checkbox" class="checkmark" name="priority" value="1" style="float:left; margin-right:10px">
    <label>Customer Verification</lable>
</td>

<td>
    <label class="firstlabel">Name</label>
    <input type="text" name="customerverificationname" value="<?php echo (isset($record->customerverificationname)) ? $record->customerverificationname:''; ?>" >
</td>
<td>
    <label class="firstlabel">Contact</label>
    <input type="text" name="customerverificationno" value="<?php echo (isset($record->customerverificationno)) ? $record->customerverificationno:''; ?>" >
</td>

</table>

</fieldset>
      <div class="form-group form-actions">
<div class="col-md-9">
<?php if(empty($record)) { ?> 
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="continue">Save &amp; Continue</button>
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="add">Save &amp; Add New</button>
<button type="submit" class="btn btn-effect-ripple btn-primary" name="submit" value="view">Save &amp; View</button>
<button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
<?php }else{ ?>
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="update">Update</button>
<?php } ?>
</div>
</div>      
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
    get_callactivity_form();
    $('a.search-customer').click(function(e){
        $.ajax({
            url: '<?php echo base_url(); ?>'+'ajax_call/search_client_list',
            method: 'get',
            success: function( data ){
                $('#searched-customer').html(data);
               
            }
        });
    });

    $('#delete-this-call').click(function(e){
    e.preventDefault(e);
    if (confirm('Are you sure you want to delete this?')) {
        var callid = $('#callid').val();
        $.ajax({
            type: 'get',
            url: '<?php echo base_url(); ?>'+'ajax_call/delete_call',
            data: {callid: callid},
            success:function(data){
                var response = JSON.parse(data);
                if(response.status == 200){
                    // $('#id'+aid).remove();
                    alert(response.message);
                    window.location.href = "<?php echo base_url('panel/calls'); ?>";

                }else if(response.status == 201){
                    alert(response.message);
                    window.location.href = "<?php echo base_url('panel/calls'); ?>";
                }else{
                    alert(response.message);
                }
                console.log(data);
            } 
        });
    }
});
});

function get_callactivity_form(){
    var callid = <?php echo $record->id; ?>;
    // $( "#ajax-workactivity" ).load( "<?php //echo base_url('ajax_complain/workactivity_form') ?>", {'complain_id': complainid});
    $( "#ajax-callactivity-form" ).load( "<?php echo base_url('ajax_call/callactivity_form') ?>", {'call_id': callid }, function(){
        $(".js-example-placeholder-single").select2({
          placeholder: "Select",
          allowClear: true
        });

        $(".js-example-placeholder-multiple").select2({
          placeholder: "Select"
        });
    });
}

</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>