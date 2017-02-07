<!DOCTYPE html>

<!--
    Project : AEC
    Author : Sittipong Promhan
    Update: 2016-08-01
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
        echo $Themes->setColorTables("ffffff", "000000", "eeeeee");
        $path = $Themes->Path();
        ?>

        <style type="text/css">
            body{
                font-family: thaisanslite;
                font-size: 18px;
            }
            input[type="text"]{
                background: #FFFFFF;
                border: #cccccc solid 1px;
                padding: 0px 5px;
            }

            input[type="password"]{
                background: #FFFFFF;
                border: #cccccc solid 1px;
                padding: 0px 5px;
            }

            select{
                background: #FFFFFF;
                border: #cccccc solid 1px;
                padding: 0px 5px;
            }

            textarea {
                background: #FFFFFF;
                border: #cccccc solid 1px;
                padding: 0px 5px;
                height: 100px;
            }
            #left-sidebar-nav{
                font-family: thaisanslite;
                font-size: 20px;
            }
            label{
                font-size: 18px;
            }
        </style>
    </head>
    <body style=" font-size: 18px;">        
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
                <nav class="navbar-color" style=" background: <?php echo $WEBSITE['headcolor'] ?>">
                    <div class="nav-wrapper">
                        <ul class="left">                      
                            <li>
                                <h1 class="logo-wrapper">
                                    <a href="#" class="brand-logo" style="color: <?php echo $WEBSITE['textheadcolor'] ?>"><?php echo $WEBSITE['name'] ?></a>
                                    <span class="logo-text"><?php echo $WEBSITE['name'] ?></span>
                                </h1>
                            </li>
                        </ul>
                        <!--
                        <div class="header-search-wrapper hide-on-med-and-down">
                            <i class="mdi-action-search"></i>
                            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="ค้นหา ..."/>
                        </div>
                        -->
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#" class="waves-effect waves-block waves-light translation-button">
                                    <i class="mdi-action-home"></i>
                                </a>
                            </li>
                            <!--
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown">
                            <?php
                            /*
                              if (Language::getLangValue() == "EN") {
                              echo CHtml::image($path . '/themes/materialize/images/flag-icons/United-States.png');
                              } else {
                              echo CHtml::image($path . '/themes/materialize/images/flag-icons/Thailand.png');
                              }
                             * 
                             */
                            ?>
                                </a>
                            </li>
                            -->
                            <li>
                                <a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                            </li>                       

                            <?php if (empty(Yii::app()->session['name'])) { ?>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#myLogin" class="waves-effect waves-block waves-light"
                                       onclick="popuplogin()">
                                        <i class="mdi-action-lock-outline"></i>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>" class="waves-effect waves-block waves-light translation-button"><i class="mdi-action-exit-to-app"></i></a>
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
                <aside id="left-sidebar-nav"  style=" z-index: 1;">
                    <ul id="slide-out" class="side-nav fixed leftside-navigation" style=" background: <?php echo $WEBSITE['sidebarcolor'] ?>">
                        <?php if (Yii::app()->session['admin_flag'] == '1') { ?>
                            <li class="active" style=" padding: 5px;">
                                <i class="mdi-action-settings"></i> MENU
                            </li>

                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('Sysicon/ShowSysicon') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-editor-insert-emoticon"></i>Icons</a>
                            </li>
                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('User/ShowUser') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-action-account-circle"></i>Users</a>
                            </li>
                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('Userpriv') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-hardware-security"></i>User Privileges</a>
                            </li>
                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('Sysitems') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-action-list"></i>Report Items</a>
                            </li>
                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('syswebsite') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-image-brush"></i>ตั้งค่าเว็บไซต์</a>
                            </li>
                            <li class="bold">
                                <a href="<?php echo Yii::app()->createUrl('Backoffice/showgroupreport') ?>" style="color:<?php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-av-web"></i>Reports</a>
                            </li>
                            <!--
                            <li class="bold">
                                <a href="<?//php echo Yii::app()->createUrl('news') ?>" style="color:<?//php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-hardware-cast-connected"></i>News</a>
                            </li>
                            <li class="bold">
                                <a href="<?//php echo Yii::app()->createUrl('photo') ?>" style="color:<?//php echo $WEBSITE['textsidebarcolor'] ?>"><i class="mdi-image-photo-library"></i>Photo</a>
                            </li>
                            -->
                        <?php } ?>
                        <li class="active" style=" padding: 5px;">
                            <i class="mdi-hardware-keyboard"></i> บันทึกข้อมูล
                        </li>

                        <?php
                        $i = 0;
                        $reportGroup = new SysReportgroup();
                        $list = $reportGroup->getGroupMenuRecord();
                        foreach ($list as $rs):
                            ?>
                            <li><a href="<?php echo Yii::app()->createUrl('frontend/ReportList', array('groupid' => $rs['id'], 'groupname' => $rs['name' . Language::getLangField()])) ?>">
                                    <img src="<?php echo Yii::app()->baseUrl . "/assets/icon_system/" . $rs['icon'] ?>" width="16"/>
                                    <?php echo $rs['name' . Language::getLangField()] ?></a>
                            </li>
                        <?php endforeach; ?>


                        <!--
                                                <li class="no-padding">
                                                    <ul class="collapsible collapsible-accordion">
                                                        <li class="bold"><a class="collapsible-header waves-effect cyan darken-4 white-text"><i class="mdi-hardware-keyboard"></i>บันทึกข้อมูล</a>
                                                            <div class="collapsible-body cyan darken-4">
                                                                <ul>
                        <?php
                        /*
                          $i = 0;
                          $reportGroup = new SysReportgroup();
                          $list = $reportGroup->getGroupMenuRecord();
                          foreach ($list as $rs):
                          /* $i++;
                          $menu_id = $i;
                          if (Yii::app()->session['menu'] == $i) {
                          $active = "class = 'bold active' style='background:#FFFFFF;' box-shadow:none;";
                          $textmenu = "pink-text";
                          } else {
                          $active = "";
                          $textmenu = "yellow-text";
                          } */
                        /*
                          echo '<li><a class="white-text" id="settext" href="' . Yii::app()->createUrl('frontend/ReportList', array('groupid' => $rs['id'], 'groupname' => $rs['name' . Language::getLangField()])) . '">';
                          echo '<img src="' . Yii::app()->baseUrl . "/assets/icon_system/" . $rs['icon'] . '" width="16"/>';
                          echo '&nbsp;&nbsp;' . $rs['name' . Language::getLangField()] . '</a></li>';
                          endforeach;
                         * 
                         */
                        ?>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>     
                        -->
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

                    </ul>
                    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan darken-2"><i class="mdi-navigation-menu"></i></a>
                </aside>
                <!-- END LEFT SIDEBAR NAV-->

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
                <!-- START CONTENT -->
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
        <div class="modal-content">
            <div class="container" style="margin-top:10px; width: 100%; position: relative;">
                <div class="row">
                    <div class="col s12 m12 l4">
                        <img class="profile-img" src="<?php echo Yii::app()->baseUrl ?>/images/photo.png">
                    </div>
                    <div class="col s12 m12 l8">
                        <h4 class="blue-text">TAK Health Information Center Authentication</h4>
                    </div>
                </div>

                <input class="form-control" placeholder="Username" onkeydown="checkEnter1();"id="username" name="username" type="text">

                <input class="form-control" placeholder="Password" onkeydown="checkEnter();" id="password" name="password" type="password" value="">

            </div>
            <button type="button" class="btn green" onclick="checklogin();"><i class="mdi-action-done"></i> ตกลง</button>
            <button type="button" class="btn red" onclick="cleartext();"><i class="mdi-content-clear"></i> ยกเลิก</button>
        </div>
        <div class="modal-footer teal lighten-4">
            <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">close</a>
        </div>
    </div>

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
    <script src="<?php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/highcharts-more.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->baseUrl ?>/assets/Highcharts-4.1.5/js/themes/grid-light.js" type="text/javascript"></script>

</html>

<script type="text/javascript">
                /*     $(document).ready(function () {
                 $(".breadcrumb").addClass("breadcrumbs white-text");
                 });
                 
                 function popuplogin() {
                 $("#popuplogin").openModal();
                 }
                 
                 function activemenu(id) {
                 var url = "<?php // echo Yii::app()->createUrl('site/Activemenu')                          ?>";
                 var data = {menu: id};
                 $.post(url, data, function (success) {
                 
                 });
                 }*/

                function Setlanguage(lg) {
                    var url = "<?php echo Yii::app()->createUrl('main/setlanguage') ?>";
                    var data = {lang: lg};
                    $.post(url, data, function (success) {
                        window.location.reload();
                    });
                }
</script>

<script lagnuage="javascript">

    function SetThemes(Themes) {
        var url = "<?php echo Yii::app()->createUrl('Home/Setthemes') ?>";
        var data = {Themes: Themes};
        $.post(url, data, function () {
            window.location.reload();
        });
    }

    function Setlanguage(lg) {
        var url = "<?php echo Yii::app()->createUrl('main/setlanguage') ?>";
        var data = {lang: lg};
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
    /*
     $(document).ready(function() {
     
     $("#menu-toggle").click(function(e) {
     e.preventDefault();
     $("#wrapper").toggleClass("toggled");
     });
     
     
     
     $('#myTab a').click(function(e) {
     e.preventDefault();
     $(this).tab('show');
     });
     
     // Add slideDown animation to dropdown
     $('.dropdown').on('show.bs.dropdown', function(e) {
     $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
     });
     
     // Add slideUp animation to dropdown
     $('.dropdown').on('hide.bs.dropdown', function(e) {
     $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
     });
     
     // first show page
     //loadRecordList($("#reportId").val());
     });
     */
    /*
     function openwindow(title, info) {
     $("#show_result").load('table.php');
     $("#info_report").text(info);
     $('#win').slideDown(500).window({
     title: title,
     draggable: true,
     resize: true,
     minimizable: false
     });
     }
     */
    function checkKey(evt, id) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode === 13) {
            var maxBox = $("#countbox").val();
            id += 1;
            if (id > maxBox) {
                $("#recordSave").focus();
            } else {
                $("#val_" + id).focus();
            }
        } else {
            if (charCode !== 46 && charCode !== 45 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                return true;
            }
        }
    }



    function loadRecordList(reportId) {

        //clear form
        //$("#showList").html("");
        var budgetYear = "";
        if ($("#budgetyear").val()) {
            budgetYear = $("#budgetyear").val();
        }

        var period = "0";
        if ($("#period").val()) {
            period = $("#period").val();
        }

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createUrl("/Frontend/RecordList") ?>",
            data: {reportId: reportId, budgetYear: budgetYear, period: period}
        }).done(function (data) {
            //alert(data);
            $("#showList").html(data);
        });

        //$("#loading").modal("hide");
    }


    function recordEdit(reportId, id) {

        //clear form
        $("#showRecordEdit").html("");
        $("#saveButton").html('<button type="button" class="btn waves-effect waves-light green" id="recordSave" onclick="recordSave();">บันทึก</button>&nbsp; &nbsp; <button type="button" class="btn waves-effect waves-red modal-close">ยกเลิก</button>');

        var budgetYear = "";
        if ($("#budgetyear").val()) {
            budgetYear = $("#budgetyear").val();
        }

        var period = "0";
        if ($("#period").val()) {
            period = $("#period").val();
        }

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->createUrl("/Frontend/RecordEdit") ?>",
            data: {reportId: reportId, budgetYear: budgetYear, period: period, id: id}
        }).done(function (data) {
            //alert(data);
            $("#showRecordEdit").html(data);
            $('#recordEdit').openModal('show');
        }).fail(function (x, e) {
            alert("มีข้อผิดพลาด!!!");
        });


    }

    $('#recordEdit').on('shown.bs.modal', function () {
        $('#val_1').focus();
    });

    function recordSave() {
        $("#saveButton").html("<img src='<?php echo Yii::app()->baseUrl; ?>/images/ajax-loader.gif'>&nbsp;กำลังบันทึกข้อมูล โปรดรอสักครู่...");
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Frontend/RecordSave") ?>',
            data: $("#formRecordEdit").serialize(),
            type: 'POST',
            success: function () {
                loadRecordList($("#reportId").val());
            }
        });

        $('#recordEdit').closeModal();
    }

</script>   