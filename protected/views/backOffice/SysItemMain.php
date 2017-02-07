
<ol class="breadcrumbs" id="navi">
    <li><a href="<?php echo Yii::app()->createUrl('Sysitems'); ?>"><span class="glyphicon glyphicon-home"></span> หน้าหลัก</a></li>
    <!--li><a href="#">Library</a></li>
    <li class="active">Data</li-->
</ol>

<div id="showContent"></div>


<script type="text/javascript">

    $(document).ready(function () {
        manageItemGroup();
    });

    function manageItemGroup() {

        var url = "<?php echo Yii::app()->createUrl('Sysitems/ItemGroup') ?>";

        $.post(url, function (rs) {
            $("#showContent").html(rs);
        });
    }

    function manageItems(gid, lv, id) {

        var url = "<?php echo Yii::app()->createUrl('Sysitems/Item'); ?>";


        var data = {gid: gid, lv: lv, id: id};

        $("#showContent").html('<div class="modal-body">' +
                '<img src="<?php echo Yii::app()->baseUrl; ?>/images/ajax-loader.gif" />' +
                '&nbsp; กำลังโหลดข้อมูล กรุณารอสักครู่...</div>');
        $.post(url, data, function (rs) {
            $("#showContent").html(rs);

            var url2 = "<?php echo Yii::app()->createUrl('Sysitems/GetNavigator'); ?>";
            $.post(url2, {gid: gid, id: id}, function (rs) {
                $("#navi").html(rs);
            });

        });

    }


</script>