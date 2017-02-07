<?php

/**
 * This is the model class for table "co_district".
 *
 * The followings are the available columns in table 'co_district':
 * @property string $district_id
 * @property string $distid
 * @property string $distname
 * @property string $distname_en
 * @property integer $geo_id
 * @property string $provid
 * @property string $borderhealth
 */
class CoDistrict extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'co_district';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('distid, distname', 'required'),
			array('geo_id', 'numerical', 'integerOnly'=>true),
			array('distid', 'length', 'max'=>4),
			array('distname, distname_en', 'length', 'max'=>30),
			array('provid', 'length', 'max'=>2),
			array('borderhealth', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('district_id, distid, distname, distname_en, geo_id, provid, borderhealth', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'district_id' => 'District',
			'distid' => 'Distid',
			'distname' => 'Distname',
			'distname_en' => 'Distname En',
			'geo_id' => 'Geo',
			'provid' => 'Provid',
			'borderhealth' => 'Borderhealth',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('distid',$this->distid,true);
		$criteria->compare('distname',$this->distname,true);
		$criteria->compare('distname_en',$this->distname_en,true);
		$criteria->compare('geo_id',$this->geo_id);
		$criteria->compare('provid',$this->provid,true);
		$criteria->compare('borderhealth',$this->borderhealth,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CoDistrict the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
