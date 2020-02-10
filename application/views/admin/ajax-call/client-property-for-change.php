<?php //$this->load->helper('mr_robot');  
// $db_technician= get_rows('property');
?>
        <table class="table table-bordered table-vcenter entry">
            <thead>
            <tr>
                <th class="text-center sorting_disabled" style="width: 74px;" rowspan="1" colspan="1" aria-label=""><i class="fa fa-flash"></i></th>
                <th><label>Brand</label></th>
                <th><label>Type</label></th>
                <th><label>Model Name</label></th>
                <th><label>Capacity</label></th>
                <th><label>Location</label></th>
                <th><label>Assign Name</label></th>
            </tr>
            </thead>
            <tbody id="tablebody">
            <?php foreach($property as $row){ ?>
            <tr>
                <!-- <input type="hidden" name="clientid" value="<?php //echo $row->clientid; ?>"> -->
                <td class="text-center">
                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success select-property" style="overflow: hidden; position: relative;" data-id="<?php echo $row->id; ?>" data-propertyid="<?php echo $row->id; ?>" data-complainid="<?php echo $complainid; ?>" data-original-title="Select Property"><i class="fa fa-check"></i></a>
                </td>
                
                <td><input type="text" name="brand" value="<?php echo $row->brand; ?>" ></td>
                <td><input type="text" name="type" value="<?php echo $row->type; ?>" ></td>
                <td><input type="text" name="modelnumber" value="<?php echo $row->modelnumber; ?>" ></td>
                <td><input type="text" name="capacityinton" value="<?php echo $row->capacityinton; ?>" ></td>
                <td><input type="text" name="location" value="<?php echo $row->location; ?>" ></td>
                <td><input type="text" name="assignname" value="<?php echo $row->assignname; ?>" ></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
      
<script type="text/javascript">
$(function(){    
   $("a.select-property").click(function(){
        // var propertyid = $("input[name='propertyid']").val(); 
        var propertyid =$(this).attr('data-id');
        var complainid =$(this).attr('data-complainid');

        // $('#close1').click();
            $('#modal-change').modal("hide");
        $.ajax({
            url : '<?php echo base_url(); ?>'+'ajax_complain/update_complain_property',
            method : 'GET',
            data : { 'propertyid': propertyid , 'complainid': complainid },
            success : function( data ){
                var response = JSON.parse(data);
                if(response.status == 200){
                    // alert(response.message);
                    // $('#close1').click();
                    get_complain_property(complainid, propertyid);
                }else location.reload();
                // $('#property-complain').html(data);
            }
        });
        
    });
});
</script>