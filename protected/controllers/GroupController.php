<?php

class GroupController extends Controller {

    public function actionGet_ListReport() {
        $group_id = $_GET['group_id'];
        $cat = new SysReportlist();
        $data['Catalog'] = $cat->findAll("$group_id");
        $this->render('//backOfiice/Catalog', $data);
    }

}
