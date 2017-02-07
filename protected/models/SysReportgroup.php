<?php

/**
 * This is the model class for table "sys_reportgroup".
 *
 * The followings are the available columns in table 'sys_reportgroup':
 * @property integer $id
 * @property string $name
 * @property string $name_en
 * @property string $note
 * @property string $note_en
 * @property string $owner
 * @property string $create_date
 * @property integer $create_by
 * @property integer $catalog_id
 * @property integer $rowid
 * @property integer $template
 * @property string $color
 * @property integer $colid
 * @property string $icon
 * @property integer $delete_flag
 */
class SysReportgroup extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_reportgroup';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('create_date', 'required'),
            array('create_by, catalog_id, rowid, template, colid, delete_flag', 'numerical', 'integerOnly' => true),
            array('name, name_en', 'length', 'max' => 255),
            array('owner', 'length', 'max' => 10),
            array('color, icon', 'length', 'max' => 100),
            array('note, note_en', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, name_en, note, note_en, owner, create_date, create_by, catalog_id, rowid, template, color, colid, icon, delete_flag', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'name_en' => 'Name En',
            'note' => 'Note',
            'note_en' => 'Note En',
            'owner' => 'Owner',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'catalog_id' => 'Catalog',
            'rowid' => 'Rowid',
            'template' => 'Template',
            'color' => 'Color',
            'colid' => 'Colid',
            'icon' => 'Icon',
            'delete_flag' => 'Delete Flag',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('note_en', $this->note_en, true);
        $criteria->compare('owner', $this->owner, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('create_by', $this->create_by);
        $criteria->compare('catalog_id', $this->catalog_id);
        $criteria->compare('rowid', $this->rowid);
        $criteria->compare('template', $this->template);
        $criteria->compare('color', $this->color, true);
        $criteria->compare('colid', $this->colid);
        $criteria->compare('icon', $this->icon, true);
        $criteria->compare('delete_flag', $this->delete_flag);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysReportgroup the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function findgroup() {
        $sql = "SELECT * FROM sys_reportgroup";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function findgroupkpi() {
        $sql = "SELECT * FROM sys_reportgroup WHERE showkpi = '1' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function get_group_report($catalog_id = '') {
        $sql = "SELECT g.`id`,g.`name`,g.`name_en`,g.`rowid`,g.`colid`,m.`code`,g.`color`,g.icon
                    FROM sys_reportgroup g INNER JOIN sys_reportmenu_template m ON g.`template` = m.`template_id` AND g.`colid` = m.`colid`
                    WHERE g.`catalog_id` = '$catalog_id' and g.rowid is not null order by g.rowid,g.colid";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function getGroupReportRecord($catalogId) {
        $sql = "SELECT r.* FROM sys_reportgroup r
                INNER JOIN sys_reportlist l ON l.menugroup_id = r.id AND l.record_flag = 'Y'
                WHERE r.catalog_id = $catalogId
                GROUP BY r.id";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function gettemplategroup($catalogId = '') {
        $query = "SELECT g.`rowid`,g.`template`,t.`name`,t.`name_en`,g.`catalog_id`,g.colid
                    FROM sys_reportgroup g INNER JOIN sys_reportmenu_template t ON g.`template` = t.`template_id`
                    WHERE g.`catalog_id` = '$catalogId' AND g.`rowid` IS NOT NULL
                    GROUP BY g.`rowid`
                    ORDER BY g.`rowid`";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getsubcatalog($catalogId = '', $rowId = '') {
        $query = "SELECT g.*,t.`code`
                        FROM sys_reportgroup g INNER JOIN sys_reportmenu_template t ON g.`template` = t.`template_id` AND g.`colid` = t.`colid`
                        WHERE g.`rowid` = '$rowId' AND g.`catalog_id` = '$catalogId'
                        ORDER BY g.`catalog_id`,g.`colid` ASC ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getcombogroup($catalogId = '') {
        $query = "SELECT g.id AS groupid,g.`template`,g.`catalog_id`,g.`name` AS groupname
                        FROM sys_reportgroup g 
                        WHERE g.`catalog_id` = '$catalogId' AND (g.`rowid` = '' OR g.`rowid` IS NULL)
                        ORDER BY g.`id` ";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

    public function getcountgroup($catalogIdD = '') {
        $sql = "SELECT COUNT(*) AS TOTAL
                    FROM sys_reportgroup r
                    WHERE r.`catalog_id` = '$catalogIdD' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    public function GetDetailGroup($groupID = null) {
        $sql = "SELECT * FROM sys_reportgroup WHERE id = '$groupID' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs;
    }
    
    public function getGroupMenuRecord(){
        $sql = "SELECT DISTINCT g.* FROM sys_reportgroup g
                INNER JOIN sys_reportlist l ON l.menugroup_id = g.id
                WHERE l.active = 1 AND l.record_flag = 'Y'";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

}
