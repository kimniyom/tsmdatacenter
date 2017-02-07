<?php
/* @var $this SysWebsiteController */
/* @var $model SysWebsite */

$this->breadcrumbs = array(
    'Sys Websites' => array('index'),
    $model->name,
);

$this->menu = array(
    array('label' => 'List SysWebsite', 'url' => array('index')),
    array('label' => 'Create SysWebsite', 'url' => array('create')),
    array('label' => 'Update SysWebsite', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete SysWebsite', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage SysWebsite', 'url' => array('admin')),
);
?>

<h1>View SysWebsite #<?php echo $model->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'logo',
        'headcolor',
        'navigatorcolor',
        'sidebarcolor',
        'headtablecolor',
        'textheadcolor',
        'textnavigatorcolor',
        'textsidebarcolor',
        'textheadtablecolor',
    ),
));
?>
