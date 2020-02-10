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
            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php //for($i = 1; $i<=15; $i++) { ?>
        <tr>
            <td>&nbsp;&nbsp;<?php echo $i ?></td>
            <td>
                <select name="categoryid[]" class="form-control">
                <?php foreach($categories as $row){ ?> 
                <option value="<?php echo $row->id; ?>" >
                    <?php echo $row->title; ?>
                </option>
                <?php } ?>

                </select>
            </td>
            <td>
                <select name="billtype[]" class="form-control">
                    <option value="VB">VAT Bill</option>
                    <option value="PB">PAN Bill</option>
                    <option value="NB">NO Bill</option>
                </select>
            </td>
            <td><input type="text" class="form-control" name="amount[]" /></td>
            <td><input type="text" class="form-control" name="detail[]" /></td>
            <td class="text-center">
                <a href="" data-toggle="tooltip" title="Add DB" id="save-db-entry" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-plus"></i></a>
                <!-- <a href="<?php echo base_url("admin/delete/complains/".$r->id) ?>" data-toggle="tooltip" title="Delete Complain" class="btn btn-effect-ripple btn-xs btn-danger"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-times"></i></a> -->
            </td>
        </tr>
    <?php //} ?>
    </tbody>
</table>
<script type="text/javascript">
$('a#save-db-entry').click(function(e){
    e.preventDefault();
    var formdata = $('#db-entry-form');
    // alert(formdata.serialize());
    $.ajax({
        url: '<?php echo base_url(); ?>'+'accounting/ajax_save_db_entry',
        method: 'post',
        data: formdata.serialize(),
        success: function (data) {
            console.log('Submission was successful.');
            console.log(data);
        },
        error: function (data) {
            console.log('An error occurred.');
            console.log(data);
        },
    });
});
</script>