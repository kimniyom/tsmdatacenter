<script src="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกไฟล์...',
            'auto': true,
            'fileTypeExts': '*.jpg; *.jpeg; *.png',
            'swf': '<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf',
            'uploader': '<?php echo Yii::app()->createUrl('photo/uploadify', array('albumId' => $album->id)) ?>',
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
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'รูปภาพกิจกรรม' => array('index'),
    $album['title'],
);
?>

<input id="file_upload" name="file_upload" type="file" multiple="true"><br/>
*.pdf .zip .rar เท่านั้น<br/>
อัพโหลดได้ครั้งละไม่เกิน 5 ไฟล์
<hr style="border-bottom: #999999 solid 2px;"/>
<center>
    <h4 style=" color: #6666ff; "><?php echo $album['title'] ?></h4>
    <p style=" color: #999999;"><?php echo $album['detail'] ?></p>
    <p style=" font-size: 12px; color: #cccccc;"><?php echo $album['create_date'] ?></p>
</center>
<div class="row">
    <?php foreach ($gallery as $rs): ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <div class="container-card set-views-card box-all" style=" height:250px;">
                <div class="img-wrapper">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/photo/<?php echo $rs['images']; ?>" class="img-responsive img-polaroid img-news-all" style="height:250px;"/>
                    <div style="position: absolute; right: 5px; bottom: 5px; z-index: 10;">
                        <button type="button" class="btn btn-danger" onclick="DeleteGallery('<?php echo $rs['id'] ?>')">ลบ</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    function DeleteGallery(id) {
        var url = "<?php echo Yii::app()->createUrl('photo/deletegallery') ?>";
        var data = {id: id};
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
</script>