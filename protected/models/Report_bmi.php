<?php

class Report_bmi{
    function Rpt_bw_bh_bmi6_12_th_changwat($year = null,$term = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi6_12_th r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi6_12_th_ampur($ampur = null,$year = null,$term = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi6_12_th r 
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi6_12_nonth_changwat($year = null,$term = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi6_12_nonth r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi6_12_nonth_ampur($ampur = null,$year = null,$term = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi6_12_nonth r 
                    WHERE r.BUDGETYEAR = '$year'  AND TERM = '$term'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    /*********************************** END bmi6_12 *************************/
    
    function Rpt_bw_bh_bmi13_18_th_changwat($year = null,$term = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi13_18_th r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi13_18_th_ampur($ampur = null,$year = null,$term = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi13_18_th r 
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi13_18_nonth_changwat($year = null,$term = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi13_18_nonth r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND TERM = '$term'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi13_18_nonth_ampur($ampur = null,$year = null,$term = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(HEIGHT_M1) AS HEIGHT_M1,
                            SUM(HEIGHT_W1) AS HEIGHT_W1,
                            IFNULL(SUM(SUM_MW1),0) AS SUM_MW1,
                            ((SUM(SUM_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(HEIGHT_M2) AS HEIGHT_M2,
                            SUM(HEIGHT_W2) AS HEIGHT_W2,
                            IFNULL(SUM(SUM_MW2),0) AS SUM_MW2,
                            ((SUM(SUM_MW2)/SUM(SUM_KIDALL))*100) AS P3,
                            SUM(HEIGHT_M3) AS HEIGHT_M3,
                            SUM(HEIGHT_W3) AS HEIGHT_W3,
                            IFNULL(SUM(SUM_MW3),0) AS SUM_MW3,
                            ((SUM(SUM_MW3)/SUM(SUM_KIDALL))*100) AS P4,
                            SUM(FATS_M1) AS FATS_M1,
                            SUM(FATS_W1) AS FATS_W1,
                            IFNULL(SUM(SUMFATS_MW1),0) AS SUMFATS_MW1,
                            ((SUM(SUMFATS_MW1)/SUM(SUM_KIDALL))*100) AS P5,
                            SUM(FATS_M2) AS FATS_M2,
                            SUM(FATS_W2) AS FATS_W2,
                            IFNULL(SUM(SUMFATS_MW2),0) AS SUMFATS_MW2,
                            ((SUM(SUMFATS_MW2)/SUM(SUM_KIDALL))*100) AS P6,
                            SUM(GROWTH_M) AS GROWTH_M,
                            SUM(GROWTH_W) AS GROWTH_W,
                            IFNULL(SUM(SUMGROWTH_MW),0) AS SUMGROWTH_MW,
                            ((SUM(SUMGROWTH_MW)/SUM(SUM_KIDALL))*100) AS P7
                    FROM rpt_bw_bh_bmi13_18_nonth r 
                    WHERE r.BUDGETYEAR = '$year'  AND TERM = '$term'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function Rpt_bw_bh_bmi0_5_th_changwat($year = null,$period = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(WEIGHT_M1) AS WEIGHT_M1,
                            SUM(WEIGHT_W1) AS WEIGHT_W1,
                            IFNULL(SUM(SUMWEIGHT_MW1),0) AS SUMWEIGHT_MW1,
                            ((SUM(SUMWEIGHT_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(WEIGHT_M2) AS WEIGHT_M2,
                            SUM(WEIGHT_W2) AS WEIGHT_W2,
                            IFNULL(SUM(SUMWEIGHT_MW2),0) AS SUMWEIGHT_MW2,
                            ((SUM(SUMWEIGHT_MW2)/SUM(SUM_KIDALL))*100) AS P3
                           
                    FROM rpt_bw_bh_bmi0_5_th r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND PERIOD = '$period'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi0_5_th_ampur($ampur = null,$year = null,$period = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(WEIGHT_M1) AS WEIGHT_M1,
                            SUM(WEIGHT_W1) AS WEIGHT_W1,
                            IFNULL(SUM(SUMWEIGHT_MW1),0) AS SUMWEIGHT_MW1,
                            ((SUM(SUMWEIGHT_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(WEIGHT_M2) AS WEIGHT_M2,
                            SUM(WEIGHT_W2) AS WEIGHT_W2,
                            IFNULL(SUM(SUMWEIGHT_MW2),0) AS SUMWEIGHT_MW2,
                            ((SUM(SUMWEIGHT_MW2)/SUM(SUM_KIDALL))*100) AS P3
                    FROM rpt_bw_bh_bmi0_5_th r 
                    WHERE r.BUDGETYEAR = '$year' AND PERIOD = '$period'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function Rpt_bw_bh_bmi0_5_nonth_changwat($year = null,$period = null){
        $query = "SELECT
                            AMPUR AS PCUCODE,
                            distname AS PCUNAME,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(WEIGHT_M1) AS WEIGHT_M1,
                            SUM(WEIGHT_W1) AS WEIGHT_W1,
                            IFNULL(SUM(SUMWEIGHT_MW1),0) AS SUMWEIGHT_MW1,
                            ((SUM(SUMWEIGHT_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(WEIGHT_M2) AS WEIGHT_M2,
                            SUM(WEIGHT_W2) AS WEIGHT_W2,
                            IFNULL(SUM(SUMWEIGHT_MW2),0) AS SUMWEIGHT_MW2,
                            ((SUM(SUMWEIGHT_MW2)/SUM(SUM_KIDALL))*100) AS P3
                           
                    FROM rpt_bw_bh_bmi0_5_nonth r INNER JOIN co_district d ON r.AMPUR = d.distid
                    WHERE r.BUDGETYEAR = '$year' AND PERIOD = '$period'
                    GROUP BY r.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Rpt_bw_bh_bmi0_5_nonth_ampur($ampur = null,$year = null,$period = null){
        $query = "
                    SELECT * 
                    FROM
                    (
                    SELECT off_id AS PCUCODE,off_name AS PCUNAME
                    FROM co_office 
                    WHERE hasdata = 'Y' AND distid = '$ampur' 
                    ) Q1
                    LEFT JOIN
                    (
                    SELECT
                            HOSPCODE,
                            SUM(MAN) AS MAN,
                            SUM(WOWEN) AS WOMEN,
                            IFNULL(SUM(SUM_KIDALL),0) AS SUM_KIDALL,
                            SUM(KID_M) AS KID_M,
                            SUM(KID_W) AS KID_W,
                            IFNULL(SUM(SUM_KID_MW),0) AS SUM_KID_MW,
                            ((SUM(SUM_KID_MW)/SUM(SUM_KIDALL))*100) AS P1,
                            SUM(WEIGHT_M1) AS WEIGHT_M1,
                            SUM(WEIGHT_W1) AS WEIGHT_W1,
                            IFNULL(SUM(SUMWEIGHT_MW1),0) AS SUMWEIGHT_MW1,
                            ((SUM(SUMWEIGHT_MW1)/SUM(SUM_KIDALL))*100) AS P2,
                            SUM(WEIGHT_M2) AS WEIGHT_M2,
                            SUM(WEIGHT_W2) AS WEIGHT_W2,
                            IFNULL(SUM(SUMWEIGHT_MW2),0) AS SUMWEIGHT_MW2,
                            ((SUM(SUMWEIGHT_MW2)/SUM(SUM_KIDALL))*100) AS P3
                    FROM rpt_bw_bh_bmi0_5_nonth r 
                    WHERE r.BUDGETYEAR = '$year' AND PERIOD = '$period'
                    GROUP BY r.HOSPCODE
                ) Q2 ON Q1.PCUCODE = Q2.HOSPCODE  ";
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
