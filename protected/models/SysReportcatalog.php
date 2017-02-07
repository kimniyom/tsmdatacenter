<?php

/**
 * This is the model class for table "sys_reportcatalog".
 *
 * The followings are the available columns in table 'sys_reportcatalog':
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property string $create_date
 * @property integer $create_by
 * @property string $owner
 * @property integer $delete_flag
 */
class SysReportcatalog extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_reportcatalog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('create_date', 'required'),
            array('create_by, delete_flag', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('owner', 'length', 'max' => 10),
            array('note', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, note, create_date, create_by, owner, delete_flag', 'safe', 'on' => 'search'),
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
            'note' => 'Note',
            'create_date' => 'Create Date',
            'create_by' => 'Create By',
            'owner' => 'Owner',
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
        $criteria->compare('note', $this->note, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('create_by', $this->create_by);
        $criteria->compare('owner', $this->owner, true);
        $criteria->compare('delete_flag', $this->delete_flag);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysReportcatalog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function showcatalog($ampur = '') {
        
        if($ampur == "6300"){
             $showCatalog = "SELECT SRPCL.*,SRPU.name as Author 
                                FROM sys_reportcatalog SRPCL 
                                LEFT JOIN sys_reportuser SRPU on SRPCL.create_by=SRPU.userid  
                                WHERE SRPCL.delete_flag='0' ORDER BY SRPCL.owner,SRPCL.id";
        }else{
            $showCatalog = "SELECT SRPCL.*,SRPU.name as Author 
                                FROM sys_reportcatalog SRPCL 
                                LEFT JOIN sys_reportuser SRPU on SRPCL.create_by=SRPU.userid  
                                WHERE SRPCL.delete_flag='0' AND owner = '$ampur' ORDER BY SRPCL.owner,SRPCL.id";
        }
        
        return Yii::app()->db->createCommand($showCatalog)->queryAll();
    }

}
