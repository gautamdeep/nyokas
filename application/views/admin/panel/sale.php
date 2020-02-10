<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Sale <?php echo isset($record['0']->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Sale</li>
                        <li><a href=""><?php echo isset($record['0']->id) ? 'Update': 'Entry'; ?></a></li>
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
                <?php }elseif($this->session->flashdata('error')){ ?> 
                	<script>
                        alertify.error('<?php echo $this->session->flashdata('error'); ?>');
                    </script>
                <?php } ?>

                <!-- General Elements Content -->
                <form action="<?php echo base_url('panel/sale') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="saleid" value="<?php echo isset($sale['saleid']) ? $sale['saleid']: ''; ?>">
                    <?php //if(!empty($sale)) print_r($sale); ?>
                    <!-- <div class="form-group">
                        <label class="col-md-2 control-label">Customer Name</label>
                        <div class="col-md-3">
                            <input type="text" name="customername" class="form-control" <?php echo !empty($sale['customername'])? 'value="'.$sale['customername'].'" readonly':''; ?> required>
                        </div>
                        <label class="col-md-2 control-label">Sale Date</label>
                        <div class="col-md-3">
                            <input type="text" name="salesdate"  class="input-datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($sale['salesdate'])? 'value="'.$sale['salesdate'].'" readonly':''; ?> required>
                        </div>
                    </div>  -->
                    <table class="inputCtable">
                        <tr class="inputrow">
                            <td>
                                <label>Sale Date</label>
                                <input type="text" name="salesdate"  class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($sale['salesdate'])? 'value="'.$sale['salesdate'].'" readonly':''; ?> required>
                            </td>
                            <td>
                                <label>Organization</label>
                                <input type="text" name="organization" value="<?php echo (empty($record['0']) ? '' : $record['0']->organization);?>" >
                            </td>
                            <td>
                                <label>Email</label>
                                <input type="email" id="date" name="email" value="<?php echo (empty($record['0']) ? '' : $record['0']->email);?>" required>
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
                                <label>Phone 1</label>
                                <input type="text" id="" name="phone1" value="<?php echo (empty($record['0']) ? '' : $record['0']->phone1);?>" required>
                            </td>
                            
                        </tr>
                        <tr class="inputrow">
                        <td>
                            <label>City</label>
                            <input type="text" name="city" value="<?php echo (empty($record['0']) ? '' : $record['0']->city);?>" >
                        </td>
                        <td>
                            <label>Address</label>
                            <input type="text" name="address" value="<?php echo (empty($record['0']) ? '' : $record['0']->address);?>" >
                        </td>
                        <td>
                                <label>Phone 2</label>
                                <input type="text" name="mobile" value="<?php echo (empty($record['0']) ? '' : $record['0']->mobile);?>" >
                            </td>
                    </tr>
                    </table>
                    <table class="table table-bordered table-vcenter entry">
                        <thead>
                        <tr>
                            <th><label>Sn.</label></th>
                            <th><label>Product</label></th>
                            <th><label>Model</label></th>
                            <th><label>Serial</label></th>
                            <th><label>Warranty C.</label></th>
                            <th><label>MRP</label></th>
                            <th><label>Discount</label></th>
                            <th><label>VAT</label></th>
                            <th><label>TAX</label></th>
                            <th><label>Commision</label></th>
                            <th><label>Amount</label></th>
                        </tr>
                        </thead>
                        <tbody id="tablebody">
                        <?php for($i=1; $i<6; $i++){ ?> 
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <select row-id="<?php echo $i; ?>" class="pdrow">
                                <?php
                                $this->load->helper('mr_robot');
                                $producttypes = get_rows('product_types');
                                foreach($producttypes as $row){
                                ?>   
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->producttypename; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select name="model[]" id="pdrow<?php echo $i; ?>">
                                <?php
                                $this->load->helper('mr_robot');
                                $productmodels = get_rows('product_models', array('producttype'=>$producttypes[0]->id));
                                foreach($productmodels as $row){
                                ?> 
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->modelname; ?></option>
                                <?php } ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="productserialno[]" value="">
                            </td>
                            <td>
                                <input type="text" name="warrantycardno[]" value="">
                            </td>
                            <td>
                                <input type="text" name="productMRP[]" value="" class="productMRP" >
                            </td>
                            <td>
                                <input type="text" name="discount[]" value="" >
                            </td>
                            <td>
                                <input type="text" name="vatamount[]" value="" >
                            </td>
                            <td>
                                <input type="text" name="taxamount[]" value="" >
                            </td>
                            <td>
                                <input type="text" name="commision[]" value="" >
                            </td>
                            <td>
                                <input type="text" name="actualprice[]" value="" >
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-effect-ripple btn-primary" id="add-more-rows" name="continue" value="continew">Save &amp; Continue to Add</button>
                            <button type="submit" class="btn btn-effect-ripple btn-danger" name="exit" value="exit">Save &amp; Exit</button>
                            <!-- <button type="reset" class="btn btn-effect-ripple btn-default">Reset</button> -->
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

<script type="text/javascript">

$( document ).ready(function(){
    // if (c_id == null || c_id ==''){
        $(".input-datepicker").datepicker({
            dateFormat: "yy-mm-dd"
        }).datepicker("setDate", "0");
    // }
   $('.pdrow').change(function(){
        var rowid = $(this).attr('row-id');
        var productid = $(this).val();
        $.ajax({
            type : 'get',
            url : "<?php echo base_url('ajax/get_models'); ?>",
            data: {'productid' : productid},
            success : function ( data ){
                $('#pdrow'+rowid).html(data);
            }
        });
    });
    $('.productMRP').change(function(){
    	console.log('Hello Nepal');
    });
});
// function tablerows(){
//     var rows = $('#rowsno').val();
//     console.log(rows)
//     for(var i = 1; i<= rows; i++)
//     $('#tablebody').append('<tr><td>'+i+'</td><td>test</td><td><input type="number" name="productquantity[]" min="1" ></td></tr>');
// }
</script>