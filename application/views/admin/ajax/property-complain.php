<?php $this->load->helper('mr_robot');  
    $complain_type= get_rows('complain_type');
?>
<fieldset>
    <legend>Complain Information</legend>
    <table class="inputtable2">
     <tr class="inputrow">
        <td>
            <label>Complain By</label>
            <input type="text" name="complainer" id="complainer" value="">
        </td>
        <td>
            <label>Post</label>
            <input type="text" name="complainerpost" value="" >
        </td>
        <td>
            <label>Phone No</label>
            <input type="text" name="complainerphone" value="" >
        </td>
        <td>
            <label class="" for="text-input">Complain Date/Time</label>
            <input type="text" id="date" name="reg_datetime" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="">
        </td>
        
    </tr>
    <tr class="inputrow">
        <td colspan="2">
            <label>Complain Type</label>
            <select id="example-chosen-multiple" name="complaintype[]" class="js-example-placeholder-multiple js-states" data-placeholder="Choose Complain.." style="width: 250px;" multiple="multiple" required>
            <?php foreach($complain_type as $row){ ?> 
                <option value="<?php echo $row->id; ?>" <?php //echo (in_array($row->id, $complaintype)? 'selected="selected"': ''); ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
            </select>
        </td>
        <td colspan="2">
            <label>Complain Description *</label>
            <textarea name="complaindetail" style="width: 248px;" required></textarea>
        </td>
    </tr>
</table>
</fieldset>
<div class="form-group form-actions">
    <div class="col-md-9">
    <?php if(empty($record)) { ?> 
        <button type="submit" class="btn btn-effect-ripple btn-primary" name="submit" value="view">Save &amp; View</button>
        <!-- <button type="reset" class="btn btn-effect-ripple btn-danger">Reset</button> -->
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
