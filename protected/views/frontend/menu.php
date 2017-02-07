<style type="text/css">
    #animation_effect{
        visibility: hidden;
        width: 100%;
    }

</style>

<h4 style=" margin: 0px;">
    <?php echo $catalogName; ?>
</h4>
<div style=" width: 100%; height: 10px; border-bottom:#999999 solid 1px; margin: 5px 0px;"></div>
<div id="animation_effect" class="fadeIn">
    <?php
    $i = 0;
    //$row = 0;

    if (count($group_menu) > 0) {
        foreach ($group_menu as $rs):
            $i++;

            //echo '<div class="row" style="margin-bottom:10px;">';
            ?> 
            <div class="row" style="margin-bottom:10px;">
                <div class="col-lg-6 col-sm-6 col-6">
                    <a href="<?php echo Yii::app()->createUrl('Frontend/Record', array('group_id' => $rs['id'], 'group_name' => $rs['name'])); ?>" 
                       id="<?php echo $rs['color'] ?>"class="list-group-item">
                        <div class="btn" id="sub_menu_group">
                            <?php if (isset($rs['icon'])) { ?>
                                <img src="<?php echo Yii::app()->baseUrl ?>/assets/icon_system/<?php echo $rs['icon']; ?>"/>
                                <? } else { ?>
                                <i class="fa fa-clipboard fa-4x"></i>
                            <?php } ?>
                            <h4><?php echo $rs['name'] ?></h4>
                        </div>
                    </a>
                </div>
            </div>

            <?php
        endforeach;
    }
    ?>
</div>

