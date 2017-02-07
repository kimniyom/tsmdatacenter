<?php

class ReportpersonController extends CController {

    //public $layout = 'template_report';
    public function actionReportpopulation() {
        $report = new ReportPerson_Model();
        $distId = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $startage = $_POST['startage'];
        $endage = $_POST['endage'];
        $agecolumn = $_POST['agecolumn'];
        $year = $_POST['year'];
        $BUDGETYEAR = ($year - 543);
        //$distId = Yii::app()->session['distId'];
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($distId == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->get_ampur_all(); //Get ชื่อสถานบริการมาแสดง
            $Field = "r.AMPUR";
            $JOIN = " INNER JOIN co_district_pop o ON r.AMPUR = o.distid ";
            $GROUPBY = "r.AMPUR";
            $WHERE = " AND 1=1 AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($distId != '0' && $pcu == '0') {
            //$ampur = $report->get_codeitems($distId);
            $data['location'] = "สถานบริการ";
            $PCU = $report->get_pcu_inampur($distId); //Get ชื่อสถานบริการมาแสดง
            $Field = "IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`)";
            $JOIN = " INNER JOIN co_office_pop o ON IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`) = o.off_id ";
            $GROUPBY = "r.HOSPCODE";
            $WHERE = "AND r.AMPUR = '$distId' AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($pcu != '0') {
            $data['location'] = "หมู่บ้าน";
            $PCU = $report->get_village_inpcu($pcu); //Get ชื่อสถานบริการมาแสดง
            //$tambon = $report->get_codeitems($pcu);
            /*
              $hospital = array("10722", "10723", "11238", "11239", "11240", "11241", "11242", "11243", "27443");
             */
            /*
              if (in_array($pcu, $hospital)) {
              $Field = "r.TAMBON";
              $JOIN = " INNER JOIN co_village_hospital o ON r.TAMBON = o.VILLCODE";
              $GROUPBY = "r.TAMBON";
              } else {

              }
             */
            $Field = "r.VILLAGE";
            $JOIN = " INNER JOIN co_village_hospital o ON r.VILLAGE = o.VILLCODE";
            $GROUPBY = "r.VILLAGE";


            $WHERE = "AND r.HOSPCODE = '$pcu' AND r.`BUDGETYEAR` = '$BUDGETYEAR'";
        }
        //} else {
        //}

        $data['amphurs'] = $PCU;
        //print_R($PCU);
        //$startage = "0";
        //$endage = "50";
        //$agecolumn = "10";

        $data['startage'] = $startage;
        $data['endage'] = $endage;
        $data['agecolumn'] = $agecolumn;

        $allcolumn = ceil((($endage + 1) - $startage) / $agecolumn);
        $data['allcolumn'] = $allcolumn;
        $data['checkopen'] = 0;


        //////////////////////////////////////////////
        //จำนวนคนในแต่ละอำเภอ ในแต่ละช่วงอายุ

        $dataarray = array();
        //จำนวนคนทั้งหมดแยกตามช่วงอายุ
        $alldataarray = array();

        for ($i = 1; $i <= $allcolumn; $i++) {
            if ($i == $allcolumn) {
                $endageqry = $endage;
                $startageqry = ($agecolumn * ($i - 1)) + $startage;
            } else {
                $endageqry = (($agecolumn * $i) - 1) + $startage;
                $startageqry = $endageqry - ($agecolumn - 1 );
            }

            //จำนวนคนในแต่ละอำเภอ แยกตามช่วงอายุ
            $StrQrydata = "
                SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_th r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE         
                  GROUP BY $GROUPBY 
                  ORDER BY $GROUPBY
                ";

            $alldatas = Yii::app()->db->createCommand($StrQrydata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $dataarray[$alldata['amphur']][$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;

            //จำนวนคนทั้งหมดแยกตามช่วงอายุ
            $StrQryalldata = "
                SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_th r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE
                ";
            $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $alldataarray[$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;
        }//end for

        $data['dataarray'] = $dataarray;
        $data['alldataarray'] = $alldataarray;

        //จำนวนคนทั้งหมดแยกตามอำเภอ ผลรวม
        $graphdataarray = array();
        $StrQryalldata = "
            SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_th r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
                  GROUP BY $GROUPBY 
        ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();
        foreach ($alldatas as $alldata):
            $countall = ($alldata['woman']) + ($alldata['man']);
            $graphdataarray[$alldata['amphur']] = array(
                'countman' => $alldata['man'],
                'countwoman' => $alldata['woman'],
                'countall' => number_format($countall));
        endforeach;

        //จำนวนคนทั้งหมดทุกอำเภอ ผลรวมทั้งจังหวัด
        $countalldata = 0;

        $StrQryalldata = "
             SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_th r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
            ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

        foreach ($alldatas as $alldata):
            $data['countallman'] = number_format($alldata['man']);
            $data['countallwoman'] = number_format($alldata['woman']);
            $countalldata = ($alldata['woman']) + ($alldata['man']);
        endforeach;

        $data['countalldata'] = number_format($countalldata);
        /////////////////////////////////////////////////////////////////////////////////////////

        $data['graphdataarray'] = $graphdataarray;
        $data['DateUpdate'] = $report->getdate_process('rpt_pop_th');
        $this->renderPartial("//reports/report_population", $data);
        //$data['content'] = "report_person/new_graph_population2";
    }

    public function actionReportpopulationnothai() {
        $report = new ReportPerson_Model();
        $distId = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $startage = $_POST['startage'];
        $endage = $_POST['endage'];
        $agecolumn = $_POST['agecolumn'];
        $year = $_POST['year'];
        $BUDGETYEAR = ($year - 543);
        //$distId = Yii::app()->session['distId'];
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($distId == '0') {
            $data['location'] = Language::TextFilterAmphur();
            $PCU = $report->get_ampur_all(); //Get ชื่อสถานบริการมาแสดง
            $Field = "r.AMPUR";
            $JOIN = " INNER JOIN co_district_pop o ON r.AMPUR = o.distid ";
            $GROUPBY = "r.AMPUR";
            $WHERE = " AND 1=1 AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($distId != '0' && $pcu == '0') {
            //$ampur = $report->get_codeitems($distId);
            $data['location'] = Language::TextFilterOffice();
            $PCU = $report->get_pcu_inampur($distId); //Get ชื่อสถานบริการมาแสดง
            $Field = "IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`)";
            $JOIN = " INNER JOIN co_office_pop o ON IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`) = o.off_id ";
            $GROUPBY = "r.HOSPCODE";
            $WHERE = "AND r.AMPUR = '$distId' AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($pcu != '0') {
            $data['location'] = "หมู่บ้าน";
            $PCU = $report->get_village_inpcu($pcu); //Get ชื่อสถานบริการมาแสดง
            //$tambon = $report->get_codeitems($pcu);
            /*
              $hospital = array("10722", "10723", "11238", "11239", "11240", "11241", "11242", "11243", "27443");
             */
            /*
              if (in_array($pcu, $hospital)) {
              $Field = "r.TAMBON";
              $JOIN = " INNER JOIN co_village_hospital o ON r.TAMBON = o.VILLCODE";
              $GROUPBY = "r.TAMBON";
              } else {

              }
             */
            $Field = "r.VILLAGE";
            $JOIN = " INNER JOIN co_village_hospital o ON r.VILLAGE = o.VILLCODE";
            $GROUPBY = "r.VILLAGE";


            $WHERE = "AND r.HOSPCODE = '$pcu' AND r.`BUDGETYEAR` = '$BUDGETYEAR'";
        }
        //} else {
        //}

        $data['amphurs'] = $PCU;
        //print_R($PCU);
        //$startage = "0";
        //$endage = "50";
        //$agecolumn = "10";

        $data['startage'] = $startage;
        $data['endage'] = $endage;
        $data['agecolumn'] = $agecolumn;

        $allcolumn = ceil((($endage + 1) - $startage) / $agecolumn);
        $data['allcolumn'] = $allcolumn;
        $data['checkopen'] = 0;


        //////////////////////////////////////////////
        //จำนวนคนในแต่ละอำเภอ ในแต่ละช่วงอายุ

        $dataarray = array();
        //จำนวนคนทั้งหมดแยกตามช่วงอายุ
        $alldataarray = array();

        for ($i = 1; $i <= $allcolumn; $i++) {
            if ($i == $allcolumn) {
                $endageqry = $endage;
                $startageqry = ($agecolumn * ($i - 1)) + $startage;
            } else {
                $endageqry = (($agecolumn * $i) - 1) + $startage;
                $startageqry = $endageqry - ($agecolumn - 1 );
            }

            //จำนวนคนในแต่ละอำเภอ แยกตามช่วงอายุ
            $StrQrydata = "
                SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE         
                  GROUP BY $GROUPBY 
                  ORDER BY $GROUPBY
                ";

            $alldatas = Yii::app()->db->createCommand($StrQrydata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $dataarray[$alldata['amphur']][$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;

            //จำนวนคนทั้งหมดแยกตามช่วงอายุ
            $StrQryalldata = "
                SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE
                ";
            $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $alldataarray[$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;
        }//end for

        $data['dataarray'] = $dataarray;
        $data['alldataarray'] = $alldataarray;

        //จำนวนคนทั้งหมดแยกตามอำเภอ ผลรวม
        $graphdataarray = array();
        $StrQryalldata = "
            SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
                  GROUP BY $GROUPBY 
        ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();
        foreach ($alldatas as $alldata):
            $countall = ($alldata['woman']) + ($alldata['man']);
            $graphdataarray[$alldata['amphur']] = array(
                'countman' => $alldata['man'],
                'countwoman' => $alldata['woman'],
                'countall' => number_format($countall));
        endforeach;

        //จำนวนคนทั้งหมดทุกอำเภอ ผลรวมทั้งจังหวัด
        $countalldata = 0;

        $StrQryalldata = "
             SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
            ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

        foreach ($alldatas as $alldata):
            $data['countallman'] = number_format($alldata['man']);
            $data['countallwoman'] = number_format($alldata['woman']);
            $countalldata = ($alldata['woman']) + ($alldata['man']);
        endforeach;

        $data['countalldata'] = number_format($countalldata);
        /////////////////////////////////////////////////////////////////////////////////////////

        $data['graphdataarray'] = $graphdataarray;
        $data['DateUpdate'] = $report->getdate_process('rpt_pop_nth');
        $this->renderPartial("//reports/report_population", $data);
        //$data['content'] = "report_person/new_graph_population2";
    }

    public function actionReportpopulationnothai_all() {
        $report = new ReportPerson_Model();
        $distId = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $startage = $_POST['startage'];
        $endage = $_POST['endage'];
        $agecolumn = $_POST['agecolumn'];
        $year = $_POST['year'];
        $BUDGETYEAR = ($year - 543);
        //$distId = Yii::app()->session['distId'];
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($distId == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->get_ampur_all(); //Get ชื่อสถานบริการมาแสดง
            $Field = "r.AMPUR";
            $JOIN = " INNER JOIN co_district_pop o ON r.AMPUR = o.distid ";
            $GROUPBY = "r.AMPUR";
            $WHERE = " AND 1=1 AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($distId != '0' && $pcu == '0') {
            //$ampur = $report->get_codeitems($distId);
            $data['location'] = "สถานบริการ";
            $PCU = $report->get_pcu_inampur($distId); //Get ชื่อสถานบริการมาแสดง
            $Field = "IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`)";
            $JOIN = " INNER JOIN co_office_pop o ON IF(r.`HOSPCODE` IS NULL,'00000',r.`HOSPCODE`) = o.off_id ";
            $GROUPBY = "r.HOSPCODE";
            $WHERE = "AND r.AMPUR = '$distId' AND r.`BUDGETYEAR` = '$BUDGETYEAR' ";
        } else if ($pcu != '0') {
            $data['location'] = "หมู่บ้าน";
            $PCU = $report->get_village_inpcu($pcu); //Get ชื่อสถานบริการมาแสดง
            //$tambon = $report->get_codeitems($pcu);
            /*
              $hospital = array("10722", "10723", "11238", "11239", "11240", "11241", "11242", "11243", "27443");
             */
            /*
              if (in_array($pcu, $hospital)) {
              $Field = "r.TAMBON";
              $JOIN = " INNER JOIN co_village_hospital o ON r.TAMBON = o.VILLCODE";
              $GROUPBY = "r.TAMBON";
              } else {

              }
             */
            $Field = "r.VILLAGE";
            $JOIN = " INNER JOIN co_village_hospital o ON r.VILLAGE = o.VILLCODE";
            $GROUPBY = "r.VILLAGE";


            $WHERE = "AND r.HOSPCODE = '$pcu' AND r.`BUDGETYEAR` = '$BUDGETYEAR'";
        }
        //} else {
        //}

        $data['amphurs'] = $PCU;
        //print_R($PCU);
        //$startage = "0";
        //$endage = "50";
        //$agecolumn = "10";

        $data['startage'] = $startage;
        $data['endage'] = $endage;
        $data['agecolumn'] = $agecolumn;

        $allcolumn = ceil((($endage + 1) - $startage) / $agecolumn);
        $data['allcolumn'] = $allcolumn;
        $data['checkopen'] = 0;


        //////////////////////////////////////////////
        //จำนวนคนในแต่ละอำเภอ ในแต่ละช่วงอายุ

        $dataarray = array();
        //จำนวนคนทั้งหมดแยกตามช่วงอายุ
        $alldataarray = array();

        for ($i = 1; $i <= $allcolumn; $i++) {
            if ($i == $allcolumn) {
                $endageqry = $endage;
                $startageqry = ($agecolumn * ($i - 1)) + $startage;
            } else {
                $endageqry = (($agecolumn * $i) - 1) + $startage;
                $startageqry = $endageqry - ($agecolumn - 1 );
            }

            //จำนวนคนในแต่ละอำเภอ แยกตามช่วงอายุ
            $StrQrydata = "
                SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth_vhid r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE         
                  GROUP BY $GROUPBY 
                  ORDER BY $GROUPBY
                ";

            $alldatas = Yii::app()->db->createCommand($StrQrydata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $dataarray[$alldata['amphur']][$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;

            //จำนวนคนทั้งหมดแยกตามช่วงอายุ
            $StrQryalldata = "
                SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth_vhid r $JOIN
                  WHERE age >= '$startageqry' 
                    AND age <= '$endageqry' $WHERE
                ";
            $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

            foreach ($alldatas as $alldata):
                $countall = ($alldata['woman']) + ($alldata['man']);
                $alldataarray[$i] = array(
                    'countman' => number_format($alldata['man']),
                    'countwoman' => number_format($alldata['woman']),
                    'countall' => number_format($countall));
            endforeach;
        }//end for

        $data['dataarray'] = $dataarray;
        $data['alldataarray'] = $alldataarray;

        //จำนวนคนทั้งหมดแยกตามอำเภอ ผลรวม
        $graphdataarray = array();
        $StrQryalldata = "
            SELECT 
                    $Field AS amphur,
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth_vhid r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
                  GROUP BY $GROUPBY 
        ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();
        foreach ($alldatas as $alldata):
            $countall = ($alldata['woman']) + ($alldata['man']);
            $graphdataarray[$alldata['amphur']] = array(
                'countman' => $alldata['man'],
                'countwoman' => $alldata['woman'],
                'countall' => number_format($countall));
        endforeach;

        //จำนวนคนทั้งหมดทุกอำเภอ ผลรวมทั้งจังหวัด
        $countalldata = 0;

        $StrQryalldata = "
             SELECT 
                    SUM(r.`MALE`) AS man,
                    SUM(r.`FEMALE`) AS woman 
                  FROM
                    rpt_pop_nth_vhid r $JOIN
                  WHERE age >= '$startage' 
                    AND age <= '$endage' $WHERE
            ";

        $alldatas = Yii::app()->db->createCommand($StrQryalldata)->queryAll();

        foreach ($alldatas as $alldata):
            $data['countallman'] = number_format($alldata['man']);
            $data['countallwoman'] = number_format($alldata['woman']);
            $countalldata = ($alldata['woman']) + ($alldata['man']);
        endforeach;

        $data['countalldata'] = number_format($countalldata);
        /////////////////////////////////////////////////////////////////////////////////////////

        $data['graphdataarray'] = $graphdataarray;
        $data['DateUpdate'] = $report->getdate_process('rpt_pop_nth_vhid');
        $this->renderPartial("//reports/report_population", $data);
        //$data['content'] = "report_person/new_graph_population2";
    }

    public function actionReportpyramid() {
        $ampur = $_POST['distId'];
        $tambon = $_POST['tambon'];
        $pcu = $_POST['pcu'];
        $PERIOD = ($_POST['year'] - 543); //แปลงให้เป็นปี ค.ศ.

        if ($ampur == '0') {
            $_WHERE = " AND BUDGETYEAR = '$PERIOD' ";
        } else if ($ampur != '0' && $tambon == '0') {
            $_WHERE = " AND r.AMPUR = '$ampur' AND BUDGETYEAR = '$PERIOD' ";
        } else if ($tambon != '0' && $pcu == '0') {
            $_WHERE = " AND r.TAMBON = '$tambon' AND BUDGETYEAR = '$PERIOD' ";
        } else if ($pcu != '0') {
            $_WHERE = " AND r.`HOSPCODE` = '$pcu' AND BUDGETYEAR = '$PERIOD' ";
        }

        $Age = new RptTypeAge();
        $report = new ReportPerson_Model();
        $result = $Age->findAll('1=1 ORDER BY id ASC');
        foreach ($result as $rs):
            $where = "r.`AGE` " . $rs['code'] . $_WHERE;
            $AGE[] = $rs['type_name'];
            $MAN[] = +-($report->getpyramidman($where));
            $WOMAN[] = $report->getpyramidwoman($where);
        endforeach;

        $_AGE = "'" . implode("','", $AGE) . "'";
        $_MAN = implode(",", $MAN);
        $_WOMAN = implode(",", $WOMAN);

        //echo $_MAN;
        $chart = new Chart();
        $data['chart'] = $chart->Piramitchart($_AGE, $_MAN, $_WOMAN);
        $this->renderPartial("//reports/report_singlechart", $data);
    }

    /* ปิรมิดต่างชาติ */

    public function actionReportpyramidnonth() {
        $ampur = $_POST['distId'];
        $tambon = $_POST['tambon'];
        $pcu = $_POST['pcu'];
        $PERIOD = ($_POST['year'] - 543); //แปลงให้เป็นปี ค.ศ.

        if ($ampur == '0') {
            $_WHERE = " AND PERIOD = '$PERIOD' ";
        } else if ($ampur != '0' && $tambon == '0') {
            $_WHERE = " AND LEFT(r.`VILLAGE`, 4) = '$ampur' AND PERIOD = '$PERIOD' ";
        } else if ($tambon != '0' && $pcu == '0') {
            $_WHERE = " AND LEFT(r.`VILLAGE`, 6) = '$tambon' AND PERIOD = '$PERIOD' ";
        } else if ($pcu != '0') {
            $_WHERE = " AND r.`HOSPCODE` = '$pcu' AND PERIOD = '$PERIOD' ";
        }

        $Age = new RptTypeAge();
        $report = new ReportPerson_Model();
        $result = $Age->findAll('1=1 ORDER BY id ASC');
        foreach ($result as $rs):
            $where = "r.`AGE` " . $rs['code'] . $_WHERE;
            $AGE[] = $rs['type_name'];
            $MAN[] = $report->getpyramidmannothai($where);
            $WOMAN[] = $report->getpyramidwomannothai($where);
        endforeach;

        $_AGE = "'" . implode("','", $AGE) . "'";
        $_MAN = implode(",", $MAN);
        $_WOMAN = "-" . implode(",-", $WOMAN);

        $chart = new Chart();
        $data['chart'] = $chart->Piramitchart($_AGE, $_MAN, $_WOMAN);
        $this->renderPartial("//reports/report_singlechart", $data);
    }

    public function actionTestreport() {
        echo "Kimniyom CLUB";
    }

}

?>
