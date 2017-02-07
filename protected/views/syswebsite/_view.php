<?php
/* @var $this SysWebsiteController */
/* @var $data SysWebsite */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headcolor')); ?>:</b>
	<?php echo CHtml::encode($data->headcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('navigatorcolor')); ?>:</b>
	<?php echo CHtml::encode($data->navigatorcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sidebarcolor')); ?>:</b>
	<?php echo CHtml::encode($data->sidebarcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('headtablecolor')); ?>:</b>
	<?php echo CHtml::encode($data->headtablecolor); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('textheadcolor')); ?>:</b>
	<?php echo CHtml::encode($data->textheadcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('textnavigatorcolor')); ?>:</b>
	<?php echo CHtml::encode($data->textnavigatorcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('textsidebarcolor')); ?>:</b>
	<?php echo CHtml::encode($data->textsidebarcolor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('textheadtablecolor')); ?>:</b>
	<?php echo CHtml::encode($data->textheadtablecolor); ?>
	<br />

	*/ ?>

</div>