<table class="inputtable2">
    <tr class="inputrow">
   		<td>
            <label class="firstlabel">Client Name: </label>
            <input type="hidden" name="clientid" id="clientid" value="<?php echo (empty($record) ? '' : $record->clientid);?>" >
            <label id="businessname"><?php echo (empty($record) ? '' : $record->businessname);?></label>                            
        </td>
        <td>
            <label class="firstlabel">Full Name: </label>
            <label id="businessname"><?php echo (empty($record) ? '' : $record->businessname);?></label>                            
        </td>
   
        <td>
            <label class="firstlabel">City/Address: </label>
            <label id="address"><?php echo (empty($record) ? '' : $record->address);?></label>
        </td>
        <td>
            <label class="firstlabel">Landmark: </label>
            <label id="landmark"><?php echo (empty($record) ? '' : $record->landmark);?></label>
        </td>
        <!-- <td>
            <label>Loadshedding: </label>
            <label id="loadshedding"><?php echo (empty($record) ? '' : $record->loadshedding);?></label>
        </td> -->
    </tr>
    <tr class="inputrow">
        <td>
            <label class="firstlabel">Contact Person </label>
            <input type="text" name="" value="<?php echo (isset($record->regby_name)) ? $record->regby_name:''; ?>" >                            
        </td>
        <td>
            <label class="firstlabel">Contact No</label>
            <input type="text" name="" value="<?php echo (isset($record->regby_name)) ? $record->regby_name:''; ?>" >                            
        </td>
</table>