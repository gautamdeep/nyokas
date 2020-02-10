<?php $this->load->helper('mr_robot');  
    $complain_type= get_rows('complain_type');
?>
<fieldset>
    <legend>Property Information</legend>
    <div class="">

    <form id="property-complain" name="property-complain">
    <table class="table table-bordered table-vcenter entry">
        <thead>
        <tr>
            <th class="text-center sorting_disabled" style="width: 74px;" rowspan="1" colspan="1" aria-label=""><i class="fa fa-flash"></i></th>
            <th><label>Brand</label></th>
            <th><label>Model Name</label></th>
            <th><label>Capacity</label></th>
            <th><label>Type</label></th>
            <th><label>Location/Room</label></th>
            <th style="min-width:400px"><label>Complain</label></th>
        </tr>
        </thead>
        <tbody id="tablebody">
            <tr>
            <?php if(!empty($property)){ ?> 
                <!-- <td><?php echo $i+1; ?></td> -->
                <input type="hidden" name="complainid" value="<?php echo (empty($complainid) ? '' : $complainid);?>">
                <input type="hidden" name="propertyid" value="<?php echo (empty($property) ? '' : $property->id);?>">
                <td class="text-center">
                    <a href="#modal-change" data-toggle="modal" class="btn btn-effect-ripple btn-xs btn-success" id="change-property" data-clientid="<?php echo $complain->clientid; ?>" data-complainid="<?php echo $complain->id; ?>" data-original-title="Change Property"><i class="fa fa-pencil"></i></a>
                </td>
                <td><?php echo empty($property->brand)?'':$property->brand; ?></td>
                <td><?php echo empty($property->modelnumber)?'':$property->modelnumber; ?></td>
                <td><?php echo empty($property->capacityinton)?'':$property->capacityinton; ?> TON</td>
                <td><?php echo empty($property->type)?'':$property->type; ?></td>
                <td><?php echo empty($property->location)?'':$property->location; ?></td>
                <?php  
                    $complaintype = explode(",",$complain->complaintype); 
                    $db_complaintype= get_rows('complain_type');
                    $postfix = $complainlist = '';
                    foreach($complaintype as $row){
                        // if (in_array($row, $db_complaintype))
                        $complainlist .= $postfix.$db_complaintype[$row-1]->name ;
                        $postfix = ', ';
                        // $complainlist = ($db_complaintype->id == $row);
                    }

                ?>
                <td><div>
                <!-- <input type="text" name="complain" value="<?php echo $complainlist; ?>" > -->
                <p>
                    <select name="complaintype[]" class="js-example-placeholder-multiple js-states" multiple="multiple">
                    <?php foreach($db_complaintype as $row){ ?> 
                        <option value="<?php echo $row->id; ?>" <?php echo (in_array($row->id, $complaintype)? 'selected="selected"': ''); ?>>
                            <?php echo $row->name; ?>
                        </option>
                        <?php } ?>
                    </select>
                </p></div>
                </td>

                <?php } ?>
            </tr>
        </tbody>
    </table>
    <button type="submit" id="update-property-complain" class="btn btn-effect-ripple btn-success" name="submit" value="update">Update Property</button>
    </form>
    </div>
</fieldset>


<div id="modal-change" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width:900px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Select any One <strong>Property</strong></h3>
            </div>
            <div class="modal-body">
                <div class="box span3">
                    <div class="box-content" id="content-property"></div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-effect-ripple btn-danger" id="close1" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#change-property').click(function(e){
        e.preventDefault(e);
        // var clientid = $(this).attr('data-clientid'); 
        var clientid =  $("input[name='clientid']").val(); 
        var complainid = $(this).attr('data-complainid'); 
        $.ajax({
            url: '<?php echo base_url(); ?>'+'ajax_complain/populate_client_property_for_change',
            method: 'GET',
            data: {'clientid': clientid, 'complainid': complainid },
            success: function( data ){
                $('#content-property').html(data);
            }
        });

        // $('#close1').click();
    });
    // $( "#property-complain" ).submit(function( event ) {

</script>