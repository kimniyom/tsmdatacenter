<?php
/* @var $this CoDistrictController */
/* @var $model CoDistrict */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'co-district-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'distname'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'distname', array('size' => 30, 'maxlength' => 30,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'distname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-2">
            <?php echo $form->labelEx($model, 'distname_en'); ?>
        </div>
        <div class="col-md-10 col-lg-10">
            <?php echo $form->textField($model, 'distname_en', array('size' => 30, 'maxlength' => 30,'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'distname_en'); ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2 col-lg-2"></div>
        <div class="col-md-10 col-lg-10">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->