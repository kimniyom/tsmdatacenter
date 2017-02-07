<?php
/* @var $this CounterController */
/* @var $model Counter */

$this->breadcrumbs=array(
	'Counters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Counter', 'url'=>array('index')),
	array('label'=>'Manage Counter', 'url'=>array('admin')),
);
?>

<h1>Create Counter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>