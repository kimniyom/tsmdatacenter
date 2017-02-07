<?php

class Report_kpi_qof {

    function nhso_anc12week_qof_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_anc12week_qof r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.PERIOD = '$year' AND d.distid != '6300'
                        GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_anc12week_qof_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_anc12week_qof r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.PERIOD = '$year' AND o.distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_labor_anc5_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_labor_anc5_qof r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.PERIOD = '$year' AND d.distid != '6300'
                        GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_labor_anc5_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_labor_anc5_qof r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.PERIOD = '$year' AND o.distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_bweight2500_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_bweight2500 r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.PERIOD = '$year' AND d.distid != '6300'
                        GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_bweight2500_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_bweight2500 r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.PERIOD = '$year' AND o.distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_dtp5_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_dtp5 r INNER JOIN co_office o ON r.HOSPCODE = o.off_id
                        RIGHT JOIN co_district d ON d.distid = o.distid
                        WHERE r.PERIOD = '$year' AND d.distid != '6300'
                        GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function nhso_dtp5_ampur($year = '', $ampur = '') {
        $query = "SELECT o.off_id AS CODE,o.off_name AS NAME,SUM(B) AS B,SUM(A) AS A
                        FROM nhso_dtp5 r LEFT JOIN co_office o ON o.off_id = r.HOSPCODE
                        WHERE r.PERIOD = '$year' AND o.distid = '$ampur'
                        GROUP BY o.off_id 
                        ORDER BY distid,off_type DESC,off_id ASC";

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
