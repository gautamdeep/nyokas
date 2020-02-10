<?php
    $this->load->helper('mr_robot');
    $loadshedding= get_rows('loadshedding_group');
    $brands= get_rows('brands');
    $ac_types= get_rows('ac_types');
?>
<!-- Page content -->
<div id="page-content">
    <!-- Forms Components Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Print Complain</h1>
                </div>
            </div>

            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li>Dashboard</li>
                        <li>Complain</li>
                        <li><a href="">Print</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- END Forms Components Header -->

    <!-- Form Components Row -->
    <div class="row">
        <div class="col-md-12">
            <!-- General Elements Block -->
            <div class="block">
            <a href="<?php echo base_url('panel/clients'); ?>" class="btn btn-primary">Back To Complain</a>
            <!-- <a href="<?php echo base_url($url); ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure you want to delete?? Every Data associated with this Client will also be Deleted');">Delete</a> -->
            <!-- <?php 
            	if($this->session->flashdata('message')){ ?> 
            	<script>
                    alertify.success('<?php echo $this->session->flashdata('message'); ?>');
                </script>
            <?php } ?> -->

            <!-- General Elements Content -->
                
            <fieldset>
                <legend>Complain Form</legend>
                <div id="JobToPrint">
                <h3>Nyokas Concern Pvt. Ltd.</h3>
                <p>061-536661 | Naghdhunga, Pokhara</p>
                <h4><b><u>Complain Registration</u></b></h4>
                    <table class="inputtable2">

                        <tr class="inputrow">
                            <td>
                                <label>Date</label>
                                <label class="input-underline"><?php echo date('Y-m-d H:i:s');?></label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Org Name</label>
                                <label class="input-underline"><?php echo (empty($record) ? '' : $record->businessname);?></label>
                            </td>
                            <td>
                                <label>Address</label>
                                 <label class="input-underline"><?php echo (empty($record) ? '' : $record->address);?></label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td>
                                <label>Complain by</label>
                                <label class="input-underline"><?php echo (empty($record) ? '' : $record->complainer);?></label>
                            </td>
                            <td>
                                <label>Contact</label>
                                 <label class="input-underline"><?php echo (empty($record) ? '' : $record->complainerphone);?></label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>AC</label>
                                <label class="input-underline"><?php echo (empty($property) ? '' : $property->brand);?></label>
                                <label class="input-underline"><?php echo (empty($property) ? '' : $property->type);?></label>
                                <label class="input-underline"><?php echo (empty($property) ? '' : $property->capacityinton);?> TON</label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>Location</label>
                                <label class="input-underline"><?php echo (empty($property) ? '' : $property->location);?></label>
                                <label class="input-underline"><?php echo (empty($property) ? '' : $property->assignname);?></label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>Complain Type</label>
                                <label class="input-underline"><?php echo (empty($record) ? '' : $record->complainlist);?></label>
                            </td>
                        </tr>
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>Complain Detail</label>
                                <label class="input-underline"><?php echo (empty($record) ? '' : $record->complaindetail);?></label>
                            </td>
                        </tr> 
                        <tr class="inputrow">
                            <td>
                                <label>Technician</label>
                                <label class="input-underline">&nbsp;</label>
                            </td>
                            <td>
                                <label>Work Time Peroid</label>
                                <label class="input-underline">&nbsp;</label>
                            </td>
                        </tr> 
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>Activity</label>
                                <label class="input-underline">&nbsp;</label>
                            </td>
                            
                        </tr> 
                        <tr class="inputrow">
                            <td colspan="2">
                                <label>Remarks</label>
                                <label class="input-underline">&nbsp;</label>
                            </td>
                            
                        </tr> 
                    </table>
                </div>
            </fieldset>
            <button type="submit" class="btn btn-effect-ripple btn-success" name="print-jobcard" onclick="PrintJob();">Print</button>
                <!-- END General Elements Content -->
            </div>
            <!-- END General Elements Block -->
        </div>
    </div>
    <!-- END Form Components Row -->
</div>
<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/admin/css/print.css'); ?>">
<style type="text/css" media="print">
    label{font-size:14px !important;}
    label{background:#111; color:#fff;}
    label.input-underline{width:200px;border-bottom:1px dashed #ccc;}
    @media print {
        
        @page {
            size: A4 landscape ;
        }
    }
</style>
<script type="text/javascript">
    function PrintJob() {    
        var JobToPrint = document.getElementById('JobToPrint');
        var popupWin = window.open('', '_blank', 'width=300,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + JobToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

</script>