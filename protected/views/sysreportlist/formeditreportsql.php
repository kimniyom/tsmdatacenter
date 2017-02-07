<?php
$col = new SysItemGroups();
$itemid = $col->getAllByDistCode(Yii::app()->session['distcode']);
//select ข้อมูลในตาราง Sys_row_group ขึ้นมาเพื่อเอามาใส่ใน DropdowsList
$period = new Period();
$periodid = $period->findAll();
?>

<div class="row">
    <div class="col l6 m6">
        <input type="hidden" class="form-control" id="sqlrpid" value="<?php echo $datas['id'] ?>">

        <div class="form-group" style=" margin-right: 10px;">
            ชื่อรายงาน
            <input type="text" class="form-control" id="sqlrpname" onkeydown="checkEnter1();" placeholder="ชื่อรายงาน" value="<?php echo $datas['name'] ?>">
        </div>

        <div class="form-group" style=" margin-right: 10px;">
            แหล่งที่มา
            <input type="text" class="form-control" id="sqlrpsource" onkeydown="checkEnter2();" placeholder="แหล่งที่มาของข้อมูล" value="<?php echo $datas['source'] ?>">   
        </div>

        <div class="form-group">
            หมายเหตุ
            <textarea rows="3" id="sqlrpnote"><?php echo $datas['note'] ?></textarea>
            <!--input type="text" class="form-control" id="rpnote" onkeydown="checkEnter3();"-->   
        </div>


        <div class="form-group" style=" margin-right: 10px;">
            Controller
            <input type="text" class="form-control" id="sqlrpurl" onkeydown="checkEnter4();" value="report/reportgen" readonly="readonly">   
        </div>

        <div class="form-group" id="colid">
            ส่วนหัวตารางข้อมูล
            <select class="browser-default"  id="sqlcolID" onkeydown="checkEnter5();">
                <option value="0" selected>เลือกส่วนหัวตาราง</option>
                <?php
                foreach ($itemid as $col):
                    if ($col['comment']) {
                        $comment = " (" . $col['comment'] . ")";
                    } else {
                        $comment = "";
                    }
                    ?>
                    <option value="<?php echo $col['id']; ?>" <?php
                    if ($col['id'] == $datas['col_group_id']) {
                        echo "selected";
                    }
                    ?>><?php echo $col['id'] . " - " . $col['item_group_name'] . $comment; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            ความถี่ในการบันทึกข้อมูล
            <select class="browser-default" id="sqlperiodID">
                <?php foreach ($periodid as $prrow): ?>
                    <option value="<?php echo $prrow['period_id']; ?>" <?php
                    if ($prrow['period_id'] == $datas['period_id']) {
                        echo "selected";
                    }
                    ?>><?php echo $prrow['period_name']; ?></option>
                        <?php endforeach; ?>
            </select>  
        </div>

        แหล่งข้อมูล
        <select class="browser-default" id="sqlreporttype">
            <option value="Y">จากคำสั่ง sql</option>
        </select>

        <label>KPI *ถ้าไม่นำไปแสดงไม่ต้องเลือกส่วนนี้</label>
        <select class="browser-default" id="sqlkpistatus">
            <option value=""></option>
            <option value="Y" <?php
            if ($datas['kpistatus'] == "Y") {
                echo "selected";
            }
            ?>>ผ่าน</option>
            <option value="N" <?php
            if ($datas['kpistatus'] == "N") {
                echo "selected";
            }
            ?>>ไม่ผ่าน</option>
        </select>
    </div>
    <div class="col l6 m6 card" style=" height: 610px; ">
        <i class="mdi-action-description" ></i>
        คำสั่ง sql
        <textarea  id="sql" style="margin-bottom: 10px; height: 560px; background: #000; color: #ffcc00;"><?php echo $datas['sql'] ?></textarea>
    </div>
</div>

<script type="text/javascript">
//function save ชื่อรายงาน
    function UpdateReportSql() {

        var url = "<?php echo Yii::app()->createUrl('backoffice/updatereportsql') ?>";
        var report_id = $("#sqlrpid").val();
        var rpname = $("#sqlrpname").val();
        var rpsource = $("#sqlrpsource").val(); //id ของ input box
        var rpnote = $("#sqlrpnote").val();
        var rpmenugid = $("#rpmenugid").val();
        var rpcol = $("#sqlcolID").val();
        var rpurl = $("#sqlrpurl").val();
        var rpperiod = $("#sqlperiodID").val();
        var rptype = $("#sqlreporttype").val();
        var rpno = $("#sqlrpno").val();
        var sql = $("#sql").val();
        var kpistatus = $("#sqlkpistatus").val();
        if (rpname == '') {
            $("#sqlrpname").focus();
            return false;
        }

        if (rpno === '') {
            rpno = '99';
        }

        if (sql == '') {
            $("#sql").focus();
            return false;
        }

        if (rpname == '') {
            $("#sqlrpname").focus();
            return false;
        }
        if (rpsource == '') {
            $("#sqlrpsource").focus();
            return false;
        }

        //alert(report_id);
        var data = {
            report_id: report_id,
            rpname: rpname,
            rpsource: rpsource,
            rpnote: rpnote,
            rpmenugid: rpmenugid,
            rpurl: rpurl,
            rpcol: rpcol,
            rpperiod: rpperiod,
            rpno: rpno,
            rptype: rptype,
            sql: sql,
            kpistatus: kpistatus
        }; //ค่าที่ต้องการส่งไปให้กับ controller ในที่นี้ส่งค่าไปกับตัวแปร itemgroup กับ sun
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }

</script>

