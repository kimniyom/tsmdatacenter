<style type="text/css">
    #cnews{
        padding: 0px;
        margin-bottom: 5px;
    }
    #cnews #linknews{
        color: #666666;
        padding: 0px;
        font-size: 14px;
    }

    #cnews #linknews:hover{
        color: #ff0000;
    }
    #cnews > #span{
        font-size:1em;
        line-height:1em;
        /*height:1em;*/
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media only screen and (max-width: 500px) {
        #head-menu{
            font-size: 2em;
        }
    }
</style>

<?php
$Language = new Language();
$NewsModel = new News();
$TypeNews = new Typenews();
$AlbumModel = new Album();

$album = $AlbumModel->GetAlbumLimit(4);
$lg = $Language->SetLanguage();
?>

<?php
foreach ($TypeNews->GetTypeAllActive() as $type):
    $typenews = "typename_" . $lg;
    ?>
    <!-- style=" border-radius: 35px 5px 5px 35px;"  light-green darken-2 -->
    <div class="row valign-wrapper" style=" border-bottom: #999999 solid 2px; width: 100%; position: relative;">
        <img src="<?php echo Yii::app()->baseUrl; ?>/images/bbc-news-icon.png" class="circle responsive-img"/>
        <h4 class="red-text" id="head-menu">
            &nbsp;<?php echo $type[$typenews] ?>
        </h4>
        <a href="<?php echo Yii::app()->createUrl('new/index', array('type' => $type['id'])) ?>" style=" right: 0px; bottom: 0px; position: absolute;">
            <button type="button" class="btn grey white-text">...more</button></a>
    </div>

    <?php
    foreach ($NewsModel->GetnewsAllType($type['id']) as $rs):
        $title = "title_" . $lg;
        ?>
        <div id="cnews" style="border-bottom: #ff9900 dashed 1px;" >
            <div id="span">
                <span class="btn light-green darken-1 white-text" style="color: #ff0000; padding: 5px; padding-top: 0px; border-radius: 20px;"> 
                    <?php
                    if ($lg == 'th') {
                        echo $Language->date_th($rs['create_date']);
                    } else {
                        echo $Language->date_en($rs['create_date']);
                    }
                    ?>
                </span>
                <a href="<?php echo Yii::app()->createUrl('new/view', array('id' => $rs['id'], 'typeId' => $type['id'])) ?>" id="linknews"><?php echo $rs[$title] ?></a>
            </div>
        </div>
    <?php endforeach; ?>
    <br/><br/>
    <?php
endforeach;
?>

<!--
    ########### กิจกรรม ##########
    ##########################
-->

<div class="row valign-wrapper" style=" border-bottom: #999999 solid 2px; width: 100%; position: relative;">
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/pictures-icon.png" class="circle responsive-img"/>
    <h4 class="red-text" id="head-menu">
        &nbsp;รูปภาพกิจกรรม
    </h4>
    <a href="<?php echo Yii::app()->createUrl('activity') ?>" style=" right: 0px; bottom: 0px; position: absolute;">
        <button type="button" class="btn grey white-text">...more</button></a>
</div>
<div class="row">
    <?php
    foreach ($album as $rs):
        $images = $AlbumModel->GetfirstAlbum($rs['id']);
        ?>
        <div class="col s12 m4 l3">
            <div class="container-card set-views-card box-all" style=" background: #f9f9f9; height: 230px; padding: 0px;">
                <a href="<?php echo Yii::app()->createUrl('activity/view/', array('id' => $rs['id'])) ?>">
                    <div class="port-3 effect-1">
                        <div class="image-box">
                            <div class="img-wrapper">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/photo/<?php echo $images; ?>" class="test" style="height:200px; z-index: 100;"/>
                            </div>
                        </div>
                        <div class="text-desc">
                            <h3><?php echo $rs['title'] ?></h3>
                            <p><?php echo $rs['detail'] ?></p>
                        </div>
                    </div>
                </a>
                <p class="detail green-text" style=" text-align: left;">
                    <font style=" font-size: 12px;" class="pull-right"><?php echo $Language->date_th($rs['create_date']) ?></font>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>






