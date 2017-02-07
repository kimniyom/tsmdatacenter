<?php

class HeadrowstablesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'backend';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($reportid) {
        $model = new Headrowstables;
        $ReportListModel = new SysReportlist();
        $RepoerGroupModel = new SysReportgroup();

        $reportList = $ReportListModel->find("id = '$reportid'");
        $reportGroup = $RepoerGroupModel->find("id = '" . $reportList['menugroup_id'] . "' ");
        $detail = $model->find("report_id = '$reportid'");

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Headrowstables'])) {
            $model->attributes = $_POST['Headrowstables'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
            'reportid' => $reportid,
            'detail' => $detail,
            'reportlist' => $reportList,
            'reportgroup' => $reportGroup,
        ));
    }

    public function actionLoaddata() {
        $reportid = Yii::app()->request->getPost('report_id');
        $model = new Headrowstables;

        $ReportListModel = new SysReportlist();
        $data['reportlist'] = $ReportListModel->find("id = '$reportid' ");
        $data['detail'] = $model->find("report_id = '$reportid'");
        $filterActive = $data['reportlist']['template'];

        $sql = "SELECT f.filter_name
                    FROM filters f 
                    WHERE f.filter LIKE('$filterActive') ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        
        if($data['detail']['rows'] != ''){
            $rowsTotal = $data['detail']['rows'];
        } else {
            $rowsTotal = 1;
        }
        
        $data['filter'] = $rs;
        $data['rows'] = $rowsTotal;
        $data['reportid'] = $reportid;
        $this->renderPartial('headrowstables', $data);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Headrowstables'])) {
            $model->attributes = $_POST['Headrowstables'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($reportid) {
        $Model = new Headrowstables();
        $data['rows'] = $Model->findAll();
        $data['reportid'] = $reportid;
        $this->render('index', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Headrowstables('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Headrowstables']))
            $model->attributes = $_GET['Headrowstables'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Headrowstables the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Headrowstables::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Headrowstables $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'headrowstables-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSave() {
        $reportid = Yii::app()->request->getPost('report_id');
        $rows = Yii::app()->request->getPost('rows');
        $Model = new Headrowstables();
        $ReportList = new SysReportlist();
        $data['reportlist'] = $ReportList->find("id = '$reportid'");
        $CheckReport = $Model->find("report_id = '$reportid'");
         $filterActive = $data['reportlist']['template'];

        $sql = "SELECT f.filter_name
                    FROM filters f 
                    WHERE f.filter LIKE('$filterActive') ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if (empty($CheckReport)) {
            $columns = array(
                'report_id' => $reportid,
                'rows' => $rows
            );
            Yii::app()->db->createCommand()
                    ->insert("headrowstables", $columns);
        } else {
            $columns = array(
                'rows' => $rows
            );
            Yii::app()->db->createCommand()
                    ->update("headrowstables", $columns, "report_id = '$reportid'");
        }

        $data['headtables'] = $CheckReport;
        $data['rows'] = $rows;
        $data['reportid'] = $reportid;
        $data['filter'] = $rs;
        $this->renderPartial('headrowstables', $data);
    }

}
