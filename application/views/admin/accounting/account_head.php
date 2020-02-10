<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><?php echo (empty($record) ? 'Add' : 'Update');?> Account Head</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Setting</li>
                        <li><a href=""><?php echo $title; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Table Styles Header -->

    <!-- Tables Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="block">
            <?php 
                if($this->session->flashdata('message')){ ?> 
                <script>
                    alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php } ?>

                <div class="add-edit-form">
                <fieldset>
                <legend>Account Head Entry</legend>
                <?php //$url = isset($record->id)? 'panel/client/'.$record->id:'panel/client'; ?>
                <form action="<?php echo base_url('accounting/account_head'); ?>" method="post" class="form-horizontal">
                <?php echo (!empty($record))? "<input type='hidden' name='id' value='".$record->id."'>":""; ?>
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>Title</label>
                                <input type="text" name="title" value="<?php echo (empty($record) ? '' : $record->title);?>" required>
                            </td>
                            <td>
                                <label>Description</label>
                                <input type="text" name="description" value="<?php echo (empty($record) ? '' : $record->description);?>"  >
                            </td>
                        </tr>
                        
                        
                    </table>
                    <div class="form-group form-actions">
                        <div class="col-md-9">
                        <button class="btn btn-success"><?php echo empty($record)? 'Add New':'Update'; ?></button>
                        </div>
                    </div>
                </form>
                </fieldset>
                </div>
                <hr>
                <table class="table table-striped table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th style="width: 80px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($records as $k=>$r) { ?>
                        <tr id="tabl">
                            <td><?php echo $k+1 ?></td>
                            <td><?php echo $r->title; ?></td>
                            <td><?php echo $r->description; ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("accounting/account_head/".$r->id) ?>" data-toggle="tooltip" title="Edit <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo base_url("delete/index/account_category/".$r->id) ?>" data-toggle="tooltip" title="Delete <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-danger" onclick="return confirm('Are you Sure?');"><i class="fa fa-times"></i></a>
                            </td>
                        <tr>
                    <?php } ?>
                    </tbody>
                </table>
                <!-- END Partial Responsive Content -->
            </div>
            <!-- END Partial Responsive Block -->
        </div>
    </div>
    <!-- END Tables Row -->

</div>
<!-- END Page Content -->
<script type="text/javascript">
$(function(){
    // $("input[name=='groupname']") console.log('yes');
    // console.log('start');
    $("#groupname").change(function(){
        $('td').filter(function(){
        if( $(this).text() === 'Group2') console.log('ttt');
    })
        // var tt = $('#groupname').val();
        // console.log(tt);
        // $( ".grpname:contains($('#groupname').val())" ).css( "text-decoration", "underline" );
        // if($( ".row:contains($('#input-value').val())" )) console.log("value found");
        // if( ".grpname:contains(tt)" ) console.log('baba rey baba');
         // var next = $("#tabl").find('.grpname').val();
        // var next = [];
        // $("tr").find("td").val(); 
        $.each($("tr").find("td").val(), function(key, value) {
            // keys.push(key);
            // values.push(value);
            console.log('1233');
        });
        console.log(next);
    });
});
</script>