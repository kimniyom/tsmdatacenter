<?php
/* @var $this TypenewsController */
/* @var $model Typenews */

$this->breadcrumbs = array(
    'Typenews' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Typenews', 'url' => array('index')),
    array('label' => 'Create Typenews', 'url' => array('create')),
    array('label' => 'Update Typenews', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Typenews', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Typenews', 'url' => array('admin')),
);
?>

<h1>View Typenews #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'typename_th',
        'typename_en',
        'active',
    ),
));
?>
