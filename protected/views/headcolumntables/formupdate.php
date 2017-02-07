<input type="hidden" id="columnID" value="<?php echo $detail['id'] ?>"/>
<div class="row">
    <label>ชื่อไทย</label>
    <input type="text" id="e_headname" value="<?php echo $detail['headname'] ?>"/>
</div>
<div class="row">
    <label>ชื่ออังกฤษ</label>
    <input type="text" id="e_headname_en" value="<?php echo $detail['headname_en'] ?>"/>
</div>
<div class="row">
    <div class="col m6 l6">
        <label>Colspan</label>
        <input type="number" id="e_colspan" value="<?php echo $detail['colspan'] ?>"/>
    </div>
    <div class="col m6 l6">
        <label>Upper</label>
        <input type="number" id="e_upper" value="<?php echo $detail['upper'] ?>"/>
    </div>
</div>
<div class="row">
    <div class="col m6 l6">
        <label>Rows</label>
        <input type="number" id="e_rows" value="<?php echo $detail['rows'] ?>"/>
    </div>
    <div class="col m6 l6">
        <label>Rowsnumber</label>
        <input type="number" id="e_rowsnumber" value="<?php echo $detail['rowsnumber'] ?>"/>
    </div>
</div>

