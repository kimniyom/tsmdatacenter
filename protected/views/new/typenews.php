<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ประเภทข่าว',
);
?>
<div class="row">
    <?php foreach ($typenews as $rs): ?>
        <div class="col-md-3 col-lg-3">
            <button type="button" class="btn btn-default btn-block">
                <h4><i class="fa fa-paper-o"></i></h4>
                    <?php echo $rs['typename'] ?>
            </button>
        </div>
    <?php endforeach; ?>
</div>
