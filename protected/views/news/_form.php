<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">News</div>
        <div class="panel-body">
            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <div style="color: #ff0033;">
                <?php echo $form->errorSummary($model); ?>
            </div>

            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'typenews'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php
                    $list = CHtml::listData(Typenews::model()->findAll(), 'id', 'typename_th');
                    echo $form->dropDownList($model, 'typenews', $list, array('class' => 'form-control'));
                    ?>
                </div>
            </div>

            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'title_th'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->textField($model, 'title_th', array('maxlength' => 255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'title_th'); ?>
                </div>
            </div>
            
            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'title_en'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->textField($model, 'title_en', array('maxlength' => 255, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'title_en'); ?>
                </div>
            </div>

            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'detail_th'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->textArea($model, 'detail_th', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'detail_th'); ?>
                </div>
            </div>
            
            <div class="row" style=" margin-bottom: 10px;">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'detail_en'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->textArea($model, 'detail_en', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'detail_en'); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 col-lg-2">
                    <?php echo $form->labelEx($model, 'file'); ?>
                </div>
                <div class="col-md-10 col-lg-10">
                    <?php echo $form->radioButton($model, 'file', array('value' => 1, 'uncheckValue' => 0)); ?>มี
                    &nbsp;<?php echo $form->radioButton($model, 'file', array('value' => 0, 'uncheckValue' => 1)); ?>ไม่มี
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