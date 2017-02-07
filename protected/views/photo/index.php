<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'Photo',
);

$ModelAlbum = new Album();
?>
<button type="button" class="btn btn-success" onclick="Addalbum(1)"><i class="fa fa-plus"></i> สร้างกิจกรรม</button><br/><br/>
<div class="panel panel-default">
    <div class="panel-heading">รูปภาพกิจกรรม</div>
    <div class="panel-body">
        <div class="row">
            <?php
            foreach ($album as $rs):
                $images = $ModelAlbum->GetfirstAlbum($rs['id']);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="container-card set-views-card box-all" style=" background: #f9f9f9;">
                        <a href="<?php echo Yii::app()->createUrl('photo/view/', array('id' => $rs['id'])) ?>">
                            <div class="img-wrapper">
                                <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/photo/<?php echo $images; ?>" class="img-responsive img-polaroid img-news-all" style="height:250px;"/>
                            </div>
                            <p class="detail">
                                <?php echo $rs->title ?><br/>
                                <font style=" font-size: 12px;" class="pull-right"><?php echo $rs['create_date'] ?></font>
                            </p>
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" id="btn-card"> ลบ</button>
                        <a href="<?php echo Yii::app()->createUrl('photo/view/', array('id' => $rs['id'])) ?>">
                            <button type="button" class="btn btn-primary btn-sm" id="btn-card" style=" margin-right: 92px;"> เพิ่มรูปภาพ</button></a>
                        <button type="button" class="btn btn-warning btn-sm" id="btn-card" style=" margin-right: 40px;" onclick="Update('<?php echo $rs['id'] ?>', '<?php echo $rs['title'] ?>', '<?php echo $rs['detail'] ?>')"> แก้ไข</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!--
    ## ADD Activity ##
-->
<div class="modal fade" tabindex="-1" role="dialog" id="popup-add-album">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่มรูปภาพกิจกรรม</h4>
            </div>
            <div class="modal-body">
                <label>ชื่อกิจกรรม : </label>
                <input type="hidden" class="form-control" id="id" />
                <input type="text" class="form-control" id="title" />
                <label>รายละเอียด : </label>
                <textarea class="form-control" rows="5" id="detail"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="Save()" id="btn-save">Save</button>
                <button type="button" class="btn btn-success" onclick="Edit()" id="btn-update">Update</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).ready(function () {

    });

    function clearTxt() {
        $("#title").val('');
        $("#detail").val('');
    }

    function Addalbum(flag) {
        if (flag == '1') {
            clearTxt();
            $("#btn-update").hide();
            $("#btn-save").show();
        } else {
            $("#btn-save").hide();
            $("#btn-update").show();
        }
        $("#popup-add-album").modal();
    }

    function Save() {
        var url = "<?php echo Yii::app()->createUrl('photo/savealbum') ?>";
        var title = $("#title").val();
        var detail = $("#detail").val();
        var data = {title: title, detail: detail}
        if (title == "") {
            $("#title").focus();
            return false;
        }
        $.post(url, data, function (datas) {
            var id = datas.id;
            var url2 = "<?php echo Yii::app()->createUrl('photo/view') ?>" + "/id/" + id;
            window.location = url2;
        }, 'Json');
    }

    function Update(id, title, detail) {
        $("#id").val(id);
        $("#title").val(title);
        $("#detail").val(detail);
        $("#btn-update").show();
        $("#btn-save").hide();

        Addalbum(0);
    }

    function Edit() {
        var url = "<?php echo Yii::app()->createUrl('photo/updatealbum') ?>";
        var id = $("#id").val();
        var title = $("#title").val();
        var detail = $("#detail").val();
        var data = {id: id, title: title, detail: detail}

        if (title == "") {
            $("#title").focus();
            return false;
        }
        $.post(url, data, function (datas) {
            clearTxt();
            window.location.reload();
        });
    }
</script>
