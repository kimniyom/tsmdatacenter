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
        var ampur = $("#amphur").val();
        var yearval = $("#year").val();
        var year = (yearval - 543);
        //var DistCode = 6300;
//DistCode != '6300' && 
        if (ampur == '0') {
            Ext.Msg.alert({
                title: 'Warnning',
                msg: "<center><h4>กรุณาเลือกอำเภอ</h4></center",
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

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
        var data = {distId: ampur, year: year};
        //alert(data);

        $.post(url, data, function (result) {
            $("#show_report_success").html(result);
        });

    }

</script>

<div id="card-alert" class="card <?php echo $filterModel->filter_bg_color('teal lighten-5') ?>">
    <div class="card-content <?php echo $filterModel->filter_text_color() ?>">
        <div class="row">
            <div class="col m4 l4">
                อำเภอ 
                <label>
                    <?php
                    echo "<font id=amphur><select class='browser-default' id=amphur>\n";
                    echo "<option value='0'>--------------------</option> \n";
                    echo "</select></font>\n";
                    ?>
                </label>
            </div>
            <div class="col m4 l4">
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

<!-- ส่งนแสดงตาราง -->

        <div id="show_report_success"></div>


<p id="note">
    <?php if ($note != "") { ?>
        หมายเหตุ <br/>
        <?php echo $note; ?>
    <?php } ?>
</p>

<script type="text/javascript">
    //window.onLoad = dochange('amphur', 6300);
    dochange('amphur', 6300);

    function dochange(src, val) {
        var url = "<?php echo Yii::app()->createUrl('report/Filter/Ampur_pcu_singleyear') ?>";
        var data = {src: src, val: val};
        $.post(url, data, function (datas) {
            $("#" + src).html(datas);
        });
    }

</script>
