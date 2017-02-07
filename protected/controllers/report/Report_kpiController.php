<?php

class Report_kpiController extends Controller {

    public function actionKpi_dm_control() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_dm_control_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_dm_control_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละผู้ป่วยเบาหวานที่คุมระดับน้ำตาลในเลือดได้ดี", "id = 'setText-Center' colspan='3'");
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
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_ht_control() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_ht_control_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_ht_control_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละผู้ป่วยความดันโลหิตสูงที่ควบคุมระดับความดันโลหิตได้ดี", "id = 'setText-Center' colspan='3'");
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
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_dm_screen_eye() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_dm_screen_eye_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_dm_screen_eye_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของผู้ป่วยเบาหวาน (ผู้ป่วยเบาหวานได้รับการคัดกรองภาวะแทรกซ้อนทางไต)", "id = 'setText-Center' colspan='7'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("คัดกรอง", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อนผิดปกติ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $SumWorking = 0;
        $SumUnnormal = 0;
        $Percent_screen = 0;
        $Percent_working = 0;
        $Percent = 0;
        $SumPercent_screen = 0;
        $SumPercent_working = 0;
        $SumPercent = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));
            $TakisTable->addCell(number_format($rs['WORKING']));

            if (!empty($rs['A'])) {
                $Percent_working = ($rs['WORKING'] / $rs['A']) * 100;
            } else {
                $Percent_working = "0";
            }

            $TakisTable->addCell(number_format($Percent_working, 2));

            $TakisTable->addCell(number_format($rs['UNNORMAL']));

            if (!empty($rs['A'])) {
                $Percent = ($rs['UNNORMAL'] / $rs['A']) * 100;
            } else {
                $Percent = "0";
            }

            $TakisTable->addCell(number_format($Percent, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $SumWorking = $SumWorking + $rs['WORKING'];
            $SumUnnormal = $SumUnnormal + $rs['UNNORMAL'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }

        if (!empty($SumA)) {
            $SumPercent_working = ($SumA / $SumWorking) * 100;
            $SumPercent = ($SumA / $SumUnnormal) * 100;
        } else {
            $SumPercent_working = "0";
            $SumPercent = "0";
        }
        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumWorking), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent_working, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumUnnormal), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_dm_screen_kidney() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_dm_screen_kidney_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_dm_screen_kidney_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของผู้ป่วยเบาหวาน (ผู้ป่วยเบาหวานได้รับการคัดกรองภาวะแทรกซ้อนทางไต)", "id = 'setText-Center' colspan='7'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("คัดกรอง", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อนผิดปกติ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $SumWorking = 0;
        $SumUnnormal = 0;
        $Percent_screen = 0;
        $Percent_working = 0;
        $Percent = 0;
        $SumPercent_screen = 0;
        $SumPercent_working = 0;
        $SumPercent = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));
            $TakisTable->addCell(number_format($rs['WORKING']));

            if (!empty($rs['A'])) {
                $Percent_working = ($rs['WORKING'] / $rs['A']) * 100;
            } else {
                $Percent_working = "0";
            }

            $TakisTable->addCell(number_format($Percent_working, 2));

            $TakisTable->addCell(number_format($rs['UNNORMAL']));

            if (!empty($rs['A'])) {
                $Percent = ($rs['UNNORMAL'] / $rs['A']) * 100;
            } else {
                $Percent = "0";
            }

            $TakisTable->addCell(number_format($Percent, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $SumWorking = $SumWorking + $rs['WORKING'];
            $SumUnnormal = $SumUnnormal + $rs['UNNORMAL'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }

        if (!empty($SumA)) {
            $SumPercent_working = ($SumA / $SumWorking) * 100;
            $SumPercent = ($SumA / $SumUnnormal) * 100;
        } else {
            $SumPercent_working = "0";
            $SumPercent = "0";
        }
        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumWorking), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent_working, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumUnnormal), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_dm_screen_foot() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_dm_screen_foot_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_dm_screen_foot_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของผู้ป่วยเบาหวาน (ผู้ป่วยเบาหวานได้รับการคัดกรองภาวะแทรกซ้อนทางไต)", "id = 'setText-Center' colspan='7'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("คัดกรอง", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ภาวะแทรกซ้อนผิดปกติ", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $SumWorking = 0;
        $SumUnnormal = 0;
        $Percent_screen = 0;
        $Percent_working = 0;
        $Percent = 0;
        $SumPercent_screen = 0;
        $SumPercent_working = 0;
        $SumPercent = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));
            $TakisTable->addCell(number_format($rs['WORKING']));

            if (!empty($rs['A'])) {
                $Percent_working = ($rs['WORKING'] / $rs['A']) * 100;
            } else {
                $Percent_working = "0";
            }

            $TakisTable->addCell(number_format($Percent_working, 2));

            $TakisTable->addCell(number_format($rs['UNNORMAL']));

            if (!empty($rs['A'])) {
                $Percent = ($rs['UNNORMAL'] / $rs['A']) * 100;
            } else {
                $Percent = "0";
            }

            $TakisTable->addCell(number_format($Percent, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $SumWorking = $SumWorking + $rs['WORKING'];
            $SumUnnormal = $SumUnnormal + $rs['UNNORMAL'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }

        if (!empty($SumA)) {
            $SumPercent_working = ($SumA / $SumWorking) * 100;
            $SumPercent = ($SumA / $SumUnnormal) * 100;
        } else {
            $SumPercent_working = "0";
            $SumPercent = "0";
        }
        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumWorking), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent_working, 2), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumUnnormal), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumPercent, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_ht_kidney() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_ht_kidney_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_ht_kidney_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของผู้ป่วยความดัน (ผู้ป่วยความดันได้รับการคัดกรองภาวะแทรกซ้อนทางไต)", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        //$data['DateUpdate'] = $report->Getdatequery("rpt_chronic_all");
        $data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_anc_12week() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_anc_12week_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_anc_12week_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของหญิงตั้งครรภ์ได้รับการฝากครรภ์ครั้งแรก เมื่ออายุครรภ์ <=12 สัปดาห์", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_anc12week");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_newborncare6mont() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_newborncare6mont_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_newborncare6mont_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของเด็กแรกเกิด-ต่ำกว่า  6  เดือน กินนมแม่อย่างเดียว", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_newborncare6month");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_labor_anc5() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_labor_anc5_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->Kpi_labor_anc5_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละของหญิงตั้งครรภ์ได้รับการฝากครรภ์คุณภาพครบ  5  ครั้งตามเกณฑ์", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_labor_anc5");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_ppcare3() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_ppcare3_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_ppcare3_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("รัอยละของมารดาหลังคลอดได้รับการดูแลครบ  3  ครั้งตามเกณฑ์", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_ppcare3");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionkpi_nutrion18m() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_nutrion18m_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_nutrion18m_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละเด็กอายุ 18 เดือน ได้รับการคัดกรองพัฒนาการทุกคน", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_nutrion18m");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionkpi_nutrion30m() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        if ($ampur == '0') {
            $result = $report->kpi_nutrion30m_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_nutrion30m_ampur($year, $ampur);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("ร้อยละเด็กอายุ 30 เดือน ได้รับการคัดกรองพัฒนาการทุกคน", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_nutrion30m");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

    public function actionKpi_momdeath() {
        $report = new Report_kpi();
        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];
        if ($ampur == '0') {
            $result = $report->kpi_momdeath_changwat($year);
            $pcu = "อำเภอ";
            $h = "อำเภอ";
        } else {
            $result = $report->kpi_momdeath_ampur($year, $ampur,$type);
            $pcu = "สถานบริการ";
            $h = "";
        }

        $TakisTable = new TakisTables();
        $TakisTable->setClass("stripe row-border order-column cell-border");
        $TakisTable->showColumnIndex(false);
        $TakisTable->addHeader($pcu, "id = 'setText-Center' rowspan='2' ");
        $TakisTable->addHeader("อัตราส่วนการตายมารดาไทย", "id = 'setText-Center' colspan='5'");
        $TakisTable->addSpanHeader("เป้าหมาย", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ผลงาน", "id = 'setText-Center'");
        $TakisTable->addSpanHeader("ร้อยละ", "id = 'setText-Center'");

        $SumA = 0;
        $SumB = 0;
        $Percent_screen = 0;
        $SumPercent_screen = 0;
        foreach ($result as $rs):
            $TakisTable->startRow();
            $TakisTable->addCell($rs['CODE'] . ' ' . $h . ' ' . $rs['NAME'], "align='left' id= 'setText-Left' ");
            $TakisTable->addCell(number_format($rs['B']));
            $TakisTable->addCell(number_format($rs['A']));
            if (!empty($rs['B'])) {
                $Percent_screen = ($rs['A'] / $rs['B']) * 100000;
            } else {
                $Percent_screen = "0";
            }
            $TakisTable->addCell(number_format($Percent_screen, 2));

            $SumB = $SumB + $rs['B'];
            $SumA = $SumA + $rs['A'];
            $TakisTable->endRow();
        endforeach;

        $TakisTable->startRow();
        $TakisTable->addCell("รวม", "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumB), "id = 'setText-Center-fix'");
        $TakisTable->addCell(number_format($SumA), "id = 'setText-Center-fix'");

        if (!empty($SumB)) {
            $SumPercent_screen = ($SumA / $SumB) * 100000;
        } else {
            $SumPercent_screen = "0";
        }


        $TakisTable->addCell(number_format($SumPercent_screen, 2), "id = 'setText-Center-fix'");
        $TakisTable->endRow();
        $data['tables'] = $TakisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("kpi_momdeath");
        //$data['DateUpdate'] = "";
        $this->renderPartial("//reports/report_singletable", $data);
    }

}

?>
