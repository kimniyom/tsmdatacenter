<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title_th')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title_en')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('detail_th')); ?>:</b>
    <?php echo CHtml::encode($data->detail); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('detail_en')); ?>:</b>
    <?php echo CHtml::encode($data->detail); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
    <?php echo CHtml::encode($data->create_date); ?>
    <br />


</div>



