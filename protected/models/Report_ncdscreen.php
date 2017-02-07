<?php

class Report_ncdscreen {

    function Get_dm_changwat_value($budgetyear = null, $group = null) {
        $query = "SELECT r.`AMPUR` AS CODE,
                            RIGHT(r.`PERIOD`,2) AS PERIOD,
                            r.`B`,SUM(r.`A`) AS A,
                            IFNULL(r.`PERCENT`,0) AS PERCENT
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.NCDTYPE = 'DM'
                        GROUP BY r.`AMPUR`,r.`PERIOD` ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_dm_changwat($budgetyear = null, $group = null) {
        $query = "SELECT d.`distid` AS CODE,
                            d.`distname` AS NAMES,
                            IFNULL(SUM(Q1.B),0) B,
                            SUM(A) AS A,
                            SUM(RS_NORMAL) AS RS_NORMAL,
                            SUM(RS_RISK) AS RS_RISK,
                            SUM(RS_CHRONIC) AS RS_CHRONIC
                        FROM 

                        co_district d

                        LEFT JOIN

                        (
                        SELECT r.`AMPUR`,
                                r.`HOSPCODE`,
                                r.`B`,
                                SUM(r.`A`) AS A,
                                SUM(r.`RS_NORMAL`) AS RS_NORMAL,
                                SUM(r.`RS_RISK`) AS RS_RISK,
                                SUM(r.RS_CHRONIC) AS RS_CHRONIC,
                                r.`PERCENT`
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group'  AND r.NCDTYPE = 'DM'
                        GROUP BY r.`AMPUR`,r.`HOSPCODE` 
                        ) Q1

                        ON d.`distid` = Q1.AMPUR
                        WHERE d.`distid` != '6300'
                        GROUP BY d.`distid` ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_dm_ampur_value($budgetyear = null, $ampur = null, $group = null) {
        $query = "SELECT r.`HOSPCODE` AS CODE,
                            RIGHT(r.`PERIOD`,2) AS PERIOD,
                            r.`B`,
                            r.`A`,
                            IFNULL(r.`PERCENT`,0) AS PERCENT
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.`AMPUR` = '$ampur' AND r.NCDTYPE = 'DM'
                        GROUP BY r.`HOSPCODE`,r.`PERIOD` ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_dm_ampur($budgetyear = null, $ampur = null, $group = null) {
        $query = "SELECT o.off_id AS CODE,
                            o.off_name AS NAMES,
                            IFNULL(r.`B`,0) AS B,
                            SUM(A) AS A,
                            SUM(r.`RS_NORMAL`) AS RS_NORMAL,
                            SUM(r.`RS_RISK`) AS RS_RISK,
                            SUM(r.RS_CHRONIC) AS RS_CHRONIC
                        FROM rpt_ncdscreen r RIGHT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.`AMPUR` = '$ampur' AND r.NCDTYPE = 'DM'
                        GROUP BY o.off_id ORDER BY CONCAT(o.off_type,o.off_name) DESC
                         ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }
    
    
    function Get_ht_changwat_value($budgetyear = null, $group = null) {
        $query = "SELECT r.`AMPUR` AS CODE,
                            RIGHT(r.`PERIOD`,2) AS PERIOD,
                            r.`B`,SUM(r.`A`) AS A,
                            IFNULL(r.`PERCENT`,0) AS PERCENT
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.NCDTYPE = 'HT'
                        GROUP BY r.`AMPUR`,r.`PERIOD` ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_ht_changwat($budgetyear = null, $group = null) {
        $query = "SELECT d.`distid` AS CODE,
                            d.`distname` AS NAMES,
                            IFNULL(SUM(Q1.B),0) B,
                            SUM(A) AS A,
                            SUM(RS_NORMAL) AS RS_NORMAL,
                            SUM(RS_RISK) AS RS_RISK,
                            SUM(RS_CHRONIC) AS RS_CHRONIC
                        FROM 

                        co_district d

                        LEFT JOIN

                        (
                        SELECT r.`AMPUR`,
                            r.`HOSPCODE`,
                            r.`B`,
                            SUM(r.`A`) AS A,
                            SUM(r.`RS_NORMAL`) AS RS_NORMAL,
                            SUM(r.`RS_RISK`) AS RS_RISK,
                            SUM(r.RS_CHRONIC) AS RS_CHRONIC,
                            r.`PERCENT`
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group'  AND r.NCDTYPE = 'HT'
                        GROUP BY r.`AMPUR`,r.`HOSPCODE` 
                        ) Q1

                        ON d.`distid` = Q1.AMPUR
                        WHERE d.`distid` != '6300'
                        GROUP BY d.`distid` ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_ht_ampur_value($budgetyear = null, $ampur = null, $group = null) {
        $query = "SELECT r.`HOSPCODE` AS CODE,
                            RIGHT(r.`PERIOD`,2) AS PERIOD,
                            r.`B`,
                            r.`A`,
                            IFNULL(r.`PERCENT`,0) AS PERCENT
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.`AMPUR` = '$ampur' AND r.NCDTYPE = 'HT'
                        GROUP BY r.`HOSPCODE`,r.`PERIOD` ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Get_ht_ampur($budgetyear = null, $ampur = null, $group = null) {
        $query = "SELECT o.off_id AS CODE,
                            o.off_name AS NAMES,
                            IFNULL(r.`B`,0) AS B,
                            SUM(A) AS A,
                            SUM(r.`RS_NORMAL`) AS RS_NORMAL,
                            SUM(r.`RS_RISK`) AS RS_RISK,
                            SUM(r.RS_CHRONIC) AS RS_CHRONIC
                        FROM rpt_ncdscreen r RIGHT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.`BUDGETYEAR` = '$budgetyear' AND r.`NCDGROUP` = '$group' AND r.`AMPUR` = '$ampur' AND r.NCDTYPE = 'HT'
                        GROUP BY o.off_id ORDER BY CONCAT(o.off_type,o.off_name) DESC
                         ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }
    
    function Getdatequery($table = '') {
        $query = "SELECT MAX(DATE_UPDATE) AS DATE_UPDATE FROM $table LIMIT 1";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['DATE_UPDATE'];
    }
    
    function Getpercentchangwat($group = '',$type = ''){
        $year = date('Y');
        $query = "SELECT (SUM(A)/SUM(B))*100 AS percent
                        FROM 

                        co_district d

                        LEFT JOIN

                        (
                        SELECT r.`AMPUR`,
                                r.`HOSPCODE`,
                                r.`B`,
                                SUM(r.`A`) AS A,
                                SUM(r.`RS_NORMAL`) AS RS_NORMAL,
                                SUM(r.`RS_RISK`) AS RS_RISK,
                                SUM(r.RS_CHRONIC) AS RS_CHRONIC,
                                r.`PERCENT`
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$year' AND r.`NCDGROUP` = '$group'  AND r.NCDTYPE = '$type'
                        GROUP BY r.`AMPUR`,r.`HOSPCODE` 
                        ) Q1

                        ON d.`distid` = Q1.AMPUR
                        WHERE d.`distid` != '6300' ";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        $percent = number_format($rs['percent']);
        return $percent;
    }
    
     function bh_predm_ampur($distid = '', $year = '') {
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
                                FROM rpt_predm r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function bh_predm_changwat($year = '') {
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
                                FROM rpt_predm r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
         function bh_preht_ampur($distid = '', $year = '') {
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
                                FROM rpt_preht r 
                               WHERE BUDGETYEAR = '$year'
                                GROUP BY HOSPCODE
                        ) AS Q2

                        ON Q1.off_id = Q2.HOSPCODE 
                ORDER BY Q1.distid,Q1.off_type DESC,Q1.off_id ASC ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function bh_preht_changwat($year = '') {
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
                                FROM rpt_preht r 
                                WHERE BUDGETYEAR = '$year'
                                GROUP BY AMPUR
                        ) AS Q2

                        ON Q1.distid = Q2.AMPUR ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }


}

?>
