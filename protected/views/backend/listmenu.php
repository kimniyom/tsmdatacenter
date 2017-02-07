<!--
/**
 * Description of listmenu
 *
 * @author Sittipong Promhan
 * @create Aug 4, 2016 11:18:59 AM
 * @copyright (c) Tak Provincial Health Office
 */
-->



<?php
    $this->breadcrumbs = array($groupname);
?>

<div class="row valign-wrapper  cyan darken-3" style=" border-radius: 35px 5px 5px 35px;">
    <img src="<?php echo Yii::app()->baseUrl . "/assets/icon_system/" . $group['icon'] ?>" class="circle responsive-img"/> 
    <h4 class="white-text">
        &nbsp;<?php echo $groupname ?>
    </h4>
</div>


<div class="row">
    <div class="col s12 m12 l12">
        <ul class="collection with-header" style=" background: none; border: none;">
            <?php foreach ($listmenu as $rs): ?>
                <!--
                # Comment By Kimniyom
                # คลิกเมนู ให้ทำงานที่ Function openwindow โดยส่งค่า Paramiter 2 ค่า คือ (ชื่อรายงาน,ID รายงาน)
                #
                -->
                <a href="<?php echo Yii::app()->createUrl('reports/index', array('group' => $groupid, 'reportid' => $rs['id'])) ?>"
                   class="collection-item"
                   id="color-hover"
                   style="border-bottom: #838383 dashed 1px;">
                    <i class="mdi-action-assignment"></i>
                    <?php echo $rs['name'.Language::getLangField()]; ?>
                    <?php
                    if (!empty($rs['subtitle'])) {
                        echo "<br/><font style='font-size:14px; color:blue;'><i class='fa fa-tag'></i> " . $rs['subtitle'.Language::getLangField()] . "</font>";
                    }
                    ?>
                    &nbsp; &nbsp;
                    <span style="font-weight: normal; font-size: 12px; color: #666666;">
                        <?php echo Language::Source(); ?>
                        <?php echo $rs['source'.Language::getLangField()]; ?></span>
                    <i class="mdi-content-send secondary-content"></i>
                    <?php if ($rs['controller'] == '') { ?>
                        <p style="color: #ff6600; float: left; font-size: 13px; margin-top: 5px; clear: both;">กำลังดำเนินการ</p>
                    <?php } ?>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
