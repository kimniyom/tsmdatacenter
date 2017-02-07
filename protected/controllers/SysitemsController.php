<?php

// Create By Note
class SysitemsController extends Controller {

    public $layout = 'backend';
   

    // private $navi = array();

    public function actionIndex() {
        $this->render('//backOffice/SysItemMain');
    }

    public function beforeAction($action) {
        if (isset(Yii::app()->session['userid']) && (Yii::app()->session['admin_flag'] == 1 || Yii::app()->session['report_flag'] == 1)) {
            return true;
        } else {
            $this->render('//user/accessdeny');
        }
    }

    public function actionItemGroup() {
        $distCode = Yii::app()->session['distcode'];
        //ดึงข้อมูลที่ได้จาก Model มาแสดง
        $item = new SysItemGroups();
        $data['item'] = $item->getAllByDistCode($distCode);
        $this->renderPartial('//backOffice/SysItemGroups', $data);
    }

    public function actionItem() {
        //ดึงข้อมูลที่ได้จาก Model มาแสดง

        $gid = isset($_POST['gid']) ? $_POST['gid'] : "0";
        $id = isset($_POST['id']) ? $_POST['id'] : "0";
        $lv = isset($_POST['lv']) ? $_POST['lv'] : "0";


        //เช็คค่า level ที่ส่งมา
        //if($lv == 0){
        $lv += 1;
        //$gid = ($gid-1); Comment By Kimniyom ทำให้ไป GET ค่ามาแสดงไม่ตรงข้อ
        // }
        //  $navi = array();


        $sql = "SELECT i1.id,i1.item_group_id,i1.item_code,i1.item_name,i1.item_name_en,i1.levelid,i1.order_number,COUNT(i2.id) as child FROM sys_items i1
                LEFT JOIN sys_items i2 ON i2.upper_item_id = i1.id AND i2.delete_flag = 0
                WHERE i1.delete_flag = 0 AND i1.item_group_id = $gid AND i1.upper_item_id = $id
                GROUP BY i1.id
                ORDER BY i1.order_number+0,i1.id";
        /*
          $subitem = new SysItems();
          $where = "delete_flag='0'";
          $where .= " AND item_group_id = ".$gid;
          $where .= " AND upper_item_id = ".$id;
         */


        //$data['item'] = $subitem->findAll($where." ORDER BY order_number+0,id"); //การใส่เงื่อนไขการ select ข้อมูลจากฐาน ให้ใส่เงื่อนไขใน()ของ findall ได้เลยโดยไม่ต้องใส่ WHERE
        // $data['navi'] = $navi;
        $data['item'] = Yii::app()->db->createCommand($sql)->queryAll();
        $data['gid'] = $gid;
        $data['id'] = $id;
        $data['lv'] = $lv;
        $this->renderPartial('//backOffice/SysItems', $data);
    }

    /*
      public function actionSub2item() {
      //ดึงข้อมูลที่ได้จาก Model มาแสดง
      $up1itemid = $_GET['up1id'];
      $subitem = new SysItems();
      $data['subitem'] = $subitem->findAll("delete_flag='0' AND upper_item_id = '$up1itemid'"); //การใส่เงื่อนไขการ select ข้อมูลจากฐาน ให้ใส่เงื่อนไขใน()ของ findall ได้เลยโดยไม่ต้องใส่ WHERE
      $this->render('//backOffice/SysItems', $data);
      }
     */

    public function actionItemOrderSave() {
        $itemId = $_POST['item_id'];
        // $itemGroupId = $_POST['gid'];

        $c = 0;
        $i = 1;


        foreach ($itemId as $id):

            $where = "id = " . $id;
            $rs = array(
                'order_number' => $i++
            );

            $c += Yii::app()->db->createCommand()->update('sys_items', $rs, $where);

        endforeach;

        echo $c;
    }

    public function actionSaveItemGroups() {
        //$owner = Yii::app()->session['userid'];
        $distId = Yii::app()->session['distcode'];
        $userId = Yii::app()->session['userid'];
        $data = array(
            'item_group_name' => $_POST['itemgroup'],
            'item_group_name_en' => $_POST['itemgroup_en'],
            'delete_flag' => 0,
            'create_by' => $userId,
            'distid' => $distId,
            'comment' => $_POST['comment']
        );

        Yii::app()->db->createCommand()
                ->insert('sys_item_groups', $data);
    }

    public function actionSaveItem() {
        $distId = Yii::app()->session['distcode'];
        $userId = Yii::app()->session['userid'];
        //การเลือกข้อมูลจากฐานข้อมูลขึ้นมาตามเงื่อนไข เพื่อเอาค่ามาคำนวณ
        $lv = isset($_POST['lv']) ? $_POST['lv'] : "0";
        $gid = isset($_POST['gid']) ? $_POST['gid'] : "0";
        //$id = isset($_POST['id'])?$_POST['id']:"0";
        $uid = isset($_POST['uid']) ? $_POST['uid'] : "0";
        //echo $lvl;
        //เช็คค่า level ที่ส่งมา
        if ($lv == 0) {
            $lv += 1;
        }

        if (strlen($distId) <= 0 && strlen($userId) <= 0) {
            echo "nologin";
        } else {

            //$lvlnum = $lvl+1;
            //นับ upper item
            $chk = "SELECT count(*) AS maxid FROM sys_items WHERE upper_item_id = '$uid' AND item_group_id = '$gid' and delete_flag = 0";
            $row = Yii::app()->db->createCommand($chk)->queryScalar();


            $refid = $this->getRefId();

            //if(isset($_POST['orderNumber']) && strlen($_POST['orderNumber']) > 0) $numorder = $_POST['orderNumber'];
            // else $numorder = ($row+1);
            $numorder = ($row + 1);
            //นำข้อมูลเข้าฐานข้อมูล
            //$owner = Yii::app()->session['userid'];

            $data = array(
                'item_group_id' => $gid,
                'item_name' => $_POST['itemname'],
                'item_name_en' => $_POST['itemname_en'],
                'item_code' => trim($_POST['itemcode']),
                'upper_item_id' => $uid,
                'order_number' => $numorder,
                //'levelid'=> ($lv+1),
                'reference_id' => $refid,
                'create_by' => $userId,
                'distid' => $distId
            );

            Yii::app()->db->createCommand()->insert('sys_items', $data); //Insert เข้าตารางในฐานข้อมูล


            $select_itemid = new SysItems();
            $itemrow = $select_itemid->find("reference_id = $refid")->id;

            $this->setUpperItemAll($itemrow);
            $this->setUnderLevel($itemrow);
        }
    }

    //function แก้ไขข้อมูล
    public function actionEditItemGroup() {
        $owner = Yii::app()->session['userid'];
        $gid = $_POST['id'];
        $id = $_POST['id'];

        $data = array(
            'item_group_name' => $_POST['itemgroup'],
            'item_group_name_en' => $_POST['itemgroup_en'],
            'comment' => $_POST['comment']
        );

        Yii::app()->db->createCommand()->update('sys_item_groups', $data, "id = '$id' ");
    }

    //function แก้ไขข้อมูล
    public function actionEditItem() {
        $owner = Yii::app()->session['userid'];
        $item_id = $_POST['id'];
        $data = array(
            'item_code' => trim($_POST['item']),
            'item_name' => $_POST['itemname'],
            'item_name_en' => $_POST['itemname_en'],
        );


        Yii::app()->db->createCommand()->update('sys_items', $data, "id = '$item_id' ");
        /*
          $upper = "update sys_items set upper_item_all = getUpperItemAll($item_id) where id = $item_id";
          Yii::app()->db->createCommand($upper)->query();

          $under = "select count(DISTINCT levelid) as lv from sys_items where upper_item_all like '%|$item_id|%'";
          $itemlv = Yii::app()->db->createCommand($under)->queryScalar();

          $update_under = "update sys_items set under_level = $itemlv where id = $item_id";
          Yii::app()->db->createCommand($update_under)->query();
         * */
    }

    //function ตรวจสอบค่า flag
    public function actionCheckflag() {
        $group_id = $_POST['groupid'];
        $sql = "SELECT COUNT(*)
                FROM sys_items it
                WHERE it.item_group_id = '$group_id' AND it.delete_flag = 0";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();

        echo $count;
    }

    //function ตรวจสอบค่า flag sysItem
    public function actionCheck_flagItem() {
        $item_id = $_POST['item_id'];
        $sql = "SELECT COUNT(*)
                FROM sys_items it
                WHERE it.upper_item_id = '$item_id' AND it.delete_flag = 0";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();

        echo $count;
    }

    //function delete group
    public function actionDeletegroup() {
        $group_id = $_POST['groupid'];
        $data = array('delete_flag' => '1');
        Yii::app()->db->createCommand()
                ->update('sys_item_groups', $data, "id = '$group_id' ");
    }

    //function delete group
    public function actionDeleteitem() {
        $item_id = $_POST['item_id'];
        $data = array('delete_flag' => '1');
        Yii::app()->db->createCommand()
                ->update('sys_items', $data, "id = '$item_id' ");

        $this->setUnderLevel($item_id);
    }

    /*
      private function getGroupName($gid){
      $itemgroup = new SysItemGroups();
      $ig = $itemgroup->find("id = $gid");
      return $ig->item_group_name;
      }

      private function getItemName($id){
      if($id != ""){
      $item = new SysItems();
      $it = $item->find("id = $id");
      return $it->item_name;
      }else{
      return "";
      }
      }


      private function genNavi($itemId){
      $item = new SysItems();

      $it = $item->find("id = ".$itemId);

      $navi = array(
      "id" => $it->id,
      "name" => $it->item_name
      );
      if($it->upper_item_id != '' || $it->upper_item_id != null){
      $this->genNavi($it->upper_item_id);
      $this->navi[] = $navi;
      }else{
      return true;
      }
      }
     */

    function actionGetNavigator() {
        $id = $_POST['id'];
        $groupId = $_POST['gid'];

        $itemGroups = new SysItemGroups();
        $itemGroup = $itemGroups->find("id = $groupId")->item_group_name;

        $navi = "<li><a href=\"" . Yii::app()->createUrl('Sysitems') . "\"><span class=\"glyphicon glyphicon-home\"></span> หน้าหลัก</a></li>";



        if ($id == '0') {
            $navi .= "<li class='active'>" . $itemGroup . "</li>";
        } else {

            $navi .= "<li><a href=\"javascript:manageItems('" . $groupId . "','0','0')\">" . $itemGroup . "</a></li>";

            $sql = "SELECT CONCAT('''',REPLACE(CONCAT(id,IFNULL(upper_item_all,'')),'|',''','''),'''') FROM sys_items WHERE id = $id";
            $items = Yii::app()->db->createCommand($sql)->queryScalar();

            if (strlen($items) > 0) {

                $sql = "SELECT * FROM sys_items WHERE id IN($items) ORDER BY levelid";
                $result = Yii::app()->db->createCommand($sql)->queryAll();

                $i = 1;
                foreach ($result as $rs):
                    //if(strlen($rs['item_name']) > 70) $name = substr($rs['item_name'],0,70)."...";
                    //else $name = $rs['item_name'];
                    $name = $rs['item_name'];

                    if ($i++ == count($result)) {
                        $navi .= "<li class='active'>" . $name . "</li>";
                    } else {
                        $navi .= "<li><a href=\"javascript:manageItems('" . $rs['item_group_id'] . "','" . $rs['levelid'] . "','" . $rs['id'] . "')\">" . $name . "</a></li>";
                    }
                endforeach;
            }
        }

        echo $navi;
    }

    public function actionCopy() {
        $userId = Yii::app()->session['userid'];
        $cb = $_POST['cb'];
        $ref = time();

        Yii::app()->db->createCommand()->delete("sys_copy_items", "userid=:userid", array(":userid" => $userId));

        foreach ($cb as $c):
            $data = array(
                'userid' => $userId,
                'ref' => $ref,
                'itemid' => $c
            );

            Yii::app()->db->createCommand()->insert('sys_copy_items', $data); //Insert เข้าตารางในฐานข้อมูล
        endforeach;

        Yii::app()->session['copyRefId'] = $ref;
        Yii::app()->session['copyText'] = '<div class="alert alert-success" role="alert">คุณคัดลอกไว้จำนวน ' . count($cb) . ' รายการ</div>';

        echo $ref . "|" . count($cb);
    }

    public function actionCancelCopy() {
        $userId = Yii::app()->session['userid'];
        Yii::app()->db->createCommand()->delete("sys_copy_items", "userid=:userid", array(":userid" => $userId));
        unset(Yii::app()->session['copyRefId']);
        unset(Yii::app()->session['copyText']);
    }

    public function actionPaste() {
        $userId = Yii::app()->session['userid'];
        $distId = Yii::app()->session['distcode'];
        $refId = Yii::app()->session['copyRefId'];
        $gid = $_POST['gid'];
        $uid = $_POST['uid'];
        $lv = $_POST['lv'];

        $sql = "SELECT item_code,item_name FROM sys_copy_items cp
                INNER JOIN sys_items i ON i.id = cp.itemid
                WHERE cp.userid = $userId AND ref='$refId'";

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $rs):
            // echo "item_code=". $rs['item_code']." item_name=".$rs['item_name']."\n";
            $this->saveItems($gid, $rs['item_code'], $rs['item_name'], $uid, $lv + 1, $userId, $distId);
        endforeach;

        echo "success";
        //echo "gid=$gid uid=$uid lv=$lv";
    }

    public function actionMove() {
        $userId = Yii::app()->session['userid'];
        $distId = Yii::app()->session['distcode'];
        $refId = Yii::app()->session['copyRefId'];
        $gid = $_POST['gid'];
        $uid = $_POST['uid'];
        $lv = $_POST['lv'];

        $sql = "SELECT itemid FROM sys_copy_items
                 WHERE userid = $userId AND ref='$refId'";

        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $rs):
            $this->moveItems($gid, $uid, $lv, $rs['itemid'], $userId, $distId);
        endforeach;
    }

    private function getRefId() {
        list($usec, $sec) = explode(' ', microtime());
        $s1 = (int) $sec * 1000;
        $s2 = round((float) $usec * 1000);
        return str_replace(".", "", $s1 + $s2);
    }

    private function saveItems($groupId, $itemCode, $itemName, $upperId, $lv, $userId, $distId) {
        //$lvlnum = $lvl+1;
        //นับ upper item
        $chk = "SELECT count(*) AS maxid FROM sys_items WHERE upper_item_id = '$upperId' AND item_group_id = '$groupId' and delete_flag = 0";
        $row = Yii::app()->db->createCommand($chk)->queryScalar();

        $refid = $this->getRefId();
        $numorder = ($row + 1);

        $data = array(
            'item_group_id' => $groupId,
            'item_name' => $itemName,
            'item_code' => $itemCode,
            'upper_item_id' => $upperId,
            'order_number' => $numorder,
            'levelid' => ($lv + 1),
            'reference_id' => $refid,
            'create_by' => $userId,
            'distid' => $distId
        );

        Yii::app()->db->createCommand()->insert('sys_items', $data); //Insert เข้าตารางในฐานข้อมูล


        $select_itemid = new SysItems();
        $itemrow = $select_itemid->find("reference_id = $refid")->id;

        $this->setUpperItemAll($itemrow);
        $this->setUnderLevel($itemrow);
    }

    private function moveItems($groupId, $upperId, $lv, $itemId, $userId, $distId) {

        /* จำ upper และ lower อันเก่าแล้ววิ่งด้วย */
        $items = new SysItems();
        $oldUpperAll = $items->find("id = $itemId")->upper_item_id;

        $chk = "SELECT count(*) AS maxid FROM sys_items WHERE upper_item_id = '$upperId' AND item_group_id = '$groupId' and delete_flag = 0";
        $row = Yii::app()->db->createCommand($chk)->queryScalar();
        $numorder = ($row + 1);

        $data = array(
            'item_group_id' => $groupId,
            'upper_item_id' => $upperId,
            'order_number' => $numorder,
            'levelid' => ($lv + 1),
            'create_by' => $userId,
            'distid' => $distId
        );

        Yii::app()->db->createCommand()->update('sys_items', $data, "id = $itemId ");

        $this->setUpperItemAll($itemId);
        $this->setUnderLevel($itemId);
        $this->setUnderLevelByUpperId($oldUpperAll);

        $lower = $items->findAll("upper_item_all LIKE '%|$itemId|%' ORDER BY levelid");
        foreach ($lower as $lw):
            $this->setUpperItemAll($lw->id);
            $this->setUnderLevel($lw->id);
        endforeach;
    }

    private function setUpperItemAll($itemId) {
        $upper = "update sys_items set upper_item_all = getUpperItemAll($itemId) where id = $itemId";
        Yii::app()->db->createCommand($upper)->query();
    }

    /*
      private function setUnderLevel($itemId) {
      $items = new SysItems();
      $upperItemAll = $items->find("id = '$itemId'")->upper_item_all;
      if (substr($upperItemAll, 0, 1) == '|')
      $upperItemAll = substr($upperItemAll, 1, strlen($upperItemAll));

      if (substr($upperItemAll, -1) == "|") {
      $upperItemAll = substr($upperItemAll, 0, strlen($upperItemAll) - 2);
      }
      $item = explode("|", $upperItemAll);
      if ($item[0] != '') {
      $newLV = count($item) + 1;
      } else {
      $newLV = 1;
      }

      $uplevel = "UPDATE sys_items SET levelid = '$newLV' WHERE id = '$itemId'";
      Yii::app()->db->createCommand($uplevel)->query();


      foreach ($item as $it):
      $under = "select count(DISTINCT levelid) as lv from sys_items where delete_flag = 0 AND upper_item_all like '%|$it|%'";
      $itemlv = Yii::app()->db->createCommand($under)->queryScalar();

      //$update_under = "update sys_items set under_level = '$itemlv' where id = $it";
      //Yii::app()->db->createCommand($update_under)->query();
      //Update 16/05/2559 By Kimniyom
      $columns = array(
      "under_level" => $itemlv
      );
      Yii::app()->db->createCommand()
      ->update("sys_items", $columns, "id = '$it' ");
      endforeach;
      }
     * 
     */

    //UPDATE FUNCTION BY KIMNIYOM 2017-01-17 
    private function setUnderLevel($itemId) {
        $items = new SysItems();
        $upperItemAll = $items->find("id = '$itemId'")->upper_item_all;
        if (substr($upperItemAll, 0, 1) == '|')
            $upperItemAll = substr($upperItemAll, 1, strlen($upperItemAll));

        if (substr($upperItemAll, -1) == "|") {
            $upperItemAll = substr($upperItemAll, 0, strlen($upperItemAll) - 1);
            //$upperItemAll = str_replace("|", $upperItemAll, "");
        }
        $item = explode("|", $upperItemAll);
        if ($item[0] != '') {
            $newLV = count($item) + 1;
        } else {
            $newLV = 1;
        }

        //echo $newLV; exit;



        $uplevel = "UPDATE sys_items SET levelid = '$newLV' WHERE id = '$itemId'";
        Yii::app()->db->createCommand($uplevel)->query();


        foreach ($item as $it):
            $under = "select count(DISTINCT levelid) as lv from sys_items where delete_flag = 0 AND upper_item_all like '%|$it|%' ";
            $itemlv = Yii::app()->db->createCommand($under)->queryScalar();

            $update_under = "UPDATE sys_items SET under_level = '" . $itemlv . "' WHERE id = '" . $it . "'";
            Yii::app()->db->createCommand($update_under)->query();
            //Yii::app()->db->createCommand($update_under)->query();
            /*
              $columns = array(
              "under_level" => $itemlv
              );
              Yii::app()->db->createCommand()
              ->update("sys_items", $columns, "id = '$it' ");
             * 
             */

            //echo $update_under;
        endforeach;
    }

    private function setUnderLevelByUpperId($upperItemAll) {
        //$upperItemAll = $select_itemid->find("id = $itemId")->upper_item_all;
        if (substr($upperItemAll, 0, 1) == '|')
            $upperItemAll = substr($upperItemAll, 1, strlen($upperItemAll));
        if (substr($upperItemAll, -1) == "|") {
            $upperItemAll = substr($upperAll, 0, strlen($upperAll) - 2);
        }
        $item = explode("|", $upperItemAll);
        if ($item[0] != '') {
            $newLV = count($item) + 1;
        } else {
            $newLV = 1;
        }

        // $uplevel = "UPDATE sys_items SET levelid = $newLV WHERE id = $itemId";
        // Yii::app()->db->createCommand($uplevel)->query();
        //if($item[0] != ''){
        foreach ($item as $it):
            $under = "select count(DISTINCT levelid) as lv from sys_items where delete_flag = 0 AND upper_item_all like '%|$it|%'";
            $itemlv = Yii::app()->db->createCommand($under)->queryScalar();

            $update_under = "update sys_items set under_level = $itemlv where id = $it";
            Yii::app()->db->createCommand($update_under)->query();
        endforeach;
        // }
    }

  
}

?>
