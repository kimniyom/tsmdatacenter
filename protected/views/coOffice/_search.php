<?php
/* @var $this CoOfficeController */
/* @var $model CoOffice */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'off_id'); ?>
		<?php echo $form->textField($model,'off_id',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'off_id_new'); ?>
		<?php echo $form->textField($model,'off_id_new',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'off_name'); ?>
		<?php echo $form->textField($model,'off_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'off_name_en'); ?>
		<?php echo $form->textField($model,'off_name_en',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'off_type'); ?>
		<?php echo $form->textField($model,'off_type',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'road'); ?>
		<?php echo $form->textField($model,'road',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'provid'); ?>
		<?php echo $form->textField($model,'provid',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'distid'); ?>
		<?php echo $form->textField($model,'distid',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subdistid'); ?>
		<?php echo $form->textField($model,'subdistid',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'villid'); ?>
		<?php echo $form->textField($model,'villid',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'villno'); ?>
		<?php echo $form->textField($model,'villno',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cup_code'); ?>
		<?php echo $form->textField($model,'cup_code',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pcu_code'); ?>
		<?php echo $form->textField($model,'pcu_code',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pointx'); ?>
		<?php echo $form->textField($model,'pointx',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pointy'); ?>
		<?php echo $form->textField($model,'pointy',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hasdata'); ?>
		<?php echo $form->textField($model,'hasdata',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hasdataf12'); ?>
		<?php echo $form->textField($model,'hasdataf12',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hasdatancd'); ?>
		<?php echo $form->textField($model,'hasdatancd',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hasdatarefer'); ?>
		<?php echo $form->textField($model,'hasdatarefer',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'refermember'); ?>
		<?php echo $form->textField($model,'refermember',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'createdate'); ?>
		<?php echo $form->textField($model,'createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatedate'); ?>
		<?php echo $form->textField($model,'updatedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'off_name_new'); ?>
		<?php echo $form->textField($model,'off_name_new',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order_number'); ?>
		<?php echo $form->textField($model,'order_number'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->