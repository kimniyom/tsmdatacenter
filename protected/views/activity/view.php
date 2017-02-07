

<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'รูปภาพกิจกรรม' => array('index'),
    $album['title'],
);
?>

<center>
    <h4 style=" color: #6666ff; "><?php echo $album['title'] ?></h4>
    <p style=" color: #999999;"><?php echo $album['detail'] ?></p>
    <p style=" font-size: 12px; color: #cccccc;"><?php echo $album['create_date'] ?></p>
</center>
<div class="row">
    <?php foreach ($gallery as $rs): ?>
        <div class="col s12 m4 l3">
            <div class="container-card set-views-card box-all card" style=" height:250px;">
                <div class="img-wrapper">
                    <a href="<?php echo Yii::app()->baseUrl; ?>/uploads/photo/<?php echo $rs['images']; ?>" class="fancybox" rel="ligthbox">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/photo/<?php echo $rs['images']; ?>" style="height:250px; z-index: 10;"/></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        //FANCYBOX
        //https://github.com/fancyapps/fancyBox
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });

</script>

