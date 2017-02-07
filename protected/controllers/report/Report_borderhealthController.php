<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Report_borderhealthController extends Controller {

    public function actionBh_fp() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->bh_fp_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->bh_fp_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='3' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='14' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='14' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='14' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='14' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='14' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("ยาเม็ด (แผง)", "colspan='2' ");
            $Tables .= $Table->TH("ยาฉีด", "colspan='2' ");
            $Tables .= $Table->TH("ห่วงอนามัย", "colspan='2' ");
            $Tables .= $Table->TH("ยาฝัง", "colspan='2' ");
            $Tables .= $Table->TH("ถุงยางอนามัย (ชิ้น)", "colspan='2' ");
            $Tables .= $Table->TH("หมันชาย", "colspan='2' ");
            $Tables .= $Table->TH("หมันหญิง", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();


        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 35; $i++) {
            $Tables .= $Table->TH("คน", "");
            $Tables .= $Table->TH("ครั้ง", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $SUM_F1_PID = array(0, 0, 0, 0, 0);
        $SUM_F1_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F2_PID = array(0, 0, 0, 0, 0);
        $SUM_F2_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F3_PID = array(0, 0, 0, 0, 0);
        $SUM_F3_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F4_PID = array(0, 0, 0, 0, 0);
        $SUM_F4_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F5_PID = array(0, 0, 0, 0, 0);
        $SUM_F5_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F6_PID = array(0, 0, 0, 0, 0);
        $SUM_F6_SEQ = array(0, 0, 0, 0, 0);
        $SUM_F7_PID = array(0, 0, 0, 0, 0);
        $SUM_F7_SEQ = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["F1_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F1_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F2_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F2_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F3_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F3_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F4_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F4_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F5_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F5_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F6_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F6_SEQ_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F7_PID_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["F7_SEQ_$i"]), $style);

                //Sum
                $SUM_F1_PID[$i] = $SUM_F1_PID[$i] + $rs["F1_PID_$i"];
                $SUM_F1_SEQ[$i] = $SUM_F1_SEQ[$i] + $rs["F1_SEQ_$i"];
                $SUM_F2_PID[$i] = $SUM_F2_PID[$i] + $rs["F2_PID_$i"];
                $SUM_F2_SEQ[$i] = $SUM_F2_SEQ[$i] + $rs["F2_SEQ_$i"];
                $SUM_F2_PID[$i] = $SUM_F2_PID[$i] + $rs["F3_PID_$i"];
                $SUM_F2_SEQ[$i] = $SUM_F2_SEQ[$i] + $rs["F3_SEQ_$i"];
                $SUM_F2_PID[$i] = $SUM_F2_PID[$i] + $rs["F4_PID_$i"];
                $SUM_F2_SEQ[$i] = $SUM_F2_SEQ[$i] + $rs["F4_SEQ_$i"];
                $SUM_F5_PID[$i] = $SUM_F5_PID[$i] + $rs["F5_PID_$i"];
                $SUM_F5_SEQ[$i] = $SUM_F5_SEQ[$i] + $rs["F5_SEQ_$i"];
                $SUM_F2_PID[$i] = $SUM_F2_PID[$i] + $rs["F6_PID_$i"];
                $SUM_F2_SEQ[$i] = $SUM_F2_SEQ[$i] + $rs["F6_SEQ_$i"];
                $SUM_F2_PID[$i] = $SUM_F2_PID[$i] + $rs["F7_PID_$i"];
                $SUM_F2_SEQ[$i] = $SUM_F2_SEQ[$i] + $rs["F7_SEQ_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($SUM_F1_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F1_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F2_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F2_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F3_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F3_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F4_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F4_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F5_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F5_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F6_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F6_SEQ[$i]));
            $Tables .= $Table->TD(number_format($SUM_F7_PID[$i]));
            $Tables .= $Table->TD(number_format($SUM_F7_SEQ[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_fp");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_bcg() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Bcg_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Bcg_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='3' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='3' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("แรกคลอด");
            $Tables .= $Table->TH("< 1 ปี");
            $Tables .= $Table->TH("> 1  ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $BCG_FIRST = array(0, 0, 0, 0, 0);
        $BCG = array(0, 0, 0, 0, 0);
        $BCG_1 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["BCG_FIRST_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BCG_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BCG_1_$i"]), $style);

                //Sum
                $BCG_FIRST[$i] = $BCG_FIRST[$i] + $rs["BCG_FIRST_$i"];
                $BCG[$i] = $BCG[$i] + $rs["BCG_$i"];
                $BCG_1[$i] = $BCG_1[$i] + $rs["BCG_1_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($BCG_FIRST[$i]));
            $Tables .= $Table->TD(number_format($BCG[$i]));
            $Tables .= $Table->TD(number_format($BCG_1[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_hb() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Hb_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Hb_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='3' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='3' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("แรกคลอด");
            $Tables .= $Table->TH("< 1 ปี");
            $Tables .= $Table->TH("hb2");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $HB1 = array(0, 0, 0, 0, 0);
        $HB1_1 = array(0, 0, 0, 0, 0);
        $BCG2 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["HB1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["HB1_1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BCG2_$i"]), $style);

                //Sum
                $HB1[$i] = $HB1[$i] + $rs["HB1_$i"];
                $HB1_1[$i] = $HB1_1[$i] + $rs["HB1_1_$i"];
                $BCG2[$i] = $BCG2[$i] + $rs["HB2_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($HB1[$i]));
            $Tables .= $Table->TD(number_format($HB1_1[$i]));
            $Tables .= $Table->TD(number_format($BCG2[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_Dtphb_less1year() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dtphb_less_1_year_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dtphb_less_1_year_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='3' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='3' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("DTPHB1,OPV ");
            $Tables .= $Table->TH("DTPHB2,OPV2");
            $Tables .= $Table->TH("DTPHB3,OPV3");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DTPHB1 = array(0, 0, 0, 0, 0);
        $DTPHB2 = array(0, 0, 0, 0, 0);
        $DTPHB3 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["DTPHB1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB2_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB3_$i"]), $style);

                //Sum
                $DTPHB1[$i] = $DTPHB1[$i] + $rs["DTPHB1_$i"];
                $DTPHB2[$i] = $DTPHB2[$i] + $rs["DTPHB2_$i"];
                $DTPHB3[$i] = $DTPHB3[$i] + $rs["DTPHB3_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DTPHB1[$i]));
            $Tables .= $Table->TD(number_format($DTPHB2[$i]));
            $Tables .= $Table->TD(number_format($DTPHB3[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_Dtphb_more1year() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dtphb_more_1_year_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dtphb_more_1_year_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='3' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='3' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("DTPHB1,OPV ");
            $Tables .= $Table->TH("DTPHB2,OPV2");
            $Tables .= $Table->TH("DTPHB3,OPV3");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DTPHB1 = array(0, 0, 0, 0, 0);
        $DTPHB2 = array(0, 0, 0, 0, 0);
        $DTPHB3 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["DTPHB1_1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB2_1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB3_1_$i"]), $style);

                //Sum
                $DTPHB1[$i] = $DTPHB1[$i] + $rs["DTPHB1_1_$i"];
                $DTPHB2[$i] = $DTPHB2[$i] + $rs["DTPHB2_1_$i"];
                $DTPHB3[$i] = $DTPHB3[$i] + $rs["DTPHB3_1_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DTPHB1[$i]));
            $Tables .= $Table->TD(number_format($DTPHB2[$i]));
            $Tables .= $Table->TD(number_format($DTPHB3[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_Dtp4() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dtp4_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dtp4_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 2 ปี");
            $Tables .= $Table->TH("อายุ > 2 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DTPHB1 = array(0, 0, 0, 0, 0);
        $DTPHB2 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["DTPOPV4_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPOPV4_2_$i"]), $style);

                //Sum
                $DTPHB1[$i] = $DTPHB1[$i] + $rs["DTPOPV4_$i"];
                $DTPHB2[$i] = $DTPHB2[$i] + $rs["DTPOPV4_2_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DTPHB1[$i]));
            $Tables .= $Table->TD(number_format($DTPHB2[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_Dtp5() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dtp5_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dtp5_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 5 ปี");
            $Tables .= $Table->TH("อายุ > 5 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DTPHB1 = array(0, 0, 0, 0, 0);
        $DTPHB2 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["DTPOPV5_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPOPV5_5_$i"]), $style);

                //Sum
                $DTPHB1[$i] = $DTPHB1[$i] + $rs["DTPOPV5_$i"];
                $DTPHB2[$i] = $DTPHB2[$i] + $rs["DTPOPV5_5_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DTPHB1[$i]));
            $Tables .= $Table->TD(number_format($DTPHB2[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_mmr1() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Mmr1_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Mmr1_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 1 ปี");
            $Tables .= $Table->TH("อายุ > 1 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $MMR1 = array(0, 0, 0, 0, 0);
        $MMR1_1 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["MMR1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["MMR1_1_$i"]), $style);

                //Sum
                $MMR1[$i] = $MMR1[$i] + $rs["MMR1_$i"];
                $MMR1_1[$i] = $MMR1_1[$i] + $rs["MMR1_1_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($MMR1[$i]));
            $Tables .= $Table->TD(number_format($MMR1_1[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_mmr2() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Mmr2_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Mmr2_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 3 ปี");
            $Tables .= $Table->TH("อายุ > 3 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $MMR2 = array(0, 0, 0, 0, 0);
        $MMR2_3 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["MMR2_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["MMR2_3_$i"]), $style);

                //Sum
                $MMR1[$i] = $MMR1[$i] + $rs["MMR2_$i"];
                $MMR1_1[$i] = $MMR1_1[$i] + $rs["MMR2_3_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($MMR2[$i]));
            $Tables .= $Table->TD(number_format($MMR2_3[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_laje1() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Laje1_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Laje1_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 2 ปี");
            $Tables .= $Table->TH("อายุ > 2 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $LAJE1 = array(0, 0, 0, 0, 0);
        $LAJE1_2 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["LAJE1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["LAJE1_2_$i"]), $style);

                //Sum
                $LAJE1[$i] = $LAJE1[$i] + $rs["LAJE1_$i"];
                $LAJE1_2[$i] = $LAJE1_2[$i] + $rs["LAJE1_2_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($LAJE1[$i]));
            $Tables .= $Table->TD(number_format($LAJE1_2[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_laje2() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Laje2_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Laje2_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='2' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='2' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("อายุ < 3 ปี");
            $Tables .= $Table->TH("อายุ > 3 ปี");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $LAJE1 = array(0, 0, 0, 0, 0);
        $LAJE1_2 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["LAJE3_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["LAJE3_3_$i"]), $style);

                //Sum
                $LAJE1[$i] = $LAJE1[$i] + $rs["LAJE3_$i"];
                $LAJE1_2[$i] = $LAJE1_2[$i] + $rs["LAJE3_3_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($LAJE1[$i]));
            $Tables .= $Table->TD(number_format($LAJE1_2[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_all");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_dt() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dt_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dt_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='3' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='3' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='3' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("DT1");
            $Tables .= $Table->TH("DT2");
            $Tables .= $Table->TH("DT3");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DT106 = array(0, 0, 0, 0, 0);
        $DT107 = array(0, 0, 0, 0, 0);
        $DT108 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["VAC_106_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["VAC_107_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["VAC_108_$i"]), $style);

                //Sum
                $DT106[$i] = $DT106[$i] + $rs["VAC_106_$i"];
                $DT107[$i] = $DT107[$i] + $rs["VAC_107_$i"];
                $DT108[$i] = $DT108[$i] + $rs["VAC_108_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DT106[$i]));
            $Tables .= $Table->TD(number_format($DT107[$i]));
            $Tables .= $Table->TD(number_format($DT108[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_dt");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_anc() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Dt_anc_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Dt_anc_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='5' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='5' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("DTANC1");
            $Tables .= $Table->TH("DTANC2");
            $Tables .= $Table->TH("DTANC3");
            $Tables .= $Table->TH("DTANC4");
            $Tables .= $Table->TH("DTANC5");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $DTANC1 = array(0, 0, 0, 0, 0);
        $DTANC2 = array(0, 0, 0, 0, 0);
        $DTANC3 = array(0, 0, 0, 0, 0);
        $DTANC4 = array(0, 0, 0, 0, 0);
        $DTANC5 = array(0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["DTANC1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTANC2_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTANC3_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTANC4_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTANC5_$i"]), $style);

                //Sum
                $DTANC1[$i] = $DTANC1[$i] + $rs["DTANC1_$i"];
                $DTANC2[$i] = $DTANC2[$i] + $rs["DTANC2_$i"];
                $DTANC3[$i] = $DTANC3[$i] + $rs["DTANC3_$i"];
                $DTANC4[$i] = $DTANC4[$i] + $rs["DTANC4_$i"];
                $DTANC5[$i] = $DTANC5[$i] + $rs["DTANC5_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($DTANC1[$i]));
            $Tables .= $Table->TD(number_format($DTANC2[$i]));
            $Tables .= $Table->TD(number_format($DTANC3[$i]));
            $Tables .= $Table->TD(number_format($DTANC4[$i]));
            $Tables .= $Table->TD(number_format($DTANC5[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_anc");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_bplace() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $PCU = $report->Bplace_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $PCU = $report->Bplace_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH("สถานที่", "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='6' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='6' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='6' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='6' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='6' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("แพทย์");
            $Tables .= $Table->TH("พยาบาล");
            $Tables .= $Table->TH("จนท.สธ");
            $Tables .= $Table->TH("ผดุงครรภ์โบราณ");
            $Tables .= $Table->TH("คลอดเอง");
            $Tables .= $Table->TH("อื่น ๆ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $BPLACE1 = array(0, 0, 0, 0, 0,0);
        $BPLACE2 = array(0, 0, 0, 0, 0,0);
        $BPLACE3 = array(0, 0, 0, 0, 0,0);
        $BPLACE4 = array(0, 0, 0, 0, 0,0);
        $BPLACE5 = array(0, 0, 0, 0, 0,0);
        $BPLACE6 = array(0, 0, 0, 0, 0,0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            if ($rs['BPLACE'] == '1') {
                $Location = "รพ.";
            } else if ($rs['BPLACE'] == '2') {
                $Location = "สถานีอนามัย";
            } else if ($rs['BPLACE'] == '3') {
                $Location = "บ้าน";
            } else if ($rs['BPLACE'] == '4') {
                $Location = "ระหว่างทาง";
            } else if ($rs['BPLACE'] == '5') {
                $Location = "อื่น ๆ";
            }
            $Tables .= $Table->TH($Location);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["BDOCTOR1_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BDOCTOR2_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BDOCTOR3_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BDOCTOR4_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BDOCTOR5_$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["BDOCTOR6_$i"]), $style);

                //Sum
                $BPLACE1[$i] = $BPLACE1[$i] + $rs["BDOCTOR1_$i"];
                $BPLACE2[$i] = $BPLACE2[$i] + $rs["BDOCTOR2_$i"];
                $BPLACE3[$i] = $BPLACE3[$i] + $rs["BDOCTOR3_$i"];
                $BPLACE4[$i] = $BPLACE4[$i] + $rs["BDOCTOR4_$i"];
                $BPLACE5[$i] = $BPLACE5[$i] + $rs["BDOCTOR5_$i"];
                $BPLACE6[$i] = $BPLACE6[$i] + $rs["BDOCTOR6_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TD(number_format($BPLACE1[$i]));
            $Tables .= $Table->TD(number_format($BPLACE2[$i]));
            $Tables .= $Table->TD(number_format($BPLACE3[$i]));
            $Tables .= $Table->TD(number_format($BPLACE4[$i]));
            $Tables .= $Table->TD(number_format($BPLACE5[$i]));
            $Tables .= $Table->TD(number_format($BPLACE6[$i]));
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_bplace");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_vccgroup() {

        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];
        $report = new Border_health();

        //echo $ampur.' - '.$pcu;
        //exit();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        $PCU = $report->Vacine_group($year, $ampur, $pcu); //Get ชื่อสถานบริการมาแสดง
        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH("กลุ่มวัคซีน", "rowspan='2' ");

        $Tables .= $Table->TH("ตุลาคม", "colspan='2' ");
        $Tables .= $Table->TH("พฤศจิกายน", "colspan='2' ");
        $Tables .= $Table->TH("ธันวาคม", "colspan='2' ");
        $Tables .= $Table->TH("มกราคม", "colspan='2' ");
        $Tables .= $Table->TH("กุมภาพันธ์", "colspan='2' ");
        $Tables .= $Table->TH("มีนาคม", "colspan='2' ");
        $Tables .= $Table->TH("เมษายน", "colspan='2' ");
        $Tables .= $Table->TH("พฤษภาคม", "colspan='2' ");
        $Tables .= $Table->TH("มิถุนายน", "colspan='2' ");
        $Tables .= $Table->TH("กรกฎาคม", "colspan='2' ");
        $Tables .= $Table->TH("สิงหาคม", "colspan='2' ");
        $Tables .= $Table->TH("กันยายน", "colspan='2' ");
        $Tables .= $Table->TH("รวม", "rowspan='2' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 12; $i++) {
            $Tables .= $Table->TH("ชาย");
            $Tables .= $Table->TH("หญิง");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $MEN = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $WOMEN = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        $TOTALALL = 0;
        $TOTAL = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['vaccine_group'] . ' ' . $rs['vaccine_name']);
            //for ($i = 1; $i <= 5; $i++) {
            $styleTotal = "style='background:#F90;color:#FFF; font-weight:bold'";
            $style = "";

            $Tables .= $Table->TD(number_format($rs["MEN_10"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_10"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_11"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_11"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_12"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_12"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_01"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_01"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_02"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_02"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_03"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_03"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_04"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_04"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_05"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_05"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_06"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_06"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_07"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_07"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_08"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_08"]), $style);
            $Tables .= $Table->TD(number_format($rs["MEN_08"]), $style);
            $Tables .= $Table->TD(number_format($rs["WOMEN_09"]), $style);

            $Tables .= $Table->TD(number_format($rs["TOTAL"]), $styleTotal);

            //Sum
            $MEN[0] = $MEN[0] + $rs["MEN_10"];
            $WOMEN[0] = $WOMEN[0] + $rs["WOMEN_10"];
            $MEN[1] = $MEN[1] + $rs["MEN_11"];
            $WOMEN[1] = $WOMEN[1] + $rs["WOMEN_11"];
            $MEN[2] = $MEN[2] + $rs["MEN_12"];
            $WOMEN[2] = $WOMEN[2] + $rs["WOMEN_12"];
            $MEN[3] = $MEN[3] + $rs["MEN_01"];
            $WOMEN[3] = $WOMEN[3] + $rs["WOMEN_01"];
            $MEN[4] = $MEN[4] + $rs["MEN_02"];
            $WOMEN[4] = $WOMEN[4] + $rs["WOMEN_02"];
            $MEN[5] = $MEN[5] + $rs["MEN_03"];
            $WOMEN[5] = $WOMEN[5] + $rs["WOMEN_03"];
            $MEN[6] = $MEN[6] + $rs["MEN_04"];
            $WOMEN[6] = $WOMEN[6] + $rs["WOMEN_04"];
            $MEN[7] = $MEN[7] + $rs["MEN_05"];
            $WOMEN[7] = $WOMEN[7] + $rs["WOMEN_05"];
            $MEN[8] = $MEN[8] + $rs["MEN_06"];
            $WOMEN[8] = $WOMEN[8] + $rs["WOMEN_06"];
            $MEN[9] = $MEN[9] + $rs["MEN_07"];
            $WOMEN[9] = $WOMEN[9] + $rs["WOMEN_07"];
            $MEN[10] = $MEN[10] + $rs["MEN_08"];
            $WOMEN[10] = $WOMEN[10] + $rs["WOMEN_08"];
            $MEN[11] = $MEN[11] + $rs["MEN_09"];
            $WOMEN[11] = $WOMEN[11] + $rs["WOMEN_09"];

            $TOTALALL = $TOTALALL + $rs["TOTAL"];
            //}
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        //for ($i = 1; $i <= 5; $i++) {
        $Tables .= $Table->TD(number_format($MEN[0]));
        $Tables .= $Table->TD(number_format($WOMEN[0]));
        $Tables .= $Table->TD(number_format($MEN[1]));
        $Tables .= $Table->TD(number_format($WOMEN[1]));
        $Tables .= $Table->TD(number_format($MEN[2]));
        $Tables .= $Table->TD(number_format($WOMEN[2]));
        $Tables .= $Table->TD(number_format($MEN[3]));
        $Tables .= $Table->TD(number_format($WOMEN[3]));
        $Tables .= $Table->TD(number_format($MEN[4]));
        $Tables .= $Table->TD(number_format($WOMEN[4]));
        $Tables .= $Table->TD(number_format($MEN[5]));
        $Tables .= $Table->TD(number_format($WOMEN[5]));
        $Tables .= $Table->TD(number_format($MEN[6]));
        $Tables .= $Table->TD(number_format($WOMEN[6]));
        $Tables .= $Table->TD(number_format($MEN[7]));
        $Tables .= $Table->TD(number_format($WOMEN[7]));
        $Tables .= $Table->TD(number_format($MEN[8]));
        $Tables .= $Table->TD(number_format($WOMEN[8]));
        $Tables .= $Table->TD(number_format($MEN[9]));
        $Tables .= $Table->TD(number_format($WOMEN[9]));
        $Tables .= $Table->TD(number_format($MEN[10]));
        $Tables .= $Table->TD(number_format($WOMEN[10]));
        $Tables .= $Table->TD(number_format($MEN[11]));
        $Tables .= $Table->TD(number_format($WOMEN[11]));

        $Tables .= $Table->TD(number_format($TOTALALL));
        //}
        $Tables .= $Table->EndFooter();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_group");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_vaccine_preschoolers() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Bh_vaccine_preschoolers_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Bh_vaccine_preschoolers_ampur($year, $ampur); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='17' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='17' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='17' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='17' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='17' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("BCG");
            $Tables .= $Table->TH("HBV1");
            $Tables .= $Table->TH("HBV21");
            $Tables .= $Table->TH("DTPHB1");
            $Tables .= $Table->TH("DTPHB2");
            $Tables .= $Table->TH("DTPHB3");
            $Tables .= $Table->TH("DTP4");
            $Tables .= $Table->TH("DTP5");
            $Tables .= $Table->TH("MMR1");
            $Tables .= $Table->TH("MMR2");
            $Tables .= $Table->TH("J11");
            $Tables .= $Table->TH("J12");
            $Tables .= $Table->TH("OPV1");
            $Tables .= $Table->TH("OPV2");
            $Tables .= $Table->TH("OPV3");
            $Tables .= $Table->TH("OPV4");
            $Tables .= $Table->TH("OPV5");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $BCG = array(0, 0, 0, 0, 0, 0);
        $HBV1 = array(0, 0, 0, 0, 0, 0);
        $HBV2 = array(0, 0, 0, 0, 0, 0);
        $DTPHB1 = array(0, 0, 0, 0, 0, 0);
        $DTPHB2 = array(0, 0, 0, 0, 0, 0);
        $DTPHB3 = array(0, 0, 0, 0, 0, 0);
        $DTP4 = array(0, 0, 0, 0, 0, 0);
        $DTP5 = array(0, 0, 0, 0, 0, 0);
        $MMR1 = array(0, 0, 0, 0, 0, 0);
        $MMR2 = array(0, 0, 0, 0, 0, 0);
        $J11 = array(0, 0, 0, 0, 0, 0);
        $J12 = array(0, 0, 0, 0, 0, 0);
        $OPV1 = array(0, 0, 0, 0, 0, 0);
        $OPV2 = array(0, 0, 0, 0, 0, 0);
        $OPV3 = array(0, 0, 0, 0, 0, 0);
        $OPV4 = array(0, 0, 0, 0, 0, 0);
        $OPV5 = array(0, 0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['HOSCODE'] . ' ' . $rs['HOSNAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["BCG_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["HBV1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["HBV2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTPHB3_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTP4_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTP5_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["MMR1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["MMR2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["J11_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["J12_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPV1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPV2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPV3_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPV4_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPV5_M$i"]), $style);
            }

            for ($i = 1; $i <= 5; $i++) {
                $BCG[$i] = $BCG[$i] + $rs["BCG_M$i"];
                $HBV1[$i] = $HBV1[$i] + $rs["HBV1_M$i"];
                $HBV2[$i] = $HBV2[$i] + $rs["HBV2_M$i"];
                $DTPHB1[$i] = $DTPHB1[$i] + $rs["DTPHB1_M$i"];
                $DTPHB2[$i] = $DTPHB2[$i] + $rs["DTPHB2_M$i"];
                $DTPHB3[$i] = $DTPHB3[$i] + $rs["DTPHB3_M$i"];
                $DTP4[$i] = $DTP4[$i] + $rs["DTP4_M$i"];
                $DTP5[$i] = $DTP5[$i] + $rs["DTP5_M$i"];
                $MMR1[$i] = $MMR1[$i] + $rs["MMR1_M$i"];
                $MMR2[$i] = $MMR2[$i] + $rs["MMR2_M$i"];
                $J11[$i] = $J11[$i] + $rs["J11_M$i"];
                $J12[$i] = $J12[$i] + $rs["J12_M$i"];
                $OPV1[$i] = $OPV1[$i] + $rs["OPV1_M$i"];
                $OPV2[$i] = $OPV2[$i] + $rs["OPV2_M$i"];
                $OPV3[$i] = $OPV3[$i] + $rs["OPV3_M$i"];
                $OPV4[$i] = $OPV4[$i] + $rs["OPV4_M$i"];
                $OPV5[$i] = $OPV5[$i] + $rs["OPV5_M$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            if ($i == 5) {
                $style = "style='background:#F90;color:#FFF; font-weight:bold'";
            } else {
                $style = "";
            }
            $Tables .= $Table->TD(number_format($BCG[$i]), $style);
            $Tables .= $Table->TD(number_format($HBV1[$i]), $style);
            $Tables .= $Table->TD(number_format($HBV2[$i]), $style);
            $Tables .= $Table->TD(number_format($DTPHB1[$i]), $style);
            $Tables .= $Table->TD(number_format($DTPHB2[$i]), $style);
            $Tables .= $Table->TD(number_format($DTPHB3[$i]), $style);
            $Tables .= $Table->TD(number_format($DTP4[$i]), $style);
            $Tables .= $Table->TD(number_format($DTP5[$i]), $style);
            $Tables .= $Table->TD(number_format($MMR1[$i]), $style);
            $Tables .= $Table->TD(number_format($MMR2[$i]), $style);
            $Tables .= $Table->TD(number_format($J11[$i]), $style);
            $Tables .= $Table->TD(number_format($J12[$i]), $style);
            $Tables .= $Table->TD(number_format($OPV1[$i]), $style);
            $Tables .= $Table->TD(number_format($OPV2[$i]), $style);
            $Tables .= $Table->TD(number_format($OPV3[$i]), $style);
            $Tables .= $Table->TD(number_format($OPV4[$i]), $style);
            $Tables .= $Table->TD(number_format($OPV5[$i]), $style);
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_preschoolers");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_vaccine_school_age_child() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Bh_vaccine_school_age_child_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Bh_vaccine_school_age_child_ampur($year, $ampur); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "rowspan='2' ");

        $Tables .= $Table->TH("ไตรมาส 1", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='9' ");
        $Tables .= $Table->TH("ทั้งปี", "colspan='9' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("BCGS");
            $Tables .= $Table->TH("MMRS");
            $Tables .= $Table->TH("DTS1");
            $Tables .= $Table->TH("DTS2");
            $Tables .= $Table->TH("DTS3");
            $Tables .= $Table->TH("DTS4");
            $Tables .= $Table->TH("OPVS1");
            $Tables .= $Table->TH("OPVS2");
            $Tables .= $Table->TH("OPVS3");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $BCGS = array(0, 0, 0, 0, 0, 0);
        $MMRS = array(0, 0, 0, 0, 0, 0);
        $DTS1 = array(0, 0, 0, 0, 0, 0);
        $DTS2 = array(0, 0, 0, 0, 0, 0);
        $DTS3 = array(0, 0, 0, 0, 0, 0);
        $DTS4 = array(0, 0, 0, 0, 0, 0);
        $OPVS1 = array(0, 0, 0, 0, 0, 0);
        $OPVS2 = array(0, 0, 0, 0, 0, 0);
        $OPVS3 = array(0, 0, 0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['HOSCODE'] . ' ' . $rs['HOSNAME']);
            for ($i = 1; $i <= 5; $i++) {
                if ($i == 5) {
                    $style = "style='background:#F90;color:#FFF; font-weight:bold'";
                } else {
                    $style = "";
                }
                $Tables .= $Table->TD(number_format($rs["BCGS_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["MMRS_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTS1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTS2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTS3_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["DTS4_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPVS1_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPVS2_M$i"]), $style);
                $Tables .= $Table->TD(number_format($rs["OPVS3_M$i"]), $style);
            }

            for ($i = 1; $i <= 5; $i++) {
                $BCGS[$i] = $BCGS[$i] + $rs["BCGS_M$i"];
                $MMRS[$i] = $MMRS[$i] + $rs["MMRS_M$i"];
                $DTS1[$i] = $DTS1[$i] + $rs["DTS1_M$i"];
                $DTS2[$i] = $DTS2[$i] + $rs["DTS2_M$i"];
                $DTS3[$i] = $DTS3[$i] + $rs["DTS3_M$i"];
                $DTS4[$i] = $DTS4[$i] + $rs["DTS4_M$i"];
                $OPVS1[$i] = $OPVS1[$i] + $rs["OPVS1_M$i"];
                $OPVS2[$i] = $OPVS2[$i] + $rs["OPVS2_M$i"];
                $OPVS3[$i] = $OPVS3[$i] + $rs["OPVS3_M$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 1; $i <= 5; $i++) {
            if ($i == 5) {
                $style = "style='background:#F90;color:#FFF; font-weight:bold'";
            } else {
                $style = "";
            }
            $Tables .= $Table->TD(number_format($BCGS[$i]), $style);
            $Tables .= $Table->TD(number_format($MMRS[$i]), $style);
            $Tables .= $Table->TD(number_format($DTS1[$i]), $style);
            $Tables .= $Table->TD(number_format($DTS2[$i]), $style);
            $Tables .= $Table->TD(number_format($DTS3[$i]), $style);
            $Tables .= $Table->TD(number_format($DTS4[$i]), $style);
            $Tables .= $Table->TD(number_format($OPVS1[$i]), $style);
            $Tables .= $Table->TD(number_format($OPVS2[$i]), $style);
            $Tables .= $Table->TD(number_format($OPVS3[$i]), $style);
        }
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_vaccine_school_age_child");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionBh_anc12week() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Bh_anc12week_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Bh_anc12week_ampur($year, $ampur); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "");

        $Tables .= $Table->TH("B", "");
        $Tables .= $Table->TH("A", "");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $SUMA = array(0, 0);
        $SUMB = array(0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['HOSCODE'] . ' ' . $rs['HOSNAME']);

            $Tables .= $Table->TD(number_format($rs['B']));
            $Tables .= $Table->TD(number_format($rs['A']));

            //Sum
            $SUMA[0] = $SUMA[0] + $rs['A'];
            $SUMB[0] = $SUMB[0] + $rs['B'];
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        $Tables .= $Table->TD(number_format($SUMB[0]));
        $Tables .= $Table->TD(number_format($SUMA[0]));
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_anc12week");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionBh_anc5() {

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Border_health();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Bh_anc5_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Bh_anc5_ampur($year, $ampur); //Get ชื่อสถานบริการมาแสดง
        }

        //echo $PCU;
        //exit();

        $Table = new Tables();
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();

        $Tables .= $Table->TH($data['location'], "");

        $Tables .= $Table->TH("B", "");
        $Tables .= $Table->TH("A", "");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->EndThead();

        //$Array_period = array("0", "1", "2", "3", "4");

        $SUMA = array(0, 0);
        $SUMB = array(0, 0);

        $Tables .= $Table->StartBody();
        foreach ($PCU as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['HOSCODE'] . ' ' . $rs['HOSNAME']);

            $Tables .= $Table->TD(number_format($rs['B']));
            $Tables .= $Table->TD(number_format($rs['A']));

            //Sum
            $SUMA[0] = $SUMA[0] + $rs['A'];
            $SUMB[0] = $SUMB[0] + $rs['B'];
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();


        $Tables .= $Table->StartFooter();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        $Tables .= $Table->TD(number_format($SUMB[0]));
        $Tables .= $Table->TD(number_format($SUMA[0]));
        $Tables .= $Table->EndFooter();


        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $report->Getdatequery("bh_anc5");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
