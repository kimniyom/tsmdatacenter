
<div class="card">
    <div class="card-action blue white-text">
        จัดการ Item
    </div>
    <div class="card-content">
        <div class="row">
            <div class="col m4 l4">
                รหัส :
                <input type="text" class="form-control" id="itemcode" name="itemcode"  OnKeyPress="CheckNum();" size="5" placeholder="Item Code">
            </div>
        </div>
        <div class="row">
            <div class="col m6 l6">
                ชื่อ :
                <input type="text" class="form-control" id="itemname" name="itemname"  placeholder="Item name">
            </div>
            <div class="col m6 l6">
                Name :
                <input type="text" class="form-control" id="itemname_en" name="itemname_en"  placeholder="Item name">
            </div>
        </div>
        <!--td>
            ลำดับการเรียง :-->
        <input type="hidden" id="id" name="id">
        <input type="hidden" class="form-control" id="orderNumber"  OnKeyPress="CheckNum();" size="5" placeholder="leave for automatic">
        <!--/td-->

        <div class="btn blue" onclick="saveItem();" id="save">
            <i class="mdi-content-add"></i> เพิ่ม
        </div>
        <div class="btn geen" onclick="edititem();" id="edit">                            
            <i class="mdi-content-save"></i> บันทึก                            
        </div>
        <div class="btn red" onclick="clear_text();">
            <i class="mdi-action-delete"></i> ยกเลิก
        </div>
    </div>
</div>


<div class="well">
    <div class="btn blue lighten-1 white-text" onclick="setCopy();">
        <span class="mdi-content-content-copy"></span> คัดลอก
    </div>  
    <div class="btn green white-text" onclick="copy();" id="copyOK">
        <span class="mdi-content-save"></span> ตกลง
    </div>
    <div class="btn white grey-text <?php echo isset(Yii::app()->session['copyRefId']) ? "" : "disabled"; ?>" onclick="paste();" id="copyPaste">
        <span class="mdi-content-content-paste"></span> วาง
    </div>
    <div class="btn white grey-text <?php echo isset(Yii::app()->session['copyRefId']) ? "" : "disabled"; ?>" onclick="move();" id="copyMove">
        <span class="mdi-content-redo"></span> ย้าย
    </div>
    <div class="btn red" onclick="cancelCopy();">
        <span class="mdi-content-clear"></span> ยกเลิก
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div id="displayCopy"><?php echo isset(Yii::app()->session['copyText']) ? Yii::app()->session['copyText'] : ""; ?></div>
        <!-- Result -->
        <form id="formOrderNumber" onsubmit="return false;">
            <input type="hidden" id="gid" name="gid" value="<?php echo $gid; ?>">
            <input type="hidden" id="uid" name="uid" value="<?php echo $id; ?>">
            <input type="hidden" id="lv" name="lv" value="<?php echo $lv; ?>">

            <table id="showItemGroups" class="row-border stripe" style=" font-size: 20px;">
                <thead>
                    <tr>
                        <th class="index" style=" width: 2%;">#</th>
                        <th class="hidden" id="checkbox" style=" width: 2%;">
                            เลือก
                        </th>
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                        <th>Name</th>
                        <th>จำนวนลูกระดับถัดไป</th>
                        <th style=" text-align: center;">เครื่องมือ</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($item as $rs): ?>

                        <tr>
                            <td class="index"><?php echo $no; ?></td>
                            <td class="hidden" id="checkbox<?php echo $no; ?>" style=" text-align: center;">
                                <p>
                                    <input type="checkbox" name="cb[]" value="<?php echo $rs['id']; ?>" id="<?php echo $rs['id']; ?>">
                                    <label for="<?php echo $rs['id']; ?>"></label>
                                </p>
                            </td>
                            <td>
                                <input type='hidden' id='item_id' name='item_id[]' value='<?php echo $rs['id']; ?>'>
                                <?php echo $rs['item_code']; ?></td>
                            <td><a href="javascript:manageItems('<?php echo $rs['item_group_id']; ?>','<?php echo $rs['levelid']; ?>','<?php echo $rs['id']; ?>');">
                                    <?php echo $rs['item_name']; ?></a>
                            </td>
                            <td><a href="javascript:manageItems('<?php echo $rs['item_group_id']; ?>','<?php echo $rs['levelid']; ?>','<?php echo $rs['id']; ?>');">
                                    <?php echo $rs['item_name_en']; ?></a></td>
                            <td style=" text-align: center;"><?php echo $rs['child']; ?></td>
                            <td style=" text-align: center;">
                                <a href="javascript:set_box('<?php echo $rs['item_code']; ?>', '<?php echo $rs['item_name']; ?>', '<?php echo $rs['item_name_en']; ?>',<?php echo $rs['order_number']; ?>, '<?php echo $rs['id']; ?>');">
                                    <i class="mdi-editor-border-color"></i></a>
                                <a href="javascript:deleteitem('<?php echo $rs['id']; ?>');"><i class="mdi-action-delete red-text"></i></a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </form>
    </div>
</div>

<script type="text/javascript">
    function clear_text() {
        $("#id").val(''); //id ของ input box เป็นค่าว่าง
        $("#itemcode").val(''); //id ของ input box เป็นค่าว่าง
        $("#itemname").val(''); //id ของ input box เป็นค่าว่าง
        $("#save").show();
        $("#edit").hide();
    }
    function CheckNum() {
        if (event.keyCode < 48 || event.keyCode > 57) {
            //alert('กรุณากรอกข้อมูลเป็นตัวเลข');

            $.messager.confirm('Warning', 'กรุณากรอกข้อมูลเป็นตัวเลข', function (r) {
                if (r) {
                    $("#itemcode").focus();
                }
            });
        }
    }


    function saveItem() {
        var gid = $('#gid').val();
        var uid = $('#uid').val();
        var lv = $('#lv').val();
        var itemcode = $("#itemcode").val(); //id ของ input box
        var itemname = $("#itemname").val(); //id ของ input box
        var itemname_en = $("#itemname_en").val(); //id ของ input box
        //var order_number = $("#orderNumber").val();

        var data = {itemcode: itemcode, itemname: itemname, itemname_en: itemname_en, gid: gid, uid: uid, lv: lv};

        if (itemname == '' || itemname_en == '') {
            alert("กรุณาระบุชื่อ Item name");
            $("#itemname").focus();
            return false;
        } else {
            var url = "<?php echo Yii::app()->createUrl('sysitems/saveitem'); ?>";

            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                success: function (rs) {
                    if (rs == "nologin") {
                        alert("กรุณาเข้าสู่ระบบอีกครั้ง.");
                    } else {
                        manageItems(gid, lv, uid);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //console.log(arguments);
                    //alert(thrownError);
                }
            });
        }
    }
    //Set Button & Show val
    function set_box(code, name, name_en, orderNumber, id) {
        $("#save").hide();
        $("#edit").show();
        //$("#del").hide();
        $("#id").val(id);
        $("#itemcode").val(code);
        $("#itemname").val(name);
        $("#itemname_en").val(name_en);
        $("#orderNumber").val(orderNumber);
        // $("#DescriptCatalog").val(note);
    }
    // ฟังก์ชั่นแก้ไข
    function edititem() {

        var gid = $("#gid").val();
        var uid = $("#uid").val();
        var lv = $('#lv').val();
        var id = $('#id').val();

        //if(lvl > 0) lvl -= 1;

        var itemcode = $("#itemcode").val();
        var itemname = $("#itemname").val();
        var itemname_en = $("#itemname_en").val();
        var order_number = $("#orderNumber").val();
        //var DescriptCatalog = $("#DescriptCatalog").val();
        var data = {item: itemcode, itemname: itemname, itemname_en: itemname_en, orderNumber: order_number, gid: gid, id: id};

        /*
         if (itemcode == '') {
         $("#itemcode").focus();
         return false;
         }
         */
        if (itemname == '') {
            $("#itemname").focus();
            return false;
        }
        var url = "<?php echo Yii::app()->createUrl('Sysitems/EditItem') ?>";
        $.post(url, data, function (success) {
            manageItems(gid, lv, uid);
        });
    }

    //ฟังก์ชั่นลบ
    function deleteitem(item_id) {
        // alert("delete="+item_id);
        var gid = $("#gid").val();
        var uid = $("#uid").val();
        var lv = $('#lv').val();
        var data = {item_id: item_id};
        var urlcheck = "<?php echo Yii::app()->createUrl('Sysitems/Check_flagItem') ?>";

        $.post(urlcheck, data, function (result) {
            // alert(result);
            if (result > '0') {
                Ext.MessageBox.confirm("Wornning", "<center>ภายใต้หัวข้อนี้มีข้อมูลอยู่<br/>ต้องการลบรายการใช่หรือไม่ ?</center>", function (btn) {
                    if (btn === 'yes') {

                        var url = "<?php echo Yii::app()->createUrl('Sysitems/Deleteitem') ?>";
                        $.post(url, data, function () {
                            //alert(success);
                            //window.location.reload();
                            manageItems(gid, lv, uid);
                        });
                        //Ext.MessageBox.alert("ผลลัพท์","ลบข้อมูลเรียบร้อย");
                        //alert("ลบแล้ว");
                        //some code delete

                    }
                });
            } else {
                Ext.MessageBox.confirm("Wornning", "<center>ต้องการลบรายการใช่หรือไม่ ?</center>", function (btn) {
                    if (btn === 'yes') {

                        var url = "<?php echo Yii::app()->createUrl('Sysitems/Deleteitem') ?>";
                        $.post(url, data, function () {
                            manageItems(gid, lv, uid);
                        });
                        //Ext.MessageBox.alert("ผลลัพท์","ลบข้อมูลเรียบร้อย");
                        //alert("ลบแล้ว");
                        //some code delete

                    }
                    //$.messager.alert('Error', 'ไม่สามารถลบหมวดรายงานนี้ได้!', 'error');
                    //return false;
                });
            }
        });

    }


    var fixHelperModified = function (e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();

        $helper.children().each(function (index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
            updateIndex = function (e, ui) {
                $('td.index', ui.item.parent()).each(function (i) {
                    //$(this).html(i + 1);
                    $(this).html(i + 1);
                });

                updateOrderNumber();
            };

    $("#showItemGroups tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();

    function updateOrderNumber() {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Sysitems/ItemOrderSave") ?>',
            data: $("#formOrderNumber").serialize(),
            type: 'POST'
                    /*,
                     success: function(data) {
                     alert("บันทึกแล้วจำนวน (รายการ)"+data);
                     },
                     error :function(xhr, ajaxOptions, thrownError){
                     /// console.log(arguments);
                     alert("ไม่สามารถเปลี่ยนแปลงข้อมูลได้โปรดลองอีกครั้ง หรือแจ้งปัญหา (055)518133");
                     }*/
        });
    }

    $(document).ready(function () {
        $("#showItemGroups").DataTable({
            "pageLength": 100,
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "scrollX": true
        }); // id ของ ตารางเพื่อกำหนดให้ตารางเป็นรูปแบบของ DataTable
        $("#edit").hide();
    });

    function setCopy() {
        var copyText = '<div class="alert alert-warning" role="alert">เลือกรายการที่ต้องการแล้วกดปุ่มตกลง จากนั้นนำไปวางตรงตำแหน่งที่ต้องการ</div>';
        $("#displayCopy").html(copyText);
        for (i = 0; i < <?php echo $no; ?>; i++) {
            $("#checkbox" + i).removeClass();
        }
    }


//var refid;
//var copyText;
    function copy() {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Sysitems/Copy") ?>',
            data: $("#formOrderNumber").serialize(),
            type: 'POST',
            success: function (data) {
                var rs = data.split("|");
                // refid = rs[0];
                var copyText = '<div class="alert alert-success" role="alert">คุณคัดลอกไว้จำนวน ' + rs[1] + ' รายการ</div>';
                $("#displayCopy").html(copyText);
            }
        });
    }


    function cancelCopy() {
        $.post("<?php echo Yii::app()->createUrl("/Sysitems/CancelCopy") ?>");
        for (i = 0; i < <?php echo $no; ?>; i++) {
            $("#checkbox" + i).addClass("hidden");
        }
        $("#displayCopy").html("");
        $("#copyPaste").addClass("disabled");
        $("#copyMove").addClass("disabled");
    }

    function paste() {
        var gid = $("#gid").val();
        var uid = $("#uid").val();
        var lv = $('#lv').val();
        var data = {gid: gid, uid: uid, lv: lv};

        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Sysitems/Paste") ?>',
            data: data,
            type: 'POST',
            success: function () {
                //alert(data);
                manageItems(gid, lv, uid);
            }
        });
    }

    function move() {
        var gid = $("#gid").val();
        var uid = $("#uid").val();
        var lv = $('#lv').val();
        var data = {gid: gid, uid: uid, lv: lv};

        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/Sysitems/Move") ?>',
            data: data,
            type: 'POST',
            success: function () {
                manageItems(gid, lv, uid);
                cancelCopy();
            }
        });
    }


</script>