<style type="text/css">

    @media(max-width: 1580px) {
        #fres { 
            font-size: 2em; 
            border-bottom: #999999 solid 2px; padding-bottom: 10px; color: #666666;
        }
    }
    @media(max-width: 980px) {
        #fres { 
            font-size: 1em;  
            border-bottom: #999999 solid 2px; padding-bottom: 10px; color: #666666;
        }
    }
</style>
<?php
//$Language = new Language();
$lg = Language::GetLanguageDefault();

$this->breadcrumbs = array(
    $group['name' . $lg] => Yii::app()->createUrl('main/Getreportlist', array('groupid' => $group['id'], 'groupname' => $group['name' . $lg])),
    $report['name' . $lg]
);
?>

<div id="fres">
    <img src="<?php echo Yii::app()->baseUrl; ?>/images/Custom-reports-icon.png" style=" width: 38px;"/> <?php echo $report['name' . $lg] ?>
</div>

<div id="filters"></div>

<script type="text/javascript">

    $(document).ready(function () {
        var template = "<?php echo $report['template'] ?>";
        var report_id = "<?php echo $report['id'] ?>";
        var web_url = "<?php echo Yii::app()->baseUrl; ?>" + "/index.php/" + template + "/report_id/" + report_id;

        $("#filters").load(web_url);
    });

</script>