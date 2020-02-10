<fieldset>
<legend>Existing Clients</legend>
<div style="max-height: 400px;overflow-y: scroll;">
<table class="table table-striped table-bordered table-vcenter">
    <thead>
        <tr>
            <th>Sn</th>
            <th>Businessname</th> 
            <th class="hidden-xs">Name</th> 
            <th>Address</th>
            <th>City</th>
            <th>Landmark</th>
            <th>Phone no.</th>
            <!-- <th>Created By</th> -->
            <th style="width: 40px;" class="text-center"><i class="fa fa-flash"></i></th>
        </tr>
    </thead>
    <tbody>
    
    <?php foreach($clients as $k=>$r) { ?>
    <tr>
        <td><strong><?php echo $k+1 ?></strong></td>
        <td><strong><?php echo $r->businessname ?></strong></td>
        <td class="hidden-xs"><?php echo $r->firstname.' '.$r->lastname; ?></td>
        <td><?php echo $r->address ?></td>
        <td><?php echo $r->city ?></td>
        <td><?php echo $r->landmark ?></td>
        
        <td> <strong><?php echo $r->phone1; ?></strong></td>
        <!-- <td><?php echo ucfirst($r->status); ?></td> -->
        <td class="text-center">
            <a id-clientid="<?php echo $r->id; ?>" data-toggle="tooltip" title="Select this Client" class="btn btn-effect-ripple btn-xs btn-success client-select" ><i class="fa fa-check"></i></a>
        </td>
    </tr>
    <?php } ?>

	</tbody>
</table>
</div>
</fieldset>
<div id='aja'></div>

<!-- <script src="<?php echo base_url('assets/admin/js/pages/uiTables.js');?>"></script>
<script>$(function(){ UiTables.init(); });</script> -->