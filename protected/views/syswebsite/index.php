<?php
/* @var $this SysWebsiteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ตั้งค่าเว็บไซต์',
);
?>
<script src="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl ?>/assets/uploadify/uploadify.css">

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
            'uploader': '<?php echo Yii::app()->createUrl('syswebsite/uploadify') ?>',
            'uploadLimit': 5,
            'onUploadSuccess': function (file, data, response) {
                window.location.reload();
            }
        });
    });
</script>

<h1>ตั้งค่าเว็บไซต์</h1>
<div class="card" style=" background: none; box-shadow: none;">
    <div class="card-content ">
        <div class="row">
            <div class="col l3 m3">
                LOGO
            </div>
            <div class="col l1 m1">
                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $website['logo'] ?>" width="80"/>
            </div>
            <div class="col l2 m2" style=" padding-top: 20px;">
                <form>
                    <div id="queue"></div>
                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col l3 m3">
                ชื่อระบบ
            </div>
            <div class="col l9 m9">
                <input type="text" id="name" value="<?php echo $website['name'] ?>"/>
            </div>
        </div>
        <hr/>
        <h4>รูปแบบเว็บไซต์</h4>
        <div class="row">
            <div class="col l3 m3" style="text-align: right;">
                NavbarColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="headcolor" value="<?php echo $website['headcolor'] ?>"/>
            </div>
            <div class="col l3 m3" style="text-align: right;">
                TextNavbarColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="textheadcolor" value="<?php echo $website['textheadcolor'] ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col l3 m3" style="text-align: right;">
                SidebarColor
            </div>
            <div class="col l3 m3" style="text-align: right;">
                <input type="text" class="jscolor" id="sidebarcolor" value="<?php echo $website['sidebarcolor'] ?>"/>
            </div>
            <div class="col l3 m3" style="text-align: right;">
                TextSidebarColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="textsidebarcolor" value="<?php echo $website['textsidebarcolor'] ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col l3 m3" style="text-align: right;">
                NavigatorColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="navigatorcolor" value="<?php echo $website['navigatorcolor'] ?>"/>
            </div>
            <div class="col l3 m3" style="text-align: right;">
                TextNavigatorColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="textnavigatorcolor" value="<?php echo $website['textnavigatorcolor'] ?>"/>
            </div>
        </div>
        <hr/>
        <h4>Report</h4>
        <div class="row">
            <div class="col l3 m3" style="text-align: right;">
                HeadtableColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="headtablecolor" value="<?php echo $website['headtablecolor'] ?>"/>
            </div>
            <div class="col l3 m3" style="text-align: right;">
                TextHeadtableColor
            </div>
            <div class="col l3 m3">
                <input type="text" class="jscolor" id="textheadtablecolor" value="<?php echo $website['textheadtablecolor'] ?>"/>
            </div>
        </div>
    </div>
    <hr/>
    <div class="card-footer" style=" text-align: right;">
        <button type="button" class="btn waves-effect green" onclick="Save()"><i class="mdi-content-save"></i> บันทึก</button>
    </div>
</div>


<script type="text/javascript">
    function Save() {
        var url = "<?php echo Yii::app()->createUrl('syswebsite/save') ?>";
        var name = $("#name").val();
        var headcolor = $("#headcolor").val();
        var textheadcolor = $("#textheadcolor").val();
        var sidebarcolor = $("#sidebarcolor").val();
        var textsidebarcolor = $("#textsidebarcolor").val();
        var navigatorcolor = $("#navigatorcolor").val();
        var textnavigatorcolor = $("#textnavigatorcolor").val();
        var headtablecolor = $("#headtablecolor").val();
        var textheadtablecolor = $("#textheadtablecolor").val();
        if (name == '') {
            $("#name").focus();
            return false;
        }
        var data = {
            name: name,
            headcolor: headcolor,
            textheadcolor: textheadcolor,
            sidebarcolor: sidebarcolor,
            textsidebarcolor: textsidebarcolor,
            navigatorcolor: navigatorcolor,
            textnavigatorcolor: textnavigatorcolor,
            headtablecolor: headtablecolor,
            textheadtablecolor: textheadtablecolor
        };

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
</script>
