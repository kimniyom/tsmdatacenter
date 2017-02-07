<!DOCTYPE html>
<!--
    Project : TAK Information Center
    Author : Sittipong Promhan
-->
<html>
    <head>
        <title>TAK Health Information Center</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/css/bootstrap-cosmo.css">
        <!--link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/css/bootstrap-flatly.css"-->
        <!--link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/css/bootstrap.css"-->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link href="<?php echo Yii::app()->baseUrl; ?>/assets/icon/css/font-awesome.min.css" rel="stylesheet">
        <!-- SideBar -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/sidebar.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/animation.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/css/button.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Datatable -->
        <!--link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/css/jquery.dataTables.css">
        <script src="<?php echo Yii::app()->baseUrl; ?>/assets/Datatable/media/js/jquery.dataTables.js"></script-->


    </head>
    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand" style="color: #ff0; background: #165ba8; padding: 0px; height: 51px; text-align: center;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg_takic3.png" style="height: 50px;"/>
                    </li>
                    <li>
                        <nav class="nav-sidebar">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">

                                    <li class="">
                                        <a href="javascript:window.location.reload();" style=" padding: 0px; border:none;">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/tak.jpg" style="width:100%;" id="img_menu"/>
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
                                            <a href="<?php echo Yii::app()->createUrl('Frontend/menuGroup', array("catId" => $rs['id'], "menu_id" => $menu_id, "catalogname" => $rs['name'])); ?>" <?php echo $active; ?>>
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

                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <button type="button" class="navbar-toggle collapsed" id="menu-toggle" style=" float: left; margin-left: 10px;">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <a class="navbar-brand" style="padding:2px; padding-right:1px; padding-left: 0px;">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg_takic3.png" id="tak_logo" style="margin-top: 10px; height:35px;"/>
                            </a>

                        </div>



                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo Yii::app()->baseUrl; ?>"><b>ศูนย์ข้อมูล <?php echo Yii::app()->session['ampurname']; ?></b></a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="<?php echo Yii::app()->baseUrl; ?>"><span class=" glyphicon glyphicon-home"></span> Home</a>
                                </li>
                                <?php if (Yii::app()->session['name'] == '') { ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('User'); ?>"><span class=" glyphicon glyphicon-home"></span> Login</a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?php echo Yii::app()->createUrl('User/logout'); ?>"><span class=" glyphicon glyphicon-off"></span> Logout</a>
                                    </li>
                                <?php } ?>
                                <?php if (Yii::app()->session['name'] == '') { ?>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                            <span class=" glyphicon glyphicon-cog"></span> AdminMenu <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="<?php echo Yii::app()->createUrl('Catalog') ?>"><i class=" fa fa-angle-right"></i> จัดการรายงาน</a></li>
                                            <li><a href="#"><i class=" fa fa-angle-right"></i> จัดรูปแบบกลุ่มรายงาน</a></li>
                                            <li><a href="#"><i class=" fa fa-angle-right"></i> จัดการ User</a></li>
                                        </ul>
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

<script language="JavaScript">
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

        // first show page
        //loadRecordList($("#reportId").val());
    });

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
        $("#saveButton").html('<button type="button" class="btn btn-primary" id="recordSave" onclick="recordSave();">บันทึก</button> <button type="button" class="btn btn-default modal-close">ยกเลิก</button>');

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
            $('#recordEdit').openModal();
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

        $('#recordEdit').modal('hide');
    }

</script>