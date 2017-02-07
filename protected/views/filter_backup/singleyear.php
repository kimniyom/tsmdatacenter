<!--
# Create By Kimniyom
# Filter ชุดแรก => แสดงรายงานแบบ เลือก อำเภอ -> สถานบริการ  
# Filter ชุดที่สอง => ปี พ.ศ.
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
                var yearval = $("#year").val();
                var year = (yearval - 543);
                if (year == '') {
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
                var data = {year: year};
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
            function shownote() {
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

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                ปีงบประมาณ
                                <label>
                                    <?php echo $year; ?>
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
                <?php if ($note != "") { ?>
                    <div class="btn btn-warning" onclick="shownote();" style=" padding: 5px; margin: 4px;">
                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/Notes-icon.png"/>
                        หมายเหตุ <span class="caret"></span>
                    </div><br/>
                    <p><?php echo $note; ?></p>
                <?php } ?>
            </div>
        </div>


    </body>
</html>
