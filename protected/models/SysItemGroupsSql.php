<?php

/**
 * This is the model class for table "sys_item_groups_sql".
 *
 * The followings are the available columns in table 'sys_item_groups_sql':
 * @property integer $id
 * @property string $item_group_name
 * @property string $item_group_name_en
 * @property integer $delete_flag
 * @property integer $create_by
 * @property string $create_date
 * @property string $distid
 */
class SysItemGroupsSql extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_item_groups_sql';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_group_name, create_date', 'required'),
			array('id, delete_flag, create_by', 'numerical', 'integerOnly'=>true),
			array('item_group_name, item_group_name_en', 'length', 'max'=>255),
			array('distid', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_group_name, item_group_name_en, delete_flag, create_by, create_date, distid', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'item_group_name' => 'Item Group Name',
			'item_group_name_en' => 'Item Group Name En',
			'delete_flag' => 'Delete Flag',
			'create_by' => 'Create By',
			'create_date' => 'Create Date',
			'distid' => 'Distid',
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
		$criteria->compare('item_group_name',$this->item_group_name,true);
		$criteria->compare('item_group_name_en',$this->item_group_name_en,true);
		$criteria->compare('delete_flag',$this->delete_flag);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('distid',$this->distid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysItemGroupsSql the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
