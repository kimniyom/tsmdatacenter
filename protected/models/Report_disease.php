<?php

class Report_disease {

    function Rpt_diag21_ampur_th($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease504 d) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag21_th r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_diag21_nonth($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease504 d) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag21_nonth r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_diag75_th($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease505 d) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag75_th r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_diag75_nonth($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease505 d) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag75_nonth r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_diag19_th($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_diseaseacd d 
                          WHERE d.`recordID` NOT IN ('000001','000002')) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag19_th r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_diag19_nonth($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_diseaseacd d 
                          WHERE d.`recordID` NOT IN ('000001','000002') ) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_diag19_nonth r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }
    
    function Rpt_death103_th($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease103 d ) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_death103_th r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Rpt_death103_nonth($period = '', $where = '') {
        $query = "SELECT 
                        Q1.groupname,
                        Q2.* 
                      FROM
                        (SELECT 
                          d.`groupcode`,
                          d.`groupname` 
                        FROM
                          co_disease103 d ) Q1 
                        LEFT JOIN 
                          (SELECT 
                            r.`GROUPCODE`,
                            SUM(r.`SUM_PID1`) AS PERIOD1,
                            SUM(r.`SUM_PID2`) AS PERIOD2,
                            SUM(r.`SUM_PID3`) AS PERIOD3,
                            SUM(r.`SUM_PID4`) AS PERIOD4,
                            SUM(r.`AMOUNT`) AS AMOUNT 
                          FROM
                            rpt_death103_nonth r 
                          WHERE r.`PERIOD` = '$period' $where
                          GROUP BY r.`GROUPCODE`) Q2 
                          ON Q1.groupcode = Q2.GROUPCODE  ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Getdatequery($table = '') {
        $query = "SELECT MAX(DATE_UPDATE) AS DATE_UPDATE FROM $table LIMIT 1";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['DATE_UPDATE'];
    }

}

?>
