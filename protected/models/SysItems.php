<?php

/**
 * This is the model class for table "sys_items".
 *
 * The followings are the available columns in table 'sys_items':
 * @property integer $id
 * @property integer $item_group_id
 * @property string $item_code
 * @property string $item_name
 * @property string $item_name_en
 * @property integer $upper_item_id
 * @property string $upper_item_all
 * @property integer $order_number
 * @property integer $levelid
 * @property integer $under_level
 * @property integer $delete_flag
 * @property string $reference_id
 * @property integer $create_by
 * @property string $create_date
 * @property string $distid
 * @property integer $inputtype
 *
 * The followings are the available model relations:
 * @property Results[] $results
 * @property Results[] $results1
 */
class SysItems extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_group_id, item_name', 'required'),
			array('item_group_id, upper_item_id, order_number, levelid, under_level, delete_flag, create_by, inputtype', 'numerical', 'integerOnly'=>true),
			array('item_code', 'length', 'max'=>20),
			array('item_name, item_name_en, upper_item_all, reference_id', 'length', 'max'=>255),
			array('distid', 'length', 'max'=>4),
			array('create_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_group_id, item_code, item_name, item_name_en, upper_item_id, upper_item_all, order_number, levelid, under_level, delete_flag, reference_id, create_by, create_date, distid, inputtype', 'safe', 'on'=>'search'),
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
			'results' => array(self::HAS_MANY, 'Results', 'COL_ITEM_ID'),
			'results1' => array(self::HAS_MANY, 'Results', 'ROW_ITEM_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_group_id' => 'Item Group',
			'item_code' => 'Item Code',
			'item_name' => 'Item Name',
			'item_name_en' => 'Item Name En',
			'upper_item_id' => 'Upper Item',
			'upper_item_all' => 'Upper Item All',
			'order_number' => 'Order Number',
			'levelid' => 'Levelid',
			'under_level' => 'Under Level',
			'delete_flag' => 'Delete Flag',
			'reference_id' => 'Reference',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'distid' => 'Distid',
			'inputtype' => 'Inputtype',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('item_group_id',$this->item_group_id);
		$criteria->compare('item_code',$this->item_code,true);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('item_name_en',$this->item_name_en,true);
		$criteria->compare('upper_item_id',$this->upper_item_id);
		$criteria->compare('upper_item_all',$this->upper_item_all,true);
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('levelid',$this->levelid);
		$criteria->compare('under_level',$this->under_level);
		$criteria->compare('delete_flag',$this->delete_flag);
		$criteria->compare('reference_id',$this->reference_id,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('distid',$this->distid,true);
		$criteria->compare('inputtype',$this->inputtype);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysItems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
