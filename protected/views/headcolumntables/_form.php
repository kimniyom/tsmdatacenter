<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'headcolumntables-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'report_id'); ?>
		<?php echo $form->textField($model,'report_id'); ?>
		<?php echo $form->error($model,'report_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'headname'); ?>
		<?php echo $form->textField($model,'headname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'headname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'colspan'); ?>
		<?php echo $form->textField($model,'colspan'); ?>
		<?php echo $form->error($model,'colspan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upper'); ?>
		<?php echo $form->textField($model,'upper'); ?>
		<?php echo $form->error($model,'upper'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rows'); ?>
		<?php echo $form->textField($model,'rows'); ?>
		<?php echo $form->error($model,'rows'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rowsnumber'); ?>
		<?php echo $form->textField($model,'rowsnumber'); ?>
		<?php echo $form->error($model,'rowsnumber'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'headname_en'); ?>
		<?php echo $form->textField($model,'headname_en',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'headname_en'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->