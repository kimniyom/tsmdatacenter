
<script type="text/javascript">

    function clearval() {
        $("#user").val('');
        $("#pass").val('');
        $("#fname").val('');
        $("#lname").val('');
        $("#helppass").hide();
        //$("#user").focus();
        $("#sp").hide();
        $("#dis").show();
        $("#hosp").show();

        $("#addUser").openModal();

    }
    function saveUser() {

        //alert($("#dist").val());

        var user = $("#user").val();
        var pass = $("#pass").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var hos = $("#hos").val();
        var amphur = $("#dist").val();
        var data = {user: user, pass: pass, fname: fname, lname: lname, hos: hos, amphur: amphur};
        if (user == "") {
            $("#user").focus();
        } else if (pass == "") {
            $("#pass").focus();
        } else if (fname == "") {
            $("#fname").focus();
        } else {

            var url = "<?php echo Yii::app()->createUrl('User/SaveUser') ?>";
            $.post(url, data, function (success) {
                //alert(success);
                if (success == "save") {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Save',
                        msg: 'บันทึกข้อมูลสำเร็จ',
                        buttons: Ext.MessageBox.OK
                    });
                    window.location.reload();
                } else if (success == "notnull") {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Warnning',
                        msg: 'มีชื่อผู้ใช้งาน(Username)นี้ในระบบแล้ว',
                        buttons: Ext.MessageBox.OK
                    });
                } else {
                    Ext.Msg.alert({
                        //width: 400,
                        title: 'Warnning',
                        msg: 'บันทึกข้อมูลผิดพลาด',
                        buttons: Ext.MessageBox.OK
                    });
                }
            });
        }
    }
    //function แก้ไขข้อมูล
    function editUser() {
        var uid = $("#uid").val();
        var user = $("#user").val();
        var pass = $("#pass").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var hos = $("#hos").val();
        var dist = $("#dist").val();
        var distold = $("#distcode").val();
        //alert(dist);
        var data = {user: user,
            pass: pass,
            fname: fname,
            lname: lname,
            hos: hos,
            dist: dist,
            distold: distold,
            userid: uid};
        var url = "<?php echo Yii::app()->createUrl('User/EditUser') ?>";
        $.post(url, data, function (success) {
            if (success == "save") {
                Ext.Msg.alert({
                    //width: 400,
                    title: 'Edit',
                    msg: 'แก้ไขข้อมูลสำเร็จ',
                    buttons: Ext.MessageBox.OK
                });
                //Materialize.toast('I am a toast', 4000)

                window.location.reload();
            } else {
                Ext.Msg.alert({
                    //width: 400,
                    title: 'Warnning',
                    msg: 'แก้ไขข้อมูลผิดพลาด',
                    buttons: Ext.MessageBox.OK
                });
            }

        });
    }
    //ฟังก์ชั่นลบ
    function deleteUser() {
        Ext.MessageBox.show({
            title: 'Icon Support',
            msg: 'Are you sure you want to proceed?',
            buttons: Ext.MessageBox.OKCANCEL,
            icon: Ext.MessageBox.WARNING,
            fn: function (btn) {
                if (btn == 'ok') {
                    var uid = $("#uid").val();
                    var url = "<?php echo Yii::app()->createUrl('User/DeleteUser') ?>";

                    var data = {uid: uid};
                    $.post(url, data, function (success) {
                        window.location.reload();
                    });
                } else {
                    return;
                }
            }
        });
    }

    function Confirm() {
        var uid = $("#uid").val();
        var url = "<?php echo Yii::app()->createUrl('User/DeleteUser') ?>";

        var data = {uid: uid};
        $.post(url, data, function (success) {
            window.location.reload();
        });
    }
    //Function แสดงปุ่มและข้อมูลเมื่อมีการคลิก row ใน DataTable
    function Clickrow(uID, user, pass, fname, lname, hos, dist) {
        //alert(hos);
        $("#dis").hide();
        $("#hosp").hide();
        $("#sp").show();
        $("#btsave").hide();
        $("#btedit").show();
        $("#btdel").show();
        $("#btclose").show();
        $("#helppass").show();
        //alert(uID);
        //ใส่ข้อมูลลงใน Input Box
        $("#uid").val(uID);
        $("#user").val(user);
        $("#pass").val(pass);
        $("#fname").val(fname);
        $("#lname").val(lname);
        $("#hos").val(hos);
        $("#distcode").val(dist);
        $("#addUser").openModal();
    }
</script>
<script type="text/javascript">
    //แสดงข้อมูลในรูปแบบของ DataTable
    $(document).ready(function () {
        var table = $("#showUser").DataTable({
            "sort": true,
            //scrollY: 200,
            paging: false,
            responsive: true

        }); // id ของ ตาราง
        //เลือกแถวแล้วแสดงแถบสีในแถวที่เลือก
        $('#showUser tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $("#btsave").show();
        $("#btedit").hide();
        $("#btdel").hide();
        $("#btclose").show();
        //ซ่อน dropdown เลือกสถานบริการและอำเภอ
        $("#dis").hide();
        $("#hosp").hide();

        test();
    });
    function chkdist() {
        var distid = $('#hos').val();
        var url = "<?php echo Yii::app()->createUrl('User/ChkDist') ?>";
        var data = {distid: distid};
        $.post(url, data, function (success) {
            alert(success);
            window.location.reload();
        });
    }
</script>

<script type="text/javascript">
    function set_hos(val) {
        $("#hos").val(val);
    }
</script>
<script language=Javascript>
    function Inint_AJAX() {
        try {
            return new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
        } //IE
        try {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } catch (e) {
        } //IE
        try {
            return new XMLHttpRequest();
        } catch (e) {
        } //Native Javascript
        alert("XMLHttpRequest not supported");
        return null;
    }
    ;
    function dochange(src, val) {
        //alert(val);
        $("#dist").val(val);
        var req = Inint_AJAX();
        req.onreadystatechange = function () {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                }
            }
        };
        req.open("GET", "<?php echo Yii::app()->baseUrl; ?>" + "/index.php?r=report/Filter/FilterHos&data=" + src + "&val=" + val); //สร้าง connection
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf8"); // set Header
        req.send(null); //ส่งค่า
    }

    window.onLoad = dochange('amphur', '0');


</script>
<script type="text/javascript">
    function select1() {
        $("#dis").hide();
        $("#hosp").hide();
    }
    function select2() {
        $("#dis").show();
        $("#hosp").show();
    }

    function test() {

        //แสดงรูปก่อนแสดงขณะประมวลผล
        var img = "<center><img src='<?php echo Yii::app()->baseUrl ?>/images/ajax-loader.gif'/></center>";
        $("#showList").html(img);

        //Load ข้อมูลจากฐานข้อมูลมาแสดง
        var url = "<?php echo Yii::app()->createUrl("/User/Test") ?>";
        $("#showList").load(url);
    }
</script>

<style type="text/css">
    #addUser {overflow-y: hidden !important ;} 
    .row{
        margin-bottom: 0px;
    }
</style>

<?php
/* @var $this TypenewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ผู้ใช้งาน',
);
?>


<!-- Modal -->
<div id="addUser" class="modal modal-fixed-footer">
    <div class="modal-header white" style="padding:5px 15px;"><h4>เพิ่มผู้ใช้งาน</h4></div>
    <div class="modal-content">
        <input type="hidden" id="uid">
        <input type="hidden" id="distcode">
        <div class="row">
            <div class="col l6 m6 s12">
                <label>Username</label>
                <input type="text" class="validate" id="user" placeholder="Username" autofocus>
            </div>
            <div class="col l6 m6 s12">
                <label>Password</label>
                <input type="password" class="validate" id="pass" placeholder="Password" aria-describedby="helppass">
                <span id="helppass" class="help-block red-text">Password ไม่สามารถดูได้ ถ้าลืมต้องเปลี่ยนใหม่เท่านั้น...</span>
            </div>
        </div>

        <div class="row">
            <div class="col l6 m6 s12">
                <div class="form-group">
                    <label>ชื่อ</label>
                    <input type="text" class="form-control" id="fname" size="30" placeholder="Name">
                </div>
            </div>
            <div class="col l6 m6 s12">
                <div class="form-group">
                    <label>นามสกุล</label>
                    <input type="text" class="form-control" id="lname" size="30" placeholder="Surname">
                </div>
            </div>
        </div>

        <div class="form-group btn-group" data-toggle="buttons" id="sp" style=" display: none;">
            <div class="row">
                <div class="col l6 m6 s12">
                    <label class="btn waves-effect waves-light blue btn-sm" onclick="select1();">
                        <input type="radio" name="options" id="sp1" autocomplete="off" checked> ใช้สถานบริการเดิม
                    </label>
                    <label class="btn waves-effect waves-light red lighten-2 btn-sm" onclick="select2();">
                        <input type="radio" name="options" id="sp2" autocomplete="off"> เปลี่ยนสถานบริการ
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group" id="dis">
            <div class="row">
                <div class="col l12 m12 s12">
                    <label>แผนกหลัก</label>
                    <input type="hidden" id="dist">
                    <?php
                    echo "<form name=sel>\n";
                    echo "<font id=amphur><select class='form-control input-md' id='amphur'>\n";
                    echo "<option value='0'>-กรุณาเลือกอำเภอ-</option> \n";
                    echo "</select></font>\n";
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group" id="hosp" style=" margin-bottom: 50px;">
            <div class="row">
                <div class="col l12 m12 s12">
                    <label>แผนกย่อย</label>
                    <?php
                    echo "<font id=hos><select class='browser-default' id='hos'>\n";
                    echo "<option value='0'>-กรุณาเลือกสถานบริการ-</option> \n";
                    echo "</select></font>\n";
                    echo "</form>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="form-group btn-group">
            <a class="btn waves-effect waves-light btn-default modal-close" id="btclose">ปิด</a>
            <a class="btn waves-effect waves-light blue" id="btsave" onclick="saveUser();">บันทึก</a>
            <a class="btn waves-effect waves-light blue" id="btedit" onclick="editUser();">แก้ไข</a>
            <a class="btn waves-effect waves-light red lighten-1" id="btdel" onclick="deleteUser();">ลบ</a>                   
        </div>
    </div>
</div>
<!-- End Modal -->

<div class="card">
    <div class="card-action blue white-text">
        จัดการผู้ใช้งาน
        <button type="button" class="btn btn-primary" id="save" style="margin-bottom: 0px; float: right;" data-toggle="modal" onclick="clearval();" >
            <i class="mdi-content-add-circle"></i> เพิ่มผู้ใช้งาน
        </button>
    </div>
    <div class=" card-content">

        <div style="text-align: center;">
            <label class="text-danger">คลิกเลือกที่แถวของข้อมูลเมื่อต้องการแก้ไขหรือลบข้อมูล</label>
        </div>


        <!-- Result -->
        <table id="showUser" class="striped" style=" border: #cccccc solid 1px;">
            <thead>
                <tr class="bg-primary">
                    <th>ลำดับ</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Hospital Code</th>
                    <th>อำเภอ</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $j = 0;
                foreach ($user as $rs): $j++;
                    ?>
                    <tr id="edituser" 
                        onclick="Clickrow('<?php echo $rs['userid']; ?>',
                                        '<?php echo $rs['username']; ?>',
                                        '<?php echo $rs['password']; ?>',
                                        '<?php echo $rs['name']; ?>',
                                        '<?php echo $rs['lname']; ?>',
                                        '<?php echo $rs['hospcode']; ?>',
                                        '<?php echo $rs['distcode']; ?>'
                                        );">
                        <td><?php echo $j; ?></td>
                        <td><?php echo $rs['username']; ?></td>
                        <td><?php echo $rs['name']; ?></td>
                        <td><?php echo $rs['lname']; ?></td>
                        <td><?php echo $rs['off_name']; ?></td>
                        <td><?php echo $rs['distname']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>


