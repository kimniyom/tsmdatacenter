<?php
/* @var $this SysLogoController */
/* @var $model SysLogo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sys-logo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Logo'); ?>
		<?php echo $form->textField($model,'Logo',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'Logo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Distid'); ?>
		<?php echo $form->textField($model,'Distid',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'Distid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Note'); ?>
		<?php echo $form->textArea($model,'Note',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->