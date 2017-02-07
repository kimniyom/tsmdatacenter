<html>
    <head>
        <meta charset="utf-8"/>
        <style type="text/css">
            #slide {
                position: absolute;
                left: -300px;
                -webkit-animation: slide 0.5s forwards;
                -webkit-animation-delay: 1s;
                animation: slide 1s forwards;
                animation-delay: 0s;
                margin: auto;
            }

            @-webkit-keyframes slide {
                100% { left: 0; }
            }

            @keyframes slide {
                100% { left: 0; }
            }

        </style>

        <?php echo $chart; ?>

        <script type="text/javascript">

            ///$(document).ready(function() {
            //$("#chart_content").html("<center><img src='<? //php echo Yii::app()->baseUrl;    ?>/images/img-loading.gif'/><center>");
            //var url = "<? //php echo Yii::app()->createUrl('Main/Graph_piramit')  ?>";
            //var data = {};
            //$.post(url, data, function(datas) {
            //$("#chart_content").html(datas);
            //});
            //});

        </script>

    </head>
    <body>
        <? //php echo $text; ?>
        <!--
        <img src="<? //php echo Yii::app()->baseUrl                                 ?>/images/selectmenu.png" id="slide"/>
        -->
        <div class="alert alert-warning" style=" border-radius: 0px;">
            <span class="glyphicon glyphicon-dashboard"></span> DashBoard <?php echo "ปีงบประมาณ " . $year; ?>
        </div>
        <!--
        <div class="row" style="margin: 0px;">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><span class=" glyphicon glyphicon-user"></span> ประชากรในเขตพื้นที่</div>
                    <div class="panel-body">
                        <div id="chart_content">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <div class="row" style="margin: 0px; margin-top: 15px;">
            <?php for ($i = 0; $i <= count($chart_content) - 1; $i++) { ?>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading"></div>
                        <div class="panel-body">
                            <div id="<?php echo $chart_content[$i]; ?>"></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>


    </body>
</html>
