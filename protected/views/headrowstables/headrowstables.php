<style type="text/css">
    .demotables table thead tr th{
        border:  #cccccc solid 1px;
        text-align: center;
        white-space: nowrap;
        font-size: 12px;
        font-weight: normal;
    }
</style>
<div class="card" style=" overflow: auto;">
    <div class="card-content">
        <div class="demotables">
            <table class="striped" id="rowstables">
                <thead>
                    <?php
                    $ModelColTable = new Headcolumntables();
                    $headtables = $ModelColTable->findAll("report_id = '$reportid' ");
                    $Rowstables = $ModelColTable->findAll("report_id = '$reportid' AND rows = '1' ");
                    for ($i = 1; $i <= $rows; $i++):
                        ?>
                        <?php if ($i == 1) { ?>
                            <tr>
                                <th rowspan="<?php echo $rows ?>" colspan="0" style="background: #f5f5f5;">
                                    <?php echo $filter['filter_name'] ?>
                                </th>
                                <?php foreach ($Rowstables as $rowsfirst) { ?>
                                    <th rowspan="<?php echo $rowsfirst['rowsnumber'] ?>" colspan="<?php echo $rowsfirst['colspan'] ?>">
                                        <?php echo $rowsfirst['headname'] ?> / <?php echo $rowsfirst['headname_en'] ?> 
                                        <a href="javascript:openformedit('<?php echo $rowsfirst['id'] ?>')" title="แก้ไข"><i class="mdi-editor-border-color orange-text"></i></a>
                                        <span class="green-text">colspan = <?php echo $rowsfirst['colspan'] ?></span>
                                    </th>
                                <?php } ?>
                                <th>
                                    <button type="button" class="btn red" onclick="PopupAddColumns('1')">เพิ่มช่องตาราง</button>
                                </th>
                            </tr>

                        <?php } else { ?>
                            <tr>
                                <?php
                                $RowstablesSub = $ModelColTable->findAll("report_id = '$reportid' AND rows = '$i' ");
                                foreach ($RowstablesSub as $subcal):
                                    ?>
                                    <th rowspan="<?php echo $subcal['rowsnumber'] ?>" colspan="<?php echo $subcal['colspan'] ?>">
                                        <?php echo $subcal['headname'] ?> / <?php echo $subcal['headname_en'] ?>
                                        <a href="javascript:openformedit('<?php echo $subcal['id'] ?>')" title="แก้ไข"><i class="mdi-editor-border-color orange-text"></i></a>
                                        <span class="green-text">colspan = <?php echo $subcal['colspan'] ?></span>
                                    </th>
                                <?php endforeach; ?> 
                            </tr>
                        <?php } ?>
                    <?php endfor; ?>
                </thead>
            </table>
        </div>
    </div>
</div>


<!--
    #Previews
-->

<h4>Preview</h4>
<div class="card" style=" overflow: auto;">
    <div class="card-content">
        <div class="demotables">
            <table class="striped" id="rowstables">
                <thead>
                    <?php
                    /*
                      $ModelColTable = new Headcolumntables();
                      $headtables = $ModelColTable->findAll("report_id = '$reportid' ");
                      $Rowstables = $ModelColTable->findAll("report_id = '$reportid' AND rows = '1' ");
                     * 
                     */
                    for ($i = 1; $i <= $rows; $i++):
                        ?>
                        <?php if ($i == 1) { ?>
                            <tr>
                                <th rowspan="<?php echo $rows ?>" colspan="0" style="background: #f5f5f5;">
                                    <?php echo $filter['filter_name'] ?>
                                </th>
                                <?php foreach ($Rowstables as $rowsfirst) { ?>
                                    <th rowspan="<?php echo $rowsfirst['rowsnumber'] ?>" colspan="<?php echo $rowsfirst['colspan'] ?>">
                                        <?php echo $rowsfirst['headname' . Language::GetLanguageDefault()] ?> 
                                    </th>
                                <?php } ?>
                            </tr>

                        <?php } else { ?>
                            <tr>
                                <?php
                                $RowstablesSub = $ModelColTable->findAll("report_id = '$reportid' AND rows = '$i' ");
                                foreach ($RowstablesSub as $subcal):
                                    ?>
                                    <th rowspan="<?php echo $subcal['rowsnumber'] ?>" colspan="<?php echo $subcal['colspan'] ?>">
                                        <?php echo $subcal['headname' . Language::GetLanguageDefault()] ?>
                                    </th>
                                <?php endforeach; ?> 
                            </tr>
                        <?php } ?>
                    <?php endfor; ?>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- start popup -->
<!-- Modal -->
<div class="modal modal-fixed-footer" id="popupupdate">
    <div class="modal-content">
        <h4>แก้ไขข้อมูลตาราง</h4>
        <hr/>
        <div class="card">
            <div class="card-content" id="formupdate"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="save" class="btn green" onclick="saveColumns();"><i class="mdi-content-save"></i> บันทึก</button>
    </div>
</div>

<script type="text/javascript">
    function openformedit(id) {
        var url = "<?php echo Yii::app()->createUrl('headcolumntables/formupdate') ?>";
        var data = {id: id};
        $.post(url, data, function (datas) {
            $("#formupdate").html(datas);
            $("#popupupdate").openModal();
        });
    }

    function saveColumns() {
        var url = "<?php echo Yii::app()->createUrl('headcolumntables/saveupdate') ?>";
        var id = $("#columnID").val();
        var headname = $("#e_headname").val();
        var headname_en = $("#e_headname_en").val();
        var colspan = $("#e_colspan").val();
        var rows = $("#e_rows").val();
        var rowsnumber = $("#e_rowsnumber").val();
        var upper = $("#e_upper").val();
        var data = {
            id: id,
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


