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
            "bAutoWidth": false
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
        $("#myModal").modal();

    }

    function savegroup_report() {
        var url = "<?php echo Yii::app()->createUrl('backoffice/savegroup_report') ?>";
        var groupname = $("#groupname").val();
        var groupname_en = $("#groupname_en").val();
        var note = $("#note").val();
        var note_en = $("#note_en").val();
        var set_icon = $("#set_icon").val();
        var data = {
            groupname: groupname,
            groupname_en: groupname_en,
            note: note,
            note_en: note_en,
            set_icon: set_icon
        };

        if (groupname == '') {
            $("#groupname").focus();
            return false;
        }
        if (groupname_en == '') {
            $("#groupname_en").focus();
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
    function Editgroupmenu(groupid, groupname, groupname_en, note, note_en, icon) {
        $("#save").hide();
        $("#edit").show();
        //เซ็ตค่าใส่ TextBox
        $("#group_id").val(groupid);
        $("#groupname").val(groupname);
        $("#groupname_en").val(groupname_en);
        $("#note").val(note);
        $("#note_en").val(note_en);
        $("#set_icon").val(icon);

        $("#myModal").modal();
    }

    function Save_EditGroup_menu() {
        //iรับค่า TextBox
        var url = "<?php echo Yii::app()->createUrl('backoffice/editgroup_report') ?>";
        var group_id = $("#group_id").val();
        var groupname = $("#groupname").val();
        var groupname_en = $("#groupname_en").val();
        var note = $("#note").val();
        var note_en = $("#note_en").val();
        var icon = $("#set_icon").val();
        var data = {
            group_id: group_id,
            groupname: groupname,
            groupname_en: groupname_en,
            note: note,
            note_en: note_en,
            icon: icon
        };

        if (groupname == '') {
            $("#groupname").focus();
            return false;
        }

        if (groupname_en == '') {
            $("#groupname_en").focus();
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">กลุ่มรายงาน</h4>
            </div>
            <div class="modal-body" style=" max-height: 450px; overflow: auto;">
                <table width="100%">
                    <tr>
                        <td></td>
                        <td>
                            ชื่อกลุ่มรายงาน :
                            <input type="text" class="form-control" id="groupname" placeholder="กลุ่มรายงาน">
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            GroupReport :
                            <input type="text" class="form-control" id="groupname_en" placeholder="GroupReport">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            หมายเหตุ :
                            <input type="text" class="form-control" id="note" placeholder="คำอธิบาย">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            Explanation :
                            <input type="text" class="form-control" id="note_en" placeholder="explanation">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" id="set_icon"/>
                            Icon :
                            <div class="well" style=" padding: 10px; text-align: center;">
                                <div class="btn-group" data-toggle="buttons" style="border-radius:0px;">
                                    <?php
                                    $j = 0;
                                    foreach ($icon as $ic): $j++;
                                        ?>
                                        <label class="btn" onclick="set_icon('<?php echo $ic['icon']; ?>');">
                                            <input type="radio" name="options" id="icon" autocomplete="off" checked="checked"/>
                                            <img src="<?php echo Yii::app()->baseUrl ?>/assets/icon_system/<?php echo $ic['icon'] ?>" 
                                                 style="width:25px;"/>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savegroup_report();" id="save" >Save changes</button>
                <button type="button" class="btn btn-primary" onclick="Save_EditGroup_menu();" id="edit">Save Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- Result -->
<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title"><span class="glyphicon glyphicon-bookmark"></span> กลุ่มรายงาน</h3>
        <!-- Button trigger modal -->
        <div class="btn btn-primary btn-sm" style="margin-bottom: 0px; float: right;" onclick="insert_Group_Menu();">
            <span class="glyphicon glyphicon-plus"></span> เพิ่มกลุ่มรายงาน
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="showcatalog" class="table table-striped table-hover" style="background:#FFF; width: 100%;">
            <thead>
                <tr>
                    <td>ลำดับ</td>
                    <td>ชื่อกลุ่มรายงาน</td>
                    <td>GroupName</td>
                    <td>ไอคอน</td>
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
                        <td><?php echo $rs['name_en']; ?></td>
                        <td><img src="<?php echo Yii::app()->baseUrl; ?>/assets/icon_system/<?php echo $rs['icon']; ?>" width="25"/></td>
                        <td><?php echo $rs['create_date']; ?></td>
                        <td>
                            <button style=" width: 60px;"  class="btn btn-warning btn-sm"
                                    onclick="Editgroupmenu('<?php echo $rs['id']; ?>', '<?php echo $rs['name']; ?>', '<?php echo $rs['name_en']; ?>', '<?php echo $rs['note']; ?>', '<?php echo $rs['note_en']; ?>', '<?php echo $rs['icon'] ?>');">
                                <span class="glyphicon glyphicon-pencil">แก้ไข</span>
                            </button>
                        </td>   
                        <td>
                            <button class="btn btn-danger btn-sm" 
                                    onclick="Deletgroupmenu('<?php echo $rs['id']; ?>');">
                                <span class="glyphicon glyphicon-trash">ลบ</span></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
