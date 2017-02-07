<?php

class Dashboard {

    function kpi_dm_control($ampur = '') {
        if ($ampur != '6300') {
            $where = " o.distid = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }
        $query = "SELECT COUNT(*) AS B,
                                SUM(IF(r.`DM_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        WHERE r.`BUDGETYEAR` = '$year' AND DM = '1' AND $where";

        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if (!empty($rs['B'])) {
            $PERCENT = ($rs['A'] / $rs['B']) * 100;
        } else {
            $PERCENT = 0;
        }
        return $PERCENT;
    }

    function kpi_ht_control($ampur = '') {
        if ($ampur != '6300') {
            $where = " o.distid = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }
        $query = "SELECT COUNT(*) AS B,
                                SUM(IF(r.`HT_CONTROL` = '1',1,0)) AS A
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        WHERE r.`BUDGETYEAR` = '$year' AND HT = '1' AND $where";

        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if (!empty($rs['B'])) {
            $PERCENT = ($rs['A'] / $rs['B']) * 100;
        } else {
            $PERCENT = 0;
        }
        return $PERCENT;
    }

    function kpi_ht_kidney($ampur = '') {
        if ($ampur != '6300') {
            $where = " o.distid = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $query = "SELECT 
                        SUM(IF(r.HT_KIDNEY = '1',1,0)) AS A,
                        COUNT(*) AS B
                        FROM rpt_chronic_all r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        WHERE r.HT = '1' AND BUDGETYEAR = '$year'  AND $where ";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if (!empty($rs['B'])) {
            $PERCENT = ($rs['A'] / $rs['B']) * 100;
        } else {
            $PERCENT = 0;
        }
        return $PERCENT;
    }

    function ncdscreen_dm($group = '', $ampur = '') {
        if ($ampur != '6300') {
            $where = " d.distid = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $query = "SELECT d.`distid` AS CODE,d.`distname` AS NAMES,IFNULL(SUM(Q1.B),0) B,SUM(A) AS A,SUM(RS_NORMAL) AS RS_NORMAL,SUM(RS_RISK) AS RS_RISK
                        FROM 

                        co_district d

                        LEFT JOIN

                        (
                        SELECT r.`AMPUR`,r.`HOSPCODE`,r.`B`,SUM(r.`A`) AS A,SUM(r.`RS_NORMAL`) AS RS_NORMAL,SUM(r.`RS_RISK`) AS RS_RISK,r.`PERCENT`
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$year' AND r.`NCDGROUP` = '$group'  AND r.NCDTYPE = 'DM' 
                        GROUP BY r.`AMPUR`,r.`HOSPCODE` 
                        ) Q1

                        ON d.`distid` = Q1.AMPUR
                        WHERE d.`distid` != '6300' AND $where
                        GROUP BY d.`distid` ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        $sumB = 0;
        $sumA = 0;
        foreach ($result as $rs):
            $sumB = $sumB + $rs['B'];
            $sumA = $sumA + $rs['A'];
        endforeach;

        if (!empty($sumB)) {
            $PERSENT = ($sumA / $sumB) * 100;
        }

        return $PERSENT;
    }

    function ncdscreen_ht($group = '', $ampur = '') {
        if ($ampur != '6300') {
            $where = " d.distid = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $query = "SELECT d.`distid` AS CODE,d.`distname` AS NAMES,IFNULL(SUM(Q1.B),0) B,SUM(A) AS A,SUM(RS_NORMAL) AS RS_NORMAL,SUM(RS_RISK) AS RS_RISK
                        FROM 

                        co_district d

                        LEFT JOIN

                        (
                        SELECT r.`AMPUR`,r.`HOSPCODE`,r.`B`,SUM(r.`A`) AS A,SUM(r.`RS_NORMAL`) AS RS_NORMAL,SUM(r.`RS_RISK`) AS RS_RISK,r.`PERCENT`
                        FROM rpt_ncdscreen r 
                        WHERE r.`BUDGETYEAR` = '$year' AND r.`NCDGROUP` = '$group'  AND r.NCDTYPE = 'HT' 
                        GROUP BY r.`AMPUR`,r.`HOSPCODE` 
                        ) Q1

                        ON d.`distid` = Q1.AMPUR
                        WHERE d.`distid` != '6300' AND $where
                        GROUP BY d.`distid` ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        $sumB = 0;
        $sumA = 0;
        foreach ($result as $rs):
            $sumB = $sumB + $rs['B'];
            $sumA = $sumA + $rs['A'];
        endforeach;

        if (!empty($sumB)) {
            $PERSENT = ($sumA / $sumB) * 100;
        }

        return $PERSENT;
    }

    function epi_1ege($ampur = "") {
        if ($ampur != '6300') {
            $where = " r.AMPUR = '$ampur' ";
        } else {
            $where = "1=1";
        }
        $yearnow = date("Y");
        $month = date("m");
        if ($month > 9) {
            $year = $yearnow + 1;
        } else {
            $year = $yearnow;
        }

        $query = "SELECT (SUM(r.COMPLETE)/SUM(r.TARGET)*100) AS PERCENT
        FROM rpt_vaccine_1y r
        WHERE r.BUDGETYEAR = '$year'
        AND $where ";

        $result = Yii::app()->db->createCommand($query)->queryRow();

        return $result['PERCENT'];
    }

    function getkpi($groupId) {
        $sql = "SELECT COUNT(*) AS TOTAL,SUM(if(s.kpistatus = 'Y',1,0)) AS KPI
                    FROM sys_reportlist s 
                    WHERE s.menugroup_id = '$groupId' ";
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

}

?>
