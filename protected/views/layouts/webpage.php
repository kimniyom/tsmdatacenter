<!DOCTYPE html>
<!--
    Project : TAK Datacenter Ampur
    Author : Kimniyom
    Update: 2016-07-07
-->
<?php
$Themes = new Themes();
?>
<html>
    <head>
        <title><?php echo Yii::app()->params['appTitle'] ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl ?>/images/icon-tak.png">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/materialize/css/materialize.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/themes/materialize/js/plugins/data-tables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/css/card.css">

        <!-- Font Thai -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/css/font-th.css">
        <!-- Images Hover -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/assets/image-hover-effects/css/hover-effects.css">

        <!-- Compiled and minified JavaScript -->
        <script src="<?php echo Yii::app()->baseUrl ?>/themes/materialize/js/plugins/jquery-1.11.2.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl ?>/themes/materialize/js/materialize.js"></script>
        <script src="<?php echo Yii::app()->baseUrl ?>/themes/materialize/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>

        <!-- fancybox -->
        <link rel="stylesheet" href="<?php echo Yii::app()->baseUrl ?>/assets/fancyBox2.1.5/source/jquery.fancybox.css" media="screen">
        <script src="<?php echo Yii::app()->baseUrl ?>/assets/fancyBox2.1.5/source/jquery.fancybox.js"></script>
        <?php
        //echo $Themes->AssetsCss();
        //echo $Themes->AssetsJs();
        //echo $Themes->setColorTables("ffffff", "000000", "eeeeee");
        $path = $Themes->Path();
        $NewsModel = new News();
        $AlbumModel = new Album();
        ?>

        <style type="text/css">
            .parallax-container {
                height: 350px;
            }
            body{
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,e5e5e5+100;White+3D */
                /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,f6f6f6+78,ededed+100;White+3D+%231 */
                background: #ffffff; /* Old browsers */
                background: -moz-linear-gradient(top,  #ededed 0%, #ffffff 78%, #ededed 100%); /* FF3.6-15 */
                background: -webkit-linear-gradient(top,  #ededed 0%,#ffffff 78%,#ededed 100%); /* Chrome10-25,Safari5.1-6 */
                background: linear-gradient(to bottom,  #ededed 0%,#ffffff 78%,#ededed 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ededed', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
            }
        </style>
    </head>
    <body>        

        <div class="navbar-fixed">
            <nav class="white">
                <div class="container">
                    <div class="nav-wrapper green-text">
                        <a href="#!" class="brand-logo green-text" id="webtitle"><?php echo Yii::app()->params['appTitle'] ?></a>

                        <a href="#" data-activates="mobile-demo" class="button-collapse  waves-light hide-on-large-only cyan darken-2"><i class="mdi-navigation-menu"></i></a>
                        <ul class="side-nav" id="mobile-demo">
                            <li><a href="<?php echo Yii::app()->createUrl('main/index') ?>" class="green-text">รายงาน</a></li>
                        </ul>

                        <ul class="right hide-on-med-and-down green-text">
                            <li style=" padding-top: 10px;"><a href="">
                                    <?php
                                    /*
                                      if (Language::getLangValue() != 'EN' || Language::getLangValue() == '') {
                                      echo CHtml::image($path . '/themes/materialize/images/flag-icons/Thailand.png', 'Thailand');
                                      } else {
                                      echo CHtml::image($path . '/themes/materialize/images/flag-icons/United-States.png', 'English');
                                      }
                                     * 
                                     */
                                    ?></a>
                            </li>
                            <li><a href="<?php echo Yii::app()->createUrl('main/index') ?>" class="green-text">รายงาน</a></li>
                        </ul>



                    </div>
                </div>
            </nav>
        </div>

        <div id="index-banner" class="parallax-container">
            <div class="section no-pad-bot">
                <!--
                <div class="container">
                    <br><br>
                    <h1 class="header center teal-text text-lighten-2">Parallax Template</h1>
                    <div class="row center">
                        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
                    </div>
                    <div class="row center">
                        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
                    </div>
                    <br><br>

                </div>
                -->
            </div>
            <div class="parallax"><img src="<?php echo Yii::app()->baseUrl; ?>/images/bgaec.jpg"/></div>
        </div>


        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <?php if (!empty($this->breadcrumbs)): ?>
            <div class="card" style="margin-top: 0px; border-radius: 0px; padding: 10px;">
                <div class="container">
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?><!-- breadcrumbs -->
                </div>
            </div>
        <?php endif ?>


        <div class="container" style=" margin-top: 20px;">
            <!--start container-->
            <?php echo $content ?>
            <!-- END CONTENT -->
        </div>

        <footer class="page-footer green darken-3">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">ศูนย์ข้อมูลสุขภาพประชากรต่างชาติ</h5>
                        <p class="grey-text text-lighten-4">Tak Health Information for Migrants </p>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">เว็บลิงค์</h5>
                        <ul>
                            <li><a class="white-text" href="#!">ศูนย์ข้อมมูลสาธารณสุขจังหวัดตาก</a></li>
                            <li><a class="white-text" href="#!">สำนักงานสาธารณสุขจังหวัดตาก</a></li>
                        </ul>
                    </div>
                    
                    <div class="col l3 s12">
                        <h5 class="white-textm green darken-3">.</h5>
                        <ul>
                           <li><a class="white-text" href="#!">Takis</a></li>
                            <li><a class="white-text" href="#!">Tm15</a></li>
                        </ul>
                    </div>
                
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    &copy; <a class="orange-text text-lighten-3">งานเทคโนโลยีสารสนเทศสำนักงานสาธารณสุขจังหวัดตาก</a>
                </div>
            </div>
        </footer>
    </body>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.parallax').parallax();
            $(".button-collapse").sideNav();
        });
        $(document).ready(function () {
            $(".breadcrumb").addClass("breadcrumbs white-text");
        });

        function Setlanguage(lg) {
            var url = "<?php echo Yii::app()->createUrl('main/setlanguage') ?>";
            var data = {lang: lg};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    </script>
</html>

