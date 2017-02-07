<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'รูปภาพกิจกรรม',
);

$ModelAlbum = new Album();
$Language = new Language();
?>

<div class="row valign-wrapper" style=" border-bottom: #999999 solid 2px; width: 100%; position: relative;">
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/pictures-icon.png" class="circle responsive-img"/>
    <h4 class="green-text">
        &nbsp;รูปภาพกิจกรรม
    </h4>
</div>
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
    'header' => '',
    'nextPageLabel' => 'Next',
    'prevPageLabel' => 'Prev',
    'selectedPageCssClass' => 'active',
    'hiddenPageCssClass' => 'disabled',
    'htmlOptions' => array(
        'class' => 'pagination',
    )
))
?>
<div class="row">
    <?php
    foreach ($album as $rs):
        $images = $ModelAlbum->GetfirstAlbum($rs['id']);
        ?>
        <div class="col s12 m4 l3">
            <div class="container-card set-views-card box-all" style=" background: #f9f9f9; height: 300px;">
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
                <p class="detail green-text" style=" text-align: left;margin-top: 20px;">
                    <?php echo $rs['title'] ?><br/>
                    <font style=" font-size: 12px;" class="pull-right"><?php echo $Language->date_th($rs['create_date']) ?></font>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
    'header' => '',
    'nextPageLabel' => 'Next',
    'prevPageLabel' => 'Prev',
    'selectedPageCssClass' => 'active',
    'hiddenPageCssClass' => 'disabled',
    'htmlOptions' => array(
        'class' => 'pagination',
    )
))
?>




