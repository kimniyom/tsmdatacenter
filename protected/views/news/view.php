<script src="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกไฟล์...',
            'auto': true,
            'fileTypeExts': '*.pdf; *.rar; *zip',
            'swf': '<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf',
            'uploader': '<?php echo Yii::app()->createUrl('news/uploadify', array('newsId' => $model->id)) ?>',
            'uploadLimit': 5,
            'onUploadSuccess': function (file, data, response) {
                window.location.reload();
                //alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
            }
        });
    });
</script>
<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
    'News' => array('index'),
    $model->title_th,
);

$this->menu = array(
    array('label' => 'List News', 'url' => array('index')),
    array('label' => 'Create News', 'url' => array('create')),
    array('label' => 'Update News', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete News', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage News', 'url' => array('admin')),
);
?>

<h4> <?php echo $model->title_th; ?></h4>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id',
        'title_th',
         'title_en',
        'detail_th',
        'detail_en',
        'create_date',
    ),
));
?>

<br/>

<?php
if ($model->file == '1') {
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-paperclip"></i> ไฟล์แนบ
        </div>
        <div class="panel-body">
            <input id="file_upload" name="file_upload" type="file" multiple="true"><br/>
            *.pdf .zip .rar เท่านั้น<br/>
            อัพโหลดได้ครั้งละไม่เกิน 5 ไฟล์
            <hr/>
            <?php
            foreach ($file as $files):
                ?>
                <a href="<?php echo Yii::app()->baseUrl; ?>/uploads/news/<?php echo $files['filename'] ?>" target="_bank">
                    <i class="fa fa-file-pdf-o"></i> <?php echo $files['filename'] ?></a> 
                <button type="button" class="btn btn-danger btn-xs" title="ลบ" onclick="deletefile('<?php echo $files['id'] ?>')"><i class="fa fa-trash-o"></i></button><br/>
                    <?php
                endforeach;
                ?>
        </div>
    </div>
    <?php
}
?>


<script type="text/javascript">
    function deletefile(id) {
        var r = confirm("Are you sure ...?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('filenews/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }
</script>
