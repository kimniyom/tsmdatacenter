<?php
/* @var $this CounterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Counters',
);

$this->menu=array(
	array('label'=>'Create Counter', 'url'=>array('create')),
	array('label'=>'Manage Counter', 'url'=>array('admin')),
);
?>

<h1>Counters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
