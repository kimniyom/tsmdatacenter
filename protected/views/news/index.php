<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'News',
);

$this->menu = array(
    array('label' => 'Create News', 'url' => array('create')),
    array('label' => 'Manage News', 'url' => array('admin')),
);
?>

<a href="<?php echo Yii::app()->createUrl('news/create') ?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มข่าว</button></a>
<br/><br/>
<div class="panel panel-default">
    <div class="panel-heading">News</div>
    <div class="panel-body">
        <table class="table table-striped table-bordered" id="tablenews">
            <thead>
                <tr>
                    <th>#</th>
                    <th>หัวข้อ</th>
                    <th>Title</th>
                    <th>ไฟล์</th>
                    <th style=" width: 20%; text-align: center;">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($news as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rs['title_th'] ?></td>
                        <td><?php echo $rs['title_en'] ?></td>
                        <td style="text-align: center;">
                            <?php if ($rs['file'] == 0) { ?>
                                ไม่มี
                            <?php } else { ?>
                                <a href="<?php echo Yii::app()->createUrl('news/view', array('id' => $rs['id'])) ?>"><i class="fa fa-paperclip"></i> จัดการไฟล์</a>
                            <?php } ?>
                        </td>
                        <td style=" text-align: center;">
                            <a href="<?php echo Yii::app()->createUrl('news/view', array('id' => $rs['id'])) ?>">
                                <button type="button" class="btn btn-default btn-sm">view</button></a>
                            <a href="<?php echo Yii::app()->createUrl('news/update', array('id' => $rs['id'])) ?>">
                                <button type="button" class="btn btn-info btn-sm">update</button></a>
                            <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deletenews('<?php echo $rs['id'] ?>')">delete</button>
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

    function deletenews(id) {
        var r = confirm("Are you sure delete ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('news/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>

