<?php

/**
 * Description of DynamicsController
 *
 * @author Sittipong Promhan
 * @create 17 ธ.ค. 2557 10:57:56
 * @copyright (c) Tak Provincial Health Office
 */
class DynamicsController extends Controller {

    //private $rowSum = array();

    public function actionGenReport() {

        $reportId = Yii::app()->request->getPost('reportId');
        $budGetYear = Yii::app()->request->getPost('budgetyear');
        $Inputperiod = Yii::app()->request->getPost('period');
        $period = isset($Inputperiod) ? $Inputperiod : "0";


        
        
        if (isset($_POST['lv3'])) {
            $id = $_POST['lv3'];
            if ($id == ""){
                $levelId = 3;
                $id = $_POST['lv2'];
            }else{
                $levelId = 4;
            }
        }else if (isset($_POST['lv2'])) {
            $id = $_POST['lv2'];
            if ($id == ""){
                $id = $_POST['lv1'];
                $levelId = 2;
            }else{
                $levelId = 3;
            }
       }else if(isset($_POST['lv1'])){
            $id = $_POST['lv1'];

            if($id == ""){
                $levelId = 1;
            }else{
                $levelId = 2; 
            }
        }else {
            $levelId = 1;
        }

        // clear variable for store summary
        $this->colSum = array();
        //$this->rowSum = array();
        //$budGetYear = '2557';
        // $period = 0;
        //$reportId = 1;
        //$levelId = 1;

        $reports = new SysReportlist();

        $report = $reports->find("id = $reportId");

        $listFlag = $report->showall; //(period = 3,4)แสดงแยก เดือน หรือ ไตรมาส
        $periodId = $report->period_id;
        $colGroupId = $report->col_group_id;
        $rowGroupId = $report->row_group_id;
        $reportShowType = $report->showtype;

        //$results = $this->getResults($reportId, $budGetYear, $period, $rowGroupId, $levelId);

        $this->setMaxLevel($colGroupId);
        $this->setMaxRowLevel($rowGroupId);
        //$table = "reportid=$reportId ,budGetYear=$budGetYear ,period=$period ,levelId=$levelId ,id=$id";
        // get header row name

        $table = "<table id='ReportTable' class='stripe row-border order-column cell-border' cellspacing='0' width='100%'>";
          
        if($listFlag == 1){
            $table .= $this->genColsPeriod($reportShowType,$colGroupId, $budGetYear,$periodId,$levelId,$rowGroupId, $this->getHeaderName($rowGroupId, $levelId));
        }else{
            $table .= $this->genCols($reportShowType,$colGroupId, $budGetYear, $period, $levelId,$rowGroupId, $this->getHeaderName($rowGroupId, $levelId));
        }

        
        
        if ($levelId > 1) {
            if($listFlag == 1){
                $results = $this->getResultsPeriod($reportShowType,$reportId, $budGetYear, $rowGroupId, $levelId, $id);
                $table .= $this->genRowsPeriod($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $periodId, $levelId, $results, $id);
            }else{
                $results = $this->getResults($reportShowType,$reportId, $budGetYear, $period, $rowGroupId, $levelId, $id, $listFlag);
                $table .= $this->genRows($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $period, $levelId, $results, $id);
            }
        } else {
            if($listFlag == 1){
                $results = $this->getResultsPeriod($reportShowType,$reportId, $budGetYear, $rowGroupId, $levelId);
                $table .= $this->genRowsPeriod($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $periodId, $levelId, $results);
            }else{
                $results = $this->getResults($reportShowType,$reportId, $budGetYear, $period, $rowGroupId, $levelId, $listFlag);
                $table .= $this->genRows($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $period, $levelId, $results);
            }
        }

        $table .= "</table>";

        //$table .= "<BR/>".print_r($this->arrColId);

        $data['table'] = $table;
        //$data['table'] = "colid = ".print_r($results);
        if($reportShowType == 2 && $levelId > 1){
            $data['colLock'] = ($this->maxRowLevel - $levelId) + 1;
        }else{
            $data['colLock'] = "1";
        }
//echo $data['table'];
       $this->renderPartial('//reports/dynamics', $data);
        //$this->render('//reports/dynamics', $data);
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

    private function setMaxLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
    private function setMaxRowLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxRowLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }

    /*
      private function genCols($itemGroupId){
      $str = "<thead>";
      $this->arrColId = array();
      for($i = 1; $i <= $this->maxLevel; $i++){
      //$column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i");

      $sql = "SELECT i1.* FROM sys_items i1
      LEFT JOIN sys_items i2 ON i2.id = i1.upper_item_id AND i2.delete_flag = 0
      WHERE i1.item_group_id = $itemGroupId AND i1.levelid = $i AND i1.delete_flag = 0
      ORDER BY i2.order_number,i2.id,i1.order_number,i1.id";
      $column = Yii::app()->db->createCommand($sql)->queryAll();

      $str .= "<tr>";

      if($i == 1) $str .= "<th rowspan='$this->maxLevel'>อำเภอ</th>";

      foreach($column as $col):
      // เก็บค่า colid ที่ต้องแสดงผล
      if($col['under_level'] == 0){
      $this->arrColId[] = $col['id'];
      }

      $rowspan = $this->getRowSpan($col['id']);
      $colspan = $this->getColSpan($col['id']);

      $str .= "<th ";

      if($rowspan > 1) $str .= " rowspan='".$rowspan."'";
      if($colspan > 1) $str .= " colspan='".$colspan."'";

      $str .= ">".$col['item_name']."</th>";
      endforeach;
      $str .= "</tr>";
      }

      $str .= "</thead>";

      return $str;
      }
     */

    private function genCols($reportShowType,$itemGroupId,$budGetYear,$period,$levelId,$rowGroupId,$headerGroupName="อำเภอ") {
        $items = new SysItems();
        
        $str = "<thead>";
        $this->arrColId = array();
        
        $strColId = "";

        $tmpCol = array();
        $tmpCol2 = array();
                
        for ($i = 1; $i <= $this->maxLevel; $i++) {


            if ($i == 1) {
                $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i ORDER BY order_number+0,id");

                $tmpCol = $column;
                $str .= "<tr>";
                
                if($reportShowType == 2 && $levelId > 1){
                      /*
                        * แสดงหัวตารางทุกระดับ
                        */
                       //$arrUpper = array();
                        $itemGroups = new SysItemGroups();
                        $itemGroup = $itemGroups->findByPk($rowGroupId);

                       $arrUpper = explode("->",substr($itemGroup->item_group_name,0));

                       for($y = $levelId-1; $y < $this->maxRowLevel; $y++){
                           $str .= "<th rowspan='".$this->maxLevel."'>".$arrUpper[$y]."</th>";
                       }
                       /****************************************************/
                }else{
                    $str .= "<th rowspan='".($this->maxLevel)."'>$headerGroupName</th>";
                }
                
                // แสดงปี
                //$countItem = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND under_level = 0");   
                //$str .= "<th colspan='".count($countItem)."'>".($period==2?'ปี พ.ศ. ':'ปีงบประมาณ ').$budGetYear."</th>";
                //$str .= "</tr><tr>";
                     
                foreach ($column as $col):
                    // เก็บค่า colid ที่ต้องแสดงผล
                    //if ($col['under_level'] == 0) {
                        $strColId .= "|".$col['id'];
                    //}

                    $rowspan = $this->getRowSpan($col['id']);
                    $colspan = $this->getColSpan($col['id']);
                  
                    $str .= "<th ";

                    if ($rowspan > 1)
                        $str .= " rowspan='" . $rowspan . "'";
                    if ($colspan > 1)
                        $str .= " colspan='" . $colspan . "'";

                    $str .= ">" . $col['item_name'] ."</th>";
                    //$str .= ">" . $col['item_name'] . " id=".$col['id']. "</th>";
                endforeach;
                $str .= "</tr>";
            }else {
                $str .= "<tr>";
                foreach ($tmpCol as $c):
                    $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i AND upper_item_id = $c->id ORDER BY order_number+0,id");

                    $tmpCol2 = array_merge($tmpCol2, $column);

                    $strColId2 = "";
                    foreach ($column as $col):
                        // เก็บค่า colid ที่ต้องแสดงผล
                        //if ($col['under_level'] == 0) {
                            $strColId2 .= "|".$col['id'];
                        //}

                        $rowspan = $this->getRowSpan($col['id']);
                        $colspan = $this->getColSpan($col['id']);
                        
                        $str .= "<th ";

                        if ($rowspan > 1)
                            $str .= " rowspan='" . $rowspan . "'";
                        if ($colspan > 1)
                            $str .= " colspan='" . $colspan . "'";

                        $str .= ">" . $col['item_name'] ."</th>";
                        //$str .= ">" . $col['item_name'] . " id=".$col['id'] . "</th>";
                    endforeach;
                    if(strlen($strColId2) > 0)
                        $strColId = str_replace("|".$c->id, $strColId2, $strColId);
                endforeach;
                $str .= "</tr>";
                $tmpCol = $tmpCol2;
            }
            /*
              $sql = "SELECT i1.* FROM sys_items i1
              LEFT JOIN sys_items i2 ON i2.id = i1.upper_item_id AND i2.delete_flag = 0
              WHERE i1.item_group_id = $itemGroupId AND i1.levelid = $i AND i1.delete_flag = 0
              ORDER BY i2.order_number,i2.id,i1.order_number,i1.id";
              $column = Yii::app()->db->createCommand($sql)->queryAll();
             */


            /* foreach($column as $col):
              // เก็บค่า colid ที่ต้องแสดงผล
              if($col['under_level'] == 0){
              $this->arrColId[] = $col['id'];
              }

              $rowspan = $this->getRowSpan($col['id']);
              $colspan = $this->getColSpan($col['id']);

              $str .= "<th ";

              if($rowspan > 1) $str .= " rowspan='".$rowspan."'";
              if($colspan > 1) $str .= " colspan='".$colspan."'";

              $str .= ">".$col['item_name']."</th>";
              endforeach;
              $str .= "</tr>"; */
        }

        $str .= "</thead>";
        
        if(substr($strColId,0,1) == "|") $strColId = substr($strColId,1,strlen($strColId));
        
        $this->arrColId = array_filter(explode("|", $strColId));

        return $str;
    }
    
    private function genColsPeriod($reportShowType, $itemGroupId, $budGetYear, $periodId,$levelId,$rowGroupId, $headerGroupName = "อำเภอ") {
        $items = new SysItems();
        
      
        $str = "<thead>";
        $this->arrColId = array();

        $strColId = "";

        $tmpCol = array();
        $tmpCol2 = array();

        $listCol = array();
        $countItem = count($items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND under_level = 0"));
        //$countItemAll = $countItem;
        if ($periodId == 4) {
            //$countItemAll = $countItem * 12;
            $listCol = $this->monthName;
           
        } else if ($periodId == 3) {
            //$countItemAll = $countItem * 4;
            $listCol = $this->trimasName;
        } else {
            $listCol = array();
            for($i = $budGetYear; $i > ($budGetYear - 3); $i--){
                $listCol[] = $i; 
            }
        }

        $str .= "<tr>";
         if($reportShowType == 2 && $levelId > 1){
                /*
                  * แสดงหัวตารางทุกระดับ
                  */
                 //$arrUpper = array();
                $itemGroups = new SysItemGroups();
                $itemGroup = $itemGroups->findByPk($rowGroupId);

                 $arrUpper = explode("->",substr($itemGroup->item_group_name,0));

                 for($y = $levelId-1; $y < $this->maxRowLevel; $y++){
                     $str .= "<th rowspan='".($this->maxLevel+1)."'>".$arrUpper[$y]."</th>";
                 }
                 /****************************************************/
          }else{
            $str .= "<th rowspan='" . ($this->maxLevel+1) . "'>$headerGroupName</th>";
          }

        // แสดงปี

      //  $str .= "<th colspan='" . $countItemAll . "'>".($periodId==2?'ปี พ.ศ. ':'ปีงบประมาณ ').$budGetYear."</th>";
       // $str .= "</tr>";

     //       $str .= "<tr>";
            foreach($listCol as $lc):
                $str .= "<th colspan='" . $countItem . "'>$lc</th>";
            endforeach;

            $str .= "</tr>";
       // }


        for ($i = 1; $i <= $this->maxLevel; $i++) {

            $str .= "<tr>";
            if ($i == 1) {
                //$str .= "<tr>";
                foreach (array_keys($listCol) as $l) {
                    $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i ORDER BY order_number+0,id");

                    $tmpCol = $column;
                    foreach ($column as $col):
                        // เก็บค่า colid ที่ต้องแสดงผล
                        //if ($col['under_level'] == 0) {
                        $strColId .= "|" . $l.$col['id'];
                        //}

                        $rowspan = $this->getRowSpan($col['id']);
                        $colspan = $this->getColSpan($col['id']);

                        $str .= "<th ";

                        if ($rowspan > 1)
                            $str .= " rowspan='" . $rowspan . "'";
                        if ($colspan > 1)
                            $str .= " colspan='" . $colspan . "'";

                        $str .= ">" . $col['item_name'] . "</th>";
                    //$str .= ">" . $col['item_name'] . " id=".$col['id']. "</th>";
                    endforeach;
                   
                }
                // $str .= "</tr>";
            }else {
               // $str .= "<tr>";
                foreach (array_keys($listCol) as $l) {
                    
                    foreach ($tmpCol as $c):
                        $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i AND upper_item_id = $c->id ORDER BY order_number+0,id");

                        $tmpCol2 = array_merge($tmpCol2, $column);

                        $strColId2 = "";
                        foreach ($column as $col):
                            // เก็บค่า colid ที่ต้องแสดงผล
                            //if ($col['under_level'] == 0) {
                            $strColId2 .= "|" . $l.$col['id'];
                            //}

                            $rowspan = $this->getRowSpan($col['id']);
                            $colspan = $this->getColSpan($col['id']);

                            $str .= "<th ";

                            if ($rowspan > 1)
                                $str .= " rowspan='" . $rowspan . "'";
                            if ($colspan > 1)
                                $str .= " colspan='" . $colspan . "'";

                            $str .= ">" . $col['item_name'] . "</th>";
                        //$str .= ">" . $col['item_name'] . " id=".$col['id'] . "</th>";
                        endforeach;
                        if (strlen($strColId2) > 0)
                            $strColId = str_replace("|" . $l.$c->id, $strColId2, $strColId);
                    endforeach;
                }
               // $str .= "</tr>";
                $tmpCol = $tmpCol2;
            }
            $str .= "</tr>";

        }
        $str .= "</thead>";

        if (substr($strColId, 0, 1) == "|")
            $strColId = substr($strColId, 1, strlen($strColId));

        $this->arrColId = array_filter(explode("|", $strColId));

        return $str;
    }
    
    private function genRows($reportShowType, $reportId, $itemGroupId, $colGroupId, $budgetYear, $period, $levelId, $results, $upperItemId = '', $link = '') {
        $items = new SysItems();

        $reports = new SysReportlist();
        $report = $reports->find("id = $reportId");
        
        $sql = "SELECT COUNT(*) FROM sys_items WHERE 
              item_group_id = $colGroupId AND under_level = 0 AND delete_flag = 0";

        $record = Yii::app()->db->createCommand($sql)->queryScalar();

        $tableRow = "<tbody>";

        if($reportShowType == 2 && $levelId > 1){
            $item_rs = $items->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND under_level = 0 AND upper_item_all LIKE '%|$upperItemId|%' ORDER BY upper_item_id,order_number,id");
        }else{
            if ($upperItemId == '') {
                $item_rs = $items->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");
            } else {
                $item_rs = $items->findAll("delete_flag = 0 AND levelid = $levelId and (upper_item_id = $upperItemId OR id = $upperItemId) ORDER BY order_number,id");
            }
        }

        foreach ($item_rs as $item):

            $rowColor = "";
            if ($this->isCompleted($reportId, $itemGroupId, $item['id'], $budgetYear, $period, $record) > 0) {
                $rowColor = "style='background-color: red'";
            }

            $tableRow .= "<tr $rowColor>";

            // แสดงหัวแถวของข้อมูล
            if($reportShowType == 2 && $levelId > 1){
                 $arrUpper = array();
            
                $upperAll = $item->upper_item_all;
                $upperAll = "|".$item->id.$item->upper_item_all;
                
                if(strlen($upperAll) > 0){
                    if(substr($upperAll,-1) == "|"){
                        $upperAll = substr($upperAll,0,strlen($upperAll)-2);
                    }
                    $arrUpper = explode("|",substr($upperAll,1));
                }

                /*
                 * แสดงข้อมูลแถวทุกระดับ
                 */
                for($i = $this->maxRowLevel-$levelId; $i >= 0; $i--){
                    $y = $i - ($this->maxRowLevel - count($arrUpper)); //แก้ไขกรณีบ้างอันมีลูกไม่เท่ากับ maxRowLevel แล้วแสดงผลผิดช่อง
                    if($y >= 0){
                        if(strlen($arrUpper[$y]) > 0){
                            $tableRow .= "<th style='text-align:left'>".$items->findByPk($arrUpper[$y])->item_name."</th>";
                        }else{
                            $tableRow .= "<th>&nbsp;</th>";
                        }
                    }else{
                        $tableRow .= "<th>&nbsp;</th>";
                    }
                }

            }else{
            
                if (strlen($link) > 0) {
                    $tableRow .= "<th><a href='" . $link . "'>" . $item['item_code'] . " - " . $item['item_name'] . "</a></th>";
                } else {
                    $itemCode = "";
                    if(strlen(trim($item['item_code'])) > 0) 
                        $itemCode = $item['item_code']." - ";
                    $tableRow .= "<th>" . $itemCode . $item['item_name'] . "</th>";
                }
            }

            /*
             * แสดงข้อมูล
             */

            for ($i = 0; $i < count($this->arrColId); $i++) {
                
                if(isset($results[$item['id']][$this->arrColId[$i]])){ // มีข้อมูล [ยังไม่ได้บันทึก]
                    if($results[$item['id']][$this->arrColId[$i]] == "T"){
                        $tableRow .= "<td style='text-align:center;'><img src='".Yii::app()->baseUrl."/images/Ok.png'  height='24' width='24'></td>";
                    }else if($results[$item['id']][$this->arrColId[$i]] == "F"){
                        $tableRow .= "<td>&nbsp;</td>";
                    }else{
                        $tableRow .= "<td>" . number_format($results[$item['id']][$this->arrColId[$i]]) . "</td>";
                    }
                    //$tableRow .= "<td>".$item['id']."-".$this->arrColId[$i]."</td>";
               
                    if($report->showsum == 1){
                        if (!isset($this->colSum[$this->arrColId[$i]])){
                            $this->colSum[$this->arrColId[$i]] = 0;
                        }
                        //if(!isset($this->rowSum[$item['id']])) $this->rowSum[$item['id']] = 0;

                        if($results[$item['id']][$this->arrColId[$i]] == "T" || $results[$item['id']][$this->arrColId[$i]] == "F"){
                            $this->colSum[$this->arrColId[$i]] = "";
                        }else{
                             $this->colSum[$this->arrColId[$i]] += $results[$item['id']][$this->arrColId[$i]];
                        }

                    }
                }else{ // ไม่มีข้อมูล [ยังไม่ได้บันทึก]
                    $tableRow .= "<td>0</td>";
                    if($report->showsum == 1){
                        if (!isset($this->colSum[$this->arrColId[$i]])){
                            $this->colSum[$this->arrColId[$i]] = 0;
                        }
                    }
                }
            }

            $tableRow .= "</tr>";
        endforeach;

        $tableRow .= "</tbody>";

        if($report->showsum == 1){
            
            $colspan = "";
            if($reportShowType == 2 && $levelId > 1){
                $colspan = " colspan='".(($this->maxRowLevel - $levelId) + 1)."'";
            }
            
            $tableRow .= "<tfoot>";
            $tableRow .= "<tr>";
            $tableRow .= "<th$colspan>รวม</th>";
            for ($i = 0; $i < count($this->arrColId); $i++) {
                $val = "";
                if($this->colSum[$this->arrColId[$i]] != "") 
                    $val = number_format($this->colSum[$this->arrColId[$i]]);
                $tableRow .= "<th>" . $val . "</th>";
            }

            $tableRow .= "</tr>";
            $tableRow .= "</tfoot>";
        }

        return $tableRow;
    }
    
    private function genRowsPeriod($reportShowType,$reportId, $itemGroupId, $colGroupId, $budgetYear, $periodId, $levelId, $results, $upperItemId = '', $link = '') {
        $items = new SysItems();
        
        $reports = new SysReportlist();
        $report = $reports->find("id = $reportId");

        $sql = "SELECT COUNT(*) FROM sys_items WHERE 
              item_group_id = $colGroupId AND under_level = 0 AND delete_flag = 0";

        $record = Yii::app()->db->createCommand($sql)->queryScalar();

        $tableRow = "<tbody>";

         if($reportShowType == 2 && $levelId > 1){
            $item_rs = $items->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND under_level = 0 AND upper_item_all LIKE '%|$upperItemId|%' ORDER BY upper_item_id,order_number,id");
        }else{
            if ($upperItemId == '') {
                $item_rs = $items->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");
            } else {
                $item_rs = $items->findAll("delete_flag = 0 AND levelid = $levelId and (upper_item_id = $upperItemId OR id = $upperItemId) ORDER BY order_number,id");
            }
        }

        foreach ($item_rs as $item):

            $rowColor = "";
          /*  if ($this->isCompleted($reportId, $itemGroupId, $item['id'], $budgetYear, $period, $record) > 0) {
                $rowColor = "style='background-color: red'";
            }*/

            $tableRow .= "<tr $rowColor>";

             if($reportShowType == 2 && $levelId > 1){
                 $arrUpper = array();
            
                $upperAll = $item->upper_item_all;
                $upperAll = "|".$item->id.$item->upper_item_all;
                
                if(strlen($upperAll) > 0){
                    if(substr($upperAll,-1) == "|"){
                        $upperAll = substr($upperAll,0,strlen($upperAll)-2);
                    }
                    $arrUpper = explode("|",substr($upperAll,1));
                }

                /*
                 * แสดงข้อมูลแถวทุกระดับ
                 */
                for($i = $this->maxRowLevel-$levelId; $i >= 0; $i--){
                    $y = $i - ($this->maxRowLevel - count($arrUpper)); //แก้ไขกรณีบ้างอันมีลูกไม่เท่ากับ maxRowLevel แล้วแสดงผลผิดช่อง
                    if($y >= 0){
                        if(strlen($arrUpper[$y]) > 0){
                            $tableRow .= "<th style='text-align:left'>".$items->findByPk($arrUpper[$y])->item_name."</th>";
                        }else{
                            $tableRow .= "<th>&nbsp;</th>";
                        }
                    }else{
                        $tableRow .= "<th>&nbsp;</th>";
                    }
                }

            }else{
                if (strlen($link) > 0) {
                    $tableRow .= "<th><a href='" . $link . "'>" . $item['item_code'] . " - " . $item['item_name'] . "</a></th>";
                } else {
                    $itemCode = "";
                    if(strlen($item['item_code']) > 0) 
                        $itemCode = $item['item_code']." - ";
                    $tableRow .= "<th>" . $itemCode . " - " . $item['item_name'] . "</th>";
                }
            }

            /*
             * แสดงข้อมูล
             */


            for ($i = 0; $i < count($this->arrColId); $i++) {
                //$tableRow .= "<td>" . number_format($results[$item['id']][$this->arrColId[$i]]) . "</td>";
                //$tableRow .= "<td>".$item['id']."-".$this->arrColId[$i]."</td>";
                if(isset($results[$item['id']][$this->arrColId[$i]])){ // มีข้อมูล [ยังไม่ได้บันทึก]
                    if($results[$item['id']][$this->arrColId[$i]] == "T"){
                        $tableRow .= "<td style='text-align:center;'><img src='".Yii::app()->baseUrl."/images/Ok.png'  height='24' width='24'></td>";
                    }else if($results[$item['id']][$this->arrColId[$i]] == "F"){
                        $tableRow .= "<td>&nbsp;</td>";
                    }else{
                        $tableRow .= "<td>" . number_format($results[$item['id']][$this->arrColId[$i]]) . "</td>";
                    }
                   
                 if($report->showsum == 1){
                  if (!isset($this->colSum[$this->arrColId[$i]]))
                        $this->colSum[$this->arrColId[$i]] = 0;
       
                        //$this->colSum[$this->arrColId[$i]] += $results[$item['id']][$this->arrColId[$i]];
                        if($results[$item['id']][$this->arrColId[$i]] == "T" || $results[$item['id']][$this->arrColId[$i]] == "F"){
                            $this->colSum[$this->arrColId[$i]] = "";
                        }else{
                             $this->colSum[$this->arrColId[$i]] += $results[$item['id']][$this->arrColId[$i]];
                        }
                     
                 }
                 }else{ // ไม่มีข้อมูล [ยังไม่ได้บันทึก]
                    $tableRow .= "<td>0</td>";
                    if($report->showsum == 1){
                        if (!isset($this->colSum[$this->arrColId[$i]])){
                            $this->colSum[$this->arrColId[$i]] = 0;
                        }
                    }
                }
            }

            $tableRow .= "</tr>";
        endforeach;

        $tableRow .= "</tbody>";
         if($report->showsum == 1){
            $colspan = "";
            if($reportShowType == 2 && $levelId > 1){
                $colspan = " colspan='".(($this->maxRowLevel - $levelId) + 1)."'";
            }
             
            $tableRow .= "<tfoot>";
            $tableRow .= "<tr>";
            $tableRow .= "<th$colspan>รวม</th>";
            for ($i = 0; $i < count($this->arrColId); $i++) {
                //$tableRow .= "<th>" . number_format($this->colSum[$this->arrColId[$i]]) . "</th>";
                
                $val = "";
                if($this->colSum[$this->arrColId[$i]] != "") 
                    $val = number_format($this->colSum[$this->arrColId[$i]]);
                $tableRow .= "<th>" . $val . "</th>";
            }

            $tableRow .= "</tr>";
            $tableRow .= "</tfoot>";
         }
         
        return $tableRow;
    }

   
    private function isCompleted($reportId, $itemGroupId, $id, $budgetYear, $period, $record) {
        
        $reports = new SysReportlist();
        $report = $reports->findByPk($reportId);
        
        if($report->checkinput){
            $sql = "SELECT COUNT(*) FROM (
                    SELECT COUNT(r.AMOUNT) AS C1 FROM sys_items i
                    LEFT JOIN results r ON r.COL_ITEM_ID = i.id AND r.REPORT_ID = $reportId AND r.BUDGETYEAR = '$budgetYear' AND r.PERIOD = $period
                    WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId AND (i.upper_item_all LIKE '%|$id|%' OR i.id = $id) AND i.under_level = 0
                    GROUP BY i.id
                    HAVING C1 != $record) q";

            return Yii::app()->db->createCommand($sql)->queryScalar();
        }else{
            return 0;
        }
    }

    private function getRowSpan($itemId) {
        $sql = "SELECT IF(under_level > 0,1,($this->maxLevel+1) - levelid) FROM sys_items WHERE id = '$itemId';";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    private function getColSpan($itemId) {
        $sql = "select count(*) from sys_items where delete_flag = 0 and upper_item_all like '%|$itemId|%' and under_level = 0;";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    private function getResults($reportShowType,$reportId, $budgetYear, $period, $itemGroupId, $levelId, $upperItemId = '') {
        $arrResults = array();

        $item = new SysItems();

        //$rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");

        if($reportShowType == 2 && $levelId > 1){
            $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND under_level = 0 AND upper_item_all LIKE '%|$upperItemId|%' ORDER BY upper_item_id,order_number,id");
        }else{
            if ($upperItemId == '') {
                $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");
            } else {
                $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND (upper_item_id = $upperItemId OR id = $upperItemId) AND levelid = $levelId ORDER BY order_number,id");
            }
        }
        foreach ($rows as $row):
            $sql = "SELECT r.ROW_ITEM_ID,ii.inputtype,SUM(r.AMOUNT) AS amount FROM sys_items i
                    INNER JOIN results r ON r.COL_ITEM_ID = i.id
                    LEFT JOIN sys_items ii ON ii.id = r.ROW_ITEM_ID
                    WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId AND (i.upper_item_all LIKE '%|$row->id|%' OR i.id = $row->id)
                    AND r.REPORT_ID = $reportId AND r.BUDGETYEAR = '$budgetYear' AND r.PERIOD = $period
                    GROUP BY r.ROW_ITEM_ID";

            $result = Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($result as $rs):
                $amount = $rs['amount'];
                if($rs['inputtype'] == 2){ // ถูกผิด
                    if($amount > 0) $amount = "T";
                    else $amount = "F";
                }
                $arrResults[$row->id][$rs['ROW_ITEM_ID']] = $amount;
            endforeach;
        endforeach;

        return $arrResults;
    }
    
    private function getResultsPeriod($reportShowType,$reportId, $budgetYear, $itemGroupId, $levelId, $upperItemId = '') {
        $arrResults = array();

        $item = new SysItems();

        //$rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");

         if($reportShowType == 2 && $levelId > 1){
            $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND under_level = 0 AND upper_item_all LIKE '%|$upperItemId|%' ORDER BY upper_item_id,order_number,id");
        }else{
            if ($upperItemId == '') {
                $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND levelid = $levelId ORDER BY order_number,id");
            } else {
                $rows = $item->findAll("delete_flag = 0 AND item_group_id = $itemGroupId AND (upper_item_id = $upperItemId OR id = $upperItemId) AND levelid = $levelId ORDER BY order_number,id");
            }
        }

        foreach ($rows as $row):
            $sql = "SELECT r.PERIOD,ii.inputtype,r.ROW_ITEM_ID,SUM(r.AMOUNT) AS amount FROM sys_items i
                    INNER JOIN results r ON r.COL_ITEM_ID = i.id
                    LEFT JOIN sys_items ii ON ii.id = r.ROW_ITEM_ID
                    WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId AND (i.upper_item_all LIKE '%|$row->id|%' OR i.id = $row->id)
                    AND r.REPORT_ID = $reportId AND r.BUDGETYEAR = '$budgetYear' 
                    GROUP BY r.PERIOD,r.ROW_ITEM_ID";

            $result = Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($result as $rs):
               // $arrResults[$row->id][$rs['PERIOD'].$rs['ROW_ITEM_ID']] = $rs['amount'];
                $amount = $rs['amount'];
                   if($rs['inputtype'] == 2){ // ถูกผิด
                       if($amount > 0) $amount = "T";
                       else $amount = "F";
                   }
                   $arrResults[$row->id][$rs['PERIOD'].$rs['ROW_ITEM_ID']] = $amount;
            endforeach;
        endforeach;

        return $arrResults;
    }
    
    
    private $maxLevel = 0;
    private $maxRowLevel = 0;
    // private $ColSpan = 0;
    private $arrColId = array();
    private $colSum = array();

    private $monthName = array( "10" => "ตุลาคม",
                                  "11" => "พฤศจิกายน",
                                  "12" => "ธันวาคม",
                                  "01" => "มกราคม",
                                  "02" => "กุมภาพันธ์",
                                  "03" => "มีนาคม",
                                  "04" => "เมษายน",
                                  "05" => "พฤษภาคม",
                                  "06" => "มิถุนายน",
                                  "07" => "กรกฎาคม",
                                  "08" => "สิงหาคม",
                                  "09" => "กันยายน");
      /*  private $monthName = array("ตุลาคม","พฤศจิกายน","ธันวาคม","มกราคม","กุมภาพันธ์","มีนาคม",
                                   "เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน");*/

      private $trimasName = array(1 => "ไตรมาสที่ 1",2 => "ไตรมาสที่ 2",3 => "ไตรมาสที่ 3",4 => "ไตรมาสที่ 4");

}

?>
