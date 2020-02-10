<?php include 'inc/config.php'; $template['header_link'] = 'WELCOME'; ?>
<?php include 'inc/template_start.php'; ?>
<?php include 'inc/page_head.php'; ?>

<!-- Page content -->
<div id="page-content">
    <!-- First Row -->
    <div class="row">
        
    </div>
    <!-- END First Row -->

    <!-- Second Row -->
   
    <!-- END Second Row -->

    <!-- Third Row -->
   
    <!-- END Third Row -->
</div>
<!-- END Page Content -->

<?php include 'inc/page_footer.php'; ?>
<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url('assets/admin/js/pages/readyDashboard.js');?>"></script>
<script>$(function(){ ReadyDashboard.init(); });</script>

<?php include 'inc/template_end.php'; ?>