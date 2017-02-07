<?php

class Report_kpi {

    function kpi_dm_control_changwat($year = '') {
        $query = "SELECT d.`distid` AS CODE,d.`distname` AS NAME,
                                COUNT(*) AS B,
                                SUM(IF(r.`DM_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.`HOSPCODE` = o.`off_id`
                        RIGHT JOIN co_district d ON d.distid = o.`distid`
                        WHERE r.`BUDGETYEAR` = '$year' AND DM = '1'
                        GROUP BY d.`distid` ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_control_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,
                                COUNT(*) AS B,
                                SUM(IF(r.`DM_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON r.`HOSPCODE` = o.`off_id`
                        WHERE r.`BUDGETYEAR` = '$year'
                            AND o.distid = '$ampur' AND DM = '1'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_ht_control_changwat($year = '') {
        $query = "SELECT d.`distid` AS CODE,d.`distname` AS NAME,
                                COUNT(*) AS B,
                                SUM(IF(r.`HT_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.`HOSPCODE` = o.`off_id`
                        RIGHT JOIN co_district d ON d.distid = o.`distid`
                        WHERE r.`BUDGETYEAR` = '$year' AND HT = '1'
                        GROUP BY d.`distid` ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_ht_control_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,
                                COUNT(*) AS B,
                                SUM(IF(r.`HT_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON r.`HOSPCODE` = o.`off_id`
                        WHERE r.`BUDGETYEAR` = '$year'
                            AND o.distid = '$ampur' AND HT = '1'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_eye_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(IF(r.CHECK_EYE = '1',1,0)) AS A,
                        SUM(IF(r.EYE = '1',1,0)) AS WORKING,
                        SUM(IF(r.EYE = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_eye_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(IF(r.CHECK_EYE = '1',1,0)) AS A,
                        SUM(IF(r.EYE = '1',1,0)) AS WORKING,
                        SUM(IF(r.EYE = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_kidney_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(IF(r.CHECK_KIDNEY = '1',1,0)) AS A,
                        SUM(IF(r.DM_KIDNEY = '1',1,0)) AS WORKING,
                        SUM(IF(r.DM_KIDNEY = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_kidney_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(IF(r.CHECK_KIDNEY = '1',1,0)) AS A,
                        SUM(IF(r.DM_KIDNEY = '1',1,0)) AS WORKING,
                        SUM(IF(r.DM_KIDNEY = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_foot_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(IF(r.CHECK_FOOT= '1',1,0)) AS A,
                        SUM(IF(r.FOOT = '1',1,0)) AS WORKING,
                        SUM(IF(r.FOOT = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_dm_screen_foot_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(IF(r.CHECK_FOOT = '1',1,0)) AS A,
                        SUM(IF(r.FOOT = '1',1,0)) AS WORKING,
                        SUM(IF(r.FOOT = '2',1,0)) AS UNNORMAL,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.DM = '1' AND BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_ht_kidney_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(IF(r.HT_KIDNEY = '1',1,0)) AS A,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.HT = '1' AND BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_ht_kidney_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(IF(r.HT_KIDNEY = '1',1,0)) AS A,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.HT = '1' AND BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function kpi_anc_12week_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_anc12week  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_anc_12week_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_anc12week r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function kpi_newborncare6mont_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_newborncare6month  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_newborncare6mont_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_newborncare6month r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function kpi_labor_anc5_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_labor_anc5  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_labor_anc5_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_labor_anc5 r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
      function kpi_ppcare3_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_ppcare3  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_ppcare3_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_ppcare3 r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
          function kpi_nutrion18m_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_nutrion18m  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_nutrion18m_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_nutrion18m r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function kpi_nutrion30m_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_nutrion30m  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_nutrion30m_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_nutrion30m r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function kpi_momdeath_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,
                        d.distname AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_momdeath  r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE BUDGETYEAR = '$year'  
                        GROUP BY d.distid ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function kpi_momdeath_ampur($year = '', $ampur = '') {
        $query = "
            SELECT Q1.CODE,Q1.NAME,IFNULL(Q2.A,0) AS A,IFNULL(Q2.B,0) AS B
            
            FROM (
                SELECT off_id AS CODE,off_name AS NAME,off_type,distid
                FROM co_office 
                WHERE hasdata = 'Y' AND distid = '$ampur'
            ) Q1 
            
LEFT JOIN 
(
        SELECT o.off_id AS CODE,
                        o.off_name AS NAME,
                        SUM(A) AS A,
                        SUM(B) AS B
                        FROM kpi_momdeath r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE BUDGETYEAR = '$year'  AND distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC 
                        ) Q2 
                        ON Q1.CODE= Q2.CODE
                        ORDER BY Q1.distid,Q1.off_type DESC,Q1.CODE ASC 
                ";
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
