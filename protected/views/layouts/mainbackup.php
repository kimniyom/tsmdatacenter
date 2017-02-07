<!DOCTYPE html>
<!--
    Project : TAK Datacenter Ampur
    Author : Kimniyom
-->
<html>
    <head>
        <title>TAK Information Center</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/css/bootstrap-flatly.css">
        <!--<link rel="stylesheet" href="assets/bootstrap3/css/bootstrap-theme.min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/icon/css/font-awesome.min.css" rel="stylesheet">
        <!-- SideBar -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/sidebar_1.css">

        <!-- Animation -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/animation.css">

        <!-- Css Color -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/button.css">

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

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/TableTools/css/dataTables.tableTools.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/TableTools/js/dataTables.tableTools.js"></script>

        <!-- ExtJS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/css/ext-all.css"/>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/ext-all.js"></script>

        <!-- Function Resize Page Support Mobile <= 751 -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/ResizePage.js"></script>

        <!-- Report Css -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/report/report.css"/>

        <!-- Chart -->
        <script src="<?php echo Yii::app()->baseUrl ?>/assets/heightchart/js/highcharts.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->baseUrl ?>/assets/heightchart/js/themes/grid-light.js" type="text/javascript"></script>

       
        <script type="text/javascript">
            function cleartext() {
                $("#username").val('');
                $("#password").val('');
            }

            function checklogin() {
                var user = $("#username").val();
                var pass = $("#password").val();
                var data = {user: user, pass: pass};
                //alert(user);
                if (user == '') {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Wornning',
                        msg: 'กรุณากรอกชื่อผู้ใช้งานด้วย',
                        buttons: Ext.MessageBox.OK

                    });
                    $("#username").focus();
                } else if (pass == '') {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Wornning',
                        msg: 'กรุณากรอกรหัสผ่านด้วย',
                        buttons: Ext.MessageBox.OK

                    });
                    $("#password").focus();
                } else {

                    //var url = "";
                    $.ajax({
                        url: "<?php echo Yii::app()->createUrl('//User/Checklogin') ?>",
                        type: "POST",
                        data: {user: user, pass: pass}
                    }).done(function(succ) {
                        //alert(html);
                        if (succ == 'success') {
                            //alert('Login Success');
                            window.location.assign("<?php echo Yii::app()->createUrl('//Backoffice/ShowCatalog') ?>");
                        } else {
                            //alert(succ);
                            Ext.Msg.alert({
                                //width: 400,
                                title: 'Wornning',
                                msg: 'กรุณาตรวจสอบชื่อผู้ใช้งานและรหัสผ่านด้วย',
                                buttons: Ext.MessageBox.OK

                            });
                        }
                    });
                }
            }

            function checkEnter1() {
                if (window.event.keyCode == '13') {
                    $('#password').focus();
                }
            }
            function checkEnter() {
                if (window.event.keyCode == '13') {
                    checklogin();
                }
            }
        </script>
        <style>
            .panel-heading {
                padding: 5px 15px;
            }

            .panel-footer {
                padding: 1px 15px;
                color: #A0A0A0;
            }

            .profile-img {
                width: 96px;
                height: 96px;
                margin: 0 auto 10px;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }

        </style>

    </head>
    <body>
        <!-- Start Modal -->
        <!-- Modal -->
        <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel" style=" text-align: center;">TAK Health Information Center Authentication</h4>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="container" style="margin-top:10px; width: 100%; position: relative;">

                            <img class="profile-img"
                                 src="<?php echo Yii::app()->baseUrl ?>/images/photo.png" alt="">

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </span> 
                                    <input class="form-control" placeholder="Username" onkeydown="checkEnter1();"id="username" name="username" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </span>
                                    <input class="form-control" placeholder="Password" onkeydown="checkEnter();" id="password" name="password" type="password" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style=" text-align: center;">
                        <button type="button" class="btn btn-info" onclick="checklogin();"><span class=" glyphicon glyphicon-check"></span> ตกลง</button>
                        <button type="button" class="btn btn-danger" onclick="cleartext();"><span class=" glyphicon glyphicon-remove"></span> ยกเลิก</button>
                    </div>


                </div>
            </div>
        </div>

        <!-- End Modal -->
        <div id="wrapper">

            <!-- Sidebar -->

            <nav class="navbar navbar-default" role="navigation" style="margin-bottom: 0px;">
                <div class="container">
                    <div id="sidebar-wrapper" class="sidebar-toggle">

                        <ul class="sidebar-nav">
                            <li class="">
                                <a href="javascript:window.location.reload();" style=" padding: 0px; border:none;">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo Yii::app()->session['logo']; ?>" style="width:100%;" id="img_menu"/>
                                </a>
                            </li>
                            <?php if (Yii::app()->session['name'] == '') { ?>
                                <?php
                                $i = 0;
                                $catalog = Yii::app()->session['catalog'];
                                foreach ($catalog as $rs):
                                    $i++;
                                    $menu_id = $i;
                                    if (Yii::app()->session['menu'] == $i) {
                                        $active = " class = 'active_menu' ";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('main/GetSubmenu', array("catalog_id" => $rs['id'], "menu_id" => $menu_id, "catalogname" => $rs['name'])); ?>" <?php echo $active; ?>>
                                            <span class="glyphicon glyphicon-send" style=" padding-left: 3px;"></span> <?php echo $rs['name']; ?> 
                                        </a>
                                    </li>

                                <?php endforeach; ?>
                            <?php } else { ?>
                                <br/>
                                <img class="profile-img" src="<?php echo Yii::app()->baseUrl ?>/images/photo.png" alt=""><br/>
                                <div style=" color: #ffffff; text-align: center;">
                                    ผู้ใช้งาน : <span class=" glyphicon glyphicon-user"></span> <?php echo Yii::app()->session['name']; ?><br/>
                                    รหัสอำเภอ : <span class="glyphicon glyphicon-leaf"></span> <?php echo Yii::app()->session['distcode']; ?>
                                </div>
                            <?php } ?>

                            <!-- Logo -->
                            <div style=" color: #ffffff; text-align: center; bottom: 50px; width: 100%;">
                                <br/><br/>
                                <img  src="<?php echo Yii::app()->baseUrl ?>/images/logoSSJ.png" alt="">
                                <img  src="<?php echo Yii::app()->baseUrl ?>/images/logo_takis.png" alt="">
                                <font style=" color: #cccccc; font-size: 12px;">
                                <br/>&COPY; ศูนย์ขัอมูลจังหวัดตาก
                                <br/>เวอร์ชั่น 1.3
                                </font>
                            </div>

                        </ul>

                    </div>
                </div>
            </nav>


            <div class="modal fade" id="backgroungsidebar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            </div>

            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->

            <div id="page-content-wrapper" style=" padding: 0px;">
                <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="bg-navbar" style="margin-bottom: 0px;">

                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">

                            <a href="#" class="navbar-toggle collapsed"  data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>

                            <div class="navbar-brand" id="back_btn" style="padding-top:0px; height: 30px;display: none; list-style-type: none;">
                                <a href="Javascript:(0);" onclick="history.back();"><i class="fa fa-angle-left fa-3x" id="listnone"></i></a>
                            </div>

                            <!--
                            <a href="Javascript:(0);" class="navbar-brand" style="padding:2px; padding-right:1px; display: none; padding-left: 0px;" onclick="history.back();" id="back_btn">
                                <button class="btn" style=" margin-top:3px; margin-left: 0px; background: none;" id="btn-back">
                                    <img src="<?php // echo Yii::app()->baseUrl             ?>/images/arrows_left_head.png" />
                                    back
                                </button>
                            </a>
                            -->

                            <a id="menu-toggle" href="#" class="navbar-toggle" style="float: left; margin-left: 10px; margin-right: 0px;">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>

                            <a class="navbar-brand" style="padding:2px; padding-right:1px; padding-left: 0px;">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg_takic3.png" id="tak_logo" style="margin-top: 10px; height:35px;"/>
                            </a>

                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li style=" padding-top: 0px;">
                                    <a style=" font-size: 24px; color: #ffff00;">ศูนย์ข้อมูล<?php echo Yii::app()->session['ampurname']; ?></a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <?php if (Yii::app()->session['name'] == '') { ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('Main'); ?>"><span class=" glyphicon glyphicon-home"></span> Home</a>
                                    </li>
                                <?php } ?>

                                <?php if (Yii::app()->session['name'] != '') { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                            <span class=" glyphicon glyphicon-cog"></span> AdminMenu <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo Yii::app()->createUrl('Backoffice/ShowCatalog') ?>"><i class=" fa fa-file-text"></i> จัดการรายงาน</a></li>
                                            <li><a href="<?php echo Yii::app()->createUrl('Sysicon/ShowSysicon') ?>""><i class=" fa fa-meh-o"></i> ไอค่อน</a></li>
                                            <li><a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>"><i class=" fa fa-users"></i> จัดการ User</a></li>
                                            <li><a href="<?php echo Yii::app()->createUrl('Frontend') ?>"><i class=" fa fa-keyboard-o"></i> คีย์ข้อมูล</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>

                                <?php if (Yii::app()->session['name'] == '') { ?>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#myLogin"><span class=" glyphicon glyphicon-lock"></span> Login</a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>"><span class=" glyphicon glyphicon-off"></span> Logout</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>

                <!-- 
                # Navigator
                # Create Kimniyom
                -->
                <?php if (isset(Yii::app()->session['distcode'])) { ?>

                    <ol class="breadcrumb" style=" margin:0px 0px 0px 0px;" id="navigator">
                        <li>
                            <span class=" glyphicon glyphicon-home"></span>
                            <a href="<?php echo Yii::app()->createUrl('Backoffice/ShowCatalog'); ?>">หมวดรายงาน</a>
                        </li>
                        <?php if (Yii::app()->session['navigatorcatalog'] != "") { ?>
                            <li><?php echo Yii::app()->session['navigatorcatalog']; ?></li>
                        <?php } ?>
                        <?php if (Yii::app()->session['navigatorgroupmenu'] != "") { ?>
                            <li class="active" style="color: #cccccc;"><?php echo Yii::app()->session['navigatorgroupmenu']; ?></li>
                        <?php } ?>
                        <?php if (Yii::app()->session['navigatorconfiggroup'] != "") { ?>
                            <li class="active" style="color: #cccccc;"><?php echo Yii::app()->session['navigatorconfiggroup']; ?></li>
                        <?php } ?>
                    </ol>
                <?php } ?>

                <div class="container-fluid" style="padding-top: 10px;">


                    <div class="row">
                        <div class="col-lg-12">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <!-- /#wrapper -->

    </body>
</html>
