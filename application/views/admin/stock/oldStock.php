<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Old Stock <?php echo isset($record['0']->id) ? 'Update': 'Entry'; ?></h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Old Stock</li>
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
                <?php } ?>

                <!-- General Elements Content -->
                <form action="<?php echo base_url('panel/oldStock') ?>" method="post" class="form-horizontal">
                    <input type="hidden" name="stockid" value="<?php echo isset($stock['stockid']) ? $stock['stockid']: ''; ?>">
                    <?php //if(!empty($stock)) print_r($stock); ?>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Notes</label>
                        <div class="col-md-4">
	                        <textarea name="note" class="form-control" <?php echo !empty($stock['note'])? 'readonly' : ''; ?>><?php echo !empty($stock['note'])? $stock['note'] : ''; ?></textarea>
                            <!-- <input type="text" name="enteredby" class="form-control" <?php echo !empty($stock['enteredby'])? 'value="'.$stock['enteredby'].'" readonly':''; ?>> -->
                        </div>
                        <!-- <label class="col-md-2 control-label">Entry Date</label>
                        <div class="col-md-3">
                            <input type="text" name="entereddate"  class="input-datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($stock['entereddate'])? 'value="'.$stock['entereddate'].'" readonly':''; ?>>
                        </div> -->
                    </div> 
                    <hr>
                    <table class="table table-bordered table-vcenter entry">
                        <thead>
                        <tr>
                            <th><label>Sn.</label></th>
                            <th><label>Product Type</label></th>
                            <th><label>Model Name</label></th>
                            <th><label>Quantity</label></th>
                            <th><label>MRP</label></th>
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
                                <input type="number" name="productquantity[]" value="" min="1" >
                            </td>
                            <td>
                                <input type="text" name="productMRP[]" value="" >
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
    // $('#add-more-rows').click(function(e){
    //     e.preventDefault();
    //     // tablerows();
    //     // $('#tablebody').append(formresult);
    // });
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
});
// function tablerows(){
//     var rows = $('#rowsno').val();
//     console.log(rows)
//     for(var i = 1; i<= rows; i++)
//     $('#tablebody').append('<tr><td>'+i+'</td><td>test</td><td><input type="number" name="productquantity[]" min="1" ></td></tr>');
// }
</script>