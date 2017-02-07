<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        var width = "<?php echo Yii::app()->session['width']; ?>";/*ความกว้างของหน้าจอ*/
        var widthVal;
        var widthPersen;
        var widthResult;
        if (width <= 751) {
            /*Config For Mobile : By Kimniyom*/
            $(".img_report").hide();
            widthVal = ((width * 20) / 100);/*หา 20 % ของความสูง*/
            widthPersen = (width - widthVal).toString();
            widthResult = widthPersen.slice(0, 3);
            //alert(widthResult);
            var styles = {
                "text-overflow": "ellipsis",
                "overflow": "hidden",
                "white-space": "nowrap",
                "width": widthResult
            };
            $(".text_menu").css(styles);
            $("#head_report").css(styles);
            //$(".SetfontReport").css(styles);
        }
    });

</script>


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

<script>
    $(document).ready(function () {
        $("#back_btn").show();
    });
</script>

<!--
#   Author Kimniyom
#   Dialog ShowReport
#   2014/12/08 09:11
-->

<?php
$this->breadcrumbs = array(
    //"รอชำระเงิน" => Yii::app()->createUrl('frontend/orders/informpayment'),
    $groupname
);
?>

<!-- Dialog แสดงเงื่อนไขการดูรายงาน -->
<div id="overlay" class="">
    <button type="button" class="close" id="close_overlay" 
            data-toggle="tooltip" data-placement="bottom" title="ปิด"
            style="color:#FFF; position: absolute; top: 0px; right: 10px; background: #ff6600; padding: 2px 10px;"
            onclick="closewindow();">&times;</button>

    <h4 class="modal-title"> 
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/documents-icon.png" style=" float: left;"/>
        <p id="head_report"></p>
    </h4>
    <!-- แสดง Filter จากการเรียก Function openwindow -->
    <div id="filter"></div>
</div>

<!--
#
# End Dialog 
#
-->
<div id="animation_effect" class="fadeIn">
    <div class="list-group" style=" border-radius: 0px; border: none;">
        <a  class="list-group-item  list-group-item-info"  style=" border-radius: 0px; border: none; ">
            <h4>
                <span class=" glyphicon glyphicon-folder-open"></span>&nbsp <?php echo $groupname; ?>
            </h4>
        </a>
        <?php foreach ($listmenu as $rs): ?>
            <!--
            # Comment By Kimniyom
            # คลิกเมนู ให้ทำงานที่ Function openwindow โดยส่งค่า Paramiter 2 ค่า คือ (ชื่อรายงาน,ID รายงาน)
            #
            -->
            <a href="javascript:void(0)"class="list-group-item" 
               onclick="openwindow('<?php echo $rs['name']; ?>', '<?php echo $rs['id'] ?>', '<?php echo $rs['template'] ?>', '<?php echo $rs['subtitle'] ?>');" 
               style=" border-radius: 0px; border-left: 0px; border-right: 0px" id="lisemenureport">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12" style=" text-align: left;">
                        <div class="text_menu" style="float: left;">
                            <span class="glyphicon glyphicon-list-alt  i_report" style=" color: #999999;"></span> 
                            <?php echo $rs['name']; ?>
                            <?php
                            if (!empty($rs['subtitle'])) {
                                echo "<br/><font style='font-size:14px; color:blue;'><i class='fa fa-tag'></i> " . $rs['subtitle'] . "</font>";
                            }
                            ?>
                        </div><br/>
                        <p style="color: #ff6600; float: left; font-size: 13px; margin-top: 5px; clear: both;">
                            <span class="glyphicon glyphicon-home i_info" style=" color: #999999;"></span> ที่มา : <?php echo $rs['source']; ?>
                        </p>
                        <?php if ($rs['controller'] == '') { ?>
                            <p style="color: #ff6600; float: left; font-size: 13px; margin-top: 5px; clear: both;">กำลังดำเนินการ</p>
                        <?php } ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>