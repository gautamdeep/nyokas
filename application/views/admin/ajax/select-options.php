<?php foreach($records as $row){ ?>
	<option value="<?php echo $row->id; ?>">
		<?php echo ($table == 'product_types')? $row->producttypename : (($table == 'product_models')? $row->modelname: ''); ?>
	</option>
<?php } ?>
