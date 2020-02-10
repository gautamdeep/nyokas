<!-- Page content -->
<div id="page-content">
    <!-- Table Styles Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1><?php echo $title; ?></h1>
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

                <div class="block-title">
                    <h2>Add Loadshedding Group</h2>
                </div>

                <div class="add-edit-form">
                    <form action="<?php echo base_url('setting/loadshedding_group'); ?>" method="post" enctype="multipart/form-data" class="form-borderless">
                        <?php echo (!empty($record))? "<input type='hidden' name='id' value='".$record->id."'>":""; ?>
                        <div class="col-sm-4 form-group">
                            <label class="col-md-4 control-label" for="text-input">Group Name</label>
                            <div class="col-md-8">
                            <input type="text" id="groupname" name="groupname" class="form-control" value="<?php echo (empty($record) ? '' : $record->groupname);?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6 form-group">
                            <label class="col-md-3 control-label" for="text-input">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" rows="1"><?php echo (empty($record) ? '' : $record->description);?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-2 form-group"><button class="btn btn-success"><?php echo empty($record)? 'Add New':'Update'; ?></button></div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <hr>
                <table class="table table-striped table-borderless table-vcenter">
                    <thead>
                        <tr>
                            <th>Sno</th>
                            <th>Group Name</th>
                            <th>Description</th>
                            <th style="width: 80px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($records as $k=>$r) { ?>
                        <tr id="tabl">
                            <td><?php echo $k+1 ?></td>
                            <td class="grpname"><?php echo $r->groupname ?></td>
                            <td><?php echo $r->description ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("setting/loadsheddingGroup/".$r->id) ?>" data-toggle="tooltip" title="Edit <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo base_url("delete/index/loadshedding_group/".$r->id) ?>" data-toggle="tooltip" title="Delete <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-danger"  onclick="return confirm('Are you Sure?');"><i class="fa fa-times"></i></a>
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
</script