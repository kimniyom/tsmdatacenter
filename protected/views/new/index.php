<style type="text/css">
    #table-border-new table thead tr th{
        border-bottom: none;
    }
    #table-border-new table tbody tr{
        border-bottom: #999999 dashed 1px;
    }
</style>
<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$Language = new Language();
$lg = $Language->SetLanguage();
$this->breadcrumbs = array(
    $types['typename_' . $lg],
);
?>

<div class="row valign-wrapper" style=" border-bottom: #999999 solid 2px; width: 100%; position: relative;">
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/bbc-news-icon.png" class="circle responsive-img"/>
    <h4 class="red-text" id="head-menu">
        &nbsp;<?php echo $types['typename_' . $lg] ?>
    </h4>
</div>


<div class="row">
    <div class="col m9 l9">
        <div id="table-border-new">
            <table class="bordered highlight">
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($news as $rs): $i++;
                        if ($lg == 'th') {
                            $date = $Language->date_th($rs['create_date']);
                        } else {
                            $date = $Language->date_en($rs['create_date']);
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="<?php echo Yii::app()->createUrl('new/view', array('id' => $rs['id'], 'typeId' => $types['id'])) ?>" class="red-text">
                                    <?php echo $date ?> <?php echo $rs['title_' . $lg] ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col s12 m3 l3">
        <div class="card">
            <div class="card-content">
                <h4>
                    <?php
                    if ($lg == 'th') {
                        echo "ประเภทข่าว";
                    } else {
                        echo "TypeNews";
                    }
                    ?>
                </h4>
                <div class="collection">
                    <?php
                    foreach ($typesall as $typedata):
                        ?>
                        <a href="<?php echo Yii::app()->createUrl('new/index', array('type' => $typedata['id'])) ?>" class="collection-item"><?php echo $typedata['typename_' . $lg] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tablenews").dataTable();
    });
</script>

