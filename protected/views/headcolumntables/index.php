<?php
/* @var $this HeadcolumntablesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Headcolumntables',
);

$this->menu=array(
	array('label'=>'Create Headcolumntables', 'url'=>array('create')),
	array('label'=>'Manage Headcolumntables', 'url'=>array('admin')),
);
?>

<h1>Headcolumntables</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
