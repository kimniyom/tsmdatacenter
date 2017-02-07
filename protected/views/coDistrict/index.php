<?php
/* @var $this CoDistrictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Co Districts',
);

$this->menu = array(
    array('label' => 'Create CoDistrict', 'url' => array('create')),
    array('label' => 'Manage CoDistrict', 'url' => array('admin')),
);
?>

<h1>Co Districts</h1>
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
                        <td><?php echo $rs['distid'] ?></td>
                        <td><?php echo $rs['distname'] ?></td>
                        <td><?php echo $rs['distname_en'] ?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('codistrict/update', array('id' => $rs['distid'])) ?>">
                                <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
