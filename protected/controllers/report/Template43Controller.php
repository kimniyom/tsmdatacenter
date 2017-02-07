<?php

class Template43Controller extends CController {

    public $comboboxclass = "browser-default";

    //public $layout = "template_report";
    public function actionTemplatepopulation() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        $rs = $report->get_link_report($report_id);
        $dateNow = date("Y");
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (($dateNow - 2) + 543)); // 5 ปีย้อนหลัง

        $data['controller'] = $rs['controller'];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $this->renderPartial('//reports/report_template', $data);
    }

    public function actionTemplate_ampur_tambon_pcu_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $dateNow = date("Y");
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (($dateNow - 5) + 543)); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_tambon_pcu_singleyear', $data);
    }

    public function actionTemplate_ampur_tambon_pcu_multiyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['monthstart'] = $filter->monthComboBox("monthstart", "", "", "monthstart", $this->comboboxclass);
        $data['yearstart'] = $filter->yearComboBox("yearstart", "", "", "yearstart", $this->comboboxclass, (date("Y") - 5) + 543); // 5 ปีย้อนหลัง
        $data['monthend'] = $filter->monthComboBox("monthend", "", "", "monthend", $this->comboboxclass);
        $data['yearend'] = $filter->yearComboBox("yearend", "", "", "yearend", $this->comboboxclass, (date("Y") - 5) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_tambon_pcu_multiyear', $data);
    }

    public function actionTemplate_ampur_pcu_multiyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['monthstart'] = $filter->monthComboBox("monthstart", "", "", "monthstart", $this->comboboxclass);
        $data['yearstart'] = $filter->yearComboBox("yearstart", "", "", "yearstart", $this->comboboxclass, (date("Y") - 5) + 543); // 5 ปีย้อนหลัง
        $data['monthend'] = $filter->monthComboBox("monthend", "", "", "monthend", $this->comboboxclass);
        $data['yearend'] = $filter->yearComboBox("yearend", "", "", "yearend", $this->comboboxclass, (date("Y") - 5) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_pcu_multiyear', $data);
    }

    public function actionTemplate_ampur_tambon_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 5) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_tambon_singleyear', $data);
    }

    public function actionTemplate_ampur_pcu_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 2) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_pcu_singleyear', $data);
    }

    public function actionTemplate_ampur_selectpcu_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 2) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_selectpcu_singleyear', $data);
    }

    public function actionTemplate_ampur_selectpcur506_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        $r506 = new Report_r506();
        /* Filter */
        $filter = new Filter();
        $value1 = $r506->get_group_506();
        $value2 = $r506->get_disease_code();

        $data['code506'] = $filter->ComboBox_R506('code506', 'code506', "", "", 'โรคร่วม', $value1, 'โรคเดี่ยว', $value2, '');
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 2) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_selectpcu506_singleyear', $data);
    }

    public function actionTemplate_ampur_tambon_or_pcu_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 2) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_tambon_or_pcu_singleyear', $data);
    }

    public function actionTemplate_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 1) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/singleyear', $data);
    }

    public function actionTemplate_borderhealth_ampur_pcu_singleyear() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (date("Y") - 2) + 543); // 5 ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampurborderhealth_pcu_singleyear', $data);
    }

    //ชุดเงื่อนไขเลือกอำเภอ มี ปุ่ม radio ให้เลือกเทอม 1 หรือ 2
    public function actionTemplate_ampur_term() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $dateNow = date("Y");
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (($dateNow - 1) + 543)); // 5ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_pcu_term', $data);
    }

    //ชุดเงื่อนไขเลือกอำเภอ ปีงบประมาณ เลือกไตรมาสได้
    public function actionTemplate_ampur_period() {
        $report_id = $_GET['report_id'];
        //$info = $_GET['info'];
        $report = new SysReportlist();
        /* Filter */
        $dateNow = date("Y");
        $filter = new Filter();
        $data['year'] = $filter->yearComboBox("year", "", "", "year", $this->comboboxclass, (($dateNow - 1) + 543)); // 5ปีย้อนหลัง

        $rs = $report->get_link_report($report_id);
        $data['controller'] = $rs['controller'];
        $data['info'] = $rs['source' . Language::GetLanguageDefault()];
        $data['note'] = $rs['note' . Language::GetLanguageDefault()];
        $this->renderPartial('//filter/ampur_pcu_period', $data);
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
