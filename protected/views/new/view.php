
<?php
/* @var $this NewsController */
/* @var $model News */

$Language = new Language();
$lg = $Language->SetLanguage();

$this->breadcrumbs = array(
    $type['typename_' . $lg] => array('index', 'type' => $type['id']),
    $model['title_' . $lg],
);
?>

<h4 class="red-text"> <?php echo $model['title_' . $lg]; ?></h4>
<hr/>
<p style=" font-size: 12px;">
    <?php
    if ($lg == 'th') {
        echo $Language->date_th($model['create_date']);
    } else {
        echo $Language->date_en($model['create_date']);
    }
    ?>
</p>
<?php
echo $model['detail_' . $lg];
?>

<br/>

<?php
if ($model->file == '1') {
    ?>
    <hr/>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-paperclip"></i> ไฟล์แนบ
        </div>
        <div class="panel-body">
            <?php
            foreach ($file as $files):
                ?>
                <a href="<?php echo Yii::app()->baseUrl; ?>/uploads/news/<?php echo $files['filename'] ?>" target="_bank">
                    <i class="fa fa-file-pdf-o"></i> <?php echo $files['filename'] ?></a> 
                <br/>
                <?php
            endforeach;
            ?>
        </div>
    </div>
    <?php
}
?>
