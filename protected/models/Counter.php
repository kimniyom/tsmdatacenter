<?php

/**
 * This is the model class for table "counter".
 *
 * The followings are the available columns in table 'counter':
 * @property integer $id
 * @property string $ip
 * @property string $date
 * @property string $d_update
 */
class Counter extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'counter';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ip', 'length', 'max' => 20),
            array('date, d_update', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ip, date, d_update', 'safe', 'on' => 'search'),
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
            'ip' => 'Ip',
            'date' => 'Date',
            'd_update' => 'D Update',
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
        $criteria->compare('ip', $this->ip, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('d_update', $this->d_update, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Counter the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function CheckCounter($ip = null) {
        $date = date("Y-m-d");
        $sql = "SELECT * FROM counter WHERE ip = '$ip' AND date = '$date' ";
        $check = Yii::app()->db->createCommand($sql)->queryRow();
        if (empty($check)) {
            $columns = array("ip" => $ip, "date" => $date, "d_update" => date("Y-m-d H:i:s"));
            Yii::app()->db->createCommand()->insert("counter", $columns);
        }
    }
    
     public function CountAll() {
        $sql = "SELECT COUNT(*) AS total FROM counter";
        $check = Yii::app()->db->createCommand($sql)->queryRow();
        return $check['total'];
    }
    
     public function CountDay() {
        $date = date("Y-m-d");
        $sql = "SELECT COUNT(*) AS total FROM counter WHERE date = '$date'";
        $check = Yii::app()->db->createCommand($sql)->queryRow();
        return $check['total'];
    }

}
