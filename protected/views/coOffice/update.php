<?php
/* @var $this CoOfficeController */
/* @var $model CoOffice */

$this->breadcrumbs=array(
	'Co Offices'=>array('index'),
	$model->off_id=>array('view','id'=>$model->off_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CoOffice', 'url'=>array('index')),
	array('label'=>'Create CoOffice', 'url'=>array('create')),
	array('label'=>'View CoOffice', 'url'=>array('view', 'id'=>$model->off_id)),
	array('label'=>'Manage CoOffice', 'url'=>array('admin')),
);
?>

<h1>Update CoOffice <?php echo $model->off_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>