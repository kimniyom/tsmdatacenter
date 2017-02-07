<?php

class UserController extends Controller {

    public $layout = "backend";

    public function actionIndex() {
        $this->render('//user/login');
    }

    public function actionChecklogin() {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $user = new SysReportuser();
        $result = $user->find("username = '" . $username . "'");
        if (isset($result)) {
            if ($result->password == md5($password)) {
                $name = $result['name'];
                $hospcode = $result['hospcode'];
                $distcode = $result['distcode'];
                $userid = $result['userid'];
                Yii::app()->session['name'] = $name;
                Yii::app()->session['hospcode'] = $hospcode;
                Yii::app()->session['distcode'] = $distcode;
                Yii::app()->session['userid'] = $userid;
                Yii::app()->session['admin_flag'] = $result['admin_flag'];
                Yii::app()->session['report_flag'] = $result['report_flag'];
                Yii::app()->session['user_flag'] = $result['user_flag'];
                echo "success";
            } else {
                echo "unsuccess";
                //echo "\n rs pass = $result->password";
                //echo "\n md5 pass =  ".md5($password);
            }
        } else {
            echo "unsuccess";
        }
    }

    public function actionlogout() {
        Yii::app()->session->destroy();
        $this->redirect(array('//main'));
    }

    public function actionShowUser() {
        //$showuser = new SysReportuser();
        //$data['listuser'] = $showuser->findAll();

        $showuser = "SELECT *
                FROM sys_reportuser u
                LEFT OUTER JOIN co_district d ON u.distcode = d.distid 
                LEFT OUTER JOIN co_office o ON u.hospcode = o.off_id 
                WHERE u.delete_flag = 0";
        $data['user'] = Yii::app()->db->createCommand($showuser)->queryAll();

        $selecthos = "SELECT * FROM co_office";
        $data['hos'] = Yii::app()->db->createCommand($selecthos)->queryAll();

        //การส่งค่าใน CreateCommand จะต้องส่งค่าไปเป็น array
        $this->render('//backOffice/Userlist', $data);
    }

    public function actionSaveUser() {
        $username = $_POST['user'];
        $chkuser = "SELECT count(*) FROM sys_reportuser u where username = '$username' ";
        $count = Yii::app()->db->createCommand($chkuser)->queryScalar();
        if ($count == 0) {
            $data = array(
                'username' => $_POST['user'],
                'password' => md5($_POST['pass']),
                'name' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'hospcode' => $_POST['hos'],
                'distcode' => $_POST['amphur'],
                'delete_flag' => '0'
            );

            Yii::app()->db->createCommand()->insert('sys_reportuser', $data);
            echo "save";
        } else {
            echo "notnull";
        }
    }

    public function actionEditUser() {
        $dist = $_POST['dist'];
        if ($dist == '') {
            $dist = $_POST['distold'];
        }
        $uid = $_POST['userid'];
        $data = array(
            'username' => $_POST['user'],
            'password' => md5($_POST['pass']),
            'name' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'hospcode' => $_POST['hos'],
            'distcode' => $dist
        );

        $query = Yii::app()->db->createCommand()->update('sys_reportuser', $data, "userid = '$uid' ");
        if (isset($query)) {
            echo "save";
        } else {
            echo "fails";
        }
    }

    public function actionDeleteUser() {
        $userid = $_POST['uid'];
        $data = array('delete_flag' => '1');
        $query = Yii::app()->db->createCommand()->update('sys_reportuser', $data, "userid = '$userid' ");
        if (isset($query)) {
            echo "save";
        } else {
            echo "fails";
        }
    }

    public function actionUserlist() {

        $showuser = "SELECT *
                FROM sys_reportuser u
                LEFT OUTER JOIN co_district d ON u.distcode = d.distid 
                LEFT OUTER JOIN co_office o ON u.hospcode = o.off_id 
                WHERE u.delete_flag = 0";
        $data = Yii::app()->db->createCommand($showuser)->queryAll();

        //$selecthos = "SELECT * FROM co_office";
        //$data['hos'] = Yii::app()->db->createCommand($selecthos)->queryAll();
        /*
          $table = '<table class="table table-striped table-hover" style="background:#fff">';
          foreach ($data as $it2):


          $table .= '<tr class="' . $it2['username'] . '">';
          $table .= '<td width="10%"></td>';
          $table .= '<td width="30%">' . $it2['username'] . '</td>';
          $table .= '<td width="40%">' . $it2['name'] . '</td>';
          $table .= '<td width="20%">แก้ไข</td>';
          $table .= '</tr>';
          endforeach;
          $table .= '</table>';
         */
        //การส่งค่าใน CreateCommand จะต้องส่งค่าไปเป็น array
        //$this->render('//backOffice/Showuser1', $data);
        echo $data;
    }

    public function actionTest() {
        echo "ทดสอบ ajax 5555777777777777777";
        echo "
            <button class='btn btn-success'>แสดง ajax</button>
            ";
        $showuser = "SELECT *
                FROM sys_reportuser u
                LEFT OUTER JOIN co_district d ON u.distcode = d.distid 
                LEFT OUTER JOIN co_office o ON u.hospcode = o.off_id 
                WHERE u.delete_flag = 0";
        $data['user'] = Yii::app()->db->createCommand($showuser)->queryAll();

        //query ข้อมูลแล้วส่งข้อมูลแบบ array ไปหน้า view เพื่อแสดงข้อมูลในรูปแบบต่าง ๆ
        $this->renderPartial('//backOffice/Showuser1', $data);

        //กรณีที่ไม่ต้องการแสดงข้อมูลในหน้า view สำหรับแสดงผลให้แทรกโคดการแสดงผลใน COntroller ได้เลย แต่การปรับแต่งตารางจะค่อนข้างยาก
        /*
          $table = '<table id="tabletest" class="table table-striped table-hover" style="background:#fff">';
          $i = 1;
          foreach ($data as $it2):


          $table .= '<tr class="' . $it2['username'] . '">';
          $table .= '<td width="10%">'.$i.'</td>';
          $table .= '<td width="30%">' . $it2['username'] . '</td>';
          $table .= '<td width="40%">' . $it2['name'] . '</td>';
          $table .= '<td width="20%">แก้ไข</td>';
          $table .= '</tr>';
          $i++;
          endforeach;
          $table .= '</table>';

          echo $table;
         * */
    }

}
