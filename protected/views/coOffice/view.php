<?php
/* @var $this CoOfficeController */
/* @var $model CoOffice */

$this->breadcrumbs=array(
	'Co Offices'=>array('index'),
	$model->off_id,
);

$this->menu=array(
	array('label'=>'List CoOffice', 'url'=>array('index')),
	array('label'=>'Create CoOffice', 'url'=>array('create')),
	array('label'=>'Update CoOffice', 'url'=>array('update', 'id'=>$model->off_id)),
	array('label'=>'Delete CoOffice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->off_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CoOffice', 'url'=>array('admin')),
);
?>

<h1>View CoOffice #<?php echo $model->off_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'off_id',
		'off_id_new',
		'off_name',
		'off_name_en',
		'off_type',
		'address',
		'road',
		'provid',
		'distid',
		'subdistid',
		'villid',
		'villno',
		'postcode',
		'cup_code',
		'pcu_code',
		'pointx',
		'pointy',
		'status',
		'hasdata',
		'hasdataf12',
		'hasdatancd',
		'hasdatarefer',
		'refermember',
		'createdate',
		'updatedate',
		'off_name_new',
		'order_number',
	),
)); ?>
