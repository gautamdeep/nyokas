<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>Complain</title>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url('assets/admin/css/print.css'); ?>">
	<script type='text/javascript' src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
	<script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
</head>

<body>
	<div id="page-wrap">
		<div class="row">
        <div class="col-md-12">
            <div class="">
            <div id="">
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
            </div>
          
            </div>
        </div>
    </div>

	
	</div>


</body>

</html>