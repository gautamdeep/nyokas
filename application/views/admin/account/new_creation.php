<?php
    $this->load->helper('mr_robot');
    $loadshedding= get_rows('loadshedding_group');
    $brands= get_rows('brands');
    $ac_types= get_rows('ac_types');
?>
<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Account <?php echo isset($record->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Account</li>
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
            <a href="<?php echo base_url('panel/clients'); ?>" class="btn btn-primary">View All</a>
            <a href="<?php echo base_url('delete/account_request/'.$record->id); ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
            <?php 
            	if($this->session->flashdata('message')){ ?> 
            	<script>
                    alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php } ?>

            <!-- General Elements Content -->
                
            <fieldset>
                <legend>Customer Information</legend>
                <?php //$url = isset($record->id)? 'panel/client/'.$record->id:'panel/client'; ?>
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="clientid" value="<?php echo isset($record->id) ? $record->id: ''; ?>">
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Business Name</label>
                                <input type="hidden" name="id" id="id" value="<?php echo (empty($record) ? '' : $record->id);?>" >
                                <input type="text" name="businessname" id="businessname" value="<?php echo (empty($record) ? '' : $record->businessname);?>" required>
                            </td>
                            <td>
                                <label>City</label>
                                <input type="text" name="city" id="city" value="<?php echo (empty($record) ? '' : $record->city);?>"  >
                            </td>
                             <td>
                                <label>Address</label>
                                <input type="text" name="address" id="address" value="<?php echo (empty($record) ? '' : $record->address);?>"  >
                            </td>
                            <td>
                                <label>Landmark</label>
                                <input type="text" name="landmark" id="landmark" value="<?php echo (empty($record) ? '' : $record->landmark);?>"  >
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" value="<?php echo (empty($record) ? '' : $record->firstname);?>" >
                            </td>
                            <td>
                                <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" value="<?php echo (empty($record) ? '' : $record->lastname);?>"  >
                            </td>
                            <td>
                                <label>Phone</label>
                                <input type="text" name="phone" id="phone" value="<?php echo (empty($record) ? '' : $record->phone);?>"  >
                            </td>
                            <td>
                                <label>Mobile</label>
                                <input type="text" name="mobile" id="mobile" value="<?php echo (empty($record) ? '' : $record->mobile);?>"  >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" id="email" value="<?php echo (empty($record) ? '' : $record->email);?>"  >
                            </td>
                            <td>
                                <label>Request Date</label>
                                <input type="text" name="created_at" id="created_at" value="<?php echo (empty($record) ? '' : $record->created_at);?>"  >
                            </td>
                            <td>
                                <label>Referred By</label>
                                <input type="text" name="referredby" id="referredby" value="<?php echo (empty($record) ? '' : $record->referredby);?>"  >
                            </td>
                        </tr>
                        
                    </table>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="create" id="new-create">Create New Account</button>
                            <button type="submit" class="btn btn-effect-ripple btn-primary" name="submit" value="search" id="search">Search Existing Client</button>
                        </div>
                    </div>
                </form>
            </fieldset>
                
            <div id="ajax-load"></div>

        </div>   
        <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>
<script type="text/javascript">

$('#search').click(function(e){
    e.preventDefault(e);
    var reqid = '<?php echo $record->id; ?>';
    // $( "#ajax-load" ).load( "<?php echo base_url('ajax_account/populate_client') ?>"), {'reqid': reqid };
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>'+'ajax_account/populate_client',
        data: {'reqid': reqid},
        success:function(data){
            $("#ajax-load").html(data);
        } 
    });
});

$(document).on('click', '.client-select', function(e){
    e.preventDefault();
    var clientid = $(this).attr('id-clientid');
    var reqid = '<?php echo $record->id; ?>';
    $.ajax({
        url: '<?php echo base_url(); ?>'+'ajax_account/set_accountdetail',
        method: 'post',
        data: {'clientid': clientid, 'reqid': reqid },
        success: function( data ){
            // alert(data);
            var response = JSON.parse(data);
            if(response.status == 400){
                alert(response.message);
            }else{ 
                // alert(response.message);
                $("#ajax-load").html(response.message);
                // $("#ajax-load").html(data); alert(data); 
            }
        }
    });
});
$(document).on('click', '#create-account', function(e){
    e.preventDefault();
    // var clientid = $(this).attr('id-clientid');
    // var reqid = '<?php echo $record->id; ?>';
    $.ajax({
        url: '<?php echo base_url(); ?>'+'ajax_account/post_accountdetail',
        method: 'post',
        data: $("#account-detail").serialize(), 
        success: function( data ){
            // alert(data);
            var response = JSON.parse(data);
            if(response.status == 200){
                window.location.href = "<?php echo base_url(); ?>account/creation_success/"+response.userid;
            }else{ 
                alert(response.message);
            }
        }
    });
});

$('#new-create').click(function(e){
    e.preventDefault(e);
    var reqid = '<?php echo $record->id; ?>';
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>'+'ajax_account/get_newaccountform',
        data: {'reqid': reqid},
        success:function(data){
            var response = JSON.parse(data);
            $("#ajax-load").html(response.template);
        } 
    });
});
$(document).on('click', '#create-new-account', function(e){
    e.preventDefault();
    // var clientid = $(this).attr('id-clientid');
    // var reqid = '<?php echo $record->id; ?>';
    $.ajax({
        url: '<?php echo base_url(); ?>'+'ajax_account/post_newaccount',
        method: 'post',
        data: $("#new-account-detail").serialize(), 
        success: function( data ){
            // alert(data);
            var response = JSON.parse(data);
            if(response.status == 200){
                window.location.href = "<?php echo base_url(); ?>account/creation_success/"+response.userid;
            }else{ 
                alert(response.message);
            }
        }
    });
});
</script>

<!-- <script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script> -->