<?php

class ReportPerson_Model {

    function get_ampur_all() {
        $sql = "SELECT o.distid AS amphur,o.distname AS ampurname,o.distname_en AS ampurname_en
                    FROM co_district_pop o WHERE o.distid != '6300' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_pcu_inampur($distid = '') {
        $sql = "SELECT o.off_id AS amphur,o.off_name AS ampurname,o.off_name_en AS ampurname_en
                    FROM co_office_pop o 
                    WHERE (o.distid = '$distid' OR o.distid = '6399') AND hasdata = 'Y' ORDER BY distid,off_type DESC,off_id ASC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_codeitems($id = '') {
        $sql = "SELECT item_code FROM sys_items WHERE id = '$id' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['item_code'];
    }

    function get_village_inpcu($hospcode = '') {
        /*
          $sql = "SELECT item_code AS amphur,item_name AS ampurname
          FROM sys_items s
          WHERE s.`item_group_id` = '9'
          AND s.`upper_item_id` = '$id' ";
         * 
         */
        $sql = "SELECT VILLCODE AS amphur,VILLNAME AS ampurname FROM co_village_hospital WHERE HOSPCODE = '$hospcode' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_tambon_inampur($distId = '') {
        $sql = "SELECT 
                    tamboncodefull AS amphur,tambonname as ampurname
                FROM 
                    ctambon c
                WHERE 
                    c.ampurcode = '$distId' 
                AND c.changwatcode = '63'
                ORDER BY tamboncodefull ASC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_village_intambon($tambonId = '') {
        $sql = "SELECT 
                    villagecodefull AS amphur,villagename as ampurname
                FROM 
                    cvillage c
                WHERE 
                    c.tamboncode = '$tambonId' 
                AND c.changwatcode = '63'
                ORDER BY villagecodefull ASC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_village($villId = '') {
        $sql = "SELECT 
                    villagecodefull AS amphur,villagename as ampurname
                FROM 
                    cvillage c
                WHERE 
                    c.villagecodefull = '$villId' 
                AND c.changwatcode = '63'
                ORDER BY villagecodefull ASC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function getdate_process($Table = '') {
        $sql = "SELECT DATE_UPDATE
                    FROM $Table
                    ORDER BY DATE_UPDATE DESC 
                    LIMIT 1 ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['DATE_UPDATE'];
    }

    /* ปิรมิด ไทย */

    function getpyramidman($where = '') {
        $query = "SELECT IFNULL(SUM(r.`MALE`),0) AS MAN
                        FROM rpt_pop_th r
                        WHERE $where";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['MAN'];
    }

    function getpyramidwoman($where = '') {
        $query = "SELECT IFNULL(SUM(r.`FEMALE`),0) AS WOMAN
                        FROM rpt_pop_th r
                        WHERE  $where";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['WOMAN'];
    }

    /* ปิรมิด ต่างชาติ */

    function getpyramidmannothai($where = '') {
        $query = "SELECT IFNULL(SUM(r.`MALE`),0) AS MAN
                        FROM rpt_pop_nth r
                        WHERE $where";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['MAN'];
    }

    function getpyramidwomannothai($where = '') {
        $query = "SELECT IFNULL(SUM(r.`FEMALE`),0) AS WOMAN
                        FROM rpt_pop_nth r
                        WHERE  $where";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['WOMAN'];
    }

}

?>
