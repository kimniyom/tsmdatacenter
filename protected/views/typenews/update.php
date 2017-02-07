<?php
/* @var $this TypenewsController */
/* @var $model Typenews */

$this->breadcrumbs=array(
	'ประเภทข่าว' => array('index'),
	$model->typename_th => array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Typenews', 'url'=>array('index')),
	array('label'=>'Create Typenews', 'url'=>array('create')),
	array('label'=>'View Typenews', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Typenews', 'url'=>array('admin')),
);
?>

<h1>Update Typenews <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>