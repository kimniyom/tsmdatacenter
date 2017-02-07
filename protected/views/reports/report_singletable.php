<script src="<?php echo Yii::app()->baseUrl; ?>/js/ConfigLayout.js" type="text/javascript"></script>

<?php
    $pathSWF = Yii::app()->baseUrl . "/assets/Datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf";
?>

<input type="hidden" id="fileexport" value="<?php echo $pathSWF; ?>"/>
<div class="ContentReport">
    <?php echo $tables; ?>
    <font style=" font-size: 12px;">ประมวลผลวันที่ : <?php //echo $DateUpdate; ?></font>
</div>