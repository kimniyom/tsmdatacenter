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
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/sidebar.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Jquery EasyUI
        <link rel="stylesheet" href="<? //php echo Yii::app()->baseUrl;                   ?>/assets/jquery-easyui/themes/black/easyui.css">
        <link rel="stylesheet" href="<? //php echo Yii::app()->baseUrl;                   ?>/assets/jquery-easyui/themes/icon.css">
        <script src="<? //php echo Yii::app()->baseUrl;                   ?>/assets/jquery-easyui/jquery.easyui.min.js"></script>
        -->
        <!-- Datatable -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/css/jquery.dataTables.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/js/jquery.dataTables.js"></script>

        <!-- Extension Datatable -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/Responsive/css/dataTables.responsive.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/Responsive/js/dataTables.responsive.js"></script>

        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/FixedColumns/css/dataTables.fixedColumns.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/extensions/FixedColumns/js/dataTables.fixedColumns.js"></script>

        <!-- ExtJS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/css/ext-all.css"/>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/extjs/ext-all.js"></script>



        <script type="text/javascript">
            $(document).ready(function () {
                $("#menu-toggle").click(function (e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });

                $('#myTab a').click(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });

                // Add slideDown animation to dropdown
                $('.dropdown').on('show.bs.dropdown', function (e) {
                    $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
                });

                // Add slideUp animation to dropdown
                $('.dropdown').on('hide.bs.dropdown', function (e) {
                    $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
                });
                $("#username").focus();

            });

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
                    }).done(function (succ) {
                        //alert(html);
                        if (succ == 'success') {
                            //alert('Login Success');
                            window.location.assign("<?php echo Yii::app()->createUrl('//BackOffice/Index') ?>");
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
            #modal-body { 
                background: url('http://www.mbuisc.ac.th/media-support/image%20backgroud/AbstractBlueBackgroundVectorGraphic1.jpg') no-repeat center center fixed; 
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: auto;
            }
        </style>

    </head>
    <body>
        <!-- Start Modal -->
        <!-- Modal -->
        <div class="modal fade" id="myLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">TAK HDC User Authentication</h4>
                    </div>
                    <div class="modal-body" id="modal-body">
                        <div class="container" style="margin-top:10px">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 col-md-offset-1">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <strong> Login to continue</strong>
                                        </div>
                                        <div class="panel-body">

                                            <fieldset>
                                                <div class="row">
                                                    <div class="center-block">
                                                        <img class="profile-img"
                                                             src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-10  col-md-offset-1 ">
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
                                                        <div class="form-group">
                                                            <button class="btn btn-lg btn-primary btn-block" onclick="checklogin();">เข้าสู่ระบบ</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                        </div>
                                        <div class="panel-footer ">
                                            <!-- Don't have an account! <a href="#" onClick=""> Sign Up Here </a> -->
                                            กรุณาลงชื่อเข้าใช้งานระบบ
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand" style="color: #ff0; background: #165ba8; padding: 0px; height: 60px; text-align: center;">
                        
                    </li>
                    <li>
                        <nav class="nav-sidebar">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                    <li class="">
                                        <a href="javascript:window.location.reload();" style=" padding: 0px; border:none;">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo Yii::app()->session['logo']; ?>" style="width:100%;" id="img_menu"/>
                                        </a>
                                    </li>

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
                                            <a href="<?php echo Yii::app()->createUrl('main/GetSubmenu', array("catalog_id" => $rs['id'], "menu_id" => $menu_id)); ?>" <?php echo $active; ?>>
                                                <span class="glyphicon glyphicon-send"></span> <?php echo $rs['name']; ?> 
                                            </a>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        </nav>
                    </li>

                </ul>

            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->

            <div id="page-content-wrapper" style=" padding: 0px;">
                
                <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style=" //background: #165ba8;">
                    
                </nav>
                
                    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: #165ba8;">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" style="padding:2px; padding-right:1px; padding-left: 0px; background: #165ba8;">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg_takic3.png" style="height: 59px;"/>
                                </a>
                                <a class="navbar-brand" href="#" id="menu-toggle" style=" padding: 2px; padding-left: 5px;">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-navicon fa-stack-1x"></i>
                                    </span>
                                </a>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="#">ศูนย์ข้อมูล<?php echo Yii::app()->session['ampurname']; ?></a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <?php if (Yii::app()->session['name'] != '') { ?>
                                        <li><a href="#"><span class=" glyphicon glyphicon-user"></span><?php echo Yii::app()->session['name']; ?></a></li>
                                        <li><a href="#"><span class="glyphicon glyphicon-leaf"> อำเภอ </span><?php echo Yii::app()->session['distcode']; ?></a></li>
                                    <?php } ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->baseUrl; ?>"><span class=" glyphicon glyphicon-home"></span>Home</a>
                                    </li>

                                    <?php if (Yii::app()->session['name'] != '') { ?>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                                <span class=" glyphicon glyphicon-cog"></span> AdminMenu <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="<?php echo Yii::app()->createUrl('backoffice/show_catalog') ?>"><i class=" fa fa-angle-right"></i> จัดการรายงาน</a></li>
                                                <li><a href="#"><i class=" fa fa-angle-right"></i> จัดรูปแบบกลุ่มรายงาน</a></li>
                                                <li><a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>"><i class=" fa fa-angle-right"></i> จัดการ User</a></li>
                                            </ul>
                                        </li>
                                    <?php } ?>

                                    <?php if (Yii::app()->session['name'] == '') { ?>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#myLogin"><span class=" glyphicon glyphicon-home"></span> Login</a>
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

                    <div class="container-fluid">

                        <ol class="breadcrumb">
                            <li><a href="#"><span class=" glyphicon glyphicon-home"></span> Home</a></li>
                            <li><a href="#">Library</a></li>
                            <li class="active">Data</li>
                        </ol>

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
