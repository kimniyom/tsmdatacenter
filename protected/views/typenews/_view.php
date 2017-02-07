<?php
/* @var $this TypenewsController */
/* @var $data Typenews */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('typename')); ?>:</b>
    <?php echo CHtml::encode($data->typename); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
    <?php echo CHtml::encode($data->active); ?>
    <br />


</div>