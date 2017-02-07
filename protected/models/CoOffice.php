<?php

/**
 * This is the model class for table "co_office".
 *
 * The followings are the available columns in table 'co_office':
 * @property string $off_id
 * @property string $off_id_new
 * @property string $off_name
 * @property string $off_name_en
 * @property string $off_type
 * @property string $address
 * @property string $road
 * @property string $provid
 * @property string $distid
 * @property string $subdistid
 * @property string $villid
 * @property string $villno
 * @property string $postcode
 * @property string $cup_code
 * @property string $pcu_code
 * @property string $pointx
 * @property string $pointy
 * @property string $status
 * @property string $hasdata
 * @property string $hasdataf12
 * @property string $hasdatancd
 * @property string $hasdatarefer
 * @property string $refermember
 * @property string $createdate
 * @property string $updatedate
 * @property string $off_name_new
 * @property integer $order_number
 */
class CoOffice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'co_office';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('off_id', 'required'),
			array('order_number', 'numerical', 'integerOnly'=>true),
			array('off_id, postcode, cup_code, pcu_code', 'length', 'max'=>5),
			array('off_id_new', 'length', 'max'=>9),
			array('off_name, off_name_en, road, off_name_new', 'length', 'max'=>100),
			array('off_type, provid, villno', 'length', 'max'=>2),
			array('address', 'length', 'max'=>255),
			array('distid', 'length', 'max'=>4),
			array('subdistid', 'length', 'max'=>6),
			array('villid', 'length', 'max'=>8),
			array('pointx, pointy', 'length', 'max'=>50),
			array('status, hasdata, hasdataf12, hasdatancd, hasdatarefer, refermember', 'length', 'max'=>1),
			array('createdate, updatedate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('off_id, off_id_new, off_name, off_name_en, off_type, address, road, provid, distid, subdistid, villid, villno, postcode, cup_code, pcu_code, pointx, pointy, status, hasdata, hasdataf12, hasdatancd, hasdatarefer, refermember, createdate, updatedate, off_name_new, order_number', 'safe', 'on'=>'search'),
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
			'off_id' => 'Off',
			'off_id_new' => 'Off Id New',
			'off_name' => 'Off Name',
			'off_name_en' => 'Off Name En',
			'off_type' => 'Off Type',
			'address' => 'Address',
			'road' => 'Road',
			'provid' => 'Provid',
			'distid' => 'Distid',
			'subdistid' => 'Subdistid',
			'villid' => 'Villid',
			'villno' => 'Villno',
			'postcode' => 'Postcode',
			'cup_code' => 'Cup Code',
			'pcu_code' => 'Pcu Code',
			'pointx' => 'Pointx',
			'pointy' => 'Pointy',
			'status' => 'Status',
			'hasdata' => 'Hasdata',
			'hasdataf12' => 'Hasdataf12',
			'hasdatancd' => 'Hasdatancd',
			'hasdatarefer' => 'Hasdatarefer',
			'refermember' => 'Refermember',
			'createdate' => 'Createdate',
			'updatedate' => 'Updatedate',
			'off_name_new' => 'Off Name New',
			'order_number' => 'Order Number',
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

		$criteria->compare('off_id',$this->off_id,true);
		$criteria->compare('off_id_new',$this->off_id_new,true);
		$criteria->compare('off_name',$this->off_name,true);
		$criteria->compare('off_name_en',$this->off_name_en,true);
		$criteria->compare('off_type',$this->off_type,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('road',$this->road,true);
		$criteria->compare('provid',$this->provid,true);
		$criteria->compare('distid',$this->distid,true);
		$criteria->compare('subdistid',$this->subdistid,true);
		$criteria->compare('villid',$this->villid,true);
		$criteria->compare('villno',$this->villno,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('cup_code',$this->cup_code,true);
		$criteria->compare('pcu_code',$this->pcu_code,true);
		$criteria->compare('pointx',$this->pointx,true);
		$criteria->compare('pointy',$this->pointy,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('hasdata',$this->hasdata,true);
		$criteria->compare('hasdataf12',$this->hasdataf12,true);
		$criteria->compare('hasdatancd',$this->hasdatancd,true);
		$criteria->compare('hasdatarefer',$this->hasdatarefer,true);
		$criteria->compare('refermember',$this->refermember,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('updatedate',$this->updatedate,true);
		$criteria->compare('off_name_new',$this->off_name_new,true);
		$criteria->compare('order_number',$this->order_number);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CoOffice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
