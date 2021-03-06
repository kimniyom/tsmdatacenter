<?php

/**
 * This is the model class for table "headrowstables".
 *
 * The followings are the available columns in table 'headrowstables':
 * @property integer $id
 * @property integer $report_id
 * @property string $headname
 * @property string $headname_en
 * @property integer $upper
 * @property integer $rows
 */
class Headrowstables extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'headrowstables';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('report_id, upper, rows', 'numerical', 'integerOnly' => true),
            array('headname, headname_en', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, report_id, headname, headname_en, upper, rows', 'safe', 'on' => 'search'),
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
            'report_id' => 'Report',
            'headname' => 'Headname',
            'headname_en' => 'Headname En',
            'upper' => 'Upper',
            'rows' => 'จำนวนแถวของหัวตาราง',
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
        $criteria->compare('report_id', $this->report_id);
        $criteria->compare('headname', $this->headname, true);
        $criteria->compare('headname_en', $this->headname_en, true);
        $criteria->compare('upper', $this->upper);
        $criteria->compare('rows', $this->rows);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Headrowstables the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
