<!--
# Create By Kimniyom
# Filter ชุดแรก => แสดงรายงานแบบ เลือก อำเภอ   
# Filter ชุดที่สอง => แสดง ปี พ.ศ.
# Filter เลือก ไตรมาสได้
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
        var ampur = sel.amphur.value;
        var yearPs = $("#year").val();
        var year = (yearPs - 543);
        var DistCode = 6300;
        var period = $("#period").val();
        //alert(ampur + year + type);
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

        if (year == '') {
            Ext.Msg.alert({
                //width: 400,
                title: 'Warnning',
                msg: "<p style='pading:5px;'>กรุณาเลือกเงือนไขในช่อง * ให้ครบ</p>",
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

        if (period == '') {
            Ext.Msg.alert({
                title: 'Warnning',
                msg: "<p style='pading:5px;'>กรุณาเลือกไตรมาส</p>",
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

        var url = "<?php echo Yii::app()->createUrl($controller) ?>";
        var data = {distId: ampur, year: year, period: period};
        //alert(data);
        $.post(url, data, function (result) {
            $("#show_report_success").html(result);
        });
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
        var filter = "Ampur_period";
        req.onreadystatechange = function () {
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
    window.onLoad = dochange('amphur', 6300);

</script>

<div id="card-alert" class="card <?php echo $filterModel->filter_bg_color('teal lighten-5') ?>">
    <div class="card-content <?php echo $filterModel->filter_text_color() ?>">
        <div class="row">
            <?php echo "<form name=sel>\n"; ?>

            <div class="col s12 m6 l4">
                <?php echo Language::TextFilterAmphur() ?>
                <label>
                    <?php
                    echo "<font id=amphur><select class='browser-default' id=amphur>\n";
                    echo "<option value='0'>--------------------</option> \n";
                    echo "</select></font>\n";
                    ?>
                </label>
            </div>

            <?php echo "</form>\n"; ?>
            <div class="col s12 m6 l4">
                <?php echo Language::TextFilterPeriod() ?>
                <label>
                    <?php echo $year; ?>
                </label>
            </div>

            <div class="col s12 m6 l4">
                ไตรมาส
                <label>
                    <select id="period" name="period" class="browser-default">
                        <option value="5">ทั้งปี</option>
                        <option value="1">ไตรมาส 1</option>
                        <option value="2">ไตรมาส 2</option>
                        <option value="3">ไตรมาส 3</option>
                        <option value="3">ไตรมาส 4</option>
                    </select>
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


