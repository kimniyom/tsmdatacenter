<?php

/**
 * Description of UserPrivileges
 *
 * @author Sittipong Promhan
 * @create 15 พ.ค. 2558 10:14:44
 * @copyright (c) Tak Provincial Health Office
 */
class UserprivController extends Controller {

    public $layout = 'backend';

    public function actionIndex() {
        $this->actionList();
    }

    public function beforeAction($action) {
        if(isset(Yii::app()->session['userid']) && (Yii::app()->session['admin_flag'] == 1 || Yii::app()->session['report_flag'] == 1)){
            return true;
        }else{
            $this->render('//user/accessdeny');
        }
    }
    
    public function actionList() {

        $distCode = Yii::app()->session['distcode'];

        $sql = "SELECT o.off_name,r.* FROM sys_reportuser r
                LEFT JOIN co_office o ON o.off_id = r.hospcode
                WHERE distcode = '$distCode' AND delete_flag = 0;";
        $users = Yii::app()->db->createCommand($sql)->queryAll();

        $table = '<div class="card">';
        $table .= '<div class="card-title blue white-text" style="padding:10px;">รายชื่อผู้ใช้งาน</div>';
        $table .= '<div class="card-content"><p>กำหนดสิทธิ์การบันทึกข้อมูล</p></div>';
        $table .= '<table id="user" class="bordered striped">';

        $table .= '<tr class="success">';
        $table .= '<th width="5%">id</th>';
        $table .= '<th width="15%">ชื่อผู้ใช้</th>';
        $table .= '<th width="30%">ชื่อ-สกุล</th>';
        $table .= '<th>สถานที่ทำงาน</th>';
        $table .= '<th>สิทธิ์</th>';
        $table .= '</tr>';
        foreach ($users as $user):
            $priv = "";
            if($user['admin_flag'] == 1)
                $priv .= "|| ผู้ดูแลระบบ&nbsp;&nbsp;";
             if($user['report_flag'] == 1)
                $priv .= "|| จัดการรายงานได้&nbsp;&nbsp;";
             if($user['user_flag'] == 1)
                $priv .= "|| จัดการผู้ใช้ได้&nbsp;&nbsp;";
        
             $priv .= "|| บันทึกข้อมูลได้&nbsp;&nbsp;";
             
            $table .= '<tr>';
            $table .= '<td class="hidden">' . $user['userid'] . '</td>';
            $table .= '<td>' . $user['username'] . '</td>';
            $table .= '<td>' . $user['name'] . ' &nbsp ' . $user['lname'] . '</td>';
            $table .= '<td>' . $user['off_name'] . '</td>';
            $table .= '<td>'.$priv.'</td>';
            $table .= '</tr>';
        endforeach;

        $table .='</table></div>';

        $data['userList'] = $table;
        $this->render('//user/privileges', $data);
    }

    public function actionItemGroup() {

        $distCode = Yii::app()->session['distcode'];
        $userId = $_POST['userId'];

        $sql = "SELECT id,item_group_name,distid,IFNULL(amount,0) AS amount FROM sys_item_groups i
                INNER JOIN (SELECT row_group_id FROM sys_reportlist WHERE row_group_id IS NOT NULL GROUP BY row_group_id) r ON r.row_group_id = i.id
                LEFT JOIN (SELECT item_group_id,COUNT(*) AS amount FROM sys_privileges WHERE userid = $userId GROUP BY item_group_id) p ON p.item_group_id = i.id
                WHERE delete_flag = 0 AND distid = '$distCode'";

        $itemGroup = Yii::app()->db->createCommand($sql)->queryAll();

        $str = "";
        foreach ($itemGroup as $ig):
            $str .= '<a href="javascript:itemList(' . $ig['id'] . ','.$userId.')" class="list-group-item"><span class="badge">' . $ig['amount'] . '</span>' . $ig['item_group_name'] . '</a>';
        endforeach;

        echo $str;
    }

    public function actionItemList() {

        $groupId = $_POST['groupId'];
        $userId = $_POST['userId'];
        $distCode = Yii::app()->session['distcode'];
        $itemGroups = new SysItemGroups();
        $itemGroup = $itemGroups->find("delete_flag = 0 AND distid = '$distCode' AND id = $groupId");

        $str = "";

        if (count($itemGroup) > 0) {
            $str = $this->getItemListByGroup($groupId,$userId);
        } else {
            $str = "คุณทำแบบนี้ไม่ดีนะจ๊ะ!!!";
        }

        echo $str;
    }

    private function getItemListByGroup($groupId, $userId) {

        $sql = "SELECT IF(p.userid IS NOT NULL,'Y','N') check_flag,s.* FROM sys_items s
                    LEFT JOIN (SELECT * FROM sys_privileges WHERE userid = $userId AND item_group_id = $groupId) p ON p.itemid = s.id
                    WHERE s.item_group_id = $groupId AND levelid = 1 AND delete_flag = 0
                    ORDER BY order_number,id";

        $result = Yii::app()->db->createCommand($sql)->queryAll();

        $items = new SysItems();

        $str = "<ul>";
        foreach ($result as $rs):

            //level 1
            $check_flag1 = "";
            if ($rs['check_flag'] == "Y")
                $check_flag1 = "class=\"checked\"";
            $str .= "<li id='" . $rs['id'] . "' $check_flag1>" . $rs['item_name'];

            //level 2
            //$item = $items->findAll("delete_flag = 0 AND upper_item_id = ".$rs['id']." ORDER BY order_number,id");
            $sql = "SELECT IF(p.userid IS NOT NULL,'Y','N') check_flag,s.* FROM sys_items s
                    LEFT JOIN (SELECT * FROM sys_privileges WHERE userid = $userId AND item_group_id = $groupId) p ON p.itemid = s.id
                    WHERE s.upper_item_id = " . $rs['id'] . " AND delete_flag = 0
                    ORDER BY order_number,id";

            $item = Yii::app()->db->createCommand($sql)->queryAll();

            if (count($item) > 0) {

                $str .= "<ul>";
                foreach ($item as $it):

                    //level 3
                    //$item2 = $items->findAll("delete_flag = 0 AND upper_item_id = ".$it['id']." ORDER BY order_number,id");
                    $sql = "SELECT IF(p.userid IS NOT NULL,'Y','N') check_flag,s.* FROM sys_items s
                            LEFT JOIN (SELECT * FROM sys_privileges WHERE userid = $userId AND item_group_id = $groupId) p ON p.itemid = s.id
                            WHERE s.upper_item_id = " . $it['id'] . " AND delete_flag = 0
                            ORDER BY order_number,id";

                    $item2 = Yii::app()->db->createCommand($sql)->queryAll();

                    //level 2

                    $check_flag2 = "";
                    if ($it['check_flag'] == "Y")
                        $check_flag2 = "class=\"checked\"";

                    $str .= "<li id='" . $it['id'] . "' $check_flag2>" . $it['item_name'];
                    if (count($item2) > 0) {


                        $str .= "<ul>";
                        foreach ($item2 as $it2):
                            $check_flag3 = "";
                            if ($it2['check_flag'] == "Y")
                                $check_flag3 = "class=\"checked\"";
                            $str .= "<li id='" . $it2['id'] . "' $check_flag3>" . $it2['item_name'] . "</li>";
                        endforeach;
                        $str .= "</ul>";
                    }
                    $str .= '</li>';
                endforeach;
                $str .= '</ul>';
            }
            $str .= '</li>';
        endforeach;
        $str .= '</ul>';

        return $str;
    }

    public function actionPrivSave() {
        $id = $_POST['id'];
        $userId = $_POST['userId'];
        $groupId = $_POST['groupId'];

        $sql = "DELETE FROM sys_privileges WHERE userid = $userId AND item_group_id = $groupId";
        Yii::app()->db->createCommand($sql)->query();

        if(count($id) > 0){
            foreach ($id as $i):
                $data = array(
                    'userid' => $userId,
                    'item_group_id' => $groupId,
                    'itemid' => $i
                );

                Yii::app()->db->createCommand()->insert('sys_privileges', $data);
            endforeach;
        }
        echo "SUCCESS";
        //echo implode(",", $id);
        //print_r($id);
    }

}

?>
