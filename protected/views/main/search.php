
<script>
    function openwindow(title, report_id, template, subtitle) {
        $("body").css({"overflow": "hidden"});
        $("#filter").html("<center>Loading ... <br/> หากนานเกิน 5 วินาที กรุณาปิดหน้านี้แล้วเปิดใหม่</center>");
        /*รับค่าจากการคลิกเมนูรายงานมา 2 ค่า ('ชื่อรายงาน','ID รายงาน')*/
        $("#head_report").html(title + "<br/>" + "<p style='font-size:14px; padding-left:10px;color:#ffff00;'> " + subtitle + "</p>");// เซ็ต หัว Dialog รายงาน
        /*สร่าง Link ส่งค่าไปยัง Controller เพื่อเช็คว่า ใช้ ตัวไหน จาก รหัสข้อที่ส่งเข้าไป*/
        var web_url = "<?php echo Yii::app()->baseUrl; ?>" + "/index.php/" + template + "/report_id/" + report_id;
        /*เมื่อเช็คแล้วให้ แสดงที่ Box filter*/
        $("#filter").load(web_url);
        $('#overlay').show();
        $('#overlay').addClass('slideDown');
        /*$("#myModalShowReport").modal();*/
    }

    function closewindow() {
        $("body").css({"overflow": "auto"});
        $('#overlay').hide();
    }

</script>

<!--
#   Author Kimniyom
#   Dialog ShowReport
#   2014/12/08 09:11
-->

<?php
$this->breadcrumbs = array(
    "ค้นหา" => Yii::app()->createUrl('main'),
    $search
);

$Language = new Language();
$lg = $Language->GetLanguageDefault();

$WEBSITE = SysWebsite::model()->find("id = '1'");
?>

<!--<div class="row valign-wrapper  cyan darken-3" style=" border-radius: 35px 5px 5px 35px;">-->
<h4>คำค้นหา: <font style="color:red;">"<?php echo $search ?>"</font></h4>

<div class="row">
    <div class="col s12 m12 l12">
        <ul class="collection with-header" style=" background: none; border: none;">
            <?php foreach ($datas as $rs): ?>
                <!--
                # Comment By Kimniyom
                # คลิกเมนู ให้ทำงานที่ Function openwindow โดยส่งค่า Paramiter 2 ค่า คือ (ชื่อรายงาน,ID รายงาน)
                #
                -->
                <a href="<?php echo Yii::app()->createUrl('reports/index', array('group' => $rs['menugroup_id'], 'reportid' => $rs['id'])) ?>"
                   class="collection-item"
                   id="color-hover"
                   style="border-bottom: #838383 dashed 1px; font-weight: normal;">
                    <i class="mdi-action-assignment"></i>

                    <?php
                    echo str_replace($search, "<font style='color:red;'>$search</font>", $rs['name' . $lg]);
                    //echo $rs['name' . $lg];
                    ?>
                    <?php
                    if (!empty($rs['subtitle'])) {
                        echo "<br/><font style='font-size:14px; color:blue;'><i class='fa fa-tag'></i> " . $rs['subtitle' . $lg] . "</font>";
                    }
                    ?>
                    <span style="font-weight: normal; color: #666666;">
                        <?php echo $Language->Source(); ?>
                    <?php echo $rs['source' . $lg]; ?></span>
                    <i class="mdi-content-send secondary-content"></i>
                    <?php if ($rs['controller'] == '') { ?>
                        <p style="color: #ff6600; float: left; font-size: 13px; margin-top: 5px; clear: both;">กำลังดำเนินการ</p>
                <?php } ?>
                </a>
<?php endforeach; ?>
        </ul>
    </div>
</div>
