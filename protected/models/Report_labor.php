<?php

class Report_labor {

    public $SetFildeThai = "
        SUM(IF(RIGHT(r.`PERIOD`,2) = '01',AMOUNT_TH,0)) AS THAI01,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '02',AMOUNT_TH,0)) AS THAI02,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '03',AMOUNT_TH,0)) AS THAI03,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '04',AMOUNT_TH,0)) AS THAI04,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '05',AMOUNT_TH,0)) AS THAI05,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '06',AMOUNT_TH,0)) AS THAI06,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '07',AMOUNT_TH,0)) AS THAI07,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '08',AMOUNT_TH,0)) AS THAI08,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT_TH,0)) AS THAI09,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '10',AMOUNT_TH,0)) AS THAI10,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '11',AMOUNT_TH,0)) AS THAI11,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '12',AMOUNT_TH,0)) AS THAI12
        ";
    public $SetFildeNOThai = "
        SUM(IF(RIGHT(r.`PERIOD`,2) = '01',AMOUNT_NTH,0)) AS NOTHAI01,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '02',AMOUNT_NTH,0)) AS NOTHAI02,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '03',AMOUNT_NTH,0)) AS NOTHAI03,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '04',AMOUNT_NTH,0)) AS NOTHAI04,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '05',AMOUNT_NTH,0)) AS NOTHAI05,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '06',AMOUNT_NTH,0)) AS NOTHAI06,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '07',AMOUNT_NTH,0)) AS NOTHAI07,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '08',AMOUNT_NTH,0)) AS NOTHAI08,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '09',AMOUNT_NTH,0)) AS NOTHAI09,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '10',AMOUNT_NTH,0)) AS NOTHAI10,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '11',AMOUNT_NTH,0)) AS NOTHAI11,
        SUM(IF(RIGHT(r.`PERIOD`,2) = '12',AMOUNT_NTH,0)) AS NOTHAI12
        ";
    public $SetFilde = "
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

    /* Labor Thai */

    function Getlabor_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,$this->SetFildeThai
                                FROM rpt_labor_th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR 
                        
                    LEFT JOIN 

                        (
                                SELECT AMPUR,$this->SetFildeNOThai
                                FROM rpt_labor_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q3

                        ON Q1.distid = Q3.AMPUR
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.tamboncodefull AS PCUCODE,Q1.tambonname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT o.tamboncodefull,o.tambonname
                                FROM ctambon o
                                WHERE o.`ampurcode` = '$distid' 
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->SetFildeThai
                                FROM rpt_labor_th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q2

                        ON Q1.tamboncodefull = Q2.TAMBON

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->SetFildeNOThai
                                FROM rpt_labor_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q3

                        ON Q1.tamboncodefull = Q3.TAMBON

                        ORDER BY Q1.tamboncodefull ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    /* RPT Labor 15 - 19 */

    function Getlabor_changwat15_19($year) {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,$this->SetFildeThai
                                FROM rpt_labor15_19th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR 
                
                        LEFT JOIN 

                        (
                                SELECT AMPUR,$this->SetFildeNOThai
                                FROM rpt_labor15_19nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q3

                        ON Q1.distid = Q3.AMPUR
                
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_ampur15_19($distid = '', $year = '') {
        $query = "SELECT Q1.tamboncodefull AS PCUCODE,Q1.tambonname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT o.tamboncodefull,o.tambonname
                                FROM ctambon o
                                WHERE o.`ampurcode` = '$distid' 
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->SetFildeThai
                                FROM rpt_labor15_19th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q2

                        ON Q1.tamboncodefull = Q2.TAMBON
                        
                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->SetFildeNOThai
                                FROM rpt_labor15_19nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q3

                        ON Q1.tamboncodefull = Q3.TAMBON

                        ORDER BY Q1.tamboncodefull ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_changwat_momdeath($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,";
        for ($j = 1; $j <= 11; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.THAI$months,0) AS THAI$months,
                            IFNULL(Q2.NOTHAI$months,0) AS NOTHAI$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.THAI12,0) AS THAI12,
                        IFNULL(Q2.NOTHAI12,0) AS NOTHAI12";
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

        for ($i = 1; $i <= 11; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',TH_DEATH,0)) AS THAI$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',NTH_DEATH,0)) AS NOTHAI$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '12',TH_DEATH,0)) AS THAI12,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '12',NTH_DEATH,0)) AS NOTHAI12
                       ";

        $query .= "FROM rpt_momdeath r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`AMPUR`
                          ) AS Q2

                        ON Q1.distid = Q2.AMPUR
                        
                        ORDER BY Q1.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_ampur_momdeath($distid = '', $year = '') {
        $query = "SELECT Q1.tamboncodefull AS PCUCODE,Q1.tambonname AS PCUNAME,";
        for ($j = 1; $j <= 11; $j++):
            if (strlen($j) < 2) {
                $months = "0" . $j;
            } else {
                $months = $j;
            }
            $query .= "
                            IFNULL(Q2.THAI$months,0) AS THAI$months,
                            IFNULL(Q2.NOTHAI$months,0) AS NOTHAI$months,
                       ";
        endfor;
        $query .=" IFNULL(Q2.THAI12,0) AS THAI12,
                        IFNULL(Q2.NOTHAI12,0) AS NOTHAI12";
        $query .="
                        FROM
                        (
                                SELECT o.tamboncodefull,o.tambonname
                                FROM ctambon o
                                WHERE o.`ampurcode` = '$distid' 
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,
                ";

        for ($i = 1; $i <= 11; $i++):
            if (strlen($i) < 2) {
                $month = "0" . $i;
            } else {
                $month = $i;
            }
            $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',TH_DEATH,0)) AS THAI$month,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '$month',NTH_DEATH,0)) AS NOTHAI$month,
                       ";
        endfor;

        $query .= "
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '12',TH_DEATH,0)) AS THAI12,
                                    SUM(IF(RIGHT(r.`PERIOD`,2) = '12',NTH_DEATH,0)) AS NOTHAI12
                       ";

        $query .= "FROM rpt_momdeath r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                          ) AS Q2

                        ON Q1.tamboncodefull = Q2.TAMBON
                        
                        ORDER BY Q1.tamboncodefull ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    /* จำนวนเด็กอายุต่ำกว่า 5 ปีมีพัฒนาการปกติตามวัย */

    function Getlabor_changwat_rpt_nutrion0_5($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT LEFT(VILLAGE,4) AS AMPUR,$this->setamountthai
                                FROM rpt_nutrion0_5 r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY LEFT(VILLAGE,4)
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR 
                        
                    LEFT JOIN 

                        (
                                SELECT LEFT(VILLAGE,4) AS AMPUR,$this->setamountnothai
                                FROM rpt_nutrion0_5_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY LEFT(VILLAGE,4)
                        ) AS Q3

                        ON Q1.distid = Q3.AMPUR
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_ampur_rpt_nutrion0_5($distid = '', $year = '') {
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT off_id,off_name
                                FROM co_office d 
                                WHERE d.distid = '$distid' AND d.`hasdata` = 'Y' 
                                 ORDER BY off_type
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT HOSPCODE,$this->setamountthai
                                FROM rpt_nutrion0_5 r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                        
                    LEFT JOIN 

                        (
                                SELECT HOSPCODE,$this->setamountnothai
                                FROM rpt_nutrion0_5_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q3

                        ON Q1.off_id = Q3.HOSPCODE
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    /* จำนวนทารกแรกเกิดที่มีน้ำหนักน้อยกว่า 2500 กรัม */

    function Getlabor_newbon2500_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,$this->setamountthai
                                FROM rpt_newborn2500_th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR 
                        
                    LEFT JOIN 

                        (
                                SELECT AMPUR,$this->setamountnothai
                                FROM rpt_newborn2500_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY AMPUR
                        ) AS Q3

                        ON Q1.distid = Q3.AMPUR
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getlabor_newbon2500_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.tamboncodefull AS PCUCODE,Q1.tambonname AS PCUNAME,$this->SetFilde
                        FROM
                        (
                                SELECT o.tamboncodefull,o.tambonname
                                FROM ctambon o
                                WHERE o.`ampurcode` = '$distid' 
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->setamountthai
                                FROM rpt_newborn2500_th r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q2

                        ON Q1.tamboncodefull = Q2.TAMBON

                        LEFT JOIN 

                        (
                                SELECT r.`TAMBON`,$this->setamountnothai
                                FROM rpt_newborn2500_nonth r 
                                WHERE LEFT(PERIOD,4) = '$year'
                                GROUP BY r.`TAMBON`
                        ) AS Q3

                        ON Q1.tamboncodefull = Q3.TAMBON

                        ORDER BY Q1.tamboncodefull ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    /* จำนวนทารกตาย 7 วัน,28 วัน ,1 ปี , 5 ปี(แยกไทย/ต่างชาติ) */

    function Getlabor_child_death_changwat($year = "") {
        $sql = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,Q2.*";
        $sql .= "
                    FROM 
                    (
                            SELECT d.`distid`,d.`distname`
                            FROM co_district d 
                            WHERE d.`distid` != '6300'
                    ) Q1

                    LEFT JOIN

                    (
                            SELECT r.`AMPUR`,
                                        SUM(r.`TH_CHILDDEATH7D`) AS THAI7DAY,
                                        SUM(r.`NTH_CHILDDEATH7D`) AS NOTHAI7DAY,
                                        SUM(r.`TH_CHILDDEATH28D`) AS THAI28DAY,
                                        SUM(r.`NTH_CHILDDEATH28D`) AS NOTHAI28DAY,
                                        SUM(r.`TH_CHILDDEATH1Y`) AS THAI1YEAR,
                                        SUM(r.`NTH_CHILDDEATH1Y`) AS NOTHAI1YEAR,
                                        SUM(r.`TH_CHILDDEATH5Y`) AS THAI5YEAR,
                                        SUM(r.`NTH_CHILDDEATH5Y`) AS NOTHAI5YEAR,";
        for ($i = 1; $i <= 11; $i++) {
            if (strlen($i) < 2) {
                $m = "0" . $i;
            } else {
                $m = $i;
            }
            $sql .= "
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH7D`,0)) AS THAI7DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH7D`,0)) AS NOTHAI7DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH28D`,0)) AS THAI28DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH28D`,0)) AS NOTHAI28DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH1Y`,0)) AS THAI1YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH1Y`,0)) AS NOTHAI1YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH5Y`,0)) AS THAI5YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH5Y`,0)) AS NOTHAI5YEAR_MONTH$m,
                      ";
        }
        $sql .= "
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH7D`,0)) AS THAI7DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH7D`,0)) AS NOTHAI7DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH28D`,0)) AS THAI28DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH28D`,0)) AS NOTHAI28DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH1Y`,0)) AS THAI1YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH1Y`,0)) AS NOTHAI1YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH5Y`,0)) AS THAI5YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH5Y`,0)) AS NOTHAI5YEAR_MONTH12";
        $sql .= "
                            FROM rpt_child_death r
                            WHERE LEFT(r.`DDEATH`,4) = '$year'
                            GROUP BY r.`AMPUR`
                    ) Q2

                    ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Getlabor_child_death_ampur($distid = '', $year = "") {
        $sql = "SELECT Q1.tamboncodefull AS PCUCODE,Q1.tambonname AS PCUNAME,Q2.*";
        $sql .= "
                    FROM 
                    (
                            SELECT o.tamboncodefull,o.tambonname
                            FROM ctambon o
                            WHERE o.`ampurcode` = '$distid' 
                    ) Q1

                    LEFT JOIN

                    (
                            SELECT r.`TAMBON`,
                                        SUM(r.`TH_CHILDDEATH7D`) AS THAI7DAY,
                                        SUM(r.`NTH_CHILDDEATH7D`) AS NOTHAI7DAY,
                                        SUM(r.`TH_CHILDDEATH28D`) AS THAI28DAY,
                                        SUM(r.`NTH_CHILDDEATH28D`) AS NOTHAI28DAY,
                                        SUM(r.`TH_CHILDDEATH1Y`) AS THAI1YEAR,
                                        SUM(r.`NTH_CHILDDEATH1Y`) AS NOTHAI1YEAR,
                                        SUM(r.`TH_CHILDDEATH5Y`) AS THAI5YEAR,
                                        SUM(r.`NTH_CHILDDEATH5Y`) AS NOTHAI5YEAR,";
        for ($i = 1; $i <= 11; $i++) {
            if (strlen($i) < 2) {
                $m = "0" . $i;
            } else {
                $m = $i;
            }
            $sql .= "
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH7D`,0)) AS THAI7DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH7D`,0)) AS NOTHAI7DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH28D`,0)) AS THAI28DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH28D`,0)) AS NOTHAI28DAY_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH1Y`,0)) AS THAI1YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH1Y`,0)) AS NOTHAI1YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`TH_CHILDDEATH5Y`,0)) AS THAI5YEAR_MONTH$m,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '$m',r.`NTH_CHILDDEATH5Y`,0)) AS NOTHAI5YEAR_MONTH$m,
                      ";
        }
        $sql .= "
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH7D`,0)) AS THAI7DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH7D`,0)) AS NOTHAI7DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH28D`,0)) AS THAI28DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH28D`,0)) AS NOTHAI28DAY_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH1Y`,0)) AS THAI1YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH1Y`,0)) AS NOTHAI1YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`TH_CHILDDEATH5Y`,0)) AS THAI5YEAR_MONTH12,
                                   SUM(IF(RIGHT(r.`DDEATH`,2) = '12',r.`NTH_CHILDDEATH5Y`,0)) AS NOTHAI5YEAR_MONTH12";
        $sql .= "
                            FROM rpt_child_death r
                            WHERE LEFT(r.`DDEATH`,4) = '$year'
                            GROUP BY r.`TAMBON`
                    ) Q2

                    ON Q1.tamboncodefull = Q2.TAMBON ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Getdatequery($table = '') {
        $query = "SELECT MAX(DATE_UPDATE) AS DATE_UPDATE FROM $table LIMIT 1";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['DATE_UPDATE'];
    }

}

?>
