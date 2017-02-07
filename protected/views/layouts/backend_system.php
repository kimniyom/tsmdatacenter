<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo Yii::app()->params['appTitle'] ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <?php $link = Yii::app()->baseUrl . "/themes/AdminLTE2/"; ?>
        <link href="<?php echo $link; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Card -->
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/card.css" rel="stylesheet" type="text/css" />

        <!-- Font Awesome Icons -->
        <link href="<?php echo Yii::app()->baseUrl ?>/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/images/icon-tak.png">
        <!-- Theme style -->
        <link href="<?php echo $link; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $link; ?>dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $link; ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.3 -->
        <script src="<?php echo $link; ?>plugins/jQuery/jQuery-2.1.3.min.js"></script>

        <!-- ExtJS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/css/ext-all.css"/>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/ext-all.js"></script>

        <!-- Treeview -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/jstree/themes/default/style.min.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/jstree/jstree.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                var user = "<?php echo Yii::app()->session['admin_flag'] ?>";
                if (user != '1') {
                    //window.location = "<?//php echo Yii::app()->createUrl('') ?>";
                }
            });
        </script>
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the 
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |  
    |---------------------------------------------------------|
    
    -->
    <body class="skin-red fixed">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header" style=" background: #FFF; border-bottom: #999999 solid 1px;">

                <!-- Logo -->
                <a href="#" class="logo"><b><i class="fa fa-user"></i><i class="fa fa-gear"></i> Admin</b></a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-fixed-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="<?php echo $link; ?>dist/img/avatar5.png" class="user-image" alt="User Image"/>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs"><?php echo Yii::app()->session['name']; ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar" style=" border-right: #999999 solid 1px;">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $link; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo Yii::app()->session['distcode'] . ' - ' . Yii::app()->session['name']; ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <hr/>

                    <!-- Sidebar Menu-->

                    <?php //if (Yii::app()->session['name'] != '') { ?>
                    <ul class="sidebar-menu">
                        <?php if (Yii::app()->session['admin_flag'] == "1") { ?>
                            <!--
                                <li><a href="<?//php echo Yii::app()->createUrl('Sysicon/ShowSysicon') ?>""><i class=" fa fa-meh-o"></i> ไอค่อน</a></li>
                                <li><a href="<?//php echo Yii::app()->createUrl('User/ShowUser') ?>"><i class=" fa fa-users"></i> จัดการ User</a></li>
                                <li><a href="<?//php echo Yii::app()->createUrl('Sysitems') ?>"><i class=" fa fa-list-alt"></i> รายการสำหรับรายงาน</a></li>
                                <li><a href="<?//php echo Yii::app()->createUrl('Userpriv') ?>"><i class=" fa fa-wrench"></i> กำหนดสิทธิ์</a></li>
                                <li><a href="<?//php echo Yii::app()->createUrl('backoffice/showgroupreport/') ?>"><i class=" fa fa-th-list"></i> รายงาน</a></li>
                                <li><a href="<?//php echo Yii::app()->createUrl('Frontend') ?>"><i class=" fa fa-keyboard-o"></i> บันทึกข้อมูล</a></li>
                            -->
                            <li><a href="<?php echo Yii::app()->createUrl('typenews') ?>"><i class=" fa fa-newspaper-o text-yellow"></i> ประเภทข่าว</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('news') ?>"><i class=" fa fa-newspaper-o text-green"></i> ข่าวประชาสัมพันธ์</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('photo') ?>"><i class=" fa fa-photo text-orange"></i> รูปภาพกิจกรรม</a></li>
                        <?php } else { ?>
                            <li><a href="<?php echo Yii::app()->createUrl('codistrict') ?>"><i class=" fa fa-newspaper-o text-green"></i> คีย์ข้อมูลอำเภอ</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('cooffice') ?>"><i class=" fa fa-keyboard-o text-red"></i> คีย์ข้อมูลสถานบริการ</a></li>
                        <?php } ?>    
                    </ul>
                    <?php //} ?>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Admin
                        <small>Admin Menager</small>
                    </h1>
                    <ol class="breadcrumb" id="navicator">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>"><span class=" glyphicon glyphicon-off"></span> Logout</a>
                        </li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php if (isset($this->breadcrumbs)): ?>
                        <div class="well well-sm">
                            <?php
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'homeLink' => CHtml::link('Home', Yii::app()->createUrl('backend')),
                                'links' => $this->breadcrumbs,
                            ));
                            ?><!-- breadcrumbs -->
                        </div>
                    <?php endif ?>
                    <?php echo $content; ?>

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">

                </div>
                <!-- Default to the left --> 
                <strong>Copyright &copy; 2015 <a href="#">ศูนย์ข้อมูลสาธารณสุข</a></strong> จังหวัดตาก
            </footer>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->



        <script src="<?php echo $link; ?>plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo $link; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $link; ?>dist/js/app.min.js" type="text/javascript"></script>


        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo $link; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
        <!-- Morris.js charts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo $link; ?>plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo $link; ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $link; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $link; ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $link; ?>plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo $link; ?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo $link; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo $link; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="<?php echo $link; ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo $link; ?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo $link; ?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    </body>
</html>