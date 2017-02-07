<?php

class Report_service {

    
    public $SetFildeThai = "
            IFNULL(Q2.THAI01,0) AS THAI01,
            IFNULL(Q3.NOTHAI01,0) AS NOTHAI01,
            IFNULL(Q2.THAI02,0) AS THAI02,
            IFNULL(Q3.NOTHAI02,0) AS NOTHAI02,
            IFNULL(Q2.THAI03,0) AS THAI03,
            IFNULL(Q3.NOTHAI03,0) AS NOTHAI03,
            IFNULL(Q2.THAI04,0) AS THAI04,
            IFNULL(Q3.NOTHAI04,0) AS NOTHAI04,
            IFNULL(Q2.THAI05,0) AS THAI05,
            IFNULL(Q3.NOTHAI05,0) AS NOTHAI05,
            IFNULL(Q2.THAI06,0) AS THAI06,
            IFNULL(Q3.NOTHAI06,0) AS NOTHAI06,
            IFNULL(Q2.THAI07,0) AS THAI07,
            IFNULL(Q3.NOTHAI07,0) AS NOTHAI07,
            IFNULL(Q2.THAI08,0) AS THAI08,
            IFNULL(Q3.NOTHAI08,0) AS NOTHAI08,
            IFNULL(Q2.THAI09,0) AS THAI09,
            IFNULL(Q3.NOTHAI09,0) AS NOTHAI09,
            IFNULL(Q2.THAI10,0) AS THAI10,
            IFNULL(Q3.NOTHAI10,0) AS NOTHAI10,
            IFNULL(Q2.THAI11,0) AS THAI11,
            IFNULL(Q3.NOTHAI11,0) AS NOTHAI11,
            IFNULL(Q2.THAI12,0) AS THAI12,
            IFNULL(Q3.NOTHAI12,0) AS NOTHAI12
        ";
    public $setamountthai = "
        SUM(IF(RIGHT(r.`PERIOD`,2) = '01',AMOUNT,0)) AS THAI01,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '02',AMOUNT,0)) AS THAI02,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '03',AMOUNT,0)) AS THAI03,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '04',AMOUNT,0)) AS THAI04,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '05',AMOUNT,0)) AS THAI05,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '06',AMOUNT,0)) AS THAI06,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '07',AMOUNT,0)) AS THAI07,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '08',AMOUNT,0)) AS THAI08,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS THAI09,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '10',AMOUNT,0)) AS THAI10,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '11',AMOUNT,0)) AS THAI11,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '12',AMOUNT,0)) AS THAI12
    ";
    
    public $setvisitthai = "
        SUM(IF(RIGHT(r.`PERIOD`,2) = '01',VISIT,0)) AS THAI01,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '02',VISIT,0)) AS THAI02,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '03',VISIT,0)) AS THAI03,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '04',VISIT,0)) AS THAI04,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '05',VISIT,0)) AS THAI05,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '06',VISIT,0)) AS THAI06,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '07',VISIT,0)) AS THAI07,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '08',VISIT,0)) AS THAI08,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '09',VISIT,0)) AS THAI09,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '10',VISIT,0)) AS THAI10,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '11',VISIT,0)) AS THAI11,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '12',VISIT,0)) AS THAI12
    ";
    
    public $setamountnothai = "
        SUM(IF(RIGHT(r.`PERIOD`,2) = '01',AMOUNT,0)) AS NOTHAI01,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '02',AMOUNT,0)) AS NOTHAI02,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '03',AMOUNT,0)) AS NOTHAI03,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '04',AMOUNT,0)) AS NOTHAI04,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '05',AMOUNT,0)) AS NOTHAI05,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '06',AMOUNT,0)) AS NOTHAI06,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '07',AMOUNT,0)) AS NOTHAI07,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '08',AMOUNT,0)) AS NOTHAI08,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS NOTHAI09,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '10',AMOUNT,0)) AS NOTHAI10,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '11',AMOUNT,0)) AS NOTHAI11,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '12',AMOUNT,0)) AS NOTHAI12
        ";

    /* จำนวนผู้ป่วยนอก  คน/ครั้ง ไทย ดูแบบรายเดือน*/
    function Getservice_changwat($year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,";
        
        for($i = 10;$i<=12;$i++):
            $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.VISIT$i,0) AS VISIT$i,
                       ";
        endfor;
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.VISIT$months,0) AS VISIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.VISIT09,0) AS VISIT09";
        $query .="
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district o 
                                WHERE o.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`AMPUR`,
                ";
        
        for($i=10;$i<=12;$i++):
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',VISIT,0)) AS VISIT$i,
                       ";
        endfor;
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',VISIT,0)) AS VISIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',VISIT,0)) AS VISIT09
                       ";

        $query .= "FROM rpt_service_opd_th r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10')  AND CONCAT('$year','09')
                                GROUP BY r.`AMPUR`
                          ) AS Q2

                        ON Q1.distid = Q2.AMPUR
                        
                        ORDER BY Q1.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getservice_ampur($distid = '', $year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.VISIT$i,0) AS VISIT$i,
                       ";
        }
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.VISIT$months,0) AS VISIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.VISIT09,0) AS VISIT09";
        $query .="
                        FROM
                        (
                                SELECT o.off_id,o.off_name_new AS off_name
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND hasdata = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`HOSPCODE`,
                ";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',VISIT,0)) AS VISIT$i,
                       ";
        }
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',VISIT,0)) AS VISIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',VISIT,0)) AS VISIT09
                       ";

        $query .= "FROM rpt_service_opd_th r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10') AND CONCAT('$year','09')
                                GROUP BY r.`HOSPCODE`
                          ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE
                        
                        ORDER BY Q1.off_id ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    /* จำนวนผู้ป่วยนอก  คน/ครั้ง ต่างชาติ ดูแบบรายเดือน*/
    function Getservice_changwat_nonth($year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,";
        
        for($i = 10;$i<=12;$i++):
            $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.VISIT$i,0) AS VISIT$i,
                       ";
        endfor;
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.VISIT$months,0) AS VISIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.VISIT09,0) AS VISIT09";
        $query .="
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district o 
                                WHERE o.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`AMPUR`,
                ";
        
        for($i=10;$i<=12;$i++):
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',VISIT,0)) AS VISIT$i,
                       ";
        endfor;
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',VISIT,0)) AS VISIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',VISIT,0)) AS VISIT09
                       ";

        $query .= "FROM rpt_service_opd_nonth r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10')  AND CONCAT('$year','09')
                                GROUP BY r.`AMPUR`
                          ) AS Q2

                        ON Q1.distid = Q2.AMPUR
                        
                        ORDER BY Q1.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getservice_ampur_nonth($distid = '', $year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.VISIT$i,0) AS VISIT$i,
                       ";
        }
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.VISIT$months,0) AS VISIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.VISIT09,0) AS VISIT09";
        $query .="
                        FROM
                        (
                                SELECT o.off_id,o.off_name_new AS off_name
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND hasdata = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`HOSPCODE`,
                ";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',VISIT,0)) AS VISIT$i,
                       ";
        }
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',VISIT,0)) AS VISIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',VISIT,0)) AS VISIT09
                       ";

        $query .= "FROM rpt_service_opd_nonth r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10') AND CONCAT('$year','09')
                                GROUP BY r.`HOSPCODE`
                          ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE
                        
                        ORDER BY Q1.off_id ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    /*จำนวนผู้ป่วยนอก คน/ครั้ง ดูแบบไตรมาศ*/
    function Getservice_changwat_opdth_period($year = ''){
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`distid`,d.`distname`
                                    FROM co_district d
                                    WHERE d.`distid` != '6300'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`AMPUR`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`VISIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`VISIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`VISIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`VISIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`VISIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_opd_th_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`AMPUR`
                                    ) Q2
                                    ON Q1.distid = Q2.AMPUR ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Getservice_ampur_opdth_period($distid = '',$year = ''){
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name_new AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`off_id`,d.`off_name_new`
                                    FROM co_office d
                                    WHERE d.`distid` = '$distid' AND hasdata = 'Y'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`HOSPCODE`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`VISIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`VISIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`VISIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`VISIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`VISIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_opd_th_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`HOSPCODE`
                                    ) Q2
                                    ON Q1.off_id = Q2.HOSPCODE ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     /*จำนวนผู้ป่วยนอก คน/ครั้ง ดูแบบไตรมาศ*/
    function Getservice_changwat_opdnonth_period($year = ''){
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`distid`,d.`distname`
                                    FROM co_district d
                                    WHERE d.`distid` != '6300'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`AMPUR`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`VISIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`VISIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`VISIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`VISIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`VISIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_opd_nonth_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`AMPUR`
                                    ) Q2
                                    ON Q1.distid = Q2.AMPUR ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Getservice_ampur_opdnonth_period($distid = '',$year = ''){
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name_new AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`off_id`,d.`off_name_new`
                                    FROM co_office d
                                    WHERE d.`distid` = '$distid' AND hasdata = 'Y'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`HOSPCODE`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`VISIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`VISIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`VISIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`VISIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`VISIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_opd_nonth_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`HOSPCODE`
                                    ) Q2
                                    ON Q1.off_id = Q2.HOSPCODE ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    /* จำนวนผู้ป่วยนอก  คน/วันนอน ไทย*/
    function Getservice_changwat_ipdth($year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,";
        
        for($i = 10;$i<=12;$i++):
            $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.DAYADMIT$i,0) AS DAYADMIT$i,
                       ";
        endfor;
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.DAYADMIT$months,0) AS DAYADMIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.DAYADMIT09,0) AS DAYADMIT09";
        $query .="
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district o 
                                WHERE o.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`AMPUR`,
                ";
        
        for($i=10;$i<=12;$i++):
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',DAYADMIT,0)) AS DAYADMIT$i,
                       ";
        endfor;
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',DAYADMIT,0)) AS DAYADMIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',DAYADMIT,0)) AS DAYADMIT09
                       ";

        $query .= "FROM rpt_service_ipd_th r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10')  AND CONCAT('$year','09')
                                GROUP BY r.`AMPUR`
                          ) AS Q2

                        ON Q1.distid = Q2.AMPUR
                        
                        ORDER BY Q1.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getservice_ampur_ipdth($distid = '', $year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.DAYADMIT$i,0) AS DAYADMIT$i,
                       ";
        }
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.DAYADMIT$months,0) AS DAYADMIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.DAYADMIT09,0) AS DAYADMIT09";
        $query .="
                        FROM
                        (
                                SELECT o.off_id,o.off_name_new AS off_name
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND hasdata = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`HOSPCODE`,
                ";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',DAYADMIT,0)) AS DAYADMIT$i,
                       ";
        }
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',DAYADMIT,0)) AS DAYADMIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',DAYADMIT,0)) AS DAYADMIT09
                       ";

        $query .= "FROM rpt_service_ipd_th r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10') AND CONCAT('$year','09')
                                GROUP BY r.`HOSPCODE`
                          ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE
                        
                        ORDER BY Q1.off_id ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    
        /* จำนวนผู้ป่วยนอก  คน/ครั้ง ต่างชาติ*/
    function Getservice_changwat_ipdnonth($year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,";
        
        for($i = 10;$i<=12;$i++):
            $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.DAYADMIT$i,0) AS DAYADMIT$i,
                       ";
        endfor;
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.DAYADMIT$months,0) AS DAYADMIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.DAYADMIT09,0) AS DAYADMIT09";
        $query .="
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district o 
                                WHERE o.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`AMPUR`,
                ";
        
        for($i=10;$i<=12;$i++):
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',DAYADMIT,0)) AS DAYADMIT$i,
                       ";
        endfor;
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',DAYADMIT,0)) AS DAYADMIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',DAYADMIT,0)) AS DAYADMIT09
                       ";

        $query .= "FROM rpt_service_ipd_nonth r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10')  AND CONCAT('$year','09')
                                GROUP BY r.`AMPUR`
                          ) AS Q2

                        ON Q1.distid = Q2.AMPUR
                        
                        ORDER BY Q1.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    
    function Getservice_ampur_ipdnonth($distid = '', $year = '') {
        $yearOld = ($year-1);
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                            IFNULL(Q2.AMOUNT$i,0) AS AMOUNT$i,
                            IFNULL(Q2.DAYADMIT$i,0) AS DAYADMIT$i,
                       ";
        }
        
        for ($j = 1; $j <= 8; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.AMOUNT$months,0) AS AMOUNT$months,
                            IFNULL(Q2.DAYADMIT$months,0) AS DAYADMIT$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.AMOUNT09,0) AS AMOUNT09,
                        IFNULL(Q2.DAYADMIT09,0) AS DAYADMIT09";
        $query .="
                        FROM
                        (
                                SELECT o.off_id,o.off_name_new AS off_name
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND hasdata = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`HOSPCODE`,
                ";
        
        for($i=10;$i<=12;$i++){
             $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',AMOUNT,0)) AS AMOUNT$i,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$i',DAYADMIT,0)) AS DAYADMIT$i,
                       ";
        }
        
        for ($i = 1; $i <= 8; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',AMOUNT,0)) AS AMOUNT$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',DAYADMIT,0)) AS DAYADMIT$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT,0)) AS AMOUNT09,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '09',DAYADMIT,0)) AS DAYADMIT09
                       ";

        $query .= "FROM rpt_service_ipd_nonth r 
                                WHERE PERIOD BETWEEN CONCAT('$yearOld','10') AND CONCAT('$year','09')
                                GROUP BY r.`HOSPCODE`
                          ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE
                        
                        ORDER BY Q1.off_id ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

         /*จำนวนผู้ป่วยนอก คน/วันนอน ดูแบบไตรมาศ*/
    function Getservice_changwat_ipdth_period($year = ''){
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`distid`,d.`distname`
                                    FROM co_district d
                                    WHERE d.`distid` != '6300'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`AMPUR`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`DAYADMIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`DAYADMIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`DAYADMIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`DAYADMIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`DAYADMIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_ipd_th_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`AMPUR`
                                    ) Q2
                                    ON Q1.distid = Q2.AMPUR ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Getservice_ampur_ipdth_period($distid = '',$year = ''){
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name_new AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`off_id`,d.`off_name_new`
                                    FROM co_office d
                                    WHERE d.`distid` = '$distid' AND hasdata = 'Y'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`HOSPCODE`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`DAYADMIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`DAYADMIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`DAYADMIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`DAYADMIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`DAYADMIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_ipd_th_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`HOSPCODE`
                                    ) Q2
                                    ON Q1.off_id = Q2.HOSPCODE ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
        function Getservice_changwat_ipdnonth_period($year = ''){
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`distid`,d.`distname`
                                    FROM co_district d
                                    WHERE d.`distid` != '6300'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`AMPUR`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`DAYADMIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`DAYADMIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`DAYADMIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`DAYADMIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`DAYADMIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_ipd_nonth_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`AMPUR`
                                    ) Q2
                                    ON Q1.distid = Q2.AMPUR ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Getservice_ampur_ipdnonth_period($distid = '',$year = ''){
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name_new AS PCUNAME,
                                    IFNULL(Q2.PERIOD1,0) AS PERIOD1,
                                    IFNULL(Q2.VISITPERIOD1,0) AS VISITPERIOD1,
                                    IFNULL(Q2.PERIOD2,0) AS PERIOD2,
                                    IFNULL(Q2.VISITPERIOD2,0) AS VISITPERIOD2,
                                    IFNULL(Q2.PERIOD3,0) AS PERIOD3,
                                    IFNULL(Q2.VISITPERIOD3,0) AS VISITPERIOD3,
                                    IFNULL(Q2.PERIOD4,0) AS PERIOD4,
                                    IFNULL(Q2.VISITPERIOD4,0) AS VISITPERIOD4,
                                    IFNULL(Q2.PERIOD5,0) AS PERIOD5,
                                    IFNULL(Q2.VISITPERIOD5,0) AS VISITPERIOD5
                                    FROM
                                    (
                                    SELECT d.`off_id`,d.`off_name_new`
                                    FROM co_office d
                                    WHERE d.`distid` = '$distid' AND hasdata = 'Y'
                                    ) Q1
                                    LEFT JOIN
                                    (
                                    SELECT r.`HOSPCODE`,
                                            SUM(IF(r.`PERIOD` = '1',r.`AMOUNT`,0)) AS PERIOD1,
                                            SUM(IF(r.`PERIOD` = '1',r.`DAYADMIT`,0)) AS VISITPERIOD1,
                                            SUM(IF(r.`PERIOD` = '2',r.`AMOUNT`,0)) AS PERIOD2,
                                            SUM(IF(r.`PERIOD` = '2',r.`DAYADMIT`,0)) AS VISITPERIOD2,
                                            SUM(IF(r.`PERIOD` = '3',r.`AMOUNT`,0)) AS PERIOD3,
                                            SUM(IF(r.`PERIOD` = '3',r.`DAYADMIT`,0)) AS VISITPERIOD3,
                                            SUM(IF(r.`PERIOD` = '4',r.`AMOUNT`,0)) AS PERIOD4,
                                            SUM(IF(r.`PERIOD` = '4',r.`DAYADMIT`,0)) AS VISITPERIOD4,
                                            SUM(IF(r.`PERIOD` = '5',r.`AMOUNT`,0)) AS PERIOD5,
                                            SUM(IF(r.`PERIOD` = '5',r.`DAYADMIT`,0)) AS VISITPERIOD5
                                    FROM `rpt_service_ipd_nonth_year_period` r
                                    WHERE r.`BUDGETYEAR` = '$year'
                                    GROUP BY r.`HOSPCODE`
                                    ) Q2
                                    ON Q1.off_id = Q2.HOSPCODE ";
         $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
 
    function Getdatequery($table = '') {
        $query = "SELECT MAX(DATE_UPDATE) AS DATE_UPDATE FROM $table LIMIT 1";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['DATE_UPDATE'];
    }
    


}

?>
