<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Prospect <?php echo isset($record['0']->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Prospect</li>
                        <li><a href=""><?php echo isset($record['0']->id) ? 'Update': 'Add'; ?></a></li>
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
            <a href="<?php echo base_url('panel/complains'); ?>" class="btn btn-primary btn-sm">View All</a>
                <?php 
                	if($this->session->flashdata('message')){ ?> 
                	<script>
                        alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                    </script>
                <?php } ?>

                
                <fieldset>
                    <legend>Customer Information</legend>
                    <!-- General Elements Content -->
                    <?php $url = isset($record['0']->id)? 'panel/prospect/'.$record['0']->id:'panel/prospect'; ?>
                    <form action="<?php echo base_url($url) ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <input type="hidden" name="id" value="<?php echo isset($record['0']->id) ? $record['0']->id: ''; ?>">
                        <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Date/Time</label>
                                <input type="text" id="date" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo (empty($record['0']) ? '' : $record['0']->reg_datetime);?>" required>
                            </td>
                            <td>
                                <label>Referred by</label>
                                <input type="text" name="referredBy" id="referredBy" value="<?php echo (empty($record['0']) ? '' : $record['0']->referredBy);?>">
                            </td>
                            <td>
                                <label>Met*</label>
                                <input type="text" name="met" id="met" value="<?php echo (empty($record['0']) ? '' : $record['0']->met);?>" required>
                            </td>
                            <td>
                                <label>Interested in</label>
                                <input type="text" name="interestIn" id="interestIn" value="<?php echo (empty($record['0']) ? '' : $record['0']->interestIn);?>">
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Business Name</label>
                                <input type="text" name="businessname" id="businessname" value="<?php echo (empty($record['0']) ? '' : $record['0']->businessname);?>">
                            </td>
                            <td>
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="<?php echo (empty($record['0']) ? '' : $record['0']->address);?>" >
                            </td>
                            <td>
                                <label>City</label>
                                <input type="text" name="city" id="city" value="<?php echo (empty($record['0']) ? '' : $record['0']->city);?>" >
                            </td>
                             <td>
                                <label>Landmark</label>
                                <input type="text" name="landmark" id="landmark" value="<?php echo (empty($record['0']) ? '' : $record['0']->landmark);?>" >
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" value="<?php echo (empty($record['0']) ? '' : $record['0']->firstname);?>">
                            </td>
                            <td>
                                <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" value="<?php echo (empty($record['0']) ? '' : $record['0']->lastname);?>">
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" id="email" value="<?php echo (empty($record['0']) ? '' : $record['0']->email);?>" >
                            </td>
                            <td>
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" value="<?php echo (empty($record['0']) ? '' : $record['0']->phone);?>" >
                            </td>
                        </tr>
                        
                        <tr class="inputrow">
                            <td>
                            <label>Note</label>
                                <textarea name="note"><?php echo (empty($record['0']) ? '' : $record['0']->note);?> </textarea>
                            </td>
                        </tr>
                    </table>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                        <?php if(empty($record['0'])) { ?> 
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="customer" value="add">Save</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                        <?php }else{ ?>
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="customer" value="update">Update</button>
                        <?php } ?>
                        </div>
                    </div>
                </form>
                </fieldset>
                <?php if(!empty($record['0'])) { ?> 
                <fieldset>
                    <legend>Follow up Information</legend>
                    <?php $url = isset($record['0']->id)? 'panel/prospect/'.$record['0']->id:'panel/prospect'; ?>
                    <form action="<?php echo base_url($url) ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="prospectId" value="<?php echo (empty($record['0']) ? '' : $record['0']->id);?>">
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Followed Date</label>
                                <input type="text" id="date" name="followedDate" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="" required>
                            </td>
                            
                            <td>
                                <label>Follow Medium</label>
                                <input type="text" name="followMedium" id="followMedium" value="">
                            </td>

                            <td>
                                <label>Discussion</label>
                                <input type="text" name="discussion" id="discussion" value="">
                            </td>
                            <td>
                                <label>Reminder</label>
                                 <input type="text" id="date" name="reminder" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="" required>
                            </td>
                            <td>
                                <label>Note</label>
                                <input type="text" name="note" id="note" value="">
                            </td>
                        </tr>
                    </table>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                        <?php if(empty($record['0'])) { ?> 
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="followup" value="add">Add New</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
                        <?php }else{ ?>
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="followup" value="update">Update</button>
                        <?php } ?>
                        </div>
                    </div>
                </form>
                    <div class="sc">
                    <table class="table table-bordered table-vcenter entry">
                        <thead>
                        <tr>
                            <th><label>Date</label></th>
                            <th><label>Follow Medium</label></th>
                            <th><label>Discussion</label></th>
                            <th><label>Reminder</label></th>
                            <th><label>Note</label></th>
                        </tr>
                        </thead>
                        <tbody id="tablebody">
                        <?php //echo "<pre>"; print_r($ac_complains); echo "</pre>"; ?>

                        <?php for($i=0; $i<10; $i++){ ?> 
                        <tr <?php echo (empty($followups[$i])) ? '' : 'id'.$followups[$i]->id.'='.$followups[$i]->id;?> >
                           
                            <td><input type="text" name="followedDate[]" value="<?php echo empty($followups[$i]->followedDate)?'':$followups[$i]->followedDate; ?>" ></td>
                            <td><input type="text" name="followMedium[]" value="<?php echo empty($followups[$i]->followMedium)?'':$followups[$i]->followMedium; ?>" ></td>
                            <td><input type="text" name="discussion[]" value="<?php echo empty($followups[$i]->discussion)?'':$followups[$i]->discussion; ?>" ></td>
                            <td><input type="text" name="reminder[]" value="<?php echo empty($followups[$i]->reminder)?'':$followups[$i]->reminder; ?>" ></td>
                            <td><input type="text" name="note[]" value="<?php echo empty($followups[$i]->note)?'':$followups[$i]->note; ?>" ></td>
                            
                           
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                  
                        </div>
                        </fieldset>
                    <?php } ?>
                <!-- END General Elements Content -->
            </div>
            <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>

<script type="text/javascript">
$( document ).ready(function(){
    get_products();
    // $(".input-datepicker").datepicker().datepicker("setDate", new Date());
    var c_id = "<?php echo isset($record['0']->id)? $record['0']->id: null; ?>";
    if (c_id == null || c_id ==''){
        $(".input-datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        }).datepicker("setDate", "0");
    }
});
// $( document ).ready( 
//     // $(".input-datepicker").datepicker();
//     // $(".input-datepicker").datepicker("setDate", new Date());
// );
$(function(){
    $('.del').click(function(e){
        e.preventDefault(e);
        var aid = $(this).attr('id');
        console.log(aid);
        $.ajax({
            type: 'get',
            url: '<?php echo base_url(); ?>'+'ajax/remove_ac_work_detail',
            data: {aid: aid},
            success:function(data){
                var response = JSON.parse(data);
                if(response.status == 200){
                    $('#id'+aid).remove();
                    location.reload();
                }
                console.log(data);
            } 
        });
    });

    $('#add-new').click(function(e){
        e.preventDefault(e);
        $('#add-new').text('Processing...');
        if($('#producttypename').val() != ''){
            $.ajax({
                type : 'post',
                url : '<?php echo base_url(); ?>'+'ajax/get_cart_header',
                data : $('#productForm').serialize(),
                success: function ( data ){
                    $('#modal-fade').modal('hide');
                    
                    var response = JSON.parse(data);
                    console.log(response.message);
                    console.log(response.status);
                    if(response.status == 200) 
                        get_products();
                }
            });
        }else alert('Enter Productname')
        $('#add-new').text('Add New');
    });
    $('a .search-customer').click(function(e){
        // var id = $(this).attr('data-id');
        console.log('hey you');
        $.ajax({
            url: '<?php echo base_url(); ?>'+'ajax/search_customer',
            method: 'get',
            // data: {'id': id},
            success: function( data ){
                $('#searched-customer').html(data);
            }
        });
    });
    
});
function get_products( jQuery ) {
    var product_id = "<?php echo isset($record['0']->producttypeid)? $record['0']->producttypeid: ''; ?>";
    $.ajax({
        url : '<?php echo base_url("ajax/get_products"); ?>',
        success: function ( data ){
            $('#get-products').html(data);
            $('.get-products option[value='+product_id+']').prop('selected', true);
        }
    });
}


</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>