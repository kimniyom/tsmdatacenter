<?php

class Report_anc {

    function Getanc_thai_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,A,B
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc12week_th r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getanc_thai_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,A,B
                        FROM
                        (
                                SELECT o.`off_id`,o.`off_name`,o.off_type,o.distid
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND o.`hasdata` = 'Y'
                                ORDER BY o.distid,o.off_type DESC,o.off_id ASC
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT HOSPCODE,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc12week_th r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getanc_nonthai_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,A,B
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc12week_nonth r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getanc_nonthai_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,A,B
                        FROM
                        (
                                SELECT o.`off_id`,o.`off_name`,o.off_type,o.distid
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND o.`hasdata` = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT HOSPCODE,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc12week_nonth r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
        function Getanc_5weekthai_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,A,B
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc5_th r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getanc_5weekthai_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,A,B
                        FROM
                        (
                                SELECT o.`off_id`,o.`off_name`,o.off_type,o.distid
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND o.`hasdata` = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT HOSPCODE,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc5_th r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
     function Getanc_5weeknonthai_changwat($year = '') {
        $query = "SELECT Q1.distid AS PCUCODE,Q1.distname AS PCUNAME,A,B
                        FROM
                        (
                                SELECT distid,distname
                                FROM co_district d 
                                WHERE d.`distid` != '6300'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT AMPUR,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc5_nonth r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Getanc_5weeknonthai_ampur($distid = '', $year = '') {
        $query = "SELECT Q1.off_id AS PCUCODE,Q1.off_name AS PCUNAME,A,B
                        FROM
                        (
                                SELECT o.`off_id`,o.`off_name`,o.off_type,o.distid
                                FROM co_office o
                                WHERE o.`distid` = '$distid' AND o.`hasdata` = 'Y'
                        ) AS Q1

                        LEFT JOIN 

                        (
                                SELECT HOSPCODE,SUM(A) AS A,SUM(B) AS B
                                FROM rpt_anc5_nonth r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC";
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
