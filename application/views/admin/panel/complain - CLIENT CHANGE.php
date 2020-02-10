<?php $this->load->helper('mr_robot');
      $status= get_rows('status');
      $technician= get_rows('employees');
?>
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Complain <?php echo isset($record->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Complain</li>
                        <li><a href=""><?php echo isset($record->id) ? 'Update': 'Add'; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Forms Components Header -->

    <!-- Form Components Row -->
    <div class="row">
        <div class="col-md-12">
            <!-- General Elements Block -->
            <div class="block">
                <a href="<?php echo base_url('panel/complains'); ?>" class="btn btn-primary">View All</a>
                <?php 
                	if($this->session->flashdata('message')){ ?> 
                	<script>
                        alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                    </script>
                <?php } ?>

                <!-- General Elements Content -->
                <?php $url = isset($record->id)? 'panel/complain/'.$record->id:'panel/complain'; ?>
                
                    <fieldset>
                    <legend>Client Information</legend>
                    <a href="#modal-fade" class="btn btn-effect-ripple btn-xs btn-info view-modal search-client" data-toggle="modal" data-id="" >
                        <?php echo (empty($record)) ? 'Select ' : 'Change ';?> <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo base_url('panel/client'); ?>" class="btn btn-xs btn-success" id="">Add New</a>
                    <table class="inputtable2">
                    <form action="<?php echo base_url($url) ?>" method="post" class="form-horizontal">
                    <input type="hidden" name="complainid" value="<?php echo isset($record->id) ? $record->id: ''; ?>">
                        <tr class="inputrow">
                       		<td>
                                <label>Business Name</label>
		                    	<input type="hidden" name="clientid" id="clientid" value="<?php echo (empty($record) ? '' : $record->clientid);?>" >
                                <input type="text" name="businessname" id="businessname" value="<?php echo (empty($record) ? '' : $record->businessname);?>" readonly>
                            </td>
                            <td>
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="<?php echo (empty($record) ? '' : $record->address);?>" readonly >
                            </td>
                            <td>
                                <label>Landmark</label>
                                <input type="text" name="landmark" id="landmark" value="<?php echo (empty($record) ? '' : $record->landmark);?>" readonly >
                            </td>
                            <td>
                                <label>Loadshedding</label>
                                <input type="text" name="loadshedding" id="loadshedding" value="<?php echo (empty($record) ? '' : $record->loadshedding);?>" readonly >
                            </td>
                        </tr>
                    </form>
                    </table>
                    </fieldset>
                    <fieldset>
                        <legend>Complain Information</legend>
                        <form id="complain-form">
                        <table class="inputtable2">
                        <input type="hidden" name="complainid" value="<?php echo isset($record->id) ? $record->id: ''; ?>">
                         <tr class="inputrow">
                         	<td>
                                <label>Complain By</label>

                                <input type="text" name="complainer" value="<?php echo (empty($record) ? '' : $record->complainer);?>">
                            </td>
                            <td>
                                <label>Post</label>
                                <input type="text" name="complainerpost" value="<?php echo (empty($record) ? '' : $record->complainerpost);?>" >
                            </td>
                            <td>
                                <label>Phone No</label>
                                <input type="text" name="complainerphone" value="<?php echo (empty($record) ? '' : $record->complainerphone);?>" >
                            </td>
                            <td>
                                <label class="" for="text-input">Complain Date/Time</label>
                                <input type="text" id="date" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo (empty($record) ? '' : $record->reg_datetime);?>" required>
                            </td>
                            
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Complain Description</label>
                                <textarea name="complaindetail"><?php echo (empty($record) ? '' : $record->complaindetail); ?></textarea>
                                <!-- <input type="text" name="firstname" value="<?php echo (empty($record) ? '' : $record->repfirstname);?>" > -->
                            </td>
                            <td>
                                <label>Work Status</label>
                                
                                <select name="status">
                                    <option value="<?php echo $status[0]->id; ?>" <?php echo (isset($record->status[0]) &&  $status[0]->id == $record->status)? 'selected':''; ?>>
                                        <?php echo $status[0]->name; ?>
                                    </option>
                                    <option value="<?php echo $status[1]->id; ?>" <?php echo (isset($record->status[0]) &&  $status[1]->id == $record->status)? 'selected':''; ?>>
                                        <?php echo $status[1]->name; ?>
                                    </option>
                                    <option value="<?php echo $status[2]->id; ?>" <?php echo (isset($record->status[0]) &&  $status[2]->id == $record->status)? 'selected':''; ?>>
                                        <?php echo $status[2]->name; ?>
                                    </option>
                                </select>
                            </td>
                        </tr>
                        </table>
                        <button type="submit" id="update-complain" class="btn btn-effect-ripple btn-success" name="submit" value="update">Update Complain</button>
                        </form>
                    </fieldset>
                    
                    <div id="ajax-complainproperty"></div>
                    <div id="ajax-workactivity"></div>
            </div>
        </div>
    </div>
    <!-- END Form Components Row -->
</div>
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
                        <div id="searched-client"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="add-new">Add New</button>
                <button type="button" class="btn btn-effect-ripple btn-danger" id="close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$( document ).ready(function(){
    var propertyid = <?php echo $record->propertyid; ?>;
    var complainid = <?php echo $record->id; ?>;
            
    get_complain_property(complainid, propertyid);
    get_complain_activity();

    // $(".input-datepicker").datepicker().datepicker("setDate", new Date());
    // var c_id = "<?php echo isset($record->id)? $record->id: null; ?>";
    // if (c_id == null || c_id ==''){
    //     $(".input-datepicker").datepicker({
    //         dateFormat: "yy-mm-dd"
    //     }).datepicker("setDate", "0");
    // }
});

$(document).on('submit', '#property-complain', function(event){ 
    event.preventDefault(event);
    $.ajax({
       type: "POST",
       url: "<?php echo base_url('ajax_complain/update_property_complain'); ?>",
       data: $("#property-complain").serialize(), // serializes the form's elements.
       success: function(data)
       {
            var response = JSON.parse(data);
            if(response.status == 200){
                alert(response.message);
            }else location.reload();
       }
    });
});
$(document).on('submit', '#workactivity-form', function(event){ 
    event.preventDefault();
    $.ajax({
       type: "POST",
       url: "<?php echo base_url('ajax_complain/post_workactivity_form'); ?>",
       data: $("#workactivity-form").serialize(), // serializes the form's elements.
       success: function(data)
       {
            get_complain_activity();
       }
    });
});
$('a.search-client').click(function(e){
    // var id = $(this).attr('data-id');
    var complainid = $("[name=complainid]").val();
    
    $.ajax({
        url: '<?php echo base_url(); ?>'+'ajax_complain/search_client',
        method: 'get',
        data: {'complainid': complainid},
        success: function( data ){
            $('#searched-client').html(data);

        }
    });
});
$( "#complain-form" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
       type: "POST",
       url: "<?php echo base_url('ajax_complain/update_complain_info'); ?>",
       data: $("#complain-form").serialize(), // serializes the form's elements.
       success: function(data)
       {
            var response = JSON.parse(data);
            if(response.status == 200){
                alert(response.message);
            }else location.reload();
       }
    });
});




function get_complain_property(complainid, propertyid){
    $( "#ajax-complainproperty" ).load( "<?php echo base_url('ajax_complain/get_complainproperty') ?>", {
        'property_id': propertyid, 
        'complain_id': complainid
    }, function(){
        $(".js-example-placeholder-single").select2({
          placeholder: "Select",
          allowClear: true
        });

        $(".js-example-placeholder-multiple").select2({
          placeholder: "Select"
        });
    });
}
function get_complain_activity(){
    var complainid = <?php echo $record->id; ?>;
    // $( "#ajax-workactivity" ).load( "<?php //echo base_url('ajax_complain/workactivity_form') ?>", {'complain_id': complainid});
    $( "#ajax-workactivity" ).load( "<?php echo base_url('ajax_complain/workactivity_form') ?>", {'complain_id': complainid }, function(){
        $(".js-example-placeholder-single").select2({
          placeholder: "Select",
          allowClear: true
        });

        $(".js-example-placeholder-multiple").select2({
          placeholder: "Select"
        });
    });
}

$(function(){
    // $('.del').click(function(e){
    //     e.preventDefault(e);
    //     var aid = $(this).attr('id');
    //     console.log(aid);
    //     $.ajax({
    //         type: 'get',
    //         url: '<?php echo base_url(); ?>'+'ajax/remove_ac_work_detail',
    //         data: {aid: aid},
    //         success:function(data){
    //             var response = JSON.parse(data);
    //             if(response.status == 200){
    //                 $('#id'+aid).remove();
    //                 location.reload();
    //             }
    //             console.log(data);
    //         } 
    //     });
    // });

    
    // $('#add-new').click(function(e){
    //     e.preventDefault(e);
    //     $('#add-new').text('Processing...');
    //     if($('#producttypename').val() != ''){
    //         $.ajax({
    //             type : 'post',
    //             url : '<?php echo base_url(); ?>'+'ajax/get_cart_header',
    //             data : $('#productForm').serialize(),
    //             success: function ( data ){
    //                 $('#modal-fade').modal('hide');
    //                 var response = JSON.parse(data);
    //                 console.log(response.message);
    //                 console.log(response.status);
    //                 if(response.status == 200) 
    //                     get_products();
    //             }
    //         });
    //     }else alert('Enter Productname')
    //     $('#add-new').text('Add New');
    // });
    
    
});
</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>