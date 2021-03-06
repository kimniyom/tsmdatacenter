<?php
/* @var $this SysWebsiteController */
/* @var $model SysWebsite */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'sys-website-form',
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
        <?php echo $form->labelEx($model, 'name'); ?>
<?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'logo'); ?>
<?php echo $form->textField($model, 'logo', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'headcolor'); ?>
<?php echo $form->textField($model, 'headcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'headcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'navigatorcolor'); ?>
<?php echo $form->textField($model, 'navigatorcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'navigatorcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sidebarcolor'); ?>
<?php echo $form->textField($model, 'sidebarcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'sidebarcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'headtablecolor'); ?>
<?php echo $form->textField($model, 'headtablecolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'headtablecolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'textheadcolor'); ?>
<?php echo $form->textField($model, 'textheadcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'textheadcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'textnavigatorcolor'); ?>
<?php echo $form->textField($model, 'textnavigatorcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'textnavigatorcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'textsidebarcolor'); ?>
<?php echo $form->textField($model, 'textsidebarcolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'textsidebarcolor'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'textheadtablecolor'); ?>
<?php echo $form->textField($model, 'textheadtablecolor', array('size' => 60, 'maxlength' => 255)); ?>
<?php echo $form->error($model, 'textheadtablecolor'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->