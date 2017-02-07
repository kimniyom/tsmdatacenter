<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <!-- Stack the columns on mobile by making one full-width and the other half-width -->
        <div class="row">   
            <div class="col-xs-3 col-md-3"><a href="<?php echo Yii::app()->createUrl('Catalog')?>" class="btn btn-primary btn-lg">สร้างหมวดรายงาน</a></div>
            <div class="col-xs-3 col-md-3"><a href="#" class="btn btn-primary btn-lg">สร้างกลุ่มรายงาน</a></div>
            <div class="col-xs-3 col-md-3"><a href="#" class="btn btn-primary btn-lg">สร้างรายงาน</a></div>
            <div class="col-xs-3 col-md-3"><a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>" class="btn btn-primary btn-lg">สร้างผู้ใช้</a></div>
        </div>
    </body>
</html>