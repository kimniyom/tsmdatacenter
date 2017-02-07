<?php

/**
 * Description of TemplateController
 *
 * @author Sittipong Promhan
 * @create 18 ธ.ค. 2557 11:23:46
 * @copyright (c) Tak Provincial Health Office
 */
class TemplateController extends Controller{
    
    public function actionDynamics(){
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        $rs = $report->find("id = $report_id");
        $showAllFlag = $rs->showall;
        $lvId = 1;
        
        $data['controller'] = $rs->controller;
        $data['info'] = $rs->source;
        $data['note'] = str_replace(" ","&nbsp;",str_replace("\n", "<BR/>", $rs->note));
        $data['filter'] = $this->getFilter($report_id,$rs->period_id,$showAllFlag);
        $data['rowFilter'] = $this->getRowFilter($report_id,$lvId);
        $this->renderPartial('//template/dynamics',$data);
    }
    
    private function getRowFilter($reportId,$lvId,$upperId=''){
        $report = new SysReportlist();
        $rs = $report->find("id = $reportId");
               
        $items = new SysItems();
        
        $sql = "SELECT MAX(levelid) AS maxLevel FROM sys_items WHERE delete_flag = 0 AND item_group_id = $rs->row_group_id";
        $maxLevel = Yii::app()->db->createCommand($sql)->queryScalar();
        
        if($maxLevel > 1){
            $where = "delete_flag = 0 AND item_group_id = $rs->row_group_id AND levelid = $lvId";
            /*Update By Kimniyom 10/07/2559
            if(Yii::app()->session['distId'] != "6300" && Yii::app()->session['distId'] != "6310" && $lvId == 1){
                $where .= " AND item_code = '".Yii::app()->session['distId']."'";
            }
            */
     
            if($upperId != '') $where .= " AND upper_item_id = $upperId";
            $item = $items->findAll($where." ORDER BY order_number,id");

            if(count($item) > 0 && $lvId < $maxLevel){
                $filter = '<div class="col s12 m4 l4" id="d1'.$lvId.'">';
                $filter .= '<label id="d2'.$lvId.'">'.$this->getHeaderName($rs->row_group_id,$lvId).'</label>';
                if($lvId == $maxLevel){
                    $filter .= "<select name='lv$lvId' id='lv$lvId' class='browser-default'>";
                }else{
                    $filter .= "<select name='lv$lvId' id='lv$lvId' class='browser-default' onchange=\"loadFilter('$reportId','".($lvId+1)."');\" >";
                }

                //if(count($item) > 1) 
                    $filter .= "<option value=''>--- ทั้งหมด ---</option>";
                foreach($item as $i):
                    $filter .= "<option value='$i->id'>$i->item_name</option>";
                endforeach;
                $filter .= "</select>";
                $filter .= "</div>";
                unset($item);
            }else{
                $filter = "";
            }
        }else{
            $filter = "";
        }
        return $filter;
    }
    
    private function getHeaderName($rowGroupId, $levelId) {
        $itemGroup = new SysItemGroups();
        $groups = $itemGroup->find("id = $rowGroupId");

        $arrGroup = explode("->", $groups->item_group_name);

        if (count($arrGroup) >= ($levelId - 1))
            return $arrGroup[$levelId - 1];
        else
            return $arrGroup[0];
    }
    
    public function actionRowFilter(){
        $reportId = $_POST['reportId'];
        $lvId = $_POST['lvId'];
        $upperId= $_POST['upperId'];
        echo $this->getRowFilter($reportId, $lvId,$upperId);
    }
    
    private function getFilter($reportId,$periodId,$showAllFlag = 0){
        $year = date("Y");
     
        if($year < 2400) $year += 543;
       
        if($periodId != 2){
            $m = date("m");
            if($m > 9){
                $year += 1;
            }
        }

        
        $filter = new Filter();
        //$str = '<form class="form-inline" role="form">';
        $str = '<input type="hidden" id="reportId" value="'.$reportId.'">';
        //$periodId = 4;
       // $filter->setComboBoxOption("onchange='loadRecordList($reportId);'");
        $defaultYear = (date("Y")-2) + 543;
        if($periodId == 1){       
            //$str .= '<div class="form-group">';
            $str .= '<div class="col s12 m4 l4">';
            $str .= '<label>ปีงบประมาณ</label>';
            $str .= $filter->yearComboBox('budgetyear',$year,'','budgetyear','browser-default',$defaultYear);
            $str .= '</div>';    
        }else if($periodId == 2){  
            //$str .= '<div class="form-group">';
            $str .= '<div class="col s12 m4 l4">';
            $str .= '<label>ปี พ.ศ.</label>';
            $str .= $filter->yearComboBox('budgetyear',$year,'','budgetyear','browser-default',$defaultYear);
            $str .= '</div>';    
        }else if($periodId == 3){
            //$str .= '<div class="form-group">';
            $str .= '<div class="col s12 m4 l4">';
            $str .= '<label>ปีงบประมาณ</label>';
            $str .= $filter->yearComboBox('budgetyear',$year,'','budgetyear','browser-default',$defaultYear);
            $str .= '</div>';    
          
            if($showAllFlag == 0){
                //$str .= '&nbsp;&nbsp;<div class="form-group">';
                $str .= '<div class="col s12 m4 l4">';
                $str .= '<label>ไตรมาส</label>';
                $str .= $filter->quarterComboBox("period",$value,"","period","browser-default");
                $str .= '</div>';  
            }
            
        }else if($periodId == 4){
            //$str .= '<div class="form-group">';
            $str .= '<div class="col s12 m4 l4">';
            $str .= '<label>ปีงบประมาณ</label>';
            $str .= $filter->yearComboBox('budgetyear',$year,'','budgetyear','browser-default',$defaultYear);
            $str .= '</div>';    
            if($showAllFlag == 0){
                //$str .= '&nbsp;&nbsp;<div class="form-group">';
                $str .= '<div class="col s12 m4 l4">';
                $str .= '<label>เดือน</label>';
                $str .= $filter->monthBudgetComboBox("period",$value,"","period","browser-default");
                $str .= '</div>';  
            }
        }else{
            $str = "ไม่ได้ตั้งค่าช่วงเวลา";
        }
        
        return $str;
    }
}

?>
