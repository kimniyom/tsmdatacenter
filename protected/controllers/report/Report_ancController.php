<?php

class Report_ancController extends Controller {

    public function actionRpt_anc12week_th() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_anc();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getanc_thai_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getanc_thai_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("ผลงาน", "");
        $takisTable->addHeader("เป้าหมาย", "");

        $result = $PCU;

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['A'], "align='right'");
            $takisTable->addCell($rs['B'], "align='right'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_anc12week_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_anc12week_nonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_anc();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getanc_nonthai_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getanc_nonthai_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("ผลงาน", "");
        $takisTable->addHeader("เป้าหมาย", "");

        $result = $PCU;

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['A'], "align='right'");
            $takisTable->addCell($rs['B'], "align='right'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_anc12week_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_anc5week_th() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_anc();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getanc_5weekthai_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getanc_5weekthai_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("ผลงาน", "");
        $takisTable->addHeader("เป้าหมาย", "");

        $result = $PCU;

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['A'], "align='right'");
            $takisTable->addCell($rs['B'], "align='right'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_anc5_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_anc5week_nonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $report = new Report_anc();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getanc_5weeknonthai_changwat($year); //Get ชื่อสถานบริการมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getanc_5weeknonthai_ampur($ampur, $year); //Get ชื่อสถานบริการมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Left' ");
        $takisTable->addHeader("ผลงาน", "");
        $takisTable->addHeader("เป้าหมาย", "");

        $result = $PCU;

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell($rs['A'], "align='right'");
            $takisTable->addCell($rs['B'], "align='right'");
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_anc5_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
