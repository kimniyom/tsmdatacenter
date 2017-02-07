<?php

class Report_laborController extends Controller {

    public function actionRpt_labor() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfull();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_changwat($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "ตำบล";
            $PCU = $report->Getlabor_ampur($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "colspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("ไทย");
            $takisTable->addSpanHeader("ต่างชาติ");
        endfor;

        $takisTable->addSpanHeader("ไทย");
        $takisTable->addSpanHeader("ต่างชาติ");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['THAI01'], "align='right'");
            $takisTable->addCell($rs['NOTHAI01'], "align='right'");
            $takisTable->addCell($rs['THAI02'], "align='right'");
            $takisTable->addCell($rs['NOTHAI02'], "align='right'");
            $takisTable->addCell($rs['THAI03'], "align='right'");
            $takisTable->addCell($rs['NOTHAI03'], "align='right'");
            $takisTable->addCell($rs['THAI04'], "align='right'");
            $takisTable->addCell($rs['NOTHAI04'], "align='right'");
            $takisTable->addCell($rs['THAI05'], "align='right'");
            $takisTable->addCell($rs['NOTHAI05'], "align='right'");
            $takisTable->addCell($rs['THAI06'], "align='right'");
            $takisTable->addCell($rs['NOTHAI06'], "align='right'");
            $takisTable->addCell($rs['THAI07'], "align='right'");
            $takisTable->addCell($rs['NOTHAI07'], "align='right'");
            $takisTable->addCell($rs['THAI08'], "align='right'");
            $takisTable->addCell($rs['NOTHAI08'], "align='right'");
            $takisTable->addCell($rs['THAI09'], "align='right'");
            $takisTable->addCell($rs['NOTHAI09'], "align='right'");
            $takisTable->addCell($rs['THAI10'], "align='right'");
            $takisTable->addCell($rs['NOTHAI10'], "align='right'");
            $takisTable->addCell($rs['THAI11'], "align='right'");
            $takisTable->addCell($rs['NOTHAI11'], "align='right'");
            $takisTable->addCell($rs['THAI12'], "align='right'");
            $takisTable->addCell($rs['NOTHAI12'], "align='right'");

            $sum[0] = $rs['THAI01'] + $rs['THAI02'] + $rs['THAI03'] + $rs['THAI04'] + $rs['THAI05'] + $rs['THAI06'] + $rs['THAI07'] + $rs['THAI08'] + $rs['THAI09'] + $rs['THAI10'] + $rs['THAI11'] + $rs['THAI12'];
            $sum[1] = $rs['NOTHAI01'] + $rs['NOTHAI02'] + $rs['NOTHAI03'] + $rs['NOTHAI04'] + $rs['NOTHAI05'] + $rs['NOTHAI06'] + $rs['NOTHAI07'] + $rs['NOTHAI08'] + $rs['NOTHAI09'] + $rs['NOTHAI10'] + $rs['NOTHAI11'] + $rs['NOTHAI12'];
            $takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_labor_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* Labor 15-19 */

    public function actionRpt_labor15_19() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];

        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfull();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_changwat15_19($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "ตำบล";
            $PCU = $report->Getlabor_ampur15_19($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "colspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("ไทย");
            $takisTable->addSpanHeader("ต่างชาติ");
        endfor;

        $takisTable->addSpanHeader("ไทย");
        $takisTable->addSpanHeader("ต่างชาติ");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['THAI01'], "align='right'");
            $takisTable->addCell($rs['NOTHAI01'], "align='right'");
            $takisTable->addCell($rs['THAI02'], "align='right'");
            $takisTable->addCell($rs['NOTHAI02'], "align='right'");
            $takisTable->addCell($rs['THAI03'], "align='right'");
            $takisTable->addCell($rs['NOTHAI03'], "align='right'");
            $takisTable->addCell($rs['THAI04'], "align='right'");
            $takisTable->addCell($rs['NOTHAI04'], "align='right'");
            $takisTable->addCell($rs['THAI05'], "align='right'");
            $takisTable->addCell($rs['NOTHAI05'], "align='right'");
            $takisTable->addCell($rs['THAI06'], "align='right'");
            $takisTable->addCell($rs['NOTHAI06'], "align='right'");
            $takisTable->addCell($rs['THAI07'], "align='right'");
            $takisTable->addCell($rs['NOTHAI07'], "align='right'");
            $takisTable->addCell($rs['THAI08'], "align='right'");
            $takisTable->addCell($rs['NOTHAI08'], "align='right'");
            $takisTable->addCell($rs['THAI09'], "align='right'");
            $takisTable->addCell($rs['NOTHAI09'], "align='right'");
            $takisTable->addCell($rs['THAI10'], "align='right'");
            $takisTable->addCell($rs['NOTHAI10'], "align='right'");
            $takisTable->addCell($rs['THAI11'], "align='right'");
            $takisTable->addCell($rs['NOTHAI11'], "align='right'");
            $takisTable->addCell($rs['THAI12'], "align='right'");
            $takisTable->addCell($rs['NOTHAI12'], "align='right'");

            $sum[0] = $rs['THAI01'] + $rs['THAI02'] + $rs['THAI03'] + $rs['THAI04'] + $rs['THAI05'] + $rs['THAI06'] + $rs['THAI07'] + $rs['THAI08'] + $rs['THAI09'] + $rs['THAI10'] + $rs['THAI11'] + $rs['THAI12'];
            $sum[1] = $rs['NOTHAI01'] + $rs['NOTHAI02'] + $rs['NOTHAI03'] + $rs['NOTHAI04'] + $rs['NOTHAI05'] + $rs['NOTHAI06'] + $rs['NOTHAI07'] + $rs['NOTHAI08'] + $rs['NOTHAI09'] + $rs['NOTHAI10'] + $rs['NOTHAI11'] + $rs['NOTHAI12'];
            $takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_labor15_19th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* จำนวนมารดาตาย */

    public function actionRpt_momdeath() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];

        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfull();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_changwat_momdeath($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "ตำบล";
            $PCU = $report->Getlabor_ampur_momdeath($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "colspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("ไทย");
            $takisTable->addSpanHeader("ต่างชาติ");
        endfor;

        $takisTable->addSpanHeader("ไทย");
        $takisTable->addSpanHeader("ต่างชาติ");

        //echo $PCU;
        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['THAI01'], "align='right'");
            $takisTable->addCell($rs['NOTHAI01'], "align='right'");
            $takisTable->addCell($rs['THAI02'], "align='right'");
            $takisTable->addCell($rs['NOTHAI02'], "align='right'");
            $takisTable->addCell($rs['THAI03'], "align='right'");
            $takisTable->addCell($rs['NOTHAI03'], "align='right'");
            $takisTable->addCell($rs['THAI04'], "align='right'");
            $takisTable->addCell($rs['NOTHAI04'], "align='right'");
            $takisTable->addCell($rs['THAI05'], "align='right'");
            $takisTable->addCell($rs['NOTHAI05'], "align='right'");
            $takisTable->addCell($rs['THAI06'], "align='right'");
            $takisTable->addCell($rs['NOTHAI06'], "align='right'");
            $takisTable->addCell($rs['THAI07'], "align='right'");
            $takisTable->addCell($rs['NOTHAI07'], "align='right'");
            $takisTable->addCell($rs['THAI08'], "align='right'");
            $takisTable->addCell($rs['NOTHAI08'], "align='right'");
            $takisTable->addCell($rs['THAI09'], "align='right'");
            $takisTable->addCell($rs['NOTHAI09'], "align='right'");
            $takisTable->addCell($rs['THAI10'], "align='right'");
            $takisTable->addCell($rs['NOTHAI10'], "align='right'");
            $takisTable->addCell($rs['THAI11'], "align='right'");
            $takisTable->addCell($rs['NOTHAI11'], "align='right'");
            $takisTable->addCell($rs['THAI12'], "align='right'");
            $takisTable->addCell($rs['NOTHAI12'], "align='right'");

            $sum[0] = $rs['THAI01'] + $rs['THAI02'] + $rs['THAI03'] + $rs['THAI04'] + $rs['THAI05'] + $rs['THAI06'] + $rs['THAI07'] + $rs['THAI08'] + $rs['THAI09'] + $rs['THAI10'] + $rs['THAI11'] + $rs['THAI12'];
            $sum[1] = $rs['NOTHAI01'] + $rs['NOTHAI02'] + $rs['NOTHAI03'] + $rs['NOTHAI04'] + $rs['NOTHAI05'] + $rs['NOTHAI06'] + $rs['NOTHAI07'] + $rs['NOTHAI08'] + $rs['NOTHAI09'] + $rs['NOTHAI10'] + $rs['NOTHAI11'] + $rs['NOTHAI12'];
            $takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_momdeath");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* จำนวนมารดาตาย */

    public function actionRpt_nutrion0_5() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];

        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfull();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_changwat_rpt_nutrion0_5($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getlabor_ampur_rpt_nutrion0_5($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "colspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("ไทย");
            $takisTable->addSpanHeader("ต่างชาติ");
        endfor;

        $takisTable->addSpanHeader("ไทย");
        $takisTable->addSpanHeader("ต่างชาติ");

        //echo $PCU;
        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['THAI01'], "align='right'");
            $takisTable->addCell($rs['NOTHAI01'], "align='right'");
            $takisTable->addCell($rs['THAI02'], "align='right'");
            $takisTable->addCell($rs['NOTHAI02'], "align='right'");
            $takisTable->addCell($rs['THAI03'], "align='right'");
            $takisTable->addCell($rs['NOTHAI03'], "align='right'");
            $takisTable->addCell($rs['THAI04'], "align='right'");
            $takisTable->addCell($rs['NOTHAI04'], "align='right'");
            $takisTable->addCell($rs['THAI05'], "align='right'");
            $takisTable->addCell($rs['NOTHAI05'], "align='right'");
            $takisTable->addCell($rs['THAI06'], "align='right'");
            $takisTable->addCell($rs['NOTHAI06'], "align='right'");
            $takisTable->addCell($rs['THAI07'], "align='right'");
            $takisTable->addCell($rs['NOTHAI07'], "align='right'");
            $takisTable->addCell($rs['THAI08'], "align='right'");
            $takisTable->addCell($rs['NOTHAI08'], "align='right'");
            $takisTable->addCell($rs['THAI09'], "align='right'");
            $takisTable->addCell($rs['NOTHAI09'], "align='right'");
            $takisTable->addCell($rs['THAI10'], "align='right'");
            $takisTable->addCell($rs['NOTHAI10'], "align='right'");
            $takisTable->addCell($rs['THAI11'], "align='right'");
            $takisTable->addCell($rs['NOTHAI11'], "align='right'");
            $takisTable->addCell($rs['THAI12'], "align='right'");
            $takisTable->addCell($rs['NOTHAI12'], "align='right'");

            $sum[0] = $rs['THAI01'] + $rs['THAI02'] + $rs['THAI03'] + $rs['THAI04'] + $rs['THAI05'] + $rs['THAI06'] + $rs['THAI07'] + $rs['THAI08'] + $rs['THAI09'] + $rs['THAI10'] + $rs['THAI11'] + $rs['THAI12'];
            $sum[1] = $rs['NOTHAI01'] + $rs['NOTHAI02'] + $rs['NOTHAI03'] + $rs['NOTHAI04'] + $rs['NOTHAI05'] + $rs['NOTHAI06'] + $rs['NOTHAI07'] + $rs['NOTHAI08'] + $rs['NOTHAI09'] + $rs['NOTHAI10'] + $rs['NOTHAI11'] + $rs['NOTHAI12'];
            $takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_momdeath");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* จำนวนทารกแรกเกิดที่มีน้ำหนักน้อยกว่า 2500 กรัม (แยกไทย/ต่างชาติ) */

    public function actionRpt_newbon2500() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfullperiod();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_newbon2500_changwat($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "ตำบล";
            $PCU = $report->Getlabor_newbon2500_ampur($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "colspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("ไทย");
            $takisTable->addSpanHeader("ต่างชาติ");
        endfor;

        $takisTable->addSpanHeader("ไทย");
        $takisTable->addSpanHeader("ต่างชาติ");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['THAI10'], "align='right'");
            $takisTable->addCell($rs['NOTHAI10'], "align='right'");
            $takisTable->addCell($rs['THAI11'], "align='right'");
            $takisTable->addCell($rs['NOTHAI11'], "align='right'");
            $takisTable->addCell($rs['THAI12'], "align='right'");
            $takisTable->addCell($rs['NOTHAI12'], "align='right'");
            $takisTable->addCell($rs['THAI01'], "align='right'");
            $takisTable->addCell($rs['NOTHAI01'], "align='right'");
            $takisTable->addCell($rs['THAI02'], "align='right'");
            $takisTable->addCell($rs['NOTHAI02'], "align='right'");
            $takisTable->addCell($rs['THAI03'], "align='right'");
            $takisTable->addCell($rs['NOTHAI03'], "align='right'");
            $takisTable->addCell($rs['THAI04'], "align='right'");
            $takisTable->addCell($rs['NOTHAI04'], "align='right'");
            $takisTable->addCell($rs['THAI05'], "align='right'");
            $takisTable->addCell($rs['NOTHAI05'], "align='right'");
            $takisTable->addCell($rs['THAI06'], "align='right'");
            $takisTable->addCell($rs['NOTHAI06'], "align='right'");
            $takisTable->addCell($rs['THAI07'], "align='right'");
            $takisTable->addCell($rs['NOTHAI07'], "align='right'");
            $takisTable->addCell($rs['THAI08'], "align='right'");
            $takisTable->addCell($rs['NOTHAI08'], "align='right'");
            $takisTable->addCell($rs['THAI09'], "align='right'");
            $takisTable->addCell($rs['NOTHAI09'], "align='right'");

            $sum[0] = $rs['THAI01'] + $rs['THAI02'] + $rs['THAI03'] + $rs['THAI04'] + $rs['THAI05'] + $rs['THAI06'] + $rs['THAI07'] + $rs['THAI08'] + $rs['THAI09'] + $rs['THAI10'] + $rs['THAI11'] + $rs['THAI12'];
            $sum[1] = $rs['NOTHAI01'] + $rs['NOTHAI02'] + $rs['NOTHAI03'] + $rs['NOTHAI04'] + $rs['NOTHAI05'] + $rs['NOTHAI06'] + $rs['NOTHAI07'] + $rs['NOTHAI08'] + $rs['NOTHAI09'] + $rs['NOTHAI10'] + $rs['NOTHAI11'] + $rs['NOTHAI12'];
            $takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_newborn2500_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    /* จำนวนทารกตาย 7 วัน,28 วัน ,1 ปี , 5 ปี(แยกไทย/ต่างชาติ) */

    public function actionRpt_child_death() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_labor();
        $lib = new Lib_report();

        $month = $lib->monthfull();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getlabor_child_death_changwat($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "ตำบล";
            $PCU = $report->Getlabor_child_death_ampur($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $result = $PCU;
        //$takisTable = new TakisTables();
        $table = new Tables();
        $tables = $table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $tables .= $table->StartThead("id = 'setText-Center' rowspan='3'");
        $tables .= $table->StartRow("");
        $tables .= $table->TH($data['location'], "id = 'setText-Center' rowspan='3'");
        $tables .= $table->TH("รวม", "colspan='8' ");
        for ($i = 0; $i <= 11; $i++) {
            $tables .= $table->TH($month[$i], "colspan='8' ");
        }
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("รวม 7 วัน", "colspan='2' ");
        $tables .= $table->TH("รวม 28 วัน", "colspan='2' ");
        $tables .= $table->TH("รวม 1 ปี", "colspan='2' ");
        $tables .= $table->TH("รวม 5 ปี", "colspan='2' ");
        for ($i = 0; $i <= 11; $i++) {
            $tables .= $table->TH("7 วัน", "colspan='2' ");
            $tables .= $table->TH("28 วัน", "colspan='2' ");
            $tables .= $table->TH("1 ปี", "colspan='2' ");
            $tables .= $table->TH("5 ปี", "colspan='2' ");
        }
        $tables .= $table->EndRow();

        $tables .= $table->StartRow("");
        $tables .= $table->TH("ไทย", "");
        $tables .= $table->TH("ต่างชาติ", "");
        $tables .= $table->TH("ไทย", "");
        $tables .= $table->TH("ต่างชาติ", "");
        $tables .= $table->TH("ไทย", "");
        $tables .= $table->TH("ต่างชาติ", "");
        $tables .= $table->TH("ไทย", "");
        $tables .= $table->TH("ต่างชาติ", "");
        for ($i = 0; $i <= 11; $i++) {
            $tables .= $table->TH("ไทย", "");
            $tables .= $table->TH("ต่างชาติ", "");
            $tables .= $table->TH("ไทย", "");
            $tables .= $table->TH("ต่างชาติ", "");
            $tables .= $table->TH("ไทย", "");
            $tables .= $table->TH("ต่างชาติ", "");
            $tables .= $table->TH("ไทย", "");
            $tables .= $table->TH("ต่างชาติ", "");
        }
        $tables .= $table->EndRow();
        $tables .= $table->EndThead();

        $tables .= $table->StartBody("");
        foreach ($result as $rs):
            $tables .= $table->StartRow("");
            $tables .= $table->TH($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $tables .= $table->TH($rs["THAI7DAY"], "align='right'");
            $tables .= $table->TH($rs["NOTHAI7DAY"], "align='right'");
            $tables .= $table->TH($rs["THAI28DAY"], "align='right'");
            $tables .= $table->TH($rs["NOTHAI28DAY"], "align='right'");
            $tables .= $table->TH($rs["THAI1YEAR"], "align='right'");
            $tables .= $table->TH($rs["NOTHAI1YEAR"], "align='right'");
            $tables .= $table->TH($rs["THAI5YEAR"], "align='right'");
            $tables .= $table->TH($rs["NOTHAI5YEAR"], "align='right'");
            for ($j = 1; $j <= 12; $j++) {
                if (strlen($j) == 2) {
                    $m = $j;
                } else {
                    $m = "0" . $j;
                }
                $tables .= $table->TD($rs["THAI7DAY_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["NOTHAI7DAY_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["THAI28DAY_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["NOTHAI28DAY_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["THAI1YEAR_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["NOTHAI1YEAR_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["THAI5YEAR_MONTH$m"], "align='right'");
                $tables .= $table->TD($rs["NOTHAI5YEAR_MONTH$m"], "align='right'");
            }
            $tables .= $table->EndRow();
        endforeach;
        $tables .= $table->EndBody();
        $tables .= $table->EndTable();
        //$takisTable->setClass("stripe row-border order-column cell-border");
        //$takisTable->showColumnIndex(false);
        //$takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='3' ");
        //$takisTable->addHeader("รวม", "colspan='8' ");
        /*
          $takisTable->addSpanHeader("รวม 7 วัน","colspan='2' ");
          $takisTable->addSpanHeader("รวม 28 วัน","colspan='2' ");
          $takisTable->addSpanHeader("รวม 1 ปี","colspan='2' ");
          $takisTable->addSpanHeader("รวม 5 ปี","colspan='2' ");

          $takisTable->addSpanHeader("ไทย");
          $takisTable->addSpanHeader("ต่างชาติ");
          $takisTable->addSpanHeader("ไทย");
          $takisTable->addSpanHeader("ต่างชาติ");
          $takisTable->addSpanHeader("ไทย");
          $takisTable->addSpanHeader("ต่างชาติ");
          $takisTable->addSpanHeader("ไทย");
          $takisTable->addSpanHeader("ต่างชาติ");
         */
        /*
          for ($i = 0; $i <= 11; $i++):
          $takisTable->addHeader($month[$i], "colspan='8' ");
          endfor;

          for ($i = 0; $i <= 11; $i++):
          $takisTable->startRow();
          $takisTable->addSpanHeader("7 วัน","colspan='2' ");
          $takisTable->addSpanHeader("28 วัน","colspan='2' ");
          $takisTable->addSpanHeader("1 ปี","colspan='2' ");
          $takisTable->addSpanHeader("5 ปี","colspan='2' ");
          $takisTable->endRow();
          endfor;

          for ($i = 0; $i <= 11; $i++):
          $takisTable->addSpanHeader("ไทย");
          $takisTable->addSpanHeader("ต่างชาติ");
          endfor;


          $result = $PCU;
          $sum = array("", "");
          foreach ($result as $rs):
          $takisTable->startRow();
          $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");
          $takisTable->addCell(0, "align='right'");

          for($j=1;$j<=12;$j++){
          if (strlen($j) > 1) {
          $m = $j;
          } else {
          $m = "0" . $j;
          }
          $takisTable->addCell($rs["THAI7DAY_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["NOTHAI7DAY_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["THA28DAY_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["NOTHA28DAY_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["THAI1YEAR_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["NOTHAI1YEAR_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["THAI5YEAR_MONTH$j"], "align='right'");
          $takisTable->addCell($rs["NOTHAI5YEAR_MONTH$j"], "align='right'");
          }

          $takisTable->endRow();
          endforeach;

          $data['tables'] = $takisTable->render();
         * */
        $data['tables'] = $tables;
        $data['DateUpdate'] = $report->Getdatequery("rpt_child_death");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
