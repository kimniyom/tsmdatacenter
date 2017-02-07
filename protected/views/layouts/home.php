<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TAK Health Information System</title>
        <meta charset="UTF-8">
        <META NAME="keyword" content="TAKIS,takis,thic,Tak Health Information System,datacenter,ศูนย์ข้อมูล"/>
        <META NAME="description" content="ศูนย์ข้อมูล สำนักงานสาธารณสุข จังหวัดตาก"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/css/bootstrap-cosmo.css">
        <!--<link rel="stylesheet" href="assets/bootstrap3/css/bootstrap-theme.min.css">-->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/fonts/glyphicons-halflings-regular.svg">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/icon/css/font-awesome.min.css" rel="stylesheet">
        <!-- SideBar -->
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sidebar.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ampur.css">

        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/animation.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/fonts/THCharmofAU/fonts/th_charm_of_au.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/bootstrap/js/bootstrap.min.js"></script>

        <style type="text/css">
            body{ background: url('../images/bg-main-ap.png') #e5e5e5 top fixed; background-repeat: repeat-x;}
            #animation_effect{
                visibility: hidden;
                width: 100%;
            }

            /* unvisited link */
            a:link {
                color: #FFFFFF;
                text-decoration: none;
            }

            /* visited link */
            a:visited {
                color: #FFFFFF;
                text-decoration: none;
            }

            /* mouse over link */
            a:hover {
                color: #FFFFFF;
                text-decoration: none;
            }

            /* selected link */
            a:active {
                color: #FFFFFF;
                text-decoration: none;
            }
            /* 
             #province{
                 font-size: 26px;
             }
            */

            h3{
                font-family: 'THCharmofAU', serif;
            }
            h4{
                font-family: 'THCharmofAU', serif;
            }
            h5{
                font-family: 'THCharmofAU', serif;
            }

            #sub_menu{
                font-family: 'THCharmofAU', serif;
            }

            /* Large devices (large desktops, 1200px and up) */
            @media (min-width: 1200px) {
                h3{
                    font-size: 36px;
                }
                h4{
                    font-size: 18px;
                }
                h5{
                    font-size: 16px;
                }
                #province{
                    font-size: 26px;
                }

                #amphur{
                    font-size: 16px;
                }
            }

            /* Medium devices (desktops, 992px and up) */
            /* Small devices (tablets, 768px and up) */
            @media (min-width: 768px) and (max-width: 1199px) {
                h3{
                    font-size: 18px;
                }
                h4{
                    font-size: 18px;
                }
                h5{
                    font-size: 16px;
                } 
                #province{
                    font-size: 16px;
                }

                #amphur{
                    font-size: 16px;
                }
            }

            /* Extra small devices (ipad) */
            @media (min-width: 640px) and (max-width: 767px) {
                h3{
                    font-size: 40px;
                }
                h4{
                    font-size: 36px;
                }
                h5{
                    font-size: 36px;
                }
                #province{
                    font-size: 26px;
                }

                #amphur{
                    font-size: 26px;
                }
            }



            /* 
           @media (min-width: 480px) and (max-width: 639px) {
               h3{
                   font-size: 24px;
               }
               h4{
                   font-size: 22px;
               }
               h5{
                   font-size: 20px;
               }
                #province{
                   font-size: 20px;
               }
               
               #amphur{
                   font-size: 20px;
               }
           }
            */
            /* Extra small devices (phone) */
            @media (max-width: 639px) {
                #animation_effect{ margin-top: 20px;}
                .container{ width: 95%;}
                h3{
                    font-size: 18px;
                }
                h4{
                    font-size: 18px;
                }
                h5{
                    font-size: 16px;
                }

                #province{
                    font-size: 18px;
                }

                #amphur{
                    font-size: 18px;
                }
            }
        </style>

        <!-- Function เก็บขนาดหน้าจอ Device -->
        <script type="text/javascript">
            //เช็คขนาดหน้าจอ 
            $(document).ready(function() {
                var height = $(document).height();//ความสูงของหน้าจอ
                var width = $(document).width();//ความกว้างของหน้าจอ
                var url = "<?php echo Yii::app()->createUrl('main/SetDevice') ?>";
                var data = {screenWidth: width, screenHeight: height};
                $.post(url, data, function() {
                    //alert("<? //php echo Yii::app()->session['screenHeight']          ?>");
                });

                $("[rel='tooltip']").tooltip();
                if (width > '639') {
                    $("#logobuttom").show();
                    $("#logotop").hide();
                    $('.thumbnail').hover(
                            function() {
                                $(this).find('.caption').slideDown(250); //.fadeIn(250)
                            },
                            function() {
                                $(this).find('.caption').slideUp(250); //.fadeOut(205)
                            }
                    );
                } else {
                    $("#logotop").show();
                    $("#logobuttom").hide();
                }
            });
        </script>


        <script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
                var height = "<?php echo Yii::app()->session['screenHeight']; ?>";//ความกว้างของหน้าจอ;//ความสูงของหน้าจอ
                var width = "<?php echo Yii::app()->session['width']; ?>";//ความกว้างของหน้าจอ;

                if (width < height) {
                    $("#animation_effect").css({"margin-top": "20px"});
                    $(".container").css({"width": "95%"});
                }

            });

            function SetThemes(Themes) {
                var url = "<?php echo Yii::app()->createUrl('Home/Setthemes') ?>";
                var data = {Themes: Themes};
                $.post(url, data, function() {
                    window.location.reload();
                });
            }

        </script>

        <!-- เริ่มต้น Code แสดง วัน/เวลา -->
        <script type="text/javascript">
            var currenttime = '<?php echo date("Y-m-d H:i:s"); ?>'; //PHP method of getting server date
            var montharray = new Array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            var serverdate = new Date(currenttime);

            function padlength(what) {
                var output = (what.toString().length == 1) ? "0" + what : what;
                return output;
            }

            function displaytime() {
                serverdate.setSeconds(serverdate.getSeconds() + 1)
                var datestring = padlength(serverdate.getDate()) + " " + montharray[serverdate.getMonth()] + " " + (serverdate.getFullYear() + 543)
                var timestring = padlength(serverdate.getHours()) + ":" + padlength(serverdate.getMinutes()) + ":" + padlength(serverdate.getSeconds())
                document.getElementById("servertime").innerHTML = datestring + " , " + timestring;
            }

            window.onload = function() {
                setInterval("displaytime()", 1000);
            }

        </script>

    </head>
    <body>
        <!--<div id="_bgimg">-->
        <div id="animation_effect" class="fadeIn">
            <div class="container">
                <div class="row">

                    <div class="col-lg-9 col-sm-8 col-8" id="logotop">
                        <div class="thumbnail" style=" box-shadow: none; background: none;">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/BannerNew.png"/>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6300', 'ampurname' => 'จังหวัดตาก')) ?>">
                                <div class="caption">
                                    <h3>ธรรมชาติน่ายล ภูมิพลเขื่อนใหญ่ <BR/><BR/>พระเจ้าตากเกรียงไกร เมืองไม้และป่างาม</h3>
                                </div>    

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/tak.jpg"/>
                                    </div>
                                </div>
                            </a>
                            <div id="sub_menu"><div id="province">ศูนย์ข้อมูลสาธารณสุข จังหวัดตาก</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6301', 'ampurname' => 'อำเภอเมือง')) ?>">
                                <div class="caption">
                                    <h4>เมืองพระเจ้าตาก ต้นกระบากใหญ่<BR/><BR/> รวมชาวเขาเผ่าไทย ประทับใจริมปิง</h4>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/mung.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอเมืองตาก</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">

                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6302', 'ampurname' => 'อำเภอบ้านตาก')) ?>">
                                <div class="caption">
                                    <h5>พระบรมธาตุศักดิ์สิทธิ์ หินแกรนิตลือเลื่อง <BR/><BR/>รอยรุ่งเรืองเมืองตาก ซากไม้กลายเป็นหิน <BR/><BR/>เยือนถิ่นยุทธหัตถี รวมสองนทีปิง-วัง<BR/><BR/> เห็ดโคนดังที่บ้านตาก</h5>
                                </div>


                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Bantak2.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอบ้านตาก</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6303', 'ampurname' => 'อำเภอสามเงา')) ?>">
                                <div class="caption">
                                    <h5>พระธาตุลอยศักดิ์สิทธิ์ อิทธิฤทธิ์ผาสามเงา <BR/><BR/> ขุนเขาเสียดฟ้า ตระการตาเขื่อนภูมิพล<BR/><BR/> ยลพระธาตุแก่งสร้อย ดอยพระบาทเขาหนาม<BR/><BR/> ลือนามลำใย กล้วยไข่เลิศรส</h5>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Samngoung.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอสามเงา</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6304', 'ampurname' => 'อำเภอแม่ระมาด')) ?>">
                                <div class="caption">
                                    <h5>พระพุทธรูปหินอ่อนงามซึ้ง กล้วยอบน้ำผึ้งรสดี <BR/><BR/>ประเพณีขึ้นธาตุ อุทยานแห่งชาติขุนพะวอ<BR/><BR/> แหล่งผ้าทอชาวกะเหรี่ยง</h5>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Maelamad.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอแม่ระมาด</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6305', 'ampurname' => 'อำเภอท่าสองยาง')) ?>">
                                <div class="caption">
                                    <h4>เมืองหมอกงามล้ำ <BR/><BR/> ถ้ำแสนวิจิตร<BR/><BR/> ชีวิตชาวดอย</h4>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Tasongyang2.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอท่าสองยาง</div></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6306', 'ampurname' => 'อำเภอแม่สอด')) ?>">
                                <div class="caption">
                                    <h4>เจ้าพ่อพะวอองค์อาจ ธรรมชาติแสนสวย <BR/><BR/>ร่ำรวยอัญมณี ชมของดีริมเมย</h4>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Pawoa_Maesod3.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอแม่สอด</div></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-4 col-6">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6307', 'ampurname' => 'อำเภอพบพระ')) ?>">
                                <div class="caption">
                                    <h4>เมืองสนสองใบ ศิวิไลซ์น้ำตก <BR/><BR/>พืชผลดกการเกษตร งามเนตรบ่อน้ำร้อน <BR/><BR/>น่าผักผ่อนอากาศดี มากมีชาวเขา</h4>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Phobphra.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอพบพระ</div></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6308', 'ampurname' => 'อำเภออุ้มผาง')) ?>">
                                <div class="caption">
                                    <h5>แมกไม้เขียวสด ดอยหัวหมดชี่นชู<BR/><BR/>ทีลอซูงามล้ำ ตระหง่านง้ำลอยฟ้า<BR/><BR/> ล่องธาราชมไพร ชายแดนไทยอุ้มผาง</h5>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/Umphang.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภออุ้มผาง</div></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6309', 'ampurname' => 'อำเภอวังเจ้า')) ?>">
                                <div class="caption">
                                    <h5>ประตูสู่เมืองตาก หลายหลากวัฒนธรรม<BR/><BR/> นำเศรษฐกิจข้าวโพดลำไย <BR/><BR/> น้ำตกสวยใสโป่งเป้า คลองวังเจ้าอุทยาน <BR/><BR/> สวยตระการผ้าทอ</h5>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/WongJao.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูล อำเภอวังเจ้า</div></div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-4 col-4">
                        <div class="thumbnail">
                            <a href="<?php echo Yii::app()->createUrl('main/menu', array('distId' => '6310', 'ampurname' => 'BORDER HEALTH')) ?>">
                                <div class="caption">
                                    <h5>ศูนย์ข้อมูลสาธารณสุขต่างชาติ<BR/><BR/>5 อำเภอชายแดน<BR/><BR/> ไทย - เมียนมาร์ จังหวัดตาก</h5>
                                </div>

                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/border.jpg"/>
                            </a>
                            <div id="sub_menu"><div id="amphur">ศูนย์ข้อมูลสาธารณสุขต่างชาติ 5 อำเภอชายแดน</div></div>
                        </div>
                    </div>

                    <!-- 
                    style="background:url('<//?php echo Yii::app()->baseUrl; ?>/images/Background_Banner.png');"
                    -->
                    <div class="col-lg-6 col-sm-4 col-4" id="logobuttom" style=" background: none; text-align: center;">
                        <div class="thumbnail" style=" background: none; border: none; padding-top: 10px; box-shadow: none;">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/BannerNew.png"/>
                            <span id="servertime" style=" font-size: 40px; color: #000; text-align: center;"></span>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!--</div>-->
    </body>
</html>
