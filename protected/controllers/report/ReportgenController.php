<?php

/**
 * Description of ReportgenController
 *
 * @author Sittipong Promhan
 * @create Aug 10, 2016 2:38:26 PM
 * @copyright (c) Tak Provincial Health Office
 */
class ReportgenController extends Controller {

    private $maxLevel = 0;
    private $maxRowLevel = 0;
    private $arrColId = array();
    private $colSum = array();

    public function actionIndex() {
        $reportId = Yii::app()->request->getPost('reportId');
        $budGetYear = Yii::app()->request->getPost('budgetyear');
        $Inputperiod = Yii::app()->request->getPost('period');

        if ($budGetYear > 2400) {
            $budGetYear = $budGetYear - 543;
        }

        $period = isset($Inputperiod) ? $Inputperiod : "0";

        if (isset($_POST['lv3'])) {
            $id = $_POST['lv3'];
            if ($id == "") {
                $levelId = 3;
                $id = $_POST['lv2'];
            } else {
                $levelId = 4;
            }
        } else if (isset($_POST['lv2'])) {
            $id = $_POST['lv2'];
            if ($id == "") {
                $id = $_POST['lv1'];
                $levelId = 2;
            } else {
                $levelId = 3;
            }
        } else if (isset($_POST['lv1'])) {
            $id = $_POST['lv1'];

            if ($id == "") {
                $levelId = 1;
            } else {
                $levelId = 2;
            }
        } else {
            $levelId = 1;
            $id = "";
        }

        //$levelId = 2;
        // clear variable for store summary
        $this->colSum = array();
        //$this->rowSum = array();
        /*    $budGetYear = '2559';
          $period = 0;
          $reportId = 194;
          $levelId = 1; */

        $reports = new SysReportlist();

        $report = $reports->find("id = $reportId");

        $listFlag = $report->showall; //(period = 3,4)แสดงแยก เดือน หรือ ไตรมาส
        $periodId = $report->period_id;
        $colGroupId = $report->col_group_id;
        //$rowGroupId = $report->row_group_id;
        $reportShowType = $report->showtype;

        //$results = $this->getResults($reportId, $budGetYear, $period, $rowGroupId, $levelId);

        $this->setMaxLevel($colGroupId);
        $this->setMaxRowLevel($colGroupId);  // max row for header

        $table = "<table id='ReportTable' class='stripe row-border order-column cell-border' cellspacing='0' width='100%'>";

        //if($listFlag == 1){
        //    $table .= $this->genColsPeriod($reportShowType,$colGroupId, $budGetYear,$periodId,$levelId,$rowGroupId, $this->getHeaderName($rowGroupId, $levelId));
        //}else{
        $table .= $this->genCols($reportShowType, $colGroupId, $budGetYear, $period, $levelId, $colGroupId, $this->getHeaderName($colGroupId, $levelId));
        //}

        $table .= $this->genRows($reportId, $levelId, $budGetYear, $id);
        /* if ($levelId > 1) {
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
          } */

        $table .= "</table>";

        $data['table'] = $table;

        $data['colLock'] = "1";
        /* if($reportShowType == 2 && $levelId > 1){
          $data['colLock'] = ($this->maxRowLevel - $levelId) + 1;
          }else{
          $data['colLock'] = "1";
          } */

        //$data['colArray'] = $this->arrColId;
        //$data['level'] = $levelId;
        //$data['id'] = $id;

        $this->renderPartial('//reports/dynamics', $data);
    }

    private function setMaxLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }

    private function setMaxRowLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxRowLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }

    private function genCols($reportShowType, $itemGroupId, $budGetYear, $period, $levelId, $colGroupId, $headerGroupName = "อำเภอ") {
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

                if ($reportShowType == 2 && $levelId > 1) {
                    /*
                     * แสดงหัวตารางทุกระดับ
                     */
                    //$arrUpper = array();
                    $itemGroups = new SysItemGroupsSql();
                    $itemGroup = $itemGroups->findByPk($colGroupId);

                    $arrUpper = explode("->", substr($itemGroup->item_group_name, 0));

                    for ($y = $levelId - 1; $y < $this->maxRowLevel; $y++) {
                        $str .= "<th rowspan='" . $this->maxLevel . "'>" . $arrUpper[$y] . "</th>";
                    }
                    /*************************************************** */
                } else {
                    if ($levelId > 1) {
                        $str .= "<th rowspan='" . ($this->maxLevel) . "'>".$headerGroupName."</th>";
                    } else {
                        $str .= "<th rowspan='" . ($this->maxLevel) . "'>".$headerGroupName."</th>";
                    }
                }

                // แสดงปี
                //$countItem = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND under_level = 0");   
                //$str .= "<th colspan='".count($countItem)."'>".($period==2?'ปี พ.ศ. ':'ปีงบประมาณ ').$budGetYear."</th>";
                //$str .= "</tr><tr>";

                foreach ($column as $col):
                    // เก็บค่า colid ที่ต้องแสดงผล
                    //if ($col['under_level'] == 0) {
                    $strColId .= "|" . $col['id'];
                    //}

                    $rowspan = $this->getRowSpan($col['id']);
                    $colspan = $this->getColSpan($col['id']);

                    $str .= "<th ";

                    if ($rowspan > 1) {
                        $str .= " rowspan='" . $rowspan . "'";
                    }
                    if ($colspan > 1) {
                        $str .= " colspan='" . $colspan . "'";
                    }

                    $str .= ">" . $col['item_name'] . "</th>";
                    //$str .= ">" . $col['item_name'] . " id=".$col['id']. "</th>";
                endforeach;
                $str .= "</tr>";
            } else {
                $str .= "<tr>";
                foreach ($tmpCol as $c):
                    $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i AND upper_item_id = $c->id ORDER BY order_number+0,id");

                    $tmpCol2 = array_merge($tmpCol2, $column);

                    $strColId2 = "";
                    foreach ($column as $col):
                        // เก็บค่า colid ที่ต้องแสดงผล
                        //if ($col['under_level'] == 0) {
                        $strColId2 .= "|" . $col['id'];
                        //}

                        $rowspan = $this->getRowSpan($col['id']);
                        $colspan = $this->getColSpan($col['id']);

                        $str .= "<th ";

                        if ($rowspan > 1) {
                            $str .= " rowspan='" . $rowspan . "'";
                        }
                        if ($colspan > 1) {
                            $str .= " colspan='" . $colspan . "'";
                        }

                        $str .= ">" . $col['item_name'] . "</th>";
                    endforeach;
                    if (strlen($strColId2) > 0) {
                        $strColId = str_replace("|" . $c->id, $strColId2, $strColId);
                    }
                endforeach;
                $str .= "</tr>";
                $tmpCol = $tmpCol2;
            }
        }

        $str .= "</thead>";

        if (substr($strColId, 0, 1) == "|") {
            $strColId = substr($strColId, 1, strlen($strColId));
        }

        $this->arrColId = array_filter(explode("|", $strColId));

        return $str;
    }

    private function genColsPeriod($reportShowType, $itemGroupId, $budGetYear, $periodId, $levelId, $rowGroupId, $headerGroupName = "อำเภอ") {
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
            for ($i = $budGetYear; $i > ($budGetYear - 3); $i--) {
                $listCol[] = $i;
            }
        }

        $str .= "<tr>";
        if ($reportShowType == 2 && $levelId > 1) {
            /*
             * แสดงหัวตารางทุกระดับ
             */
            //$arrUpper = array();
            $itemGroups = new SysItemGroups();
            $itemGroup = $itemGroups->findByPk($rowGroupId);

            $arrUpper = explode("->", substr($itemGroup->item_group_name, 0));

            for ($y = $levelId - 1; $y < $this->maxRowLevel; $y++) {
                $str .= "<th rowspan='" . ($this->maxLevel + 1) . "'>" . $arrUpper[$y] . "</th>";
            }
            /*             * ************************************************* */
        } else {
            $str .= "<th rowspan='" . ($this->maxLevel + 1) . "'>$headerGroupName</th>";
        }

        // แสดงปี
        //  $str .= "<th colspan='" . $countItemAll . "'>".($periodId==2?'ปี พ.ศ. ':'ปีงบประมาณ ').$budGetYear."</th>";
        // $str .= "</tr>";
        //       $str .= "<tr>";
        foreach ($listCol as $lc):
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
                        $strColId .= "|" . $l . $col['id'];
                        //}

                        $rowspan = $this->getRowSpan($col['id']);
                        $colspan = $this->getColSpan($col['id']);

                        $str .= "<th ";

                        if ($rowspan > 1)
                            $str .= " rowspan = '" . $rowspan . "'";
                        if ($colspan > 1)
                            $str .= " colspan = '" . $colspan . "'";

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
                            $strColId2 .= "|" . $l . $col['id'];
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
                            $strColId = str_replace("|" . $l . $c->id, $strColId2, $strColId);
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

    private function genRows($reportId, $level, $budGetYear, $id) {
        $sql = $this->getSql($reportId, $level);
        $sql = str_replace('$BUDGETYEAR', $budGetYear, $sql);
        if ($id != "") {
            $sql = str_replace('$ID', $this->getIdValue($id), $sql);
        }
        //$sql = (string)$this->getSql(194,1);
        // $rsql = "SELECT report_sql FROM sys_report_sql WHERE report_id = $reportId AND level = $level;";
        // $sql = Yii::app()->db->createCommand($rsql)->queryScalar();
        //Logs::Insert("trace", $sql);

        $table = "";
        try {
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            // get column name
            if ($result) {
                $colName = array_keys($result[0]);
            }

            foreach ($result as $rs):
                $table .= "<tr>";
                $i = 0;
                foreach ($colName as $col):
                    $i++;
                    if ($i == 1) {
                        $table .= "<td style='text-align:left;'><b>$rs[$col]</b></td>";
                    } else {
                        $table .= "<td>$rs[$col]</td>";
                    }
                endforeach;
                $table .= "</tr>";
            endforeach;
        } catch (Exception $ex) {
            Logs::Insert("ReportgenController", $ex, $sql);
        }

        return $table;
    }

    private function getSql($reportId, $level) {
        $rsql = new SysReportSql();
        $sql = $rsql->find("report_id = $reportId AND level = $level");
        return $sql->sql;
    }

    private function getIdValue($id) {
        $sql = "SELECT item_code FROM sys_items WHERE id = " . $id;
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    private function getHeaderName($colGroupId, $levelId) {
        $itemGroup = new SysItemGroups();
        $groups = $itemGroup->find("id = $colGroupId");

        $arrGroup = explode("->", $groups->item_group_name);

        if (count($arrGroup) >= ($levelId - 1))
            return $arrGroup[$levelId - 1];
        else
            return $arrGroup[0];
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

    public function actionTest() {
        list($usec, $sec) = explode(' ', microtime());
        $s1 = (int) $sec * 1000;
        $s2 = round((float) $usec * 1000);
        echo str_replace(".", "", $s1 + $s2);
    }

}
