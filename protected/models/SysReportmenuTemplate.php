<?php

/**
 * This is the model class for table "sys_reportmenu_template".
 *
 * The followings are the available columns in table 'sys_reportmenu_template':
 * @property integer $id
 * @property integer $template_id
 * @property string $images
 * @property integer $colid
 * @property string $code
 * @property string $name
 */
class SysReportmenuTemplate extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_reportmenu_template';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('template_id, colid', 'numerical', 'integerOnly' => true),
            array('images, name', 'length', 'max' => 100),
            array('code', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, template_id, images, colid, code, name', 'safe', 'on' => 'search'),
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
            'template_id' => 'Template',
            'images' => 'Images',
            'colid' => 'Colid',
            'code' => 'Code',
            'name' => 'Name',
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
        $criteria->compare('template_id', $this->template_id);
        $criteria->compare('images', $this->images, true);
        $criteria->compare('colid', $this->colid);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysReportmenuTemplate the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Countcolid($templateID = '') {
        $query = "SELECT COUNT(*) AS TOTAL FROM sys_reportmenu_template WHERE template_id = '$templateID' ";
        $result = Yii::app()->db->createCommand($query)->queryRow();
        return $result['TOTAL'];
    }

    public function thaidate($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

}
