<?php

class Report_r506 {

    function get_month() {
        $thaimonth = array("มกราคม"
            , "กุมภาพันธ์"
            , "มีนาคม"
            , "เมษายน"
            , "พฤษภาคม"
            , "มิถุนายน"
            , "กรกฎาคม"
            , "สิงหาคม"
            , "กันยายน"
            , "ตุลาคม"
            , "พฤศจิกายน"
            , "ธันวาคม");
        return $thaimonth;
    }

    function get_group_506() {
        $sql = "SELECT * FROM group_disease_r506";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_disease_code() {
        $sql = "SELECT * FROM mas_disease_r506";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_office_506($amphur = '') {
        $sql = "SELECT HOSP_CODE,HOSP_NAME FROM office_r506 WHERE LEFT(HOSP_CODE,4) = '$amphur' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_value_5year($year = '', $mount = '', $disease = '', $w = '') {

        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }
        $sql = "SELECT 
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-4 AND SUBSTR(r.`DATEDEFINE`,6,2) = '$mount',1,0)) AS year1,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-3 AND SUBSTR(r.`DATEDEFINE`,6,2) = '$mount',1,0)) AS year2,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-2 AND SUBSTR(r.`DATEDEFINE`,6,2) = '$mount',1,0)) AS year3,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-1 AND SUBSTR(r.`DATEDEFINE`,6,2) = '$mount',1,0)) AS year4,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year' AND SUBSTR(r.`DATEDEFINE`,6,2) = '$mount',1,0)) AS year5
                    FROM r506 r WHERE $where";
        return Yii::app()->db->createCommand($sql)->queryRow();
        //return $sql;
    }

    function getAgeName() { // ชื่อช่วงอายุ
        $sql = "SELECT PP_ID,PP_NAME,ORDER_NUMBER
                FROM population_NAME
                ORDER BY ORDER_NUMBER";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_gentable_r506_amphur($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }
        $sql = "SELECT 
                    Q1.amphur AS district,
                    Q1.distname,
                    IFNULL(Q1.TOTAL, '0') AS PERSON,
                    IFNULL(Q2.TOTAL, '0') AS TOTAL,
                    IFNULL(((Q2.TOTAL * 100000) / Q1.TOTAL), '0') AS AVG,
                    IFNULL(Q2.DEATH, '0') AS DEATH,
                    IFNULL(((Q2.DEATH * 100000) / Q1.TOTAL), '0') AS AVG_DEATH 
                  FROM
                    (SELECT 
                      r.`AMPUR` AS amphur,
                      d.distname,
                      (SUM(r.`MALE`) + SUM(r.`FEMALE`)) AS TOTAL 
                    FROM
                      rpt_pop_th r 
                      INNER JOIN co_district d 
                        ON r.`AMPUR` = d.`distid` 
                    WHERE r.`BUDGETYEAR` = '$year' 
                      AND d.`distid` != '6300' 
                    GROUP BY d.`distid`) Q1 
                    LEFT JOIN 
                      (SELECT 
                        LEFT(r.ADDRCODE, 4) AS amphur,
                        COUNT(*) AS TOTAL,
                        SUM(IF(r.`RESULT` = '2', 1, 0)) AS DEATH 
                      FROM
                        r506 r 
                      WHERE LEFT(r.DATEDEFINE, 4) = '$year' AND $where
                      GROUP BY LEFT(r.ADDRCODE, 4)) Q2 
                      ON Q1.amphur = Q2.amphur ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_gentable_r506_pcu($year = '', $disease = '', $amphur = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) ";
        } else {
            $where = " r.DISEASE = '$disease' ";
        }

        $sql = "SELECT 
                    Q1.HOSPCODE AS district,
                    Q1.off_name AS distname,
                    IFNULL(Q1.TOTAL, '0') AS PERSON,
                    IFNULL(Q2.TOTAL, '0') AS TOTAL,
                    IFNULL(((Q2.TOTAL * Q1.TOTAL) / 100000), '0') AS AVG,
                    IFNULL(Q2.DEATH, '0') AS DEATH,
                    IFNULL(((Q2.DEATH * Q1.TOTAL) / 100000), '0') AS AVG_DEATH 
                  FROM
                    (SELECT 
                      o.`off_id` AS HOSPCODE,
                      o.`off_name`,
                      (SUM(r.`MALE`) + SUM(r.`FEMALE`)) AS TOTAL 
                    FROM
                      rpt_pop_th r 
                      RIGHT JOIN co_office o
                        ON  o.`off_id` = r.`HOSPCODE`
                    WHERE r.`BUDGETYEAR` = '$year' 
			AND o.`distid` = '$amphur'
                      AND o.`distid` != '6300' 
                      AND hasdata = 'Y'
                    GROUP BY o.`off_id`) Q1 
                    LEFT JOIN 
                      (SELECT 
                        r.`ADDRCODE`,o.`VILLCODE`,o.`VILLNAME`,co.off_id AS HOSPCODE,
                        COUNT(*) AS TOTAL,
                        SUM(IF(r.`RESULT` = '2', 1, 0)) AS DEATH 
                      FROM
                        r506 r INNER JOIN co_village_hospital o ON r.`ADDRCODE` = o.`VILLCODE`
			INNER JOIN co_office co ON o.`HOSPCODE` = co.`off_id`
                      WHERE LEFT(r.DATEDEFINE, 4) = '$year' 
			AND $where
			AND LEFT(r.`ADDRCODE`,4) = '$amphur'
                      GROUP BY o.`HOSPCODE`) Q2 
                      ON Q1.HOSPCODE = Q2.HOSPCODE ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_gentable_r506_singlepcu($year = '', $disease = '', $pcu = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) ";
        } else {
            $where = " r.DISEASE = '$disease' ";
        }

        $sql = "SELECT Q1.VILLCODE AS district,Q1.distname,
                    IFNULL(Q1.TOTAL,'0') AS PERSON,
                    IFNULL(Q2.TOTAL,'0') AS TOTAL,
                    IFNULL(FORMAT(((Q2.TOTAL * Q1.TOTAL)/100000),2),'0') AS AVG,
                    IFNULL(Q2.DEATH,'0') AS DEATH,
                    IFNULL(FORMAT(((Q2.DEATH * Q1.TOTAL)/100000),2), '0') AS AVG_DEATH
                    FROM	
                                (
                                    SELECT o.`VILLCODE`,o.`VILLNAME` AS distname,(SUM(r.`MALE`)+SUM(r.`FEMALE`)) AS TOTAL
                                    FROM rpt_pop_th r INNER JOIN co_village_hospital o ON r.`VILLAGE` = o.`VILLCODE`
                                    WHERE r.`BUDGETYEAR` = '$year' 
                                    AND r.`HOSPCODE` = '$pcu'
                       GROUP BY o.`VILLCODE`
		) Q1
                
		LEFT JOIN
                
		(
			SELECT r.ADDRCODE,COUNT(*) AS TOTAL,SUM(IF(r.`RESULT` = '2',1,0)) AS DEATH
			FROM r506 r INNER JOIN co_village_hospital o ON r.`ADDRCODE` = o.`VILLCODE`
			WHERE LEFT(r.DATEDEFINE,4) = '$year' AND o.`HOSPCODE` = '$pcu' AND $where
			GROUP BY r.ADDRCODE
		) Q2
                    ON Q1.VILLCODE = Q2.ADDRCODE ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_gentable_r506_amphurnonthai($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }
        $sql = "SELECT 
                    Q1.amphur AS district,
                    Q1.distname,
                    IFNULL(Q1.TOTAL, '0') AS PERSON,
                    IFNULL(Q2.TOTAL, '0') AS TOTAL,
                    IFNULL(((Q2.TOTAL * 100000) / Q1.TOTAL), '0') AS AVG,
                    IFNULL(Q2.DEATH, '0') AS DEATH,
                    IFNULL(((Q2.DEATH * 100000) / Q1.TOTAL), '0') AS AVG_DEATH 
                  FROM
                    (SELECT 
                      LEFT(r.`VILLAGE`, 4) AS amphur,
                      d.distname,
                      (SUM(r.`MAN`) + SUM(r.`WOMAN`)) AS TOTAL 
                    FROM
                      rpt_pop_village_nonth r 
                      INNER JOIN co_district d 
                        ON LEFT(r.`VILLAGE`, 4) = d.`distid` 
                    WHERE r.`PERIOD` = '$year' 
                      AND d.`distid` != '6300' 
                    GROUP BY d.`distid`) Q1 
                    LEFT JOIN 
                      (SELECT 
                        LEFT(r.ADDRCODE, 4) AS amphur,
                        COUNT(*) AS TOTAL,
                        SUM(IF(r.`RESULT` = '2', 1, 0)) AS DEATH 
                      FROM
                        r506 r 
                      WHERE LEFT(r.DATEDEFINE, 4) = '$year' AND $where
                      GROUP BY LEFT(r.ADDRCODE, 4)) Q2 
                      ON Q1.amphur = Q2.amphur ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_gentable_r506_pcunonthai($year = '', $disease = '', $amphur = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) ";
        } else {
            $where = " r.DISEASE = '$disease' ";
        }

        $sql = "SELECT Q1.amphur as district,Q1.distname,
                    IFNULL(Q1.TOTAL,'0') AS PERSON,
                    IFNULL(Q2.TOTAL,'0') AS TOTAL,
                    IFNULL(((Q2.TOTAL * 100000)/Q1.TOTAL),'0') AS AVG,
                    IFNULL(Q2.DEATH,'0') AS DEATH,
                    IFNULL(((Q2.DEATH * 100000) / Q1.TOTAL), '0') AS AVG_DEATH
                    FROM	
                                (
                                    SELECT LEFT(l.`HOSP_CODE`,4) AS district,l.`HOSP_CODE`,l.`off_id` AS amphur,l.`off_name` AS distname,(SUM(r.`MAN`)+SUM(r.`WOMAN`)) AS TOTAL
                                    FROM rpt_pop_village_nonth r INNER JOIN office_r506 l ON r.`HOSPCODE` = l.`off_id`
                                    WHERE r.`PERIOD` = '$year' 
                                    AND LEFT(r.`VILLAGE`,4) = '$amphur'
                       GROUP BY l.off_id
		) Q1
                
		LEFT JOIN
                
		(
			SELECT r.ADDRCODE AS amphur,COUNT(*) AS TOTAL,SUM(IF(r.`RESULT` = '2',1,0)) AS DEATH
			FROM r506 r
			WHERE LEFT(r.DATEDEFINE,4) = '$year' AND LEFT(r.ADDRCODE,4) = '$amphur' AND $where
			GROUP BY r.ADDRCODE
		) Q2
                    ON Q1.HOSP_CODE = Q2.amphur
                    WHERE Q1.district = '$amphur' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_gentable_r506_singlepcunonthai($year = '', $disease = '', $pcu = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) ";
        } else {
            $where = " r.DISEASE = '$disease' ";
        }

        $sql = "SELECT Q1.amphur as district,Q1.distname,
                    IFNULL(Q1.TOTAL,'0') AS PERSON,
                    IFNULL(Q2.TOTAL,'0') AS TOTAL,
                    IFNULL(((Q2.TOTAL * 100000)/Q1.TOTAL),'0') AS AVG,
                    IFNULL(Q2.DEATH,'0') AS DEATH,
                    IFNULL(((Q2.DEATH * 100000) / Q1.TOTAL), '0') AS AVG_DEATH
                    FROM	
                                (
                                    SELECT l.`HOSP_CODE` AS district,l.`HOSP_CODE`,l.`off_id` AS amphur,l.`off_name` AS distname,(SUM(r.`MAN`)+SUM(r.`WOMAN`)) AS TOTAL
                                    FROM rpt_pop_village_nonth r INNER JOIN office_r506 l ON r.`HOSPCODE` = l.`off_id`
                                    WHERE r.`PERIOD` = '$year' 
                                    AND `VILLAGE` = '$pcu'
                       GROUP BY l.off_id
		) Q1
                
		LEFT JOIN
                
		(
			SELECT r.ADDRCODE AS amphur,COUNT(*) AS TOTAL,SUM(IF(r.`RESULT` = '2',1,0)) AS DEATH
			FROM r506 r
			WHERE LEFT(r.DATEDEFINE,4) = '$year' AND r.ADDRCODE = '$pcu' AND $where
			GROUP BY r.ADDRCODE
		) Q2
                    ON Q1.HOSP_CODE = Q2.amphur
                    WHERE Q1.district = '$pcu' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
        //return $sql;
    }

    function get_week_5year($year = '', $mount = '', $disease = '', $w = '') {

        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }

        $sql = "SELECT 
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-4 AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year1,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-3 AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year2,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-2 AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year3,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year'-1 AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year4,
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year' AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year5
                    FROM r506 r WHERE $where";
        return Yii::app()->db->createCommand($sql)->queryRow();
        //return $sql;
    }

    function get_result_group_pcu($year = '', $mount = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }
        $sql = "SELECT 
                    SUM(IF(LEFT(r.`DATEDEFINE`,4) = '$year' AND WEEK(r.`DATEDEFINE`) = '$mount',1,0)) AS year5
                    FROM r506 r WHERE $where";
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    function get_in_group($group = '') {
        $sql = "SELECT r.DIS,r.NDIS
                    FROM mas_disease_r506 r
                    WHERE r.TDIS = '$group' ";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        $disease = array();
        foreach ($result as $rs) {
            $disease[] = "'" . $rs['DIS'] . "'";
        }

        $disease_code = implode(",", $disease);
        return $disease_code;
    }

    function get_order_disease_506($year = '', $w = '') {
        $sql = "SELECT r.DISEASE AS DISEASE_CODE,m.NAME_THAI AS DISEASE_NAME,COUNT(*) AS TOTAL
                    FROM r506 r INNER JOIN mas_disease_r506 m ON r.DISEASE = m.DIS
                    WHERE LEFT(r.DATEDEFINE,4) = '$year' $w
                    GROUP BY r.DISEASE
                    ORDER BY TOTAL DESC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_population_all($year = '') {
        $sql = "SELECT (SUM(r.`MAN`)+SUM(r.`WOMAN`)) AS TOTAL
                        FROM rpt_pop_village_th r 
                        WHERE r.`PERIOD` = '$year'";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    function get_population_amphur($year = '', $amphur = '') {

        $sql = "SELECT (SUM(r.`MAN`)+SUM(r.`WOMAN`)) AS TOTAL
                        FROM rpt_pop_village_th r 
                        WHERE r.`PERIOD` = '$year' AND LEFT(r.`VILLAGE`,4) = '$amphur' ";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    function get_population_tambon($year = '', $office = '') {
        $pcu = substr($office, 0, 6);
        $sql = "SELECT (SUM(r.`MAN`)+SUM(r.`WOMAN`)) AS TOTAL
                        FROM rpt_pop_village_th r 
                        WHERE r.`PERIOD` = '$year' AND LEFT(r.`VILLAGE`,6) = '$pcu' ";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    function get_result_age_506($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }

        $sql = "SELECT 
                    IFNULL(SUM(IF(r.AGEY > 0 AND r.AGEY <= 4,1,0)),0) AS AGE0TO4,
                    IFNULL(SUM(IF(r.AGEY >= 5 AND r.AGEY <= 9,1,0)),0)  AS AGE5TO9,
                    IFNULL(SUM(IF(r.AGEY >= 10 AND r.AGEY <= 14,1,0)),0)  AS AGE10TO14,
                    IFNULL(SUM(IF(r.AGEY >= 15 AND r.AGEY <= 19,1,0)),0)  AS AGE15TO19,
                    IFNULL(SUM(IF(r.AGEY >= 20 AND r.AGEY <= 24,1,0)),0)  AS AGE20TO24,
                    IFNULL(SUM(IF(r.AGEY >= 25 AND r.AGEY <= 29,1,0)),0)  AS AGE25TO29,
                    IFNULL(SUM(IF(r.AGEY >= 30 AND r.AGEY <= 34,1,0)),0)  AS AGE30TO34,
                    IFNULL(SUM(IF(r.AGEY >= 35 AND r.AGEY <= 39,1,0)),0)  AS AGE35TO39,
                    IFNULL(SUM(IF(r.AGEY >= 40 AND r.AGEY <= 44,1,0)),0)  AS AGE40TO44,
                    IFNULL(SUM(IF(r.AGEY >= 45 AND r.AGEY <= 49,1,0)),0)  AS AGE45TO49,
                    IFNULL(SUM(IF(r.AGEY >= 50 AND r.AGEY <= 54,1,0)),0)  AS AGE50TO54,
                    IFNULL(SUM(IF(r.AGEY >= 55 AND r.AGEY <= 59,1,0)),0)  AS AGE55TO59,
                    IFNULL(SUM(IF(r.AGEY >= 60 AND r.AGEY <= 64,1,0)),0)  AS AGE60TO64,
                    IFNULL(SUM(IF(r.AGEY >= 65 AND r.AGEY <= 69,1,0)),0)  AS AGE65TO69,
                    IFNULL(SUM(IF(r.AGEY >= 70 AND r.AGEY <= 74,1,0)),0)  AS AGE70TO74,
                    IFNULL(SUM(IF(r.AGEY >= 75 AND r.AGEY <= 79,1,0)),0)  AS AGE75TO79,
                    IFNULL(SUM(IF(r.AGEY >= 80 AND r.AGEY <= 84,1,0)),0)  AS AGE80TO84,
                    IFNULL(SUM(IF(r.AGEY >= 85 AND r.AGEY <= 89,1,0)),0)  AS AGE85TO89,
                    IFNULL(SUM(IF(r.AGEY >= 90 AND r.AGEY <= 94,1,0)),0)  AS AGE90TO94,
                    IFNULL(SUM(IF(r.AGEY >= 95 AND r.AGEY <= 99,1,0)),0)  AS AGE95TO99,
                    IFNULL(SUM(IF(r.AGEY >= 100,1,0)),0)  AS AGE100
                    FROM r506 r
                    WHERE LEFT(r.DATEDEFINE,4) = '$year' AND $where ";
        //return $this->db->query($sql)->row();
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    function get_result_death_506($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }

        $sql = "SELECT 
                    IFNULL(SUM(IF(r.AGEY > 0 AND r.AGEY <= 4,1,0)),0) AS AGE0TO4,
                    IFNULL(SUM(IF(r.AGEY >= 5 AND r.AGEY <= 9,1,0)),0)  AS AGE5TO9,
                    IFNULL(SUM(IF(r.AGEY >= 10 AND r.AGEY <= 14,1,0)),0)  AS AGE10TO14,
                    IFNULL(SUM(IF(r.AGEY >= 15 AND r.AGEY <= 19,1,0)),0)  AS AGE15TO19,
                    IFNULL(SUM(IF(r.AGEY >= 20 AND r.AGEY <= 24,1,0)),0)  AS AGE20TO24,
                    IFNULL(SUM(IF(r.AGEY >= 25 AND r.AGEY <= 29,1,0)),0)  AS AGE25TO29,
                    IFNULL(SUM(IF(r.AGEY >= 30 AND r.AGEY <= 34,1,0)),0)  AS AGE30TO34,
                    IFNULL(SUM(IF(r.AGEY >= 35 AND r.AGEY <= 39,1,0)),0)  AS AGE35TO39,
                    IFNULL(SUM(IF(r.AGEY >= 40 AND r.AGEY <= 44,1,0)),0)  AS AGE40TO44,
                    IFNULL(SUM(IF(r.AGEY >= 45 AND r.AGEY <= 49,1,0)),0)  AS AGE45TO49,
                    IFNULL(SUM(IF(r.AGEY >= 50 AND r.AGEY <= 54,1,0)),0)  AS AGE50TO54,
                    IFNULL(SUM(IF(r.AGEY >= 55 AND r.AGEY <= 59,1,0)),0)  AS AGE55TO59,
                    IFNULL(SUM(IF(r.AGEY >= 60 AND r.AGEY <= 64,1,0)),0)  AS AGE60TO64,
                    IFNULL(SUM(IF(r.AGEY >= 65 AND r.AGEY <= 69,1,0)),0)  AS AGE65TO69,
                    IFNULL(SUM(IF(r.AGEY >= 70 AND r.AGEY <= 74,1,0)),0)  AS AGE70TO74,
                    IFNULL(SUM(IF(r.AGEY >= 75 AND r.AGEY <= 79,1,0)),0)  AS AGE75TO79,
                    IFNULL(SUM(IF(r.AGEY >= 80 AND r.AGEY <= 84,1,0)),0)  AS AGE80TO84,
                    IFNULL(SUM(IF(r.AGEY >= 85 AND r.AGEY <= 89,1,0)),0)  AS AGE85TO89,
                    IFNULL(SUM(IF(r.AGEY >= 90 AND r.AGEY <= 94,1,0)),0)  AS AGE90TO94,
                    IFNULL(SUM(IF(r.AGEY >= 95 AND r.AGEY <= 99,1,0)),0)  AS AGE95TO99,
                    IFNULL(SUM(IF(r.AGEY >= 100,1,0)),0)  AS AGE100
                    FROM r506 r
                    WHERE LEFT(r.DATEDEFINE,4) = '$year' AND $where AND r.result = '2' ";
        return Yii::app()->db->createCommand($sql)->queryRow();
        //return $sql;
    }

    function get_result_ocupation_r506($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }

        $sql = "SELECT Q1.OCC_NO,Q1.OCC_NAME,IFNULL(Q2.TOTAL,0) AS RESULT
                    FROM
                    (
                            SELECT o.OCC_NO,o.OCC_NAME
                            FROM occupation_r506 o 
                    ) Q1

                    LEFT JOIN

                    (
                            SELECT r.OCCUPAT,COUNT(*) AS TOTAL
                            FROM r506 r 
                            WHERE LEFT(r.DATEDEFINE,4) = '$year' AND $where
                            GROUP BY r.OCCUPAT
                    ) Q2

                    ON Q1.OCC_NO = Q2.OCCUPAT ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_result_ocupation_death_r506($year = '', $disease = '', $w = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " r.DISEASE IN($group_direase) $w";
        } else {
            $where = " r.DISEASE = '$disease' $w";
        }

        $sql = "SELECT Q1.OCC_NO,Q1.OCC_NAME,IFNULL(Q2.TOTAL,0) AS RESULT
                    FROM
                    (
                            SELECT o.OCC_NO,o.OCC_NAME
                            FROM occupation_r506 o 
                    ) Q1

                    LEFT JOIN

                    (
                            SELECT r.OCCUPAT,COUNT(*) AS TOTAL
                            FROM r506 r 
                            WHERE LEFT(r.DATEDEFINE,4) = '$year' AND $where  AND r.result = '2'
                            GROUP BY r.OCCUPAT
                    ) Q2

                    ON Q1.OCC_NO = Q2.OCCUPAT ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function Getmedian_all($year = '', $w = '', $disease) {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }

        $yearend = ($year - 1);
        $yearstart = ($yearend - 4);
        $query = "
                        SELECT Q1.id,Q1.month_th,Q2.TOTAL
                        FROM 

                        (
                        SELECT m.`id`,`month_th`
                        FROM mas_month m
                        ) Q1

                        LEFT JOIN

                        (
                        SELECT 
                        M,
                        COUNT(*) AS TOTAL,
                        CAST((COUNT(*) / 2) AS INT)-1,
                        IF(COUNT(*) MOD 2 = 0,2,1)
                        FROM 
                        (SELECT YEAR(datedefine),MONTH(datedefine) M,COUNT(*) AS amount FROM r506 
                        WHERE YEAR(datedefine) BETWEEN '$yearstart' AND '$yearend' $where
                        GROUP BY YEAR(datedefine),MONTH(datedefine)
                        ORDER BY amount) q
                        GROUP BY M
                        ) Q2
                        ON Q1.id = Q2.M";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Getmedian_result($year = '', $w = '', $disease = '', $month = '', $total = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }
        $yearend = ($year - 1);
        $yearstart = ($yearend - 4);

        if ($total == '5') {
            $LIMIT = "LIMIT 2,1";
            $result = $this->Getquerynondouble($yearstart, $yearend, $month, $where, $LIMIT);
            return $result['amount'];
        } else {
            return "0";
        }
    }

    function Getquerynondouble($yearstart, $yearend, $month, $where, $LIMIT) {
        $query = "SELECT YEAR(datedefine) AS year,COUNT(*) AS  amount FROM r506 
                    WHERE YEAR(datedefine) BETWEEN '$yearstart' AND '$yearend' AND MONTH(datedefine) = '$month' $where
                    GROUP BY YEAR(datedefine)
                    ORDER BY amount
                    $LIMIT";
        return Yii::app()->db->createCommand($query)->queryRow();
    }

    function Getmedian_mountnow($year, $w, $disease, $join) {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }
        $query = "SELECT Q1.id,Q1.month_th,IFNULL(Q2.TOTAL,0) AS TOTAL
                        FROM 

                        (
                        SELECT m.`id`,`month_th`
                        FROM mas_month m
                        ) Q1

                        LEFT JOIN

                        (
                        SELECT 
                        MONTH(datedefine) AS M,
                        COUNT(*) AS TOTAL
                        FROM r506 $join
                        WHERE YEAR(datedefine) = '$year' $where
                        GROUP BY MONTH(datedefine)
                        ) Q2
                        ON Q1.id = Q2.M ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($result as $rs):
            $varArr[] = $rs['TOTAL'];
        endforeach;
        $value = implode(",", $varArr);
        return $value;
    }

    function Getmedian_allweek($year = '', $w = '', $disease = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }

        $yearend = ($year - 1);
        $yearstart = ($yearend - 4);
        $query = "
                        SELECT q1.week,IFNULL(q2.TOTAL,0) AS TOTAL
                        FROM
                        (SELECT week
                        FROM mas_week
                        ) q1 
                        LEFT JOIN
                        (
                        SELECT 
                        M,
                        COUNT(*) AS TOTAL,
                        CAST((COUNT(*) / 2) AS INT)-1,
                        IF(COUNT(*) MOD 2 = 0,2,1)
                        FROM 
                        (SELECT YEAR(datedefine),WEEK(datedefine) M,COUNT(*) AS amount FROM r506 
                        WHERE YEAR(datedefine) BETWEEN '$yearstart' AND '$yearend' $where
                        GROUP BY YEAR(datedefine),WEEK(datedefine)
                        ORDER BY amount) q
                        GROUP BY M
                        ) q2
                        ON q1.week = q2.M
                        ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Getmedian_resultweek($year = '', $w = '', $disease = '', $week = '', $total = '') {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }
        $yearend = ($year - 1);
        $yearstart = ($yearend - 4);

        if ($total == '5') {
            $LIMIT = "LIMIT 2,1";
            $result = $this->Getquerynondoubleweek($yearstart, $yearend, $week, $where, $LIMIT);
            return $result['amount'];
        } else {
            return "0";
        }
    }

    function Getquerynondoubleweek($yearstart, $yearend, $week, $where, $LIMIT) {
        $query = "SELECT YEAR(datedefine) AS year,COUNT(*) AS  amount 
                        FROM r506 
                        WHERE YEAR(datedefine) BETWEEN '$yearstart' AND '$yearend' AND WEEK(datedefine) = '$week' $where
                        GROUP BY YEAR(datedefine)
                        ORDER BY amount
                    $LIMIT";
        return Yii::app()->db->createCommand($query)->queryRow();
    }

    function Getmedian_weeknow($year, $w, $disease, $join) {
        if (substr($disease, 0, 1) == 'G') {
            $group = substr($disease, -2);
            $group_direase = $this->get_in_group($group);
            $where = " AND DISEASE IN($group_direase) $w";
        } else {
            $where = " AND DISEASE = '$disease' $w";
        }
        $query = "SELECT q1.week,IFNULL(q2.TOTAL,0) AS TOTAL
                        FROM
                        (SELECT week
                        FROM mas_week
                        ) q1
                        LEFT JOIN
                        (
                        SELECT 
                        week(datedefine) AS M,
                        COUNT(*) AS TOTAL
                        FROM r506 $join
                        WHERE YEAR(datedefine) = '$year' $where
                        GROUP BY WEEK(datedefine)
                        ) q2
                        ON q1.week = q2.M
                        ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($result as $rs):
            $varArr[] = $rs['TOTAL'];
        endforeach;
        $value = implode(",", $varArr);
        return $value;
    }

    function List_disease_506($year = '', $ampur = '') {
        if ($ampur != '6300') {
            $where = " AND LEFT(ADDRCODE,4) = '$ampur' ";
        } else {
            $where = " AND 1=1";
        }
        $query = "SELECT m.DIS,m.NAME_THAI,COUNT(*) AS TOTAL
                        FROM r506 r INNER JOIN mas_disease_r506 m ON r.DISEASE = m.DIS
                        WHERE LEFT(r.DATEDEFINE,4) = '$year' AND r.RACE = '1' $where
                        GROUP BY m.DIS
                        ORDER BY COUNT(*) DESC ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    function Sumperson($year = '', $ampur = '') {
        if ($ampur != '6300') {
            $where = " AND AMPUR = '$ampur' ";
        } else {
            $where = " AND 1=1";
        }
        $query = "SELECT SUM(MALE)+SUM(FEMALE) AS TOTAL
                        FROM rpt_pop_th 
                        WHERE BUDGETYEAR = '$year' $where";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        return $rs['TOTAL'];
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


