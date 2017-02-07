<?php

class HomeController extends Controller {

    public $layout = "webpage";

    public function actionIndex() {

        if (Language::getLangValue() == '') {
            Language::setLang('TH');
        }

        unset(Yii::app()->session['menu']);
        unset(Yii::app()->session['ampurname']);

        $this->render('index');
    }

    public function actionGetreportList($groupid = null, $groupname = null) {
        //$group_id = $_GET['group_id'];
        //$group_name = $_GET['group_name'];
        //$cat = new SysReportlist();
        $groupModel = new SysReportgroup();
        $query = "SELECT * FROM sys_reportlist WHERE menugroup_id = '$groupid' AND flag = '1' ORDER BY order_number,id";
        $data['listmenu'] = Yii::app()->db->createCommand($query)->queryAll();
        //$data['listmenu'] = $cat->findAll("menugroup_id = '$group_id' AND flag = '1' ORDER BY order_number,id");
        $data['group'] = $groupModel->GetDetailGroup($groupid);
        $data['groupid'] = $groupid;
        $data['groupname'] = $groupname;
        $this->render('//menu/listmenu', $data);
    }

    public function actionSetDevice() {
        $width = $_POST['screenWidth'];
        $height = $_POST['screenHeight'];

        Yii::app()->session['screenHeight'] = $height;
        Yii::app()->session['width'] = $width;
    }

    public function actionCheckBrowser() {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ( (isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-');

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            // do something for tablet devices
            print 'is tablet';
        } else if ($mobile_browser > 0) {
            // do something for mobile devices
            print 'is mobile';
        } else {
            // do something for everything else
            print 'is desktop';
        }
    }

    public function actionMenu() {
        //$distID = $_GET['distId'];
        //$ampurName = $_GET['ampurname'];
        //Yii::app()->session['ampurname'] = $ampurName;
        //$distId = Yii::app()->session['distId'] = $distID;
        $catalog = new SysReportcatalog();
        $logo = new SysLogo();
        $logoampur = $logo->Get_logo($distID);
        Yii::app()->session['logo'] = $logoampur;
        if ($distID == "6310") {
            Yii::app()->session['catalog'] = $catalog->findAll("owner = '6310' AND delete_flag = '0' ");
        } else {
            Yii::app()->session['catalog'] = $catalog->findAll("(owner = '$distId' or owner = '6300') AND owner != '6310' AND delete_flag = '0' ");
        }
        $data['text'] = "เลือกเมนู";

        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $data['year'] = $year + 543;

        if ($distID != "6310") {
            $Dashboard = new Dashboard();
            $kpi_dm_control = $Dashboard->kpi_dm_control($distID);
            $kpi_ht_control = $Dashboard->kpi_ht_control($distID);
            $kpi_ht_kidney = $Dashboard->kpi_ht_kidney($distID);
            $ncdscreen_dm_35_59 = $Dashboard->ncdscreen_dm("2", $distID);
            $ncdscreen_ht_35_59 = $Dashboard->ncdscreen_ht("2", $distID);
            $epi_1age = $Dashboard->epi_1ege($distID);

            $chart = new Chart();
            $Graph = $chart->gauge("kpi_dm_control", "ร้อยละผู้ป่วยเบาหวาน<br/>ที่คุมระดับน้ำตาลในเลือดได้ดี", number_format($kpi_dm_control, 2));
            $Graph .= $chart->gauge("kpi_ht_control", "ร้อยละผู้ป่วยความดันโลหิตสูง<br/>ที่ควบคุมระดับความดันโลหิตได้ดี", number_format($kpi_ht_control, 2));
            $Graph .= $chart->gauge("kpi_ht_kidney", "ร้อยละของผู้ป่วยความดัน <br/>(มีภาวะแทรกซ้อนทางไต)", number_format($kpi_ht_kidney, 2));
            $Graph .= $chart->gauge("ncd_dm_35_59", "คัดกรองเบาหวาน <br/> ช่วงอายุ 35 - 59 ปี", number_format($ncdscreen_dm_35_59, 2));
            $Graph .= $chart->gauge("ncd_ht_35_59", "คัดกรองความดัน <br/> ช่วงอายุ 35 - 59 ปี", number_format($ncdscreen_ht_35_59, 2));
            $Graph .= $chart->gauge("epi_1age", "เด็กอายุครบ 1 ปี <br/> ที่ได้รับการฉีดวัคซีนครบ", number_format($epi_1age, 2));
            $data['chart'] = $Graph;


            $content_chart = array(
                "kpi_dm_control",
                "kpi_ht_control",
                "kpi_ht_kidney",
                "ncd_dm_35_59",
                "ncd_ht_35_59",
                "epi_1age"
            );

            $data['chart_content'] = $content_chart;
        }
        //$data['chart'] = "";
        //$data['chart_content'] = "";
        $this->render('//template/home', $data);
    }

    /*
      public function actionGetSubmenu() {
      $catalog_id = $_GET['catalog_id'];
      $menu_id = $_GET['menu_id'];
      $data['catalogName'] = $_GET['catalogname'];
      Yii::app()->session['menu'] = $menu_id;
      $group = new SysReportgroup();
      $data['group_menu'] = $group->get_group_report($catalog_id);
      $this->render('//template/menu_report', $data);
      }
     */

    public function actionGraph_piramit() {
        $distID = Yii::app()->session['distId'];
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $data['year'] = $year + 543;

        if ($distID == '6300') {
            $_WHERE = " AND BUDGETYEAR = '$year' ";
        } else if ($distID != '6300') {
            $_WHERE = " AND r.AMPUR = '$distID' AND BUDGETYEAR = '$year' ";
        }

        $Age = new RptTypeAge();
        $report = new ReportPerson_Model();
        $result = $Age->findAll('1=1 ORDER BY id ASC');
        foreach ($result as $rs):
            $where = "r.`AGE` " . $rs['code'] . $_WHERE;
            $AGE[] = $rs['type_name'];
            $MAN[] = $report->getpyramidman($where);
            $WOMAN[] = $report->getpyramidwoman($where);
        endforeach;

        $_AGE = "'" . implode("','", $AGE) . "'";
        $_MAN = implode(",", $MAN);
        $_WOMAN = "-" . implode(",-", $WOMAN);

        $chart = new Chart();
        $data['chart'] = $chart->Piramitchart($_AGE, $_MAN, $_WOMAN);
        $this->renderPartial("//reports/report_singlechart", $data);
    }

    public function actionSetlanguage() {
        $lang = $_POST['lang'];
        $Model = new Language();
        $Model->setLang($lang);
    }

}
