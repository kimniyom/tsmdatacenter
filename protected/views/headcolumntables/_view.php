<?php
/* @var $this HeadcolumntablesController */
/* @var $data Headcolumntables */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_id')); ?>:</b>
	<?php echo CHtml::encode($data->report_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headname')); ?>:</b>
	<?php echo CHtml::encode($data->headname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('colspan')); ?>:</b>
	<?php echo CHtml::encode($data->colspan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upper')); ?>:</b>
	<?php echo CHtml::encode($data->upper); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rows')); ?>:</b>
	<?php echo CHtml::encode($data->rows); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rowsnumber')); ?>:</b>
	<?php echo CHtml::encode($data->rowsnumber); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('headname_en')); ?>:</b>
	<?php echo CHtml::encode($data->headname_en); ?>
	<br />

	*/ ?>

</div>