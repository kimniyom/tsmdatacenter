<?php
/* @var $this CoOfficeController */
/* @var $model CoOffice */

$this->breadcrumbs=array(
	'Co Offices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CoOffice', 'url'=>array('index')),
	array('label'=>'Manage CoOffice', 'url'=>array('admin')),
);
?>

<h1>Create CoOffice</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>