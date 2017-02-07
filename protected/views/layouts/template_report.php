<html>

    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/css/bootstrap.css">
        <!--<link rel="stylesheet" href="assets/bootstrap3/css/bootstrap-theme.min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/icon/css/font-awesome.min.css" rel="stylesheet">
        <!-- SideBar -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/sidebar.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Datatable -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/css/jquery.dataTables.css">
       
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/js/jquery.dataTables.js"></script>

        <!-- Extension Datatable -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/Responsive/css/dataTables.responsive.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/Responsive/js/dataTables.responsive.js"></script>

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/FixedColumns/css/dataTables.fixedColumns.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/FixedColumns/js/dataTables.fixedColumns.js"></script>
    </head>
    <body>


                <?php echo $content; ?>

    </body>
</html>