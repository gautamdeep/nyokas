<?php
    $this->load->helper('mr_robot');
    $status= get_rows('status');
    $brands= get_rows('brands');
?>
<!-- Page content -->
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
                <?php $url = isset($record->id)? 'panel/new_complain/'.$record->id:'panel/new_complain'; ?>
                <form action="<?php echo base_url($url) ?>" method="post" class="form-horizontal">
                    <!-- <input type="hidden" name="complainid" value="<?php echo isset($record->id) ? $record->id: ''; ?>"> -->
                    <fieldset>
                    <legend>Client Information</legend>
                    <a href="#modal-fade" title="" class="btn btn-effect-ripple btn-xs btn-info view-modal search-customer" data-toggle="modal" data-id="" >
                        <?php echo (empty($record)) ? 'Select ' : 'Change ';?> <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                    <a href="<?php echo base_url('panel/client'); ?>" class="btn btn-xs btn-success" id="">Add New</a>
                    <p id="a1"></p>
                    <!-- <a href="#modal-fade"><i class="fa fa-search search-customer" aria-hidden="true"></i></a> -->
                    <table class="inputtable2">
                        <tr class="inputrow">
                       		<td>
                                <label>Business Name</label>
		                    	<input type="hidden" name="clientid" id="clientid" value="<?php echo (empty($record) ? '' : $record->clientid);?>" >
                                <label id="businessname"><?php echo (empty($record) ? '' : $record->businessname);?></label>                            
                            </td>
                            <td>
                                <label>Address</label>
                                <label id="address"><?php echo (empty($record) ? '' : $record->address);?></label>
                            </td>
                            <td>
                                <label>Landmark</label>
                                <label id="landmark"><?php echo (empty($record) ? '' : $record->landmark);?></label>
                            </td>
                            <td>
                                <label>Loadshedding</label>
                                <label id="loadshedding"><?php echo (empty($record) ? '' : $record->loadshedding);?></label>
                            </td>
                        </tr>
                    </table>
                    </fieldset>

                    <div id="client-property"></div>
                    <div id="property-complain"></div>
                    
                    
                    
                        
                    
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
       
        $('input[name="businessname"]').on('blur', function() {
          //your ajax call
        });
        $('#businessname').focusout(function() {
        })
        $('#businessname').on('blur', function() {
            //your ajax call
        });
        $('a.search-customer').click(function(e){
            // var id = $(this).attr('data-id');
            $.ajax({
                url: '<?php echo base_url(); ?>'+'ajax/search_client_fornewcomplain',
                method: 'get',
                // data: {'id': id},
                success: function( data ){
                    $('#searched-customer').html(data);
                }
            });
        });
        // $('#businessname').on('input',function(e){
        //  alert('Changed!')
        // });
        // $('#businessname').keyup(function () { alert('test'); });
        // var $hello= $('[id$="businessname"]');

        // $hello.on("change", function(){ //bind() for older jquery version
        //     alert('hey');
        // }).triggerHandler('change'); //could be change() or trigger('change')
        // $("#clientid").keyup(function() {
        //     if (!this.value) {
        //         alert('The box is empty');
        //     }

        // });
        // $('#complainer').on('change', function() {
        //     alert('hey you');
        // });
        // $('#clientid').change(function() {
        // var $changedElement = $(this);
            // alert('hey your');
        // if($changedElement.val() != '') {
            // code to keep track of which elements are checked..
        // });
        // });
        // get_products();
        // $(".input-datepicker").datepicker().datepicker("setDate", new Date());
        var c_id = "<?php echo isset($record->id)? $record->id: null; ?>";
        if (c_id == null || c_id ==''){
            $(".input-datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            }).datepicker("setDate", "0");
        }
    });
    //     // $(".input-datepicker").datepicker();
    //     // $(".input-datepicker").datepicker("setDate", new Date());
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
// function get_products( jQuery ) {
//     var product_id = "<?php echo isset($record->producttypeid)? $record->producttypeid: ''; ?>";
//     $.ajax({
//         url : '<?php echo base_url("ajax/get_products"); ?>',
//         success: function ( data ){
//             $('#get-products').html(data);
//             $('.get-products option[value='+product_id+']').prop('selected', true);
//         }
//     });
// }

</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>