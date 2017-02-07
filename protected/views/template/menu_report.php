<style type="text/css">
    #animation_effect{
        visibility: hidden;
        width: 100%;
    }
</style>

<h4 style="margin-bottom: 0px; background: #0099ff; position: fixed; z-index: 1; width: 100%; 
    height: 40px; margin-top: 0px; padding-top: 10px; padding-left: 10px; color: #FFF;
    box-shadow: #00526e 0px 0px 3px 0px;">
    <?php echo "กลุ่ม " . $catalogName; ?>
</h4>
<div id="animation_effect" class="fadeIn" style=" padding: 20px; padding-top: 45px;">
    <?php
    $i = 0;
    $row = 0;

    if (count($group_menu) > 0) {
        foreach ($group_menu as $rs):
            $i++;

            if ($row != $rs['rowid']) {
                echo '<div class="row" style="margin-bottom:10px;">';
                $row = $rs['rowid'];
            }

            $countmenu = new SysReportlist();
            $TOTAL = $countmenu->getcountlist($rs['id']);
            ?> 

            <div class="<?php echo $rs['code'] ?>" style=" margin: 0px;padding: 5px; margin-top:0px; margin-bottom: 0px; padding-bottom: 0px; padding-bottom: 0px;">
                <a href="<?php echo Yii::app()->createUrl('Main/GetReportList', array('group_id' => $rs['id'], 'group_name' => $rs['name'])); ?>" 
                   data-toggle="tooltip" data-placement="top" title="<?php echo $rs['name'] ?>"
                   id="<?php echo $rs['color'] ?>"class="list-group-item">
                    <div class="btn" id="sub_menu_group">
                        <?php if (isset($rs['icon'])) { ?>
                            <img src="<?php echo Yii::app()->baseUrl ?>/assets/icon_system/<?php echo $rs['icon']; ?>"/>
                        <? } else { ?>
                            <i class="fa fa-clipboard fa-4x"></i>
                        <?php } ?> 
                        <label class="label label-danger" style=" position: absolute; top: 5px; font-size: 18px;"><?php echo $TOTAL; ?></label>
                    </div>

                    <div style="text-overflow:ellipsis;overflow: hidden;white-space:nowrap;">
                        <center><h4><?php echo $rs['name'] ?></h4></center>
                    </div>

                </a>
            </div>


            <?php
            if (count($group_menu) == $i || $group_menu[$i]['rowid'] != $row) {
                echo '</div>';
            }

        endforeach;
    }
    ?>
</div>

