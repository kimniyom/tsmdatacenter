<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'report_id'); ?>
		<?php echo $form->textField($model,'report_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'headname'); ?>
		<?php echo $form->textField($model,'headname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'colspan'); ?>
		<?php echo $form->textField($model,'colspan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'upper'); ?>
		<?php echo $form->textField($model,'upper'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rows'); ?>
		<?php echo $form->textField($model,'rows'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rowsnumber'); ?>
		<?php echo $form->textField($model,'rowsnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'headname_en'); ?>
		<?php echo $form->textField($model,'headname_en',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->