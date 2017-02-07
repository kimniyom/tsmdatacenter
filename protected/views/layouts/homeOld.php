<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Datacenter</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            #animation_effect{
                visibility: hidden;
                width: 100%;
            }

        </style>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/css/bootstrap-flatly.css">
        <!--<link rel="stylesheet" href="assets/bootstrap3/css/bootstrap-theme.min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/icon/css/font-awesome.min.css" rel="stylesheet">
        <!-- SideBar -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sidebar.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ampur.css">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animation.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Function เก็บขนาดหน้าจอ Device -->
        <script type="text/javascript">
            //เช็คขนาดหน้าจอ 
            $(document).ready(function() {
                var height = $(document).height();//ความสูงของหน้าจอ
                var width = $(document).width();//ความกว้างของหน้าจอ
                var url = "<?php echo Yii::app()->createUrl('main/SetDevice') ?>";
                var data = {screenWidth: width, screenHeight: height};
                $.post(url, data, function() {
                    //alert("<? //php echo Yii::app()->session['width'] ?>");
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("[rel='tooltip']").tooltip();

                $('.thumbnail').hover(
                        function() {
                            $(this).find('.caption').slideDown(250); //.fadeIn(250)
                        },
                        function() {
                            $(this).find('.caption').slideUp(250); //.fadeOut(205)
                        }
                );
            });
        </script>

    </head>
    <body>
        <div id="_bg">
            <div id="animation_effect" class=" fadeIn">
                <div class="container">
                    <h1 style=" color:#1a6ecc;" id="logo">TAK Information Center</h1>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>short thumbnail description</p>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6300', 'ampurname' => 'จังหวัดตาก')) ?>" class="btn btn-danger">
                                            ศูนย์ข้อมูลจังหวัด
                                        </a>
                                    </p>
                                </div>
                                <div id="carousel-tak" class="carousel slide" data-ride="carousel" data-interval="2000">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <div class="item active">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/tak.jpg"/>
                                        </div>
                                        <div class="item">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/samngaol.jpg"/>
                                        </div>
                                    </div>
                                </div>
                                <div id="sub_menu">ศูนย์ข้อมูลจังหวัดตาก</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6301', 'ampurname' => 'อำเภอเมือง')) ?>" class="btn btn-danger">
                                            อำเภอเมืองตาก
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/mung.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอเมืองตาก</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6302', 'ampurname' => 'อำเภอบ้านตาก')) ?>" class="btn btn-danger">
                                            อำเภอบ้านตาก
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/bantak.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอบ้านตาก</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6303', 'ampurname' => 'อำเภอสามเงา')) ?>" class="btn btn-danger">
                                            อำเภอสามเงา
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/samngaol.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอสามเงา</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6304', 'ampurname' => 'อำเภอแม่ระมาด')) ?>" class="btn btn-danger">
                                            อำเภอแม่ระมาด
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/maeramad.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอแม่ระมาด</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6305', 'ampurname' => 'อำเภอท่าสองยาง')) ?>" class="btn btn-danger">
                                            อำเภอท่าสองยาง
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/tasongyang.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอท่าสองยาง</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6306', 'ampurname' => 'อำเภอแม่สอด')) ?>" class="btn btn-danger">
                                            อำเภอแม่สอด
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/maesod.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอแม่สอด</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-4 col-6">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6307', 'ampurname' => 'อำเภอพบพระ')) ?>" class="btn btn-danger">
                                            อำเภอพบพระ
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/pobpa.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอพบพระ</div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6308', 'ampurname' => 'อำเภออุ้มผาง')) ?>" class="btn btn-danger">
                                            อำเภออุ้มผาง
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/aumpang.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภออุ้มผาง</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-4 col-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h4>Thumbnail Headline</h4>
                                    <p>
                                        <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6309', 'ampurname' => 'อำเภอวังเจ้า')) ?>" class="btn btn-danger">
                                            อำเภอวังเจ้า
                                        </a>
                                    </p>
                                </div>
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/wanggow.jpg"/>
                                <div id="sub_menu">ศูนย์ข้อมูล อำเภอวังเจ้า</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/logo.png" style=" height: 20px;"/>
                    &COPY; 2015 ระบบศูนย์ข้อมูลจังหวัดตาก
                    <font style=" float: right;">สำนักงานสาธารณสุขจังหวัดตาก</font>
                </div>
            </div>
        </div>
    </body>
</html>
