<?php

class Report_epiController extends Controller {

    public function actionEpi_1age() {
        $LIP = new Lib_report();
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='13' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("BCG", "colspan='2' ");
            $Tables .= $Table->TH("HBV1", "colspan='2' ");
            $Tables .= $Table->TH("DTP-HB3", "colspan='2' ");
            $Tables .= $Table->TH("OPV3", "colspan='2' ");
            $Tables .= $Table->TH("MMR", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 30; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        $Array_period = array("0", "1", "2", "3", "4");

        $SUM_B = array(0, 0, 0, 0);
        $SUM_BCG = array(0, 0, 0, 0);
        $SUM_HBV1 = array(0, 0, 0, 0);
        $SUM_DTPHB3 = array(0, 0, 0, 0);
        $SUM_OPV3 = array(0, 0, 0, 0);
        $SUM_MMR1 = array(0, 0, 0, 0);
        $SUM_COMPLETE = array(0, 0, 0, 0);

        $PERSENT_BCG = array(0, 0, 0, 0);
        $PERSENT_HBV1 = array(0, 0, 0, 0);
        $PERSENT_DTPHB3 = array(0, 0, 0, 0);
        $PERSENT_OPV3 = array(0, 0, 0, 0);
        $PERSENT_MMR1 = array(0, 0, 0, 0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0);

        $SUMPERSENT_BCG = array(0, 0, 0, 0);
        $SUMPERSENT_HBV1 = array(0, 0, 0, 0);
        $SUMPERSENT_DTPHB3 = array(0, 0, 0, 0);
        $SUMPERSENT_OPV3 = array(0, 0, 0, 0);
        $SUMPERSENT_MMR1 = array(0, 0, 0, 0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {

                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_BCG[$i] = ($rs["BCG_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_HBV1[$i] = ($rs["HBV1_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_DTPHB3[$i] = ($rs["DTPHB3_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV3[$i] = ($rs["OPV3_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_MMR1[$i] = ($rs["MMR1_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_BCG[$i] = 0;
                    $PERSENT_HBV1[$i] = 0;
                    $PERSENT_DTPHB3[$i] = 0;
                    $PERSENT_OPV3[$i] = 0;
                    $PERSENT_MMR1[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["BCG_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_BCG[$i], 2));
                $Tables .= $Table->TD(number_format($rs["HBV1_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_HBV1[$i], 2));
                $Tables .= $Table->TD(number_format($rs["DTPHB3_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTPHB3[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV3_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV3[$i], 2));
                $Tables .= $Table->TD(number_format($rs["MMR1_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_MMR1[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_BCG[$i] = $SUM_BCG[$i] + $rs["BCG_$i"];
                $SUM_HBV1[$i] = $SUM_HBV1[$i] + $rs["HBV1_$i"];
                $SUM_DTPHB3[$i] = $SUM_DTPHB3[$i] + $rs["DTPHB3_$i"];
                $SUM_OPV3[$i] = $SUM_OPV3[$i] + $rs["OPV3_$i"];
                $SUM_MMR1[$i] = $SUM_MMR1[$i] + $rs["MMR1_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_BCG[$i] = ($SUM_BCG[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_HBV1[$i] = ($SUM_HBV1[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_DTPHB3[$i] = ($SUM_DTPHB3[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV3[$i] = ($SUM_OPV3[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_MMR1[$i] = ($SUM_MMR1[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_BCG[$i] = 0;
                $SUMPERSENT_HBV1[$i] = 0;
                $SUMPERSENT_DTPHB3[$i] = 0;
                $SUMPERSENT_OPV3[$i] = 0;
                $SUMPERSENT_MMR1[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TD(number_format($SUM_B[$i]), "style='background:#F90;color:#FFF; font-weight:bold'");
            $Tables .= $Table->TD(number_format($SUM_BCG[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_BCG[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_HBV1[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_HBV1[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_DTPHB3[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_DTPHB3[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_OPV3[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_OPV3[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_MMR1[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_MMR1[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_COMPLETE[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_COMPLETE[$i], 2));
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndFooter();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_1y");
        $this->renderPartial("//Reports/report_singletable", $data);
    }
    
    public function actionEpi_1age_nonth() {
        $LIP = new Lib_report();
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epin_tambon_nonth($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_nonth($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_nonth($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='13' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='13' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("BCG", "colspan='2' ");
            $Tables .= $Table->TH("HBV1", "colspan='2' ");
            $Tables .= $Table->TH("DTP-HB3", "colspan='2' ");
            $Tables .= $Table->TH("OPV3", "colspan='2' ");
            $Tables .= $Table->TH("MMR", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 30; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        $Array_period = array("0", "1", "2", "3", "4");

        $SUM_B = array(0, 0, 0, 0);
        $SUM_BCG = array(0, 0, 0, 0);
        $SUM_HBV1 = array(0, 0, 0, 0);
        $SUM_DTPHB3 = array(0, 0, 0, 0);
        $SUM_OPV3 = array(0, 0, 0, 0);
        $SUM_MMR1 = array(0, 0, 0, 0);
        $SUM_COMPLETE = array(0, 0, 0, 0);

        $PERSENT_BCG = array(0, 0, 0, 0);
        $PERSENT_HBV1 = array(0, 0, 0, 0);
        $PERSENT_DTPHB3 = array(0, 0, 0, 0);
        $PERSENT_OPV3 = array(0, 0, 0, 0);
        $PERSENT_MMR1 = array(0, 0, 0, 0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0);

        $SUMPERSENT_BCG = array(0, 0, 0, 0);
        $SUMPERSENT_HBV1 = array(0, 0, 0, 0);
        $SUMPERSENT_DTPHB3 = array(0, 0, 0, 0);
        $SUMPERSENT_OPV3 = array(0, 0, 0, 0);
        $SUMPERSENT_MMR1 = array(0, 0, 0, 0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {

                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_BCG[$i] = ($rs["BCG_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_HBV1[$i] = ($rs["HBV1_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_DTPHB3[$i] = ($rs["DTPHB3_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV3[$i] = ($rs["OPV3_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_MMR1[$i] = ($rs["MMR1_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_BCG[$i] = 0;
                    $PERSENT_HBV1[$i] = 0;
                    $PERSENT_DTPHB3[$i] = 0;
                    $PERSENT_OPV3[$i] = 0;
                    $PERSENT_MMR1[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["BCG_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_BCG[$i], 2));
                $Tables .= $Table->TD(number_format($rs["HBV1_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_HBV1[$i], 2));
                $Tables .= $Table->TD(number_format($rs["DTPHB3_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTPHB3[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV3_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV3[$i], 2));
                $Tables .= $Table->TD(number_format($rs["MMR1_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_MMR1[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_BCG[$i] = $SUM_BCG[$i] + $rs["BCG_$i"];
                $SUM_HBV1[$i] = $SUM_HBV1[$i] + $rs["HBV1_$i"];
                $SUM_DTPHB3[$i] = $SUM_DTPHB3[$i] + $rs["DTPHB3_$i"];
                $SUM_OPV3[$i] = $SUM_OPV3[$i] + $rs["OPV3_$i"];
                $SUM_MMR1[$i] = $SUM_MMR1[$i] + $rs["MMR1_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_BCG[$i] = ($SUM_BCG[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_HBV1[$i] = ($SUM_HBV1[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_DTPHB3[$i] = ($SUM_DTPHB3[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV3[$i] = ($SUM_OPV3[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_MMR1[$i] = ($SUM_MMR1[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_BCG[$i] = 0;
                $SUMPERSENT_HBV1[$i] = 0;
                $SUMPERSENT_DTPHB3[$i] = 0;
                $SUMPERSENT_OPV3[$i] = 0;
                $SUMPERSENT_MMR1[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TD(number_format($SUM_B[$i]), "style='background:#F90;color:#FFF; font-weight:bold'");
            $Tables .= $Table->TD(number_format($SUM_BCG[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_BCG[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_HBV1[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_HBV1[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_DTPHB3[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_DTPHB3[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_OPV3[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_OPV3[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_MMR1[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_MMR1[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_COMPLETE[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_COMPLETE[$i], 2));
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndFooter();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_1y_nonth");
        $this->renderPartial("//Reports/report_singletable", $data);
    }

    public function actionEpi_2age() {
        $LIP = new Lib_report();
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_2age($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_2age($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_2age($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='9' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("DTP4", "colspan='2' ");
            $Tables .= $Table->TH("OPV4", "colspan='2' ");
            //$Tables .= $Table->TH("MMR2", "colspan='2' ");
            $Tables .= $Table->TH("J11", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 20; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        $Array_period = array("0", "1", "2", "3", "4");

        $SUM_B = array(0, 0, 0, 0);
        $SUM_DTP4 = array(0, 0, 0, 0);
        $SUM_OPV4 = array(0, 0, 0, 0);
        //$SUM_MMR2 = array(0, 0, 0, 0);
        $SUM_J11 = array(0, 0, 0, 0);
        $SUM_COMPLETE = array(0, 0, 0, 0);

        $PERSENT_DTP4 = array(0, 0, 0, 0);
        $PERSENT_OPV4 = array(0, 0, 0, 0);
        //$PERSENT_MMR2 = array(0, 0, 0, 0);
        $PERSENT_J11 = array(0, 0, 0, 0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0);

        $SUMPERSENT_DTP4 = array(0, 0, 0, 0);
        $SUMPERSENT_OPV4 = array(0, 0, 0, 0);
        //$SUMPERSENT_MMR2 = array(0, 0, 0, 0);
        $SUMPERSENT_J11 = array(0, 0, 0, 0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {

                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_DTP4[$i] = ($rs["DTP4_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV4[$i] = ($rs["OPV4_$i"] / $rs["B_$i"]) * 100;
                    //$PERSENT_MMR2[$i] = ($rs["MMR2_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_J11[$i] = ($rs["J11_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_DTP4[$i] = 0;
                    $PERSENT_OPV4[$i] = 0;
                    //$PERSENT_MMR2[$i] = 0;
                    $PERSENT_J11[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["DTP4_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTP4[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV4_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV4[$i], 2));
                //$Tables .= $Table->TD(number_format($rs["MMR2_$i"]));
                //$Tables .= $Table->TD(number_format($PERSENT_MMR2[$i], 2));
                $Tables .= $Table->TD(number_format($rs["J11_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_J11[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_DTP4[$i] = $SUM_DTP4[$i] + $rs["DTP4_$i"];
                $SUM_OPV4[$i] = $SUM_OPV4[$i] + $rs["OPV4_$i"];
               // $SUM_MMR2[$i] = $SUM_MMR2[$i] + $rs["MMR2_$i"];
                $SUM_J11[$i] = $SUM_J11[$i] + $rs["J11_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_DTP4[$i] = ($SUM_DTP4[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV4[$i] = ($SUM_OPV4[$i] / $SUM_B[$i]) * 100;
                //$SUMPERSENT_MMR2[$i] = ($SUM_MMR2[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_J11[$i] = ($SUM_J11[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_DTP4[$i] = 0;
                $SUMPERSENT_OPV4[$i] = 0;
                //$SUMPERSENT_MMR2[$i] = 0;
                $SUMPERSENT_J11[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TD(number_format($SUM_B[$i]), "style='background:#F90;color:#FFF; font-weight:bold'");
            $Tables .= $Table->TD(number_format($SUM_DTP4[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_DTP4[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_OPV4[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_OPV4[$i], 2));
            //$Tables .= $Table->TD(number_format($SUM_MMR2[$i]));
            //$Tables .= $Table->TD(number_format($SUMPERSENT_MMR2[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_J11[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_J11[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_COMPLETE[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_COMPLETE[$i], 2));
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndFooter();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_2y");
        $this->renderPartial("//Reports/report_singletable", $data);
    }
    
    public function actionEpi_2age_nonth() {
        $LIP = new Lib_report();
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_2age_nonth($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_2age_nonth($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_2age_nonth($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='9' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='9' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("DTP4", "colspan='2' ");
            $Tables .= $Table->TH("OPV4", "colspan='2' ");
            //$Tables .= $Table->TH("MMR2", "colspan='2' ");
            $Tables .= $Table->TH("J11", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 20; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();

        $Array_period = array("0", "1", "2", "3", "4");

        $SUM_B = array(0, 0, 0, 0);
        $SUM_DTP4 = array(0, 0, 0, 0);
        $SUM_OPV4 = array(0, 0, 0, 0);
        //$SUM_MMR2 = array(0, 0, 0, 0);
        $SUM_J11 = array(0, 0, 0, 0);
        $SUM_COMPLETE = array(0, 0, 0, 0);

        $PERSENT_DTP4 = array(0, 0, 0, 0);
        $PERSENT_OPV4 = array(0, 0, 0, 0);
        //$PERSENT_MMR2 = array(0, 0, 0, 0);
        $PERSENT_J11 = array(0, 0, 0, 0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0);

        $SUMPERSENT_DTP4 = array(0, 0, 0, 0);
        $SUMPERSENT_OPV4 = array(0, 0, 0, 0);
        //$SUMPERSENT_MMR2 = array(0, 0, 0, 0);
        $SUMPERSENT_J11 = array(0, 0, 0, 0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {

                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_DTP4[$i] = ($rs["DTP4_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV4[$i] = ($rs["OPV4_$i"] / $rs["B_$i"]) * 100;
                    //$PERSENT_MMR2[$i] = ($rs["MMR2_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_J11[$i] = ($rs["J11_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_DTP4[$i] = 0;
                    $PERSENT_OPV4[$i] = 0;
                    //$PERSENT_MMR2[$i] = 0;
                    $PERSENT_J11[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["DTP4_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTP4[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV4_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV4[$i], 2));
                //$Tables .= $Table->TD(number_format($rs["MMR2_$i"]));
                //$Tables .= $Table->TD(number_format($PERSENT_MMR2[$i], 2));
                $Tables .= $Table->TD(number_format($rs["J11_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_J11[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_DTP4[$i] = $SUM_DTP4[$i] + $rs["DTP4_$i"];
                $SUM_OPV4[$i] = $SUM_OPV4[$i] + $rs["OPV4_$i"];
                //$SUM_MMR2[$i] = $SUM_MMR2[$i] + $rs["MMR2_$i"];
                $SUM_J11[$i] = $SUM_J11[$i] + $rs["J11_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }
            $Tables .= $Table->EndRow();
        endforeach;
        $Tables .= $Table->EndBody();

        $Tables .= $Table->StartFooter();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_DTP4[$i] = ($SUM_DTP4[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV4[$i] = ($SUM_OPV4[$i] / $SUM_B[$i]) * 100;
                //$SUMPERSENT_MMR2[$i] = ($SUM_MMR2[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_J11[$i] = ($SUM_J11[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_DTP4[$i] = 0;
                $SUMPERSENT_OPV4[$i] = 0;
                //$SUMPERSENT_MMR2[$i] = 0;
                $SUMPERSENT_J11[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TD(number_format($SUM_B[$i]), "style='background:#F90;color:#FFF; font-weight:bold'");
            $Tables .= $Table->TD(number_format($SUM_DTP4[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_DTP4[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_OPV4[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_OPV4[$i], 2));
            //$Tables .= $Table->TD(number_format($SUM_MMR2[$i]));
            //$Tables .= $Table->TD(number_format($SUMPERSENT_MMR2[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_J11[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_J11[$i], 2));
            $Tables .= $Table->TD(number_format($SUM_COMPLETE[$i]));
            $Tables .= $Table->TD(number_format($SUMPERSENT_COMPLETE[$i], 2));
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndFooter();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_2y_nonth");
        $this->renderPartial("//Reports/report_singletable", $data);
    }

    public function actionEpi_3age() {
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_age3($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_age3($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_age3($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='5' ");
        $Tables .= $Table->EndRow();
        
        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("J12", "colspan='2' ");
            $Tables .= $Table->TH("MMR2", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 10; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();


        $SUM_B = array(0, 0, 0, 0);
        $SUM_J12 = array(0, 0, 0, 0);
        $PERSENT_J12 = array(0, 0, 0, 0);
        $SUMPERSENT_J12 = array(0, 0, 0, 0);
        
         $SUM_MMR2 = array(0, 0, 0, 0);
        $PERSENT_MMR2 = array(0, 0, 0, 0);
        $SUMPERSENT_MMR2 = array(0, 0, 0, 0);


        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {
                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_J12[$i] = ($rs["J12_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_MMR2[$i] = ($rs["MMR2_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_J12[$i] = 0;
                    $PERSENT_MMR2[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["J12_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_J12[$i], 2));
                $Tables .= $Table->TD(number_format($rs["MMR2_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_MMR2[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_J12[$i] = $SUM_J12[$i] + $rs["J12_$i"];
                $SUM_MMR2[$i] = $SUM_MMR2[$i] + $rs["MMR2_$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;

        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_J12[$i] = ($SUM_J12[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_MMR2[$i] = ($SUM_MMR2[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_J12[$i] = 0;
                $SUMPERSENT_MMR2[$i] = 0;
            }

            $Tables .= $Table->TH(number_format($SUM_B[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_J12[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_J12[$i], 2), "style='font-weight:bold;text-align:right;'");
             $Tables .= $Table->TH(number_format($SUM_MMR2[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_MMR2[$i], 2), "style='font-weight:bold;text-align:right;'");
        }
        $Tables .= $Table->ENDRow();

        $Tables .= $Table->EndBody();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_3y");
        $this->renderPartial("//Reports/report_singletable", $data);
    }
    
    public function actionEpi_3age_nonth() {
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_age3_nonth($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_age3_nonth($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_age3_nonth($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='5' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='5' ");
        $Tables .= $Table->EndRow();
        
        $Tables .= $Table->StartRow();
        for ($i = 0; $i <= 4; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2' ");
            $Tables .= $Table->TH("J12", "colspan='2' ");
            $Tables .= $Table->TH("MMR2", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 10; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();
        $Tables .= $Table->EndThead();


        $SUM_B = array(0, 0, 0, 0);
        $SUM_J12 = array(0, 0, 0, 0);
        $PERSENT_J12 = array(0, 0, 0, 0);
        $SUMPERSENT_J12 = array(0, 0, 0, 0);
        
         $SUM_MMR2 = array(0, 0, 0, 0);
        $PERSENT_MMR2 = array(0, 0, 0, 0);
        $SUMPERSENT_MMR2 = array(0, 0, 0, 0);


        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {
                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_J12[$i] = ($rs["J12_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_MMR2[$i] = ($rs["MMR2_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_J12[$i] = 0;
                    $PERSENT_MMR2[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["J12_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_J12[$i], 2));
                $Tables .= $Table->TD(number_format($rs["MMR2_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_MMR2[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_J12[$i] = $SUM_J12[$i] + $rs["J12_$i"];
                $SUM_MMR2[$i] = $SUM_MMR2[$i] + $rs["MMR2_$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;

        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 0; $i <= 4; $i++) {

            //SET_PERENT
            if ($SUM_B[$i] != 0) {
                $SUMPERSENT_J12[$i] = ($SUM_J12[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_MMR2[$i] = ($SUM_MMR2[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_J12[$i] = 0;
                $SUMPERSENT_MMR2[$i] = 0;
            }

            $Tables .= $Table->TH(number_format($SUM_B[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_J12[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_J12[$i], 2), "style='font-weight:bold;text-align:right;'");
             $Tables .= $Table->TH(number_format($SUM_MMR2[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_MMR2[$i], 2), "style='font-weight:bold;text-align:right;'");
        }
        $Tables .= $Table->ENDRow();

        $Tables .= $Table->EndBody();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_3y_nonth");
        $this->renderPartial("//Reports/report_singletable", $data);
    }

    public function actionEpi_5age() {
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = Yii::app()->request->getPost('distId');
        $year = Yii::app()->request->getPost('year');
        $type = Yii::app()->request->getPost('type');

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_age5($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_age5($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_age5($year);
            $NAME = "อำเภอ";
        }
        
        
        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='7' ");
        $Tables .= $Table->EndRow();
        
        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2'");
            $Tables .= $Table->TH("DTP5", "colspan='2' ");
            $Tables .= $Table->TH("OPV5", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 15; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();


        $Tables .= $Table->EndThead();


        $SUM_B = array(0, 0, 0, 0,0);
        $SUM_DTP5 = array(0, 0, 0, 0,0);
        $SUM_OPV5 = array(0, 0, 0, 0,0);
        $SUM_COMPLETE = array(0, 0, 0, 0,0);

        $PERSENT_DTP5 = array(0, 0, 0, 0,0);
        $PERSENT_OPV5 = array(0, 0, 0, 0,0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0,0);

        $SUMPERSENT_DTP5 = array(0, 0, 0, 0,0);
        $SUMPERSENT_OPV5 = array(0, 0, 0, 0,0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0,0);
        
        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {
                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_DTP5[$i] = ($rs["DTP5_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV5[$i] = ($rs["OPV5_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_DTP5[$i] = 0;
                    $PERSENT_OPV5[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["DTP5_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTP5[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV5_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV5[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_DTP5[$i] = $SUM_DTP5[$i] + $rs["DTP5_$i"];
                $SUM_OPV5[$i] = $SUM_OPV5[$i] + $rs["OPV5_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;

        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 0; $i <= 4; $i++) {

            ///SET_PERENT
            if ($rs["B_$i"] != 0) {
                $SUMPERSENT_DTP5[$i] = ($SUM_DTP5[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV5[$i] = ($SUM_OPV5[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_DTP5[$i] = 0;
                $SUMPERSENT_OPV5[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TH(number_format($SUM_B[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_DTP5[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_DTP5[$i], 2), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_OPV5[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_OPV5[$i], 2), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_COMPLETE[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_COMPLETE[$i], 2), "style='font-weight:bold;text-align:right;'");
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndThead();

        $Tables .= $Table->EndBody();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_5y");
        $this->renderPartial("//Reports/report_singletable", $data);
    }
    
    public function actionEpi_5age_nonth() {
        $Report = new Report_epi();
        $Table = new Tables();

        $ampur = $_POST['distId'];
        $year = $_POST['year'];
        $type = $_POST['type'];

        if ($ampur != '0') {
            if ($type == 'tambon') {
                $result = $Report->Get_epi_tambon_age5_nonth($year, $ampur);
                $NAME = "ตำบล";
            } else {
                $result = $Report->Get_epi_pcu_age5_nonth($year, $ampur);
                $NAME = "สถานบริการ";
            }
        } else {
            $result = $Report->Get_epi_changwat_age5_nonth($year);
            $NAME = "อำเภอ";
        }

        $Tables = $Table->StartTable("", "stripe row-border order-column cell-border", "ReportTable");
        $Tables .= $Table->StartThead();
        $Tables .= $Table->StartRow();
        $Tables .= $Table->TH($NAME, "rowspan='3' ");
        $Tables .= $Table->TH("รวม", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 1", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 2", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 3", "colspan='7' ");
        $Tables .= $Table->TH("ไตรมาส 4", "colspan='7' ");
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 5; $i++) {
            $Tables .= $Table->TH("รวม B", "rowspan='2'");
            $Tables .= $Table->TH("DTP5", "colspan='2' ");
            $Tables .= $Table->TH("OPV5", "colspan='2' ");
            $Tables .= $Table->TH("ครบ", "colspan='2' ");
        }
        $Tables .= $Table->EndRow();

        $Tables .= $Table->StartRow();
        for ($i = 1; $i <= 15; $i++) {
            $Tables .= $Table->TH("A", "");
            $Tables .= $Table->TH("%", "");
        }
        $Tables .= $Table->EndRow();


        $Tables .= $Table->EndThead();


        $SUM_B = array(0, 0, 0, 0);
        $SUM_DTP5 = array(0, 0, 0, 0);
        $SUM_OPV5 = array(0, 0, 0, 0);
        $SUM_COMPLETE = array(0, 0, 0, 0);

        $PERSENT_DTP5 = array(0, 0, 0, 0);
        $PERSENT_OPV5 = array(0, 0, 0, 0);
        $PERSENT_COMPLETE = array(0, 0, 0, 0);

        $SUMPERSENT_DTP5 = array(0, 0, 0, 0);
        $SUMPERSENT_OPV5 = array(0, 0, 0, 0);
        $SUMPERSENT_COMPLETE = array(0, 0, 0, 0);

        $Tables .= $Table->StartBody();
        foreach ($result as $rs):
            $Tables .= $Table->StartRow();
            $Tables .= $Table->TH($rs['CODE'] . ' ' . $rs['NAME']);
            for ($i = 0; $i <= 4; $i++) {
                //SET_PERENT
                if ($rs["B_$i"] != 0) {
                    $PERSENT_DTP5[$i] = ($rs["DTP5_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_OPV5[$i] = ($rs["OPV5_$i"] / $rs["B_$i"]) * 100;
                    $PERSENT_COMPLETE[$i] = ($rs["COMPLETE_$i"] / $rs["B_$i"]) * 100;
                } else {
                    $PERSENT_DTP5[$i] = 0;
                    $PERSENT_OPV5[$i] = 0;
                    $PERSENT_COMPLETE[$i] = 0;
                }

                $Tables .= $Table->TD(number_format($rs["B_$i"]), "style='background:#F90;color:#FFF; font-weight:bold'");
                $Tables .= $Table->TD(number_format($rs["DTP5_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_DTP5[$i], 2));
                $Tables .= $Table->TD(number_format($rs["OPV5_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_OPV5[$i], 2));
                $Tables .= $Table->TD(number_format($rs["COMPLETE_$i"]));
                $Tables .= $Table->TD(number_format($PERSENT_COMPLETE[$i], 2));

                $SUM_B[$i] = $SUM_B[$i] + $rs["B_$i"];
                $SUM_DTP5[$i] = $SUM_DTP5[$i] + $rs["DTP5_$i"];
                $SUM_OPV5[$i] = $SUM_OPV5[$i] + $rs["OPV5_$i"];
                $SUM_COMPLETE[$i] = $SUM_COMPLETE[$i] + $rs["COMPLETE_$i"];
            }

            $Tables .= $Table->EndRow();
        endforeach;

        $Tables .= $Table->TH("รวม", "style='text-align:center;'");
        for ($i = 0; $i <= 4; $i++) {

            ///SET_PERENT
            if ($rs["B_$i"] != 0) {
                $SUMPERSENT_DTP5[$i] = ($SUM_DTP5[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_OPV5[$i] = ($SUM_OPV5[$i] / $SUM_B[$i]) * 100;
                $SUMPERSENT_COMPLETE[$i] = ($SUM_COMPLETE[$i] / $SUM_B[$i]) * 100;
            } else {
                $SUMPERSENT_DTP5[$i] = 0;
                $SUMPERSENT_OPV5[$i] = 0;
                $SUMPERSENT_COMPLETE[$i] = 0;
            }

            $Tables .= $Table->TH(number_format($SUM_B[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_DTP5[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_DTP5[$i], 2), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_OPV5[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_OPV5[$i], 2), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUM_COMPLETE[$i]), "style='font-weight:bold;text-align:right;'");
            $Tables .= $Table->TH(number_format($SUMPERSENT_COMPLETE[$i], 2), "style='font-weight:bold;text-align:right;'");
        }
        $Tables .= $Table->ENDRow();
        $Tables .= $Table->EndThead();

        $Tables .= $Table->EndBody();

        $Tables .= $Table->EndTable();

        $data['tables'] = $Tables;
        $data['DateUpdate'] = $Report->Getdatequery("rpt_vaccine_5y_nonth");
        $this->renderPartial("//Reports/report_singletable", $data);
    }

}

?>
