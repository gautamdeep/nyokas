<?php foreach($records as $key=>$row){ ?> 
<tr>
	<td><?php echo $key+1; ?></td>
    <td><?php echo $row->model; ?></td>
    <td><?php echo $row->producttype; ?></td>
    <?php if($table == 'sale_products'){ ?>
    	<td><?php echo $row->productserialno; ?></td>
    	<td><?php echo $row->warrantycardno; ?></td>
	    <td><?php echo $row->MRP; ?></td>
    	<td><?php echo $row->discount; ?></td>
    	<td><?php echo $row->vatamount; ?></td>
    	<td><?php echo $row->taxamount; ?></td>
    	<td><?php echo $row->commision; ?></td>
    	<td><?php echo $row->actualprice; ?></td>
    <?php }else{ ?>
		<td><?php echo $row->quantity; ?></td>
	    <td><?php echo $row->MRP; ?></td>
    <?php } ?>
</tr>
<?php } ?>