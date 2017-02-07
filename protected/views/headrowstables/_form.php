<?php
/* @var $this HeadrowstablesController */
/* @var $model Headrowstables */
/* @var $form CActiveForm */
?>

<div class="card">
    <div class="card-content">
        <input type="hidden" id="report_id" value="<?php echo $reportid ?>"/>
        <div class="row">
            <div class="col m6 l6">
               จำนวนแถวของตาราง
                <select id="rows" class="">
                    <?php for($i = 1;$i<=5;$i++): ?>
                    <option value="<?php echo $i ?>" <?php if($detail['rows'] == $i){ echo "selected";}?>><?php echo $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <button type="button" class="btn green" onclick="Save()">บันทึกข้อมูล</button>
        </div>
    </div>
</div><!-- form -->

<!-- start popup -->
<!-- Modal -->
<div class="modal modal-fixed-footer" id="popup-add-columns">
    <div class="modal-content">
        <h4>เพิ่มช่องตาราง</h4>
        <hr/>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <label>ชื่อไทย</label>
                    <input type="text" id="headname"/>
                </div>
                <div class="row">
                    <label>ชื่ออังกฤษ</label>
                    <input type="text" id="headname_en"/>
                </div>
                <div class="row">
                    <div class="col m6 l6">
                        <label>Colspan</label>
                        <input type="number" id="colspan"/>
                    </div>
                    <div class="col m6 l6">
                        <label>Upper</label>
                        <input type="number" id="upper"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col m6 l6">
                        <label>Rows</label>
                        <input type="number" id="_rows"/>
                    </div>
                    <div class="col m6 l6">
                        <label>Rowsnumber</label>
                        <input type="number" id="rowsnumber"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="save" class="btn blue" onclick="SaveAddColumns();"><i class="mdi-content-save"></i> บันทึกข้อมูล</button>
    </div>
</div>

<div id="result"></div>

<script type="text/javascript">
    Loaddata();
    function Save() {
        var url = "<?php echo Yii::app()->createUrl('headrowstables/save') ?>";
        var report_id = $("#report_id").val();
        var rows = $("#rows").val();
        var data = {report_id: report_id, rows: rows};
        if (rows == '') {
            $("#rows").focus();
            return false;
        }
        $.post(url, data, function (datas) {
            Loaddata();
        });
    }

    function Loaddata() {
        var url = "<?php echo Yii::app()->createUrl('headrowstables/loaddata') ?>";
        var report_id = $("#report_id").val();
        var data = {report_id: report_id};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
        });
    }

    function PopupAddColumns(DefaultRows) {
        $("#popup-add-columns").openModal();
        $("#_rows").val(DefaultRows);
    }

    function SaveAddColumns() {
        var url = "<?php echo Yii::app()->createUrl('headcolumntables/addcolumns') ?>";
        var report_id = $("#report_id").val();
        var headname = $("#headname").val();
        var headname_en = $("#headname_en").val();
        var colspan = $("#colspan").val();
        var rows = $("#_rows").val();
        var rowsnumber = $("#rowsnumber").val();
        var upper = $("#upper").val();
        var data = {
            report_id: report_id,
            headname: headname,
            headname_en: headname_en,
            colspan: colspan,
            rows: rows,
            rowsnumber: rowsnumber,
            upper: upper
        };
        $.post(url, data, function (datas) {
            window.location.reload();
        });
    }
</script>