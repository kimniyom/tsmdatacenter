<html>
    <head>
        <meta charset="utf-8"/>

        <script type="text/javascript" language="javascript" class="init">
            $(document).ready(function () {
                var height = "<?php echo Yii::app()->session['screenHeight']; ?>";//ความกว้างของหน้าจอ;//ความสูงของหน้าจอ
                var width = "<?php echo Yii::app()->session['width']; ?>";//ความกว้างของหน้าจอ;
                var heightPersen;// หาเปอร์เซ็นของหน้าจอ
                var heightPersenTotext;// แปลงตัวเลขเป็น Text
                var heightPersenSubStr;// ตัดเอาจำนวนเต็ม
                var heightVal;// ความสูงของหน้าจอ

                //alert("width = " + width + "height = " + height);
                if (width <= 751 && width >= height) {
                    //Config For Mobile : By Kimniyom
                    heightPersen = ((height * 30) / 100);//หา 20 % ของความสูง
                    heightPersenTotext = heightPersen.toString();
                    heightPersenSubStr = heightPersenTotext.slice(0, 3);
                    heightVal = (height - heightPersenSubStr);
                    var styles = {height: heightVal};
                    //alert("1" + heightVal);
                    $("#chart_content").css(styles);
                } else if (width <= 751 && width <= height) {
                    heightPersen = ((height * 50) / 100);//หา 20 % ของความสูง
                    heightPersenTotext = heightPersen.toString();
                    heightPersenSubStr = heightPersenTotext.slice(0, 3);
                    heightVal = (height - heightPersenSubStr);
                    var styles = {height: heightVal};
                    //alert("2" + heightVal);
                    $("#chart_content").css(styles);
                } else {
                    //Config For Desktop : By Kimniyom
                    heightPersen = ((height * 20) / 100);//หา 20 % ของความสูง
                    heightPersenTotext = heightPersen.toString();
                    heightPersenSubStr = heightPersenTotext.slice(0, 3);
                    heightVal = (height - heightPersenSubStr);
                    var styles = {height: heightVal};
                    //alert(heightVal);
                    $("#chart_content").css(styles);
                }

                //alert(heightVal);

            });

        </script>
        <?php
        echo $graph;
        ?>
    </head>
    <body>
        <div class="ContentReport">
            <div id="chart_content" style="overflow: auto">
                <div id="chart1" style=" max-width: 97%;"></div>
                <div id="chart2" style=" max-width: 97%;"></div>
                <div style=" width: 100%; padding:0% 4%; margin-top: 20px;">
                    <?php echo $tables; ?>
                </div>
                
                <div id="chart3" style=" max-width: 97%;"></div>
                <div id="chart4" style=" max-width: 97%;"></div>
                <div id="chart5" style=" max-width: 97%;"></div>
            </div>
        </div>
    </body>
</html>