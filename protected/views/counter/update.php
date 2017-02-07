<?php
/* @var $this CounterController */
/* @var $model Counter */

$this->breadcrumbs=array(
	'Counters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Counter', 'url'=>array('index')),
	array('label'=>'Create Counter', 'url'=>array('create')),
	array('label'=>'View Counter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Counter', 'url'=>array('admin')),
);
?>

<h1>Update Counter <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>