<?php

class Report_kpi_qofController extends Controller {

    public function actionNhso_anc12week_qof() {
        $report = new Report_kpi_qof();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->nhso_anc12week_qof_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->nhso_anc12week_qof_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของหญิงมีครรภ์ได้รับการฝากครรภ์ครั้งแรกก่อน 12 สัปดาห์", "id = 'setText-Center' colspan='3'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumArray = array(0, 0, 0);

        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = "0";
            }
            $TakisTable->addCell(number_format($percent, 2));

            $SumArray[0] = $SumArray[0] + $rs['B'];
            $SumArray[1] = $SumArray[1] + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[0]), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[1]), "id = 'setText-Center-fix'");

        if (!empty($SumArray[0])) {
            $SumArray[2] = ($SumArray[1] / $SumArray[0]) * 100;
        } else {
            $SumArray[2] = "0";
        }
        $TakisTable->addCell(number_format($SumArray[2], 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("nhso_anc12week_qof");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionNhso_labor_anc5() {
        $report = new Report_kpi_qof();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->nhso_labor_anc5_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->nhso_labor_anc5_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของหญิงมีครรภ์ได้รับการฝากครรภ์ครบ 5 ครั้งตามเกณฑ์", "id = 'setText-Center' colspan='3'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumArray = array(0, 0, 0);

        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = "0";
            }
            $TakisTable->addCell(number_format($percent, 2));

            $SumArray[0] = $SumArray[0] + $rs['B'];
            $SumArray[1] = $SumArray[1] + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[0]), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[1]), "id = 'setText-Center-fix'");

        if (!empty($SumArray[0])) {
            $SumArray[2] = ($SumArray[1] / $SumArray[0]) * 100;
        } else {
            $SumArray[2] = "0";
        }
        $TakisTable->addCell(number_format($SumArray[2], 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("nhso_labor_anc5_qof");
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionNhso_bweight2500() {
        $report = new Report_kpi_qof();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->nhso_bweight2500_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->nhso_bweight2500_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("น้ำหนักทารกแรกคลอดต่ำกว่า 2500 กรัม", "id = 'setText-Center' colspan='3'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumArray = array(0, 0, 0);

        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = "0";
            }
            $TakisTable->addCell(number_format($percent, 2));

            $SumArray[0] = $SumArray[0] + $rs['B'];
            $SumArray[1] = $SumArray[1] + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[0]), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[1]), "id = 'setText-Center-fix'");

        if (!empty($SumArray[0])) {
            $SumArray[2] = ($SumArray[1] / $SumArray[0]) * 100;
        } else {
            $SumArray[2] = "0";
        }
        $TakisTable->addCell(number_format($SumArray[2], 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("nhso_bweight2500");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionNhso_dtp5() {
        $report = new Report_kpi_qof();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->nhso_dtp5_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->nhso_dtp5_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของเด็กอายุ 5 ปีที่ได้รับวัคซีน DTP5", "id = 'setText-Center' colspan='3'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumArray = array(0, 0, 0);

        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $percent = ($rs['A'] / $rs['B']) * 100;
            } else {
                $percent = "0";
            }
            $TakisTable->addCell(number_format($percent, 2));

            $SumArray[0] = $SumArray[0] + $rs['B'];
            $SumArray[1] = $SumArray[1] + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[0]), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumArray[1]), "id = 'setText-Center-fix'");

        if (!empty($SumArray[0])) {
            $SumArray[2] = ($SumArray[1] / $SumArray[0]) * 100;
        } else {
            $SumArray[2] = "0";
        }
        $TakisTable->addCell(number_format($SumArray[2], 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("nhso_dtp5");
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
