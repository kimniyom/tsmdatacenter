<?php
/* @var $this TypenewsController */
/* @var $model Typenews */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'typenews-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">ประเภทข่าว</div>
        <div class="panel-body">
            <p class="note">Fields with <span class="required">*</span> are required.</p>
            <div style="color:red;">
                <?php echo $form->errorSummary($model); ?>
            </div>
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'typename_th'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php
                    echo $form->textField($model, 'typename_th', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control'));
                    ?>
                    <?php echo $form->error($model, 'typename_th'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'typename_en'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php
                    echo $form->textField($model, 'typename_en', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control'));
                    ?>
                    <?php echo $form->error($model, 'typename_en'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'active'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->radioButton($model, 'active', array('value' => 'Y', 'uncheckValue' => 'N')); ?>แสดง
                    &nbsp;<?php echo $form->radioButton($model, 'active', array('value' => 'N', 'uncheckValue' => 'Y')); ?>ไม่แสดง
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-lg-2"></div>
                <div class="col-md-10 col-lg-10">
                    <div class="row buttons" style=" padding-left: 15px; padding-top: 10px;">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
                    </div>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div><!-- form -->