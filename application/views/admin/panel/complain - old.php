<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Complain <?php echo isset($record['0']->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Complain</li>
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
            <a href="<?php echo base_url('panel/complains'); ?>" class="btn btn-primary">View All</a>
                <?php 
                	if($this->session->flashdata('message')){ ?> 
                	<script>
                        alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                    </script>
                <?php } ?>

                <!-- General Elements Content -->
                <form action="<?php echo base_url('panel/complain') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="id" value="<?php echo isset($record['0']->id) ? $record['0']->id: ''; ?>">
                    <fieldset>
                    <legend>Customer Information</legend>
                    <a href="#modal-fade" title="" class="btn btn-effect-ripple btn-xs btn-info view-modal" data-toggle="modal" data-id="" >
                        <i class="fa fa-search search-customer" aria-hidden="true"></i>
                    </a>
                    <p id="a1"></p>
                    <!-- <a href="#modal-fade"><i class="fa fa-search search-customer" aria-hidden="true"></i></a> -->
                    <table class="inputtable2">
                        <tr class="inputrow">
                       		<td>
                                <label>Business Name</label>
                                <!-- <input type="text" name="businessname" value="<?php echo (empty($record['0']) ? '' : $record['0']->businessname);?>" > -->
                                <input type="text" name="test" id="nepa" >
                            </td>
                            <td>
                                <label>City</label>
                                <input type="text" name="city" value="<?php echo (empty($record['0']) ? '' : $record['0']->city);?>" >
                            </td>
                            <td>
                                <label>Address</label>
                                <input type="text" name="address" value="<?php echo (empty($record['0']) ? '' : $record['0']->address);?>" >
                            </td>
                            <td>
                                <label>Landmark</label>
                                <input type="text" name="landmark" value="<?php echo (empty($record['0']) ? '' : $record['0']->landmark);?>" >
                            </td>
                           
                            
                        </tr>
                        <tr class="inputrow">
                         	<td>
                                <label>First Name</label>
                                <input type="text" name="firstname" value="<?php echo (empty($record['0']) ? '' : $record['0']->firstname);?>" >
                            </td>
                            <td>
                                <label>Last Name</label>
                                <input type="text" name="lastname" value="<?php echo (empty($record['0']) ? '' : $record['0']->lastname);?>" >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo (empty($record['0']) ? '' : $record['0']->email);?>" >
                            </td>
                            <td>
                                <label>Phone 1</label>
                                <input type="text" name="phone1" value="<?php echo (empty($record['0']) ? '' : $record['0']->phone1);?>" >
                            </td>
                            <!-- <td>
                                <label>District</label>
                                <input type="text" name="district" value="<?php echo (empty($record['0']) ? '' : $record['0']->district);?>" >
                            </td> 
                            <td>
                                <label>House No</label>
                                <input type="text" name="housenumber" value="<?php echo (empty($record['0']) ? '' : $record['0']->housenumber);?>" >
                            </td>-->
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Rep First Name</label>
                                <input type="text" name="firstname" value="<?php echo (empty($record['0']) ? '' : $record['0']->repfirstname);?>" >
                            </td>
                            <td>
                                <label>Rep Last Name</label>
                                <input type="text" name="lastname" value="<?php echo (empty($record['0']) ? '' : $record['0']->replastname);?>" >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="text" name="email" value="<?php echo (empty($record['0']) ? '' : $record['0']->repemail);?>" >
                            </td>
                            <td>
                                <label>Phone 2</label>
                                <input type="text" name="phone2" value="<?php echo (empty($record['0']) ? '' : $record['0']->phone2);?>" >
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        
                    </table>
                    </fieldset>
                    <fieldset>
                    <legend>Product Information</legend>
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Brand</label>
                                <input type="text" name="brand" value="<?php echo (empty($record['0']) ? 'Hitachi' : $record['0']->brand);?>" readonly>
                            </td>
                            <td>
                                <label class="" for="text-input">Reg Date/Time</label>
                                <input type="text" id="date" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo (empty($record['0']) ? '' : $record['0']->reg_datetime);?>" required>
                            </td>
                            <td>
                                <label>Product Type</label>

                                <select name="producttypeid" class="addselect get-products" id="get-products">
                                <?php
                                    // $this->load->helper('mr_robot');
                                    // $products = get_rows('products');
                                    // foreach($products as $row){
                                ?>    
                                    <!-- <option value="<?php echo $row->id; ?>" 
                                    <?php echo (isset($record['0']->product) && ($record['0']->product == $row->id))? 'selected':''; ?>>
                                        <?php echo $row->productname; ?>
                                    </option> -->
                                <?php //} ?>
                                </select>
                                <a class="btn btn-default add-modal addnew" href="#modal-fade" data-toggle="modal" >Add New</a>
                            </td>
                            <td>
                                <label>Model Number</label>
                                <input type="text" name="model_number" value="<?php echo (empty($record['0']) ? '' : $record['0']->model_number);?>" >
                            </td>
                            

                            
                        </tr>
                        
                        <tr class="inputrow">
                            
                            <td>
                                <label>Serial No</label>
                                <input type="text" name="machine_serial_number"value="<?php echo (empty($record['0']) ? '' : $record['0']->machine_serial_number);?>" required>
                            </td>
                            <td>
                                <label>Purchase Date</label>
                                <input type="text" id="purchase_date" name="purchase_date" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo (empty($record['0']) ? '' : $record['0']->purchase_date);?>" required>
                            </td>
                            <td>
                                <label>Sales Dealer</label>
                                <input type="text" name="sales_dealer"value="<?php echo (empty($record['0']) ? '' : $record['0']->sales_dealer);?>" required>
                            </td>
                            <td>
                                <label>Bill Number</label>
                                <input type="text" name="bill_number" value="<?php echo (empty($record['0']) ? '' : $record['0']->bill_number);?>" required>
                            </td>
                            
                        </tr>
                        </table>
                        </fieldset>
                        <fieldset>
                        <legend>Complain Information</legend>
                        <table class="inputtable2">
                            <tr class="inputrow">
                                <td>
                                    <label>Complain Type</label>
                                    <input type="text" name="complain_type" value="<?php echo (empty($record['0']) ? '' : $record['0']->complain_type);?>" >
                                </td>
                                <td>
                                    <label>Loadshedding</label>
                                    <select name="loadsheding_group">
                                    <?php
                                        $this->load->helper('mr_robot');
                                        $groups = get_rows('loadshedding_group');
                                        foreach($groups as $row){
                                    ?>    
                                        <option value="<?php echo $row->id; ?>" 
                                        <?php echo (isset($record['0']->loadsheding_group) && ($record['0']->loadsheding_group == $row->id))? 'selected':''; ?>>
                                            <?php echo $row->groupname; ?>
                                        </option>
                                    <?php } ?> 
                                    </select>
                                </td>
                                <td>
                                <label>Work Status</label>
                                <select name="work_status">
                                <?php
                                    $this->load->helper('mr_robot');
                                    $status= get_rows('status');
                                ?>
                                    <option value="<?php echo $status[0]->id; ?>" <?php echo (isset($record['0']->work_status) &&  $status[0]->id == $record[0]->work_status)? 'selected':''; ?>>
                                        <?php echo $status[0]->statusdesc; ?>
                                    </option>
                                    <option value="<?php echo $status[1]->id; ?>" <?php echo (isset($record['0']->work_status) &&  $status[1]->id == $record[0]->work_status)? 'selected':''; ?>>
                                        <?php echo $status[1]->statusdesc; ?>
                                    </option>
                                    <option value="<?php echo $status[2]->id; ?>" <?php echo (isset($record['0']->work_status) &&  $status[2]->id == $record[0]->work_status)? 'selected':''; ?>>
                                        <?php echo $status[2]->statusdesc; ?>
                                    </option>
                                    <!-- <option value="part-pending" <?php echo (isset($record['0']->work_status) && 'part-pending' == $record[0]->work_status)? 'selected':''; ?>>
                                        Part-Pending
                                    </option>
                                    <option value="completed" <?php echo (isset($record['0']->work_status) && 'completed' == $record[0]->work_status)? 'selected':''; ?>>
                                        Completed
                                    </option> -->
                                </select>
                            </td>
                            <td>
                                <label>Parts Description</label>
                                <textarea name="parts_description"><?php echo (empty($record['0']) ? '' : $record['0']->parts_description);?></textarea>
                            </td>
                            <!-- <td>
                                <label>Warranty Status</label>
                                <input type="text" name="warranty_status"value="<?php echo (empty($record['0']) ? '' : $record['0']->warranty_status);?>" required>
                            </td> -->
                        </tr>
                        <tr>
                            
                        </tr>
                    </table>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                        <?php if(empty($record['0'])) { ?> 
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
            </div>
            <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Search Customer</strong></h3>
            </div>
            <div class="modal-body">
                <div class="box span3">
                    <div class="box-content">
                        <div id="searched-customer"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="add-new">Add New</button>
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:900px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Sale Items</strong></h3>
            </div>
            <div class="modal-body">
                <div class="box span3">
                    <div class="box-content">
                        <table id="example-datatable" class="table table-striped table-borderless table-vcenter">
                             <thead>
                                <th>Sno</th>
                                <th>Product Model</th>
                                <th>Product Type</th>
                                <th>Serial No.</th>
                                <th>Warranty Card No.</th>
                                <th>MRP</th>
                                <th>Discount</th>
                                <th>VAT</th>
                                <th>TAX</th>
                                <th>Commision</th>
                                <th>Actual Price</th>
                            </thead>
                            <tbody id="insertrows">
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
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
    $('#add-new').click(function(e){
        e.preventDefault(e);
        $('#add-new').text('Processing...');
        if($('#producttypename').val() != ''){
            $.ajax({
                type : 'post',
                url : '<?php echo base_url(); ?>+ajax/get_cart_header',
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