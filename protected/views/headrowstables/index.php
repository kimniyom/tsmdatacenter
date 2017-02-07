<?php
/* @var $this HeadrowstablesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Headrowstables',
);
?>

<h1>Headrowstables</h1>
<a href="<?php echo Yii::app()->createUrl('headrowstables/create',array('reportid' => $reportid)) ?>"><button type="button" class="btn green">เพิ่มแถวตาราง</button></a>
<table class="">
    <thead>
        <tr>
            <th>Rows</th>
            <th>HeadName</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($rows as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $rs['rows']; ?></td>
                <td><?php echo $rs['headname'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
