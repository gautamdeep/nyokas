<table class="inputtable2">
<tr class="inputrow">
	<td>
    <label class="firstlabel">Client Name: </label>
    <input type="hidden" name="clientid" id="clientid" value="<?php echo (empty($clientinfo) ? '' : $clientinfo['clientid']);?>" >
    <label id="businessname"><?php echo (empty($clientinfo) ? '' : $clientinfo['businessname']);?></label>                            
</td>
<td>
    <label class="firstlabel">Full Name: </label>
    <label id="
    fullname"><?php echo (empty($clientinfo) ? '' : $clientinfo['fullname']);?> </label>                            
</td>

<td>
    <label class="firstlabel">City/Address: </label>
    <label id="cityaddress"><?php echo (empty($clientinfo) ? '' : $clientinfo['cityaddress']);?></label>
</td>
<td>
    <label class="firstlabel">Landmark: </label>
    <label id="landmark"><?php echo (empty($clientinfo) ? '' : $clientinfo['landmark']);?></label>
</td>
</tr>
<!-- <tr class="inputrow">
    <td>
        <label class="firstlabel">Contact Person </label>
        <input type="text" name="" value="<?php //echo (isset($clientinfo['regby_name'])) ? $clientinfo['regby_name']:''; ?>" >                            
    </td>
    <td>
        <label class="firstlabel">Contact No</label>
        <input type="text" name="" value="<?php //echo (isset($clientinfo['regby_name'])) ? $clientinfo['regby_name']:''; ?>" >                            
    </td>
</tr> -->
</table>