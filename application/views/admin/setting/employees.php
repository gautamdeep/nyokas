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
                    <h2>Add Employee</h2>
                </div>

                <div class="add-edit-form">
                <fieldset>
                <legend>Employee Entry</legend>
                <?php //$url = isset($record->id)? 'panel/client/'.$record->id:'panel/client'; ?>
                <form action="<?php echo base_url('setting/employees'); ?>" method="post" class="form-horizontal">
                <?php echo (!empty($record))? "<input type='hidden' name='id' value='".$record->id."'>":""; ?>
                    <table class="inputtable2">
                        <tr class="inputrow">
                            <td>
                                <label>First Name</label>
                                <input type="text" name="firstname" value="<?php echo (empty($record) ? '' : $record->firstname);?>" >
                            </td>
                            <td>
                                <label>Last Name</label>
                                <input type="text" name="lastname" value="<?php echo (empty($record) ? '' : $record->lastname);?>"  >
                            </td>
                             <td>
                                <label>Citizen No</label>
                                <input type="text" name="citizenno" value="<?php echo (empty($record) ? '' : $record->citizenno);?>"  >
                            </td>
                            <td>
                                <label>Post</label>
                                <select name="post">
                                    <option value="1">— Select Post —</option>
                                    <option value="Technician" <?php echo (isset($record->post)) &&  $record->post == 'Technician' ? 'selected':''; ?>>
                                        Technician
                                    </option>
                                    
                                </select>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Enroll Date</label>
                                <input type="text" name="enrolldate" class="input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="<?php echo (empty($record) ? '' : $record->enrolldate);?>" >
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
                            <th>Name</th>
                            <th>Emp Code</th>
                            <th>Post</th>
                            <th>Citizen No</th>
                            <th>Enrolldate</th>
                            <th style="width: 80px;" class="text-center"><i class="fa fa-flash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($records as $k=>$r) { ?>
                        <tr id="tabl">
                            <td><?php echo $k+1 ?></td>
                            <td><?php echo $r->firstname.' '.$r->lastname; ?></td>
                            <td><?php echo $r->employeecode; ?></td>
                            <td><?php echo $r->post; ?></td>
                            <td><?php echo $r->citizenno; ?></td>
                            <td><?php echo $r->enrolldate; ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url("setting/employees/".$r->id) ?>" data-toggle="tooltip" title="Edit <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                <a href="<?php echo base_url("delete/index/employees/".$r->id) ?>" data-toggle="tooltip" title="Delete <?php echo $title; ?>" class="btn btn-effect-ripple btn-xs btn-danger" onclick="return confirm('Are you Sure?');"><i class="fa fa-times"></i></a>
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