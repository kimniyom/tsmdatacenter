<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <script type="text/javascript">
            function CreateRow(RowID, CatalogId) {
                var url = "<?php echo Yii::app()->createUrl('Backoffice/Combolistreport') ?>";
                var data = {CatalogId: CatalogId};
                $.post(url, data, function(success) {
                    $("#reportList").html(success);
                });

                $("#rowID").val(RowID);
                $("#catalogID").val(CatalogId);
                $("#createrow").modal();
            }

            function SaveRow() {
                var url = "<?php echo Yii::app()->createUrl('Backoffice/Saverow') ?>";
                var template = $("#template").val();
                var rowID = $("#rowID").val();
                var groupID = $("#menuId").val();

                if (groupID == "") {
                    Ext.Msg.alert('แจ้งเตือน', 'ยังไม่ได้เลือกกลุ่มรายงานในหมวดนี้');
                    return false;
                }

                var data = {groupID: groupID, template: template, rowID: rowID};
                $.post(url, data, function(success) {
                    window.location.reload();
                });
            }

            function AddColumn(CatalogId, template, RowID, ColID) {
                var url = "<?php echo Yii::app()->createUrl('Backoffice/Combogroupreport') ?>";
                var data = {CatalogId: CatalogId};

                $.post(url, data, function(success) {
                    $("#ListGroup").html(success);
                });

                $("#rowid").val(RowID);
                $("#colid").val(ColID);
                $("#template").val(template);

                $("#addcolumn").modal();
            }


            function SaveCol() {
                var url = "<?php echo Yii::app()->createUrl('Backoffice/Savecol') ?>";
                var template = $("#template").val();
                var rowID = $("#rowid").val();
                var groupID = $("#menuId").val();
                var colid = $("#colid").val();
                //alert(colid);
                if (groupID == "") {
                    Ext.Msg.alert('แจ้งเตือน', 'ยังไม่ได้เลือกกลุ่มรายงานในหมวดนี้');
                    return false;
                }

                var data = {groupID: groupID, template: template, rowID: rowID, colid: colid};
                $.post(url, data, function(success) {
                    window.location.reload();
                });
            }

            function OrderColumn(CatalogId,RowId,ColTotal){
                //alert(ColTotal);
                $("#OrderGroupReport").modal();
                var url = "<?php echo Yii::app()->createUrl('Backoffice/Ordercolumn')?>";
                var data = {CatalogId:CatalogId,RowId:RowId,ColTotal:ColTotal};
                $.post(url,data,function(success){
                    $("#resultOrderGroupReport").html(success);
                });
            }
            
            function reload(){
                window.location.reload();
            }

        </script>
    </head>
    <body>
        
        <!-- เรียง กลุ่มรายงาน -->
        <!-- Dialog Create Row -->
        <div class="modal fade bs-example-modal-sm" id="OrderGroupReport" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">เรียงแถวใหม่</h4>
                    </div>
                    <div class="modal-body" id="resultOrderGroupReport">

                    </div>
                    <div class="modal-footer" style=" text-align: center;">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class=" glyphicon glyphicon-save" onclick="reload();"> บันทึกข้อมูล</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Dialog Create Row -->
        
        <!-- Dialog Create Row -->
        <div class="modal fade bs-example-modal-sm" id="createrow" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">เพิ่มแถว</h4>
                    </div>
                    <div class="modal-body" id="resultRow">
                        แถวที่
                        <input type="text" id="rowID" readonly="readonly" class="form-control input-sm"/>
                        <input type="hidden" id="catalogID" class="form-control input-sm"/>
                        เลือกกลุ่มรายงาน
                        <div id="reportList"></div>
                    </div>
                    <div class="modal-footer" style=" text-align: center;">
                        <button type="button" class="btn btn-primary btn-sm" onclick="SaveRow();">
                            <span class=" glyphicon glyphicon-save"> บันทึกข้อมูล</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Dialog Create Row -->


        <!-- Dialog Add Column-->
        <div class="modal fade bs-example-modal-sm" id="addcolumn" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">เพิ่มคอลัมน์</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="rowid" readonly="readonly" class="form-control input-sm"/>
                        คอลัมน์ที่ : <input type="text" id="colid" class="form-control input-sm" readonly=""/>
                        <input type="hidden" id="template" class="form-control input-sm"/>
                        เลือกกลุ่มรายงาน
                        <div id="ListGroup"></div>
                    </div>
                    <div class="modal-footer" style=" text-align: center;">
                        <button type="button" class="btn btn-primary btn-sm" onclick="SaveCol();">
                            <span class=" glyphicon glyphicon-save"> บันทึกข้อมูล</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Dialog Create Row -->


        <h4>จัดรูปแบบ <?php echo $CatalogName; ?></h4>
        <table class="table table-striped" style=" background: #FFF;">
            <thead>
                <tr>
                    <th>แถวที่</th>
                    <th>กลุ่มรายงาน</th>
                    <th>รูปแบบ</th>
                    <th>จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $NewRow = 0;
                $i = 0;
                $RGroup = new SysReportgroup();
                foreach ($configtemplate as $rs):
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $rs['rowid']; ?></td>
                        <td>
                            <div class="row">
                                <?php
                                $CountCol = new SysReportmenuTemplate();
                                $ColNumber = $CountCol->Countcolid($rs['template']);
                                $result = $RGroup->getsubcatalog($rs['catalog_id'], $rs['rowid']);
                                $j = 0;
                                $NewCol = 0;

                                foreach ($result as $rss):
                                    $j++;
                                    ?>
                                    <div class="<?php echo $rss['code']; ?>" style="width:auto; margin:2px; padding:3px;" id="<?php echo $rss['color']; ?>">
                                        <?php echo $rss['name']; ?>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </td>
                        <td><?php echo "รูปแบบที่ " . $rs['template'] . '  ใน 1 แถวมี ' . $rs['name']; ?></td>
                        <td>
                            <button class="btn btn-success btn-sm"
                                    onclick="OrderColumn('<?php echo $rs['catalog_id']; ?>','<?php echo $rs['rowid']; ?>','<?php echo $j;?>');">
                                <span class="glyphicon glyphicon-tasks"></span> 
                                เรียงใหม่
                            </button>
                            <?php
                            if ($j < $ColNumber) {
                                $NewCol = $j + 1;
                                ?>
                                <button class="btn btn-info btn-sm"
                                        onclick="AddColumn('<?php echo $catalog_id; ?>', '<?php echo $rs['template']; ?>', '<?php echo $rs['rowid']; ?>', '<?php echo $NewCol ?>');"> 
                                    <span class="glyphicon glyphicon-edit"></span> เพิ่มแถวนี้
                                </button>
                            <?php } ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style=" text-align: center;">
                        <?php $NewRow = ($i + 1); ?>
                        <button class="btn btn-success btn-sm"
                                onclick="CreateRow('<?php echo $NewRow; ?>', '<?php echo $catalog_id; ?>');">
                            <span class="glyphicon glyphicon-tasks"></span> 
                            เพิ่มแถวใหม่
                        </button>

                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>