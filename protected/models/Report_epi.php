<?php

class Report_epi {

    function Get_epi_changwat($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.BCG) AS BCG_0,
	SUM(r.HBV1) AS HBV1_0,
	SUM(r.DTPHB3) AS DTPHB3_0,
	SUM(r.OPV3) AS OPV3_0,
	SUM(r.MMR1) AS MMR1_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
	SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
	SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
	SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
	SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
	SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
	SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
	SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
	SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
	SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
	SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
	SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
	SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
	SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
	SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
	SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
	SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_1y r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.BCG) AS BCG_0,
                        SUM(r.HBV1) AS HBV1_0,
                        SUM(r.DTPHB3) AS DTPHB3_0,
                        SUM(r.OPV3) AS OPV3_0,
                        SUM(r.MMR1) AS MMR1_0,
                        SUM(r.COMPLETE) AS COMPLETE_0,

                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
                        SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
                        SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
                        SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
                        SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
                        SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
                        SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
                        SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
                        SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
                        SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
                        SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
                        SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
                        SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
                        SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
                        SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
                        SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
                        SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
                        SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
                        SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
                        SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
                        SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                FROM rpt_vaccine_1y r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.tamboncodefull
                ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.BCG) AS BCG_0,
                        SUM(r.HBV1) AS HBV1_0,
                        SUM(r.DTPHB3) AS DTPHB3_0,
                        SUM(r.OPV3) AS OPV3_0,
                        SUM(r.MMR1) AS MMR1_0,
                        SUM(r.COMPLETE) AS COMPLETE_0,

                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
                        SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
                        SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
                        SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
                        SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
                        SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
                        SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
                        SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
                        SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
                        SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
                        SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
                        SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
                        SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
                        SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
                        SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
                        SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
                        SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
                        SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
                        SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
                        SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
                        SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                FROM rpt_vaccine_1y r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur' AND t.distid = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC  ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    //1 Year Nonthai
     function Get_epi_changwat_nonth($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.BCG) AS BCG_0,
	SUM(r.HBV1) AS HBV1_0,
	SUM(r.DTPHB3) AS DTPHB3_0,
	SUM(r.OPV3) AS OPV3_0,
	SUM(r.MMR1) AS MMR1_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
	SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
	SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
	SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
	SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
	SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
	SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
	SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
	SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
	SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
	SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
	SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
	SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
	SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
	SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
	SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
	SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_1y_nonth r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_nonth($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.BCG) AS BCG_0,
                        SUM(r.HBV1) AS HBV1_0,
                        SUM(r.DTPHB3) AS DTPHB3_0,
                        SUM(r.OPV3) AS OPV3_0,
                        SUM(r.MMR1) AS MMR1_0,
                        SUM(r.COMPLETE) AS COMPLETE_0,

                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
                        SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
                        SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
                        SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
                        SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
                        SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
                        SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
                        SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
                        SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
                        SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
                        SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
                        SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
                        SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
                        SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
                        SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
                        SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
                        SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
                        SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
                        SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
                        SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
                        SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                FROM rpt_vaccine_1y_nonth r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.tamboncodefull
                ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_nonth($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.BCG) AS BCG_0,
                        SUM(r.HBV1) AS HBV1_0,
                        SUM(r.DTPHB3) AS DTPHB3_0,
                        SUM(r.OPV3) AS OPV3_0,
                        SUM(r.MMR1) AS MMR1_0,
                        SUM(r.COMPLETE) AS COMPLETE_0,

                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.BCG,0)) AS BCG_1,
                        SUM(IF(r.PERIOD = '1',r.HBV1,0)) AS HBV1_1,
                        SUM(IF(r.PERIOD = '1',r.DTPHB3,0)) AS DTPHB3_1,
                        SUM(IF(r.PERIOD = '1',r.OPV3,0)) AS OPV3_1,
                        SUM(IF(r.PERIOD = '1',r.MMR1,0)) AS MMR1_1,
                        SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.BCG,0)) AS BCG_2,
                        SUM(IF(r.PERIOD = '2',r.HBV1,0)) AS HBV1_2,
                        SUM(IF(r.PERIOD = '2',r.DTPHB3,0)) AS DTPHB3_2,
                        SUM(IF(r.PERIOD = '2',r.OPV3,0)) AS OPV3_2,
                        SUM(IF(r.PERIOD = '2',r.MMR1,0)) AS MMR1_2,
                        SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.BCG,0)) AS BCG_3,
                        SUM(IF(r.PERIOD = '3',r.HBV1,0)) AS HBV1_3,
                        SUM(IF(r.PERIOD = '3',r.DTPHB3,0)) AS DTPHB3_3,
                        SUM(IF(r.PERIOD = '3',r.OPV3,0)) AS OPV3_3,
                        SUM(IF(r.PERIOD = '3',r.MMR1,0)) AS MMR1_3,
                        SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.BCG,0)) AS BCG_4,
                        SUM(IF(r.PERIOD = '4',r.HBV1,0)) AS HBV1_4,
                        SUM(IF(r.PERIOD = '4',r.DTPHB3,0)) AS DTPHB3_4,
                        SUM(IF(r.PERIOD = '4',r.OPV3,0)) AS OPV3_4,
                        SUM(IF(r.PERIOD = '4',r.MMR1,0)) AS MMR1_4,
                        SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                FROM rpt_vaccine_1y_nonth r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC  ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_changwat_2age($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_2age($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
            WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
            GROUP BY t.tamboncodefull
            ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_2age($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    //2 Year Nonthai
     function Get_epi_changwat_2age_nonth($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y_nonth r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_2age_nonth($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y_nonth r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
            WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
            GROUP BY t.tamboncodefull
            ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_2age_nonth($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.DTP4) AS DTP4_0,
	SUM(r.OPV4) AS OPV4_0,
	SUM(r.J11) AS J11_0,
	SUM(r.COMPLETE) AS COMPLETE_0,
	
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.DTP4,0)) AS DTP4_1,
	SUM(IF(r.PERIOD = '1',r.OPV4,0)) AS OPV4_1,
	SUM(IF(r.PERIOD = '1',r.J11,0)) AS J11_1,
	SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,
	
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.DTP4,0)) AS DTP4_2,
	SUM(IF(r.PERIOD = '2',r.OPV4,0)) AS OPV4_2,
	SUM(IF(r.PERIOD = '2',r.J11,0)) AS J11_2,
	SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.DTP4,0)) AS DTP4_3,
	SUM(IF(r.PERIOD = '3',r.OPV4,0)) AS OPV4_3,
	SUM(IF(r.PERIOD = '3',r.J11,0)) AS J11_3,
	SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.DTP4,0)) AS DTP4_4,
	SUM(IF(r.PERIOD = '4',r.OPV4,0)) AS OPV4_4,
	SUM(IF(r.PERIOD = '4',r.J11,0)) AS J11_4,
	SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4
			
            FROM rpt_vaccine_2y_nonth r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_changwat_age3($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.J12) AS J12_0,
	SUM(r.MMR2) AS MMR2_0,
        
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,
                
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
	SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,
        
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
	SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,
        
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
	SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4
        
            FROM rpt_vaccine_3y r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_age3($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.J12) AS J12_0,
                        SUM(r.MMR2) AS MMR2_0,
                        
                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                        SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
                        SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
                        SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
                        SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4

                FROM rpt_vaccine_3y r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.tamboncodefull
                ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_age3($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.J12) AS J12_0,
                        SUM(r.MMR2) AS MMR2_0,
                        
                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                        SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
                        SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
                        SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,
                        
                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
                        SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4
                        
                FROM rpt_vaccine_3y r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC  ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    
    //3 Year Nonth
    function Get_epi_changwat_age3_nonth($year = '') {
        $query = "SELECT d.distid AS CODE,d.distname AS NAME,
	SUM(r.TARGET) AS B_0,
	SUM(r.J12) AS J12_0,
	SUM(r.MMR2) AS MMR2_0,
        
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,
        
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
                SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
                SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
                SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4
			
            FROM rpt_vaccine_3y_nonth r RIGHT JOIN co_district d ON d.distid = r.AMPUR
            WHERE r.BUDGETYEAR = '$year' 
            GROUP BY d.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_age3_nonth($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                        SUM(r.TARGET) AS B_0,
	SUM(r.J12) AS J12_0,
	SUM(r.MMR2) AS MMR2_0,
        
	SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
	SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,
        
	SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
	SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
                SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,
	
	SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
	SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
                SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,
	
	SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
	SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
                SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4


                FROM rpt_vaccine_3y_nonth r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.tamboncodefull
                ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_age3_nonth($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                        SUM(r.TARGET) AS B_0,
                        SUM(r.J12) AS J12_0,
                        SUM(r.MMR2) AS MMR2_0,

                        SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                        SUM(IF(r.PERIOD = '1',r.J12,0)) AS J12_1,
                                SUM(IF(r.PERIOD = '1',r.MMR2,0)) AS MMR2_1,

                        SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                        SUM(IF(r.PERIOD = '2',r.J12,0)) AS J12_2,
                                SUM(IF(r.PERIOD = '2',r.MMR2,0)) AS MMR2_2,

                        SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                        SUM(IF(r.PERIOD = '3',r.J12,0)) AS J12_3,
                                SUM(IF(r.PERIOD = '3',r.MMR2,0)) AS MMR2_3,

                        SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                        SUM(IF(r.PERIOD = '4',r.J12,0)) AS J12_4,
                                SUM(IF(r.PERIOD = '4',r.MMR2,0)) AS MMR2_4

                FROM rpt_vaccine_3y_nonth r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                GROUP BY t.off_id
                ORDER BY distid,off_type DESC,off_id ASC  ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    function Get_epi_changwat_age5($year = '') {
        $query = "SELECT t.distid AS CODE,t.distname AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y r RIGHT JOIN co_district t ON t.distid = r.AMPUR
                    WHERE r.BUDGETYEAR = '$year' 
                    GROUP BY t.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_age5($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                    WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                    GROUP BY t.tamboncodefull
                    ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_age5($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                    WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                    GROUP BY t.off_id
                    ORDER BY distid,off_type DESC,off_id ASC  ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
    
    //5 Year Nonth
    function Get_epi_changwat_age5_nonth($year = '') {
        $query = "SELECT t.distid AS CODE,t.distname AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y_nonth r RIGHT JOIN co_district t ON t.distid = r.AMPUR
                    WHERE r.BUDGETYEAR = '$year' 
                    GROUP BY t.distid ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_tambon_age5_nonth($year = '', $ampur = '') {
        $query = "SELECT t.tamboncodefull AS CODE,t.tambonname AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y_nonth r RIGHT JOIN ctambon t ON t.tamboncodefull = r.TAMBON
                    WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                    GROUP BY t.tamboncodefull
                    ORDER BY r.TAMBON,t.tamboncodefull ";

        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_epi_pcu_age5_nonth($year = '', $ampur = '') {
        $query = "SELECT t.off_id AS CODE,t.off_name AS NAME,
                            SUM(r.TARGET) AS B_0,
                            SUM(r.DTP5) AS DTP5_0,
                            SUM(r.OPV5) AS OPV5_0,
                            SUM(r.COMPLETE) AS COMPLETE_0,

                            SUM(IF(r.PERIOD = '1',r.TARGET,0)) AS B_1,
                            SUM(IF(r.PERIOD = '1',r.DTP5,0)) AS DTP5_1,
                            SUM(IF(r.PERIOD = '1',r.OPV5,0)) AS OPV5_1,
                            SUM(IF(r.PERIOD = '1',r.COMPLETE,0)) AS COMPLETE_1,

                            SUM(IF(r.PERIOD = '2',r.TARGET,0)) AS B_2,
                            SUM(IF(r.PERIOD = '2',r.DTP5,0)) AS DTP5_2,
                            SUM(IF(r.PERIOD = '2',r.OPV5,0)) AS OPV5_2,
                            SUM(IF(r.PERIOD = '2',r.COMPLETE,0)) AS COMPLETE_2,

                            SUM(IF(r.PERIOD = '3',r.TARGET,0)) AS B_3,
                            SUM(IF(r.PERIOD = '3',r.DTP5,0)) AS DTP5_3,
                            SUM(IF(r.PERIOD = '3',r.OPV5,0)) AS OPV5_3,
                            SUM(IF(r.PERIOD = '3',r.COMPLETE,0)) AS COMPLETE_3,

                            SUM(IF(r.PERIOD = '4',r.TARGET,0)) AS B_4,
                            SUM(IF(r.PERIOD = '4',r.DTP5,0)) AS DTP5_4,
                            SUM(IF(r.PERIOD = '4',r.OPV5,0)) AS OPV5_4,
                            SUM(IF(r.PERIOD = '4',r.COMPLETE,0)) AS COMPLETE_4


                    FROM rpt_vaccine_5y_nonth r RIGHT JOIN co_office t ON t.off_id = r.HOSPCODE
                    WHERE r.BUDGETYEAR = '$year' AND r.AMPUR = '$ampur'
                    GROUP BY t.off_id
                    ORDER BY distid,off_type DESC,off_id ASC  ";

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
