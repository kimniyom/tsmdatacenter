<?php

/**
 * This is the model class for table "results".
 *
 * The followings are the available columns in table 'results':
 * @property string $ID
 * @property integer $REPORT_ID
 * @property string $BUDGETYEAR
 * @property string $PERIOD
 * @property integer $COL_ITEM_ID
 * @property integer $ROW_ITEM_ID
 * @property double $AMOUNT
 * @property integer $USER_ID
 * @property string $DATE_UPDATE
 */
class Results extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'results';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DATE_UPDATE', 'required'),
			array('REPORT_ID, COL_ITEM_ID, ROW_ITEM_ID, USER_ID', 'numerical', 'integerOnly'=>true),
			array('AMOUNT', 'numerical'),
			array('BUDGETYEAR, PERIOD', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, REPORT_ID, BUDGETYEAR, PERIOD, COL_ITEM_ID, ROW_ITEM_ID, AMOUNT, USER_ID, DATE_UPDATE', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'REPORT_ID' => 'Report',
			'BUDGETYEAR' => 'Budgetyear',
			'PERIOD' => 'Period',
			'COL_ITEM_ID' => 'Col Item',
			'ROW_ITEM_ID' => 'Row Item',
			'AMOUNT' => 'Amount',
			'USER_ID' => 'User',
			'DATE_UPDATE' => 'Date Update',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('REPORT_ID',$this->REPORT_ID);
		$criteria->compare('BUDGETYEAR',$this->BUDGETYEAR,true);
		$criteria->compare('PERIOD',$this->PERIOD,true);
		$criteria->compare('COL_ITEM_ID',$this->COL_ITEM_ID);
		$criteria->compare('ROW_ITEM_ID',$this->ROW_ITEM_ID);
		$criteria->compare('AMOUNT',$this->AMOUNT);
		$criteria->compare('USER_ID',$this->USER_ID);
		$criteria->compare('DATE_UPDATE',$this->DATE_UPDATE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Results the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
