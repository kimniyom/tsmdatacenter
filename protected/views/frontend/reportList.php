
<div class="row valign-wrapper" style=" padding-left: 10px; border-bottom: #666666 solid 2px; margin-bottom: 0px;">
    <img src="<?php echo Yii::app()->baseUrl . "/assets/icon_system/" . $group['icon'] ?>" class="responsive-img" style="height: 32px;"/> 
    <h4 class="green-text">
        &nbsp;<?php echo $groupname ?>
    </h4>
</div>

<form id="record" action="<?php echo Yii::app()->baseUrl; ?>/index.php/Frontend/Record" method="post">
    <input type="hidden" id="reportId" name="reportId" value="">
    <div class="row">
        <div class="col s12 m12 l12">
            <ul class="collection with-header" style=" background: none; border: none;">
                <?php foreach ($listmenu as $rs): ?>
                    <a onclick="submit('<?php echo $rs['id']; ?>')" 
                       class="collection-item"
                       id="color-hover"
                       style="border-bottom: #838383 dashed 1px; cursor: pointer;">
                        <i class="mdi-action-assignment"></i>
                        <?php echo $rs['name' . Language::getLangField()]; ?>
                        <?php
                        if (!empty($rs['subtitle'])) {
                            echo "<br/><font style='font-size:14px; color:blue;'><i class='fa fa-tag'></i> " . $rs['subtitle' . Language::getLangField()] . "</font>";
                        }
                        ?>
                        &nbsp; &nbsp;
                        <span style="font-weight: normal; font-size: 12px; color: #666666;">
                            <?php echo Language::Source(); ?>
                            <?php echo $rs['source' . Language::getLangField()]; ?></span>
                        <i class="mdi-hardware-keyboard secondary-content"></i>
                        <?php if ($rs['controller'] == '') { ?>
                            <p style="color: #ff6600; float: left; font-size: 13px; margin-top: 5px; clear: both;">กำลังดำเนินการ</p>
                        <?php } ?>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</form>

<script language="JavaScript">
    function submit(reportId) {
        $("#reportId").val(reportId);
        $("#record").submit();
    }
</script>