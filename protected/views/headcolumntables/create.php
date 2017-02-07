<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */

$this->breadcrumbs=array(
	'Headcolumntables'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Headcolumntables', 'url'=>array('index')),
	array('label'=>'Manage Headcolumntables', 'url'=>array('admin')),
);
?>

<h1>Create Headcolumntables</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>