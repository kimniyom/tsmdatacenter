<?php

class Report_diseaseController extends Controller {

    public function actionRpt_diag21_th() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag21_ampur_th($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag21_ampur_th($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag21_ampur_th($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag21_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_diag21_nonth() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag21_nonth($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag21_nonth($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag21_nonth($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag21_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_diag75_th() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag75_th($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag75_th($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag75_th($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag75_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_diag75_nonth() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag75_nonth($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag75_nonth($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag75_nonth($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag75_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_diag19_th() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag19_th($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag19_th($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag19_th($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag19_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_diag19_nonth() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_diag19_nonth($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_diag19_nonth($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_diag19_nonth($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_diag19_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_death103_th() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_death103_th($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_death103_th($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_death103_th($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_death103_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionRpt_death103_nonth() {
        $ampur = $_POST['distId'];
        $pcu = $_POST['pcu'];
        $year = $_POST['year'];

        $report = new Report_disease();

        if ($ampur == '0') {
            $result = $report->Rpt_death103_nonth($year, "");
        } else if ($ampur != '0' && $pcu == '0') {
            $where = " AND r.`AMPUR` = '$ampur' ";
            $result = $report->Rpt_death103_nonth($year, $where);
        } else if ($pcu != '0') {
            $where = " AND r.`HOSPCODE` = '$pcu' ";
            $result = $report->Rpt_death103_nonth($year, $where);
        }

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {  

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader("กลุ่มโรค", "id = 'setText-Center' rowspan='2' ");
        $takisTable->addHeader("ปีงบประมาณ " . ($year + 543), "id = 'setText-Center' colspan='5' ");
        $takisTable->addSpanHeader("ไตรมาศ 1");
        $takisTable->addSpanHeader("ไตรมาศ 2");
        $takisTable->addSpanHeader("ไตรมาศ 3");
        $takisTable->addSpanHeader("ไตรมาศ 4");
        $takisTable->addSpanHeader("รวมทั้งปี");

        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['groupname'], "align='left' id= 'setText-Left' ");
            $takisTable->addCell(number_format($rs['PERIOD1']));
            $takisTable->addCell(number_format($rs['PERIOD2']));
            $takisTable->addCell(number_format($rs['PERIOD3']));
            $takisTable->addCell(number_format($rs['PERIOD4']));
            $takisTable->addCell(number_format($rs['AMOUNT']));
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_death103_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
