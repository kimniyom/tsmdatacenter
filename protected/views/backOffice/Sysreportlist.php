

<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'กลุ่มรายงาน' => array('backoffice/showgroupreport'),
    $groupmenu['name']
);
?>

<style type="text/css">
    #popupreportsql { width: 95% !important ; max-height: 100% !important ; height: 90% !important; overflow-y: hidden !important ; top:-5px; bottom: 20px;}  /* increase the width, height and prevent vertical scroll! However, i don't recommend this, its better to turn on vertical scrolling. */
    #popupeditreportsql { width: 95% !important ; max-height: 100% !important ; height: 90% !important; overflow-y: hidden !important; top:-5px;bottom: 20px;}
    #dialog_add_report{ max-height: 100% !important ; height: 90% !important; overflow-y: hidden !important; top:-5px;bottom: 20px;}
    #popupreportstyle{ width: 95% !important ; max-height: 100% !important ; height: 90% !important; overflow-y: hidden !important; top:-5px;bottom: 20px;}
    label{
        color: #000;
    }
</style>

<div class="card">
    <div class=" card-header  teal lighten-5" style=" padding-left: 20px;">
        <img src="<?php echo Yii::app()->baseUrl; ?>/assets/icon_system/<?php echo $groupmenu['icon'] ?>" width="32"/>
        <font style=" font-size: 35px; font-weight: bold;"><?php echo $groupmenu['name'] ?> </font>
        <font style=" color: #ff3300;">*คลิกที่แถวแล้วลากเพื่อเปลี่ยนลำดับรายงาน</font>
    </div>
    <div class="card-content">

        <!-- Button trigger modal -->
        <button type="button" class="btn waves-effect blue" id="add_report" onclick="setbutton();">
            <span class="mdi-hardware-keyboard"></span> เพิ่มรายงานจากการคีย์
        </button>

        <button type="button" class="btn waves-effect green" id="add43report" onclick="Reporteportsql();">
            <span class="mdi-content-add-circle-outline"></span> เพิ่มรายงานจากคำสั่ง sql
        </button>

        <!-- Result -->
        <!-- แสดงข้อมูลที่ Ajax ดึงมา -->
        <div  id="showList"></div>

    </div>
</div>

<!-- start popup -->
<!-- Modal -->
<div class="modal modal-fixed-footer" id="dialog_add_report">
    <div class=" modal-header white" style=" border-bottom: #999999 solid 1px; padding: 5px; padding-left: 15px;"><h4><div id="hradbar"></div></h4></div>
    <div class="modal-content " style=" padding-bottom: 70px;">

        <input type="hidden" class="form-control" id="rpmenugid" value="<?php echo $menugroup_id; ?>">   
        <div class="form-group has-error" id="reportid">
            <!--label for="rpid">ลำดับที่ของรายงาน</label-->
            <input type="hidden" class="form-control" id="rpid" disabled>
            <input type="hidden" 
                   class="form-control" 
                   id="rpno" 
                   data-toggle="tooltip" 
                   data-placement="top" 
                   title="สามารถแก้ไขลำดับแถวของรายงานได้"> 
        </div>
        <div class="form-group">
            <label for="rpname">ชื่อรายงาน</label>
            <input type="text" class="form-control" id="rpname" onkeydown="checkEnter1();" placeholder="ชื่อรายงาน">
        </div>

        <!--
        <div class="form-group">
            <label for="rpname">ReportName</label>
            <input type="text" class="form-control" id="rpname_en" onkeydown="checkEnter1();" placeholder="ชื่อรายงาน">
        </div>
        -->

        <div class="form-group">
            <label for="rpname">Subtitle</label>
            <input type="text" class="form-control" id="subtitle" onkeydown="checkEnter1();" placeholder="subtitle_th">
        </div>
        <!--
       <div class="form-group">
           <label for="subtitle_en">Subtitle_En</label>
           <input type="text" class="form-control" id="subtitle_en" onkeydown="checkEnter1();" placeholder="subtitle_en">
       </div>
        -->
        <div class="form-group">
            <label for="rpsource">แหล่งที่มา</label>
            <input type="text" class="form-control" id="rpsource" onkeydown="checkEnter2();" placeholder="แหล่งที่มาของข้อมูล">   
        </div>
        <!--
      <div class="form-group">
          <label for="rpsource_en">Sources</label>
          <input type="text" class="form-control" id="rpsource_en" onkeydown="checkEnter2();" placeholder="Sources">   
      </div>
        -->
        <div class="form-group">
            <label for="rpnote">หมายเหตุ</label>
            <textarea rows="5" id="rpnote" ></textarea>
            <!--input type="text" class="form-control" id="rpnote" onkeydown="checkEnter3();"-->   
        </div>
        <!--
               <div class="form-group">
                   <label for="rpnote_en">Note</label>
                   <textarea rows="5" id="rpnote_en" ></textarea>
        <input type="text" class="form-control" id="rpnote" onkeydown="checkEnter3();"/>  
    </div>
        -->
        <div class="form-group">
            <label for="template">template</label>
            <input type="text" class="input-field" id="template">    
            <select id="template43" class="browser-default">
                <!--
                <option value="report/Template43/Template_ampur_tambon_singleyear">อำเภอ => ตำบล มีช่อง ปี พ.ศ.</option>
                <option value="report/Template43/Template_ampur_pcu_singleyear">อำเภอ => สถานบริการ มีช่อง ปี พ.ศ.</option>
                <option value="report/Template43/Template_ampur_pcu_multiyear">อำเภอ => สถานบริการ มีช่อง เดือน ปี เริ่มต้น และสิ้นสุด</option>
                <option value="report/Template43/Templatepopulation">อำเภอ => ตำบล => หมู่บ้าน เลือกดูตามช่วงอายุ</option>
                <option value="report/Template43/Template_ampur_tambon_pcu_singleyear">อำเภอ => ตำบล => สถานบริการ มีช่อง ปี พ.ศ.</option>
                <option value="report/Template43/Template_ampur_selectpcu_singleyear">อำเภอ => เลือกสถานบริการแต่ละที่ มีช่อง ปี งบประมาณ</option>
                <option value="report/Template43/Template_ampur_selectpcur506_singleyear">รายงาน 506</option>
                <option value="report/Template43/Template_singleyear">ปี พ.ศ.</option>
                <option value="report/Template43/Template_ampur_tambon_or_pcu_singleyear">อำเภอ => ดูแบบตำบล หรือ สถานบริการ</option>
                <option value="report/Template43/Template_ampur_term">อำเภอ => เทอม</option>
                <option value="report/Template43/Template_ampur_period">อำเภอ => สถานบริการ ปีงบประมาณ ไตรมาส</option>
                <option value="report/Template43/Template_borderhealth_ampur_pcu_singleyear">5 อำเภอ => สถานบริการ มีช่อง ปี พ.ศ.</option>
                -->
                <?php foreach ($filter as $filters): ?>
                    <option value="<?php echo $filters['filter'] ?>"><?php echo $filters['filter_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div class="form-group">
            <label for="rpurl">Controller</label>
            <input type="text" class="form-control" id="rpurl" onkeydown="checkEnter4();">   
        </div>

        <div class="form-group" id="colid">
            <label for="ColID">ส่วนหัวตารางข้อมูล</label>
            <select class="browser-default"  id="colID" onkeydown="checkEnter5();">
                <option value="0" selected>เลือกส่วนหัวตาราง</option>
                <?php
                foreach ($itemid as $col):
                    if ($col['comment']) {
                        $comment = " (" . $col['comment'] . ")";
                    } else {
                        $comment = "";
                    }
                    ?>
                    <option value="<?php echo $col['id']; ?>"><?php echo $col['id'] . " - " . $col['item_group_name'] . $comment; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group" id="rowid">
            <label for="rowID">ส่วนชุดข้อมูล</label>
            <select class="browser-default"  id="rowID">
                <option value="0" selected>เลือกส่วนแถวของตาราง</option>
                <?php
                foreach ($itemid as $row):
                    if ($row['comment']) {
                        $comments = " (" . $row['comment'] . ")";
                    } else {
                        $comments = "";
                    }
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['id'] . " - " . $row['item_group_name'] . $comments; ?></option>
                <?php endforeach; ?>
            </select>  
        </div>
        <div class="form-group" id="periodid">
            <label for="rowID">ความถี่ในการบันทึกข้อมูล</label>
            <select class="browser-default" id="periodID">
                <option value="0" selected>เลือกความถี่ในการบันทึกข้อมูล</option>
                <?php foreach ($periodid as $prrow): ?>
                    <option value="<?php echo $prrow['period_id']; ?>"><?php echo $prrow['period_name']; ?></option>
                <?php endforeach; ?>
            </select>  
        </div>

        <label>แหล่งข้อมูล</label>
        <select class="browser-default" id="reporttype">
            <option value="Y">ผู้ใช้งานคีย์ข้อมูลเอง</option>
            <option value="N">ดึงข้อมูลจาก 43 แฟ้ม</option>
        </select>
        <div class="checkbox" id="showallgroup">
            <input type="checkbox" id="showall" name="showall" value="1">
            <label for="showall">แสดงรายไตรมาส/เดือน <font color="red"> *กรณีเลือกเป็นรายไตรมาส/เดือน </font></label>
        </div>
        <div class="checkbox" id="showtypegroup">
            <input type="checkbox" id="showtype" name="showtype" value="2">
            <label for="showtype">แสดงรายการทั้งหมด</label>
        </div>
        <div class="checkbox" id="showsumgroup">
            <input type="checkbox" id="showsum" name="showsum" value="1">
            <label for="showsum">แสดงผลรวม</label>
        </div>
        <div class="checkbox" id="checkinputgroup">
            <input type="checkbox" id="checkinput" name="checkinput" value="1">
            <label for="checkinput">ตรวจสอบการบันทึกข้อมูล</label>
        </div>

        <label>KPI *ถ้าไม่นำไปแสดงไม่ต้องเลือกส่วนนี้</label>
        <select class="browser-default" id="kpistatus">
            <option value=""></option>
            <option value="Y">ผ่าน</option>
            <option value="N">ไม่ผ่าน</option>
        </select>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn white grey-text modal-action modal-close">Close</button>&nbsp;
        <button type="button" id="save" class="btn green" onclick="saveReport();"><i class="mdi-content-save"></i> บันทึก</button>&nbsp;
        <button type="button" id="edit" class="btn blue" onclick="editReport();"><i class="mdi-editor-mode-edit"></i> แก้ไข</button>&nbsp;
        <button type="button" id="del" class="btn red" onclick="deleteitem();"><i class="mdi-action-delete"></i> ลบ</button>&nbsp;

    </div>
</div>
<!-- end popup -->



<!-- 
    ### POPUP SQL ### 
-->
<!-- Modal -->
<input type="hidden" class="form-control" id="rpmenugid" value="<?php echo $menugroup_id; ?>">
<div class="modal modal-fixed-footer" id="popupreportsql">
    <div class=" modal-header white" style=" border-bottom: #999999 solid 1px; padding: 5px; padding-left: 15px; height: 50px;">
        <h4 style=" float: left;"><div id="hradbar">รายงานจากชุดคำสั่ง</div></h4>
        <div style=" float: right;">
            <button type="button" class="btn green" onclick="saveReportSql();"><i class="mdi-content-save"></i> บันทึก</button>&nbsp;
            <button type="button" class="btn red modal-action modal-close">Close</button>&nbsp;
        </div>
    </div>
    <div class="modal-content">
        <div class="card-content" id="bodyreportsql"> </div>
    </div>
</div>

<!-- 
    ### POPUP EDIT SQL ### 
-->
<!-- Modal -->
<div class="modal modal-fixed-footer" id="popupeditreportsql">
    <div class=" modal-header white" style=" border-bottom: #999999 solid 1px; padding: 5px; padding-left: 15px; height: 50px;">
        <h4 style=" float: left;"><div id="hradbar">แก้ไขรายงานจากชุดคำสั่ง</div></h4>
        <div style=" float: right;">
            <button type="button" class="btn green" onclick="UpdateReportSql();"><i class="mdi-content-save"></i> บันทึก</button>&nbsp;
            <button type="button" class="btn red modal-action modal-close">Close</button>&nbsp;
        </div>
    </div>
    <div class="modal-content">
        <div class="card-content" id="bodyeditreportsql"></div>
    </div>
</div>


<!-- 
    ### POPUP REPORT STYLE### 
-->
<!-- Modal -->
<div class="modal modal-fixed-footer" id="popupreportstyle">
    <div class=" modal-header white" style=" border-bottom: #999999 solid 1px; padding: 5px; padding-left: 15px; height: 50px;">
        <h4 style=" float: left;"><div id="hradbar">ตัวอย่างรายงาน</div></h4>
        <div style=" float: right;">
            <button type="button" class="btn red modal-action modal-close">Close</button>&nbsp;
        </div>
    </div>
    <div class="modal-content">
        <div class="card-content" id="bodyreportstyle"></div>
    </div>
</div>


<script type="text/javascript">
    function setreportkey() {
        $("#_reporttype select").val("Y");
        $("#dialog_add_report").openModal();
        $("#temlate43").hide();
        $("#temlate").show();
        $("#colorhead").removeClass("modal-header btn-danger");
        $("#colorhead").addClass("modal-header btn-info");

        $("#hradbar").text("จัดการรายงานจากการคีย์");
        $("#colid").show();
        $("#rowid").show();
        $("#periodid").show();
        $("#showallgroup").show();
        $("#showtypegroup").show();
        $("#showsumgroup").show();
        $("#checkinputgroup").show();
    }

    function setreport43() {
        $("#dialog_add_report").openModal();
        $("#_reporttype select").val("N");
        $("#colorhead").removeClass("modal-header btn-info");
        $("#colorhead").addClass("modal-header btn-danger");
        $("#temlate43").show();
        $("#temlate").hide();
        $("#hradbar").text("จัดการรายงานจาก 43 แฟ้ม");
        $("#colid").hide();
        $("#rowid").hide();
        $("#periodid").hide();
        $("#showallgroup").hide();
        $("#showtypegroup").hide();
        $("#showsumgroup").hide();
        $("#checkinputgroup").hide();
    }

    function clear_text() {
        $("#itemgroup").val(''); //id ของ input box เป็นค่าว่าง
        $("#itemsun").val(''); //id ของ input box เป็นค่าว่าง
        $("#save").show();
        $("#edit").hide();
        $("#del").hide();
    }
    function clear_buffer() {
        $("#rpid").val('');
        $("#rpno").val('');
        $("#rpname").val('');
        $("#rpname_en").val('');
        $("#rpsource").val('');
        $("#rpnote").val('');
        $("#rpurl").val('');
        $("#colID").val('0');
        $("#rowID").val('0');
        $("#periodID").val('0');
        $("#showall").prop('checked', false);
        $("#showsum").prop('checked', false);
        $("#checkinput").prop('checked', false);
        $("#colID").prop("disabled", false);
        $("#rowID").prop("disabled", false);
        $("#periodID").prop("disabled", false);
        $("#reporttype").prop("disabled", false);
    }

    function clear_buffer43report() {
        $("#rpid").val('');
        $("#rpno").val('');
        $("#rpname").val('');
        //$("#rpname_en").val('');
        $("#rpsource").val('');
        $("#rpnote").val('');
        $("#rpurl").val('');
    }

    function CheckNum() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            alert('กรุณากรอกข้อมูลเป็นตัวเลข');
        }
    }
    //function save ชื่อรายงาน
    function saveReport() {

        var url = "<?php echo Yii::app()->createUrl('backoffice/savereport') ?>";

        var rpname = $("#rpname").val();
        //var rpname_en = $("#rpname_en").val();

        //var rpname = $("#rpname").val();
        var subtitle = $("#subtitle").val();
        //var subtitle_en = $("#subtitle_en").val();
        var rpsource = $("#rpsource").val(); //id ของ input box
        //var rpsource_en = $("#rpsource_en").val();
        var rpnote = $("#rpnote").val();
        //var rpnote_en = $("#rpnote_en").val();
        var rpmenugid = $("#rpmenugid").val();
        var rpcol = $("#colID").val();
        var rpurl = $("#rpurl").val();
        var rprow = $("#rowID").val();
        var rpperiod = $("#periodID").val();
        var rptype = $("#reporttype").val();
        var rpno = $("#rpno").val();
        var template;

        if (rpname == '') {
            $("#rpname").focus();
            return false;
        }

        /*
         if (rpname_en == '') {
         $("#rpname_en").focus();
         return false;
         }
         */

        if (rptype == "Y") {
            template = $("#template").val();
        } else {
            template = $("#template43").val();
        }

        var showall = 0;
        if ($("#showall").is(':checked')) {
            showall = 1;
        }
        var showtype = 1;
        if ($("#showtype").is(':checked')) {
            showtype = 2;
        }
        var showsum = 0;
        if ($("#showsum").is(':checked')) {
            showsum = 1;
        }
        var checkinput = 0;
        if ($("#checkinput").is(':checked')) {
            checkinput = 1;
        }


        if (rpno === '') {
            rpno = '99';
        }

        var data = {
            rpname: rpname,
            //rpname_en: rpname_en,
            subtitle: subtitle,
            //subtitle_en: subtitle_en,
            rpsource: rpsource,
            //rpsource_en: rpsource_en,
            rpnote: rpnote,
            //rpnote_en: rpnote_en,
            rpmenugid: rpmenugid,
            rpurl: rpurl,
            rpcol: rpcol,
            rprow: rprow,
            rpperiod: rpperiod,
            rpno: rpno,
            rptype: rptype,
            template: template,
            showall: showall,
            showtype: showtype,
            showsum: showsum,
            checkinput: checkinput
        }; //ค่าที่ต้องการส่งไปให้กับ controller ในที่นี้ส่งค่าไปกับตัวแปร itemgroup กับ sun

        if (rpname == '') {
            $("#rpname").focus();
            return false;
        }
        if (rpsource == '') {
            $("#rpsource").focus();
            return false;
        }

        $.post(url, data, function (success) {
            $("#dialog_add_report").closeModal();
            autoload();
            $("#dialog_add_report").closeModal();
        });
    }

    //function แก้ไขข้อมูล
    function editReport() {
        var url = "<?php echo Yii::app()->createUrl('backoffice/editreport') ?>";
        var rpid = $("#rpid").val();
        var rpno = $("#rpno").val();
        var rpname = $("#rpname").val();
        //var rpname_en = $("#rpname_en").val();
        var subtitle = $("#subtitle").val();
        //var subtitle_en = $("#subtitle_en").val();
        var rpsource = $("#rpsource").val();
        //var rpsource_en = $("#rpsource_en").val();
        var rpnote = $("#rpnote").val();
        //var rpnote_en = $("#rpnote_en").val();
        var rpcontroller = $("#rpurl").val();
        var rpcol = $("#colID").val();
        var rprow = $("#rowID").val();
        var rpperiod = $("#periodID").val();
        var rptype = $("#reporttype").val();
        var kpistatus = $("#kpistatus").val();
        var template;
        if (rptype == "Y") {
            template = $("#template").val();
        } else {
            template = $("#template43").val();
        }

        var showall = 0;
        if ($("#showall").is(':checked')) {
            showall = 1;
        }
        var showtype = 1;
        if ($("#showtype").is(':checked')) {
            showtype = 2;
        }
        var showsum = 0;
        if ($("#showsum").is(':checked')) {
            showsum = 1;
        }
        var checkinput = 0;
        if ($("#checkinput").is(':checked')) {
            checkinput = 1;
        }

        //var rpnod = $("#rpno").val();

        var data = {
            rpid: rpid,
            rpno: rpno,
            rpname: rpname,
            //rpname_en: rpname_en,
            subtitle: subtitle,
            //subtitle_en: subtitle_en,
            rpsource: rpsource,
            //rpsource_en: rpsource_en,
            rpnote: rpnote,
            //rpnote_en: rpnote_en,
            rpcontroller: rpcontroller,
            rpcol: rpcol,
            rprow: rprow,
            rpperiod: rpperiod,
            rptype: rptype,
            template: template,
            showall: showall,
            showtype: showtype,
            showsum: showsum,
            checkinput: checkinput,
            kpistatus: kpistatus
        };

        $.post(url, data, function (success) {
            $("#dialog_add_report").closeModal();
            autoload();
            $("#dialog_add_report").closeModal();
        });
    }
    //ฟังก์ชั่นลบ
    function DeleteReportSql(id) {

        //var btn = Ext.Msg.alert({
        //width: 400,
        //    title: 'Save',
        //    msg: 'บันทึกข้อมูลสำเร็จ',
        //    buttons: Ext.MessageBox.OKCANCEL
        //}, showResult);

        Ext.MessageBox.confirm('Delete', 'ต้องการลบรายการใช่หรือไม่ ?', function (btn) {
            if (btn === 'yes') {
                var rpid = id;
                var url = "<?php echo Yii::app()->createUrl('backoffice/deletereport') ?>";
                var data = {rpid: rpid};
                $.post(url, data, function (success) {
                    autoload();
                });
            }
        });
    }

    function deleteitem() {

        //var btn = Ext.Msg.alert({
        //width: 400,
        //    title: 'Save',
        //    msg: 'บันทึกข้อมูลสำเร็จ',
        //    buttons: Ext.MessageBox.OKCANCEL
        //}, showResult);

        Ext.MessageBox.confirm('Delete', 'ต้องการลบรายการใช่หรือไม่ ?', function (btn) {
            if (btn === 'yes') {
                var rpid = $("#rpid").val();
                var url = "<?php echo Yii::app()->createUrl('backoffice/deletereport') ?>";
                var data = {rpid: rpid};
                $.post(url, data, function (success) {

                    //alert("ลบข้อมูลเสร็จเรียบร้อย...");
                    $("#dialog_add_report").closeModal();
                    autoload();
                    $("#dialog_add_report").closeModal();
                });
            } else {
                //some code
            }

        });
    }

    //แสดงข้อมูลในรูปแบบของ DataTable
    $(document).ready(function () {
        autoload();
        $("#save").show();
        $("#edit").hide();
        $("#del").hide();
        $("#controller").show();
        $("#menugroup").hide();
    });
    //Function กำหนดการแสดงปุ่มเมื่อมีการคลิก
    function setbutton() {
        setreportkey();
        clear_buffer();
        $("#save").show();
        $("#edit").hide();
        $("#del").hide();
        $("#template").val("report/template/dynamics");
        $("#rpurl").val("report/dynamics/genreport");// Fix Controller Key
        $("#controller").hide();
        $("#menugroup").hide();
        $("#reportid").show();
        $("#template43").hide();
        $("#template").show();
        //$("#dialog_add_report").openModal();
    }

    //Function กำหนดการแสดงปุ่มเมื่อมีการคลิก
    function setbutton43report() {
        setreport43();
        clear_buffer43report();
        $("#template43").show();
        $("#save").show();
        $("#edit").hide();
        $("#del").hide();
        $("#controller").hide();
        $("#menugroup").hide();
        $("#reportid").show();
        $("#template").val("");
        $("#template").hide();

        //$("#dialog_add_report").openModal();
    }

    //Function แสดงปุ่มและข้อมูลเมื่อมีการคลิก row ใน DataTable
    function Clickrow(rpID, subtitle, source, controller, template, col, row, period, rpno, rpflag, showall, showtype, showsum, checkinput, kpistatus) {
        var url = "<?php echo Yii::app()->createUrl('backoffice/get_detail_report') ?>";
        var report_id = rpID;
        var data = {report_id: report_id};
        var resultFlag = false;
        $.post(url, data, function (data) {
            $("#rpname").val(data.report_name);
            //$("#rpname_en").val(data.name_en);
            $("#rpnote").val(data.note);
            //$("#rpnote_en").val(data.note_en);
            //$("#rpsource_en").val(data.source_en);
            //$("#subtitle_en").val(data.subtitle_en);
            resultFlag = (data.amount > 0);

            if (rpflag == 'Y') {
                setreportkey();
                $("#save").hide();
                $("#edit").show();
                $("#del").show();
                $("#controller").show();
                $("#menugroup").hide();
                $("#reportid").show();
                //ใส่ข้อมูลลงใน Input Box
                $("#rpid").val(rpID);
                $("#rpno").val(rpno);
                $("#subtitle").val(subtitle);
                $("#rpsource").val(source);
                $("#rpurl").val(controller);
                $("#colID").val(col);
                $("#rowID").val(row);
                $("#periodID").val(period);
                $("#reporttype").val(rpflag);
                $("#template").show();
                $("#template").val("report/template/dynamics");
                $("#template43").hide();
                $("#kpistatus").val(kpistatus);
                if (showall == 1)
                    $("#showall").prop('checked', true);
                if (showtype == 2)
                    $("#showtype").prop('checked', true);
                if (showsum == 1)
                    $("#showsum").prop('checked', true);
                if (checkinput == 1)
                    $("#checkinput").prop('checked', true);

                if (resultFlag) {
                    $("#colID").prop("disabled", true);
                    $("#rowID").prop("disabled", true);
                    $("#periodID").prop("disabled", true);
                    $("#reporttype").prop("disabled", true);
                }
            } else {
                setreport43();
                $("#save").hide();
                $("#edit").show();
                $("#del").show();
                $("#controller").show();
                $("#menugroup").hide();
                $("#reportid").show();
                //ใส่ข้อมูลลงใน Input Box
                $("#rpid").val(rpID);
                $("#rpno").val(rpno);
                $("#subtitle").val(subtitle);
                $("#rpsource").val(source);
                $("#rpurl").val(controller);
                $("#colid").hide();
                $("#rowid").hide();
                $("#periodid").hide();
                $("#template43").show();
                $("#template43").val(template);
                $("#reporttype").val(rpflag);
                $("#template").hide();
            }
        }, 'json');
    }

    function checkEnter1() {
        if (window.event.keyCode == '13') {
            $('#rpsource').focus();
        }
    }
    function checkEnter2() {
        if (window.event.keyCode == '13') {
            $('#rpnote').focus();
        }
    }
    function checkEnter3() {
        if (window.event.keyCode == '13') {
            $('#rpurl').focus();
        }
    }
    function checkEnter4() {
        if (window.event.keyCode == '13') {
            $('#colID').focus();
        }
    }
    function checkEnter5() {
        if (window.event.keyCode == '13') {
            $('#rowID').focus();
        }
    }
    function checkEnter6() {
        if (window.event.keyCode == '13') {
            $('#rpurl').focus();
        }
    }

    function checkEnter() {
        if (window.event.keyCode == '13') {
            saveReport();
        }
    }
    //โหลดข้อมูลเมื่อมีการเปืดหน้าเว็บ
    function autoload() {
        //เรียกใช้ Controller
        var url = "<?php echo Yii::app()->createUrl("backoffice/getreportlist") ?>";
        //โยนค่าเข้าไปใน Controller
        var menugroup_id = "<?php echo $menugroup_id; ?>";
        var data = {menugroup_id: menugroup_id};
        //แสดงข้อมูลที่ได้แบบ html ใน id ที่ชื่อ showList
        $.post(url, data, function (success) {
            $("#showList").html(success);
        });
    }

    function update_report() {
        var url = "<?php echo Yii::app()->createUrl('backoffice/update_report') ?>";
        var report_id = $("#report_id").val();
        var shotname = $("#shotname").val();
        var criterion = $("#criterion").val();
        var condition = $("#condition").val();
        var active = $("#active").val();
        var data = {
            report_id: report_id,
            shotname: shotname,
            condition: condition,
            criterion: criterion,
            active: active
        };

        if (shotname == '' || criterion == '' || condition == '') {
            Ext.Msg.alert({
                //width: 400,
                title: 'Wornning',
                msg: 'กรอกข้อมูลไม่ครบ ...',
                buttons: Ext.MessageBox.OK
            });
            return false;
        }

        $.post(url, data, function () {
            autoload();
        });

    }


    function Reporteportsql() {
        $("#popupreportsql").openModal();
        var url = "<?php echo Yii::app()->createUrl('backoffice/formreportsql') ?>";
        $("#bodyreportsql").load(url);
    }

    function Editreportsql(report_id) {
        $("#popupeditreportsql").openModal();
        var url = "<?php echo Yii::app()->createUrl('backoffice/formeditreportsql') ?>";
        var data = {report_id: report_id};
        $.post(url, data, function (datas) {
            $("#bodyeditreportsql").html(datas);
        });
    }

    function ReportStyle(reportid) {
        $("#popupreportstyle").openModal();
        $("#bodyreportstyle").html("<center>Loading ...</center>");
        var url = "<?php echo Yii::app()->createUrl('backoffice/preview') ?>";
        var data = {reportid: reportid};
        $.post(url, data, function (datas) {
            $("#bodyreportstyle").html(datas);
        });

    }

</script>