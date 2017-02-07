<html>
    <head>
        <meta charset="utf-8"/>
        <style type="text/css">
            #slide {
                position: absolute;
                left: -300px;
                -webkit-animation: slide 0.5s forwards;
                -webkit-animation-delay: 2s;
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
    </head>
    <body>
        <? //php echo $text; ?>
        <img src="<?php echo Yii::app()->baseUrl ?>/images/selectmenu.png" id="slide"/>
    </body>
</html>
