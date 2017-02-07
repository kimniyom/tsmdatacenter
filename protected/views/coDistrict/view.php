<?php
/* @var $this CoDistrictController */
/* @var $model CoDistrict */

$this->breadcrumbs=array(
	'Co Districts'=>array('index'),
	$model->distid,
);

$this->menu=array(
	array('label'=>'List CoDistrict', 'url'=>array('index')),
	array('label'=>'Create CoDistrict', 'url'=>array('create')),
	array('label'=>'Update CoDistrict', 'url'=>array('update', 'id'=>$model->distid)),
	array('label'=>'Delete CoDistrict', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->distid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CoDistrict', 'url'=>array('admin')),
);
?>

<h1>View CoDistrict #<?php echo $model->distid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'district_id',
		'distid',
		'distname',
		'distname_en',
		'geo_id',
		'provid',
		'borderhealth',
	),
)); ?>
