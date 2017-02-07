<?php


/**
 * Description of BackedController
 *
 * @author Sittipong Promhan
 * @create Aug 1, 2016 11:18:59 AM
 * @copyright (c) Tak Provincial Health Office
 */
class BackendController extends Controller{
    
    public $layout = "backend";
     
    public function actionIndex() {
        $this->render('index');
    }
    
    public function actionGetreportList($groupid = null, $groupname = null) {
        $groupModel = new SysReportgroup();
        $query = "SELECT * FROM sys_reportlist WHERE menugroup_id = $groupid AND active = 1 AND record_flag = 'Y' ORDER BY order_number,id";
        $data['listmenu'] = Yii::app()->db->createCommand($query)->queryAll();
        $data['group'] = $groupModel->GetDetailGroup($groupid);
        $data['groupid'] = $groupid;
        $data['groupname'] = $groupname;
        $this->render('listmenu', $data);
    }
}

?>
