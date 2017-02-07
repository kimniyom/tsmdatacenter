<?php
/* @var $this HeadrowstablesController */
/* @var $model Headrowstables */

$this->breadcrumbs = array(
    //'Headrowstables' => array('index'),
    $reportgroup['name'] => array('backoffice/Showreportlist/menugroup_id/' . $reportgroup['id'] . '/groupname/' . $reportgroup['name']),
    'รูปแบบรายงาน',
);

$this->menu = array(
    array('label' => 'List Headrowstables', 'url' => array('index')),
    array('label' => 'Manage Headrowstables', 'url' => array('admin')),
);
?>

<h4><?php echo $reportlist['name'] ?></h4>

<?php
$this->renderPartial('_form', array('model' => $model,
    'reportid' => $reportid,
    'detail' => $detail,
        )
);
?>