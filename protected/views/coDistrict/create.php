<?php
/* @var $this CoDistrictController */
/* @var $model CoDistrict */

$this->breadcrumbs=array(
	'Co Districts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CoDistrict', 'url'=>array('index')),
	array('label'=>'Manage CoDistrict', 'url'=>array('admin')),
);
?>

<h1>Create CoDistrict</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>