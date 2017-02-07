<?php

class BackofficeController extends Controller {

    public $layout = "backend";
    private $maxLevel = 0;
    private $maxRowLevel = 0;
    private $arrColId = array();

    public function actionIndex() {
        //$this->render('//backOffice/AdminMenu');
        $this->actionShowgroupreport();
    }

    public function beforeAction($action) {
        if (isset(Yii::app()->session['userid']) && (Yii::app()->session['admin_flag'] == 1 /* || Yii::app()->session['report_flag'] == 1 */)) {
            return true;
        } else {
            $this->render('//user/accessdeny');
        }
    }

    public function actionShowCatalog() {

        //Unset Navigater
        unset(Yii::app()->session['navigatorcatalog']);
        unset(Yii::app()->session['navigatorgroupmenu']);
        unset(Yii::app()->session['navigatorconfiggroup']);

        $ampur = Yii::app()->session['distcode'];

        $user = new SysReportuser();
        $cat = new SysReportcatalog();

        //$data['Catalog'] = $cat->showcatalog();
        $icon = new SysReportIcon();
        $data['icon'] = $icon->findAll();
        $data['Group'] = $cat->findAll("catalog_id = '$catalog_id' and delete_flag='0'");
        $data['ampur'] = $user->get_pcu($ampur);
        $this->render('//backOffice/GroupMenu', $data);
    }

    public function actionMenu($distID = '') {
        $distId = Yii::app()->session['distId'] = $distID;
        $catalog = new SysReportcatalog();
        $data['catalog'] = $catalog->findAll("owner = $distId");
        $this->render('//template/menu_report', $data);
    }

    public function actionSaveCatalog() {
        $create = Yii::app()->session['userid'];
        $data = array(
            'name' => $_POST['catalog'],
            'note' => $_POST['note'],
            'owner' => $_POST['owner'],
            'create_date' => date('Y-m-d H:i:s'),
            'create_by' => $create,
            'delete_flag' => '0'
        );

        Yii::app()->db->createCommand()
                ->insert('sys_reportcatalog', $data);
    }

    public function actionEditCatalog() {
        //$owner = Yii::app()->session['userid'];
        $catalog_id = $_POST['catalog_id'];
        $data = array(
            'name' => $_POST['catalog'],
            'note' => $_POST['note'],
            'owner' => $_POST['owner']
        );

        Yii::app()->db->createCommand()
                ->update('sys_reportcatalog', $data, "id = '$catalog_id' ");
    }

    public function actionCheck_flag() {
        $catalog_id = $_POST['catalog_id'];
        $sql = "SELECT COUNT(*)
                FROM sys_reportgroup g
                WHERE g.catalog_id = '$catalog_id' ";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        echo $count;
    }

    public function actionCheckflaggroup() {
        $group_id = $_POST['group_id'];
        $sql = "SELECT COUNT(*)
                FROM sys_reportlist g
                WHERE g.menugroup_id = '$group_id' ";
        $count = Yii::app()->db->createCommand($sql)->queryScalar();
        echo $count;
    }

    public function actionDeletecatalog() {
        $catalog_id = $_POST['catalog_id'];
        $data = array('delete_flag' => '1');
        Yii::app()->db->createCommand()
                ->update('sys_reportcatalog', $data, "id = '$catalog_id' ");
    }

    public function actionShowgroupreport() {
        $cat = new SysReportgroup();
        $icon = new SysReportIcon();
        $data['icon'] = $icon->findAll();
        $data['Group'] = $cat->findAll("delete_flag='0'");
        $this->render('//backOffice/GroupMenu', $data);
    }

    public function actionShowreportlist() {
        $data['menugroup_id'] = $_GET['menugroup_id'];
        $GroupmenuModel = new SysReportgroup();
        $data['groupmenu'] = $GroupmenuModel->GetDetailGroup($data['menugroup_id']);
        //select ข้อมูลในตาราง Sys_col_group ขึ้นมาเพื่อเอามาใส่ใน DropdowsList
        $col = new SysItemGroups();
        $data['itemid'] = $col->getAllByDistCode(Yii::app()->session['distcode']);

        //select ข้อมูลในตาราง Sys_row_group ขึ้นมาเพื่อเอามาใส่ใน DropdowsList
        $period = new Period();
        $data['periodid'] = $period->findAll();

        $FilterModel = new Filters();
        $data['filter'] = $FilterModel->findAll();

        //$this->render('//backOffice/Sysreportlist', $data);
        $this->render('//backOffice/Sysreportlist', $data);
    }

    public function actionGetreportlist() {
        //รับค่าจาก View ที่ Ajax POST มา
        $menugroup_id = $_POST['menugroup_id'];
        $report = new SysReportlist();
        $data['listreport'] = $report->findAll("menugroup_id = '$menugroup_id' ORDER BY order_number,id");
        $data['menugroupid'] = $menugroup_id;

        //ส่งค่าไปที่ View สำหรับแสดงข้อมูล
        $this->renderPartial('//backOffice/ReportTable', $data);
    }

    //Function Save ข้อมูล
    public function actionSavereport() {
        $owner = Yii::app()->session['userid'];

        $menugroup = $_POST['rpmenugid'];

        $ChkCreate_by = "SELECT count(*) FROM sys_reportlist WHERE menugroup_id = '$menugroup'";
        $row = Yii::app()->db->createCommand($ChkCreate_by)->queryScalar();
        $order_number = ($row + 1);
        // Insert ข้อมูลลงฐานข้อมูล
        $data = array(
            'name' => $_POST['rpname'],
            //'name_en' => $_POST['rpname_en'],
            'subtitle' => $_POST['subtitle'],
            //'subtitle_en' => $_POST['subtitle_en'],
            'source' => $_POST['rpsource'],
            //'source_en' => $_POST['rpsource_en'],
            'note' => $_POST['rpnote'],
            //'note_en' => $_POST['rpnote_en'],
            'menugroup_id' => $menugroup,
            //'owner' => '10723',
            'controller' => $_POST['rpurl'],
            'create_by' => $owner,
            'create_date' => date('Y-m-d H:i:s'),
            'col_group_id' => $_POST['rpcol'],
            'row_group_id' => $_POST['rprow'],
            'period_id' => $_POST['rpperiod'],
            'record_flag' => $_POST['rptype'],
            'template' => $_POST['template'],
            'order_number' => $order_number,
            'showall' => $_POST['showall'],
            'showtype' => $_POST['showtype'],
            'showsum' => $_POST['showsum'],
            'checkinput' => $_POST['checkinput']
        );

        Yii::app()->db->createCommand()
                ->insert('sys_reportlist', $data);
    }

    //Function แก้ไขข้อมูล
    public function actionEditreport() {
        $owner = Yii::app()->session['userid'];
        $rpid = $_POST['rpid'];
        $data = array(
            'name' => $_POST['rpname'],
            //'name_en' => $_POST['rpname_en'],
            'subtitle' => $_POST['subtitle'],
            //'subtitle_en' => $_POST['subtitle_en'],
            'source' => $_POST['rpsource'],
            //'source_en' => $_POST['rpsource_en'],
            'note' => $_POST['rpnote'],
            //'note_en' => $_POST['rpnote_en'],
            'controller' => $_POST['rpcontroller'],
            'col_group_id' => $_POST['rpcol'],
            'row_group_id' => $_POST['rprow'],
            'period_id' => $_POST['rpperiod'],
            'create_by' => $owner,
            'order_number' => $_POST['rpno'],
            'record_flag' => $_POST['rptype'],
            'template' => $_POST['template'],
            'showall' => $_POST['showall'],
            'showtype' => $_POST['showtype'],
            'showsum' => $_POST['showsum'],
            'checkinput' => $_POST['checkinput'],
            'kpistatus' => $_POST['kpistatus']
        );

        Yii::app()->db->createCommand()
                ->update('sys_reportlist', $data, "id = '$rpid' ");
    }

    //Function ลบข้อมูล
    public function actionDeletereport() {
        $rpID = Yii::app()->request->getPost('rpid');
        Yii::app()->db->createCommand()
                ->delete('sys_reportlist', "id = '$rpID' ");
    }

    // Save Group MENU Create By  Chok
    public function actionSavegroup_report() {
        $data = array(
            'name' => Yii::app()->request->getPost('groupname'),
            //'name_en' => Yii::app()->request->getPost('groupname_en'),
            'note' => Yii::app()->request->getPost('note'),
            //'note_en' => Yii::app()->request->getPost('note_en'),
            'icon' => Yii::app()->request->getPost('set_icon'),
            'delete_flag' => '0',
            'showkpi' => Yii::app()->request->getPost('showkpi')
                /*
                  'catalog_id' => $_POST['catalogid'],
                  'color' => $_POST['color'],
                 * 
                 */
        );
        Yii::app()->db->createCommand()
                ->insert('sys_reportgroup', $data);
    }

    //Edit Group Report Create By Chok
    public function actionEditgroup_report() {
        $groupid = $_POST['group_id'];
        $data = array(
            'name' => $_POST['groupname'],
            //'name_en' => $_POST['groupname_en'],
            'note' => $_POST['note'],
            //'note_en' => $_POST['note_en'],
            'icon' => $_POST['icon'],
            'showkpi' => Yii::app()->request->getPost('showkpi')
        );
        Yii::app()->db->createCommand()
                ->update('sys_reportgroup', $data, "id = '$groupid' ");
    }

    //Delete Group Menu Report
    public function actionDeletegroupmenu() {
        $GroupId = $_POST['group_id'];
        Yii::app()->db->createCommand()
                ->delete("sys_reportgroup", "id = '$GroupId' ");
    }

    /*
     * Config Template ReportGroup
     */

    public function actionConfigtemplate() {
        $CatalogID = $_GET['catalog_id'];
        $data['catalog_id'] = $CatalogID;
        $data['CatalogName'] = $_GET['catalogname'];

        //Navigator
        Yii::app()->session['navigatorconfiggroup'] = "จัดการรูปแบบ";

        $SysReportgroup = new SysReportgroup();
        $data['configtemplate'] = $SysReportgroup->gettemplategroup($CatalogID);
        $this->render('//backOffice/Configtemplate', $data);
    }

    public function actionCombolistreport() {
        $catalogId = $_POST['CatalogId'];
        $group = new SysReportgroup();
        $tem = new SysReportmenuTemplate();
        $datatem = $tem->findAll('1=1 group by template_id order by template_id asc');
        $data = $group->getcombogroup($catalogId);
        $str = "";
        $str .= "<select id='menuId' class='form-control input-sm'>";
        $str .= "<option value='' >เลือกกลุ่มรายงาน</option>";
        foreach ($data as $rs):
            $str .= "<option value='" . $rs['groupid'] . "'>" . $rs['groupid'] . '-' . $rs['groupname'] . "</option>";
        endforeach;
        $str .= "</select>";
        $str .= "รูปแบบ";
        $str .= "<select id='template' class='form-control input-sm'>";
        foreach ($datatem as $rss):
            $str .= "<option value='" . $rss['template_id'] . "'>" . $rss['name'] . "</option>";
        endforeach;
        $str .= "</select>";

        echo $str;
    }

    public function actionSaverow() {
        $groupId = $_POST['groupID'];
        $columns = array(
            'template' => $_POST['template'],
            'rowid' => $_POST['rowID'],
            'colid' => '1'
        );
        Yii::app()->db->createCommand()
                ->update("sys_reportgroup", $columns, "id = '$groupId' ");
    }

    public function actionCombogroupreport() {
        $catalogId = $_POST['CatalogId'];
        $group = new SysReportgroup();
        $data = $group->getcombogroup($catalogId);
        $str = "";
        $str .= "<select id='menuId' class='form-control input-sm'>";
        $str .= "<option value='' >เลือกกลุ่มรายงาน</option>";
        foreach ($data as $rs):
            $str .= "<option value='" . $rs['groupid'] . "'>" . $rs['groupid'] . '-' . $rs['groupname'] . "</option>";
        endforeach;
        $str .= "</select>";

        echo $str;
    }

    public function actionSavecol() {
        $groupId = $_POST['groupID'];
        $columns = array(
            'template' => $_POST['template'],
            'rowid' => $_POST['rowID'],
            'colid' => $_POST['colid']
        );
        Yii::app()->db->createCommand()
                ->update("sys_reportgroup", $columns, "id = '$groupId' ");
    }

    public function actionOrderColumn() {
        $CatalogId = $_POST['CatalogId'];
        $RowID = $_POST['RowId'];
        $ColTotal = $_POST['ColTotal'];

        $tem = new SysReportgroup();
        $data['ColTotal'] = $ColTotal;
        $data['orderrow'] = $tem->findAll("catalog_id = '$CatalogId' AND rowid = '$RowID' ORDER BY colid ASC ");
        $this->renderPartial("//backOffice/Editrow", $data);
    }

    public function actionEditrow() {
        $id = $_POST['id'];
        $colid = $_POST['colid'];
        $data = array("colid" => $colid);
        Yii::app()->db->createCommand()
                ->update("sys_reportgroup", $data, "id = '$id' ");
    }

    public function actionDelboxmenu() {
        $id = $_POST['id'];
        $rowid = NULL;
        $colid = NULL;
        $template = NULL;
        $data = array("rowid" => $rowid, "colid" => $colid, "template" => $template);
        Yii::app()->db->createCommand()
                ->update("sys_reportgroup", $data, "id = '$id' ");
    }

    public function actionUpdate_report() {
        $id = $_POST['report_id'];
        $data = array(
            "shotname" => $_POST['shotname'],
            "condition" => $_POST['condition'],
            "criterion" => $_POST['criterion'],
            "active" => $_POST['active']
        );
        Yii::app()->db->createCommand()
                ->update("sys_reportlist", $data, "id = '$id' ");
    }

    public function actionUpdate_report_cockpit() {
        $id = $_POST['report_id'];
        $data = array(
            "shotname" => $_POST['shotname'],
            "condition" => $_POST['condition'],
            "criterion" => $_POST['criterion']
        );
        Yii::app()->db->createCommand()
                ->update("sys_reportlist", $data, "id = '$id' ");
    }

    public function actionGet_detail_report() {
        $id = $_POST['report_id'];
        //$sql = "select name as report_name,note from sys_reportlist where id = '$id'  ";
        $sql = "select name as report_name,name_en,note,note_en,source_en,subtitle_en,count(rs.ID) as amount from sys_reportlist r
                left join results rs on rs.REPORT_ID = r.id
                where r.id = $id";
        $json = Yii::app()->db->createCommand($sql)->queryRow();
        echo CJSON::encode($json);

        //echo CJSON::encode($json);
    }

    public function actionReportOrderSave() {
        $reportId = $_POST['item_id'];

        $c = 0;
        $i = 1;


        foreach ($reportId as $id):

            $where = "id = " . $id;
            $rs = array(
                'order_number' => $i++
            );

            $c += Yii::app()->db->createCommand()->update('sys_reportlist', $rs, $where);

        endforeach;

        echo $c;
    }

    public function actionFormreportsql() {
        $this->renderPartial('//sysreportlist/formreportsql');
    }

    //Function Save ข้อมูล
    public function actionSavereportsql() {
        $owner = Yii::app()->session['userid'];

        $menugroup = $_POST['rpmenugid'];

        $ChkCreate_by = "SELECT count(*) FROM sys_reportlist WHERE menugroup_id = '$menugroup'";
        $row = Yii::app()->db->createCommand($ChkCreate_by)->queryScalar();
        $order_number = ($row + 1);
        // Insert ข้อมูลลงฐานข้อมูล
        $data = array(
            'name' => $_POST['rpname'],
            'source' => $_POST['rpsource'],
            'note' => $_POST['rpnote'],
            'menugroup_id' => $menugroup,
            'template' => 'report/template/dynamics',
            'controller' => $_POST['rpurl'],
            'create_by' => $owner,
            'create_date' => date('Y-m-d H:i:s'),
            'col_group_id' => $_POST['rpcol'],
            'row_group_id' => '0',
            'period_id' => $_POST['rpperiod'],
            'record_flag' => "N",
            'order_number' => $order_number,
            'kpistatus' => $_POST['kpistatus']
        );

        Yii::app()->db->createCommand()
                ->insert('sys_reportlist', $data);

        $sqlInput = Yii::app()->request->getPost('sql');
        $sqldroup = str_replace("drop", "", $sqlInput);
        $sqldeete = str_replace("delete", "", $sqldroup);
        $sqldatabases = str_replace("databases", "", $sqldeete);

        $sqlDROP = str_replace("DROP", "", $sqldatabases);
        $sqlDELETE = str_replace("DELETE", "", $sqlDROP);
        $sqlDATABASES = str_replace("DATABASES", "", $sqlDELETE);

        $sqlMax = "SELECT MAX(id) maxid FROM sys_reportlist";

        $rrs = Yii::app()->db->createCommand($sqlMax)->queryRow();
        $report_id = $rrs['maxid'];
        $sql = $sqlDATABASES;
        $columnSql = array(
            "sql" => $sql,
            "level" => '1',
            "report_id" => $report_id
        );

        Yii::app()->db->createCommand()
                ->insert('sys_report_sql', $columnSql);
    }

    public function actionFormeditreportsql() {
        $id = Yii::app()->request->getPost('report_id');
        //$sql = "select name as report_name,note from sys_reportlist where id = '$id'  ";
        $sql = "SELECT r.*,s.sql FROM sys_reportlist r INNER JOIN sys_report_sql s ON r.id = s.report_id WHERE r.id = '$id' ";
        $data['datas'] = Yii::app()->db->createCommand($sql)->queryRow();

        $this->renderPartial('//sysreportlist/formeditreportsql', $data);
    }

    //Function update ข้อมูล
    public function actionUpdatereportsql() {
        $report_id = Yii::app()->request->getPost('report_id');

        $data = array(
            'name' => $_POST['rpname'],
            'source' => $_POST['rpsource'],
            'note' => $_POST['rpnote'],
            //'menugroup_id' => $menugroup,
            //'template' => 'report/template/dynamics',
            //'controller' => $_POST['rpurl'],
            //'create_by' => $owner,
            //'create_date' => date('Y-m-d H:i:s'),
            'col_group_id' => $_POST['rpcol'],
            'period_id' => $_POST['rpperiod'],
            'kpistatus' => $_POST['kpistatus']
                //'record_flag' => "N",
                //'order_number' => $order_number
        );

        Yii::app()->db->createCommand()
                ->update('sys_reportlist', $data, "id = '$report_id'");

        $sqlInput = Yii::app()->request->getPost('sql');
        $sqldroup = str_replace("drop", "", $sqlInput);
        $sqldeete = str_replace("delete", "", $sqldroup);
        $sqldatabases = str_replace("databases", "", $sqldeete);

        $sqlDROP = str_replace("DROP", "", $sqldatabases);
        $sqlDELETE = str_replace("DELETE", "", $sqlDROP);
        $sqlDATABASES = str_replace("DATABASES", "", $sqlDELETE);

        /*
          $sqlMax = "SELECT MAX(id) maxid FROM sys_reportlist";
          $rrs = Yii::app()->db->createCommand($sqlMax)->queryRow();
          $report_id = $rrs['maxid'];
         * 
         */
        $sql = $sqlDATABASES;
        $columnSql = array(
            "sql" => $sql
        );

        Yii::app()->db->createCommand()
                ->update('sys_report_sql', $columnSql, "report_id = '$report_id' ");
    }

    public function actionPreview() {
        $reportid = Yii::app()->request->getPost('reportid');
        $reports = new SysReportlist();
        $report = $reports->find("id = $reportid");
        $colGroupId = $report->col_group_id;
        $levelId = "1";
        $reportShowType = $report->showtype;
        //$rowGroupId = $report->row_group_id;
        //$reportShowType = $report->showtype;
        //$results = $this->getResults($reportId, $budGetYear, $period, $rowGroupId, $levelId);

        $this->setMaxLevel($colGroupId);
        $this->setMaxRowLevel($colGroupId);  // max row for header

        $table = "<table id='ReportTable' class='stripe row-border order-column cell-border' cellspacing='0' width='100%'>";

        //if($listFlag == 1){
        //    $table .= $this->genColsPeriod($reportShowType,$colGroupId, $budGetYear,$periodId,$levelId,$rowGroupId, $this->getHeaderName($rowGroupId, $levelId));
        //}else{
        $table .= $this->genCols($reportShowType, $colGroupId, $levelId, $colGroupId, $this->getHeaderName($colGroupId, $levelId));
        //}
        //$table .= $this->genRows($reportId, $levelId, $budGetYear, $id);
        /* if ($levelId > 1) {
          if($listFlag == 1){
          $results = $this->getResultsPeriod($reportShowType,$reportId, $budGetYear, $rowGroupId, $levelId, $id);
          $table .= $this->genRowsPeriod($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $periodId, $levelId, $results, $id);
          }else{
          $results = $this->getResults($reportShowType,$reportId, $budGetYear, $period, $rowGroupId, $levelId, $id, $listFlag);
          $table .= $this->genRows($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $period, $levelId, $results, $id);
          }
          } else {
          if($listFlag == 1){
          $results = $this->getResultsPeriod($reportShowType,$reportId, $budGetYear, $rowGroupId, $levelId);
          $table .= $this->genRowsPeriod($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $periodId, $levelId, $results);
          }else{
          $results = $this->getResults($reportShowType,$reportId, $budGetYear, $period, $rowGroupId, $levelId, $listFlag);
          $table .= $this->genRows($reportShowType,$reportId, $rowGroupId, $colGroupId, $budGetYear, $period, $levelId, $results);
          }
          } */

        $table .= "</table>";

        $data['table'] = $table;

        $data['colLock'] = "1";
        /* if($reportShowType == 2 && $levelId > 1){
          $data['colLock'] = ($this->maxRowLevel - $levelId) + 1;
          }else{
          $data['colLock'] = "1";
          } */

        //$data['colArray'] = $this->arrColId;
        //$data['level'] = $levelId;
        //$data['id'] = $id;

        $this->renderPartial('//reports/dynamics', $data);
    }

    private function setMaxLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }

    private function setMaxRowLevel($itemGroupId) {
        $sql = "SELECT max(levelid) as maxLevel FROM sys_items WHERE delete_flag = 0 and item_group_id=" . $itemGroupId;

        $this->maxRowLevel = Yii::app()->db->createCommand($sql)->queryScalar();
    }

    private function genCols($reportShowType, $itemGroupId, $levelId, $colGroupId, $headerGroupName = "อำเภอ") {
        $items = new SysItems();

        $str = "<thead>";
        $this->arrColId = array();

        $strColId = "";

        $tmpCol = array();
        $tmpCol2 = array();

        for ($i = 1; $i <= $this->maxLevel; $i++) {


            if ($i == 1) {
                $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i ORDER BY order_number+0,id");

                $tmpCol = $column;
                $str .= "<tr>";

                if ($reportShowType == 2 && $levelId > 1) {
                    /*
                     * แสดงหัวตารางทุกระดับ
                     */
                    //$arrUpper = array();
                    $itemGroups = new SysItemGroupsSql();
                    $itemGroup = $itemGroups->findByPk($colGroupId);

                    $arrUpper = explode("->", substr($itemGroup->item_group_name, 0));

                    for ($y = $levelId - 1; $y < $this->maxRowLevel; $y++) {
                        $str .= "<th rowspan='" . $this->maxLevel . "'>" . $arrUpper[$y] . "</th>";
                    }
                    /*                     * ************************************************* */
                } else {
                    if ($levelId > 1) {
                        $str .= "<th rowspan='" . ($this->maxLevel) . "'>" . $headerGroupName . "</th>";
                    } else {
                        $str .= "<th rowspan='" . ($this->maxLevel) . "'>" . $headerGroupName . "</th>";
                    }
                }

                // แสดงปี
                //$countItem = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND under_level = 0");   
                //$str .= "<th colspan='".count($countItem)."'>".($period==2?'ปี พ.ศ. ':'ปีงบประมาณ ').$budGetYear."</th>";
                //$str .= "</tr><tr>";

                foreach ($column as $col):
                    // เก็บค่า colid ที่ต้องแสดงผล
                    //if ($col['under_level'] == 0) {
                    $strColId .= "|" . $col['id'];
                    //}

                    $rowspan = $this->getRowSpan($col['id']);
                    $colspan = $this->getColSpan($col['id']);

                    $str .= "<th ";

                    if ($rowspan > 1) {
                        $str .= " rowspan='" . $rowspan . "'";
                    }
                    if ($colspan > 1) {
                        $str .= " colspan='" . $colspan . "'";
                    }

                    $str .= ">" . $col['item_name'] . "</th>";
                    //$str .= ">" . $col['item_name'] . " id=".$col['id']. "</th>";
                endforeach;
                $str .= "</tr>";
            } else {
                $str .= "<tr>";
                foreach ($tmpCol as $c):
                    $column = $items->findAll("delete_flag = 0 and item_group_id = $itemGroupId AND levelid = $i AND upper_item_id = $c->id ORDER BY order_number+0,id");

                    $tmpCol2 = array_merge($tmpCol2, $column);

                    $strColId2 = "";
                    foreach ($column as $col):
                        // เก็บค่า colid ที่ต้องแสดงผล
                        //if ($col['under_level'] == 0) {
                        $strColId2 .= "|" . $col['id'];
                        //}

                        $rowspan = $this->getRowSpan($col['id']);
                        $colspan = $this->getColSpan($col['id']);

                        $str .= "<th ";

                        if ($rowspan > 1) {
                            $str .= " rowspan='" . $rowspan . "'";
                        }
                        if ($colspan > 1) {
                            $str .= " colspan='" . $colspan . "'";
                        }

                        $str .= ">" . $col['item_name'] . "</th>";
                    endforeach;
                    if (strlen($strColId2) > 0) {
                        $strColId = str_replace("|" . $c->id, $strColId2, $strColId);
                    }
                endforeach;
                $str .= "</tr>";
                $tmpCol = $tmpCol2;
            }
        }

        $str .= "</thead>";

        if (substr($strColId, 0, 1) == "|") {
            $strColId = substr($strColId, 1, strlen($strColId));
        }

        $this->arrColId = array_filter(explode("|", $strColId));

        return $str;
    }

    private function getHeaderName($colGroupId, $levelId) {
        $itemGroup = new SysItemGroups();
        $groups = $itemGroup->find("id = $colGroupId");

        $arrGroup = explode("->", $groups->item_group_name);

        if (count($arrGroup) >= ($levelId - 1))
            return $arrGroup[$levelId - 1];
        else
            return $arrGroup[0];
    }

    private function getRowSpan($itemId) {
        $sql = "SELECT IF(under_level > 0,1,($this->maxLevel+1) - levelid) FROM sys_items WHERE id = '$itemId';";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

    private function getColSpan($itemId) {
        $sql = "select count(*) from sys_items where delete_flag = 0 and upper_item_all like '%|$itemId|%' and under_level = 0;";
        $result = Yii::app()->db->createCommand($sql)->queryScalar();
        return $result;
    }

}
