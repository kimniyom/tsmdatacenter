<?php

class Report_r506Controller extends Controller {

    //รายงาน แสดงข้อมูล ปีงบประมาณ แสดง เป็นเดือน แยกตามอำเภอ ลงลึกถึงรายสถานบริการ 

    public function actionGenreport() {

        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];
        $code506 = $_POST['code506'];
        $report = new Report_r506();

        if ($ampur == '0') {
            $w = " AND 1=1 AND RACE = '1' ";
            $w1 = " AND 1=1 AND RACE = '1' ";
            $join = "";
        } else if ($ampur != '0' && $pcu == '0') {
            $w = " AND LEFT(ADDRCODE,4) = '$ampur' AND RACE = '1' ";
            $w1 = " AND LEFT(ADDRCODE,4) = '$ampur' AND RACE = '1' ";
            $join = "";
        } else if ($pcu != '0') {
            $query = "SELECT HOSP_CODE FROM office_r506 WHERE off_id = '$pcu' ";
            $rs = Yii::app()->db->createCommand($query)->queryRow();
            $ADDRCODE = $rs['HOSP_CODE'];
            $w = " AND ADDRCODE = '$ADDRCODE' AND RACE = '1' ";
            
            $w1 = " AND co.off_id = '$pcu' AND RACE = '1' ";
            $join = "INNER JOIN co_village_hospital o ON `ADDRCODE` = o.`VILLCODE`
                        INNER JOIN co_office co ON o.`HOSPCODE` = co.`off_id`";
        }


        /*         * ****************หาค่ามัธยฐานของแต่ละเดือน 5 ปีย้อนหลัง********************* */

        $result = $report->Getmedian_all($year, $w, $code506);
        $median_now = $report->Getmedian_mountnow($year, $w1, $code506,$join);
        foreach ($result as $rs):
            $amount = $report->Getmedian_result($year, $w, $code506, $rs['id'], $rs['TOTAL']);
            $month[] = $rs['month_th'];
            $v_center[] = $amount;
        endforeach;
        $monthArr = implode(" ',' ", $month);
        $valcenter = implode(",", $v_center);
        $MONTHTHAI = "'" . $monthArr . "'";


        $graph = new Chart();
        $sub_title = "เปรียบเทียบกับค่ามัธยฐาน 5 ปี";
        $chartcenter = $graph->graph2line('chart1', '' . ' จำแนกรายเดือน ', $sub_title, $MONTHTHAI, 'Median 5 ปี', 'ผู้ป่วย ปี ' . $year, $valcenter, $median_now);
        //$data['graph'] = $chartcenter;

        /**         * **************หาค่ามัธยฐานของแต่ละสัปดาร์ 5 ปีย้อนหลัง********************* */
        $resultweek = $report->Getmedian_allweek($year, $w, $code506);
        $median_nowweek = $report->Getmedian_weeknow($year, $w1, $code506,$join);
        foreach ($resultweek as $rs):
            $amountweek = $report->Getmedian_resultweek($year, $w, $code506, $rs['week'], $rs['TOTAL']);
            $weekarr[] = $rs['week'];
            $resultarr[] = $amountweek;
        endforeach;
        $weekcategory = implode(" ',' ", $weekarr);
        $weekvalue = implode(",", $resultarr);

        //$graph2 = new graph_model();
        $chartcenter .= $graph->graph2line('chart2', '' . ' จำแนกรายสัปดาห์ ', $sub_title, "'" . $weekcategory . "'", 'Median 5 ปี', 'ผู้ป่วย ปี' . $year, $weekvalue, $median_nowweek);

        //########################### Gen Table #########################//
        if ($ampur == '0') {
            $PCU = "อำเภอ";
            $r506 = $report->get_gentable_r506_amphur($year, $code506, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $PCU = "สถานบริการ";
            $r506 = $report->get_gentable_r506_pcu($year, $code506, $ampur);
        } else if ($pcu != '0') {
            $r506 = $report->get_gentable_r506_singlepcu($year, $code506, $pcu);
        }

        $data['r506'] = $r506;

        $Table = new TakisTables();
        $Table->setClass('table table-bordered');
        $Table->showColumnIndex(false);
        //$Table->setId('tableReport');
        $Table->addHeader("จำนวนอัตราต่อแสน", " colspan='6' ");
        $Table->addSpanHeader($PCU);
        $Table->addSpanHeader("ประชากร");
        $Table->addSpanHeader("ผู้ป่วย");
        $Table->addSpanHeader("อัตราต่อแสน");
        $Table->addSpanHeader("เสียชีวิต");
        $Table->addSpanHeader("อัตราต่อแสน");

        $TotalArray = array('', '', '', '', '');
        foreach ($r506 as $rs):
            $Table->startRow();
            $Table->addCell($rs['district'] . ' ' . $rs['distname'], "align='left' id= 'setText-Left' ");
            $Table->addCell(number_format($rs['PERSON']));
            $Table->addCell(number_format($rs['TOTAL']));
            $Table->addCell(number_format($rs['AVG'], 2));
            $Table->addCell(number_format($rs['DEATH']));
            $Table->addCell(number_format($rs['AVG_DEATH'], 2));
            $Table->endRow();
            $TotalArray[0] = $TotalArray[0] + $rs['PERSON'];
            $TotalArray[1] = $TotalArray[1] + $rs['TOTAL'];
            $TotalArray[2] = $TotalArray[2] + $rs['AVG'];
            $TotalArray[3] = $TotalArray[3] + $rs['DEATH'];
            $TotalArray[4] = $TotalArray[4] + $rs['AVG_DEATH'];
        endforeach;

        $Table->addFooter("รวม");
        $Table->addFooter(number_format($TotalArray[0]));
        $Table->addFooter(number_format($TotalArray[1]));
        $Table->addFooter(number_format($TotalArray[2], 2));
        $Table->addFooter(number_format($TotalArray[3]));
        $Table->addFooter(number_format($TotalArray[4], 2));

        $data['tables'] = $Table->render();


        //########################### อัตราประชากรต่อ ผู้เสียชีวิต ตามช่วงอายุ###############//
        $ageName = $report->getAgeName(); // ชื่อช่วงอายุ
        foreach ($ageName as $st):
            $AGE[] = "'" . $st['PP_NAME'] . "'";
        endforeach;
        $data['AGENAME'] = implode(",", $AGE);

        $RS_AGE = $report->get_result_age_506($year, $code506, $w);
        $AMOUNT_AGE = array(
            $RS_AGE['AGE0TO4'],
            $RS_AGE['AGE5TO9'],
            $RS_AGE['AGE10TO14'],
            $RS_AGE['AGE15TO19'],
            $RS_AGE['AGE20TO24'],
            $RS_AGE['AGE25TO29'],
            $RS_AGE['AGE30TO34'],
            $RS_AGE['AGE35TO39'],
            $RS_AGE['AGE40TO44'],
            $RS_AGE['AGE45TO49'],
            $RS_AGE['AGE50TO54'],
            $RS_AGE['AGE55TO59'],
            $RS_AGE['AGE60TO64'],
            $RS_AGE['AGE65TO69'],
            $RS_AGE['AGE70TO74'],
            $RS_AGE['AGE75TO79'],
            $RS_AGE['AGE80TO84'],
            $RS_AGE['AGE85TO89'],
            $RS_AGE['AGE90TO94'],
            $RS_AGE['AGE95TO99'],
            $RS_AGE['AGE100']
        );

        $data['RESULT_AGE'] = implode(",", $AMOUNT_AGE);

        /* ####################### จำนวนผูเสียชีวิต ######################### */

        $RS_DEATH = $report->get_result_death_506($year, $code506, $w);
        $AMOUNT_DEATH = array(
            $RS_DEATH['AGE0TO4'],
            $RS_DEATH['AGE5TO9'],
            $RS_DEATH['AGE10TO14'],
            $RS_DEATH['AGE15TO19'],
            $RS_DEATH['AGE20TO24'],
            $RS_DEATH['AGE25TO29'],
            $RS_DEATH['AGE30TO34'],
            $RS_DEATH['AGE35TO39'],
            $RS_DEATH['AGE40TO44'],
            $RS_DEATH['AGE45TO49'],
            $RS_DEATH['AGE50TO54'],
            $RS_DEATH['AGE55TO59'],
            $RS_DEATH['AGE60TO64'],
            $RS_DEATH['AGE65TO69'],
            $RS_DEATH['AGE70TO74'],
            $RS_DEATH['AGE75TO79'],
            $RS_DEATH['AGE80TO84'],
            $RS_DEATH['AGE85TO89'],
            $RS_DEATH['AGE90TO94'],
            $RS_DEATH['AGE95TO99'],
            $RS_DEATH['AGE100']
        );

        $data['RESULT_DEATH'] = implode(",", $AMOUNT_DEATH);
        $chartcenter .= $graph->column_graph2("chart3", "" . ' จำแนกตามกลุ่มอายุ', $data['AGENAME'], 'จำนวนผู้ป่วย', $data['RESULT_AGE'], 'เสียชีวิต', $data['RESULT_DEATH']);


        //##################### จำนวนผู้ปวยแยกตามอาชีพ ##########################//
        $RS_OCC = $report->get_result_ocupation_r506($year, $code506, $w);
        foreach ($RS_OCC as $RESULT_OCC):
            $OccArrayResult[] = $RESULT_OCC['RESULT'];
            $OccArrayName[] = "'" . $RESULT_OCC['OCC_NAME'] . "'";
        endforeach;

        $OCC_VALUE = implode(",", $OccArrayResult); //จำนวนผู้ป่วยแยกตามอาชีพ
        $OCC_NAME = implode(",", $OccArrayName); //ชื่ออาชีพ
        //##################### จำนวนผู้ปวยเสียชีวิตแยกตามอาชีพ ##########################//
        $RS_OCC_DEATH = $report->get_result_ocupation_death_r506($year, $code506, $w);
        foreach ($RS_OCC_DEATH as $RESULT_OCC_DEATH):
            $OccDeathArrayResult[] = $RESULT_OCC_DEATH['RESULT'];
        endforeach;

        $OCC_VALUE_DEATH = implode(",", $OccDeathArrayResult); //จำนวนผู้ป่วยเสียชีวิตแยกตามอาชีพ

        $chartcenter .= $graph->column_graph2("chart4", '' . ' จำแนกตามอาชีพ', $OCC_NAME, 'จำนวนผู้ป่วย', $OCC_VALUE, 'เสียชีวิต', $OCC_VALUE_DEATH);

        $data['graph'] = $chartcenter;
        //$data['graph'] = "";
        $this->renderPartial("//reports/R506", $data);
    }

    public function actionGenreportnonthai() {

         $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];
        $code506 = $_POST['code506'];
        $report = new Report_r506();

        if ($ampur == '0') {
            $w = " AND 1=1 AND RACE != '1' ";
            $w1 = " AND 1=1 AND RACE != '1' ";
            $join = "";
        } else if ($ampur != '0' && $pcu == '0') {
            $w = " AND LEFT(ADDRCODE,4) = '$ampur' AND RACE != '1' ";
            $w1 = " AND LEFT(ADDRCODE,4) = '$ampur' AND RACE != '1' ";
            $join = "";
        } else if ($pcu != '0') {
            $query = "SELECT HOSP_CODE FROM office_r506 WHERE off_id = '$pcu' ";
            $rs = Yii::app()->db->createCommand($query)->queryRow();
            $ADDRCODE = $rs['HOSP_CODE'];
            $w = " AND ADDRCODE = '$ADDRCODE' AND RACE != '1' ";
            
            $w1 = " AND co.off_id = '$pcu' AND RACE != '1' ";
            $join = "INNER JOIN co_village_hospital o ON `ADDRCODE` = o.`VILLCODE`
                        INNER JOIN co_office co ON o.`HOSPCODE` = co.`off_id`";
        }


        /*         * ****************หาค่ามัธยฐานของแต่ละเดือน 5 ปีย้อนหลัง********************* */

        $result = $report->Getmedian_all($year, $w, $code506);
        $median_now = $report->Getmedian_mountnow($year, $w1, $code506,$join);
        foreach ($result as $rs):
            $amount = $report->Getmedian_result($year, $w, $code506, $rs['id'], $rs['TOTAL']);
            $month[] = $rs['month_th'];
            $v_center[] = $amount;
        endforeach;
        $monthArr = implode(" ',' ", $month);
        $valcenter = implode(",", $v_center);
        $MONTHTHAI = "'" . $monthArr . "'";


        $graph = new Chart();
        $sub_title = "เปรียบเทียบกับค่ามัธยฐาน 5 ปี";
        $chartcenter = $graph->graph2line('chart1', '' . ' จำแนกรายเดือน ', $sub_title, $MONTHTHAI, 'Median 5 ปี', 'ผู้ป่วย ปี ' . $year, $valcenter, $median_now);
        //$data['graph'] = $chartcenter;

        /**         * **************หาค่ามัธยฐานของแต่ละสัปดาร์ 5 ปีย้อนหลัง********************* */
        $resultweek = $report->Getmedian_allweek($year, $w, $code506);
        $median_nowweek = $report->Getmedian_weeknow($year, $w1, $code506,$join);
        foreach ($resultweek as $rs):
            $amountweek = $report->Getmedian_resultweek($year, $w, $code506, $rs['week'], $rs['TOTAL']);
            $weekarr[] = $rs['week'];
            $resultarr[] = $amountweek;
        endforeach;
        $weekcategory = implode(" ',' ", $weekarr);
        $weekvalue = implode(",", $resultarr);

        //$graph2 = new graph_model();
        $chartcenter .= $graph->graph2line('chart2', '' . ' จำแนกรายสัปดาห์ ', $sub_title, "'" . $weekcategory . "'", 'Median 5 ปี', 'ผู้ป่วย ปี' . $year, $weekvalue, $median_nowweek);

        //########################### Gen Table #########################//
        if ($ampur == '0') {
            $PCU = "อำเภอ";
            $r506 = $report->get_gentable_r506_amphur($year, $code506, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $PCU = "สถานบริการ";
            $r506 = $report->get_gentable_r506_pcu($year, $code506, $ampur);
        } else if ($pcu != '0') {
            $r506 = $report->get_gentable_r506_singlepcu($year, $code506, $pcu);
        }

        $data['r506'] = $r506;

        $Table = new TakisTables();
        $Table->setClass('table table-bordered');
        $Table->showColumnIndex(false);
        //$Table->setId('tableReport');
        $Table->addHeader("จำนวนอัตราต่อแสน", " colspan='6' ");
        $Table->addSpanHeader($PCU);
        $Table->addSpanHeader("ประชากร");
        $Table->addSpanHeader("ผู้ป่วย");
        $Table->addSpanHeader("อัตราต่อแสน");
        $Table->addSpanHeader("เสียชีวิต");
        $Table->addSpanHeader("อัตราต่อแสน");

        $TotalArray = array('', '', '', '', '');
        foreach ($r506 as $rs):
            $Table->startRow();
            $Table->addCell($rs['district'] . ' ' . $rs['distname'], "align='left' id= 'setText-Left' ");
            $Table->addCell(number_format($rs['PERSON']));
            $Table->addCell(number_format($rs['TOTAL']));
            $Table->addCell(number_format($rs['AVG'], 2));
            $Table->addCell(number_format($rs['DEATH']));
            $Table->addCell(number_format($rs['AVG_DEATH'], 2));
            $Table->endRow();
            $TotalArray[0] = $TotalArray[0] + $rs['PERSON'];
            $TotalArray[1] = $TotalArray[1] + $rs['TOTAL'];
            $TotalArray[2] = $TotalArray[2] + $rs['AVG'];
            $TotalArray[3] = $TotalArray[3] + $rs['DEATH'];
            $TotalArray[4] = $TotalArray[4] + $rs['AVG_DEATH'];
        endforeach;

        $Table->addFooter("รวม");
        $Table->addFooter(number_format($TotalArray[0]));
        $Table->addFooter(number_format($TotalArray[1]));
        $Table->addFooter(number_format($TotalArray[2], 2));
        $Table->addFooter(number_format($TotalArray[3]));
        $Table->addFooter(number_format($TotalArray[4], 2));

        $data['tables'] = $Table->render();


        //########################### อัตราประชากรต่อ ผู้เสียชีวิต ตามช่วงอายุ###############//
        $ageName = $report->getAgeName(); // ชื่อช่วงอายุ
        foreach ($ageName as $st):
            $AGE[] = "'" . $st['PP_NAME'] . "'";
        endforeach;
        $data['AGENAME'] = implode(",", $AGE);

        $RS_AGE = $report->get_result_age_506($year, $code506, $w);
        $AMOUNT_AGE = array(
            $RS_AGE['AGE0TO4'],
            $RS_AGE['AGE5TO9'],
            $RS_AGE['AGE10TO14'],
            $RS_AGE['AGE15TO19'],
            $RS_AGE['AGE20TO24'],
            $RS_AGE['AGE25TO29'],
            $RS_AGE['AGE30TO34'],
            $RS_AGE['AGE35TO39'],
            $RS_AGE['AGE40TO44'],
            $RS_AGE['AGE45TO49'],
            $RS_AGE['AGE50TO54'],
            $RS_AGE['AGE55TO59'],
            $RS_AGE['AGE60TO64'],
            $RS_AGE['AGE65TO69'],
            $RS_AGE['AGE70TO74'],
            $RS_AGE['AGE75TO79'],
            $RS_AGE['AGE80TO84'],
            $RS_AGE['AGE85TO89'],
            $RS_AGE['AGE90TO94'],
            $RS_AGE['AGE95TO99'],
            $RS_AGE['AGE100']
        );

        $data['RESULT_AGE'] = implode(",", $AMOUNT_AGE);

        /* ####################### จำนวนผูเสียชีวิต ######################### */

        $RS_DEATH = $report->get_result_death_506($year, $code506, $w);
        $AMOUNT_DEATH = array(
            $RS_DEATH['AGE0TO4'],
            $RS_DEATH['AGE5TO9'],
            $RS_DEATH['AGE10TO14'],
            $RS_DEATH['AGE15TO19'],
            $RS_DEATH['AGE20TO24'],
            $RS_DEATH['AGE25TO29'],
            $RS_DEATH['AGE30TO34'],
            $RS_DEATH['AGE35TO39'],
            $RS_DEATH['AGE40TO44'],
            $RS_DEATH['AGE45TO49'],
            $RS_DEATH['AGE50TO54'],
            $RS_DEATH['AGE55TO59'],
            $RS_DEATH['AGE60TO64'],
            $RS_DEATH['AGE65TO69'],
            $RS_DEATH['AGE70TO74'],
            $RS_DEATH['AGE75TO79'],
            $RS_DEATH['AGE80TO84'],
            $RS_DEATH['AGE85TO89'],
            $RS_DEATH['AGE90TO94'],
            $RS_DEATH['AGE95TO99'],
            $RS_DEATH['AGE100']
        );

        $data['RESULT_DEATH'] = implode(",", $AMOUNT_DEATH);
        $chartcenter .= $graph->column_graph2("chart3", "" . ' จำแนกตามกลุ่มอายุ', $data['AGENAME'], 'จำนวนผู้ป่วย', $data['RESULT_AGE'], 'เสียชีวิต', $data['RESULT_DEATH']);


        //##################### จำนวนผู้ปวยแยกตามอาชีพ ##########################//
        $RS_OCC = $report->get_result_ocupation_r506($year, $code506, $w);
        foreach ($RS_OCC as $RESULT_OCC):
            $OccArrayResult[] = $RESULT_OCC['RESULT'];
            $OccArrayName[] = "'" . $RESULT_OCC['OCC_NAME'] . "'";
        endforeach;

        $OCC_VALUE = implode(",", $OccArrayResult); //จำนวนผู้ป่วยแยกตามอาชีพ
        $OCC_NAME = implode(",", $OccArrayName); //ชื่ออาชีพ
        //##################### จำนวนผู้ปวยเสียชีวิตแยกตามอาชีพ ##########################//
        $RS_OCC_DEATH = $report->get_result_ocupation_death_r506($year, $code506, $w);
        foreach ($RS_OCC_DEATH as $RESULT_OCC_DEATH):
            $OccDeathArrayResult[] = $RESULT_OCC_DEATH['RESULT'];
        endforeach;

        $OCC_VALUE_DEATH = implode(",", $OccDeathArrayResult); //จำนวนผู้ป่วยเสียชีวิตแยกตามอาชีพ

        $chartcenter .= $graph->column_graph2("chart4", '' . ' จำแนกตามอาชีพ', $OCC_NAME, 'จำนวนผู้ป่วย', $OCC_VALUE, 'เสียชีวิต', $OCC_VALUE_DEATH);

        $data['graph'] = $chartcenter;
        //$data['graph'] = "";
        $this->renderPartial("//reports/R506", $data);
    }

    public function actionGenreportOld() {

        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];
        $code506 = $_POST['code506'];
        $report = new Report_r506();

        if ($ampur == '0') {
            $w = ' AND 1=1';
        } else if ($ampur != '0' && $pcu == '0') {
            $w = " AND LEFT(r.ADDRCODE,4) = '$ampur' ";
        } else if ($pcu != '0') {
            $w = " AND r.ADDRCODE = '$pcu' ";
        }


        /*         * ****************หาค่ามัธยฐานของแต่ละเดือน 5 ปีย้อนหลัง********************* */
        $monththai = $report->get_month();
        $monthArr = implode("','", $monththai);
        $graphmonth = "'" . $monthArr . "'";

        $month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $v_center = array();
        $val_yearnow = array();
        for ($i = 0; $i <= 11; $i++):
            $result1 = $report->get_value_5year($year, $month[$i], $code506, $w);
            $val_yearnow[] = $result1['year5']; //ผู้ป่วยในปีนั้น
            $rs1 = $result1['year1'];
            $rs2 = $result1['year2'];
            $rs3 = $result1['year3'];
            $rs4 = $result1['year4'];
            $rs5 = $result1['year5'];

            $val = array("$rs1", "$rs2", "$rs3", "$rs4", "$rs5");
            $val_center = (count($val) + 1) / 2;
            sort($val);
            $setasc = array();
            foreach ($val as $index => $value) {
                $setasc[] = $value;
                //print $index.' = '.$value.',';
            }

            $v_center[] = $setasc[$val_center];
            //echo "<br/>";
        endfor;

        $value_now = implode(",", $val_yearnow); //ผู้ป่วยในปีนั้น
        $center_month_r506 = implode(',', $v_center); //ค่ามัธยฐานของแต่ละเดือน
        $graph = new Chart();
        $sub_title = "เปรียบเทียบกับค่ามัธยฐาน 5 ปี";
        $chartcenter = $graph->graph2line('chart1', '' . ' จำแนกรายเดือน ', $sub_title, $graphmonth, 'Median 5 ปี', 'ผู้ป่วย ปี ' . $year, $center_month_r506, $value_now);
        //$data['graph'] = $chartcenter;

        /*         * ***************หาค่ามัธยฐานของแต่ละสัปดาร์ 5 ปีย้อนหลัง********************* */

        $week = array();
        for ($j = 1; $j <= 52; $j++) {
            $week[] = $j;
        }
        $weekArr = implode("','", $week);
        $graphweek = "'" . $weekArr . "'";

        $week_center = array();
        $val_weeknow = array();
        for ($a = 1; $a <= 52; $a++):
            $result2 = $report->get_week_5year($year, $a, $code506, $w);
            $val_weeknow[] = $result2['year5'];
            $rss1 = $result2['year1'];
            $rss2 = $result2['year2'];
            $rss3 = $result2['year3'];
            $rss4 = $result2['year4'];
            $rss5 = $result2['year5'];
            $w_val = array("$rss1", "$rss2", "$rss3", "$rss4", "$rss5");
            $week_val_center = (count($w_val) + 1) / 2;
            sort($w_val);
            $setasc_week = array();
            foreach ($w_val as $index_week => $value_week) {
                $setasc_week[] = $value_week;
            }

            $week_center[] = $setasc_week[$week_val_center];
            //echo "<br/>";
        endfor;

        $week_now = implode(",", $val_weeknow);
        $center_week_r506 = implode(',', $week_center);
        //$graph2 = new graph_model();
        $chartcenter .= $graph->graph2line('chart2', '' . ' จำแนกรายสัปดาห์ ', $sub_title, $graphweek, 'Median 5 ปี', 'ผู้ป่วย ปี' . $year, $center_week_r506, $week_now);
        /*
          //########################### Gen Table #########################//
          if($ampur == '0'){
          $PCU = "อำเภอ";
          $r506 = $report->get_gentable_r506_amphur($year, $code506, "");
          } else {
          $PCU = "ตำบล";
          $r506 =$report->get_gentable_r506_tambon($year, $code506, $ampur);
          }

          $data['r506'] = $r506;

          $Table = new TakisTables();
          $Table->setClass('stripe cell-border');
          $Table->showColumnIndex(true);

          //$Table->setId('tableReport');
          $Table->addHeader($PCU, "class='no_br_head' id = 'head_pcu'");
          $Table->addHeader("ประชากร", "class='no_br_head' id = 'head_pcu'");
          $Table->addHeader("ผู้ป่วย", "class='no_br_head' id = 'head_pcu'");
          $Table->addHeader("อัตราต่อแสน", "class='no_br_head' id = 'head_pcu'");
          $Table->addHeader("เสียชีวิต", "class='no_br_head' id = 'head_pcu'");
          $Table->addHeader("อัตราต่อแสน", "class='no_br_head' id = 'head_pcu'");

          $TotalArray = array('', '', '','','');
          foreach ($r506 as $rs):
          $Table->startRow();
          $Table->addCell($rs['distname'], "id = 'no_br_pcu' ");
          $Table->addCell(number_format($rs['PERSON']), "id = 'no_br' ");
          $Table->addCell(number_format($rs['TOTAL']), "id = 'no_br' ");
          $Table->addCell(number_format($rs['AVG'],2), "id = 'no_br' ");
          $Table->addCell(number_format($rs['DEATH']), "id = 'no_br' ");
          $Table->addCell(number_format($rs['AVG_DEATH'],2), "id = 'no_br' ");
          $Table->endRow();
          $TotalArray[0] = $TotalArray[0] + $rs['PERSON'];
          $TotalArray[1] = $TotalArray[1] + $rs['TOTAL'];
          $TotalArray[2] = $TotalArray[2] + $rs['AVG'];
          $TotalArray[3] = $TotalArray[3] + $rs['DEATH'];
          $TotalArray[4] = $TotalArray[4] + $rs['AVG_DEATH'];
          endforeach;

          $Table->addFooter("รวม", " colspan='2' id='set_foot_tb' style='text-align:center;' ");
          $Table->addFooter(number_format($TotalArray[0]), " id='set_foot_tb' ");
          $Table->addFooter(number_format($TotalArray[1]), " id='set_foot_tb' ");
          $Table->addFooter(number_format($TotalArray[2],2), " id='set_foot_tb' ");
          $Table->addFooter(number_format($TotalArray[3]), " id='set_foot_tb' ");
          $Table->addFooter(number_format($TotalArray[4],2), " id='set_foot_tb' ");

          $data['tables'] = $Table->render();


          //########################### อัตราประชากรต่อ ผู้เสียชีวิต ตามช่วงอายุ###############//
          $ageName = $report->getAgeName(); // ชื่อช่วงอายุ
          foreach ($ageName as $st):
          $AGE[] = "'" . $st['PP_NAME'] . "'";
          endforeach;
          $data['AGENAME'] = implode(",", $AGE);

          $RS_AGE = $report->get_result_age_506($year,$code506,$w);
          $AMOUNT_AGE = array(
          $RS_AGE['AGE0TO4'],
          $RS_AGE['AGE5TO9'],
          $RS_AGE['AGE10TO14'],
          $RS_AGE['AGE15TO19'],
          $RS_AGE['AGE20TO24'],
          $RS_AGE['AGE25TO29'],
          $RS_AGE['AGE30TO34'],
          $RS_AGE['AGE35TO39'],
          $RS_AGE['AGE40TO44'],
          $RS_AGE['AGE45TO49'],
          $RS_AGE['AGE50TO54'],
          $RS_AGE['AGE55TO59'],
          $RS_AGE['AGE60TO64'],
          $RS_AGE['AGE65TO69'],
          $RS_AGE['AGE70TO74'],
          $RS_AGE['AGE75TO79'],
          $RS_AGE['AGE80TO84'],
          $RS_AGE['AGE85TO89'],
          $RS_AGE['AGE90TO94'],
          $RS_AGE['AGE95TO99'],
          $RS_AGE['AGE100']
          );

          $data['RESULT_AGE'] = implode(",", $AMOUNT_AGE);
         *
         * 
         */
        /* ####################### จำนวนผูเสียชีวิต ######################### */
        /*
          $RS_DEATH= $report->get_result_death_506($year,$code506,$w);
          $AMOUNT_DEATH = array(
          $RS_DEATH['AGE0TO4'],
          $RS_DEATH['AGE5TO9'],
          $RS_DEATH['AGE10TO14'],
          $RS_DEATH['AGE15TO19'],
          $RS_DEATH['AGE20TO24'],
          $RS_DEATH['AGE25TO29'],
          $RS_DEATH['AGE30TO34'],
          $RS_DEATH['AGE35TO39'],
          $RS_DEATH['AGE40TO44'],
          $RS_DEATH['AGE45TO49'],
          $RS_DEATH['AGE50TO54'],
          $RS_DEATH['AGE55TO59'],
          $RS_DEATH['AGE60TO64'],
          $RS_DEATH['AGE65TO69'],
          $RS_DEATH['AGE70TO74'],
          $RS_DEATH['AGE75TO79'],
          $RS_DEATH['AGE80TO84'],
          $RS_DEATH['AGE85TO89'],
          $RS_DEATH['AGE90TO94'],
          $RS_DEATH['AGE95TO99'],
          $RS_DEATH['AGE100']
          );

          $data['RESULT_DEATH'] = implode(",", $AMOUNT_DEATH);
          $chartcenter .= $graph->column_graph2("chart3", "".' จำแนกตามกลุ่มอายุ', $data['AGENAME'], 'จำนวนผู้ป่วย', $data['RESULT_AGE'], 'เสียชีวิต', $data['RESULT_DEATH']);


          //##################### จำนวนผู้ปวยแยกตามอาชีพ ##########################//
          $RS_OCC = $report->get_result_ocupation_r506($year,$code506,$w);
          foreach($RS_OCC as $RESULT_OCC):
          $OccArrayResult[] = $RESULT_OCC['RESULT'];
          $OccArrayName[] = "'".$RESULT_OCC['OCC_NAME']."'";
          endforeach;

          $OCC_VALUE = implode(",", $OccArrayResult);//จำนวนผู้ป่วยแยกตามอาชีพ
          $OCC_NAME = implode(",", $OccArrayName);//ชื่ออาชีพ

          //##################### จำนวนผู้ปวยเสียชีวิตแยกตามอาชีพ ##########################//
          $RS_OCC_DEATH = $report->get_result_ocupation_death_r506($year,$code506,$w);
          foreach($RS_OCC_DEATH as $RESULT_OCC_DEATH):
          $OccDeathArrayResult[] = $RESULT_OCC_DEATH['RESULT'];
          endforeach;

          $OCC_VALUE_DEATH = implode(",", $OccDeathArrayResult);//จำนวนผู้ป่วยเสียชีวิตแยกตามอาชีพ

          $chartcenter .= $graph->column_graph2("chart4", ''.' จำแนกตามอาชีพ', $OCC_NAME, 'จำนวนผู้ป่วย', $OCC_VALUE, 'เสียชีวิต', $OCC_VALUE_DEATH);
         */
        $data['graph'] = $chartcenter;

        $this->renderPartial("//reports/R506", $data);
    }

    //รายงาน แสดงข้อมูล ปีงบประมาณ แสดง เป็นเดือน แยกตามอำเภอ ลงลึกถึงรายสถานบริการ 
    public function report_r506_order($id = '', $device = '') {

        $mobile = $device;

        /* ดึงข้อมูลรายละเอียดข้อมาแสดง */
        $report = $this->disease->get_detail_report($id);
        $this->url = site_url($report->CONTROL_URL . '/' . $report->INDICATOR_ID . '/' . $mobile);
        $data['name'] = $report->NAME;
        $data['infofrom'] = $report->INFO_FROM;

        /* เช็คตาราง ไทย ต่างชาติ */
        $currentYear = date('Y') + 543;
        $data['startYear'] = strlen($this->input->post('startYear')) > 0 ? $this->input->post('startYear') : $currentYear;
        $data['amphur'] = $this->input->post('amphur');
        $data['office'] = $this->input->post('box_office');

        $data['filter'] = $this->filter_order_r506($data['startYear'], $data['amphur'], $data['office']);
        $year = ($data['startYear'] - 543);

        if ($data['amphur'] == '0000' || $data['amphur'] == '') {
            $w = ' AND 1=1';
            $population = $this->r506->get_population_all($year);
        } else {
            if ($data['office'] == '0000') {
                $w = " AND LEFT(r.ADDRCODE,4) = '" . $data['amphur'] . "' ";
                $population = $this->r506->get_population_amphur($year, $data['amphur']);
            } else {
                $w = " AND r.ADDRCODE = '" . $data['office'] . "' ";
                $population = $this->r506->get_population_tambon($year, $data['office']);
            }
        }

        $r506 = $this->r506->get_order_disease_506($year, $w);

        $Table = new TakisTables();
        $Table->setClass('stripe cell-border');
        $Table->showColumnIndex(true);
        $Table->set_border_left($this->border_color());
        //$color = $this->border_color();
        //$Table->setClass("cell-border");
        $Table->setId('tableReport');
        $Table->addHeader("รหัสโรค", "class='no_br_head' id = 'head_pcu'");
        $Table->addHeader("โรค", "class='no_br_head' id = 'head_pcu'");
        $Table->addHeader("จำนวนผู้ป่วย", "class='no_br_head' id = 'head_pcu'");
        $Table->addHeader("อัตราต่อแสน", "class='no_br_head' id = 'head_pcu'");

        foreach ($r506->result() as $rs):
            $Table->startRow();
            $Table->addCell($rs->DISEASE_CODE, "id = 'no_br_pcu' style='text-align:center;'  ");
            $Table->addCell($rs->DISEASE_NAME, "id = 'no_br_pcu' ");
            $Table->addCell(number_format($rs->TOTAL), "id = 'no_br' ");
            $Table->addCell(number_format(($rs->TOTAL * 1000000) / $population, 2), "id = 'no_br' ");
            $Table->endRow();
        endforeach;

        $data['tables'] = $Table->render();
        $data['graph'] = "";

        //########################### เช็คการแสดงหน้าจอ ###################//
        if ($mobile == 'false') {
            $template_name = 'r506/template_r506';
        } else {
            $template_name = 'mobile/report_disease_group_mobile';
        }

        $this->output($data, $template_name, '');
    }
    
    public function actionList_506(){
        
        $distId = Yii::app()->session['distId'];
        
        $year = $_POST['year'];
        $report = new Report_r506();
        
        $r506 = $report->List_disease_506($year,$distId);
        $person = $report->Sumperson($year,$distId);
        
        $Table = new TakisTables();
        $Table->setClass("stripe row-border order-column cell-border");
        $Table->showColumnIndex(false);
        //$color = $this->border_color();
        //$Table->setClass("cell-border");
        //$Table->setId('tableReport');
        $Table->addHeader("อันดับโรคทางระบาดวิทยา ปี ".($year+543)." (จำนวนประชากร ".number_format($person).")","colspan='3' ");
        $Table->addSpanHeader("โรค", "class='no_br_head' id = 'head_pcu'");
        $Table->addSpanHeader("จำนวนผู้ป่วย");
        $Table->addSpanHeader("อัตราต่อแสน");

        foreach ($r506 as $rs):
            $Table->startRow();
            $Table->addCell($rs['DIS'].'-'.$rs['NAME_THAI'], "align='left' id= 'setText-Left' ");
            $Table->addCell(number_format($rs['TOTAL']));
            if(!empty($person)){
                $percent = ($rs['TOTAL'] * 1000000) / $person;
            } else {
                $percent = 0;
            }
            $Table->addCell(number_format($percent, 2));
            $Table->endRow();
        endforeach;
        
        $data['tables'] = $Table->render();
        $this->renderPartial("//reports/report_singletable", $data);
    }

}
