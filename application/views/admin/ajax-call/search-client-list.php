<?php if(!empty($clients)){ ?> 
<table id="example-datatable" class="table table-striped table-bordered table-vcenter">
    <thead>
        <tr>
            <th>Sn</th>
            <th>Businessname</th> 
            <th class="hidden-xs">Name</th> 
            <th>Address</th>
            <th>City</th>
            <th>Landmark</th>
            <th>Phone no.</th>
            <!-- <th>Status</th> -->
            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
        </tr>
    </thead>
    <tbody>
    
    <?php 
    foreach($clients as $k=>$r) { ?>
    <tr>
        <td><strong><?php echo $k+1 ?></strong></td>
        <td><strong><?php echo $r->businessname ?></strong></td>
        <td class="hidden-xs"><?php echo $r->firstname.' '.$r->lastname; ?></td>
        <td><?php echo $r->address ?></td>
        <td><?php echo $r->city ?></td>
        <td><?php echo $r->landmark ?></td>
        
        <td> <strong><?php echo $r->phone1; ?></strong></td>
        <!-- <td><?php echo ucfirst($r->status); ?></td> -->
        <td class="text-center">
            <a href="#" data-toggle="tooltip" title="Select this Client" class="btn btn-effect-ripple btn-xs btn-success client-select" id-businessname="<?php echo $r->businessname; ?>" id-fullname="<?php echo $r->firstname.' '.$r->lastname; ?>" id-clientid="<?php echo $r->id; ?>" id-cityaddress="<?php echo $r->city.' '.$r->address; ?>" id-landmark="<?php echo $r->landmark; ?>" ><i class="fa fa-pencil"></i></a>
        </td>
    </tr>
    <?php } ?>

	</tbody>
</table>


<script type="text/javascript">
$(function(){
$('.client-select').click(function(e){
    	e.preventDefault();
        
        var businessname = $(this).attr('id-businessname');
        var fullname = $(this).attr('id-fullname');
        var landmark = $(this).attr('id-landmark');
        var cityaddress = $(this).attr('id-cityaddress');
        // alert($('.cname').text());
        var clientid = $(this).attr('id-clientid');
         $.ajax({
            url: '<?php echo base_url(); ?>'+'ajax_call/populate_client_info',
            method: 'GET',
            data: {'clientid': clientid, 'businessname': businessname, 'fullname': fullname, 'cityaddress': cityaddress, 'landmark': landmark, },
            success: function( data ){
                console.log('yes');
                // console.log(data);
                $('#client-info').html(data);
                // $('#call-info').html(data);
                // $("call-info").load("demo_test.txt");
                $("#call-info").load("<?php echo base_url().'ajax_call/load_call_info_n_activity'; ?>");
                $('#close').click();
            // $('#businessname').text($(this).attr('id-businessname'));
            // $('#address').text($(this).attr('id-address'));
            // $('#landmark').text($(this).attr('id-landmark'));
            // $('#loadshedding').text($(this).attr('id-loadshedding'));
            // $('#clientid').val($(this).attr('id-clientid'));
            // $('#close').click();
            // $('#client-property').text('Property Loading...')
        // $.ajax({
        //     url: '<?php // echo base_url(); ?>'+'ajax/populate_client_property',
        //     method: 'GET',
        //     data: {'clientid': clientid },
        //     success: function( data ){

        //         $('#client-property').html(data);
        //         // alert(data);
        //         // $('#searched-client').html(data);
        //         // var response = JSON.parse(data);
        //         // if(response.status == 200){
        //         //     alert(response.message);
        //         // }else location.reload();
            }
        });
    });
});
</script>
<script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script>
<?php }else echo 'You Dont have any clients'; ?>