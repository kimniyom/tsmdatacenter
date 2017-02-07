<?php

class Report_serviceController extends Controller {

    public function actionRpt_service_opd() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        $lib = new Lib_report();

        $month = $lib->monthfullperiod();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("ครั้ง");
        endfor;

        //$takisTable->addSpanHeader("คน");
        $takisTable->addSpanHeader("ครั้ง");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=10;$i<=12;$i++){
            $takisTable->addCell(number_format($rs["AMOUNT$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISIT$i"]), "align='right'");
            }
            
            for($i=1;$i<=9;$i++):
                if(strlen($i) < 2){
                    $m = "0".$i;
                } else {
                    $m = $i;
                }
            $takisTable->addCell(number_format($rs["AMOUNT$m"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISIT$m"]), "align='right'");
            endfor;
   

            //$sum[0] = $rs['AMOUNT01'] + $rs['AMOUNT02'] + $rs['AMOUNT03'] + $rs['AMOUNT04'] + $rs['AMOUNT05'] + $rs['AMOUNT06'] + $rs['AMOUNT07'] + $rs['AMOUNT08'] + $rs['AMOUNT09'] + $rs['AMOUNT10'] + $rs['AMOUNT11'] + $rs['AMOUNT12'];
            $sum[1] = $rs['VISIT01'] + $rs['VISIT02'] + $rs['VISIT03'] + $rs['VISIT04'] + $rs['VISIT05'] + $rs['VISIT06'] + $rs['VISIT07'] + $rs['VISIT08'] + $rs['VISIT09'] + $rs['VISIT10'] + $rs['VISIT11'] + $rs['VISIT12'];
            //$takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_opd_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_service_opdnonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        $lib = new Lib_report();

        $month = $lib->monthfullperiod();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_nonth($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_nonth($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("ครั้ง");
        endfor;

        //$takisTable->addSpanHeader("คน");
        $takisTable->addSpanHeader("ครั้ง");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=10;$i<=12;$i++){
            $takisTable->addCell(number_format($rs["AMOUNT$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISIT$i"]), "align='right'");
            }
            
            for($i=1;$i<=9;$i++):
                if(strlen($i) < 2){
                    $m = "0".$i;
                } else {
                    $m = $i;
                }
            $takisTable->addCell(number_format($rs["AMOUNT$m"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISIT$m"]), "align='right'");
            endfor;
   

            //$sum[0] = $rs['AMOUNT01'] + $rs['AMOUNT02'] + $rs['AMOUNT03'] + $rs['AMOUNT04'] + $rs['AMOUNT05'] + $rs['AMOUNT06'] + $rs['AMOUNT07'] + $rs['AMOUNT08'] + $rs['AMOUNT09'] + $rs['AMOUNT10'] + $rs['AMOUNT11'] + $rs['AMOUNT12'];
            $sum[1] = $rs['VISIT01'] + $rs['VISIT02'] + $rs['VISIT03'] + $rs['VISIT04'] + $rs['VISIT05'] + $rs['VISIT06'] + $rs['VISIT07'] + $rs['VISIT08'] + $rs['VISIT09'] + $rs['VISIT10'] + $rs['VISIT11'] + $rs['VISIT12'];
            //$takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_opd_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    /*จำนวนผู้ป่วยนอก คน/ครั้ง ไตรมาศ*/
    public function actionRpt_service_opdthperiod() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_opdth_period($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_opdth_period($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

       $takisTable->addHeader("ไตรมาส 1", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 2", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 3", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 4", "colspan='2' ");
       $takisTable->addHeader("รวมทั้งปี", "colspan='2' ");

        for ($i = 1; $i <= 5; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("ครั้ง");
        endfor;

        $result = $PCU;
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=1;$i<=5;$i++){
            $takisTable->addCell(number_format($rs["PERIOD$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISITPERIOD$i"]), "align='right'");
            }
           
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_opd_th_year_period");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_service_opdnonthperiod() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_opdnonth_period($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_opdnonth_period($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

       $takisTable->addHeader("ไตรมาส 1", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 2", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 3", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 4", "colspan='2' ");
       $takisTable->addHeader("รวมทั้งปี", "colspan='2' ");

        for ($i = 1; $i <= 5; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("ครั้ง");
        endfor;

        $result = $PCU;
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=1;$i<=5;$i++){
            $takisTable->addCell(number_format($rs["PERIOD$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISITPERIOD$i"]), "align='right'");
            }
           
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_opd_nonth_year_period");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    /*จำนวนผู้ป่วยนอก คน/วันนอน คนไทย*/
    public function actionRpt_service_ipdth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        $lib = new Lib_report();

        $month = $lib->monthfullperiod();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_ipdth($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_ipdth($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("วันนอน");
        endfor;

        //$takisTable->addSpanHeader("คน");
        $takisTable->addSpanHeader("วันนอน");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=10;$i<=12;$i++){
            $takisTable->addCell(number_format($rs["AMOUNT$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["DAYADMIT$i"]), "align='right'");
            }
            
            for($i=1;$i<=9;$i++):
                if(strlen($i) < 2){
                    $m = "0".$i;
                } else {
                    $m = $i;
                }
            $takisTable->addCell(number_format($rs["AMOUNT$m"]), "align='right'");
            $takisTable->addCell(number_format($rs["DAYADMIT$m"]), "align='right'");
            endfor;
   

            //$sum[0] = $rs['AMOUNT01'] + $rs['AMOUNT02'] + $rs['AMOUNT03'] + $rs['AMOUNT04'] + $rs['AMOUNT05'] + $rs['AMOUNT06'] + $rs['AMOUNT07'] + $rs['AMOUNT08'] + $rs['AMOUNT09'] + $rs['AMOUNT10'] + $rs['AMOUNT11'] + $rs['AMOUNT12'];
            $sum[1] = $rs['DAYADMIT01'] + $rs['DAYADMIT02'] + $rs['DAYADMIT03'] + $rs['DAYADMIT04'] + $rs['DAYADMIT05'] + $rs['DAYADMIT06'] + $rs['DAYADMIT07'] + $rs['DAYADMIT08'] + $rs['DAYADMIT09'] + $rs['DAYADMIT10'] + $rs['DAYADMIT11'] + $rs['DAYADMIT12'];
            //$takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_ipd_th");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
     /*จำนวนผู้ป่วยนอก คน/วันนอน ต่างชาติ*/
    public function actionRpt_service_ipdnonth() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        $lib = new Lib_report();

        $month = $lib->monthfullperiod();

        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_ipdnonth($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_ipdnonth($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addHeader($month[$i], "colspan='2' ");
        endfor;

        $takisTable->addHeader("รวม", "");

        for ($i = 0; $i <= 11; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("วันนอน");
        endfor;

        //$takisTable->addSpanHeader("คน");
        $takisTable->addSpanHeader("วันนอน");

        $result = $PCU;
        $sum = array("", "");
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=10;$i<=12;$i++){
            $takisTable->addCell(number_format($rs["AMOUNT$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["DAYADMIT$i"]), "align='right'");
            }
            
            for($i=1;$i<=9;$i++):
                if(strlen($i) < 2){
                    $m = "0".$i;
                } else {
                    $m = $i;
                }
            $takisTable->addCell(number_format($rs["AMOUNT$m"]), "align='right'");
            $takisTable->addCell(number_format($rs["DAYADMIT$m"]), "align='right'");
            endfor;
   

            //$sum[0] = $rs['AMOUNT01'] + $rs['AMOUNT02'] + $rs['AMOUNT03'] + $rs['AMOUNT04'] + $rs['AMOUNT05'] + $rs['AMOUNT06'] + $rs['AMOUNT07'] + $rs['AMOUNT08'] + $rs['AMOUNT09'] + $rs['AMOUNT10'] + $rs['AMOUNT11'] + $rs['AMOUNT12'];
            $sum[1] = $rs['DAYADMIT01'] + $rs['DAYADMIT02'] + $rs['DAYADMIT03'] + $rs['DAYADMIT04'] + $rs['DAYADMIT05'] + $rs['DAYADMIT06'] + $rs['DAYADMIT07'] + $rs['DAYADMIT08'] + $rs['DAYADMIT09'] + $rs['DAYADMIT10'] + $rs['DAYADMIT11'] + $rs['DAYADMIT12'];
            //$takisTable->addCell(number_format($sum[0]), "align='right' id='setText-Right-bold' ");
            $takisTable->addCell(number_format($sum[1]), "align='right' id='setText-Right-bold'");

            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_ipd_nonth");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_service_ipdthperiod() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_ipdth_period($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_ipdth_period($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

       $takisTable->addHeader("ไตรมาส 1", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 2", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 3", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 4", "colspan='2' ");
       $takisTable->addHeader("รวมทั้งปี", "colspan='2' ");

        for ($i = 1; $i <= 5; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("วันนอน");
        endfor;

        $result = $PCU;
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=1;$i<=5;$i++){
            $takisTable->addCell(number_format($rs["PERIOD$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISITPERIOD$i"]), "align='right'");
            }
           
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_ipd_th_year_period");
        $this->renderPartial("//reports/report_singletable", $data);
    }
    
    public function actionRpt_service_ipdnonthperiod() {
        $ampur = $_POST['distId'];
        $year = $_POST['year'];


        $report = new Report_service();
        //ถ้าเข้ามาเป็นศูนย์ข้อมูลจังหวัด
        //if ($distId == '6300') {
        if ($ampur == '0') {
            $data['location'] = "อำเภอ";
            $PCU = $report->Getservice_changwat_ipdnonth_period($year); //Get ชื่อตำบลมาแสดง
        } else if ($ampur != '0') {
            $data['location'] = "สถานบริการ";
            $PCU = $report->Getservice_ampur_ipdnonth_period($ampur, $year); //Get ชื่อตำบลมาแสดง
        }

        $takisTable = new TakisTables();
        $takisTable->setClass("stripe row-border order-column cell-border");
        $takisTable->showColumnIndex(false);
        $takisTable->addHeader($data['location'], "id = 'setText-Center' rowspan='2' ");

       $takisTable->addHeader("ไตรมาส 1", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 2", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 3", "colspan='2' ");
       $takisTable->addHeader("ไตรมาส 4", "colspan='2' ");
       $takisTable->addHeader("รวมทั้งปี", "colspan='2' ");

        for ($i = 1; $i <= 5; $i++):
            $takisTable->addSpanHeader("คน");
            $takisTable->addSpanHeader("วันนอน");
        endfor;

        $result = $PCU;
        foreach ($result as $rs):
            $takisTable->startRow();
            $takisTable->addCell($rs['PCUCODE'] . ' ' . $rs['PCUNAME'], "align='left' id= 'setText-Left' ");
            
            for($i=1;$i<=5;$i++){
            $takisTable->addCell(number_format($rs["PERIOD$i"]), "align='right'");
            $takisTable->addCell(number_format($rs["VISITPERIOD$i"]), "align='right'");
            }
           
            $takisTable->endRow();
        endforeach;

        $data['tables'] = $takisTable->render();
        $data['DateUpdate'] = $report->Getdatequery("rpt_service_ipd_nonth_year_period");
        $this->renderPartial("//reports/report_singletable", $data);
    }

  
}

?>
