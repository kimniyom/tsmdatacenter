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
        var pcu = sel.pcu.value;
        var startage = $("#startage").val();
        var endage = $("#endage").val();
        var agecolumn = $("#agecolumn").val();
        var year = $("#year").val();
        var DistCode = "6300";

        //alert(ampur + pcu);

        if (DistCode != '6300' && ampur == '0') {
            Ext.Msg.alert({
                title: 'Warnning',
                msg: "<center><h4>กรุณาเลือกอำเภอ</h4></center",
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

        if (startage == '' || endage == '' || agecolumn == '') {
            Ext.Msg.alert({
                //width: 400,
                title: 'Warnning',
                msg: "<p style='pading:5px;'>กรุณาเลือกเงือนไขในช่อง * ให้ครบ</p>",
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

        var url = "<?php echo Yii::app()->createUrl($controller) ?>";
        var data = {distId: ampur, pcu: pcu, startage: startage, endage: endage, agecolumn: agecolumn, year: year};
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

    function dochange(src, val) {
        var req = Inint_AJAX();
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                    //$('.' + src).html(req.responseText);
                }
            }
        };
        req.open("GET", "<?php echo Yii::app()->baseUrl; ?>" + "/index.php?r=report/Filter/FilterflowOne&data=" + src + "&val=" + val); //สร้าง connection
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
        req.send(null); //ส่งค่า
    }

    function banchange() {
        //document.getElementById('result').innerHTML = sel.amphur.value + ', ' + sel.tumbon.value + ', ' + sel.ban.value;
    }


    function shownote() {
        $("#note").modal();
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
                    echo "<font id=amphur><select class='" . $filterModel->classcombo() . "' id=amphur>\n";
                    echo "<option value='0'>--------------------</option> \n";
                    echo "</select></font>\n";
                    ?>
                </label>
            </div>
            <div class="col s12 m6 l4">
                <?php echo Language::TextFilterOffice() ?> 
                <label>
                    <?php
                    echo "<font id=pcu><select class='" . $filterModel->classcombo() . "' id=pcu>\n";
                    echo "<option value='0'>--------------------</option> \n";
                    echo "</select></font>\n";
                    ?>
                </label>
            </div>
            <?php echo "</form>\n"; ?>

            <div class="col s12 m6 l4">
                <?php echo Language::TextFilterYear() ?>
                <label>
                    <?php echo $year; ?>
                </label>
            </div>

            <div class="col s12 m6 l4">
                <?php
                if (Language::getLangValue() == 'EN') {
                    echo "AgeStart";
                } else {
                    echo "อายุเริ่มต้น *";
                }
                ?>

                <label>
                    <select id="startage" class="<?php echo $filterModel->classcombo() ?>">
                        <option value="0">0</option>
                        <?php for ($i = 1; $i <= 100; $i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </div>
            <div class="col s12 m6 l4">
                <?php
                if (Language::getLangValue() == 'EN') {
                    echo "AgeEnd";
                } else {
                    echo "อายุสิ้นสุด *";
                }
                ?>
                <label>
                    <select id="endage" class="<?php echo $filterModel->classcombo() ?>">
                        <option value="120">120</option>
                        <?php for ($i = 1; $i <= 120; $i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </div>
            <div class="col s12 m6 l4">
                <?php
                if (Language::getLangValue() == 'EN') {
                    echo "span of age";
                } else {
                    echo "ช่วงอายุ *";
                }
                ?>

                <label>
                    <select id="agecolumn" class="<?php echo $filterModel->classcombo() ?>">
                        <option value="10">10</option>
                        <?php for ($i = 0; $i <= 100; $i++): ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </div>
        </div>
    </div>
    <div class="card-action <?php echo $filterModel->filter_footer_color('cyan darken-3') ?>" style="padding:5px;">
        <a class="btn-flat waves-effect light-blue white-text"
           onclick="send_param();"><i class="mdi-navigation-check left"></i> <?php echo Language::TextFilterSubmitl() ?></a>
    </div>
</div>

<!-- Show Table -->

<h4><?php echo Language::Source() ?> : <?php echo $info; ?></h4>

<!-- ส่งนแสดงตาราง -->

<div id="show_report_success"></div>

<?php if ($note != "") { ?>
    <p style=" color: red;">
        <?php echo Language::TextFilterNote() ?> : <br/>
        <?php echo $note; ?>
    </p>
<?php } ?>


