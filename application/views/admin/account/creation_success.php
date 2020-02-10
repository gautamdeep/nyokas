<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Account Created Successfully</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Account</li>
                        <li><a href="">Created</a></li>
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
            <?php 
            	if($this->session->flashdata('message')){ ?> 
            	<script>
                    alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php } ?>

            <!-- General Elements Content -->
                
            <fieldset>
                <legend>User Information</legend>
                <?php //$url = isset($record->id)? 'panel/client/'.$record->id:'panel/client'; ?>
                <form action="" method="post" class="form-horizontal" id="success-mail">
                    <input type="hidden" name="clientid" value="<?php echo isset($record->id) ? $record->clientid: ''; ?>">
                    <input type="hidden" name="id" value="<?php echo (empty($record) ? '' : $record->id);?>" >
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Name</label>
                                <input type="text" name="firstname" value="<?php echo (empty($record) ? '' : $record->firstname.' '.$record->lastname);?>"  >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo (empty($record) ? '' : $record->email);?>"  >
                            </td>
                            <td>
                                <label>Username</label>
                                
                                <input type="text" name="username" value="<?php echo (empty($record) ? '' : $record->username);?>" required>
                            </td>
                            <td>
                                <label>Password</label>
                                <input type="text" name="password_show" value="<?php echo (empty($record) ? '' : $record->password_show);?>"  >
                            </td>
                             
                            
                        </tr>
                        
                    </table>
                    
                </form>
            </fieldset>
            <div class="form-group form-actions">
                <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="create" id="send-email">Send Email to Client</button>
            </div>
            <div id="ajax-load"></div>

        </div>   
        <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>
<script type="text/javascript">
$('#send-email').click(function(e){
    e.preventDefault(e);
    $.ajax({
        type: 'post',
        url: '<?php echo base_url(); ?>'+'ajax_account/send_email',
        data: $('#success-mail').serialize(),
        success:function(data){
            var response = JSON.parse(data);
            // $("#ajax-load").html(response.template);
        } 
    });
});
</script>