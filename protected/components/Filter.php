<?php
class Filter {

    private $filter = array();
    private $url = "";
    private $option_combo = "";
    private $classCombo = "browser-default";
    private $thaimonth = array("01" => "มกราคม"
        , "02" => "กุมภาพันธ์"
        , "03" => "มีนาคม"
        , "04" => "เมษายน"
        , "05" => "พฤษภาคม"
        , "06" => "มิถุนายน"
        , "07" => "กรกฎาคม"
        , "08" => "สิงหาคม"
        , "09" => "กันยายน"
        , "10" => "ตุลาคม"
        , "11" => "พฤศจิกายน"
        , "12" => "ธันวาคม");
    
    public function Filter() {
        
    }

    public function monthComboBox($name, $value = '', $default = '',$id='',$class='') {
        $str = "";

        $str .= "<select name='$name' id='$id' class='$class' $this->option_combo>";

        if (strlen($default) > 0)
            $str .= "<option value=''>" . $default . "</option>";

        for ($i = 1; $i < 13; $i++) {
            $m = $i;
            if ($i < 10)
                $m = '0' . $i;

            $sel = "";
            if ($m == $value)
                $sel = "selected";

            $str .= "<option value='$m' $sel>" . $this->thaimonth[$m] . "</option>";
        }
        $str .= "</select>";

        return $str;
    }
    
    /*
     * เดือนแบบปีงบประมาณ
     */
    public function monthBudgetComboBox($name, $value = '', $default = '',$id='',$class='') {
        $str = "";

        $str .= "<select name='$name' id='$id' class='$class' $this->option_combo>";

        if (strlen($default) > 0)
            $str .= "<option value=''>" . $default . "</option>";

        for ($i = 10; $i < 13; $i++) {
            
            $sel = "";
            if ($i == $value)
                $sel = "selected";

            $str .= "<option value='$i' $sel>" . $this->thaimonth[$i] . "</option>";
        }
        
        for ($i = 1; $i < 10; $i++) {
            $m = $i;
            if ($i < 10)
                $m = '0' . $i;

            $sel = "";
            if ($m == $value)
                $sel = "selected";

            $str .= "<option value='$m' $sel>" . $this->thaimonth[$m] . "</option>";
        }
        $str .= "</select>";

        return $str;
    }

    public function droupdown_month($name, $id = '', $class = '', $value = '', $option = '') {

        $str = "";

        $str .= "<select name='$name' id='$id' class='$class' $option $this->option_combo>";

        //if(strlen($default) > 0) $str .= "<option value=''>".$default."</option>";

        for ($i = 1; $i < 13; $i++) {
            $m = $i;
            if ($i < 10)
                $m = '0' . $i;

            $sel = "";
            if ($m == $value)
                $sel = "selected";

            $str .= "<option value='$m' $sel style='text-align:left;' >" . $this->thaimonth[$m] . "</option>";
        }
        $str .= "</select>";

        return $str;
    }
    
    public function quarterComboBox($name,$value ='', $default='',$id='',$class='',$textstart = '', $textend = ''){
        $str = "$textstart <select name='$name' id='$id' class='$class' $this->option_combo>";
        
        if (strlen($default) > 0) $str .= "<option value=''>" . $default . "</option>";

        for($i = 1; $i <= 4; $i++){
            $sel = "";
            if ($i == $value) $sel = "selected";
            
            $str .= "<option value='$i' $sel style='text-align: left;'>ไตรมาสที่ $i</option>";
        }

        $str .= "</select> $textend ";

        return $str;
    }

    public function yearComboBox($name, $value = '', $default = '', $id = '', $class = '', $start_year = 2546, $textstart = '', $textend = '') {
        $str = "";

        $yearNow = date('Y');
        $monthNow = date('m');

        if ($monthNow > 9)
            $yearNow += 1;
        if ($yearNow < 2400)
            $yearNow += 543;

        $str .= "$textstart <select name='$name' id='$id' class='$class' $this->option_combo>";

        if (strlen($default) > 0)
            $str .= "<option value=''>" . $default . "</option>";


        for ($i = $yearNow; $i >= $start_year; $i--) {

            $sel = "";
            if ($i == $value)
                $sel = "selected";

            $str .= "<option value='$i' $sel style='text-align: left;'>" . $i . "</option>";
        }
        $str .= "</select> $textend ";

        return $str;
    }

    public function yearComboBoxBuddhist($name, $value = '', $default = '', $id = '', $class = '', $start_year = 2546, $textstart = '', $textend = '') {
        $str = "";

        $yearNow = date('Y') - 1;

        if ($yearNow < 2400)
            $yearNow += 543;

        $str .= "$textstart <select name='$name' id='$id' class='$class' $this->option_combo>";

        if (strlen($default) > 0)
            $str .= "<option value=''>" . $default . "</option>";


        for ($i = $yearNow; $i >= $start_year; $i--) {

            $sel = "";
            if ($i == $value)
                $sel = "selected";

            $str .= "<option value='$i' $sel>" . $i . "</option>";
        }
        $str .= "</select> $textend ";

        return $str;
    }

    public function schoolYearComboBox($name, $value = '', $default = '', $id = '', $class = '', $start_year = 2546, $textstart = '', $textend = '') {
        $str = "";

        $yearNow = date('Y');
        $monthNow = date('m');

        if ($monthNow < 5) {
            $yearNow = date('Y') - '1';
        } else {
            $yearNow = date('Y');
        }
        if ($yearNow < 2400)
            $yearNow += 543;

        $str .= "$textstart <select name='$name' id='$id' class='$class' $this->option_combo>";

        if (strlen($default) > 0)
            $str .= "<option value=''>" . $default . "</option>";


        for ($i = $yearNow; $i >= $start_year; $i--) {

            $sel = "";
            if ($i == $value)
                $sel = "selected";

            $str .= "<option value='$i' $sel>" . $i . "</option>";
        }
        $str .= "</select> $textend ";

        return $str;
    }

    public function report_three_month_ComboBox($name, $value = '', $default = '', $id = '', $class = '', $textstart = '', $textend = '') {
        $three_month = array('----------------', 'ไตรมาสที่1', 'ไตรมาสที่2', 'ไตรมาสที่3', 'ไตรมาสที่4');
        $str = "";

        $str .= "$textstart <select name='$name' id='$id' class='$class' $this->option_combo>";

        for ($i = 0; $i <= count($three_month) - 1; $i++) {
            $sel = "";
            if ($i == $value)
                $sel = "selected";
            $str .= "<option value='$i' $sel>" . $three_month[$i] . "</option>";
        }
        $str .= "</select> $textend ";

        return $str;
    }

    public function three_month_ComboBox($name, $value = '', $default = '', $id = '', $class = '', $textstart = '', $textend = '') {
        // ไตรมาส ของ ปีงบประมาณ
        //$month = date('m');
        $three_month = array('ไตรมาสที่1', 'ไตรมาสที่2', 'ไตรมาสที่3', 'ไตรมาสที่4');
        $results = array('1', '2', '3', '4');
        $str = "";

        $str .= "$textstart <select name='$name' id='$id' class='$class'>";
        for ($i = 0; $i <= count($three_month) - 1; $i++) {
            $sel = "";
            if ($results[$i] == $value)
                $sel = "selected";
            $str .= "<option value='$results[$i]' $sel>" . $three_month[$i] . "</option>";
        }
        $str .= "</select> $textend ";

        return $str;
    }

    public function vccComboBox($name, $value = '', $default = '') {
        $sql = "select * from mas_vcc";
        $result = mysql_query($sql);

        $str = "";
        $str .= "<select name='$name'>";

        if (strlen($default) > 0)
            $str .= "<option value='010'>" . $default . "</option>";
        $sel = "";
        while ($fetch = mysql_fetch_array($result)) {
            $vcccode = $fetch['VCCCODE'];
            $vccname = $fetch['VCC_THAI_NAME'];
            if ($vcccode == $value) {
                $str .= "<option value='$vcccode' selected='selected'>" . $vccname . "</option>";
            } else {
                $str .= "<option value='$vcccode'>" . $vccname . "</option>";
            }
        }

        $str .= "</select>";
        return $str;
    }

    public function distComboBox($name, $value = '', $default = '', $type) {
        if ($type == '0') {
            $sql = "select * from co_district";
            $result = mysql_query($sql);

            $str = "";
            $str .= "<select name='$name'>";

            if (strlen($default) > 0)
                $str .= "<option value=''>" . $default . "</option>";
            $sel = "";
            while ($fetch = mysql_fetch_array($result)) {
                $distid = $fetch['distid'];
                $distname = $fetch['distname'];
                if ($distid == $value) {
                    $str .= "<option value='$distid' selected='selected'>" . $distname . "</option>";
                } else {
                    $str .= "<option value='$distid'>" . $distname . "</option>";
                }
            }
        } else if ($type == '1') {
            $sql = "select * from co_office where off_type in('06','07','12','00') ";
            $result = mysql_query($sql);

            $str = "";
            $str .= "<select name='$name'>";

            if (strlen($default) > 0)
                $str .= "<option value=''>" . $default . "</option>";
            $sel = "";
            while ($fetch = mysql_fetch_array($result)) {
                $distid = $fetch['off_id'];
                $distname = $fetch['off_name'];
                if ($distid == $value) {
                    $str .= "<option value='$distid' selected='selected'>" . $distname . "</option>";
                } else {
                    $str .= "<option value='$distid'>" . $distname . "</option>";
                }
            }
        } else {
            $sql = "select * from co_office where off_type not in('06','07','12','00') ";
            $result = mysql_query($sql);

            $str = "";
            $str .= "<select name='$name'>";

            if (strlen($default) > 0)
                $str .= "<option value=''>" . $default . "</option>";
            $sel = "";
            while ($fetch = mysql_fetch_array($result)) {
                $distid = $fetch['off_id'];
                $distname = $fetch['off_name'];
                if ($distid == $value) {
                    $str .= "<option value='$distid' selected='selected'>" . $distname . "</option>";
                } else {
                    $str .= "<option value='$distid'>" . $distname . "</option>";
                }
            }
        }

        $str .= "</select>";
        return $str;
    }

    public function addFilter($filter, $title = '') {
        $ft = "";
        if (strlen($title) > 0)
            $ft .= "<span>" . $title . "</span>";
        $ft .= "<span>" . $filter . "</span>";
        array_push($this->filter, $ft);
    }

    public function addInput($name, $value = '', $type, $option = '', $titel = '', $endtitel = '') {
        if ($type == 'submit') {
            $value = "ตกลง";
            //$option = "class='bnt_submit' onmouseover=\"className='bnt_submit_hover' \" onmouseout=\"className='bnt_submit' \"";
        }
        $button = $titel . " <input type='" . $type . "' name='" . $name . "' value='" . $value . "' $option>" . $endtitel;
        array_push($this->filter, $button);
    }

    public function button_s($name = '', $type = '', $value = '', $option = '') {
        $str = "<input name = '$name' type='$type' value='$value' $option/>";
        return $str;
    }

    public function text_default($name = '', $id = '', $option = '', $type = '') {
        $str = "<input name = '" . $name . "' id = '" . $id . "' type='$type' $option/>";
        return $str;
    }

    public function newLine() {
        array_push($this->filter, "<p></p>");
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function render() {
        $openForm = "<form id='formFilter' name='formFilter' class='formFilter' method='post' action='" . $this->url . "'>";
        $closeForm = "</form>";

        return $openForm . implode(' ', $this->filter) . $closeForm;
    }

    public function text($text = '') {
        return $text;
    }

    public function buttum($id = '', $class = '', $value = '', $option = '') {
        $str = "<div class = '$class' id = '$id' $option >";
        $str .= $value;
        $str .= "</div>";

        return $str;
    }

    public function formsubmit($action = '', $distid = '', $startMonth = '', $endtMonth = '', $startYear = '', $endYear = '', $value = '') {
        $str = "<form id='senddata' class='senddata' action='" . $action . "' method='post' style='margin:0px;'>
                <input type='hidden' id='distid' name='distid' value='" . $distid . "'/>
                <input type='hidden' id='startMonth' name='startMonth' value='" . $startMonth . "'/>
                <input type='hidden' id='endMonth' name='endMonth' value='" . $endtMonth . "'/>
                <input type='hidden' id='startYear' name='startYear' value='" . $startYear . "'/>
                <input type='hidden' id='endYear' name='endYear' value='" . $endYear . "'/>
                <input type='hidden' id='amName' name='amName' value='" . $value . "'/>
                <input type='submit' class='btn btn-inverse' value='" . $value . "'/>
            </form>";
        return $str;
    }

    public function setComboBoxOption($str = '') {
        return $this->option_combo = $str;
    }

    public function Combo_Amphur($name = '', $id = '', $class = '', $value = '') {
        $sql = "select * from co_district";
        $result = mysql_query($sql);

        $str = "อำเภอ ";
        $str .= "<select name='$name' id='$id' class='$class' $this->option_combo>";

        $str .= "<option value='0000'>ทั้งหมด</option>";
        $sel = "";
        while ($fetch = mysql_fetch_array($result)) {
            $distid = $fetch['distid'];
            $distname = $fetch['distname'];
            if ($distid == $value) {
                $str .= "<option value='$distid' selected='selected' style='text-align: left;'>" . $distname . "</option>";
            } else {
                $str .= "<option value='$distid' style='text-align: left;'>" . $distname . "</option>";
            }
        }

        $str .= "</select>";
        return $str;
    }

    public function box_div($id = '', $option = '') {
        $str = "<text id='$id' $option>";
        $str .= "</text>";

        return $str;
    }

    public function combo_pcu_insit($id = '', $class = '', $option = '', $id_user = '') {
        $sit = new privilege_model();
        $privilege = $sit->_get_privilege($id_user);
        $str = "<select id='$id' name='$id' class='$class'  $option>";
        foreach ($privilege->result() as $row):
            $str .= "<option style='text-align:left;' value='" . $row->HOSPCODE . "'>" . $row->HOSPCODE . " - " . $row->off_name . "</option>";
        endforeach;
        $str .= "</select>";

        return $str;
    }

    public function combo_diag($id = '', $class = '', $option = '') {
        $diag = new psychiatry_model();
        $combo = $diag->diag_all_search();
        $str = "<select id='$id' name='$id' class='$class'  $option>";
        foreach ($combo->result() as $row):
            $str .= "<option style='text-align:left;' value='" . $row->mapdisease . "'>" . $row->mapdisease . "</option>";
        endforeach;
        $str .= "</select>";

        return $str;
    }
    
    public function ComboBox_R506($name, $id = '', $class = '', $default='', $groupname1 = '',$value1 = '',$groupname2 = '',$value2 = '',$textstart = '', $textend = '') {
        $str = "";

        $str .= "$textstart <select name='$name' id='$id' class='$class' >";
        $str .= "<optgroup label='".$groupname1."'>";
        foreach ($value1 as $v1) {
            $sel = "";
            if ($v1['TDIS'] == $default)
                $sel = "selected";
            $str .= "<option style='text-align: left;' value='".$v1['TDIS']."' $sel>" . $v1['TDIS']."-".$v1['NTDIS'] ."</option>";
        }
        $str .= "</optgroup>";
        
        $str .= "<optgroup label='".$groupname2."'>";
        foreach ($value2 as $v2) {
            $sel = "";
            if ($v2['DIS'] == $default)
                $sel = "selected";
            $str .= "<option style='text-align: left;' value='".$v2['DIS']."' $sel>" . $v2['DIS']."-".$v2['NAME_THAI'] ."</option>";
        }
        $str .= "</optgroup>";
        
        $str .= "</select> $textend ";

        return $str;
    }
      
    
    public function periodCombobox($periodId,$value=''){
        //$filter = new Filter();
       // $str = '<form class="form-inline" role="form">';
        //$periodId = 4;
        //$filter->setComboBoxOption("onchange='loadRecordList();'");
        $str = "";
        
        if($periodId == 1){       
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $this->yearComboBox('budgetyear',$value,'','budgetyear','form-control','2557');
            $str .= '</div></div>';    
        }else if($periodId == 2){  
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปี พ.ศ.</div>';
            $str .= $this->yearComboBox('budgetyear',$value,'','budgetyear','form-control','2557');
            $str .= '</div></div>';    
        }else if($periodId == 3){
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $this->yearComboBox('budgetyear',$value,'','budgetyear','form-control','2557');
            $str .= '</div></div>';    
            $str .= '&nbsp;&nbsp;<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ไตรมาส</div>';
            $str .= $this->quarterComboBox("period",$value,"","period","form-control");
            $str .= '</div></div>';  
        }else if($periodId == 4){
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $this->yearComboBox('budgetyear',$value,'','budgetyear','form-control','2557');
            $str .= '</div></div>';    
            $str .= '&nbsp;&nbsp;<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">เดือน</div>';
            $str .= $this->monthComboBox("period",$value,"","period","form-control");
            $str .= '</div></div>';  
        }else{
            $str = "ไม่ได้ตั้งค่าช่วงเวลา";
        }
        
        //$str .= '&nbsp;&nbsp;<button type="button" onclick="loadRecordList();" class="btn btn-success">ค้นหา</button>';
       // $str .= "</form>";
        
        return $str;
    }
    
    public function filter_bg_color($color = null){
        if($color != ''){
            $c = $color;
        } else {
            $c = "";
        }
        return $c;
    }
    
    public function filter_text_color($color = null){
         if($color != ''){
            $c = $color;
        } else {
            $c = "green-text";
        }
        return $c;
    }
    
    public function filter_footer_color($color = null){
         if($color != ''){
            $c = $color;
        } else {
            $c = "";
        }
        return $c;
    }
    
    public function classcombo(){
        return $this->classCombo;
    }

}
