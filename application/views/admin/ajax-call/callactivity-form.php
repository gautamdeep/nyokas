<form action="#" method="post" name="callactivity-form" id="callactivity-form" class="form-horizontal">
    <input type="hidden" name="callid" value="<?php echo $callid; ?>" />
<div class="sc">
<table class="table table-bordered table-vcenter entry">
<thead>
<tr>
    <th><label>Sn</label></th>
    <th style="width:46px"><label>Rn</label></th>
    <th style="width:80px"><label>Date</label></th>
    <th style="min-width:150px"><label>Activity</label></th>
    <th><label>Material Used</label></th>
    <th style="width:46px"><label>Qty</label></th>
    <!-- <th><label>Technician</label></th> -->
    <th><label>Remark</label></th>
    <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
</tr>
</thead>
<tbody id="tablebody">
        <?php foreach($activity as $key=>$row){ ?> 
        <tr>
            <td><?php echo $key+1; ?><input type="hidden" name="activityid[<?php echo $key; ?>]" value="<?php echo $row->id; ?>"></td>
            <td><input type="text" name="reportno[<?php echo $key; ?>]" value="<?php echo $row->reportno; ?>" ></td>
            <td><input type="text" name="date[<?php echo $key; ?>]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" <?php echo !empty($row->date)? 'value="'.$row->date.'"':''; ?> "></td>
            
            <td><input type="text" name="activity[<?php echo $key; ?>]" value="<?php echo $row->activity; ?>" ></td>
            <td><input type="text" name="materialused[<?php echo $key; ?>]" value="<?php echo $row->materialused; ?>" ></td>
            <td><input type="text" name="quantity[<?php echo $key; ?>]" value="<?php echo $row->quantity; ?>" ></td>
            <td><input type="text" name="remarks[<?php echo $key; ?>]" value="<?php echo $row->remarks; ?>" ></td>
           <td class="text-center"><a class="activityrow" act-id="<?php echo $row->id; ?>" style="color:red; cursor: pointer"><i class="fa fa-minus-circle"></i></a></td>
        </tr>
        <?php } $c = count($activity); ?>
        <tr>
            <td><?php echo $c+1; ?></td>
            <input type="hidden" name="activityid[<?php echo $c; ?>]" value="">
            <td><input type="text" name="reportno[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="date[<?php echo $c; ?>]" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd"  "></td>
            <td><input type="text" name="activity[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="materialused[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="quantity[<?php echo $c; ?>]" value="" ></td>
            <td><input type="text" name="remarks[<?php echo $c; ?>]" value="" ></td>
            <td class="text-center"><i class="fa fa-plus"></i></td>
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
        </tr>
    </tbody>
</table>
</div>
<div class="form-group form-actions">
    <div class="col-md-12 pull-right">
        <button type="submit" id="update-activity" class="btn btn-effect-ripple btn-primary" name="submit" value="update">Save Activity</button>
    </div>
</div>
</form>
<script type="text/javascript">
$( "#callactivity-form" ).submit(function( event ) {
    event.preventDefault();
    $.ajax({
       type: "POST",
       url: "<?php echo base_url('ajax_call/post_callactivity_form'); ?>",
       data: $("#callactivity-form").serialize(), 
       success: function(data)
       {
            var response = JSON.parse(data);
            if(response.status == 200){
                get_callactivity_form();
                alert(response.message);
            }else location.reload();
       }
    });
});
$('a.activityrow').click(function() { 
        var act_id =($(this).attr('act-id'));
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('ajax_call/del_callactivity_row'); ?>",
            data: {act_id: act_id},
            success: function(data)
            {
                var response = JSON.parse(data);
                if(response.status == 200){
                    get_callactivity_form();
                    alert(response.message);
                }else location.reload();
            }
        });
    });   
</script>