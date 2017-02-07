<?php

/**
 * Description of FrontendController
 *
 * @author Sittipong Promhan
 * @create 26 พ.ย. 2557 13:20:04
 * @copyright (c) Tak Provincial Health Office
 */
class FrontendController extends Controller {

    public $layout = 'backend';
    //private $maxLevel = 0;
    //private $ColSpan = 0;

    private $status = array('1' => 'ยังไม่ได้บันทึกข้อมูล',
        '2' => 'บันทึกข้อมูลไม่สมบูรณ์',
        '3' => 'บันทึกข้อมูลสมบูรณ์');
    private $color = array('1' => 'red darken-3 white-text',
        '2' => 'yellow accent-3',
        '3' => 'green darken-3 yellow-text');

    public function actionIndex() {

        $this->render('//frontend/home');
    }

    public function actionTest() {
        $data['priv'] = $this->getAllPrivileges("1", "9");

        /**
         * ในการเชคสิทธิ์ ให้เอา privileges all ที่ได้ไปเป็นเงื่อนไขการ where ด้วย ว่าต้องมีรหัสในนี้เท่านั้น
         */
        $this->render('//frontend/test', $data);
    }

    /*
      public function actionTest(){

      $itemGroupId = 3;

      $items = new SysItems();

      $this->setMaxLevel($itemGroupId);

      $table = "<table border='1' cellspacing='2' cellpadding='3'>";
      $table .= $this->genCol($items, $itemGroupId);
      $table .= "</table>";

      $data['table'] = $table;
      $this->render('//frontend/main',$data);
      }

      private function setMaxLevel($itemGroupId){
      $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=".$itemGroupId;

      $this->maxLevel = Yii::app()->db->createCommand($sql)->queryScalar();
      }

      private function genCol($items,$itemGroupId){
      $str = "";
      for($i = 1; $i <= $this->maxLevel; $i++){
      $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i");

      $str .= "<tr>";
      foreach($column as $col):
      $rowspan = $this->getRowSpan($col->id);
      $colspan = $this->getColSpan($col->id);

      $str .= "<td";

      if($rowspan > 1) $str .= " rowspan='".$rowspan."'";
      if($colspan > 1) $str .= " colspan='".$colspan."'";

      $str .= ">".$col->item_name."</td>";
      endforeach;
      $str .= "</tr>";
      }

      return $str;
      }

      private function genRows($items,$itemGroupId,$levelId,$upperItemId='',$link=''){
      $tableRow = "";

      if($upperItemId == ''){
      $item_rs = $items->findAll("item_group_id = $itemGroupId");
      }else{
      $item_rs = $items->findAll("levelid = $levelId and upper_item_id = $upperItemId");
      }

      foreach($item_rs as $item):
      $tableRow .= "<tr>";

      if(strlen($link) > 0){
      $tableRow .= "<td><a href='".$link."'>".$item['item_code']." - ".$item['item_name']."</a></td>";
      }else{
      $tableRow .= "<td>".$item['item_code']." - ".$item['item_name']."</td>";
      }
      //for($i = 0; $i < count($this->colId); $i++){
      //   $tableRow .= "<td>".$this->colId[$i]."</td>";
      //}
      $tableRow .= "</tr>";
      endforeach;

      return $tableRow;
      }

      private function getRowSpan($itemId){
      $sql = "SELECT IF(under_level > 0,1,($this->maxLevel+1) - levelid) FROM sys_items WHERE id = '$itemId';";
      $result = Yii::app()->db->createCommand($sql)->queryScalar();
      return $result;
      }

      private function getColSpan($itemId){
      $sql = "select count(*) from sys_items where delete_flag = 0 and upper_item_all like '%$itemId%' and under_level = 0;";
      $result = Yii::app()->db->createCommand($sql)->queryScalar();
      return $result;
      }
     */
    /*
      public function actionRecordList(){
      $items = new SysItems();
      $table = '<table class="table table-striped table-hover" style="background:#fff">';
      $table .= $this->genRows($items, '', 2, 1);
      $table .= '</table>';

      $data['table'] = $table;

      $this->render('//frontend/main',$data);
      }
     */

    public function actionRecord() {

        $reportId = Yii::app()->request->getPost('reportId');

        $reports = new SysReportlist();
        $report = $reports->find("id = $reportId");
        $data['groupname'] = SysReportgroup::model()->find("id=$report->menugroup_id")['name'];
        $periodId = $report->period_id;
        $data['groupId'] = $report->menugroup_id;
        $data['name'] = $report->name;
        $data['source'] = $report->source;
        $data['reportId'] = $reportId;
        $data['filter'] = $this->getFilter($reportId, $periodId);

        $this->render('/frontend/main', $data);
    }

    public function actionRecordList() {
        $reportId = $_POST["reportId"];
        $budgetYear = $_POST["budgetYear"];
        $period = $_POST["period"];
        $userId = Yii::app()->session['userid'];
        $hospCode = Yii::app()->session['hospcode'];

        $reports = new SysReportlist();
        $report = $reports->find("id = $reportId");

        //$periodId = $report->period_id;
        $colGroupId = $report->col_group_id;
        $rowGroupId = $report->row_group_id;

        $priv = $this->getAllPrivileges($userId, $hospCode, $rowGroupId);
//echo $priv."<BR/>";
        if ($priv != "") {
            // $data['filter'] = $this->getFilter($periodId);

            /*
              $sql = "SELECT COUNT(*) FROM sys_items WHERE
              item_group_id IN (SELECT item_group_id FROM sys_col_lists
              WHERE col_group_id = $colGroupId) AND under_level = 0";
             * 
             */

            $sql = "SELECT COUNT(*) FROM sys_items WHERE 
               item_group_id = $colGroupId AND under_level = 0 AND delete_flag = 0";

            $maxRecord = Yii::app()->db->createCommand($sql)->queryScalar();

            $items = new SysItems();

            /*
              $sql = "SELECT * FROM sys_items
              WHERE item_group_id IN (SELECT item_group_id FROM sys_row_lists WHERE row_group_id = $rowGroupId)
              AND levelid = 1 AND delete_flag = 0;";
             * 
             */

            $sql = "SELECT * FROM sys_items 
                     WHERE item_group_id = $rowGroupId
                     AND levelid = 1 AND delete_flag = 0
                     AND id IN($priv)
                     ORDER BY order_number,id ";

            $result = Yii::app()->db->createCommand($sql)->queryAll();

            $table = '<table  class="bordered" id="t_input">';

            $i = 0;
            foreach ($result as $rs):

                //level 1
                $table .= '<tr>';
                $table .= '<td colspan="4" class="active" style="font-size:25px;font-weight: bold;">ข้อมูล : ' . $rs['item_name'] . '</td>';
                $table .= '</tr>';

                //level 2
                $item = $items->findAll("delete_flag = 0 AND upper_item_id = " . $rs['id'] . " AND id IN($priv)");
                if (count($item) > 0) {

                    foreach ($item as $it):

                        //level 3
                        $item2 = $items->findAll("delete_flag = 0 AND upper_item_id = " . $it['id'] . " AND id IN($priv)");

                        if (count($item2) > 0) {

                            //level 2
                            $table .= '<tr>';
                            $table .= '<td class="active black-text" colspan="4" style="padding-left:5%; font-size:20px;">ข้อมูล : ' . $it['item_name'] . '</td>';
                            $table .= '</tr>';


                            foreach ($item2 as $it2):




                                //level 4
                                $item3 = $items->findAll("delete_flag = 0 AND upper_item_id = " . $it2['id'] . " AND id IN($priv)");

                                if (count($item3) > 0) { //มี level 4
                                    //level 3
                                    $table .= '<tr>';
                                    $table .= '<td class="active red-text" colspan="4" style="padding-left:10%;">ข้อมูล : ' . $it2['item_name'] . '</td>';
                                    $table .= '</tr>';

                                    foreach ($item3 as $it3):
                                        $status = $this->checkRecordStatus($reportId, $it3['id'], $budgetYear, $period, $colGroupId, $maxRecord);

                                        $table .= '<tr class="' . $this->color[$status] . '">';
                                        $table .= '<td width="10%"></td>';
                                        $table .= '<td width="30%">' . $it3['item_name'] . '</td>';
                                        $table .= '<td width="40%">สถานะ : ' . $this->status[$status] . '</td>';
                                        $table .= '<td width="20%"><button type="button" onclick="recordEdit(\'' . $reportId . '\',\'' . $it3['id'] . '\');" class="waves-effect waves-light btn green"><i class="mdi-content-save"></i> บันทึกข้อมูล</button></td>';
                                        $table .= '</tr>';
                                    endforeach;
                                }else {
                                    $status = $this->checkRecordStatus($reportId, $it2['id'], $budgetYear, $period, $colGroupId, $maxRecord);

                                    $table .= '<tr class="' . $this->color[$status] . '">';
                                    $table .= '<td width="10%"></td>';
                                    $table .= '<td width="30%">' . $it2['item_name'] . '</td>';
                                    $table .= '<td width="40%">สถานะ : ' . $this->status[$status] . '</td>';
                                    $table .= '<td width="20%"><button type="button" onclick="recordEdit(\'' . $reportId . '\',\'' . $it2['id'] . '\');" class="waves-effect waves-light btn green"><i class="mdi-content-save"></i> บันทึกข้อมูล</button></td>';
                                    $table .= '</tr>';
                                }
                            endforeach;
                        } else {
                            $status = $this->checkRecordStatus($reportId, $it['id'], $budgetYear, $period, $colGroupId, $maxRecord);
                            $table .= '<tr class="' . $this->color[$status] . '">';
                            $table .= '<td width="10%"></td>';
                            $table .= '<td width="30%">' . $it['item_name'] . '</td>';
                            $table .= '<td width="40%">สถานะ : ' . $this->status[$status] . '</td>';
                            $table .= '<td width="20%"><button type="button" onclick="recordEdit(\'' . $reportId . '\',\'' . $it['id'] . '\');" class="waves-effect waves-light btn green"><i class="mdi-content-save"></i> บันทึกข้อมูล</button></td>';
                            $table .= '</tr>';
                        }
                    endforeach;
                } else {
                    $status = $this->checkRecordStatus($reportId, $rs['id'], $budgetYear, $period, $colGroupId, $maxRecord);
                    $table .= '<tr class="' . $this->color[$status] . '">';
                    $table .= '<td width="10%"></td>';
                    $table .= '<td width="30%">' . $rs['item_name'] . '</td>';
                    $table .= '<td width="40%">สถานะ : ' . $this->status[$status] . '</td>';
                    $table .= '<td width="20%"><button type="button" onclick="recordEdit(\'' . $reportId . '\',\'' . $rs['id'] . '\');" class="waves-effect waves-light btn green" style="margin:0px;"><i class="mdi-content-save"></i> บันทึกข้อมูล</button></td>';
                    $table .= '</tr>';
                }
            endforeach;
            $table .= '</table>';

            $table .= "<input type='hidden' name='countbox' value='$i'>";


            echo $table;
        } else {
            echo "คุณไม่มีสิทธิ์บันทึกข้อมูลนี้!!!";
        }
    }

    public function actionRecordEdit() {
        $id = $_POST['id'];
        $reportId = $_POST["reportId"];
        $budgetYear = $_POST["budgetYear"];
        $period = $_POST["period"];

        $reports = new SysReportlist();
        $report = $reports->find("id = $reportId");

        $arrResult = $this->getResult($reportId, $budgetYear, $period, $id);

        if (count($arrResult) > 0)
            $method = "edit";
        else
            $method = "add";

        $items = new SysItems();

        // $data['owner'] = $items->find('id = '.$id)->item_name;
        /*
          $sql = "SELECT * FROM sys_items WHERE
          item_group_id IN (SELECT item_group_id FROM sys_col_lists
          WHERE col_group_id = $report->col_group_id) AND levelid = 1;";
         * 
         */
        $sql = "SELECT * FROM sys_items WHERE 
                item_group_id = $report->col_group_id AND levelid = 1 AND delete_flag = 0
                ORDER BY order_number,id;";
        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $table = "<form name='formRecordEdit' id='formRecordEdit' method='post' action='" . Yii::app()->createUrl("/Frontend/RecordSave") . "'>";
        $table .= '<table>';

        $i = 0;
        foreach ($result as $rs):

            //level 1
            $table .= '<tr>';
            $table .= '<td colspan="3" class="grey lighten-3 red-text" style="font-size:20px;font-weight: bold;">ข้อมูล : ' . $rs['item_name'] . '</td>';
            $table .= '</tr>';

            //level 2
            if ($rs['under_level'] > 0) {
                $item = $items->findAll("delete_flag = 0 AND upper_item_id = " . $rs['id'] . " ORDER BY order_number,id");
                if (count($item) > 0) {
                    //$table .= '<tr><td colspan="3">';
                    //$table .= '<table class="table table-striped table-hover" style="background:#fff">';
                    foreach ($item as $it):

                        if ($it['under_level'] > 0) { // มีลูกอีก
                            //level 3
                            $item2 = $items->findAll("delete_flag = 0 AND upper_item_id = " . $it['id'] . " ORDER BY order_number,id");
                            if (count($item2) > 0) {
                                //level 2
                                $table .= '<tr>';
                                $table .= '<td class="active black-text" colspan="3" style="padding-left:5%;font-size:20px;">ข้อมูล : ' . $it['item_name'] . '</td>';
                                $table .= '</tr>';

                                // level 3
                                foreach ($item2 as $it2):

                                    $val = "";
                                    if ($method == 'edit') {
                                        if (isset($arrResult[$id][$it2['id']])) {
                                            $val = $arrResult[$id][$it2['id']];
                                        }
                                    }

                                    $table .= '<tr>';
                                    $table .= '<td class="info" width="10%"></td>';
                                    $table .= '<td class="info" width="30%">' . $it2['item_name'] . ' :</td>';

                                    if ($it2['inputtype'] == 2) {
                                        $checked = "";
                                        if ($val == 1)
                                            $checked = "checked";
                                        $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $it2['id'] . '"><input type="checkbox" ' . $checked . ' id="val_' . $i . '"  name="val_' . $i . '" value="1" class="form-control input-sm"><label for="val_' . $i . '"></label></td>';
                                    }else {
                                        $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $it2['id'] . '"><input type="text" onkeypress="return checkKey(event,' . $i . ')" id="val_' . $i . '"  name="val_' . $i . '" value="' . $val . '" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                                    }


                                    $table .= '</tr>';
                                endforeach;
                            }
                        } else {
                            // level 2

                            $val = "";
                            if ($method == 'edit') {
                                if (isset($arrResult[$id][$it['id']])) {
                                    $val = $arrResult[$id][$it['id']];
                                }
                            }

                            $table .= '<tr>';
                            $table .= '<td class="info" width="10%"></td>';
                            $table .= '<td class="info" width="30%">' . $it['item_name'] . ' : </td>';

                            if ($it['inputtype'] == 2) {
                                $checked = "";
                                if ($val == 1)
                                    $checked = "checked";
                                $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $it['id'] . '"><input type="checkbox" ' . $checked . ' id="val_' . $i . '"  name="val_' . $i . '" value="1" class="form-control input-sm"><label for="val_' . $i . '"></label></td>';
                            }else {
                                $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $it['id'] . '"><input type="text" onkeypress="return checkKey(event,' . $i . ')" id="val_' . $i . '"  name="val_' . $i . '" value="' . $val . '" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                            }
                            $table .= '</tr>';
                        }
                        /*
                          //level 3
                          $item2 = $items->findAll("delete_flag = 0 AND upper_item_id = ".$it['id']);

                          if(count($item2) > 0){

                          //level 2
                          $table .= '<tr>';
                          $table .= '<td class="active" colspan="3" style="padding-left:5%;">ข้อมูล : '.$it['item_name'].'</td>';
                          $table .= '</tr>';

                          //$table .= '<tr><td colspan="3">';
                          //$table .= '<table class="table table-striped table-hover" style="background:#fff">';
                          foreach($item2 as $it2):
                          $table .= '<tr>';
                          $table .= '<td class="info" width="10%"></td>';
                          $table .= '<td class="info" width="30%">จำนวน : '.$it2['item_name'].'</td>';
                          $table .= '<td class="info" width="60%"><input type="hidden" name="id_'.++$i.'" value="'.$it2['id'].'"><input type="text" onkeypress="return checkKey(event,'.$i.')" id="val_'.$i.'"  name="val_'.$i.'" value="'.($method=='edit'?$arrResult[$id][$it2['id']]:"").'" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                          $table .= '</tr>';
                          endforeach;
                          //$table .= '</table>';
                          //$table .= '</td></tr>';
                          }else{

                          $table .= '<tr>';
                          $table .= '<td class="info" width="10%"></td>';
                          $table .= '<td class="info" width="30%">จำนวน : </td>';
                          $table .= '<td class="info" width="60%"><input type="hidden" name="id_'.++$i.'" value="'.$it['id'].'"><input type="text" onkeypress="return checkKey(event,'.$i.')" id="val_'.$i.'"  name="val_'.$i.'" value="'.($method=='edit'?$arrResult[$id][$it['id']]:"").'" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                          $table .= '</tr>';
                          }
                         */
                    endforeach;
                    //$table .= '</table>';
                    //$table .= '</td></tr>';
                }
            } else {
                $val = "";
                if ($method == 'edit') {
                    if (isset($arrResult[$id][$rs['id']])) {
                        $val = $arrResult[$id][$rs['id']];
                    }
                }

                $table .= '<tr>';
                $table .= '<td class="info" width="10%"></td>';
                $table .= '<td class="info" width="30%">จำนวน :</td>';
                //$table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $rs['id'] . '"><input type="text" onkeypress="return checkKey(event,' . $i . ')" id="val_' . $i . '"  name="val_' . $i . '" value="' . $val . '" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                if ($rs['inputtype'] == 2) {
                    $checked = "";
                    if ($val == 1)
                        $checked = "checked";
                    $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $rs['id'] . '"><input type="checkbox" ' . $checked . ' id="val_' . $i . '"  name="val_' . $i . '" value="1" class="form-control input-sm"><label for="val_' . $i . '"></label></td>';
                }else {
                    $table .= '<td class="info" width="60%"><input type="hidden" name="id_' . ++$i . '" value="' . $rs['id'] . '"><input type="text" onkeypress="return checkKey(event,' . $i . ')" id="val_' . $i . '"  name="val_' . $i . '" value="' . $val . '" class="form-control input-sm" placeholder="ตัวเลขเท่านั้น"></td>';
                }
                $table .= '</tr>';
            }
        endforeach;
        $table .= '</table>';

        // $table .= "<button style='float: right;' type='button' class='btn btn-default' data-dismiss='modal'>ยกเลิก</button>";
        // $table .= "<button style='float: right;' type='button' class='btn btn-primary' id='recordSave' onclick='recordSave(\"$reportId\");'>บันทึก</button>";




        $table .= "<input type='hidden' id='countbox' name='countbox' value='$i'>";
        $table .= "<input type='hidden' name='id' value='$id'>";
        $table .= "<input type='hidden' name='reportId' value='$reportId'>";
        $table .= "<input type='hidden' name='method' value='$method'>";
        $table .= "<input type='hidden' name='period' value='$period'>";
        $table .= "<input type='hidden' name='budgetYear' value='$budgetYear'>";
        $table .= "</form>";

        //$data['table'] = $table;
        //$this->render('//frontend/page',$data);

        echo $table;
    }

    public function actionRecordSave() {
        $colId = $_POST['id'];
        $countBox = $_POST['countbox'];
        $reportId = $_POST['reportId'];
        $period = $_POST['period'];
        $method = $_POST['method'];
        $budgetYear = $_POST['budgetYear'];
        $userId = Yii::app()->session['userid'];
        //if(empty($id)){
        //$product = new Products();
        // $product->created_at = new CDbExpression("NOW()");
        //}else{
        //   $product = Products::model()->findByPk($id);
        //}

        $c = 0;
        for ($i = 1; $i <= $countBox; $i++) {

            /*
             * ปรับปรุง วันที่ 23/6/2558
             * ถ้าไม่ได้ระบุอะไรมาเลย ให้ใส่ค่า default เป็น 0
             */
            if (strlen($_POST['val_' . $i]) == 0)
                $_POST['val_' . $i] = 0;

            /*
             * จบปรับปรุง ปรับปรุง วันที่ 23/6/2558
             */

            if (strlen($_POST['val_' . $i]) > 0) {
                if ($method == "add") {
                    $rs = array(
                        'REPORT_ID' => $reportId,
                        'BUDGETYEAR' => $budgetYear,
                        'PERIOD' => $period,
                        'COL_ITEM_ID' => $colId,
                        'ROW_ITEM_ID' => $_POST['id_' . $i],
                        'AMOUNT' => $_POST['val_' . $i],
                        'USER_ID' => $userId
                    );

                    $c += Yii::app()->db->createCommand()->insert('results', $rs);
                } else { //update
                    $rs = "REPORT_ID = $reportId
                            AND BUDGETYEAR = '$budgetYear'
                            AND PERIOD = '$period'
                            AND COL_ITEM_ID = $colId
                            AND ROW_ITEM_ID = " . $_POST['id_' . $i];

                    $results = new Results();
                    $result = $results->findAll($rs);

                    if (count($result) > 0) { // มีข้อมูลแล้ว update
                        $c += Yii::app()->db->createCommand()->update('results', array('AMOUNT' => $_POST['val_' . $i], 'USER_ID' => $userId), $rs);
                    } else { // ไม่มีข้อมูลเก่า insert
                        $rs = array(
                            'REPORT_ID' => $reportId,
                            'BUDGETYEAR' => $budgetYear,
                            'PERIOD' => $period,
                            'COL_ITEM_ID' => $colId,
                            'ROW_ITEM_ID' => $_POST['id_' . $i],
                            'AMOUNT' => $_POST['val_' . $i],
                            'USER_ID' => $userId
                        );

                        $c += Yii::app()->db->createCommand()->insert('results', $rs);
                    }
                }
            } else {
                if ($method == "edit") {
                    $rs = "REPORT_ID = $reportId
                            AND BUDGETYEAR = '$budgetYear'
                            AND PERIOD = '$period'
                            AND COL_ITEM_ID = $colId
                            AND ROW_ITEM_ID = " . $_POST['id_' . $i];

                    $c += Yii::app()->db->createCommand()->delete("results", $rs);
                }
            }
        }

        echo $c;
        // $data['rs'] = $c;
        //$this->render('//frontend/page',$data);
        // $this->redirect('RecordList');
    }

    public function actionGetItemName($id) {
        $items = new SysItems();
        $item = $items->find("id = $id");

        echo $item->item_name;
    }

    private function checkRecordStatus($reportId, $colId, $budgetYear, $periodId, $colGroupId, $maxRecord) {

        //SELECT COUNT(*) FROM results WHERE REPORT_ID = 1 AND BUDGETYEAR = '2558' AND PERIOD = 0 AND COL_ITEM_ID = 11;
        //$results = new Results();

        $sql = "SELECT COUNT(*) FROM results r
                LEFT JOIN sys_items s ON item_group_id = $colGroupId AND under_level = 0 AND s.id = r.ROW_ITEM_ID
                WHERE s.id IS NOT NULL AND r.COL_ITEM_ID = $colId AND r.REPORT_ID = $reportId AND r.BUDGETYEAR = '$budgetYear'
                AND r.PERIOD = $periodId";

        //$result = $results->findAll("REPORT_ID = $reportId AND BUDGETYEAR = '$budgetYear' AND PERIOD = $periodId AND COL_ITEM_ID = $colId");
        $curRecord = Yii::app()->db->createCommand($sql)->queryScalar();


        /* return desc
         * 1 = ยังไม่ได้บันทึกข้อมูล
         * 2 = บันทึกข้อมูลไม่สมบูรณ์
         * 3 = บันทึกข้อมูลสมบูรณ์
         */

        if ($curRecord == $maxRecord) {
            return 3;
        } else if ($curRecord > 0 && $curRecord < $maxRecord) {
            return 2;
        } else {
            return 1;
        }
    }

    private function getResult($reportId, $budgetYear, $periodId, $colId) {
        $results = new Results();

        $filter = "REPORT_ID = $reportId 
                    AND BUDGETYEAR = '$budgetYear' 
                    AND PERIOD = $periodId 
                    AND COL_ITEM_ID = $colId";

        $result = $results->findAll($filter);


        $rs = array();
        foreach ($result as $r):
            $rs[$r->COL_ITEM_ID][$r->ROW_ITEM_ID] = $r->AMOUNT;
        endforeach;

        return $rs;
    }

    private function getFilter($reportId, $periodId, $value = '') {
        $year = date("Y");

        if ($year < 2400)
            $year += 543;

        if ($periodId != 2) {
            $m = date("m");
            if ($m > 9) {
                $year += 1;
            }
        }


        $filter = new Filter();
        $str = '<form class="form-inline" role="form">';
        $str .= '<input type="hidden" id="reportId" value="' . $reportId . '">';
        //$periodId = 4;
        $filter->setComboBoxOption("onchange='loadRecordList($reportId);'");

        if ($periodId == 1) {
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $filter->yearComboBox('budgetyear', $year, '', 'budgetyear', 'browser-default', '2557');
            $str .= '</div></div>';
        } else if ($periodId == 2) {
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปี พ.ศ.</div>';
            $str .= $filter->yearComboBox('budgetyear', $year, '', 'budgetyear', 'browser-default', '2557');
            $str .= '</div></div>';
        } else if ($periodId == 3) {
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $filter->yearComboBox('budgetyear', $year, '', 'budgetyear', 'browser-default', '2557');
            $str .= '</div></div>';
            $str .= '&nbsp;&nbsp;<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ไตรมาส</div>';
            $str .= $filter->quarterComboBox("period", $value, "", "period", "browser-default");
            $str .= '</div></div>';
        } else if ($periodId == 4) {
            $str .= '<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">ปีงบประมาณ</div>';
            $str .= $filter->yearComboBox('budgetyear', $year, '', 'budgetyear', 'browser-default', '2557');
            $str .= '</div></div>';
            $str .= '&nbsp;&nbsp;<div class="form-group">';
            $str .= '<div class="input-group">';
            $str .= '<div class="input-group-addon">เดือน</div>';
            $str .= $filter->monthBudgetComboBox("period", $value, "", "period", "browser-default");
            $str .= '</div></div>';
        } else {
            $str = "ไม่ได้ตั้งค่าช่วงเวลา";
        }

        //$str .= '&nbsp;&nbsp;<button type="button" onclick="loadRecordList(\''.$reportId.'\');" class="btn btn-success">ค้นหา</button>';
        $str .= "</form>";

        return $str;
    }

    public function actionMenuGroup() {
        $catalogId = $_GET['catId'];

        // $catalogId = 1;

        $data['catalogName'] = $_GET['catalogname'];

        $group = new SysReportgroup();
        $data['group_menu'] = $group->getGroupReportRecord($catalogId);
        $this->render('//frontend/menuGroup', $data);
    }

    public function actionReportList($groupid = null, $groupname = null) {
        /* $group_id = $_GET['gid'];
          $group_name = $_GET['gname'];
          $cat = new SysReportlist();
          $data['reportList'] = $cat->findAll("menugroup_id = '$group_id' AND record_flag = 'Y' ORDER BY order_number,id");
          $data['groupName'] = $group_name;
          $this->render('//frontend/reportList', $data);
         */
        $groupModel = new SysReportgroup();
        $query = "SELECT * FROM sys_reportlist WHERE menugroup_id = $groupid AND active = 1 AND record_flag = 'Y' ORDER BY order_number,id";
        $data['listmenu'] = Yii::app()->db->createCommand($query)->queryAll();
        $data['group'] = $groupModel->GetDetailGroup($groupid);
        $data['groupid'] = $groupid;
        $data['groupname'] = $groupname;
        $this->render('reportList', $data);
    }

    private function getAllPrivileges($userId, $hospCode, $itemGroupId) {
        if (Yii::app()->session['admin_flag'] == 1) { //Admin
            $sql = "SELECT GROUP_CONCAT(i.id) FROM sys_items i
                    WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId";

            $idAll = Yii::app()->db->createCommand($sql)->queryScalar();
            $strPriv = $idAll;
        } else {
            // หา id ที่มีสิทธิ์ทั้งหมดก่อน
            $sql1 = "SELECT i.id FROM sys_items i
                    INNER JOIN sys_privileges p ON p.itemid = i.id AND p.item_group_id = i.item_group_id
                    WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId AND p.userid = $userId";

            $hospType = Yii::app()->db->createCommand("SELECT off_type AS hospType FROM co_office WHERE off_id = '$hospCode'")->queryScalar();
            if ($hospType == "02") {
                $sql2 = "SELECT id FROM sys_items
                        WHERE delete_flag = 0 AND item_group_id = $itemGroupId 
                        AND item_code IN (SELECT off_id FROM co_office WHERE distid = '" . Yii::app()->session['distcode'] . "' AND off_type IN ('02','03','04'))";
            } else if ($hospType == "03" || $hospType == "04" || $hospType == "06" || $hospType == "07") {
                $sql2 = "SELECT id FROM sys_items
                          WHERE delete_flag = 0 AND item_group_id = $itemGroupId AND item_code = '$hospCode'";
            } else {
                $sql2 = "";
            }

            if ($sql2 == "") {
                $sql = "SELECT GROUP_CONCAT(id) FROM ($sql1) q";
            } else {
                $sql = "SELECT GROUP_CONCAT(id) FROM ($sql1 UNION $sql2) q";
            }

            $idAll = Yii::app()->db->createCommand($sql)->queryScalar();
            $rsId = explode(",", $idAll);

            if ($rsId[0] == '') {
                $sql = "SELECT id FROM sys_items WHERE delete_flag = 0 AND item_group_id = $itemGroupId AND item_code = '" . Yii::app()->session['distcode'] . "'";
                $idAll = Yii::app()->db->createCommand($sql)->queryScalar();
                //if(strlen($strPriv) < 1) $strPriv = "";
                $rsId[0] = $idAll;
            }

            if ($rsId[0] != '') {

                $arrPriv = $rsId;

                // หา upper item ทั้งหมดเก็บไว้
                /*
                  $sql = "SELECT REPLACE(GROUP_CONCAT(DISTINCT upper_item_all),',','') FROM sys_items i
                  INNER JOIN sys_privileges p ON p.itemid = i.id AND p.item_group_id = i.item_group_id
                  WHERE i.delete_flag = 0 AND i.item_group_id = $itemGroupId AND p.userid = $userId";
                 */
                $sql = "SELECT REPLACE(GROUP_CONCAT(DISTINCT upper_item_all),',','') FROM sys_items
                        WHERE delete_flag = 0 AND item_group_id = $itemGroupId AND id IN ($idAll)";
                $upper = Yii::app()->db->createCommand($sql)->queryScalar();

                //แปลงเป็น array
                $arrPriv = array_merge($arrPriv, array_filter(explode("|", $upper)));

                // เอา id ทั้งหมด หาลูกทั้งหมด
                foreach ($rsId as $id):
                    $rs = Yii::app()->db->createCommand("SELECT GROUP_CONCAT(id) FROM sys_items WHERE delete_flag = 0 AND item_group_id = $itemGroupId AND upper_item_all LIKE '%" . $id . "%'")->queryScalar();

                    $arrPriv = array_merge($arrPriv, explode(",", $rs));
                    //$rs->free;
                endforeach;
                //$rsId->free;

                $strPriv = implode(",", array_unique(array_filter($arrPriv)));
            }else {
                /*
                  $sql = "SELECT id FROM sys_items WHERE delete_flag = 0 AND item_group_id = $itemGroupId AND item_code = '".Yii::app()->session['distcode']."'";
                  $strPriv = Yii::app()->db->createCommand($sql)->queryScalar();
                  if(strlen($strPriv) < 1) $strPriv = "";
                 * 
                 */
                $strPriv = "";
            }
        }
        //$arrPriv->free;
        //return $rsId;
        return $strPriv;
    }

}

?>
