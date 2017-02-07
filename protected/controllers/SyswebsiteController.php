<?php

class SyswebsiteController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'backend';

    /**
     * @return array action filters
     */
    /*
      public function filters() {
      return array(
      'accessControl', // perform access control for CRUD operations
      'postOnly + delete', // we only allow deletion via POST request
      );
      }
     * 
     */

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /*
      public function accessRules() {
      return array(
      array('allow', // allow all users to perform 'index' and 'view' actions
      'actions' => array('index', 'view'),
      'users' => array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions' => array('create', 'update'),
      'users' => array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions' => array('admin', 'delete'),
      'users' => array('admin'),
      ),
      array('deny', // deny all users
      'users' => array('*'),
      ),
      );
      }
     * 
     */

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
    public function actionCreate() {
        $model = new SysWebsite;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysWebsite'])) {
            $model->attributes = $_POST['SysWebsite'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['SysWebsite'])) {
            $model->attributes = $_POST['SysWebsite'];
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
    public function actionIndex() {
        $data['website'] = SysWebsite::model()->find("id = '1' ");
        $this->render('index', $data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SysWebsite('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SysWebsite']))
            $model->attributes = $_GET['SysWebsite'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SysWebsite the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SysWebsite::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SysWebsite $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-website-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function Randstrgen() {
        $len = 30;
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

    public function actionUploadify() {
        /*
          Uploadify
          Copyright (c) 2012 Reactive Apps, Ronnie Garcia
          Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
         */

// Define a destination

        $targetFolder = Yii::app()->baseUrl . '/uploads/logo'; // Relative to the root

        if (!empty($_FILES)) {
            $rs = SysWebsite::model()->find("id = '1'");
            unlink("./uploads/logo/" . $rs['logo']);
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $FULLNAME = $_FILES['Filedata']['name'];
            $type = substr($FULLNAME, -3);
            $Name = "logo_" . $this->Randstrgen() . "." . $type;
            $targetFile = $targetPath . '/' . $Name;

//$targetFile = $targetFolder . '/' . $_FILES['Filedata']['name'];
//$targetFile = $targetFolder . '/' . $Name;
// Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'JPEG', 'png', 'JPG'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
//$GalleryShot = $_FILES['Filedata']['name'];
            //$tempFile = $_FILES['Filedata']['tmp_name'];
            //$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            //$targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];
            // Validate the file type
            //$fileTypes = array('rar', 'pdf', 'zip'); // File extensions
            //$fileParts = pathinfo($_FILES['Filedata']['name']);


            if (in_array($fileParts['extension'], $fileTypes)) {

                //$width = 1280; //*** Fix Width & Heigh (Autu caculate) ***//
                //$new_images = "Thumbnails_".$_FILES["Filedata"]["name"];
                //$size = getimagesize($_FILES['Filedata']['tmp_name']);
                /*
                  $height = round($width * $size[1] / $size[0]);
                  $images_orig = imagecreatefromjpeg($tempFile);
                  $photoX = imagesx($images_orig);
                  $photoY = imagesy($images_orig);
                  $images_fin = imagecreatetruecolor($width, $height);
                  imagecopyresampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                  imagejpeg($images_fin, "uploads/photo/" . $Name);
                  imagedestroy($images_orig);
                  imagedestroy($images_fin);
                 * 
                 */

                move_uploaded_file($tempFile, $targetFile);

                $columns = array(
                    'logo' => $Name
                );
                Yii::app()->db->createCommand()
                        ->update("sys_website", $columns, "id = '1'");
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionSave() {

        $columns = array(
            "name" => Yii::app()->request->getPost('name'),
            "headcolor" => "#".Yii::app()->request->getPost('headcolor'),
            "textheadcolor" => "#".Yii::app()->request->getPost('textheadcolor'),
            "sidebarcolor" => "#".Yii::app()->request->getPost('sidebarcolor'),
            "textsidebarcolor" => "#".Yii::app()->request->getPost('textsidebarcolor'),
            "navigatorcolor" => "#".Yii::app()->request->getPost('navigatorcolor'),
            "textnavigatorcolor" => "#".Yii::app()->request->getPost('textnavigatorcolor'),
            "headtablecolor" => Yii::app()->request->getPost('headtablecolor'),
            "textheadtablecolor" => Yii::app()->request->getPost('textheadtablecolor')
        );

        Yii::app()->db->createCommand()->update("sys_website", $columns, "id = '1'");
    }

}
