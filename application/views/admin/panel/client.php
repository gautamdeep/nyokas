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
                    <h1>Client <?php echo isset($record->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Client</li>
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
            <a href="#" class="btn btn-danger pull-right" id="delete-this-client" >Delete</a>
            <?php $url = isset($record)? 'delete/client/'.$record->id: 'delete/client/'; ?>
            <!-- <a href="<?php echo base_url($url); ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure you want to delete?? Every Data associated with this Client will also be Deleted');">Delete</a> -->
            <?php 
            	if($this->session->flashdata('message')){ ?> 
            	<script>
                    alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php } ?>

            <!-- General Elements Content -->
                
            <fieldset>
                <legend>Client Information</legend>
                <?php $url = isset($record->id)? 'panel/client/'.$record->id:'panel/client'; ?>
                <form action="<?php echo base_url($url) ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="clientid" value="<?php echo isset($record->id) ? $record->id: ''; ?>">
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Business Name</label>
                                <input type="hidden" name="id" id="clientid" value="<?php echo (empty($record) ? '' : $record->id);?>" >
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
                                <input type="text" name="phone1" id="phone1" value="<?php echo (empty($record) ? '' : $record->phone1);?>"  >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email1" id="email1" value="<?php echo (empty($record) ? '' : $record->email1);?>"  >
                            </td>
                        </tr>
                         <tr class="inputrow">
                            <td>
                                <label>Rep First Name</label>
                                <input type="text" name="repfirstname" id="repfirstname" value="<?php echo (empty($record) ? '' : $record->repfirstname);?>" >
                            </td>
                            <td>
                                <label>Rep Last Name</label>
                                <input type="text" name="replastname" id="replastname" value="<?php echo (empty($record) ? '' : $record->replastname);?>"  >
                            </td>
                             <td>
                                <label>Phone</label>
                                <input type="text" name="phone2" id="phone2" value="<?php echo (empty($record) ? '' : $record->phone2);?>"  >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email2" id="email2" value="<?php echo (empty($record) ? '' : $record->email2);?>"  >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Loadshedding</label>
                                
                                <select name="loadshedding">
                                    <?php foreach($loadshedding as $row){ ?> 
                                    <option value="<?php echo $row->id; ?>" <?php echo (isset($record->loadsheddinggroup)) &&  $row->id == $record->loadsheddinggroup? 'selected':''; ?>>
                                        <?php echo $row->groupname; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                                <!--  <input type="text" name="loadshedding" id="loadshedding" value="<?php echo (empty($record) ? '' : $record->loadshedding);?>"  > -->
                            </td>
                        </tr>
                    </table>
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
            </fieldset>
                    
            <?php if(!empty($record)) { ?>  
            <fieldset>
                <legend>Property Information</legend>
                    
                <form action="<?php echo base_url('panel/property'); ?>" method="post" name="property-form" id="property-form" class="form-horizontal">
                    <input type="hidden" name="clientid" value="<?php echo (empty($record) ? '' : $record->id);?>" >
                    <div>
                    <table class="table table-bordered table-vcenter entry">
                        <thead>
                            <tr>
                                <th><label>Sn.</label></th>
                                <th><label>Brand</label></th>
                                <th><label>Type</label></th>
                                <th><label>Model</label></th>
                                <th><label>Serial</label></th>
                                <th><label>Capacity in TON *</label></th>
                                <th><label>Assign Name</label></th>
                                <th><label>Location</label></th>
                                <th><label>Install Date</label></th>
                                <th><label>Run Date</label></th>
                            </tr>
                        </thead>
                        <tbody id="tablebody">
                            <?php 
                            if(!empty($properties)) {
                            foreach($properties as $key=>$row){ ?> 
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <input type="hidden" name="id[]" value="<?php echo $row->id; ?>">
                                <td>
                                
                                <select name="brand[]">
                                <option value="0"> </option>
                                <?php foreach($brands as $brandrow){ ?> 
                                    <option value="<?php echo $brandrow->id; ?>" <?php echo (isset($row->brand) &&  $brandrow->id == $row->brand)? 'selected':''; ?>>
                                        <?php echo $brandrow->brandname; ?>
                                    </option>
                                <?php } ?>
                                </select>
                                <!-- <input type="text" name="brand[]" value="<?php echo $row->brand; ?>" > -->

                                </td>
                                <td>
                                    <select name="type[]">
                                    <option value="0"> </option>
                                    <?php foreach($ac_types as $typerow){ ?> 
                                        <option value="<?php echo $typerow->id; ?>" <?php echo (isset($row->type) &&  $typerow->id == $row->type)? 'selected':''; ?>>
                                        <?php echo $typerow->typename; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </td>
                                <td><input type="text" name="modelnumber[]" value="<?php echo $row->modelnumber; ?>" ></td>
                                <td><input type="text" name="serialnumber[]" value="<?php echo $row->serialnumber; ?>" ></td>
                                <td><input type="text" name="capacityinton[]" value="<?php echo $row->capacityinton; ?>" ></td>
                                <td><input type="text" name="assignname[]" value="<?php echo $row->assignname; ?>" ></td>
                                <td><input type="text" name="location[]" value="<?php echo $row->location; ?>" ></td>

                                <td><input type="text" name="installdate[]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($row->installdate)? 'value="'.$row->installdate.'"':''; ?> ></td>
                                <td><input type="text" name="rundate[]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($row->rundate)? 'value="'.$row->rundate.'"':''; ?> ></td>
                            </tr>
                            <?php } 
                            }
                            ?>
                            <tr>
                                <td><?php echo !empty($properties)? count($properties)+1:'1'; ?></td>
                                <input type="hidden" name="id[]" value="">
                                <td>
                                    <select name="brand[]">
                                    <option value="0" disabled selected>Choose Brand </option>
                                    <?php foreach($brands as $brandrow){ ?> 
                                        <option value="<?php echo $brandrow->id; ?>">
                                        <?php echo $brandrow->brandname; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="type[]">
                                    <option value="0" disabled selected>Choose AC Type </option>
                                    <?php foreach($ac_types as $typerow){ ?> 
                                        <option value="<?php echo $typerow->id; ?>">
                                        <?php echo $typerow->typename; ?>
                                        </option>
                                    <?php } ?>
                                    </select>
                                </td>
                                <td><input type="text" name="modelnumber[]" value="" ></td>
                                <td><input type="text" name="serialnumber[]" value="" ></td>
                                <td><input type="number" name="capacityinton[]" value="" ></td>
                                <td><input type="text" name="assignname[]" value="" ></td>
                                <td><input type="text" name="location[]" value="" ></td>
                                <td><input type="text" name="installdate[]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"></td>
                                <td><input type="text" name="rundate[]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="update-property">Update Property</button>
                        </div>
                    </div>
                    </form>
                    </fieldset>
                    <?php } ?>
                <!-- END General Elements Content -->
            </div>
            <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>

<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>
<script type="text/javascript">
$( document ).ready(function(){

    var focus = 0,
    blur = 0;
    $( "#businessname" ).focusout(function() {
        console.log('check wheather this name is already entered or not');
    });

    $('#delete-this-client').click(function(e){
        e.preventDefault(e);
        if (confirm('Are you sure you want to delete this?')) {
            var clientid = $('#clientid').val();
            $.ajax({
                type: 'get',
                url: '<?php echo base_url(); ?>'+'ajax_call/delete_client',
                data: {clientid: clientid},
                success:function(data){
                    var response = JSON.parse(data);
                    if(response.status == 200){
                        // $('#id'+aid).remove();
                        alert(response.message); 
                        window.location.href = "<?php echo base_url('panel/clients'); ?>";

                    }else if(response.status == 201){
                        alert(response.message);
                        window.location.href = "<?php echo base_url('panel/clients'); ?>";
                    }else{
                        alert(response.message);
                    }
                    console.log(data);
                } 
            });
        }
    });
});
</script>