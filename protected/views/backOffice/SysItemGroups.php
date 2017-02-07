<style type="text/css">
    #showItemGroups thead th{
        white-space: nowrap;
    }
</style>

<div class="card">
    <div class="card-action cyan white-text" style=" padding: 10px;">
        จัดการกลุ่ม
    </div>
    <div class="card-content">
        <div class="row">
            <div class="col m6 l6">
                <input type="hidden" class="form-control" id="id">
                ชื่อกลุ่ม :
                <input type="text" class="form-control" id="itemgroup"  placeholder="โปรดระบุ">
            </div>
            <div class="col m6 l6">
                GroupName :
                <input type="text" class="form-control" id="itemgroup_en"  placeholder="โปรดระบุ">
            </div>
        </div>
        <div class="row">
            <div class="col m12 l12">
                Comment: 
                <textarea  id="comment"></textarea>
            </div>
        </div>
        <button type="button" class="btn blue" onclick="saveItemGroup();" id="save">
            <i class="mdi-content-add"></i> เพิ่ม
        </button>
        <button type="button" class="btn green" id="edit" onclick="edititemgroup();">
            <i class="mdi-content-save"></i> บันทึก
        </button>
        <button type="button" class="btn red" onclick="clear_text();">
            <i class="mdi-action-delete"></i> ยกเลิก
        </button>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <!-- Result -->
        <table id="showItemGroups" class="row-border stripe" style=" font-size: 20px;">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อกลุ่ม</th>
                    <th>GroupName</th>
                    <th>จำนวนลูก</th>
                    <th>Comment</th>
                    <th style=" text-align: center;">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($item as $rs):
                    ?>
                    <tr>
                        <td>                       
                            <?php echo $rs['id']; ?>
                        </td>
                        <td>
                            <input type="hidden" id="groupid" value="<?php echo $rs['id']; ?>">
                            <a href="javascript:manageItems('<?php echo $rs['id']; ?>','0','0');"><?php echo $rs['item_group_name']; ?></a>
                        </td>
                        <td>
                            <input type="hidden" id="groupid" value="<?php echo $rs['id']; ?>">
                            <a href="javascript:manageItems('<?php echo $rs['id']; ?>','0','0');"><?php echo $rs['item_group_name_en']; ?></a>
                        </td>
                        <td style=" text-align: center;"><?php echo $rs['child']; ?></td>
                        <td><?php echo $rs['comment'] ?></td>
                        <td style="text-align: center;">
                            <a href="javascript:setbox('<?php echo $rs['id']; ?>', '<?php echo $rs['item_group_name']; ?>', '<?php echo $rs['item_group_name_en']; ?>','<?php echo $rs['comment'] ?>');">
                                <i class="mdi-editor-border-color"></i></a>
                            <a href="javascript:deleteitemgroup('<?php echo $rs['id']; ?>');"><i class="mdi-action-delete red-text"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    function clear_text() {
        $("#itemgroup").val(''); //id ของ input box เป็นค่าว่าง
        $("#itemsun").val(''); //id ของ input box เป็นค่าว่าง
    }
    function CheckNum() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            alert('กรุณากรอกข้อมูลเป็นตัวเลข');
        }
    }
    function saveItemGroup() {
        var url = "<?php echo Yii::app()->createUrl('sysitems/saveitemgroups') ?>";
        var itemgroup = $("#itemgroup").val(); //id ของ input box
        var itemgroup_en = $("#itemgroup_en").val(); //id ของ input box

        var itemsun = $("#itemsun").val(); //id ของ input box
        var itemsun_en = $("#itemsun_en").val(); //id ของ input box
        var comment = $("#comment").val();
        var data = {
            itemgroup: itemgroup,
            sun: itemsun,
            itemsun_en: itemsun_en,
            itemgroup_en: itemgroup_en,
            comment: comment
        }; //ค่าที่ต้องการส่งไปให้กับ controller ในที่นี้ส่งค่าไปกับตัวแปร itemgroup กับ sun

        if (itemgroup == '') {
            $("#itemgroup").focus();
            return false;
        }

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
    //Set Button & Show val
    function setbox(id, name, name_en, comment) {
        $("#save").hide();
        $("#edit").show();
        //$("#del").hide();
        //$("#id").val(id);
        $("#id").val(id);
        $("#itemgroup").val(name);
        $("#itemgroup_en").val(name_en);
        $("#comment").val(comment);
        $("#itemgroup").focus();
        // $("#DescriptCatalog").val(note);
    }

    // ฟังก์ชั่นแก้ไข
    function edititemgroup() {
        var url = "<?php echo Yii::app()->createUrl('sysitems/edititemgroup') ?>";
        var id = $("#id").val();
        var itemgroup = $("#itemgroup").val();
        var itemgroup_en = $("#itemgroup_en").val();
        var comment = $("#comment").val();
        var data = {id: id, itemgroup: itemgroup, itemgroup_en: itemgroup_en, comment: comment};

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }

    //ฟังก์ชั่นลบ
    function deleteitemgroup(groupid) {

        var data = {groupid: groupid};

        var urlcheck = "<?php echo Yii::app()->createUrl('sysitems/checkflag') ?>";
        $.post(urlcheck, data, function (result) {

            if (result > '0') {

                Ext.MessageBox.confirm("Wornning", "<center>ภายใต้หัวข้อนี้มีข้อมูลอยู่<br/>ต้องการลบรายการใช่หรือไม่ ?</center>", function (btn) {
                    if (btn === 'yes') {

                        var url = "<?php echo Yii::app()->createUrl('sysitems/deletegroup') ?>";
                        $.post(url, data, function (success) {
                            //alert(success);
                            window.location.reload();
                        });
                        //Ext.MessageBox.alert("ผลลัพท์","ลบข้อมูลเรียบร้อย");
                        //alert("ลบแล้ว");
                        //some code delete

                    } else {
                        //some code
                    }
                    //$.messager.alert('Error', 'ไม่สามารถลบหมวดรายงานนี้ได้!', 'error');
                    //return false;
                });
            } else {
                Ext.MessageBox.confirm("Wornning", "ต้องการลบรายการใช่หรือไม่ ?", function (btn) {
                    if (btn === 'yes') {

                        var url = "<?php echo Yii::app()->createUrl('sysitems/deletegroup') ?>";
                        $.post(url, data, function (success) {
                            //alert(success);
                            window.location.reload();
                        });
                        //Ext.MessageBox.alert("ผลลัพท์","ลบข้อมูลเรียบร้อย");
                        //alert("ลบแล้ว");
                        //some code delete

                    } else {
                        //some code
                    }

                });
            }
        });
    }

    function Showsubitem() {
        var url = "<?php echo Yii::app()->createUrl('sysitems/saveitemgroups') ?>";
        var subitemID = $("#groupid").val(); //id ของ input box
        var subdata = {subitemid: subitemID}; //ค่าที่ต้องการส่งไปให้กับ controller ในที่นี้ส่งค่าไปกับตัวแปร itemgroup กับ sun
    }

    $(document).ready(function () {
        $("#showItemGroups").dataTable({
            //"sPaginationType": "bootstrap",
            //"aaSorting":[[0,"desc"]],
            "pageLength": 100,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "scrollX": true
        }); // id ของ ตาราง
        $("#save").show();
        $("#edit").hide();
        $("#subitem").hide();
    });
</script>