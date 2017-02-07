<?php

class Report_bmiController extends Controller {

    public function actionRpt_bw_bh_bmi6_12_th() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $term = $_POST['type'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi6_12_th_changwat($year, $term); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi6_12_th_ampur($ampur, $year, $term); //Get ชื่อตำบลมาแสดง
        }

        $SUM_MAN = 0;
        $SUM_WOWEN = 0;
        $SUM_SUM_KIDALL = 0;
        $SUM_KID_M = 0;
        $SUM_KID_W = 0;
        $SUM_SUM_KID_MW = 0;
        $SUM_HEIGHT_M1 = 0;
        $SUM_HEIGHT_W1 = 0;
        $SUM_SUM_MW1 = 0;
        $SUM_HEIGHT_M2 = 0;
        $SUM_HEIGHT_W2 = 0;
        $SUM_SUM_MW2 = 0;
        $SUM_HEIGHT_M3 = 0;
        $SUM_HEIGHT_W3 = 0;
        $SUM_SUM_MW3 = 0;
        $SUM_FATS_M1 = 0;
        $SUM_FATS_W1 = 0;
        $SUM_SUMFATS_MW1 = 0;
        $SUM_FATS_M2 = 0;
        $SUM_FATS_W2 = 0;
        $SUM_SUMFATS_MW2 = 0;
        $SUM_GROWTH_M = 0;
        $SUM_GROWTH_W = 0;
        $SUM_SUMGROWTH_MW = 0;


        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='3'");
        $tables .= $table->TH("จำนวนนักเรียนทั้งหมดอายุ 6-12", "colspan='3'  rowspan='2' ");
        $tables .= $table->TH("จำนวนนักเรียนที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' rowspan='2' ");
        $tables .= $table->TH("ส่วนสูงตามเกณฑ์อายุ", "colspan='12' ");
        $tables .= $table->TH("น้ำหนักตามเกณฑ์ส่วนสูง", "colspan='8' ");
        $tables .= $table->TH("ส่วนสูงอยู่ในเกณฑ์ดีและรูปร่างสมส่วน", "colspan='4' rowspan='2' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("เตี้ย", "colspan='4' ");
        $tables .= $table->TH("ค่อนข้างเตี้ย", "colspan='4' ");
        $tables .= $table->TH("ส่วนสูงในเกณฑ์ดี(ส่วนสูงตามเกณฑ์+ค่อนข้างสูง+สูง)", "colspan='4' ");
        $tables .= $table->TH("สมส่วน", "colspan='4' ");
        $tables .= $table->TH("เริ่มอ้วน+อ้วน", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P4"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P5"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P6"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["GROWTH_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["GROWTH_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMGROWTH_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P7"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["HEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["HEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUM_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["HEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["HEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUM_MW2"];
            $SUM_HEIGHT_M3 = $SUM_HEIGHT_M3 + $rs["HEIGHT_M3"];
            $SUM_HEIGHT_W3 = $SUM_HEIGHT_W3 + $rs["HEIGHT_W3"];
            $SUM_SUM_MW3 = $SUM_SUM_MW3 + $rs["SUM_MW3"];
            $SUM_FATS_M1 = $SUM_FATS_M1 + $rs["FATS_M1"];
            $SUM_FATS_W1 = $SUM_FATS_W1 + $rs["FATS_W1"];
            $SUM_SUMFATS_MW1 = $SUM_SUMFATS_MW1 + $rs["SUMFATS_MW1"];
            $SUM_FATS_M2 = $SUM_FATS_M2 + $rs["FATS_M2"];
            $SUM_FATS_W2 = $SUM_FATS_W2 + $rs["FATS_W2"];
            $SUM_SUMFATS_MW2 = $SUM_SUMFATS_MW2 + $rs["SUMFATS_MW2"];
            $SUM_GROWTH_M = $SUM_GROWTH_M + $rs["GROWTH_M"];
            $SUM_GROWTH_W = $SUM_GROWTH_W + $rs["GROWTH_W"];
            $SUM_SUMGROWTH_MW = $SUM_SUMGROWTH_MW + $rs["SUMGROWTH_MW"];
            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M3), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W3), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW3), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW3 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_GROWTH_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_GROWTH_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMGROWTH_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMGROWTH_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();
        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi6_12_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_bw_bh_bmi6_12_nonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $term = $_POST['type'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi6_12_nonth_changwat($year, $term); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi6_12_nonth_ampur($ampur, $year, $term); //Get ชื่อตำบลมาแสดง
        }

        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='3'");
        $tables .= $table->TH("จำนวนนักเรียนทั้งหมดอายุ 6-12", "colspan='3'  rowspan='2' ");
        $tables .= $table->TH("จำนวนนักเรียนที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' rowspan='2' ");
        $tables .= $table->TH("ส่วนสูงตามเกณฑ์อายุ", "colspan='12' ");
        $tables .= $table->TH("น้ำหนักตามเกณฑ์ส่วนสูง", "colspan='8' ");
        $tables .= $table->TH("ส่วนสูงอยู่ในเกณฑ์ดีและรูปร่างสมส่วน", "colspan='4' rowspan='2' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("เตี้ย", "colspan='4' ");
        $tables .= $table->TH("ค่อนข้างเตี้ย", "colspan='4' ");
        $tables .= $table->TH("ส่วนสูงในเกณฑ์ดี(ส่วนสูงตามเกณฑ์+ค่อนข้างสูง+สูง)", "colspan='4' ");
        $tables .= $table->TH("สมส่วน", "colspan='4' ");
        $tables .= $table->TH("เริ่มอ้วน+อ้วน", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P4"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P5"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P6"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["GROWTH_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["GROWTH_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMGROWTH_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P7"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["HEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["HEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUM_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["HEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["HEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUM_MW2"];
            $SUM_HEIGHT_M3 = $SUM_HEIGHT_M3 + $rs["HEIGHT_M3"];
            $SUM_HEIGHT_W3 = $SUM_HEIGHT_W3 + $rs["HEIGHT_W3"];
            $SUM_SUM_MW3 = $SUM_SUM_MW3 + $rs["SUM_MW3"];
            $SUM_FATS_M1 = $SUM_FATS_M1 + $rs["FATS_M1"];
            $SUM_FATS_W1 = $SUM_FATS_W1 + $rs["FATS_W1"];
            $SUM_SUMFATS_MW1 = $SUM_SUMFATS_MW1 + $rs["SUMFATS_MW1"];
            $SUM_FATS_M2 = $SUM_FATS_M2 + $rs["FATS_M2"];
            $SUM_FATS_W2 = $SUM_FATS_W2 + $rs["FATS_W2"];
            $SUM_SUMFATS_MW2 = $SUM_SUMFATS_MW2 + $rs["SUMFATS_MW2"];
            $SUM_GROWTH_M = $SUM_GROWTH_M + $rs["GROWTH_M"];
            $SUM_GROWTH_W = $SUM_GROWTH_W + $rs["GROWTH_W"];
            $SUM_SUMGROWTH_MW = $SUM_SUMGROWTH_MW + $rs["SUMGROWTH_MW"];
            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M3), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W3), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW3), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW3 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_GROWTH_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_GROWTH_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMGROWTH_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMGROWTH_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();

        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi6_12_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* ###################### END 6-12 ################### */

    public function actionRpt_bw_bh_bmi13_18_th() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $term = $_POST['type'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi13_18_th_changwat($year, $term); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi13_18_th_ampur($ampur, $year, $term); //Get ชื่อตำบลมาแสดง
        }

        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='3'");
        $tables .= $table->TH("จำนวนนักเรียนทั้งหมดอายุ 6-12", "colspan='3'  rowspan='2' ");
        $tables .= $table->TH("จำนวนนักเรียนที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' rowspan='2' ");
        $tables .= $table->TH("ส่วนสูงตามเกณฑ์อายุ", "colspan='12' ");
        $tables .= $table->TH("น้ำหนักตามเกณฑ์ส่วนสูง", "colspan='8' ");
        $tables .= $table->TH("ส่วนสูงอยู่ในเกณฑ์ดีและรูปร่างสมส่วน", "colspan='4' rowspan='2' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("เตี้ย", "colspan='4' ");
        $tables .= $table->TH("ค่อนข้างเตี้ย", "colspan='4' ");
        $tables .= $table->TH("ส่วนสูงในเกณฑ์ดี(ส่วนสูงตามเกณฑ์+ค่อนข้างสูง+สูง)", "colspan='4' ");
        $tables .= $table->TH("สมส่วน", "colspan='4' ");
        $tables .= $table->TH("เริ่มอ้วน+อ้วน", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P4"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P5"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P6"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["GROWTH_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["GROWTH_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMGROWTH_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P7"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["HEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["HEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUM_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["HEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["HEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUM_MW2"];
            $SUM_HEIGHT_M3 = $SUM_HEIGHT_M3 + $rs["HEIGHT_M3"];
            $SUM_HEIGHT_W3 = $SUM_HEIGHT_W3 + $rs["HEIGHT_W3"];
            $SUM_SUM_MW3 = $SUM_SUM_MW3 + $rs["SUM_MW3"];
            $SUM_FATS_M1 = $SUM_FATS_M1 + $rs["FATS_M1"];
            $SUM_FATS_W1 = $SUM_FATS_W1 + $rs["FATS_W1"];
            $SUM_SUMFATS_MW1 = $SUM_SUMFATS_MW1 + $rs["SUMFATS_MW1"];
            $SUM_FATS_M2 = $SUM_FATS_M2 + $rs["FATS_M2"];
            $SUM_FATS_W2 = $SUM_FATS_W2 + $rs["FATS_W2"];
            $SUM_SUMFATS_MW2 = $SUM_SUMFATS_MW2 + $rs["SUMFATS_MW2"];
            $SUM_GROWTH_M = $SUM_GROWTH_M + $rs["GROWTH_M"];
            $SUM_GROWTH_W = $SUM_GROWTH_W + $rs["GROWTH_W"];
            $SUM_SUMGROWTH_MW = $SUM_SUMGROWTH_MW + $rs["SUMGROWTH_MW"];
            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M3), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W3), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW3), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW3 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_GROWTH_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_GROWTH_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMGROWTH_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMGROWTH_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();
        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi13_18_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_bw_bh_bmi13_18_nonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $term = $_POST['type'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi13_18_nonth_changwat($year, $term); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi13_18_nonth_ampur($ampur, $year, $term); //Get ชื่อตำบลมาแสดง
        }

        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='3'");
        $tables .= $table->TH("จำนวนนักเรียนทั้งหมดอายุ 6-12", "colspan='3'  rowspan='2' ");
        $tables .= $table->TH("จำนวนนักเรียนที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' rowspan='2' ");
        $tables .= $table->TH("ส่วนสูงตามเกณฑ์อายุ", "colspan='12' ");
        $tables .= $table->TH("น้ำหนักตามเกณฑ์ส่วนสูง", "colspan='8' ");
        $tables .= $table->TH("ส่วนสูงอยู่ในเกณฑ์ดีและรูปร่างสมส่วน", "colspan='4' rowspan='2' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("เตี้ย", "colspan='4' ");
        $tables .= $table->TH("ค่อนข้างเตี้ย", "colspan='4' ");
        $tables .= $table->TH("ส่วนสูงในเกณฑ์ดี(ส่วนสูงตามเกณฑ์+ค่อนข้างสูง+สูง)", "colspan='4' ");
        $tables .= $table->TH("สมส่วน", "colspan='4' ");
        $tables .= $table->TH("เริ่มอ้วน+อ้วน", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["HEIGHT_M3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["HEIGHT_W3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_MW3"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P4"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P5"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["FATS_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["FATS_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMFATS_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P6"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["GROWTH_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["GROWTH_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMGROWTH_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P7"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["HEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["HEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUM_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["HEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["HEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUM_MW2"];
            $SUM_HEIGHT_M3 = $SUM_HEIGHT_M3 + $rs["HEIGHT_M3"];
            $SUM_HEIGHT_W3 = $SUM_HEIGHT_W3 + $rs["HEIGHT_W3"];
            $SUM_SUM_MW3 = $SUM_SUM_MW3 + $rs["SUM_MW3"];
            $SUM_FATS_M1 = $SUM_FATS_M1 + $rs["FATS_M1"];
            $SUM_FATS_W1 = $SUM_FATS_W1 + $rs["FATS_W1"];
            $SUM_SUMFATS_MW1 = $SUM_SUMFATS_MW1 + $rs["SUMFATS_MW1"];
            $SUM_FATS_M2 = $SUM_FATS_M2 + $rs["FATS_M2"];
            $SUM_FATS_W2 = $SUM_FATS_W2 + $rs["FATS_W2"];
            $SUM_SUMFATS_MW2 = $SUM_SUMFATS_MW2 + $rs["SUMFATS_MW2"];
            $SUM_GROWTH_M = $SUM_GROWTH_M + $rs["GROWTH_M"];
            $SUM_GROWTH_W = $SUM_GROWTH_W + $rs["GROWTH_W"];
            $SUM_SUMGROWTH_MW = $SUM_SUMGROWTH_MW + $rs["SUMGROWTH_MW"];
            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M3), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W3), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW3), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUM_MW3 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW1), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW1 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_FATS_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_FATS_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMFATS_MW2), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMFATS_MW2 / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_GROWTH_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_GROWTH_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUMGROWTH_MW), "align='right'");
        $tables .= $table->TD(number_format((($SUM_SUMGROWTH_MW / $SUM_SUM_KIDALL) * 100), 2), "align='right' $style");
        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();

        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi13_18_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    //เด็กอายุ 0 - 5 ปี
    public function actionRpt_bw_bh_bmi0_5_th() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $period = $_POST['period'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi0_5_th_changwat($year, $period); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi0_5_th_ampur($ampur, $year, $period); //Get ชื่อตำบลมาแสดง
        }


        $SUM_MAN = 0;
        $SUM_WOWEN = 0;
        $SUM_SUM_KIDALL = 0;
        $SUM_KID_M = 0;
        $SUM_KID_W = 0;
        $SUM_SUM_KID_MW = 0;
        $SUM_HEIGHT_M1 = 0;
        $SUM_HEIGHT_W1 = 0;
        $SUM_SUM_MW1 = 0;
        $SUM_HEIGHT_M2 = 0;
        $SUM_HEIGHT_W2 = 0;
        $SUM_SUM_MW2 = 0;


        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='2'");
        $tables .= $table->TH("จำนวนทั้งหมดอายุ 0-5 ปี", "colspan='3' ");
        $tables .= $table->TH("จำนวนเด็กที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' ");
        $tables .= $table->TH("จำนวนเด็กน้ำหนักน้อยกว่าเกณฑ์", "colspan='4' ");
        $tables .= $table->TH("น้ำหนักปกติ", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");

        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["WEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMWEIGHT_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["WEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMWEIGHT_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["WEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["WEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUMWEIGHT_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["WEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["WEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUMWEIGHT_MW2"];

            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        if ($SUM_SUM_KIDALL != 0) {
            $P1 = (($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100);
            $P2 = (($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100);
            $P3 = (($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100);
        } else {
            $P1 = 0;
            $P2 = 0;
            $P3 = 0;
        }
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format($P1, 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format($P2, 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format($P3, 2), "align='right' $style");

        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();

        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi0_5_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_bw_bh_bmi0_5_nonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $period = $_POST['period'];
        $report = new Report_bmi();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Rpt_bw_bh_bmi0_5_nonth_changwat($year, $period); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Rpt_bw_bh_bmi0_5_nonth_ampur($ampur, $year, $period); //Get ชื่อตำบลมาแสดง
        }

        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='2'");
        $tables .= $table->TH("จำนวนทั้งหมดอายุ 0-5 ปี", "colspan='3' ");
        $tables .= $table->TH("จำนวนเด็กที่ชั่งน้ำหนักและวัดส่วนสูง", "colspan='4' ");
        $tables .= $table->TH("จำนวนเด็กน้ำหนักน้อยกว่าเกณฑ์", "colspan='4' ");
        $tables .= $table->TH("น้ำหนักปกติ", "colspan='4' ");
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");
        $tables .= $table->TH("ชาย", "");
        $tables .= $table->TH("หญิง", "");
        $tables .= $table->TH("รวม", "");
        $tables .= $table->TH("ร้อยละ", "");

        $tables .= $table->EndRow();
        $tables .= $table->EndThead();
        $style = "style='background:orange; color:#FFF;'";
        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TD(number_format($rs["MAN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WOMEN"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KIDALL"]), "align='right' $style");
            $tables .= $table->TD(number_format($rs["KID_M"]), "align='right'");
            $tables .= $table->TD(number_format($rs["KID_W"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUM_KID_MW"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P1"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["WEIGHT_M1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WEIGHT_W1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMWEIGHT_MW1"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P2"], 2), "align='right' $style");
            $tables .= $table->TD(number_format($rs["WEIGHT_M2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["WEIGHT_W2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["SUMWEIGHT_MW2"]), "align='right'");
            $tables .= $table->TD(number_format($rs["P3"], 2), "align='right' $style");

            //ผลรวม
            $SUM_MAN = $SUM_MAN + $rs["MAN"];
            $SUM_WOWEN = $SUM_WOWEN + $rs["WOMEN"];
            $SUM_SUM_KIDALL = $SUM_SUM_KIDALL + $rs["SUM_KIDALL"];
            $SUM_KID_M = $SUM_KID_M + $rs["KID_M"];
            $SUM_KID_W = $SUM_KID_W + $rs["KID_W"];
            $SUM_SUM_KID_MW = $SUM_SUM_KID_MW + $rs["SUM_KID_MW"];
            $SUM_HEIGHT_M1 = $SUM_HEIGHT_M1 + $rs["WEIGHT_M1"];
            $SUM_HEIGHT_W1 = $SUM_HEIGHT_W1 + $rs["WEIGHT_W1"];
            $SUM_SUM_MW1 = $SUM_SUM_MW1 + $rs["SUMWEIGHT_MW1"];
            $SUM_HEIGHT_M2 = $SUM_HEIGHT_M2 + $rs["WEIGHT_M2"];
            $SUM_HEIGHT_W2 = $SUM_HEIGHT_W2 + $rs["WEIGHT_W2"];
            $SUM_SUM_MW2 = $SUM_SUM_MW2 + $rs["SUMWEIGHT_MW2"];

            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->StartFooter();
        $tables .= $table->StartRow("");
        if ($SUM_SUM_KIDALL != 0) {
            $P1 = (($SUM_SUM_KID_MW / $SUM_SUM_KIDALL) * 100);
            $P2 = (($SUM_SUM_MW1 / $SUM_SUM_KIDALL) * 100);
            $P3 = (($SUM_SUM_MW2 / $SUM_SUM_KIDALL) * 100);
        } else {
            $P1 = 0;
            $P2 = 0;
            $P3 = 0;
        }
        $tables .= $table->TH("รวม", "align='center' id= 'setText-Left' ");
        $tables .= $table->TD(number_format($SUM_MAN), "align='right'");
        $tables .= $table->TD(number_format($SUM_WOWEN), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KIDALL), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_KID_M), "align='right'");
        $tables .= $table->TD(number_format($SUM_KID_W), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_KID_MW), "align='right'");
        $tables .= $table->TD(number_format($P1, 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M1), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W1), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW1), "align='right'");
        $tables .= $table->TD(number_format($P2, 2), "align='right' $style");
        $tables .= $table->TD(number_format($SUM_HEIGHT_M2), "align='right'");
        $tables .= $table->TD(number_format($SUM_HEIGHT_W2), "align='right'");
        $tables .= $table->TD(number_format($SUM_SUM_MW2), "align='right'");
        $tables .= $table->TD(number_format($P3, 2), "align='right' $style");

        $tables .= $table->EndFooter();
        $tables .= $table->EndTable();

        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_bw_bh_bmi0_5_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
