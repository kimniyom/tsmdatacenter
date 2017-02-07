<?php
/* @var $this CoOfficeController */
/* @var $model CoOffice */

$this->breadcrumbs=array(
	'Co Offices'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CoOffice', 'url'=>array('index')),
	array('label'=>'Create CoOffice', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#co-office-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Co Offices</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'co-office-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'off_id',
		'off_id_new',
		'off_name',
		'off_name_en',
		'off_type',
		'address',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
