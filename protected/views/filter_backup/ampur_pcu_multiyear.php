<!--
# Create By Kimniyom
# Filter ชุดแรก => แสดงรายงานแบบ เลือก อำเภอ -> สถานบริการ -> ตำบล เป็นแบบ DroupDown 3 ช่อง 
# Filter ชุดที่สอง => แสดง ระหว่าง [เดือน ปี] ถึง [เดือน ปี] เป็นแบบ DroupDown 4 ช่อง 
#
-->
<html>
    <head>
        <meta charset="utf-8"/>

        <style type="text/css">
            @media (max-width: 768px) {
                .SetfontReport{ font-size: 12px;}
            }
        </style>

        <script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
                var width = "<?php echo Yii::app()->session['width']; ?>";/*ความกว้างของหน้าจอ*/
                var widthVal;
                var widthPersen;
                var widthResult;
                if (width <= 751) {
                    /*Config For Mobile : By Kimniyom*/
                    widthVal = ((width * 25) / 100);/*หา 20 % ของความสูง*/
                    widthPersen = (width - widthVal).toString();
                    widthResult = widthPersen.slice(0, 3);
                    //alert(widthResult);
                    var styles = {
                        "text-overflow": "ellipsis",
                        "overflow": "hidden",
                        "white-space": "nowrap",
                        "width": widthResult
                    };
                    $(".SetfontReport").css(styles);
                }


            });

        </script>

        <script type="text/javascript">
            function send_param() {
                var ampur = sel.amphur.value;
                var monthstart = $("#monthstart").val();
                var monthend = $("#monthend").val();
                var yearstart = $("#yearstart").val();
                var yearend = $("#yearend").val();
                var DistCode = "<?php echo Yii::app()->session['distId']; ?>";
                
                var datestart = (yearstart-543) + monthstart;
                var dateend = (yearend-543) + monthend;
                //alert(ampur + datestart + dateend);
                //alert(monthstart + yearstart + "/" + monthend + yearend);
                if (DistCode != '6300' && ampur == '0') {
                    Ext.Msg.alert({
                        title: 'Warnning',
                        msg: "<center><h4>กรุณาเลือกอำเภอ</h4></center",
                        buttons: Ext.MessageBox.OK
                    });
                    return false;
                }

                if (datestart == '') {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Warnning',
                        msg: "<p style='pading:5px;'>กรุณาเลือกเงือนไขในช่อง * ให้ครบ</p>",
                        buttons: Ext.MessageBox.OK
                    });
                    return false;
                }

                $("#btn_report").addClass('fa fa-spinner fa-spin');
                var url = "<?php echo Yii::app()->createUrl($controller) ?>";
                var data = {distId: ampur,datestart: datestart,dateend: dateend};
                //alert(data);

                $.post(url, data, function(result) {
                    $("#show_report_success").html(result);
                    $("#btn_report").removeClass('fa fa-spinner fa-spin');
                    $("#btn_report").addClass('fa fa-search');
                    $("#filterDialog").modal('hide');
                });

            }

            function show_fillter() {
                $("#filterDialog").modal();
            }

        </script>
        <script language=Javascript>
            function Inint_AJAX() {
                try {
                    return new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                } //IE
                try {
                    return new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                } //IE
                try {
                    return new XMLHttpRequest();
                } catch (e) {
                } //Native Javascript
                alert("XMLHttpRequest not supported");
                return null;
            }
            ;

            function dochange(src, val) {
                var req = Inint_AJAX();
                var filter = "Ampur_pcu_multiyear";
                req.onreadystatechange = function() {
                    if (req.readyState == 4) {
                        if (req.status == 200) {
                            document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                        }
                    }
                };
                req.open("GET", "<?php echo Yii::app()->baseUrl; ?>" + "/index.php?r=report/Filter/" + filter + "&data=" + src + "&val=" + val); //สร้าง connection
                req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
                req.send(null); //ส่งค่า
            }

            function banchange() {
                //document.getElementById('result').innerHTML = sel.amphur.value + ', ' + sel.tumbon.value + ', ' + sel.ban.value;
            }

            window.onLoad = dochange('amphur', '<?php echo Yii::app()->session['distId'] ?>');
            
            function shownote(){
                $("#note").modal();
            }
        </script>

    </head>
    <body>

        <div class="modal fade" id="filterDialog"  tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style=" padding: 10px; text-align: center;">
                        <h4>เงื่อนไขรายงาน</h4>
                    </div>
                    <div class="modal-body" style="padding: 5px; position: relative;">
                        <?php echo "<form name=sel>\n"; ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                อำเภอ
                                <label>
                                    <?php
                                    echo "<font id=amphur><select class='form-control' id=amphur>\n";
                                    echo "<option value='0'>--------------------</option> \n";
                                    echo "</select></font>\n";
                                    ?>
                                </label>
                            </div>
                        </div>
                        <?php echo "</form>\n"; ?>
                        ตั้งแต่
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>
                                    <?php echo $monthstart; ?>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>
                                    <?php echo $yearstart; ?>
                                </label>
                            </div>
                        </div>
                        ถึง
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label>
                                    <?php echo $monthend; ?>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label>
                                    <?php echo $yearend; ?>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12" style=" text-align: center;">
                                <div class="btn btn-info" onclick="send_param();" style=" width: 100%;">
                                    <i class="fa fa-search" id="btn_report"></i> ดูรายงาน
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer" style=" text-align: center;">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </div>

                </div>
            </div>
        </div>

        <div class="panel panel-danger" style=" border: none; background: none; margin-bottom: 0px;">
            <div class="panel-heading" style=" height: 50px;">
                <h4>
                    <div class="SetfontReport" style="float: left;">ที่มา : <?php echo $info; ?></div> 
                    <div class="btn btn-warning" onclick="show_fillter();" style="float: right; padding: 0px 5px;">
                        <i class=" fa fa-th-large"></i>
                    </div>
                </h4>
            </div>
            <div class="panel-body" style="background:#FFF; padding:5px;">
                <!-- ส่งนแสดงตาราง -->
                <div id="show_report_success">
                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/top-icon.png" style=" float: right; top: 0px;" class="floating"/>
                </div>
            </div>
            <div class="panel-footer" style=" background: #e74c3c; color:#FFF;">
                <?php if($note != ""){ ?>
                <div class="btn btn-warning" onclick="shownote();" style=" padding: 5px; margin: 4px;">
                    <img src="<?php echo Yii::app()->baseUrl;?>/images/Notes-icon.png"/>
                    หมายเหตุ <span class="caret"></span>
                </div>
                <?php } ?>
            </div>
        </div>
        
         <div class="modal fade" id="note">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">หมายเหตุ</h4>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $note; ?></p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </body>
</html>
