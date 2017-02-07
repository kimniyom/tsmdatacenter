
<script type="text/javascript">

    $(document).ready(function () {
        $("#edit").hide();
        $("#del").hide();
        $("#showcatalog").DataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false,
            "scrollX": true
        });

    });

    function clear_buffer() {
        $("#group_id").val('');
        $("#groupname").val('');
        $("#note").val('');
        $("#set_icon").val('');
        $("#color").val('');
    }
    function clear_text() {
        window.location.reload();
        //$("#catalog").val('');
        //$("#DescriptCatalog").val('');
    }

    function insert_Group_Menu() {
        clear_buffer();
        $("#save").show();
        $("#edit").hide();
        $("#myModal").openModal();

    }

    function savegroup_report() {
        var url = "<?php echo Yii::app()->createUrl('backoffice/savegroup_report') ?>";
        var groupname = $("#groupname").val();
        var groupname_en = $("#groupname_en").val();
        var note = $("#note").val();
        var set_icon = $("#set_icon").val();
        var showkpi = $("#showkpi").val();
        var data = {
            groupname: groupname,
            groupname_en: groupname_en,
            note: note,
            set_icon: set_icon,
            showkpi: showkpi
        };

        if (groupname == '') {
            $("#groupname").focus();
            return false;
        }

        if (set_icon == '') {
            $("#set_icon").focus();
            return false;
        }

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }


    // ฟังก์ชั่นแสดงข้อมูลเก่า
    function Editgroupmenu(groupid, groupname, note, icon, showkpi) {
        $("#save").hide();
        $("#edit").show();
        //เซ็ตค่าใส่ TextBox
        $("#group_id").val(groupid);
        $("#groupname").val(groupname);
        $("#note").val(note);
        $("#set_icon").val(icon);
        $("#showkpi").val(showkpi);
        $("#myModal").openModal();
    }

    function Save_EditGroup_menu() {
        //iรับค่า TextBox
        var url = "<?php echo Yii::app()->createUrl('backoffice/editgroup_report') ?>";
        var group_id = $("#group_id").val();
        var groupname = $("#groupname").val();
        var note = $("#note").val();
        var icon = $("#set_icon").val();
        var showkpi = $("#showkpi").val();
        var data = {
            group_id: group_id,
            groupname: groupname,
            note: note,
            icon: icon,
            showkpi: showkpi
        };

        if (groupname == '') {
            $("#groupname").focus();
            return false;
        }


        if (icon == '') {
            $("#set_icon").focus();
            return false;
        }

        $.post(url, data, function (success) {
            window.location.reload();
        });
    }

    //ฟังก์ชั่นลบ
    function Deletgroupmenu(group_id) {
        var data = {group_id: group_id};
        var urlcheck = "<?php echo Yii::app()->createUrl('backoffice/Checkflaggroup') ?>";

        $.post(urlcheck, data, function (result) {

            if (result > '0') {
                Ext.Msg.alert('Error', 'ไม่สามารถลบกลุ่มรายงานนี้ได้!');
                return false;
            } else {
                Ext.MessageBox.confirm('Delete', 'ต้องการลบรายการใช่หรือไม่ ?', function (btn) {
                    if (btn === 'yes') {
                        var url = "<?php echo Yii::app()->createUrl('backoffice/Deletegroupmenu'); ?>";
                        $.post(url, data, function (success) {
                            window.location.reload();
                        });
                    } else {
                        //some code
                    }
                });

            }
        });
    }

    function set_icon(icon) {
        $("#set_icon").val(icon);
    }

</script>

<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'กลุ่มรายงาน',
);
?>

<!--
    Dialog Insert Group Menu 
-->
<input type="hidden" id="group_id"/>
<div class="modal modal-fixed-footer" id="myModal">
    <div class="modal-content">
        <h4>กลุ่มรายงาน</h4><br/>
        <div class="card">
            <div class="card-content">
                ชื่อกลุ่มรายงาน :
                <input type="text" class="form-control" id="groupname" placeholder="กลุ่มรายงาน">
                หมายเหตุ :
                <input type="text" class="form-control" id="note" placeholder="คำอธิบาย">
                <label>KPI</label>
                <select class="browser-default" id="showkpi">
                    <option value="0">ไม่แสดง KPI</option>
                    <option value="1">แสดง KPI</option>
                </select>
                <input type="hidden" id="set_icon"/>
                Icon :
                <div style=" text-align: center;">
                    <?php
                    $j = 0;
                    foreach ($icon as $ic): $j++;
                        ?>
                        <label class="btn white" onclick="set_icon('<?php echo $ic['icon']; ?>');" style=" margin-bottom: 10px;">
                            <input type="radio" name="options" id="icon" autocomplete="off" checked="checked"/>
                            <img src="<?php echo Yii::app()->baseUrl ?>/assets/icon_system/<?php echo $ic['icon'] ?>" 
                                 style="width:25px;"/>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn green" onclick="savegroup_report();" id="save" >Save changes</button>
        <button type="button" class="btn blue" onclick="Save_EditGroup_menu();" id="edit">Save Edit</button>
    </div>
</div>

<!-- Result -->
<div class="card">
    <div class="card-content">
        <h4><span class="glyphicon glyphicon-bookmark"></span> กลุ่มรายงาน</h4>
        <hr/>
        <!-- Button trigger modal -->
        <div class="btn btn-lg green" style="position:  absolute;top: 10px;right: 10px;" onclick="insert_Group_Menu();">
            <i class="mdi-content-add"></i> เพิ่มกลุ่มรายงาน
        </div>

        <table id="showcatalog" class="striped responsive-table" style="background:#FFF; width: 100%;">
            <thead>
                <tr>
                    <td>ลำดับ</td>
                    <td>ชื่อกลุ่มรายงาน</td>
                    <td>ไอคอน</td>
                    <td>Show KPI</td>
                    <td>วันที่สร้าง</td>
                    <td>แก้ไข</td>
                    <td>ลบ</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($Group as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <a href="<?php echo Yii::app()->createUrl('backoffice/Showreportlist', array('menugroup_id' => $rs['id'], 'groupname' => $rs['name'])); ?>">
                                <?php echo $rs['name']; ?>
                            </a>
                        </td>
                        <td><img src="<?php echo Yii::app()->baseUrl; ?>/assets/icon_system/<?php echo $rs['icon']; ?>" width="25"/></td>
                        <td style="text-align: center;">
                            <?php if ($rs['showkpi']) { ?> 
                            <i class="mdi-navigation-check" style=" color: green;"></i>
                            <?php } else { ?>
                                <i class="mdi-navigation-close" style=" color: red;"></i>
                            <?php } ?>
                        </td>
                        <td><?php echo $rs['create_date']; ?></td>
                        <td>
                            <button  class="btn btn-sm orange"
                                     onclick="Editgroupmenu('<?php echo $rs['id']; ?>', '<?php echo $rs['name']; ?>', '<?php echo $rs['note']; ?>', '<?php echo $rs['icon'] ?>', '<?php echo $rs['showkpi'] ?>');">
                                <span class="mdi-content-create"></span></button>
                        </td>   
                        <td>
                            <button class="btn btn-danger btn-sm red" 
                                    onclick="Deletgroupmenu('<?php echo $rs['id']; ?>');">
                                <span class="mdi-action-delete"></span></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
