<?php
/* @var $this CoOfficeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Co Offices',
);

$this->menu = array(
    array('label' => 'Create CoOffice', 'url' => array('create')),
    array('label' => 'Manage CoOffice', 'url' => array('admin')),
);
?>

<h1>Co Offices</h1>

<div class="box box-primary">
    <div class="box-header"></div>
    <div class="box-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CODE</th>
                    <th>TH_NAME</th>
                    <th>EN_NAME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($datas as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $rs['off_id'] ?></td>
                        <td><?php echo $rs['off_name'] ?></td>
                        <td><?php echo $rs['off_name_en'] ?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('cooffice/update', array('id' => $rs['off_id'])) ?>">
                                <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
