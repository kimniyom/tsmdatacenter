<?php

/**
 * Description of Logs
 *
 * @author Sittipong Promhan
 * @create Aug 10, 2016 2:52:42 PM
 * @copyright (c) Tak Provincial Health Office
 */
class Logs {
    
    public static function Insert($fileName,$errorMessage,$note=""){
        $sql = "INSERT INTO sys_error_log(filename,errormsg,note,create_date)
                VALUE('$fileName','$errorMessage','$note',NOW());";
        
        Yii::app()->db->createCommand($sql)->execute();
    }
}

?>
