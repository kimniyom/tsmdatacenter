<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'ประเภทข่าว',
);


?>

<a href="<?php echo Yii::app()->createUrl('typenews/create') ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มประเภทข่าว</button></a>
<br/><br/>
<div class="panel panel-default">
    <div class="panel-heading">ประเภทข่าว</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered" id="tablenews">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ประเภท</th>
                    <th>TypeNews</th>
                    <th style=" width: 20%; text-align: center;">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($typenews as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rs['typename_th'] ?></td>
                        <td><?php echo $rs['typename_en'] ?></td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('typenews/update', array('id' => $rs['id'])) ?>">
                                <button type="button" class="btn btn-info btn-sm">update</button></a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deletetypenews('<?php echo $rs['id'] ?>')">delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tablenews").dataTable();
    });

    function deletetypenews(id) {
        var r = confirm("Are you sure delete ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('typenews/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>


