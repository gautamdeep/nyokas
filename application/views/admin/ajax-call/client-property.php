<?php //$this->load->helper('mr_robot');  
// $db_technician= get_rows('property');
?>
<fieldset>
    <legend>Product Information</legend>
        <div style="max-height: 300px; overflow-y:scroll;">
        <table class="table table-bordered table-vcenter entry">
            <thead>
            <tr>
                <!-- <th><label><i class="fa fa-flash"></i></label></th> -->
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
                <input type="hidden" name="propertyid" value="<?php echo $row->id; ?>">
                <td class="text-center">
                    <a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-effect-ripple btn-xs btn-success select-property" style="overflow: hidden; position: relative;" data-id="<?php echo $row->id; ?>" data-original-title="Select Property"><i class="fa fa-check"></i></a>
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
      
    </div>
</fieldset> 
<script type="text/javascript">
$(function(){    
   $("a.select-property").click(function(){
        var propertyid = $("input[name='propertyid']").val();  

        $.ajax({
            url : '<?php echo base_url(); ?>'+'ajax/property_complain',
            method : 'GET',
            data : { 'propertyid': propertyid },
            success : function( data ){
                $('#property-complain').html(data);
            }
       });   
    });
});
</script>