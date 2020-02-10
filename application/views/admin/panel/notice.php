<?php
    $this->load->helper('mr_robot');
    $status= get_rows('status');
    $brands= get_rows('brands');
?>
<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Notice</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Notice</li>
                        <li><a href="">View</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="block">
        <!-- Timeline Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
            </div>
            <h2>Latest Updates</h2>
        </div>
        <!-- END Timeline Title -->

        <!-- Timeline Content -->
        <div class="timeline block-content-full">
            <?php if(!empty($removal_complain)){ ?>  
            <ul class="timeline-list">
                <?php foreach($removal_complain as $row){ ?> 
                <li>
                    <!-- <div class="timeline-time">10 min ago</div> -->
                    <div class="timeline-icon themed-background text-light-op"><i class="gi gi-headset"></i></div>
                    <div class="timeline-content">
                        <p class="push-bit"><strong><a href="javascript:void(0)"><?php echo $row->businessname; ?></a> wants to remove <a href="<?php echo base_url('panel/complain/'.$row->id); ?>">Complain</a></strong></p>
                        <p class="push-bit"><strong>Removal Notice:</strong> <?php echo $row->complainremoval_request; ?></p>
                        
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php }else{ echo '<div>You dont have any notice</div>'; } ?>
        </div>
        <!-- END Timeline Content -->
    </div>
</div>