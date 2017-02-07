<style type="text/css">
    #formFilter label{
        font-size: 20px;
        font-weight: bold;
        color: #000000;
    }
    #formFilter select{
        background: #ffffff;
        border: #cccccc solid 1px;
        font-size: 20px;
    }
</style>
<?php
$filterModel = new Filter();
$WEBSITE = SysWebsite::model()->find("id = '1'");
?>
<!--
<div class="card <?//php echo $filterModel->filter_bg_color('cyan lighten-5') ?>">
-->
<form id="formFilter">
    <div class="card-content <?php echo $filterModel->filter_text_color('') ?>">
        <input type="hidden" name="reportId" id="reportId" value="<?php echo $_GET['report_id']; ?>">
        <div class="row">
            <?php echo $filter; ?>
            <?php echo $rowFilter; ?>
            <div id="showRowFilter"></div>
            <div class="col l2 m2" style="padding-top: 30px;">
                <button type="button" class="btn waves-effect"  onclick="report()" style=" height: 45px; background: <?php echo $WEBSITE['headcolor']?>;color:<?php echo $WEBSITE['textheadcolor']?>">
                    <i class="mdi-navigation-check left"></i> ดูรายงาน
                </button>
            </div>
        </div>
    </div>

</form>
<!--
</div>
-->

<h4 style=" font-size: 20px; color: #666666;">ที่มา : <?php echo $info; ?></h4>

<!-- ส่งนแสดงตาราง -->
<div id="loading" style=" display: none; text-align: center;">
    <div class="preloader-wrapper small active">
        <div class="spinner-layer spinner-blue">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-red">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-yellow">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>

        <div class="spinner-layer spinner-green">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
    <p>loading ...</p>
</div>
<div id="showTable"></div>
<font style=" color: #ff0033;">
*** แถวที่มีแถบสีแดง หมายถึง ยังบันทึกข้อมูลได้ไม่ครบ 100%
</font>
<?php if (!empty($note)) { ?>
    <p style=" color: #666666;">หมายเหตุ : <?php echo $note; ?></p>
<?php } ?>


<script type="text/javascript">
    function report() {

        /*var loading = "<div class='progress'>"
         + "<div class='indeterminate'></div>"
         + "</div>";
         $("#showTable").html(loading); */
        $("#loading").show();
        var url = "<?php echo Yii::app()->createUrl($controller) ?>";
        var data = $("#formFilter").serialize();
        //alert(url);
        $.post(url, data, function (result) {
            //alert(result);
            $("#loading").hide();
            $("#showTable").html(result);
        });

    }

    function loadFilter(reportId, lvId) {
        var id = $("#lv" + (lvId - 1)).val();
        if (id.length > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl("/report/Template/RowFilter") ?>",
                data: {reportId: reportId, lvId: lvId, upperId: id}
            }).done(function (data) {
                //alert(data);
                if (lvId == 2) {
                    $("#lv2").remove();
                    $("#d12").remove();
                    $("#d22").remove();
                    $("#lv3").remove();
                    $("#d13").remove();
                    $("#d23").remove();
                } else if (lvId == 3) {
                    $("#lv3").remove();
                    $("#d13").remove();
                    $("#d23").remove();
                }
                $("#showRowFilter").append(data);
            }).fail(function (x, e) {
                alert("มีข้อผิดพลาด!!!");
            });
        } else {
            if (lvId == 2) {
                $("#lv2").remove();
                $("#d12").remove();
                $("#d22").remove();
                $("#lv3").remove();
                $("#d13").remove();
                $("#d23").remove();
            } else if (lvId == 3) {
                $("#lv3").remove();
                $("#d13").remove();
                $("#d23").remove();
            }
        }
    }

    $(document).ready(function () {
        if ($("#lv1").val() != "" && $("#lv1").length > 0)
            loadFilter("<?php echo $_GET['report_id']; ?>", "2");
    });

    function shownote() {
        $("#note").openModal();
    }

</script>


