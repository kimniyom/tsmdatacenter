<?php

class TempopulationController extends CController {

    //public $layout = "template_report";
    public function actionTemplatepopulation() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        $rs = $report->get_link_report($report_id);

        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $this->renderPartial('//reports/report_template', $data);
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
