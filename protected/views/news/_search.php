<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <div class="row">
<?php echo $form->label($model, 'id'); ?>
<?php echo $form->textField($model, 'id'); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'title_th'); ?>
<?php echo $form->textField($model, 'title_th', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'title_en'); ?>
<?php echo $form->textField($model, 'title_en', array('size' => 60, 'maxlength' => 255)); ?>
    </div>


    <div class="row">
<?php echo $form->label($model, 'detail_th'); ?>
<?php echo $form->textArea($model, 'detail_th', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'detail_en'); ?>
<?php echo $form->textArea($model, 'detail_en', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row">
<?php echo $form->label($model, 'create_date'); ?>
<?php echo $form->textField($model, 'create_date'); ?>
    </div>

    <div class="row buttons">
    <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->