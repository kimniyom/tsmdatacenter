<?php

class Border_health {

    function bh_fp_changwat($year = '') {
        $query = "SELECT Q1.distid AS CODE,Q1.distname AS NAME,Q2.*
                        FROM 

                        (
                                SELECT d.distid,d.distname
                                FROM co_district d
                                WHERE d.distid != '6300' AND borderhealth = 'Y'
                        ) Q1

                        LEFT JOIN

                        (
                        SELECT b.AMPUR,
                        ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "
                                SUM(IF(b.PERIOD = $i,b.FPTYPE1_PID,0)) AS F1_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE1_SEQ,0)) AS F1_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE2_PID,0)) AS F2_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE2_SEQ,0)) AS F2_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE3_PID,0)) AS F3_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE3_SEQ,0)) AS F3_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE4_PID,0)) AS F4_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE4_SEQ,0)) AS F4_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE5_PID,0)) AS F5_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE5_SEQ,0)) AS F5_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE6_PID,0)) AS F6_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE6_SEQ,0)) AS F6_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE7_PID,0)) AS F7_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE7_SEQ,0)) AS F7_SEQ_$i,
                                ";
        }

        $query .= "
                                SUM(IF(b.PERIOD = 5,b.FPTYPE1_PID,0)) AS F1_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE1_SEQ,0)) AS F1_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE2_PID,0)) AS F2_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE2_SEQ,0)) AS F2_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE3_PID,0)) AS F3_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE3_SEQ,0)) AS F3_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE4_PID,0)) AS F4_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE4_SEQ,0)) AS F4_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE5_PID,0)) AS F5_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE5_SEQ,0)) AS F5_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE6_PID,0)) AS F6_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE6_SEQ,0)) AS F6_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE7_PID,0)) AS F7_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE7_SEQ,0)) AS F7_SEQ_5
                                ";

        $query .="
                        FROM bh_fp b
                        WHERE b.BUDGETYEAR = '$year' 
                        GROUP BY b.AMPUR
                        ) Q2

                        ON Q1.distid = Q2.AMPUR ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function bh_fp_ampur($ampur = '', $year = '') {
        $query = "SELECT Q1.off_id AS CODE,Q1.off_name AS NAME,Q2.*
                        FROM 

                        (
                                SELECT o.off_id,o.off_name,o.distid,o.off_type
                                FROM co_office o
                                WHERE o.hasdata = 'Y' 
                                AND o.distid = '$ampur'
                        ) Q1

                        LEFT JOIN

                        (
                        SELECT b.HOSPCODE,
                        ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "
                                SUM(IF(b.PERIOD = $i,b.FPTYPE1_PID,0)) AS F1_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE1_SEQ,0)) AS F1_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE2_PID,0)) AS F2_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE2_SEQ,0)) AS F2_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE3_PID,0)) AS F3_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE3_SEQ,0)) AS F3_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE4_PID,0)) AS F4_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE4_SEQ,0)) AS F4_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE5_PID,0)) AS F5_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE5_SEQ,0)) AS F5_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE6_PID,0)) AS F6_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE6_SEQ,0)) AS F6_SEQ_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE7_PID,0)) AS F7_PID_$i,
                                SUM(IF(b.PERIOD = $i,b.FPTYPE7_SEQ,0)) AS F7_SEQ_$i,
                                ";
        }

        $query .= "
                                SUM(IF(b.PERIOD = 5,b.FPTYPE1_PID,0)) AS F1_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE1_SEQ,0)) AS F1_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE2_PID,0)) AS F2_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE2_SEQ,0)) AS F2_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE3_PID,0)) AS F3_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE3_SEQ,0)) AS F3_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE4_PID,0)) AS F4_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE4_SEQ,0)) AS F4_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE5_PID,0)) AS F5_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE5_SEQ,0)) AS F5_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE6_PID,0)) AS F6_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE6_SEQ,0)) AS F6_SEQ_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE7_PID,0)) AS F7_PID_5,
                                SUM(IF(b.PERIOD = 5,b.FPTYPE7_SEQ,0)) AS F7_SEQ_5
                                ";

        $query .="
                        FROM bh_fp b
                        WHERE b.BUDGETYEAR = '$year'
                            AND b.AMPUR = '$ampur'
                            GROUP BY b.HOSPCODE
                        ) Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                        
                   ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC
                ";

        //return $query;
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Bcg_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o 
                              WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.BCG_FIRST, 0)) AS BCG_FIRST_$i,
                                SUM(IF(b.PERIOD = $i, b.BCG, 0)) AS BCG_$i,
                                SUM(IF(b.PERIOD = $i, b.BCG_1, 0)) AS BCG_1_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.BCG_FIRST, 0)) AS BCG_FIRST_5,
                                SUM(IF(b.PERIOD = 5, b.BCG, 0)) AS BCG_5,
                                SUM(IF(b.PERIOD = 5, b.BCG_1, 0)) AS BCG_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Bcg_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.BCG_FIRST, 0)) AS BCG_FIRST_$i,
                                SUM(IF(b.PERIOD = $i, b.BCG, 0)) AS BCG_$i,
                                SUM(IF(b.PERIOD = $i, b.BCG_1, 0)) AS BCG_1_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.BCG_FIRST, 0)) AS BCG_FIRST_5,
                                SUM(IF(b.PERIOD = 5, b.BCG, 0)) AS BCG_5,
                                SUM(IF(b.PERIOD = 5, b.BCG_1, 0)) AS BCG_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //HB
    function Hb_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o  WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.HB1, 0)) AS HB1_$i,
                                SUM(IF(b.PERIOD = $i, b.HB1_1, 0)) AS HB1_1_$i,
                                SUM(IF(b.PERIOD = $i, b.HB2, 0)) AS HB2_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.HB1, 0)) AS HB1_5,
                                SUM(IF(b.PERIOD = 5, b.HB1_1, 0)) AS HB1_1_5,
                                SUM(IF(b.PERIOD = 5, b.HB2, 0)) AS HB2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Hb_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.HB1, 0)) AS HB1_$i,
                                SUM(IF(b.PERIOD = $i, b.HB1_1, 0)) AS HB1_1_$i,
                                SUM(IF(b.PERIOD = $i, b.HB2, 0)) AS HB2_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.HB1, 0)) AS HB1_5,
                                SUM(IF(b.PERIOD = 5, b.HB1_1, 0)) AS HB1_1_5,
                                SUM(IF(b.PERIOD = 5, b.HB2, 0)) AS HB2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //DTP
    function Dtphb_less_1_year_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPHB1, 0)) AS DTPHB1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB2, 0)) DTPHB2_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB3, 0)) AS DTPHB3_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPHB1, 0)) AS DTPHB1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB2, 0)) AS DTPHB2_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB3, 0)) AS DTPHB3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dtphb_less_1_year_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPHB1, 0)) AS DTPHB1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB2, 0)) DTPHB2_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB3, 0)) AS DTPHB3_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPHB1, 0)) AS DTPHB1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB2, 0)) AS DTPHB2_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB3, 0)) AS DTPHB3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //DTP More 1 Year
    function Dtphb_more_1_year_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname 
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPHB1_1, 0)) AS DTPHB1_1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB2_1, 0)) DTPHB2_1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB3_1, 0)) AS DTPHB3_1_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPHB1_1, 0)) AS DTPHB1_1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB2_1, 0)) AS DTPHB2_1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB3_1, 0)) AS DTPHB3_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dtphb_more_1_year_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPHB1_1, 0)) AS DTPHB1_1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB2_1, 0)) DTPHB2_1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPHB3_1, 0)) AS DTPHB3_1_$i, ";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPHB1_1, 0)) AS DTPHB1_1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB2_1, 0)) AS DTPHB2_1_5,
                                SUM(IF(b.PERIOD = 5, b.DTPHB3_1, 0)) AS DTPHB3_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //DTP 4 2 year
    function Dtp4_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname 
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPOPV4, 0)) AS DTPOPV4_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPOPV4_2, 0)) DTPOPV4_2_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPOPV4, 0)) AS DTPOPV4_5,
                                SUM(IF(b.PERIOD = 5, b.DTPOPV4_2, 0)) AS DTPOPV4_2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dtp4_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPOPV4, 0)) AS DTPOPV4_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPOPV4_2, 0)) DTPOPV4_2_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPOPV4, 0)) AS DTPOPV4_5,
                                SUM(IF(b.PERIOD = 5, b.DTPOPV4_2, 0)) AS DTPOPV4_2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //DTP5 5year
    function Dtp5_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPOPV5, 0)) AS DTPOPV5_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPOPV5_5, 0)) DTPOPV5_5_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPOPV5, 0)) AS DTPOPV5_5,
                                SUM(IF(b.PERIOD = 5, b.DTPOPV5_5, 0)) AS DTPOPV5_5_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dtp5_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTPOPV5, 0)) AS DTPOPV5_$i,
                                SUM(IF(b.PERIOD = $i, b.DTPOPV5_5, 0)) DTPOPV5_5_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTPOPV5, 0)) AS DTPOPV5_5,
                                SUM(IF(b.PERIOD = 5, b.DTPOPV5_5, 0)) AS DTPOPV5_5_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //MMR 1year
    function Mmr1_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.MMR1, 0)) AS MMR1_$i,
                                SUM(IF(b.PERIOD = $i, b.MMR1_1, 0)) MMR1_1_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.MMR1, 0)) AS MMR1_5,
                                SUM(IF(b.PERIOD = 5, b.MMR1_1, 0)) AS MMR1_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Mmr1_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.MMR1, 0)) AS MMR1_$i,
                                SUM(IF(b.PERIOD = $i, b.MMR1_1, 0)) MMR1_1_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.MMR1, 0)) AS MMR1_5,
                                SUM(IF(b.PERIOD = 5, b.MMR1_1, 0)) AS MMR1_1_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //MMR 2year
    function Mmr2_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.MMR2, 0)) AS MMR2_$i,
                                SUM(IF(b.PERIOD = $i, b.MMR2_3, 0)) MMR2_3_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.MMR2, 0)) AS MMR2_5,
                                SUM(IF(b.PERIOD = 5, b.MMR2_3, 0)) AS MMR2_3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Mmr2_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.MMR2, 0)) AS MMR2_$i,
                                SUM(IF(b.PERIOD = $i, b.MMR2_3, 0)) MMR2_3_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.MMR2, 0)) AS MMR2_5,
                                SUM(IF(b.PERIOD = 5, b.MMR2_3, 0)) AS MMR2_3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //LAJE 2year
    function Laje1_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.LAJE1, 0)) AS LAJE1_$i,
                                SUM(IF(b.PERIOD = $i, b.LAJE1_2, 0)) LAJE1_2_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.LAJE1, 0)) AS LAJE1_5,
                                SUM(IF(b.PERIOD = 5, b.LAJE1_2, 0)) AS LAJE1_2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Laje1_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.LAJE1, 0)) AS LAJE1_$i,
                                SUM(IF(b.PERIOD = $i, b.LAJE1_2, 0)) LAJE1_2_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.LAJE1, 0)) AS LAJE1_5,
                                SUM(IF(b.PERIOD = 5, b.LAJE1_2, 0)) AS LAJE1_2_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //LAJE2 2year
    function Laje2_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.LAJE3, 0)) AS LAJE3_$i,
                                SUM(IF(b.PERIOD = $i, b.LAJE3_3, 0)) LAJE3_3_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.LAJE3, 0)) AS LAJE3_5,
                                SUM(IF(b.PERIOD = 5, b.LAJE3_3, 0)) AS LAJE3_3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Laje2_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.LAJE3, 0)) AS LAJE3_$i,
                                SUM(IF(b.PERIOD = $i, b.LAJE3_3, 0)) LAJE3_3_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.LAJE3, 0)) AS LAJE3_5,
                                SUM(IF(b.PERIOD = 5, b.LAJE3_3, 0)) AS LAJE3_3_5
                                
                              FROM
                                bh_vaccine_all b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    //DT 2year
    function Dt_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.VAC_106, 0)) AS VAC_106_$i,
                                SUM(IF(b.PERIOD = $i, b.VAC_107, 0)) VAC_107_$i,
                                SUM(IF(b.PERIOD = $i, b.VAC_108, 0)) VAC_108_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.VAC_106, 0)) AS VAC_106_5,
                                SUM(IF(b.PERIOD = 5, b.VAC_107, 0)) AS VAC_107_5,
                                SUM(IF(b.PERIOD = 5, b.VAC_108, 0)) AS VAC_108_5
                                
                              FROM
                                bh_vaccine_dt b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dt_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.off_id,
                              o.off_name,
                              o.distid,
                              o.off_type 
                            FROM
                              co_office o 
                            WHERE o.hasdata = 'Y' AND o.distid = '$ampur') Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.VAC_106, 0)) AS VAC_106_$i,
                                SUM(IF(b.PERIOD = $i, b.VAC_107, 0)) VAC_107_$i,
                                SUM(IF(b.PERIOD = $i, b.VAC_108, 0)) VAC_108_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.VAC_106, 0)) AS VAC_106_5,
                                SUM(IF(b.PERIOD = 5, b.VAC_107, 0)) AS VAC_107_5,
                                SUM(IF(b.PERIOD = 5, b.VAC_108, 0)) AS VAC_108_5
                                
                              FROM
                                bh_vaccine_dt b 
                              WHERE b.BUDGETYEAR = '$year' 
                                AND b.AMPUR = '$ampur' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                          ORDER BY Q1.distid,
                            Q1.off_type DESC,
                            Q1.off_id ASC  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dt_anc_changwat($year = '') {
        $query = "SELECT 
                            Q1.distid AS CODE,
                            Q1.distname AS NAME,
                            Q2.* 
                          FROM
                            (SELECT 
                              o.distid,
                              o.distname
                            FROM
                              co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.AMPUR,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTANC1, 0)) AS DTANC1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC2, 0)) DTANC2_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC3, 0)) DTANC3_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC4, 0)) DTANC4_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC5, 0)) DTANC5_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTANC1, 0)) AS DTANC1_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC2, 0)) AS DTANC2_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC3, 0)) AS DTANC3_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC4, 0)) AS DTANC4_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC5, 0)) AS DTANC5_5
                                
                              FROM
                                bh_vaccine_anc b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.AMPUR) Q2 
                              ON Q1.distid = Q2.AMPUR 
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Dt_anc_ampur($ampur = '', $year = '') {
        $query = "SELECT 
                            Q1.off_id AS CODE,
                            Q1.off_name AS NAME,
                            Q2.* 
                          FROM
                            (SELECT
                            o.distid,
                              o.off_id,
                              o.off_name,
                              o.off_type
                            FROM
                              co_office o WHERE o.hasdata = 'Y' AND distid = '$ampur'
                            ) Q1 
                            LEFT JOIN 
                              (SELECT 
                                b.HOSPCODE,
                                ";
        for ($i = 1; $i <= 4; $i++) {
            $query .= "SUM(IF(b.PERIOD = $i, b.DTANC1, 0)) AS DTANC1_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC2, 0)) DTANC2_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC3, 0)) DTANC3_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC4, 0)) DTANC4_$i,
                                SUM(IF(b.PERIOD = $i, b.DTANC5, 0)) DTANC5_$i,";
        }
        $query .= "
                                SUM(IF(b.PERIOD = 5, b.DTANC1, 0)) AS DTANC1_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC2, 0)) AS DTANC2_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC3, 0)) AS DTANC3_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC4, 0)) AS DTANC4_5,
                                SUM(IF(b.PERIOD = 5, b.DTANC5, 0)) AS DTANC5_5
                                
                              FROM
                                bh_vaccine_anc b 
                              WHERE b.BUDGETYEAR = '$year' 
                              GROUP BY b.HOSPCODE) Q2 
                              ON Q1.off_id = Q2.HOSPCODE 
                               ORDER BY Q1.distid,
                                Q1.off_type DESC,
                                Q1.off_id ASC
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    /* Bplace OLD
      function Bplace_changwat($year = '') {
      $query = "SELECT
      Q1.distid AS CODE,
      Q1.distname AS NAME,
      Q2.*
      FROM
      (SELECT
      o.distid,
      o.distname
      FROM
      co_district o WHERE o.distid != '6300' AND borderhealth = 'Y'
      ) Q1
      LEFT JOIN
      (SELECT
      b.AMPUR,
      ";
      for ($i = 1; $i <= 4; $i++) {
      $query .= "SUM(IF(b.PERIOD = $i, b.BPLACE1, 0)) AS BPLACE1_$i,
      SUM(IF(b.PERIOD = $i, b.BPLACE2, 0)) BPLACE2_$i,
      SUM(IF(b.PERIOD = $i, b.BPLACE3, 0)) BPLACE3_$i,
      SUM(IF(b.PERIOD = $i, b.BPLACE5, 0)) BPLACE5_$i,";
      }
      $query .= "
      SUM(IF(b.PERIOD = 5, b.BPLACE1, 0)) AS BPLACE1_5,
      SUM(IF(b.PERIOD = 5, b.BPLACE2, 0)) AS BPLACE2_5,
      SUM(IF(b.PERIOD = 5, b.BPLACE3, 0)) AS BPLACE3_5,
      SUM(IF(b.PERIOD = 5, b.BPLACE5, 0)) AS BPLACE5_5

      FROM
      bh_bplace b
      WHERE b.BUDGETYEAR = '$year'
      GROUP BY b.AMPUR) Q2
      ON Q1.distid = Q2.AMPUR
      ";
      return Yii::app()->db->createCommand($query)->queryAll();
      }

     * 
     */

    function Bplace_changwat($year = '') {
        $query = "SELECT  BPLACE,";
        for ($i = 1; $i <= 6; $i++) {
            $query .= "SUM(IF(PERIOD = $i, BDOCTOR1, 0)) AS BDOCTOR1_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR2, 0)) BDOCTOR2_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR3, 0)) BDOCTOR3_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR4, 0)) BDOCTOR4_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR5, 0)) BDOCTOR5_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR6, 0)) BDOCTOR6_$i,";
        }
        $query .= "
                                SUM(IF(PERIOD = 5, BDOCTOR1, 0)) AS BDOCTOR1_5,
                                SUM(IF(PERIOD = 5, BDOCTOR2, 0)) AS BDOCTOR2_5,
                                SUM(IF(PERIOD = 5, BDOCTOR3, 0)) AS BDOCTOR3_5,
                                SUM(IF(PERIOD = 5, BDOCTOR4, 0)) AS BDOCTOR4_5,
                                SUM(IF(PERIOD = 5, BDOCTOR5, 0)) AS BDOCTOR5_5,
                                SUM(IF(PERIOD = 5, BDOCTOR6, 0)) AS BDOCTOR6_5
                                
                              FROM
                                bh_bplace 
                              WHERE BUDGETYEAR = '$year' 
                              GROUP BY BPLACE
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Bplace_ampur($ampur = '', $year = '') {
        $query = "SELECT  BPLACE,";
        for ($i = 1; $i <= 6; $i++) {
            $query .= "SUM(IF(PERIOD = $i, BDOCTOR1, 0)) AS BDOCTOR1_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR2, 0)) BDOCTOR2_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR3, 0)) BDOCTOR3_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR4, 0)) BDOCTOR4_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR5, 0)) BDOCTOR5_$i,
                                SUM(IF(PERIOD = $i, BDOCTOR6, 0)) BDOCTOR6_$i,";
        }
        $query .= "
                                SUM(IF(PERIOD = 5, BDOCTOR1, 0)) AS BDOCTOR1_5,
                                SUM(IF(PERIOD = 5, BDOCTOR2, 0)) AS BDOCTOR2_5,
                                SUM(IF(PERIOD = 5, BDOCTOR3, 0)) AS BDOCTOR3_5,
                                SUM(IF(PERIOD = 5, BDOCTOR4, 0)) AS BDOCTOR4_5,
                                SUM(IF(PERIOD = 5, BDOCTOR5, 0)) AS BDOCTOR5_5,
                                SUM(IF(PERIOD = 5, BDOCTOR6, 0)) AS BDOCTOR6_5
                                
                              FROM
                                bh_bplace 
                              WHERE BUDGETYEAR = '$year' AND AMPUR = '$ampur'
                              GROUP BY BPLACE
                           ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Vacine_group($BUDGETYEAR = '', $AMPUR = '', $PCU = '') {

        if ($AMPUR == '0') {
            $where = " AND 1=1";
        } else if ($AMPUR != '0' && $PCU == '0') {
            $where = " AND v.AMPUR = '$AMPUR' ";
        } else if ($PCU != '0') {
            $where = " AND v.HOSPCODE = '$PCU' ";
        }

        $query = "SELECT Q1.vaccine_group,
                            Q1.vaccine_name,
                            Q2.MEN_10,
                            Q2.WOMEN_10,
                            Q2.MEN_11,
                            Q2.WOMEN_11,
                            Q2.MEN_12,
                            Q2.WOMEN_12,
                            Q2.MEN_01,
                            Q2.WOMEN_01,
                            Q2.MEN_02,
                            Q2.WOMEN_02,
                            Q2.MEN_03,
                            Q2.WOMEN_03,
                            Q2.MEN_04,
                            Q2.WOMEN_04,
                            Q2.MEN_05,
                            Q2.WOMEN_05,
                            Q2.MEN_06,
                            Q2.WOMEN_06,
                            Q2.MEN_07,
                            Q2.WOMEN_07,
                            Q2.MEN_08,
                            Q2.WOMEN_08,
                            Q2.MEN_09,
                            Q2.WOMEN_09,
                            Q2.TOTAL
                    FROM

                    (
                            SELECT g.vaccine_group,g.vaccine_name
                            FROM vaccine_group g
                    ) Q1

                    LEFT JOIN

                    (

                            SELECT v.GROUPCODE,
                                    SUM(IF(v.PERIOD = 10,v.MEN,0)) AS MEN_10,
                                    SUM(IF(v.PERIOD = 10,v.WOMEN,0)) AS WOMEN_10,
                                    SUM(IF(v.PERIOD = 11,v.MEN,0)) AS MEN_11,
                                    SUM(IF(v.PERIOD = 11,v.WOMEN,0)) AS WOMEN_11,
                                    SUM(IF(v.PERIOD = 12,v.MEN,0)) AS MEN_12,
                                    SUM(IF(v.PERIOD = 12,v.WOMEN,0)) AS WOMEN_12,
                                    SUM(IF(v.PERIOD = 01,v.MEN,0)) AS MEN_01,
                                    SUM(IF(v.PERIOD = 01,v.WOMEN,0)) AS WOMEN_01,
                                    SUM(IF(v.PERIOD = 02,v.MEN,0)) AS MEN_02,
                                    SUM(IF(v.PERIOD = 02,v.WOMEN,0)) AS WOMEN_02,
                                    SUM(IF(v.PERIOD = 03,v.MEN,0)) AS MEN_03,
                                    SUM(IF(v.PERIOD = 03,v.WOMEN,0)) AS WOMEN_03,
                                    SUM(IF(v.PERIOD = 04,v.MEN,0)) AS MEN_04,
                                    SUM(IF(v.PERIOD = 04,v.WOMEN,0)) AS WOMEN_04,
                                    SUM(IF(v.PERIOD = 05,v.MEN,0)) AS MEN_05,
                                    SUM(IF(v.PERIOD = 05,v.WOMEN,0)) AS WOMEN_05,
                                    SUM(IF(v.PERIOD = 06,v.MEN,0)) AS MEN_06,
                                    SUM(IF(v.PERIOD = 06,v.WOMEN,0)) AS WOMEN_06,
                                    SUM(IF(v.PERIOD = 07,v.MEN,0)) AS MEN_07,
                                    SUM(IF(v.PERIOD = 07,v.WOMEN,0)) AS WOMEN_07,
                                    SUM(IF(v.PERIOD = 08,v.MEN,0)) AS MEN_08,
                                    SUM(IF(v.PERIOD = 08,v.WOMEN,0)) AS WOMEN_08,
                                    SUM(IF(v.PERIOD = 09,v.MEN,0)) AS MEN_09,
                                    SUM(IF(v.PERIOD = 09,v.WOMEN,0)) AS WOMEN_09,
                                    SUM(v.MEN + v.WOMEN) AS TOTAL
                            FROM bh_vaccine_group v
                            WHERE v.BUDGETYEAR = '$BUDGETYEAR' $where
                            GROUP BY v.GROUPCODE

                    ) Q2

                    ON Q1.vaccine_group = Q2.GROUPCODE ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Bh_vaccine_preschoolers_changwat($year = '') {
        $sql = "SELECT d.distid AS HOSCODE,d.distname AS HOSNAME,";
        for ($i = 1; $i <= 4; $i++) {
            $sql .= "
                        SUM(IF(PERIOD = '$i',BCG,0))AS BCG_M$i,
                        SUM(IF(PERIOD = '$i',HBV1,0))AS HBV1_M$i,
                        SUM(IF(PERIOD = '$i',HBV2,0))AS HBV2_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB1,0))AS DTPHB1_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB2,0))AS DTPHB2_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB3,0))AS DTPHB3_M$i,
                        SUM(IF(PERIOD = '$i',DTP4,0))AS DTP4_M$i,
                        SUM(IF(PERIOD = '$i',DTP5,0))AS DTP5_M$i,
                        SUM(IF(PERIOD = '$i',MMR1,0))AS MMR1_M$i,
                        SUM(IF(PERIOD = '$i',MMR2,0))AS MMR2_M$i,
                        SUM(IF(PERIOD = '$i',J11,0))AS J11_M$i,
                        SUM(IF(PERIOD = '$i',J12,0))AS J12_M$i,
                        SUM(IF(PERIOD = '$i',OPV1,0))AS OPV1_M$i,
                        SUM(IF(PERIOD = '$i',OPV2,0))AS OPV2_M$i,
                        SUM(IF(PERIOD = '$i',OPV3,0))AS OPV3_M$i,
                        SUM(IF(PERIOD = '$i',OPV4,0))AS OPV4_M$i,
                        SUM(IF(PERIOD = '$i',OPV5,0))AS OPV5_M$i,";
        }
        $sql .= "
                        SUM(IF(PERIOD = '5',BCG,0))AS BCG_M5,
                        SUM(IF(PERIOD = '5',HBV1,0))AS HBV1_M5,
                        SUM(IF(PERIOD = '5',HBV2,0))AS HBV2_M1,
                        SUM(IF(PERIOD = '5',DTPHB1,0))AS DTPHB1_M5,
                        SUM(IF(PERIOD = '5',DTPHB2,0))AS DTPHB2_M5,
                        SUM(IF(PERIOD = '5',DTPHB3,0))AS DTPHB3_M5,
                        SUM(IF(PERIOD = '5',DTP4,0))AS DTP4_M5,
                        SUM(IF(PERIOD = '5',DTP5,0))AS DTP5_M5,
                        SUM(IF(PERIOD = '5',MMR1,0))AS MMR1_M5,
                        SUM(IF(PERIOD = '5',MMR2,0))AS MMR2_M5,
                        SUM(IF(PERIOD = '5',J11,0))AS J11_M5,
                        SUM(IF(PERIOD = '5',J12,0))AS J12_M5,
                        SUM(IF(PERIOD = '5',OPV1,0))AS OPV1_M5,
                        SUM(IF(PERIOD = '5',OPV2,0))AS OPV2_M5,
                        SUM(IF(PERIOD = '5',OPV3,0))AS OPV3_M5,
                        SUM(IF(PERIOD = '5',OPV4,0))AS OPV4_M5,
                        SUM(IF(PERIOD = '5',OPV5,0))AS OPV5_M5";
        $sql .="
                FROM bh_vaccine_preschoolers v
                INNER JOIN co_district d ON v.AMPUR = d.distid
                WHERE v.BUDGETYEAR = '$year' AND d.borderhealth = 'Y'
                GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Bh_vaccine_preschoolers_ampur($year = '', $ampur = '') {
        $sql = "SELECT d.off_id AS HOSCODE,d.off_name AS HOSNAME,";
        for ($i = 1; $i <= 4; $i++) {
            $sql .= "
                        SUM(IF(PERIOD = '$i',BCG,0))AS BCG_M$i,
                        SUM(IF(PERIOD = '$i',HBV1,0))AS HBV1_M$i,
                        SUM(IF(PERIOD = '$i',HBV2,0))AS HBV2_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB1,0))AS DTPHB1_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB2,0))AS DTPHB2_M$i,
                        SUM(IF(PERIOD = '$i',DTPHB3,0))AS DTPHB3_M$i,
                        SUM(IF(PERIOD = '$i',DTP4,0))AS DTP4_M$i,
                        SUM(IF(PERIOD = '$i',DTP5,0))AS DTP5_M$i,
                        SUM(IF(PERIOD = '$i',MMR1,0))AS MMR1_M$i,
                        SUM(IF(PERIOD = '$i',MMR2,0))AS MMR2_M$i,
                        SUM(IF(PERIOD = '$i',J11,0))AS J11_M$i,
                        SUM(IF(PERIOD = '$i',J12,0))AS J12_M$i,
                        SUM(IF(PERIOD = '$i',OPV1,0))AS OPV1_M$i,
                        SUM(IF(PERIOD = '$i',OPV2,0))AS OPV2_M$i,
                        SUM(IF(PERIOD = '$i',OPV3,0))AS OPV3_M$i,
                        SUM(IF(PERIOD = '$i',OPV4,0))AS OPV4_M$i,
                        SUM(IF(PERIOD = '$i',OPV5,0))AS OPV5_M$i,";
        }
        $sql .= "
                        SUM(IF(PERIOD = '5',BCG,0))AS BCG_M5,
                        SUM(IF(PERIOD = '5',HBV1,0))AS HBV1_M5,
                        SUM(IF(PERIOD = '5',HBV2,0))AS HBV2_M1,
                        SUM(IF(PERIOD = '5',DTPHB1,0))AS DTPHB1_M5,
                        SUM(IF(PERIOD = '5',DTPHB2,0))AS DTPHB2_M5,
                        SUM(IF(PERIOD = '5',DTPHB3,0))AS DTPHB3_M5,
                        SUM(IF(PERIOD = '5',DTP4,0))AS DTP4_M5,
                        SUM(IF(PERIOD = '5',DTP5,0))AS DTP5_M5,
                        SUM(IF(PERIOD = '5',MMR1,0))AS MMR1_M5,
                        SUM(IF(PERIOD = '5',MMR2,0))AS MMR2_M5,
                        SUM(IF(PERIOD = '5',J11,0))AS J11_M5,
                        SUM(IF(PERIOD = '5',J12,0))AS J12_M5,
                        SUM(IF(PERIOD = '5',OPV1,0))AS OPV1_M5,
                        SUM(IF(PERIOD = '5',OPV2,0))AS OPV2_M5,
                        SUM(IF(PERIOD = '5',OPV3,0))AS OPV3_M5,
                        SUM(IF(PERIOD = '5',OPV4,0))AS OPV4_M5,
                        SUM(IF(PERIOD = '5',OPV5,0))AS OPV5_M5";
        $sql .="
                FROM bh_vaccine_preschoolers v
                INNER JOIN co_office d ON v.HOSPCODE = d.off_id
                WHERE v.BUDGETYEAR = '$year' AND d.hasdata = 'Y' AND d.distid = '$ampur' 
                GROUP BY d.off_id 
                ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Bh_vaccine_school_age_child_changwat($year = '') {
        $sql = "SELECT d.distid AS HOSCODE,d.distname AS HOSNAME,";
        for ($i = 1; $i <= 4; $i++) {
            $sql .= "
                        SUM(IF(PERIOD = '$i',BCGS,0))AS BCGS_M$i,
                        SUM(IF(PERIOD = '$i',MMRS,0))AS MMRS_M$i,
                        SUM(IF(PERIOD = '$i',DTS1,0))AS DTS1_M$i,
                        SUM(IF(PERIOD = '$i',DTS2,0))AS DTS2_M$i,
                        SUM(IF(PERIOD = '$i',DTS3,0))AS DTS3_M$i,
                        SUM(IF(PERIOD = '$i',DTS4,0))AS DTS4_M$i,
                        SUM(IF(PERIOD = '$i',OPVS1,0))AS OPVS1_M$i,
                        SUM(IF(PERIOD = '$i',OPVS2,0))AS OPVS2_M$i,
                        SUM(IF(PERIOD = '$i',OPVS3,0))AS OPVS3_M$i,";
        }
        $sql .= "
                        SUM(IF(PERIOD = '5',BCGS,0))AS BCGS_M5,
                        SUM(IF(PERIOD = '5',MMRS,0))AS MMRS_M5,
                        SUM(IF(PERIOD = '5',DTS1,0))AS DTS1_M5,
                        SUM(IF(PERIOD = '5',DTS2,0))AS DTS2_M5,
                        SUM(IF(PERIOD = '5',DTS3,0))AS DTS3_M5,
                        SUM(IF(PERIOD = '5',DTS4,0))AS DTS4_M5,
                        SUM(IF(PERIOD = '5',OPVS1,0))AS OPVS1_M5,
                        SUM(IF(PERIOD = '5',OPVS2,0))AS OPVS2_M5,
                        SUM(IF(PERIOD = '5',OPVS3,0))AS OPVS3_M5";
        $sql .="
                FROM bh_vaccine_school_age_child v
                INNER JOIN co_district d ON v.AMPUR = d.distid
                WHERE v.BUDGETYEAR = '$year' AND d.borderhealth = 'Y'
                GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Bh_vaccine_school_age_child_ampur($year = '', $ampur = '') {
        $sql = "SELECT d.off_id AS HOSCODE,d.off_name AS HOSNAME,";
        for ($i = 1; $i <= 4; $i++) {
            $sql .= "
                        SUM(IF(PERIOD = '$i',BCGS,0))AS BCGS_M$i,
                        SUM(IF(PERIOD = '$i',MMRS,0))AS MMRS_M$i,
                        SUM(IF(PERIOD = '$i',DTS1,0))AS DTS1_M$i,
                        SUM(IF(PERIOD = '$i',DTS2,0))AS DTS2_M$i,
                        SUM(IF(PERIOD = '$i',DTS3,0))AS DTS3_M$i,
                        SUM(IF(PERIOD = '$i',DTS4,0))AS DTS4_M$i,
                        SUM(IF(PERIOD = '$i',OPVS1,0))AS OPVS1_M$i,
                        SUM(IF(PERIOD = '$i',OPVS2,0))AS OPVS2_M$i,
                        SUM(IF(PERIOD = '$i',OPVS3,0))AS OPVS3_M$i,";
        }
        $sql .= "
                        SUM(IF(PERIOD = '5',BCGS,0))AS BCGS_M5,
                        SUM(IF(PERIOD = '5',MMRS,0))AS MMRS_M5,
                        SUM(IF(PERIOD = '5',DTS1,0))AS DTS1_M5,
                        SUM(IF(PERIOD = '5',DTS2,0))AS DTS2_M5,
                        SUM(IF(PERIOD = '5',DTS3,0))AS DTS3_M5,
                        SUM(IF(PERIOD = '5',DTS4,0))AS DTS4_M5,
                        SUM(IF(PERIOD = '5',OPVS1,0))AS OPVS1_M5,
                        SUM(IF(PERIOD = '5',OPVS2,0))AS OPVS2_M5,
                        SUM(IF(PERIOD = '5',OPVS3,0))AS OPVS3_M5";
        $sql .="
                FROM bh_vaccine_school_age_child v
                INNER JOIN co_office d ON v.HOSPCODE = d.off_id
                WHERE v.BUDGETYEAR = '$year' AND d.hasdata = 'Y' AND d.distid = '$ampur' 
                GROUP BY d.off_id 
                ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        return $result;
    }

    function Bh_anc12week_changwat($year = '') {
        $query = "SELECT o.distid AS HOSCODE,o.distname AS HOSNAME,SUM(B) AS B,SUM(A) AS A
                        FROM bh_anc12week r LEFT JOIN co_district o ON r.AMPUR = o.distid
                        WHERE o.borderhealth = 'Y' AND r.BUDGETYEAR = '$year' 
                        GROUP BY o.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Bh_anc12week_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS HOSCODE,o.off_name AS HOSNAME,SUM(B) AS B,SUM(A) AS A
                        FROM bh_anc12week r LEFT JOIN co_office o ON  o.off_id = r.HOSPCODE
                        WHERE r.AMPUR = '$ampur' AND r.BUDGETYEAR = '$year'
                        GROUP BY o.off_id
                        ORDER BY o.distid,o.off_type DESC,o.off_id ASC ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function Bh_anc5_changwat($year = '') {
        $query = "SELECT o.distid AS HOSCODE,o.distname AS HOSNAME,SUM(B) AS B,SUM(A) AS A
                        FROM bh_anc5 r LEFT JOIN co_district o ON r.AMPUR = o.distid
                        WHERE o.borderhealth = 'Y' AND r.BUDGETYEAR = '$year' 
                        GROUP BY o.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Bh_anc5_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS HOSCODE,o.off_name AS HOSNAME,SUM(B) AS B,SUM(A) AS A
                        FROM bh_anc5 r LEFT JOIN co_office o ON  o.off_id = r.HOSPCODE
                        WHERE r.AMPUR = '$ampur' AND r.BUDGETYEAR = '$year'
                        GROUP BY o.off_id
                        ORDER BY o.distid,o.off_type DESC,o.off_id ASC ";

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
