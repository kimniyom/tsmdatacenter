<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'กำหนดสิทธิ์',
);
?>

<div class="table-responsive">
    <?php
    echo $userList;
    ?>
</div>
<div class="card">
    <div class="card-title green white-text" style=" padding:10px;">กำหนดสิทธิ์  &nbsp; </div>
    <div class="card-content">
        <p>เลือกจากรายการด้านล่าง หรือ <button type="button" class="btn blue">คัดลอกจาก...</button></p>
        <div class="row">
            <div class="col m4">
                <div class="card">
                    <!-- Item Group -->
                    <div class="card-content cyan darken-4 white-text" id="itemGroup">
                        กรุณาเลือกผู้ใช้ที่ต้องการ
                    </div>
                </div>
            </div>
            <div class="col m8">
                <div class="card">
                    <div class="card-content cyan darken-2" id="itemList"><p class="white-text">กรุณาเลือกกลุ่มที่ต้องการ</p></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer" style="text-align: right;">
        <div id="saveButton"></div>
        <!--button type="button" id="saveButton" class="btn btn-success" onclick="save()"> บันทึก </button-->
        <input type="hidden" id="userId" value="">
        <input type="hidden" id="groupId" value="">
    </div>
</div>

<script language="JavaScript">
    $("#user tr").click(function () {
        $("#user tr").removeClass("warning");
        $(this).addClass("warning");
        //alert($(this).children("td").html());
        itemGroup($(this).children("td").html());
    });

    function itemGroup(userId) {
        $("#itemList").jstree('destroy');
        $("#userId").val("");
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('Userpriv/ItemGroup'); ?>",
            data: {userId: userId},
            type: 'POST',
            success: function (rs) {
                $("#userId").val(userId);
                $("#itemGroup").html(rs);
            }
        });
    }

    function itemList(groupId, userId) {

        $("#itemList").jstree('destroy');
        $("#groupId").val("");
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('Userpriv/ItemList'); ?>",
            data: {groupId: groupId, userId: userId},
            type: 'POST',
            success: function (rs) {
                $("#groupId").val(groupId);
                $("#itemList").html(rs);

                var id = [];
                $(".checked").each(function () {
                    //alert(this.id);
                    //$("#itemList").jstree("select_node", this);
                    id.push(this.id);
                });


                $('li[data-checkstate="checked"]').each(function () {
                    //alert(this.id);
                    // $("#itemList").jstree("select_node", this);
                    //id.push(this.id);
                });

                $('#itemList').jstree({
                    "plugins": ["wholerow", "checkbox"]
                });

                for (i = 0; i < id.length; i++) {
                    $("#itemList").jstree("select_node", id[i]);
                }
                $("#saveButton").html('<button type="button" id="saveButton" class="btn btn-success" onclick="save()"> บันทึก </button>');
            }
        });
    }


    function save() {

        $("#saveButton").html("<img src='<?php echo Yii::app()->baseUrl; ?>/images/ajax-loader.gif'>&nbsp;กำลังบันทึกข้อมูล โปรดรอสักครู่...");

        var items = [];
        var selectedElms = $('#itemList').jstree("get_selected", true);
        $.each(selectedElms, function () {
            items.push(this.id);
        });

        var userId = $("#userId").val();
        var groupId = $("#groupId").val()
        $.ajax({
            url: "<?php echo Yii::app()->createUrl('Userpriv/PrivSave'); ?>",
            data: {id: items, userId: userId, groupId: groupId},
            type: 'POST',
            success: function () {
                $("#saveButton").html("บันทึกข้อมูลเรียบร้อย");
                itemGroup(userId);
                //itemList(groupId,userId);
            }
        });
    }

</script>