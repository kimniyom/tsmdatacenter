<?php
/* @var $this SysLogoController */
/* @var $data SysLogo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Logo')); ?>:</b>
	<?php echo CHtml::encode($data->Logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Distid')); ?>:</b>
	<?php echo CHtml::encode($data->Distid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Note')); ?>:</b>
	<?php echo CHtml::encode($data->Note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />


</div>