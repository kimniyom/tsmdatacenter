<?php

class SysiconController extends Controller {
    /*
      public function actionIndex() {
      $this->render('//backOffice/AdminMenu');
      }
     */

    public $layout = "backend";

    public function actionShowSysicon() {
        $Icon = new SysReportIcon();
        $data['Icon'] = $Icon->findAll("1=1 ORDER BY id DESC");
        $this->render('//backOffice/Sysreporticon', $data);
    }

    public function actionUploadify() {
        /*
          Uploadify
          Copyright (c) 2012 Reactive Apps, Ronnie Garcia
          Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
         */

// Define a destination

        $targetFolder = Yii::app()->baseUrl . '/assets/icon_system'; // Relative to the root

        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];

            // Validate the file type
            $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array($fileParts['extension'], $fileTypes)) {
                $columns = array('icon' => $_FILES['Filedata']['name']);
                Yii::app()->db->createCommand()
                        ->insert("sys_report_icon", $columns);
                move_uploaded_file($tempFile, $targetFile);
                echo '1';
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    public function actionDelicon() {
        $id = $_POST['id'];
        $icon = $_POST['icon'];
        unlink(Yii::app()->basePath . '/../assets/icon_system/' . $icon);
        Yii::app()->db->createCommand()
                ->delete("sys_report_icon", "id = '$id' ");
    }

}
