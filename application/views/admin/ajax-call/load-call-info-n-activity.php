<?php $this->load->helper('mr_robot');  
    //$complain_type= get_rows('complain_type');
?>
<fieldset>
<legend>Call Information</legend>
<table class="inputtable2">
<tr class="inputrow">
<td>
    <label class="firstlabel">Property Type</label>
    <select name="propertytypeid">
        <option value="1">— Select Product —</option>
        <?php 
        $propertytypes = get_rows('property_types');
        foreach($propertytypes as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->propertytypeid)) &&  $row->id == $record->propertytypeid? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
        
    </select>
</td>
<td>
    <label class="firstlabel">Call Type</label>
    <select name="calltypeid">
        <option value="1">— Select Any Type —</option>
        <?php 
        $calltypes = get_rows('call_types');
        foreach($calltypes as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->calltypeid)) &&  $row->id == $record->calltypeid? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
<td>
    <label class="firstlabel">Term</label>
    <select name="term">
        <option value="0">— Select Term —</option>
        <?php 
        $callterm = get_rows('call_term');
        foreach($callterm as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->term)) &&  $row->id == $record->term? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
<td>
    <label class="firstlabel">Source</label>
    <select name="callsource">
        <option value="0">— Select Source —</option>
         <?php 
        $callsource = get_rows('call_source');
        foreach($callsource as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->callsource)) &&  $row->id == $record->callsource? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
    </select>
</td>
 

</tr>
<tr class="inputrow">

<td>
    <label class="firstlabel">Reg. By</label>
    <input type="text" name="regby_name" value="<?php echo (isset($record->regby_name)) ? $record->regby_name:''; ?>" >
</td>
<td>
    <label class="firstlabel">Reg.Phone</label>
    <input type="text" name="regby_phone" value="<?php echo (isset($record->regby_phone)) ? $record->regby_phone:''; ?>" >
</td>
<td>
    <label class="firstlabel" for="text-input">Reg Date/Time</label>
    <input type="text" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($record->reg_datetime)? 'value="'.$record->reg_datetime.'"':''; ?> ">
</td>
<td>
    <label class="firstlabel" for="text-input">Due Date/Time</label>
    <input type="text" id="date" name="duedatetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($record->duedatetime)? 'value="'.$record->duedatetime.'"':''; ?> ">
</td>
</tr>

<tr class="inputrow">
<!--  <td colspan="2">
    <label>Complain Type</label>
    <select id="example-chosen-multiple" name="complaintype[]" class="js-example-placeholder-multiple js-states" data-placeholder="Choose Complain.." style="width: 250px;" multiple="multiple" required>
    <?php foreach($complain_type as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php //echo (in_array($row->id, $complaintype)? 'selected="selected"': ''); ?>>
            <?php echo $row->name; ?>
        </option>
        <?php } ?>
    </select>
</td> -->

</tr>
<tr>
<td>
    <label class="firstlabel">Urgent</label>
    <input type="checkbox" class="checkmark" name="priority" value="1" checked>
</td>

<td>
    <label class="firstlabel">Call Detail</label>
    <textarea name="calldetail" placeholder="Call Detail"><?php echo (isset($record->calldetail)) ? $record->calldetail:''; ?></textarea>
</td>
</tr>
</table>
</fieldset>

<fieldset>
<legend>Call Activity</legend>
<table class="inputtable2">
<tr class="inputrow">
<td>
    <label class="firstlabel">Status</label>
    <select name="callstatus">
        <option value="0">— Select Call Status —</option>
        <?php 
         $callstatus = get_rows('call_status');
        foreach($callstatus as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->callstatus)) &&  $row->id == $record->callstatus? 'selected':$row->id==2? 'selected':''; ?>>
            <?php echo $row->title; ?>
        </option>
        <?php } ?>
        <!-- <option value="1">Open</option>
        <option value="8">Process</option>
        <option value="8">Review</option>
        <option value="8">Closed</option> -->
    </select>
    <!-- <input type="text" name="complainerpost" value="" > -->
</td>


</tr>
<tr>
<td>

    <label class="firstlabel">Job Assign To</label>
    <select name="jobassign">
        <option value="0">— Select Technician —</option>
        <?php 
        $employee = get_rows('employees',array('post'=>'Technician'));
        foreach($employee as $row){ ?> 
        <option value="<?php echo $row->id; ?>" <?php echo (isset($record->job_assign)) &&  $row->id == $record->job_assign? 'selected':''; ?>>
            <?php echo $row->firstname; ?>
        </option>
        <?php } ?>
    </select>
</td>

</tr>
<tr>
<td rowpan="2">
    <label class="firstlabel">Internal Note</label>
    <textarea name="internalnote" style="width:435px"><?php echo (isset($record->internalnote)) ? $record->internalnote:''; ?></textarea>
</td>
</tr>
</table>


</fieldset>
<div class="form-group form-actions">
<div class="col-md-9">
<?php if(empty($record)) { ?> 
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="continue">Save &amp; Continue</button>
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="add">Save &amp; Add New</button>
<button type="submit" class="btn btn-effect-ripple btn-primary" name="submit" value="view">Save &amp; View</button>
<button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button>
<?php }else{ ?>
<button type="submit" class="btn btn-effect-ripple btn-success" name="submit" value="update">Update</button>
<?php } ?>
</div>
</div>
<script type="text/javascript">
    $(".js-example-placeholder-single").select2({
      placeholder: "Select a state",
      allowClear: true
    });

    $(".js-example-placeholder-multiple").select2({
      placeholder: "Select a state"
    });
    $(".input-datepicker").datepicker().datepicker("setDate", new Date());
</script>
