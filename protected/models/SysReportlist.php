<?php

/**
 * This is the model class for table "sys_reportlist".
 *
 * The followings are the available columns in table 'sys_reportlist':
 * @property integer $id
 * @property string $subtitle
 * @property string $subtitle_en
 * @property string $name
 * @property string $name_en
 * @property string $source
 * @property string $source_en
 * @property string $note
 * @property string $note_en
 * @property integer $menugroup_id
 * @property string $owner
 * @property string $create_date
 * @property integer $create_by
 * @property string $controller
 * @property string $template
 * @property integer $col_group_id
 * @property integer $row_group_id
 * @property integer $period_id
 * @property string $record_flag
 * @property integer $order_number
 * @property string $progress
 * @property string $shotname
 * @property string $condition
 * @property string $criterion
 * @property integer $active
 * @property string $table_name
 * @property integer $flag
 * @property integer $showall
 * @property integer $showtype
 * @property integer $showsum
 * @property integer $checkinput
 * @property string $storeproces_name
 */
class SysReportlist extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sys_reportlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_date', 'required'),
			array('menugroup_id, create_by, col_group_id, row_group_id, period_id, order_number, active, flag, showall, showtype, showsum, checkinput', 'numerical', 'integerOnly'=>true),
			array('name, name_en, source, source_en, controller, template', 'length', 'max'=>255),
			array('owner', 'length', 'max'=>10),
			array('record_flag', 'length', 'max'=>1),
			array('progress, shotname, table_name', 'length', 'max'=>100),
			array('condition', 'length', 'max'=>5),
			array('criterion', 'length', 'max'=>50),
			array('storeproces_name', 'length', 'max'=>155),
			array('subtitle, subtitle_en, note, note_en', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subtitle, subtitle_en, name, name_en, source, source_en, note, note_en, menugroup_id, owner, create_date, create_by, controller, template, col_group_id, row_group_id, period_id, record_flag, order_number, progress, shotname, condition, criterion, active, table_name, flag, showall, showtype, showsum, checkinput, storeproces_name', 'safe', 'on'=>'search'),
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
			'subtitle' => 'Subtitle',
			'subtitle_en' => 'Subtitle En',
			'name' => 'Name',
			'name_en' => 'Name En',
			'source' => 'Source',
			'source_en' => 'Source En',
			'note' => 'Note',
			'note_en' => 'Note En',
			'menugroup_id' => 'Menugroup',
			'owner' => 'Owner',
			'create_date' => 'Create Date',
			'create_by' => 'Create By',
			'controller' => 'Controller',
			'template' => 'Template',
			'col_group_id' => 'Col Group',
			'row_group_id' => 'Row Group',
			'period_id' => 'Period',
			'record_flag' => 'Record Flag',
			'order_number' => 'Order Number',
			'progress' => 'Progress',
			'shotname' => 'Shotname',
			'condition' => 'Condition',
			'criterion' => 'Criterion',
			'active' => 'Active',
			'table_name' => 'Table Name',
			'flag' => 'Flag',
			'showall' => 'Showall',
			'showtype' => 'Showtype',
			'showsum' => 'Showsum',
			'checkinput' => 'Checkinput',
			'storeproces_name' => 'Storeproces Name',
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
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('subtitle_en',$this->subtitle_en,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('source_en',$this->source_en,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('note_en',$this->note_en,true);
		$criteria->compare('menugroup_id',$this->menugroup_id);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('create_by',$this->create_by);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('col_group_id',$this->col_group_id);
		$criteria->compare('row_group_id',$this->row_group_id);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('record_flag',$this->record_flag,true);
		$criteria->compare('order_number',$this->order_number);
		$criteria->compare('progress',$this->progress,true);
		$criteria->compare('shotname',$this->shotname,true);
		$criteria->compare('condition',$this->condition,true);
		$criteria->compare('criterion',$this->criterion,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('table_name',$this->table_name,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('showall',$this->showall);
		$criteria->compare('showtype',$this->showtype);
		$criteria->compare('showsum',$this->showsum);
		$criteria->compare('checkinput',$this->checkinput);
		$criteria->compare('storeproces_name',$this->storeproces_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SysReportlist the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public function get_link_report($report_id = '') {
            $sql = "SELECT *
                            FROM sys_reportlist s
                            WHERE s.`id` = '$report_id' ";
            $rs = Yii::app()->db->createCommand($sql)->queryRow();
            //return $rs['controller'];
            return $rs;
        }

        public function getcountlist($menuID = '') {
            $sql = "SELECT COUNT(*) AS TOTAL
                            FROM sys_reportlist r
                            WHERE r.`menugroup_id` = '$menuID' AND flag = '1' ";
            $rs = Yii::app()->db->createCommand($sql)->queryRow();
            return $rs['TOTAL'];
        }

        public function get_detail_report($report_id = '') {
            $sql = "SELECT *
                            FROM sys_reportlist
                            WHERE id = '$report_id' ";
            $rs = Yii::app()->db->createCommand($sql)->queryRow();
            //return $rs['controller'];
            return $rs;
        }
        
}