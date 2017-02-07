<!--
# Create By Kimniyom
# Filter ชุดแรก => แสดงรายงานแบบ เลือก อำเภอ -> สถานบริการ  
# Filter ชุดที่สอง => ปี พ.ศ.
#
-->
<?php
$filterModel = new Filter();
?>
<script type="text/javascript">
    send_param();
    function send_param() {
        var loading = "<div class='progress'>"
                + "<div class='indeterminate'></div>"
                + "</div>";
        $("#show_report_success").html(loading);
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

        var url = "<?php echo Yii::app()->createUrl($controller) ?>";
        var data = {year: year};
        //alert(data);

        $.post(url, data, function (result) {
            $("#show_report_success").html(result);
        });

    }
</script>

<div id="card-alert" class="card <?php echo $filterModel->filter_bg_color('teal lighten-5') ?>">
    <div class="card-content <?php echo $filterModel->filter_text_color() ?>">
        <div class="row">
            <div class="col s12 m6 l4">
                ปีงบประมาณ
                <label>
                    <?php echo $year; ?>
                </label>
            </div>
        </div>
    </div>
    <div class="card-action <?php echo $filterModel->filter_footer_color('cyan darken-3') ?>" id="pading-footer">
        <a class="btn-flat waves-effect light-blue white-text"
           onclick="send_param();"><i class="mdi-navigation-check left"></i> <?php echo Language::TextFilterSubmitl() ?></a>
    </div>
</div>

<h4>ที่มา : <?php echo $info; ?></h4>

<!-- ส่งนแสดงตาราง -->

        <div id="show_report_success"></div>


<p id="note">
    หมายเหตุ
    <?php echo $note; ?>
</p>


