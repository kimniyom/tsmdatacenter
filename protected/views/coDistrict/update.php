<?php
/* @var $this CoDistrictController */
/* @var $model CoDistrict */

$this->breadcrumbs=array(
	'Co Districts'=>array('index'),
	$model->distid=>array('view','id'=>$model->distid),
	'Update',
);

$this->menu=array(
	array('label'=>'List CoDistrict', 'url'=>array('index')),
	array('label'=>'Create CoDistrict', 'url'=>array('create')),
	array('label'=>'View CoDistrict', 'url'=>array('view', 'id'=>$model->distid)),
	array('label'=>'Manage CoDistrict', 'url'=>array('admin')),
);
?>

<h1>Update CoDistrict <?php echo $model->distid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>