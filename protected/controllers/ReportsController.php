<?php

class ReportsController extends Controller {

    //public $layout = "backend_system";

    public function actionIndex($group = null,$reportid = null) {
        $groupModel = new SysReportgroup();
        $reportModel = new SysReportlist();
        $data['group'] = $groupModel->GetDetailGroup($group);
        $data['report'] = $reportModel->get_detail_report($reportid);
        $this->render('index',$data);
    }
   
}
