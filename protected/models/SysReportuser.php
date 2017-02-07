<?php

/**
 * This is the model class for table "sys_reportuser".
 *
 * The followings are the available columns in table 'sys_reportuser':
 * @property integer $userid
 * @property string $name
 * @property string $lname
 * @property string $hospcode
 * @property string $username
 * @property string $password
 * @property string $distcode
 * @property integer $delete_flag
 * @property integer $admin_flag
 * @property integer $report_flag
 * @property integer $user_flag
 */
class SysReportuser extends CActiveRecord
{
	   
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_reportuser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('delete_flag, admin_flag, report_flag, user_flag', 'numerical', 'integerOnly'=>true),
			array('name, lname', 'length', 'max'=>255),
			array('hospcode', 'length', 'max'=>9),
			array('username, password', 'length', 'max'=>100),
			array('distcode', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userid, name, lname, hospcode, username, password, distcode, delete_flag, admin_flag, report_flag, user_flag', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'name' => 'Name',
			'lname' => 'Lname',
			'hospcode' => 'Hospcode',
			'username' => 'Username',
			'password' => 'Password',
			'distcode' => 'Distcode',
			'delete_flag' => 'Delete Flag',
			'admin_flag' => 'Admin Flag',
			'report_flag' => 'Report Flag',
			'user_flag' => 'User Flag',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('hospcode',$this->hospcode,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('distcode',$this->distcode,true);
		$criteria->compare('delete_flag',$this->delete_flag);
		$criteria->compare('admin_flag',$this->admin_flag);
		$criteria->compare('report_flag',$this->report_flag);
		$criteria->compare('user_flag',$this->user_flag);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysReportuser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function validatePassword($password) {
            return $this->hashPassword($password, $this->username) === $this->password;
        }

        public function hashPassword($password, $username) {
            return md5($username . $password);
        }
        
        public function get_pcu($hospcode = ''){
            if($hospcode == '6300'){
                $sql = "SELECT * FROM co_district ORDER BY distid";
                return Yii::app()->db->createCommand($sql)->queryAll();
            } else {
                $sql = "SELECT * FROM co_district WHERE distid = '$hospcode' ";
                return Yii::app()->db->createCommand($sql)->queryAll();
            }
        }
}
