<?php include 'inc/config.php'; $template['header_link'] = 'UI ELEMENTS'; ?>
<?php include 'inc/template_start.php'; ?>
<?php include 'inc/page_head.php'; ?>

<?php if (!empty($msg)) { ?>
    <script>
        var msg = "<?php echo $msg;?>";
        alertify.success(msg);
    </script>
<?php } ?>

<?php
    $page = "admin/" .$page;
	$this->load->view($page);
?> 


<?php include 'inc/page_footer.php'; ?>
<?php include 'inc/template_scripts.php'; ?>

<!-- Load and execute javascript code used only in this page
<script src="<?php base_url('assets/admin/js/pages/uiTables.js'); ?>"></script>
<script>$(function(){ UiTables.init(); });</script> -->
<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url('assets/admin/js/pages/formsValidation.js'); ?> "></script>
<script>$(function() { FormsValidation.init(); });</script>
<?php include 'inc/template_end.php'; ?>