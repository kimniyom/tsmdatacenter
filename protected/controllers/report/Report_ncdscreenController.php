<?php

class Report_ncdscreenController extends Controller {

    public function actionReport_dm() {
        $LIP = new Lib_report();
        $Month = $LIP->monthfullperiod();
        $Report = new Report_ncdscreen();
        $TakisTable = new TakisTables();
        //1 = 15-34, 2 = 35-59 3 = 60+
        $group = $_GET['group'];

        $ampur = $_POST['distId'];
        $year = $_POST['year'];

        if ($ampur != '0') {
            $result = $Report->Get_dm_ampur($year, $ampur, $group);
            $resultValue = $Report->Get_dm_ampur_value($year, $ampur, $group);
            $NAME = "สถานบริการ";
        } else {
            $result = $Report->Get_dm_changwat($year, $group);
            $resultValue = $Report->Get_dm_changwat_value($year, $group);
            $NAME = "อำเภอ";
        }

        $allArrayA = array();
        $allArrayPercent = array();
        $SumAllA = array(0, 0, 0);
        $SumAllB = array(0, 0, 0);
        $SumAllTotal = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $SumMonthTotal = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($resultValue as $dt):
            $allArrayA[$dt['CODE']][$dt['PERIOD']] = $dt['A'];
            $allArrayPercent[$dt['CODE']][$dt['PERIOD']] = $dt['PERCENT'];
        endforeach;

        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($NAME, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("เป้าหมาย", "rowspan='2' ");

        $TakisTable->addHeader("รวม", "colspan='2' ");
        $TakisTable->addSpanHeader("ผลงาน");
        $TakisTable->addSpanHeader("ร้อยละ");

        $TakisTable->addHeader("ผลการคัดกรอง", "colspan='2' ");
        $TakisTable->addSpanHeader("ปกติ");
        $TakisTable->addSpanHeader("เสี่ยงสูง");
        $TakisTable->addSpanHeader("สงสัยรายใหม่");

        for ($i = 0; $i <= 11; $i++):
            $TakisTable->addHeader($Month[$i], "colspan='3' ");
            $TakisTable->addSpanHeader("ผลงาน");
            $TakisTable->addSpanHeader("ผลงานสะสม");
            $TakisTable->addSpanHeader("ร้อยละ");
        endfor;

        foreach ($result as $rs):
            $SumA = array(0, 0);
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $rs['NAMES'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']), " style='background:#ffff66;' ");
            $SumAllB[0] = $SumAllB[0] + $rs['B']; //เก็บค่ารวมทั้งหมดของเป้าหมาย
            $SumAllA[0] = $SumAllA[0] + $rs['A']; //เก็บค่ารวมทั้งหมดของผลงาน
            $Percent = 0;

            if (!empty($rs['B'])) {
                //Sum
                $Percent = ($rs['A'] / $rs['B']) * 100; //หาร้อยละ
                if ($Percent >= 90) {
                    $style = "style='background:green; color:#FFF'";
                } else {
                    $style = "style='background:red; color:#FFF'";
                }
            } else {
                $Percent = "0.00";
            }

            $TakisTable->addCell(number_format($rs['A']), " style='background:#99ff99;' ");
            $TakisTable->addCell(number_format($Percent, 2), " $style ");
            $TakisTable->addCell(number_format($rs['RS_NORMAL']), " style='background:#ffff66;' ");
            $TakisTable->addCell(number_format($rs['RS_RISK']), " style='background:#ffff66;' ");
            $TakisTable->addCell(number_format($rs['RS_CHRONIC']), " style='background:#ffff66;' ");

            $SUMRS_NORMAL = ($SUMRS_NORMAL + $rs['RS_NORMAL']);
            $SUMRS_RISK = ($SUMRS_RISK + $rs['RS_RISK']);
            $SUMRS_CHRONIC = ($SUMRS_CHRONIC + $rs['RS_CHRONIC']);
            
            for ($i = 10; $i <= 12; $i++):
                $SumA[0] = $SumA[0] + $allArrayA[$rs['CODE']][$i];
                $TakisTable->addCell(number_format($allArrayA[$rs['CODE']][$i]));
                $TakisTable->addCell(number_format($SumA[0]));
                if (!empty($SumA[0])) {
                    $percentAll = ($SumA[0] / $rs['B']) * 100;
                } else {
                    $percentAll = 0;
                }
                $TakisTable->addCell(number_format($percentAll, 2), " style='background:#9999FF;color:#FFF;' ");

                $SumAllTotal[$i] = $SumAllTotal[$i] + $allArrayA[$rs['CODE']][$i];
                $SumMonthTotal[$i] = $SumMonthTotal[$i] + $SumA[0];
            endfor;

            for ($i = 1; $i <= 9; $i++):
                $m = "0" . $i;
                $SumA[1] = $SumA[1] + $allArrayA[$rs['CODE']][$m];
                $TakisTable->addCell(number_format($allArrayA[$rs['CODE']][$m]));
                $TakisTable->addCell(number_format($SumA[0] + $SumA[1]));
                if (!empty($SumA[1])) {
                    $percentAll = (($SumA[0] + $SumA[1]) / $rs['B']) * 100;
                } else {
                    $percentAll = 0;
                }
                $TakisTable->addCell(number_format($percentAll, 2), " style='background:#9999FF;color:#FFF;' ");
                $SumAllTotal[$i] = $SumAllTotal[$i] + $allArrayA[$rs['CODE']][$m];
                $SumMonthTotal[$i] = $SumMonthTotal[$i] + ($SumA[0] + $SumA[1]);
            endfor;

            $TakisTable->endRow();
        endforeach;

        // add summary
        // $TakisTable->startRow();
        $TakisTable->addFooter("รวม", "align='center' ");
        $TakisTable->addFooter(number_format($SumAllB[0]), "align='right'");
        $TakisTable->addFooter(number_format($SumAllA[0]), "align='right'");
        if (!empty($SumAllB[0])) {
            $percenttotal = ($SumAllA[0] / $SumAllB[0]) * 100;
        } else {
            $percenttotal = 0;
        }

        $TakisTable->addFooter(number_format($percenttotal, 2));

        $TakisTable->addFooter(number_format($SUMRS_NORMAL));
        $TakisTable->addFooter(number_format($SUMRS_RISK));
         $TakisTable->addFooter(number_format($SUMRS_CHRONIC));
         
        for ($i = 10; $i <= 12; $i++):
            $TakisTable->addFooter(number_format($SumAllTotal[$i]));
            if (!empty($SumAllB[0])) {
                $percentmonth = ($SumMonthTotal[$i] / $SumAllB[0]) * 100;
            } else {
                $percentmonth = 0;
            }

            $TakisTable->addFooter(number_format($SumMonthTotal[$i]));
            $TakisTable->addFooter(number_format($percentmonth, 2));
        endfor;

        for ($i = 1; $i <= 9; $i++):
            $m = "0" . $i;
            $TakisTable->addFooter(number_format($SumAllTotal[$i]));
            if (!empty($SumAllB[0])) {
                $percentmonth = ($SumMonthTotal[$i] / $SumAllB[0]) * 100;
            } else {
                $percentmonth = 0;
            }
            $TakisTable->addFooter(number_format($SumMonthTotal[$i]));
            $TakisTable->addFooter(number_format($percentmonth, 2));
        endfor;
        //$TakisTable->endRow();

        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $Report->Getdatequery("rpt_ncdscreen");

        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionReport_ht() {
        $LIP = new Lib_report();
        $Month = $LIP->monthfullperiod();
        $Report = new Report_ncdscreen();
        $TakisTable = new TakisTables();
        //1 = 15-34, 2 = 35-59 3 = 60+
        $group = $_GET['group'];

        $ampur = $_POST['distId'];
        $year = $_POST['year'];

        if ($ampur != '0') {
            $result = $Report->Get_ht_ampur($year, $ampur, $group);
            $resultValue = $Report->Get_ht_ampur_value($year, $ampur, $group);
            $NAME = "สถานบริการ";
        } else {
            $result = $Report->Get_ht_changwat($year, $group);
            $resultValue = $Report->Get_ht_changwat_value($year, $group);
            $NAME = "อำเภอ";
        }

        $allArrayA = array();
        $allArrayPercent = array();
        $SumAllA = array(0, 0, 0);
        $SumAllB = array(0, 0, 0);
        $SumAllTotal = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $SumMonthTotal = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        foreach ($resultValue as $dt):
            $allArrayA[$dt['CODE']][$dt['PERIOD']] = $dt['A'];
            $allArrayPercent[$dt['CODE']][$dt['PERIOD']] = $dt['PERCENT'];
        endforeach;

        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($NAME, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("เป้าหมาย", "rowspan='2' ");

        $TakisTable->addHeader("รวม", "colspan='2' ");
        $TakisTable->addSpanHeader("ผลงาน");
        $TakisTable->addSpanHeader("ร้อยละ");

        $TakisTable->addHeader("ผลการคัดกรอง", "colspan='3' ");
        $TakisTable->addSpanHeader("ปกติ");
        $TakisTable->addSpanHeader("เสี่ยงสูง");
        $TakisTable->addSpanHeader("สงสัยรายใหม่");

        for ($i = 0; $i <= 11; $i++):
            $TakisTable->addHeader($Month[$i], "colspan='3' ");
            $TakisTable->addSpanHeader("ผลงาน");
            $TakisTable->addSpanHeader("ผลงานสะสม");
            $TakisTable->addSpanHeader("ร้อยละ");
        endfor;

        foreach ($result as $rs):
            $SumA = array(0, 0);
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $rs['NAMES'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']), " style='background:#ffff66;' ");
            $SumAllB[0] = $SumAllB[0] + $rs['B']; //เก็บค่ารวมทั้งหมดของเป้าหมาย
            $SumAllA[0] = $SumAllA[0] + $rs['A']; //เก็บค่ารวมทั้งหมดของผลงาน
            $Percent = 0;

            if (!empty($rs['B'])) {
                //Sum
                $Percent = ($rs['A'] / $rs['B']) * 100; //หาร้อยละ
                if ($Percent >= 90) {
                    $style = "style='background:green; color:#FFF'";
                } else {
                    $style = "style='background:red; color:#FFF'";
                }
            } else {
                $Percent = "0.00";
            }

            $TakisTable->addCell(number_format($rs['A']), " style='background:#99ff99;' ");
            $TakisTable->addCell(number_format($Percent, 2), " $style ");
            $TakisTable->addCell(number_format($rs['RS_NORMAL']), " style='background:#ffff66;' ");
            $TakisTable->addCell(number_format($rs['RS_RISK']), " style='background:#ffff66;' ");
             $TakisTable->addCell(number_format($rs['RS_CHRONIC']), " style='background:#ffff66;' ");

            $SUMRS_NORMAL = ($SUMRS_NORMAL + $rs['RS_NORMAL']);
            $SUMRS_RISK = ($SUMRS_RISK + $rs['RS_RISK']);
            $SUMRS_CHRONIC = ($SUMRS_CHRONIC + $rs['RS_CHRONIC']);
            for ($i = 10; $i <= 12; $i++):
                $SumA[0] = $SumA[0] + $allArrayA[$rs['CODE']][$i];
                $TakisTable->addCell(number_format($allArrayA[$rs['CODE']][$i]));
                $TakisTable->addCell(number_format($SumA[0]));
                if (!empty($SumA[0])) {
                    $percentAll = ($SumA[0] / $rs['B']) * 100;
                } else {
                    $percentAll = 0;
                }
                $TakisTable->addCell(number_format($percentAll, 2), " style='background:#9999FF;color:#FFF;' ");

                $SumAllTotal[$i] = $SumAllTotal[$i] + $allArrayA[$rs['CODE']][$i];
                $SumMonthTotal[$i] = $SumMonthTotal[$i] + $SumA[0];
            endfor;

            for ($i = 1; $i <= 9; $i++):
                $m = "0" . $i;
                $SumA[1] = $SumA[1] + $allArrayA[$rs['CODE']][$m];
                $TakisTable->addCell(number_format($allArrayA[$rs['CODE']][$m]));
                $TakisTable->addCell(number_format($SumA[0] + $SumA[1]));
                if (!empty($SumA[1])) {
                    $percentAll = (($SumA[0] + $SumA[1]) / $rs['B']) * 100;
                } else {
                    $percentAll = 0;
                }
                $TakisTable->addCell(number_format($percentAll, 2), " style='background:#9999FF;color:#FFF;' ");
                $SumAllTotal[$i] = $SumAllTotal[$i] + $allArrayA[$rs['CODE']][$m];
                $SumMonthTotal[$i] = $SumMonthTotal[$i] + ($SumA[0] + $SumA[1]);
            endfor;

            $TakisTable->endRow();
        endforeach;

        // add summary
        // $TakisTable->startRow();
        $TakisTable->addFooter("รวม", "align='center' ");
        $TakisTable->addFooter(number_format($SumAllB[0]), "align='right'");
        $TakisTable->addFooter(number_format($SumAllA[0]), "align='right'");
        if (!empty($SumAllB[0])) {
            $percenttotal = ($SumAllA[0] / $SumAllB[0]) * 100;
        } else {
            $percenttotal = 0;
        }

        $TakisTable->addFooter(number_format($percenttotal, 2));

        $TakisTable->addFooter(number_format($SUMRS_NORMAL));
        $TakisTable->addFooter(number_format($SUMRS_RISK));
        $TakisTable->addFooter(number_format($SUMRS_CHRONIC));
        
        for ($i = 10; $i <= 12; $i++):
            $TakisTable->addFooter(number_format($SumAllTotal[$i]));
            if (!empty($SumAllB[0])) {
                $percentmonth = ($SumMonthTotal[$i] / $SumAllB[0]) * 100;
            } else {
                $percentmonth = 0;
            }

            $TakisTable->addFooter(number_format($SumMonthTotal[$i]));
            $TakisTable->addFooter(number_format($percentmonth, 2));
        endfor;

        for ($i = 1; $i <= 9; $i++):
            $m = "0" . $i;
            $TakisTable->addFooter(number_format($SumAllTotal[$i]));
            if (!empty($SumAllB[0])) {
                $percentmonth = ($SumMonthTotal[$i] / $SumAllB[0]) * 100;
            } else {
                $percentmonth = 0;
            }
            $TakisTable->addFooter(number_format($SumMonthTotal[$i]));
            $TakisTable->addFooter(number_format($percentmonth, 2));
        endfor;
        //$TakisTable->endRow();


        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $Report->Getdatequery("rpt_ncdscreen");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_predm() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_ncdscreen();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->bh_predm_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->bh_predm_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("Pre-diabetes", "");
        $takisTable->addHeader("ได้รับการวินิจฉัยผู้ป่วยรายใหม่", "");
        $takisTable->addHeader("ร้อยละ", "");
        $result = $PCU;

       foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['B']), "align='right'");
            $takisTable->addCell(number_format($rs['A']), "align='right'");
            //รวม
            $sumA = $sumA + $rs['A'];
            $sumB = $sumB + $rs['B'];
            //ร้อยละ
            if($rs['B'] != 0){
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = 0;
            }
            $takisTable->addCell(number_format($percent,2), "align='right'");
            $takisTable->endRow();
        endforeach;
        

            $takisTable->addFooter("รวม", "align='center' ");
            $takisTable->addFooter(number_format($sumB), "align='right' id= 'setText-Right'");
            $takisTable->addFooter(number_format($sumA), "align='right' id= 'setText-Right'");
            //Percent 
            if($sumB != 0){
                $sumpercent = ($sumA / $sumB) * 100;
            } else {
                $sumpercent = 0;
            }
            $takisTable->addFooter(number_format($sumpercent,2), "align='right' id= 'setText-Right'");

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_predm");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_preht() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_ncdscreen();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->bh_preht_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->bh_preht_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("Pre-hypertension", "");
        $takisTable->addHeader("ได้รับการวินิจฉัยผู้ป่วยรายใหม่", "");
        $takisTable->addHeader("ร้อยละ", "");
        $result = $PCU;

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['B']), "align='right'");
            $takisTable->addCell(number_format($rs['A']), "align='right'");
            //รวม
            $sumA = $sumA + $rs['A'];
            $sumB = $sumB + $rs['B'];
            //ร้อยละ
            if($rs['B'] != 0){
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = 0;
            }
            $takisTable->addCell(number_format($percent,2), "align='right'");
            $takisTable->endRow();
        endforeach;
        

            $takisTable->addFooter("รวม", "align='center' ");
            $takisTable->addFooter(number_format($sumB), "align='right' id= 'setText-Right'");
            $takisTable->addFooter(number_format($sumA), "align='right' id= 'setText-Right'");
            //Percent 
            if($sumB != 0){
                $sumpercent = ($sumA / $sumB) * 100;
            } else {
                $sumpercent = 0;
            }
            $takisTable->addFooter(number_format($sumpercent,2), "align='right' id= 'setText-Right'");

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_preht");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionProgress($group = '') {
        if (Yii::app()->session['distcode'] != '6300') {
            
        } else {
            
        }
    }

}

?>
