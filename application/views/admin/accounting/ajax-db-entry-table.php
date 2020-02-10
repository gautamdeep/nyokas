<?php
    $this->load->helper('mr_robot');
    $categories = get_rows('account_category');
?>

<table id="" class="table table-striped table-bordered table-vcenter">
    <thead>
        <tr>
            <th style="width: 50px">Sn</th>
            <!-- <th class="hidden-xs">CallID</th> -->
            <th style="width: 250px">Category</th> 
            <th style="width: 120px">Bill Type</th>
            <th style="width: 150px">Amount</th>
            <th>Detail</th>
            <th style="width: 60px;" class="text-center"><i class="fa fa-flash"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php //$key = 0; 
        if(!empty($db_data)) {
            // print_r($db_data);
        $totalAmt = 0;
        foreach($db_data as $key=>$db_row) { 
            $totalAmt = $totalAmt + $db_row->amount;
        ?>
        <tr>
            <td>&nbsp;&nbsp;<?php echo $key+1 ?></td>
            <td>
                <select name="categoryid[<?php echo $db_row->id ?>]" id="categoryid-<?php echo $db_row->id ?>" class="form-control">
                <?php foreach($categories as $row){ ?> 
                <option value="<?php echo $row->id; ?>" <?php echo (isset($db_row->categoryid)) &&  $db_row->categoryid == $row->id? 'selected':''; ?>>
                    <?php echo $row->title; ?>
                </option>
                <?php } ?>

                </select>
            </td>
            <td>
                <select name="billtype[<?php echo $db_row->id ?>]" id="billtype-<?php echo $db_row->id ?>" class="form-control">
                    <option value="VB" <?php echo (isset($db_row->billtype)) &&  $db_row->billtype == "VB"? 'selected':''; ?>>VAT Bill</option>
                    <option value="PB" <?php echo (isset($db_row->billtype)) &&  $db_row->billtype == "PB"? 'selected':''; ?>>PAN Bill</option>
                    <option value="NB" <?php echo (isset($db_row->billtype)) &&  $db_row->billtype == "NB"? 'selected':''; ?>>NO Bill</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="amount-<?php echo $db_row->id ?>" name="amount[<?php echo $db_row->id ?>]" value="<?php echo (isset($db_row->amount))? $db_row->amount:''; ?>" /></td>
            <td><input type="text" class="form-control" id="detail-<?php echo $db_row->id ?>" name="detail[<?php echo $db_row->id ?>]"  value="<?php echo (isset($db_row->detail))? $db_row->detail:''; ?>" /></td>
            <td class="text-center">
                <a style="float:left"href="" data-toggle="tooltip" title="Add DB" id-key="<?php echo $db_row->id ?>" class="save-db-entry btn btn-effect-ripple btn-xs btn-primary"><i class="fa fa-pencil"></i></a>

                <a href="<?php //echo base_url("admin/delete/complains/".$r->id) ?>" data-toggle="tooltip" title="Delete Entry" id-key="<?php echo $db_row->id ?>" class="btn btn-effect-ripple btn-xs btn-danger deletebtn"><i class="fa fa-times"></i></a>
            </td>
        </tr>
        <?php }
        } ?>
        <tr>
            <td>&nbsp;&nbsp;[New]</td>
            <td>
                <select name="categoryid0" id="categoryid-0" class="form-control">
                <?php foreach($categories as $row){ ?> 
                <option value="<?php echo $row->id; ?>" >
                    <?php echo $row->title; ?>
                </option>
                <?php } ?>

                </select>
            </td>
            <td>
                <select name="billtype[0]" id="billtype-0" class="form-control">
                    <option value="VB">VAT Bill</option>
                    <option value="PB">PAN Bill</option>
                    <option value="NB">NO Bill</option>
                </select>
            </td>
            <td><input type="text" class="form-control" id="amount-0" name="amount[0]" /></td>
            <td><input type="text" class="form-control" id="detail-0" name="detail[0]" /></td>
            <td class="text-center">
                <a href="" data-toggle="tooltip" title="Add DB" id-key="0" class="save-db-entry btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-plus"></i></a>
                <!-- <a href="<?php //echo base_url("admin/delete/complains/".$r->id) ?>" data-toggle="tooltip" title="Delete Complain" class="btn btn-effect-ripple btn-xs btn-danger"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a> -->
            </td>
        </tr>
    </tbody>
</table>
<?php echo (isset($totalAmt))? '<h4>&nbsp;&nbsp;Total Expenses Amount = Rs. <strong>'.$totalAmt.'</strong></h4>':''; ?>
<script type="text/javascript">
$(".deletebtn").click(function(e) {
    e.preventDefault();
    var check = confirm("Are you sure you want to delete this item?");
        if (check == true) {
            tempAlert("Deleting ...",1000);
            var datenep = $('#date-nep').val();
            var key = $(this).attr("id-key");
            $.ajax({
                url: '<?php echo base_url(); ?>'+'accounting/ajax_delete_db_entry',
                method: 'post',
                data: {'id': key, 'datenep': datenep},
                success: function (data) {
                    $('#db-entry-table').html(data);
                    console.log('deletion');
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        }
        else {
            return false;
        }
});
$("input").focus(function() { 
    $(this).css("font-weight", "bold"); 
    $(this).css("color", "#000"); 
}); 
$("input").blur(function() { 
    $(this).css("font-weight", "normal"); 
    $(this).css("color", "#454e59"); 
});
$("select").focus(function() { 
    $(this).css("font-weight", "bold"); 
     $(this).css("color", "#000");
}); 
$("select").blur(function() { 
    $(this).css("font-weight", "normal"); 
    $(this).css("color", "#454e59"); 
}); 
$('a.save-db-entry').click(function(e){
    e.preventDefault();
    // alert($(this).attr("id-key") );
    var datenep = $('#date-nep').val();
    var key = $(this).attr("id-key");
    var categoryid = $('#categoryid-'+key).val();
    var billtype = $('#billtype-'+key).val();
    var amount = $('#amount-'+key).val();
    var detail = $('#detail-'+key).val();
    if (amount == null || amount == ""|| amount == "0"|| amount <= "0") {
      alert("Amount incorrect");
      return false;
    }
    // alert(formdata.serialize());
    tempAlert("Saving ...",1000);
    $.ajax({
        url: '<?php echo base_url(); ?>'+'accounting/ajax_save_db_entry',
        method: 'post',
        data: {'id': key, 'datenep': datenep, 'categoryid': categoryid, 'billtype': billtype, 'amount': amount, 'detail': detail},
        success: function (data) {
            $('#db-entry-table').html(data);
            // setTimeout(function(){
                // alert("Using setTimeout in jQuery");}, 2000);
            
            console.log('Submission was successful.');
            // console.log(data);
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
});
function tempAlert(msg,duration)
{
     var el = document.createElement("div");
     el.setAttribute("style","position:fixed;top:30%;left:50%;background-color:#ecf9d5;padding:6px 80px; border:1px solid #7dc402; border-radius:20px;font-weight:bold");
     el.innerHTML = msg;
     setTimeout(function(){
      el.parentNode.removeChild(el);
     },duration);
     document.body.appendChild(el);
}
</script>
