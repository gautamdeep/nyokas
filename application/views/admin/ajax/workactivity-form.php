<?php $this->load->helper('mr_robot');  ?>
<form action="#" method="post" name="workactivity-form" id="workactivity-form" class="form-horizontal">
<input type="hidden" name="callid" value="<?php echo $callid; ?>" />
<fieldset>
<legend>Work Activity</legend>
<div class="sc">
	<table class="table table-bordered table-vcenter entry">
    <thead>
	    <tr>
	        <th><label>Step</label></th>
	        <th><label>AssumedProblem*</label></th>
	        <th style="min-width:400px"><label>Steps</label></th>
	        <th><label>Assumed Result</label></th>
	        <th><label>Actual Result</label></th>
	        <th><label>Material Used</label></th>
	        <!-- <th><label>Technician</label></th> -->
	        <th><label>Remark</label></th>
	    </tr>
    </thead>
    <tbody id="tablebody">
    	<?php foreach($records as $key=>$row){ ?> 
        <tr>
            <td><?php echo $key+1; ?></td>
            <input type="hidden" name="activityid[<?php echo $key; ?>]" value="<?php echo $row->id; ?>">
            <td><input type="text" name="assumedproblem[<?php echo $key; ?>]" value="<?php echo $row->assumedproblem; ?>" ></td>
            <td><input type="text" name="steps[<?php echo $key; ?>]" value="<?php echo $row->steps; ?>" ></td>
            <td><input type="text" name="assumedresult[<?php echo $key; ?>]" value="<?php echo $row->assumedresult; ?>" ></td>
            <td><input type="text" name="actualresult[<?php echo $key; ?>]" value="<?php echo $row->actualresult; ?>" ></td>
            <td><input type="text" name="materialused[<?php echo $key; ?>]" value="<?php echo $row->materialused; ?>" ></td>
            <!-- <td>
            <div><p>
                <select name="technician[<?php echo $key; ?>][]" class="js-example-placeholder-multiple js-states" multiple="multiple">
                    <?php
                    $technician = explode(",",$row->technician); 
                    $db_technician= get_rows('employees');
                    foreach($db_technician as $techrow){ ?> 
                    <option value="<?php echo $techrow->id; ?>" <?php echo (in_array($techrow->id, $technician)? 'selected="selected"': ''); ?>>
                        <?php echo $techrow->firstname; ?>
                    </option>
                    <?php } ?>
                </select>
            </p></div>
            </td>  -->
            <td><input type="text" name="remarks[<?php echo $key; ?>]" value="<?php echo $row->remarks; ?>" ></td>
        </tr>
        <?php } $c = count($records); ?>
        <tr>
            <td><?php echo $c+1; ?></td>
            <input type="hidden" name="activityid[<?php echo $c; ?>]" value="">
            <td><input type="text" name="assumedproblem[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="steps[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="assumedresult[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="actualresult[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="materialused[<?php echo $c; ?>]" value="" ></td>
           <!--  <td>
                <div><p>
            	<select name="technician[<?php echo $c; ?>][]" class="js-example-placeholder-multiple1 js-states" multiple="multiple">
                    <?php foreach($db_technician as $techrow){ ?> 
                    <option value="<?php echo $techrow->id; ?>">
                        <?php echo $techrow->firstname; ?>
                    </option>
                    <?php } ?>
                </select>
                </p></div>
            </td>  -->
            <td><input type="text" name="remarks[<?php echo $c; ?>]" value="" ></td>
        </tr>
    </tbody>
    </table>
</div>
<div class="form-group form-actions">
    <div class="col-md-9">
        <button type="submit" id="update-activity" class="btn btn-effect-ripple btn-success" name="submit" value="update">Save Activity</button>
    </div>
</div>
</fieldset>
</form>
<script type="text/javascript" class="js-code-placeholder">
// $(window).load(function() {
    $(".js-example-placeholder-single").select2({
      placeholder: "Select a state",
      allowClear: true
    });

    $(".js-example-placeholder-multiple1").select2({
      placeholder: "Select a state"
    });
// });
</script>

