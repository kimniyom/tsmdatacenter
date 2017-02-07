<?php
/* @var $this HeadcolumntablesController */
/* @var $model Headcolumntables */

$this->breadcrumbs=array(
	'Headcolumntables'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Headcolumntables', 'url'=>array('index')),
	array('label'=>'Create Headcolumntables', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#headcolumntables-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Headcolumntables</h1>

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
	'id'=>'headcolumntables-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'report_id',
		'headname',
		'colspan',
		'upper',
		'rows',
		/*
		'rowsnumber',
		'headname_en',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
