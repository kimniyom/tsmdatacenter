<?php

/**
 * This is the model class for table "sys_item_groups".
 *
 * The followings are the available columns in table 'sys_item_groups':
 * @property integer $id
 * @property string $item_group_name
 * @property integer $delete_flag
 */
class SysItemGroups extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_item_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_group_name,item_group_name_en', 'required'),
			array('delete_flag', 'numerical', 'integerOnly'=>true),
			array('item_group_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_group_name, delete_flag', 'safe', 'on'=>'search'),
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
			'item_group_name_en' => 'Item Group Name EN',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('item_group_name',$this->item_group_name,true);
		$criteria->compare('item_group_name_en',$this->item_group_name_en,true);
		$criteria->compare('delete_flag',$this->delete_flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysItemGroups the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getAll(){
            $sql = "SELECT g.id,g.item_group_name,g.item_group_name_en,COUNT(i.id) as child FROM sys_item_groups g
                    LEFT JOIN sys_items i ON i.item_group_id = g.id AND i.delete_flag = 0
                    WHERE g.delete_flag = 0
                    GROUP BY g.id";
            
            $rs = Yii::app()->db->createCommand($sql)->queryAll();
            return $rs;
        }
        
        public function getAllByDistCode($distCode){
            
            if($distCode == "6300"){
                $sql = "SELECT g.id,g.item_group_name,g.item_group_name_en,g.comment,COUNT(i.id) as child FROM sys_item_groups g
                        LEFT JOIN sys_items i ON i.item_group_id = g.id AND i.delete_flag = 0
                        WHERE g.delete_flag = 0 
                        GROUP BY g.id
                        ORDER BY g.id";
            }else{  
                $sql = "SELECT g.id,g.item_group_name,g.item_group_name_en,g.comment,COUNT(i.id) as child FROM sys_item_groups g
                        LEFT JOIN sys_items i ON i.item_group_id = g.id AND i.delete_flag = 0
                        WHERE g.delete_flag = 0 AND g.distid = '$distCode'
                        GROUP BY g.id
                        ORDER BY g.id";
            }
            
            $rs = Yii::app()->db->createCommand($sql)->queryAll();
            return $rs;
        }
        
}
