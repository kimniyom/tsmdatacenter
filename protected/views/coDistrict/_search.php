<?php
/* @var $this CoDistrictController */
/* @var $model CoDistrict */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'district_id'); ?>
		<?php echo $form->textField($model,'district_id',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distid'); ?>
		<?php echo $form->textField($model,'distid',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distname'); ?>
		<?php echo $form->textField($model,'distname',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distname_en'); ?>
		<?php echo $form->textField($model,'distname_en',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'geo_id'); ?>
		<?php echo $form->textField($model,'geo_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'provid'); ?>
		<?php echo $form->textField($model,'provid',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'borderhealth'); ?>
		<?php echo $form->textField($model,'borderhealth',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->