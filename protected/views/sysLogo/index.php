<?php
/* @var $this SysLogoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Logos',
);

$this->menu=array(
	array('label'=>'Create SysLogo', 'url'=>array('create')),
	array('label'=>'Manage SysLogo', 'url'=>array('admin')),
);
?>

<h1>Sys Logos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
