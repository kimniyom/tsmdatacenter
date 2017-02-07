<?php

/*
 * Filter : Tak Datacenter
 * Author : Kimniyom
 */

class FilterController extends CController {

    public function actionIndex() {
        $this->render('//report/Filter');
    }

    public function actionFilterflowOne() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        //ค่ากำหนดของ ฐานข้อมูล
        /*
          $host = "localhost";
          $username = "root";
          $password = "1234";
          $dbname = "takic";

          //เชื่อมต่อกับ MySQL
          $connect = mysql_connect($host, $username, $password) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
          $db = mysql_select_db($dbname) or die("ฐานข้อมูลไม่ถูกต้อง");
          mysql_query("SET NAMES 'utf8'");
         * 
         */
        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = " 1=1";
                $text = Language::TextFilterSelectAll();
            } else {
                $where = " distid = '$val' ";
                $text = Language::TextFilterDefaultSelect();
            }
            /*
              $sql = "SELECT *
              FROM sys_items s
              WHERE s.`item_group_id` = '9'
              AND s.`upper_item_id` = '0' AND $where";
             * 
             */
            $sql = "SELECT *  FROM co_district WHERE $where AND distid != '6300' ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"dochange('pcu', this.value)\" class='browser-default' >\n";
            echo "<option value='0'>-" . $text . "-</option>\n";

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'pcu') {
            echo "<select  name='pcu' id='pcu'  class='browser-default' >\n";
            /*
              $sql = "SELECT *
              FROM sys_items s
              WHERE s.`item_group_id` = '9'
              AND s.`upper_item_id` = '$val' ";
             * 
             */
            $sql = "SELECT off_id,off_name FROM co_office o WHERE o.distid = '$val' AND hasdata = 'Y' ORDER BY CONCAT(o.off_type,off_id) DESC";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            foreach ($result as $ban) {
                $val = $ban['off_id'];
                $label = $ban['off_name' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }

        echo "</select>\n";
    }

    public function actionFilterHos() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            $sql = "select * from co_district order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"dochange('hos', this.value)\" class='browser-default' >\n";
            echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'hos') {
            echo "<select name='hos' id='hos' class='browser-default' onChange=\"set_hos(this.value)\" >\n";
            $sql = "select * from co_office where distid = '$val'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            foreach ($result as $tm) {
                $val = $tm['off_id'];
                $label = $tm['off_name' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    public function actionAmpur_tambon_pcu_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        //ค่ากำหนดของ ฐานข้อมูล
        /*
          $host = "localhost";
          $username = "root";
          $password = "1234";
          $dbname = "takic";

          //เชื่อมต่อกับ MySQL
          $connect = mysql_connect($host, $username, $password) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
          $db = mysql_select_db($dbname) or die("ฐานข้อมูลไม่ถูกต้อง");
          mysql_query("SET NAMES 'utf8'");
         * 
         */
        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"dochange('tumbon', this.value)\" class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }


            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'tumbon') {
            echo "<select name='tumbon' id='tumbon' onChange=\"dochange('pcu', this.value)\" class='browser-default' >\n";
            $sql = "select * from ctambon where ampurcode = '$val'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            foreach ($result as $tm) {
                $val = $tm['tamboncodefull'];
                $label = $tm['tamboncodefull' . Language::GetLanguageDefault()] . '-' . $tm['tambonname'];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'pcu') {
            echo "<select  name='pcu' id='pcu'  class='browser-default' >\n";
            $sql = "select * from co_office where subdistid = '$val'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            foreach ($result as $ban) {
                $val = $ban['off_id'];
                $label = $ban['off_id'] . ' ' . $ban['off_name' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }

        echo "</select>\n";
    }

    public function actionAmpur_pcu_multiyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        //ค่ากำหนดของ ฐานข้อมูล
        /*
          $host = "localhost";
          $username = "root";
          $password = "1234";
          $dbname = "takic";

          //เชื่อมต่อกับ MySQL
          $connect = mysql_connect($host, $username, $password) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
          $db = mysql_select_db($dbname) or die("ฐานข้อมูลไม่ถูกต้อง");
          mysql_query("SET NAMES 'utf8'");
         * 
         */
        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }


            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    public function actionAmpur_tambon_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }


            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    public function actionAmpur_pcu_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = Yii::app()->request->getPost('src');
        $val = Yii::app()->request->getPost('val');
        $filter = "";
        //ค่ากำหนดของ ฐานข้อมูล
        /*
          $host = "localhost";
          $username = "root";
          $password = "1234";
          $dbname = "takic";

          //เชื่อมต่อกับ MySQL
          $connect = mysql_connect($host, $username, $password) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
          $db = mysql_select_db($dbname) or die("ฐานข้อมูลไม่ถูกต้อง");
          mysql_query("SET NAMES 'utf8'");
         * 
         */
        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();

            $filter = "<select name='amphur' id='amphur' class='browser-default'>";
            if (Yii::app()->session['distId'] == '6300') {
                $filter .= "<option value='0'>" . Language::TextFilterSelectAll() . "</option>";
            } else {
                $filter .= "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                $filter .= "<option value=\"$val\">$label</option> \n";
            }
        }

        $filter .= "</select>";
        echo $filter;
    }

    public function actionAmpur_selectpcu_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"dochange('pcu', this.value)\" class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'pcu') {
            $sql = "SELECT off_id,off_name FROM  co_office WHERE distid = '$val' AND hasdata = 'Y' ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='pcu' id='pcu'  class='browser-default' >\n";
            echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            foreach ($result as $am) {
                $val = $am['off_id'];
                $label = $am['off_name' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    public function actionAmpur_selectpcur506_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"dochange('pcu', this.value)\" class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>-ทั้งหมด-</option>\n";
            } else {
                echo "<option value='0'>-กรุณาเลือกอำเภอ-</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname'];
                echo "<option value=\"$val\">$label</option> \n";
            }
        } else if ($data == 'pcu') {
            $sql = "SELECT off_id,HOSP_NAME,off_name FROM office_r506 WHERE LEFT(HOSP_CODE,4) = '$val' ";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='pcu' id='pcu'  class='browser-default' >\n";
            echo "<option value='0'>-ทั้งหมด-</option>\n";
            foreach ($result as $am) {
                $val = $am['off_id'];
                $label = $am['HOSP_NAME'];
                echo "<option value=\"$val\">$val $label</option> \n";
            }
        }
        echo "</select>\n";
    }

    /* Filter ปีงบประมาณ สามารถเลือกได้ว่าจะเอา ตำบล หรือ สถาบริการ */

    public function actionAmpur_tambon_or_pcu_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' onChange=\"check_type(this.value)\" class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    /* Filter ปีงบประมาณ สามารถเลือกได้ว่าจะเอา เทอม1 หรือ เทอม2 */

    public function actionAmpur_term() {
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    /* Filter ปีงบประมาณ ไตรมาส */

    public function actionAmpur_period() {
        $data = $_GET['data'];
        $val = $_GET['val'];

        if ($data == 'amphur') {
            if ($val == '6300') {
                $where = "WHERE 1=1 AND distid != '6300' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }

    public function actionAmpurborderhealth_pcu_singleyear() {
        //กำหนดให้ IE อ่าน page นี้ทุกครั้ง ไม่ไปเอาจาก cache
        $data = $_GET['data'];
        $val = $_GET['val'];

        //ค่ากำหนดของ ฐานข้อมูล
        /*
          $host = "localhost";
          $username = "root";
          $password = "1234";
          $dbname = "takic";

          //เชื่อมต่อกับ MySQL
          $connect = mysql_connect($host, $username, $password) or die("ไม่สามารถเชื่อมต่อฐานข้อมูลได้");
          $db = mysql_select_db($dbname) or die("ฐานข้อมูลไม่ถูกต้อง");
          mysql_query("SET NAMES 'utf8'");
         * 
         */
        if ($data == 'amphur') {
            if ($val == '6300' || $val == '6310') {
                $where = "WHERE 1=1 AND distid != '6300' AND borderhealth = 'Y' ";
            } else {
                $where = "WHERE distid = '$val' ";
            }
            $sql = "select * from co_district $where  order by distid";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            echo "<select name='amphur' id='amphur' class='browser-default' >\n";
            if (Yii::app()->session['distId'] == '6300' || Yii::app()->session['distId'] == '6310') {
                echo "<option value='0'>" . Language::TextFilterSelectAll() . "</option>\n";
            } else {
                echo "<option value='0'>" . Language::TextFilterDefaultSelect() . "</option>\n";
            }

            foreach ($result as $am) {
                $val = $am['distid'];
                $label = $am['distname' . Language::GetLanguageDefault()];
                echo "<option value=\"$val\">$label</option> \n";
            }
        }
        echo "</select>\n";
    }
    
    

}

?>
