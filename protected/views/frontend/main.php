<style type="text/css">
    #t_input tr td{
        padding: 5px;

    }

    #showRecordEdit table tr td{
        padding: 5px;
        color: #339900;
    }

    #showRecordEdit table tr td input{
        padding: 0px;
        margin: 0px;
    }

    #recordEdit {max-height: 100% !important ; width: 80%; height: 90% !important; overflow-y: hidden !important; top:-5px;bottom: 20px;}

    input[type='text']{
        font-size: 20px;
        padding-left: 20px;
    }

    .input-group-addon{
        font-size: 20px;
    }
</style>    

<style type="text/css"> 
    .cuttext
    {
        white-space:nowrap; 
        width:97%; 
        overflow:hidden;
       
        text-overflow:ellipsis;
        padding-bottom: 3px;
    }
</style>

<a href="<?php echo Yii::app()->createUrl('frontend/ReportList', array('groupid' => $groupId, 'groupname' => $groupname)) ?>">
    <button type="button" class="waves-effect waves-light  btn-floating grey">
        <i class="mdi-hardware-keyboard-backspace"></i>
    </button></a>
<font style=" font-size: 25px;" ><?php echo $name; ?></font> <br/>
<font style=" font-size: 18px; margin-left: 40px;">(ที่มา : <?php echo $source; ?>)</font> 
<hr/>
<div class="row">
    <div class="col s12 m4 l4">
        <span class="card-title"></span>
        <?php echo $filter; ?>
    </div>
</div>

<div class="col s12 m12 l12">
    <div class="card-content" id="showList"></div>
</div>

<!--div class="panel panel-primary" id="showList">

</div-->

<!-- Modal -->
<div class="modal modal-fixed-footer" id="recordEdit">
    <div class="modal-header white" style="padding: 5px; padding-left: 15px;">
        <h4 class="cuttext" title="<?php echo $name; ?>"><?php echo $name; ?></h4>
    </div>
    <div class="modal-content " style=" padding:0px 0px 70px 0px;">
        <div class="card-content" id="showRecordEdit"></div>
    </div>
    <div class="modal-footer" id="saveButton">
        <button type="button" class="btn btn-primary" id="recordSave" onclick="recordSave();">บันทึก</button>          
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
    </div>
</div>



<div class="modal" id="loading" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" >
                <img src="<?php echo Yii::app()->baseUrl; ?>/images/loading.gif" />
            </div>
        </div>
    </div>
</div>

<script language ="JavaScript">
    $(document).ready(function () {
        var img = "<img src='<?php echo Yii::app()->baseUrl; ?>/images/ajax-loader.gif' />";
        $("#showList").html(img);
        loadRecordList($("#reportId").val());
    });
    
</script>