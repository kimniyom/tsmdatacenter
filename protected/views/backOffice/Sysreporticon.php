
<script src="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">
<script type="text/javascript">
    function delicon(id, icon) {
        var r = confirm("Are You Sure ... ?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('sysicon/delicon') ?>";
            var data = {id: id, icon: icon};
            $.post(url, data, function () {
                window.location.reload();
            });
        }
    }
</script>

<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกไฟล์...',
            'auto': true,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'token': '<?php echo md5('unique_salt' . $timestamp); ?>'
            },
            'fileTypeExts': '*.gif; *.jpg; *.png',
            'swf': '<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.swf',
            'uploader': '<?php echo Yii::app()->createUrl('Sysicon/Uploadify') ?>',
            'uploadLimit': 5,
            'onUploadSuccess': function (file, data, response) {
                window.location.reload();
            }
        });
    });
</script>


<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    //'กลุ่มรายงาน' => array('backoffice/showgroupreport'),
    'Icons'
);
?>


<form>
    <div id="queue"></div>
    <input id="file_upload" name="file_upload" type="file" multiple="true">
</form>

<hr/>

<div class="row">
    <?php foreach ($Icon as $rs): ?>
        <div class="col s3 m3  l1" style=" text-align: center;">
            <img src="<?php echo Yii::app()->baseurl; ?>
                 /assets/icon_system/<?php echo $rs['icon']; ?>" class="responsive-img" width="48"/><br/>
            <button type="button" class="btn red" 
                    onclick="delicon('<?php echo $rs['id'] ?>', '<?php echo $rs['icon'] ?>');">
                <i class="mdi-action-delete"></i>
            </button>
        </div>
    <?php endforeach; ?>
</div>
