<?php
/* @var $this CoDistrictController */
/* @var $data CoDistrict */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('distid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->distid), array('view', 'id'=>$data->distid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_id')); ?>:</b>
	<?php echo CHtml::encode($data->district_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distname')); ?>:</b>
	<?php echo CHtml::encode($data->distname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distname_en')); ?>:</b>
	<?php echo CHtml::encode($data->distname_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geo_id')); ?>:</b>
	<?php echo CHtml::encode($data->geo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provid')); ?>:</b>
	<?php echo CHtml::encode($data->provid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('borderhealth')); ?>:</b>
	<?php echo CHtml::encode($data->borderhealth); ?>
	<br />


</div>