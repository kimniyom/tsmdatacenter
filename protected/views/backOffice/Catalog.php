<html>
    <head>
        <meta charset="utf-8"/>
        <title>Login</title>
        <script type="text/javascript">
            function clear_text() {
                window.location.reload();
            }
            
            function savecatalog() {
                var url = "<?php echo Yii::app()->createUrl('backoffice/SaveCatalog') ?>";
                var catalog = $("#catalog").val();
                var owner = $("#ampur").val();
                var DescriptCatalog = $("#DescriptCatalog").val();
                var data = {catalog: catalog, note: DescriptCatalog, owner: owner};

                if (catalog == '') {
                    $("#catalog").focus();
                    return false;
                }

                $.post(url, data, function(success) {
                    window.location.reload();
                });
            }

            $(document).ready(function() {
                $("#edit").hide();
                $("#del").hide();
                $("#showcatalog").DataTable({
                    "scrollX": "100%",
                    "scrollCollapse": true,
                });
            });

            function set_box(id, name, note, owner) {

                $("#save").hide();
                $("#edit").show();
                $("#del").hide();
                $("#catalog_id").val(id);
                $("#ampur").val(owner);
                $("#catalog").val(name);
                $("#DescriptCatalog").val(note);
            }

            // ฟังก์ชั่นแก้ไข
            function editcatalog() {
                var url = "<?php echo Yii::app()->createUrl('backoffice/editcatalog') ?>";
                var catalog = $("#catalog").val();
                var owner = $("#ampur").val();
                var catalog_id = $("#catalog_id").val();
                var DescriptCatalog = $("#DescriptCatalog").val();
                var data = {catalog: catalog, note: DescriptCatalog, catalog_id: catalog_id, owner: owner};

                if (catalog == '') {
                    $("#catalog").focus();
                    return false;
                }

                $.post(url, data, function(success) {
                    window.location.reload();
                });
            }
            //ฟังก์ชั่นลบ
            function deletecatalog(catalog_id) {
                var data = {catalog_id: catalog_id};
                var urlcheck = "<?php echo Yii::app()->createUrl('backoffice/Check_flag') ?>";

                $.post(urlcheck, data, function(result) {
                    if (result > '0') {
                        Ext.Msg.alert('Error', 'ไม่สามารถลบหมวดรายงานนี้ได้!');
                        return false;
                    } else {
                        Ext.MessageBox.confirm('Delete', 'ต้องการลบรายการใช่หรือไม่ ?', function(btn) {
                            if (btn === 'yes') {
                                var url = "<?php echo Yii::app()->createUrl('Backoffice/deletecatalog'); ?>";
                                $.post(url, data, function(success) {
                                    window.location.reload();
                                });
                            } else {
                                //some code
                            }
                        });
                    }
                });
            }

        </script>
        <style>
            .table-striped>tbody>tr:nth-child(odd)>td,
            tr.found{
                background-color:#d5d6de;
            }
            .table-striped>tbody>tr:nth-child(even)>td,
            tr.found{
                background-color:#FFFFFF;
            }
        </style>
    </head>
    <body>

        <label class="alert alert-warning" style=" margin: 0px; padding: 5px;">
            <span class="glyphicon glyphicon-bookmark"></span> หมวดรายงาน
        </label>
        <div class="well" style=" padding: 10px;">
            <input type="hidden" id="catalog_id" />
            <table width="100%">
                <tr>
                    <td>
                        ชื่อหมวดรายงาน :
                        <input type="text" class="form-control input-sm" id="catalog" placeholder="หมวดรายงาน">
                    </td>
                    <td style=" padding-left: 10px; width: 50%;">
                        คำอธิบาย :
                        <input type="text" class="form-control input-sm" id="DescriptCatalog" placeholder="คำอธิบาย">
                    </td>
                    <td>
                        เจ้าของรายงาน :
                        <select id="ampur" class=" form-control input-sm">
                            <?php foreach ($ampur as $am): ?>
                                <option value="<?php echo $am['distid']; ?>"><?php echo $am['distid'] . '-' . $am['distname'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td align="center">
                        <p style=" height:5px;"></p>
                        <div class="btn btn-primary" onclick="savecatalog();" id="save">
                            <span class=" glyphicon glyphicon-plus" ></span> ตกลง
                        </div>
                        <div class="btn btn-primary" onclick="editcatalog();" id="edit">                            
                            <span class=" glyphicon glyphicon-edit"></span> ตกลง                            
                        </div>
                        <div class="btn btn-primary" onclick="deletecatalog();" id="del">
                            <span class=" glyphicon glyphicon-trash"></span> ตกลง
                        </div>
                        <div class="btn btn-danger" onclick="clear_text();">
                            <span class=" glyphicon glyphicon-remove"></span> ยกเลิก
                        </div>
                    </td>

                </tr>
            </table>
        </div>

        <!-- Result -->
        <table id="showcatalog" class="table table-striped table-hover" style="background:#FFF;">
            <thead>
                <tr>
                    <td>ลำดับ</td>
                    <td>ชื่อหมวด</td>
                    <td>หมายเหตุ</td>
                    <td>วันที่สร้าง</td>
                    <td>ผู้สร้าง</td>
                    <td>เจ้าของหมวด</td>
                    <td>เลือก</td>
                    <td>รูปแบบ</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($Catalog as $rs): $i++;
                    ?>
                    <tr>
                        <td align="center"><?php echo $i; ?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('Backoffice/Showgroupreport', array('catalog_id' => $rs['id'], 'catalogname' => $rs['name'])); ?>">
                                <?php echo $rs['name']; ?>
                            </a>
                        </td>
                        <td><?php echo $rs['note']; ?></td>
                        <td><?php echo $rs['create_date']; ?></td>
                        <td><?php echo $rs['Author']; ?></td>
                        <td><?php echo $rs['owner']; ?></td>
                        <td>
                            <?php if (Yii::app()->session['distcode'] == $rs['owner'] || Yii::app()->session['distcode'] == '6300') { ?>
                                <button class="btn btn-warning btn-sm"
                                        onclick="set_box('<?php echo $rs['id']; ?>', '<?php echo $rs['name']; ?>', '<?php echo $rs['note']; ?>', '<?php echo $rs['owner']; ?>');">
                                    <span class="glyphicon glyphicon-pencil">แก้ไข</span>
                                </button>
                                <button  class="btn btn-danger btn-sm"
                                         onclick="deletecatalog('<?php echo $rs['id']; ?>');">
                                    <span class="glyphicon glyphicon-trash">ลบ</span>
                                </button>
                            <?php } else { ?>
                    <center>ไม่มีสิทธิ์</center>
                <?php } ?>
            </td>
            <td>
                <?php if (Yii::app()->session['distcode'] == $rs['owner'] || Yii::app()->session['distcode'] == '6300') { ?>
                    <a href="<?php echo Yii::app()->createUrl('Backoffice/Configtemplate', array('catalog_id' => $rs['id'], 'catalogname' => $rs['name'])); ?>">
                        <button type="button" class="btn btn-info" style="padding: 5px; margin: 0px;">
                            <i class=" fa fa-edit"></i>
                            รูปแบบ
                        </button>
                    </a>
                <?php } else { ?>
                <center>ไม่มีสิทธิ์</center>
            <?php } ?>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
</body>
</html>