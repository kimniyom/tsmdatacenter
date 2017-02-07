<!DOCTYPE html>
<!--
    Project : TAK Datacenter Ampur
    Author : Kimniyom
    Update: 2016-07-07
-->
<?php
$Themes = new Themes();
$WEBSITE = SysWebsite::model()->find("id = '1'");
?>
<html>
    <head>
        <title><?php echo Yii::app()->params['appTitle'] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/images/logo_tsm.png">

        <?php
        echo $Themes->AssetsCss();
        echo $Themes->AssetsJs();
        echo $Themes->setColorTables($WEBSITE['headtablecolor'], $WEBSITE['textheadtablecolor'], "000000");
        $path = $Themes->Path();
        //$NewsModel = new News();
        ?>

        <style type="text/css">
            .pink-text{
                font-weight: bold;
            }
            .color-text-menu{
                color: <?php echo $WEBSITE['textsidebarcolor']; ?>;
            }

        </style>
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
                    }).done(function (succ) {
                        //alert(html);
                        if (succ == 'success') {
                            //alert('Login Success');
                            window.location.assign("<?php echo Yii::app()->createUrl('//backend') ?>");
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

            function SetThemes(Themes) {
                var url = "<?php echo Yii::app()->createUrl('Home/Setthemes') ?>";
                var data = {Themes: Themes};
                $.post(url, data, function () {
                    window.location.reload();
                });
            }

            $(document).ready(function () {
                $('.button-collapse-right').sideNav({
                    menuWidth: 300, // Default is 240
                    edge: 'right', // Choose the horizontal origin
                    closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
                });
            });
        </script>
    </head>
    <body>        
        <!-- Start Page Loading 
        <div id="loader-wrapper">
            <div id="loader"></div>        
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        End Page Loading -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START HEADER -->
        <header id="header" class="page-topbar">
            <!-- start header nav-->
            <div class="navbar-fixed">
                <nav class="navbar-color" style="background: <?php echo $WEBSITE['headcolor']; ?>">
                    <div class="nav-wrapper">
                        <ul class="left">                      
                            <li style=" margin: 0px; padding: 0px;">
                                <h1 class="logo-wrapper" style=" margin: 0px; padding: 0px;">
                                    <a href="#" class="brand-logo darken-1" style=" margin-top: 0px; padding-top: 0px;"><img src="<?php echo Yii::app()->baseUrl ?>/uploads/logo/<?php echo $WEBSITE['logo']; ?>" style=" margin: 0px; padding: 0px; width: 150px;" class=" img-responsive"/></a>
                                    <span class="logo-text"></span>
                                </h1>
                            </li>
                        </ul>

                        <div class="header-search-wrapper hide-on-med-and-down">
                            <form method="post" name="formsearch" id="formsearch" action="<?php echo Yii::app()->createUrl('main/search') ?>">
                                <i class="mdi-action-search"></i>
                                <input type="text" id="search" name="search" class="header-search-input z-depth-2" placeholder="ค้นหาด้วยชื่อรายงาน ..." required="required"/>
                            </form>
                        </div>

                        <ul class="right hide-on-med-and-down">
                            <li><a href="<?php echo Yii::app()->createUrl('') ?>" class="waves-effect waves-block waves-light translation-button">
                                    <i class="mdi-action-home"></i>
                                </a>
                            </li>
                            <!--
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown">
                            <?php
                            /*
                              if (Language::getLangValue() != 'EN' || Language::getLangValue() == '') {
                              echo CHtml::image($path . '/themes/materialize/images/flag-icons/Thailand.png', 'Thailand');
                              } else {
                              echo CHtml::image($path . '/themes/materialize/images/flag-icons/United-States.png', 'English');
                              }
                             * 
                             */
                            ?>
                                </a>
                            </li>
                            -->
                            <?php if (Yii::app()->session['name'] != '') { ?>
                                <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="adminmenu-dropdown">
                                        <?php echo CHtml::image(Yii::app()->baseUrl . '/images/settings-icon-orange.png', 'Settings'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                            </li>                       
                            <?php if (empty(Yii::app()->session['name'])) { ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('main/userlogin') ?>" data-toggle="modal" data-target="#myLogin" class="waves-effect waves-block waves-light">
                                        <i class="mdi-action-lock-outline"></i>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                        <!-- translation-button -->
                        <!--
                        <ul id="translation-dropdown" class="dropdown-content">
                            <li>
                                <a href="#!" onclick="Setlanguage('TH')">
                                    <?//php echo CHtml::image($path . '/themes/materialize/images/flag-icons/Thailand.png', 'Thailand'); ?>
                                    <span class="language-select">Thailand</span></a>
                            </li>
                            <li>
                                <a href="#!" onclick="Setlanguage('EN')">
                                    <?//php echo CHtml::image($path . '/themes/materialize/images/flag-icons/United-States.png', 'English'); ?>
                                    <span class="language-select">English</span></a>
                            </li>
                        </ul>
                        -->




                        <!-- adminmenu-button -->
                        <ul id="adminmenu-dropdown" class="dropdown-content">
                            <li><a href="<?php echo Yii::app()->createUrl('backoffice/showgroupreport') ?>"><i class=" fa fa-file-text"></i> จัดการรายงาน</a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('Sysitems') ?>"><i class=" fa fa-file"></i> สร้างรายงาน</a></li>
                            <?php if (Yii::app()->session['distcode'] == '6300') { ?>
                                <li><a href="<?php echo Yii::app()->createUrl('Sysicon/ShowSysicon') ?>"><i class=" fa fa-meh-o"></i> ไอค่อน</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>"><i class=" fa fa-users"></i> จัดการ User</a></li>
                            <?php } ?>
                            <li><a href="<?php echo Yii::app()->createUrl('Frontend') ?>"><i class=" fa fa-keyboard-o"></i> คีย์ข้อมูล</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>" class="waves-effect waves-block waves-light translation-button">ออกจากระบบ</a>
                            </li>
                        </ul> 


                        <!-- Dropdown Structure -->
                        <ul id='dropdown1' class='dropdown-content'>
                            <?php if (Yii::app()->session['name'] != '') { ?>
                                <li><a href="<?php echo Yii::app()->createUrl('backoffice/showgroupreport') ?>"><i class=" fa fa-file-text"></i> จัดการรายงาน</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('Sysitems') ?>"><i class=" fa fa-file"></i> สร้างรายงาน</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('Sysicon/ShowSysicon') ?>"><i class=" fa fa-meh-o"></i> ไอค่อน</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>"><i class=" fa fa-users"></i> จัดการ User</a></li>
                                <li><a href="<?php echo Yii::app()->createUrl('Frontend') ?>"><i class=" fa fa-keyboard-o"></i> คีย์ข้อมูล</a></li>
                            <?php } ?>
                            <!--
                        <li>
                            <a href="#!" onclick="Setlanguage('TH')">
                                <?//php echo CHtml::image($path . '/themes/materialize/images/flag-icons/Thailand.png', 'Thailand'); ?> <font style="padding-top: 5px; position: absolute;"> TH</font></a>
                        </li>
                        <li>
                            <a href="#!" onclick="Setlanguage('EN')">
                                <?//php echo CHtml::image($path . '/themes/materialize/images/flag-icons/United-States.png', 'English'); ?> <font style="padding-top: 5px; position: absolute;"> EN</font></a>
                        </li>
                            -->
                            <li class="divider"></li>
                            <?php if (Yii::app()->session['name'] != '') { ?>
                                <li class="bold">
                                    <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>" class="waves-effect waves-block waves-light translation-button">ออกจากระบบ</a>
                                </li>
                            <?php } else { ?>
                                <li class="bold">
                                    <a href="#" data-toggle="modal" data-target="#myLogin" class="waves-effect waves-block waves-light"
                                       onclick="popuplogin()">Login
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                </nav>
            </div>
            <!-- end header nav-->
        </header>
        <!-- END HEADER -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START MAIN -->
        <div id="main">
            <!-- START WRAPPER -->
            <div class="wrapper">

                <!-- START LEFT SIDEBAR NAV-->
                <aside id="left-sidebar-nav">
                    <ul id="slide-out" class="side-nav fixed leftside-navigation" style="background: <?php echo $WEBSITE['sidebarcolor']; ?>">
                        <li class="bold active" style=" padding: 5px;">
                            <a href="#" style="color: <?php echo $WEBSITE['textsidebarcolor']; ?>;font-size:22px;"><?php echo Language::TextFilterReport() ?></a>
                        </li>
                        <?php
                        $i = 0;
                        $Groupmodel = new SysReportgroup();
                        $groupreport = $Groupmodel->findgroup();
                        foreach ($groupreport as $rs):
                            $i++;
                            $menu_id = $i;
                            if (Yii::app()->session['menu'] == $i) {
                                $active = "class = 'bold active' style='background:none;' box-shadow:none;";
                                $textmenu = "pink-text";
                            } else {
                                $active = "";
                                $textmenu = "color-text-menu";
                            }

                            if (Language::getLangValue() == 'EN') {
                                $groupnameReport = $rs['name_en'];
                            } else {
                                $groupnameReport = $rs['name'];
                            }
                            ?>
                            <li <?php echo $active ?>>
                                <a href="<?php echo Yii::app()->createUrl('main/Getreportlist', array('groupid' => $rs['id'], 'groupname' => $groupnameReport)); ?>" 
                                   class="waves-effect waves-cyan"
                                   onclick="activemenu('<?php echo $i ?>')">
                                    <img src="<?php echo Yii::app()->baseUrl . "/assets/icon_system/" . $rs['icon'] ?>" width="16"/>
                                    <!--<i class="mdi-action-dashboard yellow-text"></i> --><span class="<?php echo $textmenu ?>"><?php echo $groupnameReport; ?></span></a>
                            </li>
                        <?php endforeach; ?>
                        <li class="divider"></li>
                        <li class="" style=" padding: 10px;">
                            <?php $CountModel = new Counter();?>
                            จำนวนเข้าชมทั้งหมด <span class="badge" style=" color: #ff3300;"><?php echo $CountModel->CountAll()?> ครั้ง</span><br/>
                            จำนวนเข้าชมวันนี้ <span class="badge" style=" color: #ff3300;"><?php echo $CountModel->CountDay()?> ครั้ง</span> 
                        </li>
                        <!--
                        <li class="no-padding">
                            <ul class="collapsible collapsible-accordion">
                                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Layouts</a>
                                    <div class="collapsible-body">
                                        <ul>
                                            <li><a href="layout-fullscreen.html">Full Screen</a>
                                            </li>
                                            <li><a href="layout-horizontal-menu.html">Horizontal Menu</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        -->     
                        <!--
                        <li class="li-hover"><div class="divider"></div></li>
                        <li class="li-hover" style=" margin-bottom: 50px;">
                            <p class="ultra-small margin more-text" style="color: <?//php echo $WEBSITE['textsidebarcolor'] ?>;margin-bottom:0px;">
                                &copy;  IT สสจ.ตาก
                                <img src="<?//php echo Yii::app()->baseUrl ?>/images/map.png" style=" margin: 0px; padding: 0px;" class="responsive-img"/>
                            </p>
                        </li>
                        -->
                    </ul>

                    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only" style=" background: <?php echo $WEBSITE['headcolor'] ?>"><i class="mdi-navigation-menu"></i></a>


                </aside>
                <a href="#" id="hmenu" data-activates='dropdown1' class="button-collapse-right btn-floating btn-medium waves-effect waves-light hide-on-large-only" style=" position: fixed; top: 10px; right: 10px; z-index: 1000; background: <?php echo $WEBSITE['headcolor'] ?>;"><i class="mdi-navigation-menu"></i></a>
                <!-- END LEFT SIDEBAR NAV-->

                <!--
                    Right Side Bar 
                <aside id="right-sidebar-nav">
                    <ul id="slide-out-right" class="side-nav fixed right-aligned">
                        <li class="bold active">
                            <a href="#" class="white-text">sdgkgjdfkgdfkljg</a>
                        </li>
                    </ul>
                    <a href="#" data-activates="slide-out-right" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan darken-2"><i class="mdi-navigation-menu"></i></a>
                </aside>
                -->
                <!-- //////////////////////////////////////////////////////////////////////////// -->

                <!-- START CONTENT -->
                <div class="card" style="margin-top: 0px; border-radius: 0px; padding: 0px; background: <?php echo $WEBSITE['navigatorcolor'] ?>;color:<?php echo $WEBSITE['textnavigatorcolor'] ?>">
                    <div class="container">
                        <?php if (isset($this->breadcrumbs)): ?>
                            <?php
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                            ));
                            ?><!-- breadcrumbs -->
                        <?php endif ?>
                    </div>
                </div>
                <section id="content" class="container">
                    <!--start container-->

                    <?php echo $content ?>

                </section>
                <!-- END CONTENT -->

                <!-- //////////////////////////////////////////////////////////////////////////// -->

            </div>
            <!-- END WRAPPER -->

        </div>
        <!-- END MAIN -->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

    </body>

    <div id="popuplogin" class="modal">
        <div class="modal-content modal-sm">
            <div class="container" style="margin-top:10px; width: 100%; position: relative;">
                <div class="row">

                    <div class="col s12 m12 l12">
                        <center>
                            <img class="responsive-img circle" src="<?php echo Yii::app()->baseUrl ?>/images/photo.png"/><br/>
                            <p class="blue-text">Foreign National <br/>Information Center <br/>Authentication</p>
                        </center>
                        <div class="row">
                            <div class="col s2 m1 l1">
                                <i class="mdi-action-account-circle" style=" margin-top: 15px;"></i>
                            </div>
                            <div class="col s10 m11 l11">
                                <input class="form-control" placeholder="Username" onkeydown="checkEnter1();"id="username" name="username" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s2 m1 l1">
                                <i class="mdi-communication-vpn-key" style=" margin-top: 15px;"></i>
                            </div>
                            <div class="col s10 m11 l11">
                                <input class="form-control" placeholder="Password" onkeydown="checkEnter();" id="password" name="password" type="password" value="">
                            </div>
                        </div>
                        <br/><br/>
                        <center>
                            <button type="button" class="btn green" onclick="checklogin();"><i class="mdi-action-done"></i> ตกลง</button>
                            <button type="button" class="btn red" onclick="cleartext();"><i class="mdi-content-clear"></i> ยกเลิก</button>
                        </center>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".breadcrumb").addClass("breadcrumbs white-text");
            $('#hmenu').dropdown({
                inDuration: 300,
                outDuration: 225,
                constrain_width: false, // Does not change width of dropdown to that of the activator
                hover: false, // Activate on hover
                gutter: 0, // Spacing from edge
                belowOrigin: false, // Displays dropdown below the button
                alignment: 'left' // Displays dropdown with edge aligned to the left of button
            });
        });

        function popuplogin() {
            $("#popuplogin").openModal();
        }

        function popuphidemenu() {
            $("#popuphidemenu").openModal();
        }

        function activemenu(id) {
            var url = "<?php echo Yii::app()->createUrl('site/Activemenu') ?>";
            var data = {menu: id};
            $.post(url, data, function (success) {

            });
        }

        function Setlanguage(lg) {
            var url = "<?php echo Yii::app()->createUrl('main/setlanguage') ?>";
            var data = {lang: lg};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }



    </script>

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
    <!-- Chart -->
    
    <!--
    
    <script src="<?//php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/highcharts.js" type="text/javascript"></script>
    <script src="<?//php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/highcharts-more.js" type="text/javascript"></script>
    <script src="<?//php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/themes/grid-light.js" type="text/javascript"></script>
-->
<script src="<?php echo Yii::app()->baseUrl ?>/assets/Highcharts-5.0.7/code/highcharts.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->baseUrl ?>/assets/Highcharts-5.0.7/code/highcharts-more.js" type="text/javascript"></script>


</html>

